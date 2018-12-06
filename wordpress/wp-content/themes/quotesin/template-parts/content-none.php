<?php
/**
 * Template part for displaying a message that posts cannot be found
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package QuotesIn
 */

?>

<div class="masonryinside">
	<div class="wrapper">

		<div class="item inside searchresult">
			<h2 class="search-title">
			<?php esc_html_e( 'That page can&rsquo;t be found.', 'quotesin' ); ?>
			</h2>
			<p><strong>
				<?php esc_html_e( 'It looks like nothing was found at this location. Please try searching for the content', 'quotesin' ); ?>
			</strong></p>
			<?php get_search_form(); ?>
		</div>
	</div>
</div>