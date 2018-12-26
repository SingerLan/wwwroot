<?php
if(!class_exists('WP_List_Table')){
    require_once( ABSPATH . 'wp-admin/includes/class-wp-list-table.php' );
}

class WPJAM_List_Table extends WP_List_Table {
	public function __construct($args = []){
		$args	= wp_parse_args($args, [
			'screen'			=> '',
			'title'				=> '',
			'plural'			=> '',
			'singular'			=> '',
			'primary_key'		=> '',
			'primary_column'	=> '',
			'fields'			=> [],
			'flat_fields'		=> [],
			'columns'			=> [],
			'sortable_columns'	=> [],
			'options_columns'	=> [],
			'bulk_actions'		=> [],
			'per_page'			=> 50,
			'ajax'				=> false,
			'model'				=> '',
			'capability'		=> 'manage_options',
			// 'modes'			=> '',
			'actions'			=> [
				'add'		=> ['title'=>'新增'],
				'edit'		=> ['title'=>'编辑'],
				'duplicate'	=> ['title'=>'复制'],
				'delete'	=> ['title'=>'删除',	'direct'=>true,	'bulk'=>true, 'confirm'=>true],
			]
		]);

		$args['screen']	= $args['name']??'';

		$model	= $args['model'];

		if($model && method_exists($model,'get_primary_key')){
			$args['primary_key']	= $args['model']::get_primary_key();	
		}

		if($model && method_exists($model, 'get_actions')){
			$args['actions']	= $model::get_actions();
		}

		if($args['actions']){
			$bulk_actions	= [];

			if($args['ajax']){
				foreach ($args['actions'] as $action_key => $action) {
					if(empty($action['bulk'])) continue;

					$capability	= $action['capability']??$args['capability'];

					if(current_user_can($capability)){
						$bulk_actions[$action_key]	= $action['title'];
					}
				}

				if($bulk_actions){
					$args['bulk_actions']	= array_merge($args['bulk_actions'], $bulk_actions);
				}
			}else{
				$args['bulk_actions']	= [];
			}	
		}

		if($model && method_exists($model, 'get_fields')){
			$args['fields']	= $model::get_fields();
		}

		if($fields = $args['fields']){
			if(!empty($args['bulk_actions'])){
				$args['columns']['cb'] = 'checkbox';
				unset($fields['cb']);
			}
			
			foreach($fields as $key => $field){
				if($field['type'] == 'fieldset'){
					foreach ($field['fields'] as $sub_key => $sub_field){
						$args['flat_fields'][$sub_key]	= $sub_field;

						if(empty($sub_field['show_admin_column'])) continue;

						$args['columns'][$sub_key] = $sub_field['column_title']??$sub_field['title'];

						if(!empty($sub_field['options'])){
							$args['options_columns'][$sub_key] = $sub_field['options'];
						}

						if(!empty($sub_field['sortable_column'])){
							$args['sortable_columns'][$sub_key] = [$sub_key, true];
						}	
					}
				}else{
					$args['flat_fields'][$key]	= $field;

					if(empty($field['show_admin_column'])) continue;

					$args['columns'][$key] = $field['column_title']??$field['title'];

					if(!empty($field['options'])){
						$args['options_columns'][$key] = $field['options'];
					}

					if(!empty($field['sortable_column'])){
						$args['sortable_columns'][$key] = [$key, true];
					}
					
				}
			}
		}

		if(is_array($args['per_page'])){
			add_screen_option('per_page', $args['per_page']);	// 选项
		}

		if(!empty($args['style'])){
			add_action('admin_enqueue_scripts', function () {
				wp_add_inline_style('list-tables', $this->_args['style']);
			});
		}

		parent::__construct($args);
	}

	protected function get_table_classes() {
		$classes = parent::get_table_classes();

		if(empty($this->_args['fixed'])){
			return array_diff($classes, ['fixed']);
		}else{
			return $classes;
		}
	}

	public function get_model(){
		return $this->_args['model']; 
	}

	public function get_plural(){
		return $this->_args['plural'];
	}

	public function get_singular(){
		return $this->_args['singular'];
	}

	public function get_actions(){
		return $this->_args['actions'];
	}

	public function get_action($key){
		$actions	= $this->_args['actions'];
		return $actions[$key]??[];
	}

	public function get_action_capability($key){
		$action	= $this->get_action($key);
		if($action){
			return $action['capability']??$this->_args['capability'];
		}else{
			return $this->_args['capability'];
		}
	}

