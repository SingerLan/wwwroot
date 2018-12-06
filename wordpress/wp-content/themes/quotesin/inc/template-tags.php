<?php
/**
 * Custom template tags for this theme
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package QuotesIn
 */

if ( !function_exists( 'quotesin_paging_nav' ) ) :
	/**
	 * Display navigation to next/previous set of posts when applicable.
	 */
	function quotesin_paging_nav()
	{
		// Don't print empty markup if there's only one page.
		if ( $GLOBALS['wp_query']->max_num_pages < 2 ) {
			return;
		}
		?>
		<nav class="navigation paging-navigation" role="navigation">
			<h1 class="screen-reader-text"><?php esc_html_e( 'Posts navigation', 'quotesin' ); ?></h1>

			<div class="navi-links">

				<?php if ( get_next_posts_link() ) : ?>
					<div
						class="nav-previous"><?php next_posts_link( __( '<span class="meta-nav">&larr;</span> Older posts', 'quotesin' ) ); ?></div>
				<?php endif; ?>

				<?php if ( get_previous_posts_link() ) : ?>
					<div
						class="nav-next"><?php previous_posts_link( __( 'Newer posts <span class="meta-nav">&rarr;</span>', 'quotesin' ) ); ?></div>
				<?php endif; ?>

			</div>
			<!-- .navi-links -->
		</nav><!-- .navigation -->
	<?php
	}
endif;

if ( !function_exists( 'quotesin_post_nav' ) ) :
	/**
	 * Display navigation to next/previous post when applicable.
	 */
	function quotesin_post_nav()
	{
		// Don't print empty markup if there's nowhere to navigate.
		$previous = ( is_attachment() ) ? get_post( get_post()->post_parent ) : get_adjacent_post( false, '', true );
		$next = get_adjacent_post( false, '', false );

		if ( !$next && !$previous ) {
			return;
		}
		?>
		<nav class="navigation post-navigation" role="navigation">
			<h1 class="screen-reader-text"><?php esc_html_e( 'Post navigation', 'quotesin' ); ?></h1>

			<div class="navi-links">
				<?php
				previous_post_link( '<div class="nav-previous">%link</div>', _x( '<span class="meta-nav">&larr;</span>&nbsp;%title', 'Previous post link', 'quotesin' ) );
				next_post_link( '<div class="nav-next">%link</div>', _x( '%title&nbsp;<span class="meta-nav">&rarr;</span>', 'Next post link', 'quotesin' ) );
				?>
			</div>
			<!-- .navi-links -->
		</nav><!-- .navigation -->
		<div class="clear"></div>
	<?php
	}
endif;

if ( !function_exists( 'quotesin_posted_on' ) ) :
	/**
	 * Prints HTML with meta information for the current post-date/time and author.
	 */
	function quotesin_posted_on()
	{
		$quotesin_time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';

		$quotesin_time_string = sprintf( $quotesin_time_string,
			esc_attr( get_the_date( 'c' ) ),
			esc_html( get_the_date() ),
			esc_attr( get_the_modified_date( 'c' ) ),
			esc_html( get_the_modified_date() )
		);

		$quotesin_posted_on = sprintf(
			/* translators: %s: Date. */
			_x( 'Date: %s', 'post date', 'quotesin' ),
			'<a href="' . esc_url( get_permalink() ) . '" rel="bookmark">' . $quotesin_time_string . '</a>'
		);

		echo '<span class="posted-on">' . $quotesin_posted_on . '</span>';

	}
endif;

/**
 * Returns true if a blog has more than 1 category.
 *
 * @return bool
 */
function quotesin_categorized_blog()
{
	if ( false === ( $all_the_cool_cats = get_transient( 'quotesin_categories' ) ) ) {
		// Create an array of all the categories that are attached to posts.
		$all_the_cool_cats = get_categories( array(
			'fields'     => 'ids',
			'hide_empty' => 1,

			// We only need to know if there is more than one category.
			'number'     => 2,
		) );

		// Count the number of categories that are attached to the posts.
		$all_the_cool_cats = count( $all_the_cool_cats );

		set_transient( 'quotesin_categories', $all_the_cool_cats );
	}

	if ( $all_the_cool_cats > 1 ) {
		// This blog has more than 1 category so quotesin_categorized_blog should return true.
		return true;
	} else {
		// This blog has only 1 category so quotesin_categorized_blog should return false.
		return false;
	}
}


/**
 * Flush out the transients used in quotesin_categorized_blog.
 */
function quotesin_category_transient_flusher()
{
	// Like, beat it. Dig?
	delete_transient( 'quotesin_categories' );
}

add_action( 'edit_category', 'quotesin_category_transient_flusher' );
add_action( 'save_post', 'quotesin_category_transient_flusher' );
