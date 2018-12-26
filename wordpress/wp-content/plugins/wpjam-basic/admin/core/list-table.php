<?php
function wpjam_admin_list_page_load($args=[]){
	global $current_list_table, $current_admin_url, $wpjam_list_table;

	$wpjam_list_table	= wpjam_get_list_table($current_list_table);

	if(empty($wpjam_list_table)){
		return;
	}

	if($args){
		$current_admin_url	= add_query_arg($args, $current_admin_url);
	}

	$current_action	= $wpjam_list_table->current_action();
	$actions		= $wpjam_list_table->get_actions();

	if(isset($actions[$current_action])){
		if((!isset($actions[$current_action]['direct']) && !isset($actions[$current_action]['overall']))){
			$wpjam_list_table->action_page();
			exit;
		}
	}
	
	return true;
}

function wpjam_admin_list_page(){
	global $wpjam_list_table;

	if($wpjam_list_table){
		$wpjam_list_table->list_page();
	}
}

function wpjam_get_list_table($current_list_table){

	$wpjam_list_table_args	= apply_filters(wpjam_get_filter_name($current_list_table, 'list_table'), []);

	if(!$wpjam_list_table_args){
		$wpjam_list_table_args_arr	= apply_filters('wpjam_list_tables', []);
		$wpjam_list_table_args		= $wpjam_list_table_args_arr[$current_list_table]??[];
	}

	if(empty($wpjam_list_table_args)){
		return false;
	}

	$wpjam_list_table_args	= wp_parse_args($wpjam_list_table_args, ['primary_key'=>'id','name'=>$current_list_table]);
	return new WPJAM_List_Table($wpjam_list_table_args);
}

function wpjam_list_table_ajax_response(){
	global $plugin_page, $current_tab, $current_admin_url, $current_page_file, $current_list_table, $wpjam_list_table;

	$current_tab		= $_POST['current_tab']??'';
	$current_admin_url	= $_POST['current_admin_url']??'';
	$plugin_page		= $_POST['plugin_page'];
	$current_list_table	= $_POST['current_list_table'];
	$current_page_file	= $_POST['current_page_file']??'';

	if($current_page_file){
		include(WP_CONTENT_DIR.$current_page_file);
	}

	$wpjam_list_table	= wpjam_get_list_table($current_list_table);
	$wpjam_list_table->ajax_response();
}