	public function get_row_action($key, $args=[]){
		extract(wp_parse_args($args, [
			'id'		=> 0,
			'data'		=> [],
			'class'		=> '',
			'style'		=> '',
			'title'		=> '',
			'tag'		=> 'a'
		]));

		$action	= $this->get_action($key);
		if(!$action) return '';

		$capability	= $this->get_action_capability($key);
		if(!current_user_can($capability)) return '';

		$title		= $title?:$action['title'];
		$class		= $class?' '.$class:'';
		$page_title	= $action['page_title']??($action['title'].$this->_args['title']);

		if($this->_args['ajax']){
			$class		= 'list-table-action'.$class;
			$data_attr	= $this->get_action_data_attr($key, $args);
			$style		= $style?' style="'.$style.'"':'';

			if($tag == 'a'){
				return '<a href="javascript:;" title="'.$page_title.'" class="'.$class.'"'.$style.' '.$data_attr.'>'.$title.'</a>';
			}else{
				return '<'.$tag.' title="'.$page_title.'" class="'.$class.'"'.$style.' '.$data_attr.'>'.$title.'</'.$tag.'>';
			}
		}else{
			global $current_admin_url;

			$action_url		= $current_admin_url.'&action='.$key;

			if($id){
				$primary_key	= $this->_args['primary_key'];
				$action_url		.= '&'.$primary_key.'='.$id;
			}

			$onclick	= '';

			if(!empty($action['direct']) || !empty($action['overall'])){
				$action_url = esc_url(wp_nonce_url($action_url, $this->get_nonce_action($key, $id)));
				if($key == 'delete'){
					$onclick = ' onclick="return confirm(\'你确定要删除？\');"';
				}
			}else{
				$action_url	.= '&TB_iframe=true&width=780&height=320';
				$class		= 'thickbox'.$class;
			}

			return '<a href="'.$action_url.'" title="'.$page_title.'" class="'.$class.'" '.$onclick.'>'.$title.'</a>';
		}
	}

	protected function bulk_actions( $which = '' ) {
		if ( is_null( $this->_actions ) ) {
			$this->_actions = $this->_args['bulk_actions'];
			$two	= '';
		} else {
			$two = '2';
		}

		if ( empty( $this->_actions ) )
			return;

		echo '<label for="bulk-action-selector-' . esc_attr( $which ) . '" class="screen-reader-text">' . __( 'Select bulk action' ) . '</label>';
		echo '<select name="action' . $two . '" id="bulk-action-selector-' . esc_attr( $which ) . "\">\n";
		echo '<option value="-1">' . __( 'Bulk Actions' ) . "</option>\n";

		foreach ( $this->_actions as $key => $title) {
			$class		= 'edit' === $key ? ' class="hide-if-no-js"' : '';
			$data_attr	= $this->get_action_data_attr($key, ['bulk'=>true]);

			echo "\t" . '<option value="' . $key . '"' . $class . $data_attr .'">' . $title . "</option>\n";
		}

		echo "</select>\n";

		submit_button( __( 'Apply' ), 'action list-table-bulk-action', '', false, array( 'id' => "doaction$two" ) );
		echo "\n";
	}

	public function get_action_data_attr($key, $args=[]){
		extract(wp_parse_args($args, [
			'type'	=> '',
			'id'	=> 0,
			'bulk'	=> false,
			'ids'	=> [],
			'data'	=> []
		]));

		$action	= $this->get_action($key);

		if(!$action) return '';

		$confirm	= $action['confirm']??'';
		$overall	= $action['overall']??'';

		if($overall){
			$direct		= true;
		}else{
			$direct		= $action['direct']??'';
		}

		$data_attr	= 'data-action="'.$key.'"';

		if($type == 'submit'){
			$submit_text	= $action['submit_text']??$action['title'];
			$data_attr		.= ' data-title="'.$submit_text.'"';
		}else{
			$page_title		= $action['page_title']??($action['title'].$this->_args['title']);
			$data_attr		.= ' data-title="'.$page_title.'"';
		}

		if($bulk){
			$nonce	= $this->create_nonce('bulk_'.$key);
			$ids	= $ids?http_build_query($ids):'';
		}else{
			$nonce	= $this->create_nonce($key, $id);
			
		}

		$action_data	= $action['data']??[];
		
		$data	= wp_parse_args($data, $action_data);
		$data	= $data?http_build_query($data):'';

		$data_values	= compact('nonce', 'id', 'bulk', 'ids', 'data', 'direct', 'confirm');

		foreach ($data_values as $data_key=>$value) {
			if($value){
				$data_attr	.= ' data-'.$data_key.'="'.$value.'"';
			}
		}

		return $data_attr;
	}

	public function get_filter_link($filters, $title, $class=''){

		$data_filters	= [];
		foreach ($filters as $name => $value) {
			$data_filters[]	= ['name'=>$name, 'value'=>$value];
		}

		return '<a title="'.esc_attr($title).'" href="javascript:;" class="list-table-filter '.$class.'" data-filter=\''.wpjam_json_encode($data_filters).'\'>'.$title.'</a>';
	}

