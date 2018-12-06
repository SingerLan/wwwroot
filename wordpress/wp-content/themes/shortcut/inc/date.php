<?php
/**
 * Delete default months
 *
 * @since Shortcut 1.3
 */
add_filter( 'months_dropdown_results', '__return_empty_array' );
/**
 * Dependency jQuery UI
 *
 * @since Shortcut 1.3
 */
function jqueryui(){
	wp_enqueue_style( 'jquery-ui', '//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.min.css' );
	wp_enqueue_script( 'jquery-ui-datepicker' );
}
add_action( 'admin_enqueue_scripts', 'jqueryui' );
/**
 * filters posts
 *
 * @since Shortcut 1.3
 */
function filterquery( $admin_query ){
	global $pagenow;
	if (
		is_admin()
		&& $admin_query->is_main_query()
		&& in_array( $pagenow, array( 'edit.php', 'upload.php' ) )
		&& ( ! empty( $_GET['zbDateFrom'] ) || ! empty( $_GET['zbDateTo'] ) )
	) {
		$admin_query->set(
			'date_query', 
			array(
				'ater' => $_GET['zbDateFrom'],
				'before' => $_GET['zbDateTo'],
				'inclusive' => true,
				'column'    => 'post_date'
			)
		);
 
	}
	return $admin_query;
}
add_action( 'pre_get_posts', 'filterquery' );
/**
 * HTML of the filter
 *
 * @since Shortcut 1.3
 */
function form(){
	$from = ( isset( $_GET['zbDateFrom'] ) && $_GET['zbDateFrom'] ) ? $_GET['zbDateFrom'] : '';
	$to = ( isset( $_GET['zbDateTo'] ) && $_GET['zbDateTo'] ) ? $_GET['zbDateTo'] : '';
	echo '<style>input[name="zbDateFrom"], input[name="zbDateTo"]{
			line-height: 28px;
			height: 28px;
			margin: 0;
			width:125px;}</style>
 
		<input type="text" name="zbDateFrom" placeholder="开始日期" value="' . $from . '" />
		<input type="text" name="zbDateTo" placeholder="结束日期" value="' . $to . '" />
		<script>
		jQuery( function($) {
			var from = $(\'input[name="zbDateFrom"]\'),
			    to = $(\'input[name="zbDateTo"]\');
 
			$( \'input[name="zbDateFrom"], input[name="zbDateTo"]\' ).datepicker();
    			from.on( \'change\', function() {
				to.datepicker( \'option\', \'minDate\', from.val() );
			});
 
			to.on( \'change\', function() {
				from.datepicker( \'option\', \'maxDate\', to.val() );
			});
 
		});
		</script>';
}
add_action( 'restrict_manage_posts', 'form');