<?php
add_filter('wpjam_cdn_setting', function(){
	$thumb_fields = [
		'use_first'	=> ['title'=>'使用第一张图',	'type'=>'checkbox',	'description'=>'如果文章没有设置特色图片的情况下，使用文章内容中的第一张图片作为缩略图！'],
		'default'	=> ['title'=>'默认缩略图',	'type'=>'image',	'description'=>'各种情况都找不到缩略图之后默认的缩略图，可以填本地或者云存储的地址！'],
		'width'		=> ['title'=>'图片最大宽度',	'type'=>'number',	'class'=>'all-options',	'description'=>'<br />设置博客文章内容中图片的最大宽度，插件会使用将图片缩放到对应宽度，节约流量和加快网站速度加载。'],
	];

	$sections	= [];

	$sections['thumb']		= [
		'title'		=> '',	
		'summary'	=> '<p>*请使用 <a href="https://blog.wpjam.com/m/wpjam-basic-thumbnail-functions/" target="_blank">WPJAM 的相关缩略图</a>函数代替 WordPress 自带的缩略图函数，下面的设置才能生效。</p>',		
		'fields'	=> $thumb_fields,
	];

	$sections	= apply_filters('wpjam_thumbnail_setting_sections', $sections);
	
	return compact('sections');
});