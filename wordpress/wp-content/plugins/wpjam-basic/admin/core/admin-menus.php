<?php
// 设置菜单
add_action('network_admin_menu', 'wpjam_admin_menu');
add_action('admin_menu', 'wpjam_admin_menu');
function wpjam_admin_menu() {
	global $pagenow, $plugin_page, $current_tab, $current_option, $current_list_table, $current_dashboard, $current_admin_url, $current_page_file;

	if($pagenow == 'options.php'){
		include(WPJAM_BASIC_PLUGIN_DIR.'admin/core/options-update.php');
		return;
	}

	// 获取后台菜单
	if(is_multisite() && is_network_admin()){
		$wpjam_pages	=  apply_filters('wpjam_network_pages', []);

		$builtin_parent_pages	= [
			'settings'	=> 'settings.php',
			'theme'		=> 'themes.php',
			'themes'	=> 'themes.php',
			'plugins'	=> 'plugins.php',
			'users'		=> 'users.php',
			'sites'		=> 'sites.php',
		];
	}else{
		$wpjam_pages	= apply_filters('wpjam_pages', []);

		$builtin_parent_pages	= [
			'management'=> 'tools.php',
			'options'	=> 'options-general.php',
			'theme'		=> 'themes.php',
			'themes'	=> 'themes.php',
			'plugins'	=> 'plugins.php',
			'posts'		=> 'edit.php',
			'media'		=> 'upload.php',
			'links'		=> 'link-manager.php',
			'pages'		=> 'edit.php?post_type=page',
			'comments'	=> 'edit-comments.php',
			'users'		=> current_user_can('edit_users')?'users.php':'profile.php',
		];
		
		if($custom_post_types = get_post_types(['_builtin' => false, 'show_ui' => true])){
			foreach ($custom_post_types as $custom_post_type) {
				$builtin_parent_pages[$custom_post_type.'s'] = 'edit.php?post_type='.$custom_post_type;
			}
		}
	}

	if(!$wpjam_pages) return;

	$current_page_hook = ''; 

	foreach ($wpjam_pages as $menu_slug=>$wpjam_page) {
		if(isset($builtin_parent_pages[$menu_slug])){
			$parent_slug = $builtin_parent_pages[$menu_slug];
		}else{
			$wpjam_page	= wpjam_parse_admin_menu($wpjam_page);
			extract($wpjam_page);
			
			// $function	= ($function !== '')?'wpjam_admin_page':'';
			$page_hook	= add_menu_page($page_title, $menu_title, $capability, $menu_slug, '__return_true', $icon, $position);

			if($page_hook && ($plugin_page == $menu_slug)){
				$current_page_setting	= $wpjam_page;
				$current_page_hook		= $page_hook;
				$current_page_file		= $wpjam_page['page_file']??'';

				$current_admin_url	= 'admin.php?page='.$plugin_page;
				$current_admin_url	= (is_network_admin())?network_admin_url($current_admin_url):admin_url($current_admin_url);
			}

			$parent_slug	= $menu_slug;
		}

		if(!empty($wpjam_page['subs'])){
			foreach ($wpjam_page['subs'] as $menu_slug => $wpjam_page) {
				$wpjam_page	= wpjam_parse_admin_menu($wpjam_page);
				extract($wpjam_page);
				
				$page_hook	= add_submenu_page($parent_slug, $page_title, $menu_title, $capability, $menu_slug, '__return_true');
				
				if($page_hook && ($plugin_page == $menu_slug)){
					$current_page_setting	= $wpjam_page;
					$current_page_hook		= $page_hook;
					$current_page_file		= $wpjam_page['page_file']??'';

					if(isset($builtin_parent_pages[$parent_slug])){
						$current_admin_url	= $builtin_parent_pages[$parent_slug];
						$current_admin_url 	.= (strpos($current_admin_url, '?'))?'&page='.$plugin_page:'?page='.$plugin_page;
					}else{
						$current_admin_url	= 'admin.php?page='.$plugin_page;
					}

					$current_admin_url	= (is_network_admin())?network_admin_url($current_admin_url):admin_url($current_admin_url);
				}
			}
		}
	}

	if($current_page_hook){
		if($current_page_file)	include($current_page_file);
		
		$function_prefix	= str_replace('-', '_', $plugin_page);

		if(function_exists($function_prefix.'_tabs')){
			add_filter(wpjam_get_filter_name($plugin_page, 'tabs'), $function_prefix.'_tabs',1);
		}

		if(function_exists($function_prefix.'_fields')){		// 等着旧的 list table 升级慢慢取消
			add_filter($plugin_page.'_fields', $function_prefix.'_fields',1);
		}

		if(function_exists($function_prefix.'_page_load')){		// 等着旧的 list table 升级慢慢取消
			add_action($plugin_page.'_page_load', $function_prefix.'_page_load',1);
		}

		$function	= $current_page_setting['function'];
		$args		= ($current_page_setting['args'])??[];

		if($function == 'tab'){

			// wpjam_print_r(wpjam_get_filter_name($plugin_page, 'tabs'));
			
			$tabs 	= apply_filters(wpjam_get_filter_name($plugin_page, 'tabs'), ($current_page_setting['tabs']??[]));

			// print_r($tabs);

			if(!$tabs) {
				wp_die('Tabs 未设置');
			}

			foreach ($tabs as $tab_key => $tab) { 
				if(is_string($tab)){
					$tabs[$tab_key]	= ['title'=>$tab, 'function'=>str_replace('-', '_', $plugin_page.'_'.$tab_key.'_page')];
				}
			}

			$tab_keys		= array_keys($tabs);
			$current_tab	= !empty($_GET['tab'])?$_GET['tab']:$tab_keys[0];

			if(empty($tabs[$current_tab])){
				wp_die('无此Tab');
			}

			$current_admin_url = $current_admin_url.'&tab='.$current_tab;

			$current_page_setting['tabs']	= $tabs;
			$function	= $tabs[$current_tab]['function'];
			$args		= ($tabs[$current_tab]['args'])??[];

			if($function == 'option'){
				$current_option	= $tabs[$current_tab]['option_name']??$plugin_page;
			}elseif($function == 'list' || $function == 'list_table'){
				$current_list_table	= $tabs[$current_tab]['list_table_name']??$plugin_page;
			}elseif($function == 'dashboard'){
				$current_dashboard	= $tabs[$current_tab]['dashboard_name']??$plugin_page;
			}
		}elseif($function == 'option'){
			$current_option	= $current_page_setting['option_name']??$plugin_page;
		}elseif($function == 'list' || $function == 'list_table'){
			$current_list_table	= $current_page_setting['list_table_name']??$plugin_page;
		}elseif($function == 'dashboard'){
			$current_dashboard	= $current_page_setting['dashboard_name']??$plugin_page;
		}

		// 如果是通过 wpjam_pages filter 定义的后台菜单，就需要设置 $current_screen->id=$plugin_page
		// 否则隐藏列功能就会出问题。	
		add_action('current_screen', function ($current_screen){
			global $pagenow, $plugin_page, $current_option, $current_list_table, $current_dashboard ;

			$current_screen->id = $current_screen->base = $plugin_page;

			if($current_option){
				include(WPJAM_BASIC_PLUGIN_DIR.'admin/core/options.php');
			}elseif($current_dashboard){
				include(WPJAM_BASIC_PLUGIN_DIR.'admin/core/dashboard.php');
			}elseif($current_list_table){
				include(WPJAM_BASIC_PLUGIN_DIR.'admin/core/list-table.php');
			}
		});

		add_action('load-'.$current_page_hook, function() use ($function, $args){
			if($function == 'list'){
				wpjam_admin_list_page_load($args);
			}elseif($function == 'option'){

			}elseif($function == 'dashboard'){

			}else{
				global $plugin_page;

				$action	= ($_GET['action'])??'';
				if(in_array($action, ['add','edit','set','bulk-edit'])) return;

				do_action($plugin_page.'_page_load');	// 等着旧的 list table 升级慢慢取消
			}
		});

		add_action($current_page_hook, function() use ($current_page_setting){
			echo '<div class="wrap">';
			wpjam_admin_page($current_page_setting);
			echo '</div>';
		});
	}
}

// 菜单处理函数
function wpjam_parse_admin_menu($wpjam_page){
	$wpjam_page = wp_parse_args($wpjam_page, [
		'menu_title'	=> '',
		'page_title'	=> '',
		'function'		=> null,
		'capability'	=> 'manage_options',
		'icon'			=> '',
		'position'		=> null,
		'fields'		=> ''
	]);

	if(!$wpjam_page['page_title']){
		$wpjam_page['page_title'] = $wpjam_page['menu_title'];
	}

	return $wpjam_page;
}