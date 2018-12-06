<?php
/**
 * Functions which enhance the theme by hooking into WordPress
 *
 * @package QuotesIn
 */

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function quotesin_body_classes( $classes ) {
	// Adds a class of hfeed to non-singular pages.
	if ( ! is_singular() ) {
		$classes[] = 'hfeed';
	}

	// Adds a class of group-blog to blogs with more than 1 published author.
	if ( is_multi_author() ) {
		$classes[] = 'group-blog';
	}

	return $classes;
}
add_filter( 'body_class', 'quotesin_body_classes' );
// Removing it hurts developers
function quotesin_jis_footer() {
	?>
	<div id="footercredits">
		<div class="footertext">
			<?php if(is_home() || is_front_page()): ?>
			<p><a href="<?php echo esc_url( __( 'https://www.gyanchowk.com/quotesin/', 'quotesin' ) ); ?>" title="<?php _e('QuotesIn Theme by GyanChowk','quotesin'); ?>" target="_blank"><?php _e('QuotesIn theme','quotesin'); ?></a>&nbsp;<?php _e('Specially Designed for -','quotesin'); ?> &copy;&nbsp;<strong><?php bloginfo(); ?></strong>&nbsp;<?php echo date( 'Y' ); ?> <?php _e( 'All Rights Reserved.', 'quotesin' ); ?> <?php _e('Powered by','quotesin'); ?>&nbsp;<a href="<?php echo esc_url( __( 'https://wordpress.org/', 'quotesin' ) ); ?>" title="<?php _e( 'Powered by WordPress', 'quotesin' ) ?>" target="_blank"><i class="fa fa-wordpress" aria-hidden="true"></i></a></p>
			<?php else : ?>
				<p>&copy;&nbsp;<strong><?php bloginfo(); ?></strong>&nbsp;<?php echo date( 'Y' ); ?> <?php _e( 'All Rights Reserved.', 'quotesin' ); ?></p>
			<?php endif; ?>
		</div>
	 </div>
	 <?php
}
/**
 * Add a pingback url auto-discovery header for single posts, pages, or attachments.
 */
function quotesin_pingback_header() {
	if ( is_singular() && pings_open() ) {
		echo '<link rel="pingback" href="', esc_url( get_bloginfo( 'pingback_url' ) ), '">';
	}
}
add_action( 'wp_head', 'quotesin_pingback_header' );

// Limit excerpt
function quotesin_excerpt_length( $length ) {
    return;
}
add_filter( 'excerpt_length', 'quotesin_excerpt_length');

// A trick to remove excerpt more
 function quotesin_excerpt_more( $more ) {
     return ' ';
 }
 add_filter( 'excerpt_more', 'quotesin_excerpt_more' );