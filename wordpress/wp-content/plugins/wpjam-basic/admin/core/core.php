<?php
include(WPJAM_BASIC_PLUGIN_DIR.'admin/includes/class-wpjam-list-table.php');
include(WPJAM_BASIC_PLUGIN_DIR.'admin/includes/class-wpjam-form.php');
include(WPJAM_BASIC_PLUGIN_DIR.'admin/includes/class-wpjam-ajax.php');

include(WPJAM_BASIC_PLUGIN_DIR.'admin/core/admin-menus.php');

include(WPJAM_BASIC_PLUGIN_DIR.'admin/core/hooks.php');
include(WPJAM_BASIC_PLUGIN_DIR.'admin/core/functions.php');

add_action('current_screen', function($current_screen){
	global $pagenow, $plugin_page;

	if(isset($plugin_page)){
		return;
	}

	if($pagenow == 'post.php' || $pagenow == 'post-new.php'){
		$post_type	= $current_screen->post_type;
		
		include(WPJAM_BASIC_PLUGIN_DIR.'admin/core/post.php');
	}elseif($pagenow == 'edit.php' || $pagenow == 'upload.php'){
		$post_type	= $current_screen->post_type;

		include(WPJAM_BASIC_PLUGIN_DIR.'admin/core/post-list.php');
	}elseif($pagenow == 'term.php') {
		$taxonomy	= $current_screen->taxonomy;

		include(WPJAM_BASIC_PLUGIN_DIR.'admin/core/term.php');
	}elseif($pagenow == 'edit-tags.php') {
		$taxonomy	= $current_screen->taxonomy;

		include(WPJAM_BASIC_PLUGIN_DIR.'admin/core/term-list.php');
	}
});

add_action('wp_loaded', function(){
	if(wp_doing_ajax() && isset($_POST['action'])){
		if($_POST['action'] == 'query_posts'){
			$args	= $_POST;
			unset($args['action']);
			$_query	= new WP_Query($args);
			wpjam_send_json($_query->posts);
		}elseif($_POST['action'] == 'inline-save' || $_POST['action'] == 'post-list-table-action'){
			$post_type = $_POST['post_type'];
			
			include(WPJAM_BASIC_PLUGIN_DIR.'admin/core/post-list.php');
		}elseif($_POST['action'] == 'add-tag'){
			$taxonomy	= $_POST['taxonomy'];

			include(WPJAM_BASIC_PLUGIN_DIR.'admin/core/term-list.php');
		}elseif($_POST['action'] == 'wpjam-page-action'){
			add_action('wp_ajax_wpjam-page-action', 'wpjam_page_ajax_response');
		}elseif($_POST['action'] == 'list-table-action'){
			include(WPJAM_BASIC_PLUGIN_DIR.'admin/core/list-table.php');
			add_action('wp_ajax_list-table-action', 'wpjam_list_table_ajax_response');
		}elseif($_POST['action'] == 'wpjam-option-action'){
			include(WPJAM_BASIC_PLUGIN_DIR.'admin/core/options-update.php');

			add_action('wp_ajax_wpjam-option-action', 'wpjam_option_ajax_response');
		}
	}
});