<?php
include(WPJAM_BASIC_PLUGIN_DIR.'admin/includes/class-wpjam-post-list-table.php');

function wpjam_get_post_list_table($post_type){
	$wpjam_list_table_args	= apply_filters(wpjam_get_filter_name($post_type, 'list_table'), []);
	
	if(empty($wpjam_list_table_args)){
		return false;
	}else{
		return new WPJAM_Post_List_Table($wpjam_list_table_args);
	}
}

do_action('wpjam_post_list_page_file', $post_type);

$post_type_list_table =  wpjam_get_post_list_table($post_type);

$post_fields	= wpjam_get_post_fields($post_type);
if(empty($post_fields)) return;

$post_fields	= array_filter($post_fields, function($field){ return !empty($field['show_admin_column']); });
if(empty($post_fields)) return;

// 在日志列表页输出自定义字段名
add_filter('manage_'.$post_type.'_posts_columns', function($columns) use($post_fields){
	wpjam_array_push($columns,  array_combine(array_keys($post_fields), array_column($post_fields, 'title')), 'date'); 
	
	return $columns;
});

// 在日志列表页输出自定义字段的值
add_action('manage_'.$post_type.'_posts_custom_column', function($column_name, $post_id) use($post_fields){
	if($post_fields && isset($post_fields[$column_name])){
		echo wpjam_column_callback($column_name, array(
			'id'		=> $post_id,
			'field'		=> $post_fields[$column_name],
			'data_type'	=> 'post_meta'
		));
	}
}, 10, 2);

if(wp_doing_ajax()) return;

$post_fields	= array_filter($post_fields, function($field){ return !empty($field['sortable_column']); });
if(empty($post_fields)) return;

// 在日志列表页获取可用于排序的自定义字段
add_filter('manage_edit-'.$post_type.'_sortable_columns', function ($columns) use($post_fields){	
	return array_merge($columns, array_combine(array_keys($post_fields), array_keys($post_fields))); 
});

// 使得可排序的自定义字段排序功能生效
add_action('pre_get_posts', function($wp_query) use($post_fields) {
	$orderby	= $wp_query->get('orderby');

	if($orderby && isset($post_fields[$orderby])){
		$wp_query->set('meta_key', $orderby);
		$orderby_type = ($post_fields[$orderby]['sortable_column'] == 'meta_value_num')?'meta_value_num':'meta_value';
		$wp_query->set('orderby', $orderby_type);
	}
});