	public function get_fields($key='', $id=0){
		if(empty($key)) return [];

		$action	= $this->get_action($key);

		if(!$action) return '';

		if(!empty($action['direct'])) return[];
		if(!empty($action['overall'])) return[];

		$fields	= $this->_args['fields'];

		$primary_key	= $this->_args['primary_key'];
		if($key != 'add' && isset($fields[$primary_key])){
			$fields[$primary_key]['type']	= 'view';
		}

		$model = $this->_args['model'];

		if($model && method_exists($model, 'get_fields')){
			$fields	= $model::get_fields($key, $id);
		}else{
			$fields	= apply_filters($this->get_postfix().'_'.$key.'_fields', $fields, $id);
			$fields	= apply_filters($this->get_postfix().'_fields', $fields, $id, $key);
		}

		return $fields;
	}

	public function create_nonce($key, $id=''){
		$nonce_action	= $this->get_nonce_action($key, $id);
		return wp_create_nonce($nonce_action);
	}

	public function verify_nonce($nonce, $key, $id=''){
		$nonce_action	= $this->get_nonce_action($key, $id);
		return wp_verify_nonce($nonce, $nonce_action);
	}

	public function get_nonce_action($key, $id=0){
		$nonce_action	= $key.'-'.$this->_args['singular'];

		return ($id)?$nonce_action.'-'.$id:$nonce_action;
	}

	public function get_postfix($list=false){
		if($list){
			return str_replace('-', '_', $this->_args['plural']);
		}else{
			return str_replace('-', '_', $this->_args['singular']);
		}
	}

	public function get_columns(){
		return apply_filters($this->_args['singular'].'_columns', $this->_args['columns']);
	}

	public function get_sortable_columns(){
		return $this->_args['sortable_columns']??[];
	}

	public function get_views(){
		if($model = $this->_args['model']){
			if(method_exists($model, 'views')){
				return $model::views();
			}
		}else{
			if(!empty($this->_args['views'])){
				return call_user_func($this->_args['views'],[]);
			}
		}

		return [];
	}

	public function single_row( $raw_item ) {
		$model	= $this->_args['model'];

		if($model && (!is_array($raw_item) || is_object($raw_item))){
			$raw_item	= $model::get($raw_item);
		}
		
		$item	= $this->parse_item($raw_item);
		$style	= isset($item['style'])?' style="'.$item['style'].'"':'';

		do_action('pre_'.$this->get_postfix().'_single_row', $item, $raw_item);

		$primary_key	= $this->_args['primary_key'];

		if($primary_key){
			$class	= isset($item['class'])?' class="'.$item['class'].' tr-'.$item[$primary_key].'"':'class="tr-'.$item[$primary_key].'"';

			echo '<tr id="'.$this->_args['singular'].'-'.$item[$primary_key].'" ' . $style . $class . '>';
		}else{
			$class	= isset($item['class'])?' class="'.$item['class'].'"':'';

			echo '<tr' . $style . $class . '>';
		}
		
		$this->single_row_columns($item);
		echo '</tr>';

		do_action($this->get_postfix().'_single_row', $item,  $raw_item);
	}

	protected function parse_item($raw_item){
		global $current_admin_url;

		$item	= (array)$raw_item;
		$model	= $this->_args['model'];

		$primary_key		= $this->_args['primary_key'];
		$actions			= $this->_args['actions'];
		$options_columns	= $this->_args['options_columns'];

		if($model && method_exists($model, 'row_actions')){
			$actions = $model::row_actions($actions, $item[$primary_key]);
		}

		if($primary_key && $actions){
			$item_id		= $item[$primary_key];
			$row_actions	= [];

			foreach ($actions as $action_key => $action) {
				if($action_key == 'add') continue;

				if(!empty($action['overall'])) continue;

				$row_actions[$action_key] = $this->get_row_action($action_key, ['id'=>$item_id]);
			}

			if($primary_key == 'id'){
				$row_actions[$primary_key]	= 'ID：'.$item_id;	// 显示 id
			}

			$item['row_actions']	= $row_actions;
		}

		if($model){
			if(method_exists($model, 'item_callback')){
				$item = $model::item_callback($item);	
			}

			if(method_exists($model, 'get_filterable_fields') && ($filterable_fields = $model::get_filterable_fields())) {
				foreach ($filterable_fields as $field_key) {
					if(isset($item[$field_key])){
						if(isset($options_columns[$field_key])){
							$item_value		= $item[$field_key];
							$options		= $options_columns[$field_key];

							$option_value	= $options[$item_value]??'';
							$option_value	= is_array($option_value)?$option_value['title']:$option_value;

							if($this->_args['ajax']){
								$item[$field_key]	= $option_value? $this->get_filter_link([$field_key=>$item_value], $option_value):$item_value;

							}else{
								$item[$field_key]	= $option_value?'<a href="'.$current_admin_url.'&'.$field_key.'='.$item_value.'">'.$option_value.'</a>':$item_value;
							}

							unset($options_columns[$field_key]);
						}else{
							if($item[$field_key] && isset($raw_item[$field_key])){
								if($this->_args['ajax']){
									$item[$field_key] = $this->get_filter_link([$field_key=>$raw_item[$field_key]], $item[$field_key]);
								}else{
									$item[$field_key] = '<a href="'.$current_admin_url.'&'.$field_key.'='.$raw_item[$field_key].'">'.$item[$field_key].'</a>';
								}
							}
						}
					}
				}
			}

			if(!empty($options_columns)){
				foreach ($options_columns as $field_key => $options) {
					if(isset($item[$field_key])){
						if($this->_args['fields'] && $this->_args['flat_fields'][$field_key]['type'] == 'checkbox' && $item[$field_key]){
							$item[$field_key]	= wp_array_slice_assoc($options, $item[$field_key]);
							$item[$field_key]	= implode(',', $item[$field_key]);
						}else{
							$item[$field_key]	= $options[$item[$field_key]]??$item[$field_key];
						}
					}
				}
			}
		}elseif(!empty($this->_args['item_callback'])){
			$item = call_user_func($this->_args['item_callback'], $item);

			if(!empty($options_columns)){
				foreach ($options_columns as $field_key => $options) {
					if(isset($item[$field_key])){
						if($this->_args['fields'] && $this->_args['flat_fields'][$field_key]['type'] == 'checkbox' && $item[$field_key]){
							$item[$field_key]	= wp_array_slice_assoc($options, $item[$field_key]);
							$item[$field_key]	= implode(',', $item[$field_key]);
						}else{
							$item[$field_key]	= $options[$item[$field_key]]??$item[$field_key];
						}
					}
				}
			}
		}

		return $item;
	}

