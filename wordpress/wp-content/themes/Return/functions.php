<?php
if(!defined('WPJAM_BASIC_PLUGIN_FILE')){
	if(!is_admin()){
		wp_die('该主题基于 WPJAM Basic 插件开发，请先<a href="https://wordpress.org/plugins/wpjam-basic/">下载</a>并<a href="'.admin_url('plugins.php').'">激活</a> WPJAM Basic 插件。');
		exit;
	}
}else{
	include_once TEMPLATEPATH.'/public/utils.php';
	include_once TEMPLATEPATH.'/public/hooks.php';
	include_once TEMPLATEPATH.'/public/widgets.php';

	if(is_admin()){
		include(TEMPLATEPATH.'/admin/admin.php');
	}
}

add_theme_support('post-thumbnails');		//添加特色缩略图支持
add_theme_support( 'post-formats', array( 'aside','gallery' ) );	//默认的 日志、链接、图像 来当作下面的大图、无图、多图 来使用的

register_nav_menus([
	'main'	=> '主菜单',
	'foot'	=> '页脚菜单'
]);


register_sidebar(array(
	'name'			=> '全站侧栏',
	'id'			=> 'widget_right',
	'before_widget'	=> '<div class="widget %2$s">', 
	'after_widget'	=> '</div>', 
	'before_title'	=> '<div class="box-moder hot-article"><h3>', 
	'after_title'	=> '</h3></div>' 
));
register_sidebar(array(
	'name'			=> '首页侧栏',
	'id'			=> 'widget_sidebar',
	'before_widget'	=> '<div class="widget %2$s">', 
	'after_widget'	=> '</div>', 
	'before_title'	=> '<div class="box-moder hot-article"><h3>', 
	'after_title'	=> '</h3></div>' 
));

register_sidebar(array(
	'name'			=> '文章页侧栏',
	'id'			=> 'widget_post',
	'before_widget' => '<div class="widget %2$s">', 
	'after_widget'	=> '</div>', 
	'before_title'	=> '<div class="box-moder hot-article"><h3>', 
	'after_title'	=> '</h3></div>' 
));

register_sidebar(array(
	'name'			=> '页面侧栏',
	'id'			=> 'widget_page',
	'before_widget'	=> '<div class="widget %2$s">', 
	'after_widget'	=> '</div>', 
	'before_title'	=> '<div class="box-moder hot-article"><h3>', 
	'after_title'	=> '</h3></div>' 
));

register_sidebar(array(
	'name'			=> '分类/标签/搜索页侧栏',
	'id'			=> 'widget_other',
	'before_widget'	=> '<div class="widget %2$s">', 
	'after_widget'	=> '</div>', 
	'before_title'	=> '<div class="box-moder hot-article"><h3>', 
	'after_title'	=> '</h3></div>' 
));  

