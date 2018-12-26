<?php
add_filter('wpjam_term_options', function($term_options){
	$term_thumbnail_type	= wpjam_cdn_get_setting('term_thumbnail_type') ?: 'img';

	$term_options['thumbnail'] = [
		'title'				=> '缩略图', 
		'taxonomies'		=> 'all', 
		'show_admin_column'	=> true,	
		'column_callback'	=> function($term_id){
			return wpjam_get_term_thumbnail($term_id, [50,50]);
		}
	];

	if($term_thumbnail_type == 'img'){
		$width	= wpjam_cdn_get_setting('term_thumbnail_width') ?: 200;
		$height	= wpjam_cdn_get_setting('term_thumbnail_height') ?: 200;

		$term_options['thumbnail']['type']			= 'img';
		$term_options['thumbnail']['item_type']		= 'url';
		$term_options['thumbnail']['size']			= $width.'x'.$height;
		$term_options['thumbnail']['description']	= '尺寸：'.$width.'x'.$height;

	}else{
		$term_options['thumbnail']['type']	= 'image';
	}

	return $term_options;
});

add_filter('wpjam_thumbnail_setting_sections', function($sections){

	unset($sections['thumb']['fields']['use_first']);
	$sections['thumb']['title']	= '缩略图设置';

	$sections['advanced']	= [
		'title'		=>'高级缩略图', 
		'fields'	=>[
			'term_thumbnail_type'	=> [
				'title'			=>'标签缩略图模式',
				'type'			=>'select',
				'options'		=>['img'=>'本地媒体模式','image'=>'输入图片链接模式']
			],
			'term_thumbnail_size'	=> [
				'title'			=>'标签缩略图尺寸',
				'type'			=>'fieldset',
				'fields'		=>[
					'term_thumbnail_width'	=> [
						'title'	=>'宽度',
						'type'	=>'number',
						'class'	=>'small-text'
					],
					'term_thumbnail_height'	=> [
						'title'	=>'高度',
						'type'	=>'number',
						'class'	=>'small-text'
					],
				]
			],
			'post_thumbnail_order'	=> [
				'title'			=>'文章缩略图顺序',
				'type'			=>'select',
				'options'		=>['1'=>'第一张图、标签缩略图、分类缩略图','2'=>'标签缩略图、第一张图、分类缩略图','3'=>'分类缩略图、第一张图、标签缩略图'],
				'description'	=>'<br />如果文章没有设置特色图片的情况下，文章缩略图启用顺序！'
			],
		]
	];
	return $sections;
});