	public function column_default($item, $column_name){
		return $item[$column_name]??'';
	}

	public function column_cb($item){
		$primary_key	= $this->_args['primary_key'];
		$name = isset($item['name'])?strip_tags($item['name']):$item[$primary_key];
		return '<label class="screen-reader-text" for="cb-select-' . $item[$primary_key] . '">' . sprintf( __( 'Select %s' ), $name ) . '</label>'
				. '<input class="list-table-cb" type="checkbox" name="'.$primary_key.'s[]" value="' . $item[$primary_key] . '" id="cb-select-' . $item[$primary_key] . '" />';
	}

	protected function get_default_primary_column_name(){
		if(!empty($this->_args['primary_column'])){
			return $this->_args['primary_column'];
		}

		return parent::get_default_primary_column_name();
	}

	protected function handle_row_actions($item, $column_name, $primary){
		if ( $primary !== $column_name ) {
			return '';
		}

		if(!empty($item['row_actions'])){
			return $this->row_actions($item['row_actions'], false);
		}
	}

	public function row_actions($actions, $always_visible = true){
		return parent::row_actions($actions, $always_visible);
	}

	public function get_per_page(){
		if($this->_args['per_page'] && is_numeric($this->_args['per_page'])){
			return $this->_args['per_page'];
		}

		$option	= $this->screen->get_option('per_page', 'option');
		if($option){
			$defualt	= $this->screen->get_option('per_page', 'default')?:50;
			$per_page	= $this->get_items_per_page($option, $default);

			return $per_page;
		}

		return 50;
	}

	public function get_offset(){
		return ($this->get_pagenum()-1) * $this->get_per_page();
	}

	public function get_limit(){
		return $this->get_offset().','.$this->get_per_page();
	}

	public function prepare_items($items='', $total_items=0){
		$this->items	= $items;
		if($total_items){
			$this->set_pagination_args( array(
				'total_items'	=> $total_items,
				'per_page'		=> $this->get_per_page()
			));
		}
	}

	public function display($args = array()){
		global $current_admin_url;

		if($args){
			$search = $args['search']??false;
		}else{
			if(isset($this->_args['search'])){
				$search	= $this->_args['search']??true;
			}elseif($model = $this->_args['model']){
				$search	= (method_exists($model, 'get_searchable_fields') && $model::get_searchable_fields())?true:false;
			}else{
				$search	= false; 
			}
		}

		$_SERVER['REQUEST_URI']	= remove_query_arg(['_wp_http_referer'], $_SERVER['REQUEST_URI']);

		if($this->_args['ajax']){
			echo '<form action="#" id="list_table_form" method="POST">';
		}else{
			echo '<form action="'. admin_url('admin.php').'" method="get">';
		}

		foreach(wp_parse_args(parse_url($current_admin_url, PHP_URL_QUERY)) as $hidden_field => $hidden_value){
			echo '<input type="hidden" name="'.$hidden_field.'" value="' . $hidden_value .'">';
		}

		if( ($search && $this->_pagination_args) || isset($_REQUEST['s']) ) {
			// $this->search_box('搜索', $this->_args['singular']);
			$this->search_box('搜索', 'wpjam');
		}

		echo '<div class="list-table">';

		$this->list_table(); 

		echo '</div>';

		echo '</form>';
	}

