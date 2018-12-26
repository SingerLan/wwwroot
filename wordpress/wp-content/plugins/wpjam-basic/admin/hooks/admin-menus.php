<?php
// 设置菜单
add_filter('wpjam_pages', 'wpjam_basic_admin_pages');
add_filter('wpjam_network_pages', 'wpjam_basic_admin_pages');
function wpjam_basic_admin_pages($wpjam_pages){
	$capability	= (is_multisite())?'manage_site':'manage_options';
	$subs		= [];

	$verified	= WPJAM_Verify::verify();

	if(!$verified){
		$subs['wpjam-basic']	= [
			'menu_title'	=> '验证WPJAM',	
			'function'		=> 'wpjam_verify_page',
			'page_file'		=> WPJAM_BASIC_PLUGIN_DIR .'admin/pages/wpjam-verify.php',	
		];

		$subs['wpjam-about']	= [
			'menu_title'	=> '关于WPJAM',	
			'function'		=> 'wpjam_basic_about_page',	
			'page_file'		=> WPJAM_BASIC_PLUGIN_DIR.'admin/pages/wpjam-about.php'
		];

		$wpjam_pages['wpjam-basic']	= [
			'menu_title'	=> 'WPJAM',	
			'icon'			=> 'dashicons-performance',
			'position'		=> '58.99',
			'subs'			=> $subs
		];

		return $wpjam_pages;
	}

	$subs['wpjam-basic']	= [
		'menu_title'	=> '优化设置',	
		'function'		=> 'option',
		'page_file'		=> WPJAM_BASIC_PLUGIN_DIR.'admin/pages/wpjam-basic.php'
	];

	$subs['wpjam-custom']	= [
		'menu_title'	=> '样式定制', 
		'function'		=> 'option',
		'option_name'	=> 'wpjam-basic',
		'page_file'		=> WPJAM_BASIC_PLUGIN_DIR.'admin/pages/wpjam-custom.php'
	];

	$subs['wpjam-cdn']	= [
		'menu_title'	=> 'CDN加速', 
		'function'		=> 'option',
		'page_file'		=> WPJAM_BASIC_PLUGIN_DIR.'admin/pages/wpjam-cdn.php'
	];

	$subs['wpjam-thumbnail']	= [
		'menu_title'	=> '缩略图设置', 
		'function'		=> 'option',
		'option_name'	=> 'wpjam-cdn',
		'page_file'		=> WPJAM_BASIC_PLUGIN_DIR.'admin/pages/wpjam-thumbnail.php'
	];

	$subs = apply_filters('wpjam_basic_sub_pages', $subs);

	$subs['wpjam-crons']		= [
		'menu_title'	=> '定时作业',		
		'function'		=> 'list',
		'page_file'		=> WPJAM_BASIC_PLUGIN_DIR .'admin/pages/wpjam-crons.php'
	];

	if(is_multisite()){
		$subs['wpjam-blog-stats']		= [
			'menu_title'	=> '博客统计',	
			'capability'	=> 'manage_sites',	
			'page_file'		=> WPJAM_BASIC_PLUGIN_DIR .'admin/pages/wpjam-blog-stats.php'
		];
	}

	$server_status_tabs	= [];
	$server_status_tabs['server']	= ['title'=>'服务器',		'function'=>'dashboard'];

	if(function_exists('opcache_get_status')){
		$server_status_tabs['opcache']		= ['title'=>'Opcache',		'function'=>'dashboard'];
	}

	if(method_exists('WP_Object_Cache', 'get_mc')){
		$server_status_tabs['memcached']	= ['title'=>'Memcached',	'function'=>'dashboard'];
	}

	$subs['server-status']	= [
		'menu_title'	=> '系统信息',		
		'function'		=> 'tab',	
		'capability'	=> $capability,	
		'page_file'		=> WPJAM_BASIC_PLUGIN_DIR .'admin/pages/server-status.php',	
		'tabs'			=> $server_status_tabs,
	];

	// $subs['data-clear']		= array('menu_title'=>'数据清理');
	$subs['dashicons']		= [
		'menu_title'	=> 'Dashicons',
		'page_file'		=> WPJAM_BASIC_PLUGIN_DIR .'admin/pages/dashicons.php',	
	];

	// if(!is_network_admin()){
	// 	$subs['wpjam-grant']	= [
	// 		'menu_title'	=> '开发设置',
	// 		'page_file'		=> WPJAM_BASIC_PLUGIN_DIR.'admin/pages/wpjam-grant.php'
	// 	];
	// }
	
	$subs['wpjam-extends']	= [
		'menu_title'	=> '扩展管理',
		'function'		=> 'option',
		'page_file'		=> WPJAM_BASIC_PLUGIN_DIR.'admin/pages/wpjam-extends.php'
	];

	if($verified !== 'verified'){
		$subs['wpjam-about']	= [
			'menu_title'	=> '关于WPJAM',	
			'function'		=> 'wpjam_basic_about_page',	
			'page_file'		=> WPJAM_BASIC_PLUGIN_DIR.'admin/pages/wpjam-about.php'
		];
	}

	$wpjam_pages['wpjam-basic']	= [
		'menu_title'	=> 'WPJAM',	
		'icon'			=> 'dashicons-performance',
		'position'		=> '58.99',	
		'function'		=> 'option',	
		'subs'			=> $subs
	];

	if($verified === 'verified'){
		return $wpjam_pages;
	}

	if(is_multisite() && is_network_admin()){
		// $wpjam_pages['settings']['subs']['db-optimize']		= array('menu_title'=>'数据库优化',	'function'=>'wpjam_db_optimize_page', 'capability'=>$capability);
	}else{
		// $wpjam_pages['management']['subs']['data-clear']	= array('menu_title'=>'数据清理',		'function'=>'wpjam_clear_page');
		// $wpjam_pages['management']['subs']['db-optimize']	= array('menu_title'=>'数据库优化',	'function'=>'wpjam_db_optimize_page', 'capability'=>$capability);
	}

	// if(is_multisite()){
	// $list_tabs = array(
	// 	'shortcodes'	=> array('title'=>'Shortcodes',	'function'=>'wpjam_shortcodes_list'),
	// 	'constants'		=> array('title'=>'系统常量', 	'function'=>'wpjam_constants_list'),
	// 	'hooks'			=> array('title'=>'Hooks', 		'function'=>'wpjam_hooks_list'),
	// 	'oembeds'		=> array('title'=>'Oembeds', 	'function'=>'wpjam_oembeds_list'),
	// );
	// 	$subs['wpjam-list']		= array('menu_title'=>'内置列表',		'capability'=>$capability,	'function'=>'tab', 'tabs'=>$list_tabs);
	// 	$subs['wpjam-functions']= array('menu_title'=>'新增的功能',	'capability'=>$capability);
	// }

	$topic_menu_title	= '讨论组';

	$wpjam_topic_messages = wpjam_get_topic_messages();
	if($unread_count	= $wpjam_topic_messages['unread_count']){
		$topic_menu_title .= '<span class="update-plugins count-'.$unread_count.'"><span class="plugin-count">'.$unread_count.'</span></span>';
	}

	$wpjam_pages['wpjam-topics']	= array(
		'menu_title'	=> $topic_menu_title,		
		'icon'			=> 'dashicons-wordpress',
		'capability'	=> 'read',
		'position'		=> '58.98',	
		'subs'			=> [
			'wpjam-topics'		=> [
				'menu_title'	=> '所有帖子',	
				'function'		=> 'list',
				'page_file'		=> WPJAM_BASIC_PLUGIN_DIR.'admin/pages/wpjam-topics.php',
				'capability'	=> 'read',
				
			],
			'wpjam-topic-user'	=>[
				'menu_title'	=> '个人中心',	
				'page_file'		=> WPJAM_BASIC_PLUGIN_DIR.'admin/pages/wpjam-topic-user.php',
				'capability'	=> 'read',
				'function'		=> 'tab',
				'tabs'			=> [
					'message'	=> ['title'=>'消息提醒',	'function'=>'wpjam_topic_user_messages_page'],
					'profile'	=> ['title'=>'个人资料',	'function'=>'wpjam_topic_user_profile_page'],
				]
			]
		]
	);
	
	return $wpjam_pages;
}
  
add_action('admin_menu', function () {
	global $menu, $submenu;
	$menu['58.88']	= ['',	'read',	'separator'.'58.88', '', 'wp-menu-separator'];

	if(get_option('WPLANG') == 'zh_CN'){
		$menu[80][0]	= '设置';
	}

	if(CDN_NAME){
		remove_submenu_page('options-general.php', 'options-media.php');
	}	

	if(wpjam_basic_get_setting('show_all_setting')){
		add_options_page('所有设置', '所有设置', 'administrator', 'options.php'); 
	}
});  