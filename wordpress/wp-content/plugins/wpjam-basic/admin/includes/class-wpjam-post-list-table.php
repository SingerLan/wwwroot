<?php 
class WPJAM_Post_List_Table{
	private $_args;

	public function __construct($args = []){
		$args	= wp_parse_args($args, [
			'model'			=> '',
			'capability'	=> 'manage_options'	
		]);

		$model		= $args['model'];
		$actions	= $model::get_actions();

		$bulk_actions	= [];
		if($actions){
			foreach ($actions as $action_key => $action) {
				if(empty($action['bulk'])) continue;

				$capability	= $action['capability']??$args['capability'];

				if(current_user_can($capability)){
					$bulk_actions[$action_key]	= $action['title'];
				}
			}
		}

		$args['actions']		= $actions;
		$args['bulk_actions']	= $bulk_actions;
		
		$this->_args	= $args;

		add_filter('post_row_actions', [$this,'row_actions'],1,2);

		if(wp_doing_ajax()){
			add_action('wp_ajax_post-list-table-action', [$this, 'ajax_response']);
		}else{
			add_action('admin_head', [$this,'admin_head']);
			global $current_screen;

			add_filter('bulk_actions-'.$current_screen->id, [$this,'bulk_actions']);
		}
	}

	public function get_model(){
		return $this->_args['model'];
	}

	public function get_actions(){
		$model	= $this->get_model();

		return $model::get_actions();
	}

