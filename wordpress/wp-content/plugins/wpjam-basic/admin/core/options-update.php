<?php
// 为了实现多个页面使用通过 option 存储。
// 注册设置选项，选用的是：'admin_action_' . $_REQUEST['action'] 的filter，
// 因为在这之前的 admin_init 检测 $plugin_page 的合法性



add_action('admin_action_update', function(){
	global $plugin_page, $current_tab, $current_option, $current_page_file;

	$current_option	= $_POST['option_page']??'';
	$current_page_file	= $_POST['current_page_file']??'';
	if($current_page_file){
		include(WP_CONTENT_DIR.$current_page_file);	
	}

	if(empty($current_option)) return;

	$referer_origin	= parse_url(wpjam_get_referer());

	if(empty($referer_origin['query']))	return;

	$referer_args	= wp_parse_args($referer_origin['query']);

	$plugin_page	= $referer_args['page']??'';	// 为了实现多个页面使用通过 option 存储。
	$current_tab	= $_POST['current_tab']??'';

	wpjam_register_settings();		
});

function wpjam_register_settings(){
	global $plugin_page, $current_tab, $current_option, $current_page_file;

	$wpjam_setting = wpjam_get_option_setting($current_option);

	if(!$wpjam_setting) return;

	extract($wpjam_setting);

	// 只需注册字段，add_settings_section 和 add_settings_field 可以在具体设置页面添加
	if($option_type == 'array'){

		if(!empty($capability)){
			add_filter('option_page_capability_'.$current_option, function($cap) use ($capability){	return $capability; });	
		}

		add_filter('sanitize_option_'.$current_option, function($value, $option_name) use ($wpjam_setting){
			$current_tab	= ($value['current_tab'])??'';

			$fields	= array_merge(...array_column($wpjam_setting['sections'], 'fields'));
			$value	= wpjam_validate_fields_value($fields, $value);
			$value	= wp_parse_args($value, wpjam_get_option($option_name));

			if($field_validate	= ($wpjam_setting['field_validate'])??''){
				$value	= call_user_func($field_validate, $value);
			}

			$value['current_tab']	= $current_tab;

			return $value;
		}, 10, 2);

		register_setting($option_group, $current_option);	
	}else{
		if(!$sections) return;

		foreach ($sections as $section_id => $section) {
			foreach ($section['fields'] as $key => $field) {
				if($field['type'] == 'fieldset'){
					$fieldset_type	= ($field['fieldset_type'])??'single';
					if($fieldset_type == 'array'){
						$field_validate = function($value) use ($field){
							return wpjam_validate_field_value($field, $value);
						};

						if(!empty($field['$capability'])){
							$capability	= $field['capability'];
							add_filter('option_page_capability_'.$key, function($cap) use ($capability){
								return $capability;
							});	
						}

						register_setting($option_group, $key, $field_validate);
					}else{
						foreach ($field['fields'] as $sub_key => $sub_field) {
							$field_validate = function($value) use ($sub_field){
								return wpjam_validate_field_value($sub_field, $value);
							};

							if(!empty($sub_field['$capability'])){
								$capability	= $sub_field['capability'];
								add_filter('option_page_capability_'.$sub_key, function($cap) use ($capability){
									return $capability;
								});	
							}

							register_setting($option_group, $sub_key, $field_validate);
						}
					}
				}else{
					$field_validate = function($value) use ($field){
						return wpjam_validate_field_value($field, $value);
					};

					if(!empty($field['$capability'])){
						$capability	= $field['capability'];
						add_filter('option_page_capability_'.$key, function($cap) use ($capability){
							return $capability;
						});	
					}

					register_setting($option_group, $key, $field_validate);
				}
			}
		}
		
	}
}

function wpjam_option_ajax_response(){
	global $plugin_page, $current_tab, $current_option, $current_page_file;

	$plugin_page		= $_POST['plugin_page'];
	$current_tab		= $_POST['current_tab']??'';
	$current_option		= $_POST['current_option']??'';
	$current_page_file	= $_POST['current_page_file']??'';
	if($current_page_file){
		include(WP_CONTENT_DIR.$current_page_file);	
	}

	$_POST	= wp_parse_args($_POST['data']);

	wpjam_register_settings();

	$whitelist_options = apply_filters('whitelist_options', []);

	$option_page	= $_POST['option_page'];

	if(!wp_verify_nonce($_POST['_wpnonce'], $option_page . '-options')){
		wpjam_send_json([
			'errcode'	=> 'invalid_nonce',
			'errmsg'	=> '非法操作'
		]);
	}

	$capability = apply_filters('option_page_capability_'.$option_page, 'manage_options');

	if(!current_user_can($capability)){
		wpjam_send_json([
			'errcode'	=> 'no_authority',
			'errmsg'	=> '无权限'
		]);
	}

	$options	= $whitelist_options[$option_page];

	if(empty($options)){
		wpjam_send_json([
			'errcode'	=> 'invalid_option',
			'errmsg'	=> '字段未注册'
		]);
	}
		
	foreach ( $options as $option ) {
		$option = trim( $option );
		$value = null;
		if ( isset( $_POST[ $option ] ) ) {
			$value = $_POST[ $option ];
			if ( ! is_array( $value ) ) {
				$value = trim( $value );
			}
			$value = wp_unslash( $value );
		}
		update_option( $option, $value );
	}

	wpjam_send_json(['errcode'=>0, 'data'=>get_option($option)]);
}