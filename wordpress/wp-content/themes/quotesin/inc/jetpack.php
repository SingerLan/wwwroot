<?php
/**
 * Jetpack Compatibility File
 * Jetpack setup function.
 *
 * @link https://jetpack.com/
 *
 * @package QuotesIn
 */

function quotesin_jetpack_setup() {
	// Add theme support for Infinite Scroll.
	add_theme_support( 'infinite-scroll', array(
		'type'            => 'scroll',
		'footer_widgets'  => array( 'quotesin-footer-1' ),
		'container'       => 'scroll-wrapper',
		'render'          => 'quotesin_jetpack_render',
		'posts_per_page'  => get_option( 'posts_per_page' ),
		'wrapper'         => false,
		'footer'          => false,
	) );
}

add_action( 'after_setup_theme', 'quotesin_jetpack_setup' );
// Custom render function for Infinite Scroll.
function quotesin_jetpack_render() {
	while ( have_posts() ) {
		the_post();
		get_template_part( 'template-parts/content', get_post_format() );
	}
}