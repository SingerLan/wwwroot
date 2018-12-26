<?php
// Dashboard Widget
add_action('wp_dashboard_setup',  function(){
	global $wp_meta_boxes, $plugin_page;
	
	if(!empty($plugin_page)){
		unset($wp_meta_boxes[$plugin_page]);	 // 移除默认的 widget 
		$dashboard_widgets	= apply_filters(wpjam_get_filter_name($plugin_page,'dashboard_widgets'), array());
	}else{
		$dashboard_widgets	= apply_filters('wpjam_dashboard_widgets', array());
	}

	if($dashboard_widgets){
		foreach ($dashboard_widgets as $widget_id => $dashboard_widget) {
			extract(wp_parse_args($dashboard_widget, array(
				'title'		=> '',
				'callback'	=> wpjam_get_filter_name($widget_id,'dashboard_widget_callback'),
				'control'	=> null,
				'args'		=> '',
				'context'	=> 'normal',	// 位置，normal 左侧, side 右侧
				'priority'	=> 'core'
			)));

			if($control == null){
				$screen = get_current_screen();
				add_meta_box($widget_id, $title, $callback, $screen, $context, $priority, $args );
			}else{
				wp_add_dashboard_widget($widget_id, $title, $callback, $control, $args);
			}
		}
	}
});


function wpjam_admin_dashboard_page($title='', $summary=''){
	global $plugin_page, $current_tab;

	require_once(ABSPATH . 'wp-admin/includes/dashboard.php');
	
	wp_dashboard_setup();

	wp_enqueue_script('dashboard');
	
	if(wp_is_mobile()) {
		wp_enqueue_script('jquery-touch-punch');
	}
	?>

	<?php $filter_name	= wpjam_get_filter_name($plugin_page,'welcome_panel'); ?>

	<?php if(has_action($filter_name)){?>

	<div id="welcome-panel" class="welcome-panel">
		<?php do_action($filter_name); ?>
	</div>

	<?php } else {?>

	<?php 

	if($title){
		if(!empty($current_tab)){
			echo '<h2>'.$title.'</h2>';	
		}else{
			echo '<h1>'.$title.'</h1>';
		}
	}

	if($summary){
		echo wpautop($summary);
	}

	?>
	
	<?php } ?>
	
	<div id="dashboard-widgets-wrap">
	<?php wp_dashboard(); ?>
	</div>
	
	<?php
}