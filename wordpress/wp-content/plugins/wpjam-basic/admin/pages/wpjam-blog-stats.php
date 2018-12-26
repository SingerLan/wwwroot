<?php

function wpjam_blog_stats_page(){
	global $current_admin_url, $wpjam_stats_labels, $wpdb;

	extract($wpjam_stats_labels);

	echo '<h1>每日数据</h1>';

	wpjam_stats_header(array('show_date_type'=>true));

	$sql	= "SELECT DATE_FORMAT(`registered`, '{$wpjam_date_format}') as day, count(*) as count FROM {$wpdb->blogs} WHERE registered >= '{$wpjam_start_date} 00:00:01' AND  registered <= '{$wpjam_end_date} 23:59:59' GROUP BY day ORDER BY day DESC";

	$counts_array = $wpdb->get_results($sql, OBJECT_K);

	wpjam_line_chart($counts_array, ['count'=>'注册数'], array('show_sum' =>true, 'show_avg' =>true));

}