	public function search_box( $text, $input_id ) {
		if ( empty( $_REQUEST['s'] ) && !$this->has_items() )
			return;

		$input_id = $input_id . '-search-input';
		?>
		<p class="search-box">
			<label class="screen-reader-text" for="<?php echo esc_attr( $input_id ); ?>"><?php echo $text; ?>:</label>
			<input type="search" id="<?php echo esc_attr( $input_id ); ?>" name="s" value="<?php _admin_search_query(); ?>" />
			<?php submit_button( $text, '', '', false, array( 'id' => 'search-submit' ) ); ?>
		</p>
		<?php
	}

	public function display_tablenav( $which ) {
		if ( 'top' === $which ) {
			wp_nonce_field($this->get_nonce_action('list'));
		}
		?>
		<div class="tablenav <?php echo esc_attr( $which ); ?>">
			<?php $this->extra_tablenav( $which ); ?>

			<?php if (!empty($this->_args['bulk_actions']) && $this->has_items() ){ ?>
			<div class="alignleft actions bulkactions">
				<?php $this->bulk_actions( $which ); ?>
			</div>
			<?php } ?>

			<?php $this->pagination( $which ); ?>

			<br class="clear" />
		</div>
	<?php
	}

	public function print_column_headers( $with_id = true ) {
		list( $columns, $hidden, $sortable, $primary ) = $this->get_column_info();

		$current_url = set_url_scheme( 'http://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'] );
		$current_url = remove_query_arg( 'paged', $current_url );

		if ( isset( $_REQUEST['orderby'] ) ) {
			$current_orderby = $_REQUEST['orderby'];
		} else {
			$current_orderby = '';
		}

		if ( isset( $_REQUEST['order'] ) && 'desc' === $_REQUEST['order'] ) {
			$current_order = 'desc';
		} else {
			$current_order = 'asc';
		}

		if ( ! empty( $columns['cb'] ) ) {
			static $cb_counter = 1;
			$columns['cb'] = '<label class="screen-reader-text" for="cb-select-all-' . $cb_counter . '">' . __( 'Select All' ) . '</label>'
				. '<input id="cb-select-all-' . $cb_counter . '" type="checkbox" />';
			$cb_counter++;
		}

