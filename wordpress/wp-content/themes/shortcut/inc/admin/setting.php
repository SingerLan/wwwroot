<?php
if( is_admin() ) {
    add_action('admin_menu', 'display_loobo_menu');
}
function display_loobo_menu() {
	$icon_url = get_template_directory_uri().'/images/t.svg';
    add_menu_page('主题设置', '主题设置', 'administrator','barley', 'loobo_setting_page', $icon_url ,29);
    add_submenu_page('barley', '主题设置 &gt; 设置', '主题设置', 'administrator','barley', 'loobo_setting_page');
}
function loobo_setting_page(){
	settings_errors();
	?>
	<div class="wrap">
		<header>
			<h2>主题设置</h2>
			<p>Shortcut主题，当前版本 <?php echo ZB_VERSION;?></p>
		</header>
		<h2 class="nav-tab-wrapper">
	        <a class="nav-tab nav-tab-active" href="javascript:;" id="tab-title-general"><span class="m-r-10 dashicons dashicons-dashboard"></span>基础功能</a>
	        <a class="nav-tab" href="javascript:;" id="tab-title-skin"><span class="m-r-10 dashicons dashicons-admin-appearance"></span>外观设置</a>
			<a class="nav-tab" href="javascript:;" id="tab-title-mail"><span class="m-r-10 dashicons dashicons-email-alt"></span>邮件</a>  
			<a class="nav-tab" href="javascript:;" id="tab-title-social"><span class="m-r-10 dashicons dashicons-share"></span>社交</a> 
			<a class="nav-tab" href="javascript:;" id="tab-title-other"><span class="m-r-10 dashicons dashicons-lightbulb"></span>功能设置</a> 
	    </h2>
		<form style="background-color:#fff;padding:20px;" action="options.php" method="POST">
			<?php settings_fields( 'barley_group' ); ?>
			<?php
				$labels = loobo_get_option_labels();
				extract($labels);
			?>
			<?php foreach ( $sections as $section_name => $section ) { ?>
	            <div id="tab-<?php echo $section_name; ?>" class="div-tab hidden">
	                <?php loobo_option_do_settings_section($option_page, $section_name); ?>
	            </div>                      
	        <?php } ?>
			<input type="hidden" name="<?php echo $option_name;?>[current_tab]" id="current_tab" value="" />
			<input type="submit" name="submit" id="submit" class="savebtn btn-w-md btn-success" value="保存更改">
		</form>
		<?php loobo_option_tab_script(); ?>
	</div>
<?php
}
function loobo_setting_active_page(){
	settings_errors();
	$order = loobo_get_setting('order');
	$sn = loobo_get_setting('sn');
	?>
	<div class="wrap">
		<form action="options.php" method="POST">
			<?php settings_fields( 'barley_group' ); ?>
			<?php
				settings_errors();
				$labels = loobo_get_option_labels();
				extract($labels);
			?>
			<?php foreach ( $sections as $section_name => $section ) { ?>
	            <div id="tab-<?php echo $section_name; ?>" class="div-tab <?php if($section_name!='auth') echo 'hidden'; ?>">
	                <?php loobo_option_do_settings_section($option_page, $section_name); ?>
	            </div>                      
	        <?php } ?>
			<input type="hidden" name="<?php echo $option_name;?>[current_tab]" id="current_tab" value="" />
			<input type="submit" name="submit" id="submit" class="btn btn-w-md btn-info" value="保存更改">
		</form>
	</div>

<?php	
}
function loobo_option_tab_script(){
	$current_tab = '';
	$option_name = 'barley';
	$option = get_option( $option_name );
	if(!empty($_GET['settings-updated'])){
		$current_tab = $option['current_tab'];
	}
	?>
	<script type="text/javascript">
		jQuery('div.div-tab').hide();
	<?php if($current_tab){ ?>
		jQuery('#tab-title-<?php echo $current_tab; ?>').addClass('nav-tab-active');
		jQuery('#tab-<?php echo $current_tab; ?>').show();
		jQuery('#current_tab').val('<?php echo $current_tab; ?>');
	<?php } else{ ?>
		jQuery('h2 a.nav-tab').first().addClass('nav-tab-active');
		jQuery('div.div-tab').first().show();
	<?php } ?>
		jQuery(function($){
			$('h2 a.nav-tab').on('click',function(){
		        $('h2 a.nav-tab').removeClass('nav-tab-active');
		        $(this).addClass('nav-tab-active');
		        $('div.div-tab').hide();
		        $('#'+jQuery(this)[0].id.replace('title-','')).show();
		        $('#current_tab').val($(this)[0].id.replace('tab-title-',''));
		    });
		});
	</script>
<?php
}
function loobo_option_field_callback($field) {
	$field_name		= $field['name'];
	$field['key']	= $field_name;
	$field['name']	= $field['option'].'['.$field_name.']';

	$options	= loobo_get_option( $field['option'] );
	$field['value'] = (isset($options[$field_name]))?$options[$field_name]:'';

	echo loobo_admin_get_field_html($field);
}
function loobo_admin_get_field_html($field){

	$key		= $field['key'];
	$name		= $field['name'];
	$type		= $field['type'];
	$value		= $field['value'];

	$class		= isset($field['class'])?$field['class']:'regular-text';
	$description= (!empty($field['description']))?( ($type == 'checkbox')? ' <label for="'.$key.'" class="description">'.$field['description'].'</label>':'<p class="description">'.$field['description'].'</p>'):'';

	$title 	= isset($field['title'])?$field['title']:$field['name'];
	$label 	= '<label for="'.$key.'">'.$title.'</label>';

	switch ($type) {
		case 'text':
		case 'password':
		case 'hidden':
		case 'url':
		case 'url':
		case 'tel':
		case 'email':
		case 'month':
		case 'date':
		case 'datetime':
		case 'datetime-local':
		case 'week':
			$field_html = '<input name="'.$name.'" id="'. $key.'" type="'.$type.'"  value="'.esc_attr($value).'" class="form-control" />';
			break;
		case 'range':
			$max	= isset($field['max'])?' max="'.$field['max'].'"':'';
			$min	= isset($field['min'])?' min="'.$field['min'].'"':'';
			$step	= isset($field['step'])?' step="'.$field['step'].'"':'';

			$field_html ='<input name="'.$name.'" id="'. $key.'" type="'.$type.'"  value="'.esc_attr($value).'"'.$max.$min.$step.' class="'.$class.'" onchange="jQuery(\'#'.$key.'_span\').html(jQuery(\'#'.$key.'\').val());"  /> <span id="'.$key.'_span">'.$value.'</span>';
			break;

		case 'nloobober':
			$max	= isset($field['max'])?' max="'.$field['max'].'"':'';
			$min	= isset($field['min'])?' min="'.$field['min'].'"':'';
			$step	= isset($field['step'])?' step="'.$field['step'].'"':'';

			$field_html = '<input name="'.$name.'" id="'. $key.'" type="'.$type.'"  value="'.esc_attr($value).'" class="'.$class.'"'.$max.$min.$step.' />';
			break;

		case 'checkbox':
			$field_html = '<input name="'.$name.'" id="'. $key.'" type="checkbox"  value="1" '.checked("1",$value,false).' >';
			break;

		case 'textarea':
			$rows = isset($field['rows'])?$field['rows']:6;
			$field_html = '<textarea name="'.$name.'" id="'. $key.'" rows="'.$rows.'" cols="50"  class="form-control" >'.esc_attr($value).'</textarea>';
			break;

		case 'select':
			$field_html  = '<select class="form-control" style="width: 20%;" name="'.$name.'" id="'. $key.'">';
			foreach ($field['options'] as $option_title => $option_value){ 
				$field_html .= '<option value="'.$option_value.'" '.selected($option_value,$value,false).'>'.$option_title.'</option>';
			}
			$field_html .= '</select>';
			
			break;

		case 'radio':
			$field_html  = '';
			foreach ($field['options'] as $option_value => $option_title) {
				$field_html  .= '<span style="padding-right:20px"><input name="'.$name.'" type="radio" id="'.$key.'" value="'.$option_value .'" '.checked($option_value,$value,false).' />'.$option_title.' </span>';
			}
			break;

		case 'image':
			$field_html = '<div class="input-group"><input type="text" class="form-control" value="'.esc_attr($value).'" name="'.$name.'" id="'.$key.'" type="url"><input type="button" class="loobo_upload btn btn-info" value="上传"></div>';
			$field_html .= '<img src="'.esc_attr($value).'" style="max-width:80px;vertical-align: top;margin:10px 0" />';
            break;
        case 'mulit_image':
        case 'multi_image':
        	$field_html  = '';
            if(is_array($value)){
                foreach($value as $image_key=>$image){
                    if(!empty($image)){
                    	$field_html .= '<span><input type="text" name="'.$name.'[]" id="'. $key.'" value="'.esc_attr($image).'"  class="'.$class.'" /><a href="javascript:;" class="button del_image">删除</a></span>';
                    }
                }
            }
            $field_html  = '<span><input type="text" name="'.$name.'[]" id="'.$key.'" value="" class="'.$class.'" /><input type="bu
            tton" class="loobo_mulit_upload button" style="width:110px;" value="选择图片[多选]" title="按住Ctrl点击鼠标左键可以选择多张图片"></span>';
            break;
        case 'mulit_text':
        case 'multi_text':
        	$field_html  = '';
            if(is_array($value)){
                foreach($value as $text_key=>$item){
                    if(!empty($item)){
                    	$field_html .= '<span><input type="text" name="'.$name.'[]" id="'. $key.'" value="'.esc_attr($item).'"  class="'.$class.'" /><a href="javascript:;" class="button del_image">删除</a></span>';
                    }
                }
            }
            $field_html  = '<span><input type="text" name="'.$name.'[]" id="'.$key.'" value="" class="'.$class.'" /><a class="loobo_mulit_text button">添加选项</a></span>';
            break;

        case 'file':
        	$field_html  = '<input type="file" name="'.$name.'" id="'. $key.'" />'.'已上传：'.wp_get_attachment_link($value);
            break;
		
		default:
			$field_html = '<input name="'.$name.'" id="'. $key.'" type="text"  value="'.esc_attr($value).'" class="'.$class.'" />';
			break;
	}

	return $field_html.$description;
}
function loobo_other_field_callback(){
	echo '';
}
function loobo_add_settings($labels){
	extract($labels);
	register_setting( $option_group, $option_name, $field_validate );

	$field_callback = empty($field_callback)?'loobo_option_field_callback' : $field_callback;
	if($sections){
		foreach ($sections as $section_name => $section) {
			add_settings_section( $section_name, $section['title'], $section['callback'], $option_page );

			$fields = isset($section['fields'])?$section['fields']:(isset($section['fields'])?$section['fields']:'');

			if($fields){
				foreach ($fields as $field_name=>$field) {
					$field['option']	= $option_name;
					$field['name']		= $field_name;

					$field_title		= $field['title'];

					$field_title = '<label for="'.$field_name.'">'.$field_title.'</label>';

					add_settings_field( 
						$field_name,
						$field_title,		
						$field_callback,	
						$option_page, 
						$section_name,	
						$field
					);	
				}
			}
		}
	}
}

