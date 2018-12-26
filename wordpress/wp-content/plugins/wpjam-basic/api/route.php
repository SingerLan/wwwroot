<?php
global $wpjam_json;

$wpjam_json	= $json = str_replace('mag.', '', $action);

do_action('wpjam_api_template_redirect', $json);

$api_settings	= get_option('wpjam_apis') ?: [];
$api_setting	= $api_settings[$json] ?? [];
if(!$api_setting){
	wpjam_send_json([
		'errcode'	=> 'api_not_defined',
		'errmsg'	=> '接口未定义！',
	]);
}

$response		= ['errcode'=>0];
$current_user	= apply_filters('wpjam_current_user', null);

if($api_setting['auth']){
	if(is_wp_error($current_user)){
		wpjam_send_json($current_user);
	}else{
		$response['current_user']	= $current_user;
	}
}else{
	$response['current_user']	= is_wp_error($current_user)?null:$current_user;
}

foreach ($api_setting['modules'] as $module){
	if(!$module['type'] || !$module['args']){
		continue;
	}

	$args		= is_array($module['args']) ? $module['args'] : wpjam_parse_shortcode_attr(stripslashes_deep($module['args']), 'module');

	$type		= $module['type'];
	$action		= $args['action']??'';

	$output		= $args['output']??'';
	$template	= '';

	if($type == 'post_type'){
		if(empty($action)){
			wpjam_send_json([
				'errcode'	=> 'empty_action',
				'errmsg'	=> '没有设置 action',
			]);
		}

		$action	= str_replace(
			['unreply', 'unapply', 'like.delete', 'fav.delete'], 
			['reply.delete', 'apply.delete', 'unlike', 'unfav'], 
			$action
		);

		$post_type	= $args['post_type']??($_GET['post_type']??null);

		if($action == 'list'){
			$template	= WPJAM_BASIC_PLUGIN_DIR.'api/post.list.php';
		}elseif($action == 'get'){
			$template	= WPJAM_BASIC_PLUGIN_DIR.'api/post.get.php';
		}
	}elseif($type == 'taxonomy_post_type'){
		$template	= WPJAM_BASIC_PLUGIN_DIR.'api/taxonomy.post.list.php';
	}elseif($type == 'taxonomy'){
		$template	= WPJAM_BASIC_PLUGIN_DIR.'api/taxonomy.list.php';
	}elseif($type == 'setting'){
		$template	= WPJAM_BASIC_PLUGIN_DIR.'api/setting.php';
	}elseif($type == 'other'){
		$template	= WPJAM_BASIC_PLUGIN_DIR.'api/other.php';
	}

	$template	= apply_filters('wpjam_api_template_include', $template, $type, $action);

	if($template && is_file($template)){
		global $wpjam_pre_query_vars;	// 两个 post 模块的时候干扰。。。。

		if(empty($wpjam_pre_query_vars)){
			$wpjam_pre_query_vars	= $wp->query_vars; 
		}else{
			$wp->query_vars	= $wpjam_pre_query_vars;
		}

		$wp->set_query_var('template_type',	$type);

		include($template);
	}
}

$response	= apply_filters('wpjam_json', $response, $api_setting, $json);

wpjam_send_json($response);