		foreach ( $columns as $column_key => $column_display_name ) {
			$class = array( 'manage-column', "column-$column_key" );

			if ( in_array( $column_key, $hidden ) ) {
				$class[] = 'hidden';
			}

			if ( 'cb' === $column_key )
				$class[] = 'check-column';

			if ( $column_key === $primary ) {
				$class[] = 'column-primary';
			}

			$data_attr	= '';

			if ( isset( $sortable[$column_key] ) ) {
				list( $orderby, $desc_first ) = $sortable[$column_key];

				if ( $current_orderby === $orderby ) {
					$order = 'asc' === $current_order ? 'desc' : 'asc';
					$class[] = 'sorted';
					$class[] = $current_order;
				} else {
					$order = $desc_first ? 'desc' : 'asc';
					$class[] = 'sortable';
					$class[] = $desc_first ? 'asc' : 'desc';
				}

				$class[] = 'list-table-sort';

				if($this->_args['ajax']){
					$column_display_name = '<a href="javascript:;"><span>' . $column_display_name . '</span><span class="sorting-indicator"></span></a>';
				}else{
					$column_display_name = '<a href="' . esc_url( add_query_arg( compact( 'orderby', 'order' ), $current_url ) ) . '"><span>' . $column_display_name . '</span><span class="sorting-indicator"></span></a>';
				}

				$data_attr	= 'data-orderby="'.$orderby.'" data-order="'.$order.'"'; 
			}

			$tag = ( 'cb' === $column_key ) ? 'td' : 'th';
			$scope = ( 'th' === $tag ) ? 'scope="col"' : '';
			$id = $with_id ? "id='$column_key'" : '';

			if ( !empty( $class ) )
				$class = "class='" . join( ' ', $class ) . "'";

			echo "<$tag $scope $id $class $data_attr>$column_display_name</$tag>";
		}
	}

	public function list_table() {
		$this->views();
		parent::display();
	}

	public function extra_tablenav( $which='top' ) {
		do_action($this->get_postfix(true).'_extra_tablenav', $which);
	}

	public function list_page(){
		global $current_tab;

		$model 		= $this->_args['model'];	
		$actions	= $this->_args['actions'];
	
		if(!$this->_args['ajax'] && $model ){
			$primary_key	= $this->_args['primary_key'];
			$redirect_to	= wpjam_get_referer();
			$action_key 	= $this->current_action();

			if(isset($actions[$action_key])){

				$capability = $this->get_action_capability($action_key);
				if(!current_user_can($capability)){
					ob_clean();
					wp_die('无权限');
				}

				if(isset($_GET[$primary_key])){
					check_admin_referer($action_key.'-'.$this->_args['singular'].'-'.$_GET[$primary_key]);

					$result = $model::$action_key($_GET[$primary_key]);

					$action_result = ($action_key == 'delete')?'deleted':'updated';

					if(is_wp_error($result)){
						$redirect_to = add_query_arg( array( $action_result => urlencode($result->get_error_message()) ), $redirect_to );
					}else{
						$redirect_to = add_query_arg( array( $action_result => 1 ), $redirect_to );	
					}

					wp_redirect($redirect_to);
					
				}elseif(!isset($_POST[$primary_key.'s'])) {

					check_admin_referer($action_key.'-'.$this->_args['singular']);

					$result = $model::$action_key();

					if(is_wp_error($result)){
						$redirect_to = add_query_arg( array( 'updated' => urlencode($result->get_error_message()) ), $redirect_to );
					}else{
						$redirect_to = add_query_arg( array( 'updated' => 1 ), $redirect_to );	
					}

					wp_redirect($redirect_to);
				}
			}
		}

		$page_title = '';
		if(isset($actions['add']) ) {
			$page_title	= ' '.$this->get_row_action('add', ['class'=>'page-title-action']);
		}

		$subtitle	= apply_filters($this->get_postfix(true).'_subtitle', '');
		$subtitle 	.= (!empty($_REQUEST['s']))?' “'.$_REQUEST['s'].'”的搜索结果':'';
		$subtitle 	= '<span class="subtitle">'.$subtitle.'</span>';

		if(empty($current_tab)){
			echo '<h1>'.$this->_args['title'].$page_title.$subtitle .'</h1>';
		}else{
			echo '<h2>'.$this->_args['title'].$page_title.$subtitle .'</h2>';
		}

		if($this->_args['ajax']){
			echo '<div class="list-table-notice notice inline is-dismissible" style="display:none;"></div>';
		}

		if(isset($this->_args['summary'])){
			echo wpautop($this->_args['summary']);
		}

		if($model && method_exists($model, 'pre_list_page')){
			$model::pre_list_page();
		}

		if($this->get_pagenum() < 2 && $actions = $this->_args['actions']){
			$overall_actions = '';
			foreach ($actions as $action_key => $action) {
				if($action_key == 'add') continue;

				if(empty($action['overall'])) continue;
					
				$overall_actions	.= $this->get_row_action($action_key, ['class'=>'button-primary large']).'&nbsp;&nbsp;&nbsp';
			}

			if($overall_actions){
				echo '<p class="submit">'.$overall_actions.'</p>';
			}
		}

		if($model){
			extract($model::list($this->get_per_page(), $this->get_offset()));
		}

		if(is_wp_error($items)){
			wpjam_admin_add_error($items->get_error_code().' '.$items->get_error_message(), 'error');
		}else{
			$this->prepare_items($items, $total);
			$this->display();
		}

		if($model && method_exists($model, 'list_page')){
			$model::list_page();
		}else{
			do_action($this->get_postfix().'_list_page');
		}
		
		if(!$this->_args['ajax']){ ?>

		<script type="text/javascript">
		jQuery(function($){
			window.tb_reload	= '';
			var old_tb_remove	= window.tb_remove;

			window.tb_remove	= function() {
				old_tb_remove();
				if (window.tb_reload) {
					window.location.reload();
				}
			};
		});
		</script>
		
		<?php }
	}

	public function action_page(){
		define( 'IFRAME_REQUEST', true );

		global $current_admin_url;

		$model			= $this->_args['model'];

		$primary_key	= $this->_args['primary_key'];
		$actions		= $this->_args['actions'];
		$id				= isset($_GET[$primary_key])?$_GET[$primary_key]:false;

		$action_key 	= $this->current_action();

		$action_text	= $actions[$action_key]['title'];
		$submit_text	= $actions[$action_key]['submit_text']??$action_text;
		$page_title		= $actions[$action_key]['page_title']??($action_text.$this->_args['title']);


		iframe_header($page_title);

		if($action_key == 'duplicate'){
			$action_key = 'add';
		}

		$fields			= $this->get_fields($action_key, $id);

		$nonce_action	= $this->get_nonce_action($action_key, $id);

		$form_url		= $current_admin_url.'&action='.$action_key;

		if($id){
			$form_url	.= '&'.$primary_key.'='.$id;
		}

		$capability 	= $this->get_action_capability($action_key);

		if( $_SERVER['REQUEST_METHOD'] == 'POST' ){

			check_admin_referer($nonce_action);

			if(!current_user_can($capability)){
				ob_clean();
				wp_die('无权限');
			}

			if($model){

				$data	= wpjam_validate_fields_value($fields);

				if($action_key == 'add'){
					$result = $model::insert($data);
				}elseif($action_key == 'edit'){
					$result = $model::update($id, $data);
				}else{
					$result = $model::$action_key($id, $data);
				}

				if(is_wp_error($result)){
					wpjam_admin_add_error($action_text.'失败：'.$result->get_error_message(),'error');
				}else{
					wpjam_admin_add_error($action_text.'成功');
				}
			}
		}

		?>

		<div id="wpbody-content" tabindex="0" style="overflow: auto; -webkit-overflow-scrolling: touch; height:100%;">

		<div class="action-wrap wrap" style="overflow: auto; -webkit-overflow-scrolling: touch; height:100%; padding:0px 15px 0 25px; margin:0;">

		<?php $data = ($id !== false && $model)?$model::get($id):$_GET; ?>

		<?php wpjam_display_errors();?>
		<form method="post" action="<?php echo $form_url; ?>" enctype="multipart/form-data" id="form">
			<?php wpjam_fields($fields, compact('data')); ?>
			<?php wp_nonce_field($nonce_action);?>
			<?php wp_original_referer_field(true, 'previous');?>
			<?php if($submit_text!==false){ submit_button($submit_text); } ?>
		</form>

		<?php 
		do_action($this->get_postfix().'_action_page', $fields, $id, $action_key);
		do_action($this->get_postfix().'_'.$action_key.'_page', $fields, $id);
		?>

		</div>

		</div>

		<script type="text/javascript">
		jQuery(function($){
				var H	= $('.action-wrap')[0].scrollHeight;
				var H	= (H > 600)?600:H;

				tbWindow		= $('#TB_window', window.parent.document);
				tbIframeContent	= $('#TB_iframeContent', window.parent.document);

				if( tbIframeContent.length ){
					window.parent.TB_HEIGHT	= H;	// 第一次需要 post message

					tbIframeContent.height(H);

					tbWindow.css({'margin-top': '-' + parseInt( ( H / 2 ), 10 ) + 'px'});
				}
				
				<?php if($_POST){ ?>parent.window.tb_reload = 1;<?php } ?>

		});
		</script>

		<?php iframe_footer();
	}

	public function ajax_response(){

		$list_action_type	= $_POST['list_action_type'];
		
		$model				= $this->_args['model'];

		if($list_action_type != 'list'){
			$list_action		= $_POST['list_action'];
			$action				= $this->get_action($list_action);
			if(!$action) {
				wpjam_send_json([
					'errcode'	=> 'invalid_action',
					'errmsg'	=> '非法操作'
				]);
			}

			$update		= $action['update'] ?? true;

			if(!empty($action['overall'])){
				$response_type	= 'list';
			}else{
				$response_type	= $action['response']??$list_action;
			}

			$bulk		= $_POST['bulk']??false;
			$nonce		= $_POST['_ajax_nonce'];

			if($bulk){
				$bulk_action	= 'bulk_'.$list_action;

				$ids	= $_POST['ids']? wp_parse_args($_POST['ids']) : [];

				if(!$this->verify_nonce($nonce, $bulk_action)){
					wpjam_send_json([
						'errcode'	=> 'invalid_nonce',
						'errmsg'	=> '非法操作'
					]);
				}
			}else{
				$id		= $_POST['id']??'';

				if(!$this->verify_nonce($nonce, $list_action, $id)){
					wpjam_send_json([
						'errcode'	=> 'invalid_nonce',
						'errmsg'	=> '非法操作'
					]);
				}
			}

			$capability = $this->get_action_capability($list_action);
			if(!current_user_can($capability)){
				wpjam_send_json([
					'errcode'	=>'no_authority', 
					'errmsg'	=>'无权限'
				]);
			}
		}else{
			$nonce		= $_POST['_ajax_nonce'];
			if(!$this->verify_nonce($nonce, 'list')){
				wpjam_send_json([
					'errcode'	=> 'invalid_nonce',
					'errmsg'	=> '非法操作'
				]);
			}
		}

		if($list_action_type == 'list'){
			if($_POST['data']){
				foreach (wp_parse_args($_POST['data']) as $key => $value) {
					$_REQUEST[$key]	= $value;
				}
			}

			extract($model::list($this->get_per_page(),$this->get_offset()));

			if(is_wp_error($items)){
				wpjam_send_json($items);
			}else{
				ob_start();
				
				$this->prepare_items($items, $total);
				$this->list_table();

				$data	= ob_get_clean();
			}

			wpjam_send_json(['errcode'=>0, 'data'=>$data, 'type'=>'list']);
		}elseif($list_action_type == 'direct'){
			if($bulk){
				if(method_exists($model, $bulk_action)){
					$result	= $model::$bulk_action($ids);
				}else{
					foreach($ids as $id) {
						$result	= $model::$list_action($id);
					}
				}
			}else{
				if($id){
					$result	= $model::$list_action($id);
					if($list_action == 'duplicate'){
						$id = $result;
					}
				}else{
					$result	= $model::$list_action();
				}
			} 
		}else{
			if($list_action_type == 'submit'){
				if($bulk){
					$fields	= $this->get_fields($list_action, $ids);

					$data	= $_POST['data']? wp_parse_args($_POST['data']) : [];
					$data	= wpjam_validate_fields_value($fields, $data);

					if(method_exists($model,$bulk_action)){
						$result	= $model::$bulk_action($ids, $data);
					}else{
						foreach($ids as $id) {
							$result	= $model::$list_action($id, $data);
						}
					}
				}else{
					$fields	= $this->get_fields($list_action, $id);

					$data	= $_POST['data']? wp_parse_args($_POST['data']) : [];
					$data	= wpjam_validate_fields_value($fields, $data);

					if($list_action == 'add' || $list_action == 'duplicate'){
						$result	= $model::insert($data);
					}elseif($list_action == 'edit'){
						$result	= $model::update($id, $data);
					}else{
						$result	= $model::$list_action($id, $data);
					}
				}
			}

			$submit_text	= $action['submit_text']??$action['title'];

			if($bulk){
				$fields	= $this->get_fields($list_action, $ids);

				$data	= isset($_POST['data'])? wp_parse_args($_POST['data']) : [];
			}else{
				$fields		= $this->get_fields($list_action, $id);

				$defaults	= isset($_POST['data']) ? wp_parse_args($_POST['data']) : [];
				$data		= $id ? ($model::get($id)) : [];

				if ($defaults) {
					$data	= wp_parse_args($data, $defaults);
				}
			}	

			ob_start();
			?>
			<div class="list-table-action-notice notice inline is-dismissible" style="display:none; margin:5px 0px 2px;"></div>

			<?php 

			if($bulk){
				$data_attr	= $this->get_action_data_attr($list_action, ['type'=>'submit','bulk'=>true, 'ids'=>$ids]);
			}else{
				$data_attr	= $this->get_action_data_attr($list_action, ['type'=>'submit','id'=>$id]);
			}

			echo '<form method="post" id="list_table_action_form" action="#" '.$data_attr.'>';

			wpjam_fields($fields, compact('data')); 

			if($submit_text){
				echo '<p class="submit"><input type="submit" name="list-table-submit" id="list-table-submit" class="button-primary large"  value="'.$submit_text.'"> <span class="spinner" style="float: none; height: 28px;"></span></p>';
			}

			echo "</form>";
			?>

			<?php if($response_type == 'append'){ ?><div class="card response" style="display:none;"></div><?php } ?>

			<?php 

			$model = $this->_args['model'];

			if($model && method_exists($model, 'action_form')){
				$model::action_form($list_action, compact('id', 'data', 'bulk', 'ids'));
			}else{
				if($bulk){
					do_action($this->get_postfix().'_'.$list_action.'_ajax_form',[], $ids);
					do_action($this->get_postfix().'_action_ajax_form', [], $ids, $list_action);
				}else{
					do_action($this->get_postfix().'_'.$list_action.'_ajax_form', $data, $id);
					do_action($this->get_postfix().'_action_ajax_form', $data, $id, $list_action);
				}
			}

			wpjam_form_field_tmpls();

			$form	= ob_get_clean();

			if($list_action_type == 'form'){
				wpjam_send_json(['errcode'=>0, 'form'=>$form, 'type'=>$response_type]);
			}
		}

		if(is_wp_error($result)){
			wpjam_send_json($result);
		}else{
			if($response_type == 'append'){
				wpjam_send_json(['errcode'=>0, 'data'=>$result,	'type'=>$response_type]);
			}elseif($response_type == 'list'){
				extract($model::list($this->get_per_page(),$this->get_offset()));

				if(is_wp_error($items)){
					wpjam_send_json($items);
				}else{
					ob_start();
					
					$this->prepare_items($items, $total);
					$this->list_table();

					$data	= ob_get_clean();
				}
			}elseif($response_type == 'delete'){
				$data ='';
			}elseif($response_type == 'add' || $response_type == 'duplicate'){
				$id = $result;

				ob_start();
				$this->single_row($id);
				$data	= ob_get_clean();
			}else{
				if($bulk){
					$items	= $model::get_by_ids($ids);
					$data	= [];
					if($update){
						foreach ($items as $id => $item) {
							ob_start();
							$this->single_row($item);
							$data[$id]	= ob_get_clean();
						}
					}
				}else{
					$data	= '';
					if($update){
						ob_start();
						$this->single_row($id);
						$data	= ob_get_clean();
					}
				}
			}
			
			if($list_action_type == 'submit'){
				wpjam_send_json(['errcode'=>0, 'data'=>$data, 'type'=>$response_type, 'form'=>$form]);
			}else{
				wpjam_send_json(['errcode'=>0, 'data'=>$data, 'type'=>$response_type]);
			}
		}
	}

	public function _js_vars() {}
}