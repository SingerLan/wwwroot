<?php
/**
 * QuotesIn functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package QuotesIn
 */

if ( ! function_exists( 'quotesin_setup' ) ) :
	function quotesin_setup() {
		load_theme_textdomain( 'quotesin', get_template_directory() . '/languages' );

		// Add default posts and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );
		add_theme_support( 'title-tag' );

		if ( function_exists( 'add_image_size' ) ) {
			add_theme_support( 'post-thumbnails' );
			add_image_size( 'quotesin-page', 960 );
		}

		// This theme uses wp_nav_menu() in one location.
		register_nav_menus( array(
			'primary' => esc_html__( 'Primary', 'quotesin' ),
		) );
		register_nav_menu( 'social', __( 'Social', 'quotesin' ) );

		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support( 'html5', array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
		) );

		// Set up the WordPress core custom background feature.
		add_theme_support( 'custom-background', apply_filters( 'quotesin_custom_background_args', array(
			'default-color' => 'ffffff',
			'default-image' => '',
		) ) );

		// Add theme support for selective refresh for widgets.
		add_theme_support( 'customize-selective-refresh-widgets' );

		/**
		 * Add support for core custom logo.
		 *
		 * @link https://codex.wordpress.org/Theme_Logo
		 */
		add_theme_support( 'custom-logo', array(
			'height'      => 100,
			'width'       => 400,
			'flex-width'  => true,
			'flex-height' => true,
			'header-text' => array( 'site-title', 'site-description' ),
		) );
	}
endif;
add_action( 'after_setup_theme', 'quotesin_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function quotesin_content_width() {
	// This variable is intended to be overruled from themes.
	// Open WPCS issue: {@link https://github.com/WordPress-Coding-Standards/WordPress-Coding-Standards/issues/1043}.
	// phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound
	$GLOBALS['content_width'] = apply_filters( 'quotesin_content_width', 900 );
}
add_action( 'after_setup_theme', 'quotesin_content_width', 0 );

function quotesin_fallback_menu()
{
	wp_nav_menu( array(
			'menu'       => 'quotesin-primary',
			'container'  => false,
			'items_wrap' => '<ul>%3$s</ul>',
			'depth'      => 0,
		)
	);
}
/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function quotesin_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Footer', 'quotesin' ),
		'id'            => 'quotesin-footer-1',
		'description'   => esc_html__( 'Add widgets here.', 'quotesin' ),
		'before_widget' => '<div class="footerwidget">',
		'after_widget'  => '</div>',
		'before_title'  => '<h4 class="footerheading">',
		'after_title'   => '</h4>',
	) );
}
add_action( 'widgets_init', 'quotesin_widgets_init' );

// Style the Tag Cloud
function quotesin_custom_tag_cloud_widget( $args )
{
	$args['largest'] = 14; //largest tag
	$args['smallest'] = 14; //smallest tag
	$args['unit'] = 'px'; //tag font unit
	$args['number'] = '8'; //number of tags
	return $args;
}

add_filter( 'widget_tag_cloud_args', 'quotesin_custom_tag_cloud_widget' );

/**
 * Enqueue scripts and styles.
 */
function quotesin_scripts() {
	wp_enqueue_style( 'quotesin-style', get_stylesheet_uri() );
	wp_enqueue_script( 'quotesin-navigation', get_template_directory_uri() . '/inc/js/navigation.js', array(), '20151215', true );
	wp_enqueue_script( 'quotesin-skip-link-focus-fix', get_template_directory_uri() . '/inc/js/skip-link-focus-fix.js', array(), '20180424', true );
	wp_enqueue_script( 'jquery' );
	wp_enqueue_script( 'quotesin-top-menu', get_template_directory_uri() . '/inc/js/script.js', array( 'jquery' ), '20180415', true );
	wp_enqueue_style( 'font-awesome', get_template_directory_uri() . '/inc/font-awesome-4.3.0/css/font-awesome.min.css', 'style' );
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
	if ( is_singular() && wp_attachment_is_image() ) {
		wp_enqueue_script( 'quotesin-kin', get_template_directory_uri() . '/inc/js/keyboard-image-navigation.js', array( 'jquery' ), '20180416' );
	}
}
add_action( 'wp_enqueue_scripts', 'quotesin_scripts' );


// Numbered Pagination
function quotesin_pagination()
{
		the_posts_pagination( array(
			'mid_size' => 3,
			'prev_text' => _x( '&larr; Previous', 'posts navigation', 'quotesin' ),
			'next_text' => _x( 'Next &rarr;',     'posts navigation', 'quotesin' ),
		) );
}

// Limit Three Topics
add_filter('term_links-post_tag','quotesin_three_tags');
function quotesin_three_tags($terms) {
	return array_slice($terms,0,3,true);
}
// Generate Random color - You can customize
function quotesin_random_color() {
    $rand = array('0', '1', '2', '3', '4', '5', '6', '7', '8', '9', 'a', 'b', 'c', 'd', 'e', 'f');
    $quotesin_color = '#'.$rand[rand(0,15)].$rand[rand(0,15)].$rand[rand(0,15)].$rand[rand(0,15)].$rand[rand(0,15)].$rand[rand(0,15)];
    echo $quotesin_color;
}

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';
/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
if ( defined( 'JETPACK__VERSION' ) ) {
	require get_template_directory() . '/inc/jetpack.php';
}
// End
