<?php
add_filter('wpjam_category_term_options',function ($post_options){
	$term_options['cat_layout']	= ['title'=>'布局样式',	'type'=>'select',	'show_admin_column'=>true,	'options'=>['list1'=>'小图、标准、特色三种文章形式堆砌显示','list2'=>'第1和7篇文章大图显示','list3'=>'同上，增加侧边栏','list4'=>'经典博客列表']];
	
	return $term_options;
});