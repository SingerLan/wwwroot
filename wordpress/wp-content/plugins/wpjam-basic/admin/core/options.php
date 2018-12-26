<?php
// 后台选项页面
function wpjam_option_page($option_name, $args=array()){
	if(!$option_name) return;

	global $current_tab;

	$wpjam_setting = wpjam_get_option_setting($option_name);
	if(!$wpjam_setting)	{
		wp_die($option_name.' 的 wpjam_settings 未设置', '未设置');
	}
	
	extract($wpjam_setting);

	if(!$sections) return;

	do_action(str_replace('-', '_', $option_page).'_option_page');

	if(is_multisite() && is_network_admin()){	
		if($_SERVER['REQUEST_METHOD'] == 'POST'){	// 如果是 network 就自己保存到数据库	
			$fields	= array_merge(...array_column($sections, 'fields'));
			$value	= wpjam_validate_fields_value($fields, $_POST[$option_name]);
			$value	= wp_parse_args($value, wpjam_get_option($option_name));

			update_site_option( $option_name,  $value);
			wpjam_admin_add_error('设置已保存。');
		}
		wpjam_display_errors();
		echo '<form action="'.add_query_arg(array('settings-updated'=>'true'), wpjam_get_current_page_url()).'" method="POST">';
	}else{
		echo '<form action="options.php" method="POST" id="wpjam_option">';
	}

	settings_fields($option_group);

	global $current_page_file;
	if($current_page_file){
		echo '<input type="hidden" name="current_page_file" value="'.str_replace(WP_CONTENT_DIR, '', $current_page_file).'" />';
	}

	if($current_tab){
		echo '<input type="hidden" name="current_tab" value="'.$current_tab.'" />';
	}

	if($option_type == 'array'){
		$wpjam_option	= wpjam_get_option($option_name);
		
		if(!empty($_GET['settings-updated']) && !empty($wpjam_option['current_tab']) && isset($sections[$wpjam_option['current_tab']])){
			// echo '<input type="hidden" name="'.$option_name.'[current_tab]" id="current_tab" value="'.$wpjam_option['current_tab'].'" />';
		}else{
			// echo '<input type="hidden" name="'.$option_name.'[current_tab]" id="current_tab" value="" />';
		}
	}

	// 拷贝自 do_settings_sections 和 do_settings_fields 函数

	$page_type	= (count($sections) > 1)?'tab':'';

	if($page_type == 'tab'){

		echo '<h1 class="nav-tab-wrapper">';
		foreach ( $sections as $section_id => $section ) {
			echo '<a class="nav-tab" href="javascript:;" id="tab_title_'.$section_id.'">'.$section['title'].'</a>';
		}
		echo '</h1>';
	}else{
		// 如 $page_title 里面有 <h1> <h2> 标签，就不再加入 <h2> <h3> 标签了。
		if(!empty($args['page_title'])){
			if(preg_match("/<[^<]+>/",$args['page_title']) ){ 
				echo $args['page_title'];
			}else{
				if(empty($current_tab)){
					echo '<h1>'.$args['page_title'].'</h1>';
				}else{
					echo '<h2>'.$args['page_title'].'</h2>';
				}
			}
		}
	}

	foreach ( $sections as $section_id => $section ) {
		$section_class	= ($page_type == 'tab')?' class="div-tab hidden"':'';

		echo '<div id="tab_'.$section_id.'"'.$section_class.'>';

		if(!empty($section['title'])){
			if(empty($current_tab)){
				echo "<h2>{$section['title']}</h2>\n";
			}else{
				echo "<h3>{$section['title']}</h3>\n";
			}
		}

		settings_errors();

		echo '<div class="option-notice notice inline" style="display:none;"></div>';

		if(!empty($section['callback'])) call_user_func($section['callback'], $section);

		if(!empty($section['summary'])) echo wpautop($section['summary']);
		
		if(!$section['fields']) continue;

		if($option_type == 'array'){
			wpjam_fields($section['fields'], array(
				'fields_type'	=> 'table',
				'data_type'		=> 'option',
				'field_name'	=> $option_name,
				'field_callback'=> $wpjam_setting['field_callback']??''
			));
		}else{
			wpjam_fields($section['fields'], array(
				'fields_type'	=> 'table',
				'data_type'		=> 'option',
				'option_type'	=> 'single'
			));
		}
		
		echo '</div>';
	}
	
	echo '<p class="submit">';

	submit_button('', 'primary', 'submit', false);

	echo '<span class="spinner"  style="float: none; height: 28px;"></span>';

	echo '</p>';

	echo '</form>'; 
}

