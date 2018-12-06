<?php
/**
 * The template part for displaying a message that posts cannot be found.
 * @package QuotesIn
 */
?>

<h1 class="page-title">
	<?php esc_html_e( 'Nothing Found', 'quotesin' ); ?>
</h1>
<!-- .page-header -->
<div class="page-content">
	<?php if ( is_home() && current_user_can( 'publish_posts' ) ) : ?>
		<p><?php printf(
			/* translators: 1: Post new link. */
			esc_html__( 'Ready to publish your first post? <a href="%1$s">Get started here</a>.', 'quotesin' ), esc_url( admin_url( 'post-new.php' ) )
			);
			?></p>
	<?php elseif ( is_search() ) : ?>
		<p><?php esc_html_e( 'Sorry, but nothing matched your search terms. Please try again with some different keywords.', 'quotesin' ); ?></p>
		<?php get_search_form(); ?>
	<?php
	else : ?>
		<p>
			<?php esc_html_e( 'It seems we can&rsquo;t find what you&rsquo;re looking for. Perhaps searching can help.', 'quotesin' ); ?>
		</p>
		<?php get_search_form(); ?>
	<?php endif; ?>
</div>
<!-- .page-content -->