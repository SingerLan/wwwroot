<?php
add_action('admin_init', function () {
	remove_submenu_page('themes.php', 'theme-editor.php');
}, 999);

add_filter('wpjam_pages', function ($wpjam_pages){
	$capability	= (is_multisite())?'manage_site':'manage_options';

	$wpjam_pages['themes']['subs']['wpjam-theme-setting']	= [
		'menu_title'	=> '主题设置',	
		'function'		=> 'option',
		'option_name'	=> 'wpjam_theme',
		'page_file'		=> TEMPLATEPATH .'/admin/theme-setting.php',		
	];

	$wpjam_pages['themes']['subs']['wpjam-theme-support']	= [
		'menu_title'	=> '主题支持',	
		'option_name'	=> 'wpjam_theme',
		'page_file'		=> TEMPLATEPATH .'/admin/theme-support.php',		
	];

	global $submenu;

	unset($submenu['themes.php'][6]);

	return $wpjam_pages;

});


add_action('wpjam_post_page_file', function($post_type){
	if($post_type == 'post'){
		require TEMPLATEPATH .'/admin/post-options.php';
	}
});

add_action('wpjam_post_list_page_file', function($post_type){
	if($post_type == 'post'){
		require TEMPLATEPATH .'/admin/post-options.php';
	}
});

add_action('wpjam_term_list_page_file', function($taxonomy){
	if($taxonomy == 'category'){
		require TEMPLATEPATH .'/admin/term-options.php';
	}
});

add_action('wpjam_term_page_file', function($taxonomy){
	if($taxonomy == 'category'){
		require TEMPLATEPATH .'/admin/term-options.php';
	}
});

add_filter('admin_footer_text', function  () {
	echo 'Powered by <a href="http://www.xintheme.com" target="_blank">新主题</a> + <a href="https://blog.wpjam.com/" target="_blank">WordPress 果酱</a>';
});

//上传图片使用日期重命名
if( wpjam_get_setting('wpjam_theme', 'xintheme_up_img') ) {
	add_filter('wp_handle_upload_prefilter', function ($file){  
		$file['name'] = date("YmdHis")."".mt_rand(1,100).".".pathinfo($file['name'] , PATHINFO_EXTENSION);  
		return $file;  
	});
} 

//编辑器增强
add_filter('mce_buttons_3', function ($buttons) {
	$buttons[] = 'hr';
	$buttons[] = 'del';
	$buttons[] = 'sub';
	$buttons[] = 'sup'; 
	$buttons[] = 'fontselect';
	$buttons[] = 'fontsizeselect';
	$buttons[] = 'cleanup';   
	$buttons[] = 'styleselect';
	$buttons[] = 'wp_page';
	$buttons[] = 'anchor';
	$buttons[] = 'backcolor';
	return $buttons;
});

/*编辑器添加分页按钮*/
add_filter('mce_buttons',function ($mce_buttons) {
	$pos = array_search('wp_more',$mce_buttons,true);
	if ($pos !== false) {
		$tmp_buttons	= array_slice($mce_buttons, 0, $pos+1);
		$tmp_buttons[]	= 'wp_page';
		$mce_buttons	= array_merge($tmp_buttons, array_slice($mce_buttons, $pos+1));
	}
	return $mce_buttons;
});


//字体增加  
add_filter('tiny_mce_before_init', function ($initArray){  
   $initArray['font_formats'] = "微软雅黑='微软雅黑';宋体='宋体';黑体='黑体';仿宋='仿宋';楷体='楷体';隶书='隶书';幼圆='幼圆';";  
   return $initArray;  
});

add_filter('contextual_help', function ($old_help, $screen_id, $screen){
	$screen->remove_help_tabs();
	return $old_help;
}, 10, 3 );

//去除后台标题中的“—— WordPress”
add_filter('admin_title', function ($admin_title, $title){
	return $title.' &lsaquo; '.get_bloginfo('name');
}, 10, 2);