function loobo_option_get_checkbox_settings($labels){
	$sections = $labels['sections'];
	$checkbox_options = array();
	foreach ($sections as $section) {
		$fields = $section['fields'];
		foreach ($fields as $field_name => $field) {
			if($field['type'] == 'checkbox'){
				$checkbox_options[] = $field_name;
			}
		}
	}
	return $checkbox_options;
}
function barley_validate( $barley ) {
	$current = get_option( 'barley' );

	foreach (array('nocategory','smtp_switch','smtp_ssl','comment_reply_mail','login_mail','login_error_mail','social_qq','social_weibo','social_weixin','social_xingqiu') as $key ) {
		if(empty($barley[$key])){ 
			$barley[$key] = 0;
		}
	}

	flush_rewrite_rules();

	return $barley;
}
function loobo_option_do_settings_section($option_page, $section_name){
	global $wp_settings_sections, $wp_settings_fields;

	if ( ! isset( $wp_settings_sections[$option_page] ) )
		return;

	$section = $wp_settings_sections[$option_page][$section_name];

	if ( $section['title'] )
		echo "<h3>{$section['title']}</h3>\n";

	if ( isset( $wp_settings_fields ) && isset( $wp_settings_fields[$option_page] ) && !empty($wp_settings_fields[$option_page][$section['id']] ) ){
		echo '<table class="form-table">';
		do_settings_fields( $option_page, $section['id'] );
		echo '</table>';
	}
}
function loobo_admin_init() {
	loobo_add_settings(loobo_get_option_labels());
}
add_action( 'admin_init', 'loobo_admin_init' );

function loobo_get_option($option_name){
	$options = get_option( $option_name );
	if($options && !is_admin()){
		return $options;
	}else{
		$defaults = loobo_option_defaults();
		return wp_parse_args($options, $defaults);
	}
}
function barley_get_setting($setting_name,$default=''){
	$option = get_option('barley');
	if(isset($option[$setting_name])){
		return str_replace("\r\n", "\n", $option[$setting_name]);
	}else{
		return $default;
	}
}