	public function get_action($key){
		$actions	= $this->get_actions();
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

	public function ajax_response(){
		$model	= $this->get_model();

		$list_action_type	= $_POST['list_action_type'];
		$list_action		= $_POST['list_action'];
		
		$capability = $this->get_action_capability($list_action);
		if(!current_user_can($capability)){
			wpjam_send_json([
				'errcode'	=>'no_authority', 
				'errmsg'	=>'无权限'
			]);
		}

		$nonce	= $_POST['_ajax_nonce'];
		$bulk	= $_POST['bulk']??false;
		$ids	= [];
		$id		= 0;

		if($bulk){
			$bulk_action	= 'bulk_'.$list_action;
			$ids			= $_POST['ids']? wp_parse_args($_POST['ids']) : [];

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
		
		$actions	= $this->get_actions();

		$action		= $actions[$list_action]??[];
		if(!$action) {
			wpjam_send_json([
				'errcode'	=> 'invalid_action',
				'errmsg'	=> '非法操作'
			]);
		}

		$response_type	= $action['response']??$list_action;

		if($list_action_type == 'direct'){
			if($bulk){
				if(method_exists($model, $bulk_action)){
					$result	= $model::$bulk_action($ids);
				}else{
					foreach($ids as $id) {
						$result	= $model::$list_action($id);
					}
				}
			}else{
				$result	= $model::$list_action($id);
			}	
		}else{
			$data	= isset($_POST['data'])?wp_parse_args($_POST['data']):[];

			ob_start();

			$submit_text	= $action['submit_text']??$action['title'];
			$page_title		= $action['page_title']??$action['title'];

			if($bulk){
				$fields	= $model::get_fields($list_action, $ids);
				$nonce	= $this->create_nonce($bulk_action, $id);
			}else{
				$fields	= $model::get_fields($list_action, $id);
				$nonce	= $this->create_nonce($list_action, $id);
			}

			WPJAM_AJAX::form([
				'fields'		=> $fields,
				'data'			=> $data,
				'bulk'			=> $bulk,
				'ids'			=> $ids,
				'id'			=> $id,
				'action'		=> $list_action,
				'submit_text'	=> $submit_text,
				'page_title'	=> $page_title,
				'nonce'			=> $nonce,
				'notice_class'	=> 'list-table-action-notice',
				'form_id'		=> 'post_list_table_action_form',
			]);
			
			$form	= ob_get_clean();

			if($list_action_type == 'form'){
				wpjam_send_json(['errcode'=>0, 'form'=>$form, 'type'=>$response_type]);
			}

			if($bulk){
				if(method_exists($model,$bulk_action)){
					$result	= $model::$bulk_action($ids, $data);
				}else{
					foreach($ids as $id) {
						$result	= $model::$list_action($id, $data);
						if(is_wp_error($result)){
							wpjam_send_json($result);
						}
					}
				}
			}else{
				$result	= $model::$list_action($id, $data);
			}	
		}

		if(is_wp_error($result)){
			wpjam_send_json($result);
		}

		if($response_type == 'append'){
			wpjam_send_json(['errcode'=>0, 'data'=>$result, 'type'=>$response_type]);
		}elseif($response_type == 'delete'){
			$data ='';
		}else{
			if($bulk){
				$wp_list_table = _get_list_table('WP_Posts_List_Table', ['screen' => $_POST['screen']]);
				$data	= [];
				foreach ($ids as $id) {
					ob_start();
					$wp_list_table->single_row(get_post($id));
					$data[$id]	= ob_get_clean();
				}
			}else{
				ob_start();
				$wp_list_table = _get_list_table('WP_Posts_List_Table', ['screen' => $_POST['screen']]);
				$wp_list_table->single_row(get_post($id));
				$data	= ob_get_clean();
			}
		}

		if($list_action_type == 'submit'){
			wpjam_send_json(['errcode'=>0, 'data'=>$data, 'type'=>$response_type, 'form'=>$form]);
		}else{
			wpjam_send_json(['errcode'=>0, 'data'=>$data, 'type'=>$response_type]);
		}
	}

	public function row_actions($row_actions, $post){
		$id			= $post->ID;

		$actions	= $this->get_actions();

		foreach ($actions as $action_key => $action){
			$page_title		= $action['page_title']??$action['title'];
			$direct			= $action['direct']??'';
			$confirm		= $action['confirm']??'';
			$class			= $action['class']??'';

			$class			= $class?' '.$class:'';
			$class			= 'post-list-table-action '.$class;

			$data_attr		= 'data-title="'.$page_title.'" data-action="'.$action_key.'"';

			// if($bulk){
				// $nonce	= $this->create_nonce('bulk_'.$action_key);
				// $ids	= $ids?http_build_query($ids):'';
			// }else{
				$nonce	= $this->create_nonce($action_key, $id);
			// }

			$data_values	= compact('nonce', 'id', 'direct', 'confirm');

			foreach ($data_values as $data_key=>$value) {
				if($value){
					$data_attr	.= ' data-'.$data_key.'="'.$value.'"';
				}
			}

			$row_actions[$action_key] = '<a href="javascript:;" title="'.$page_title.'" class="'.$class.'" '.$data_attr.'>'.$action['title'].'</a>';
		}

		return $row_actions;
	}

	public function bulk_actions($bulk_actions=[]){
		return array_merge($bulk_actions, $this->_args['bulk_actions']);
	}

	public function admin_head(){
		if($bulk_actions = $this->_args['bulk_actions']){	$actions = $this->_args['actions'];
		?>

		<script type="text/javascript">
		jQuery(function($){
			<?php foreach($bulk_actions as $action_key => $bulk_action) { 
				$bulk_action = $actions[$action_key];
				$page_title	= $bulk_action['page_title']??$bulk_action['title']; 
				$nonce		= $this->create_nonce('bulk_'.$action_key); 
				$direct		= $bulk_action['direct']??''; 
				$confirm	= $bulk_action['confirm']??''; 
			?>
				
			$('.bulkactions option[value=<?php echo $action_key;?>]').data('action', '<?php echo $action_key?>').data('title', '<?php echo $page_title; ?>').data('bulk',1).data('nonce','<?php echo $nonce; ?>').data('direct','<?php echo $direct; ?>').data('confirm','<?php echo $confirm; ?>');
			
			<?php } ?>
		});
		</script>

		<?php } 
	}

	public function create_nonce($key, $id=0){
		$nonce_action	= $this->get_nonce_action($key, $id);
		return wp_create_nonce($nonce_action);
	}

	public function verify_nonce($nonce, $key, $id=0){
		$nonce_action	= $this->get_nonce_action($key, $id);
		return wp_verify_nonce($nonce, $nonce_action);
	}

	public function get_nonce_action($key, $id=0){
		$nonce_action	= $key.'-post-list-action';

		return ($id)?$nonce_action.'-'.$id:$nonce_action;
	}
}