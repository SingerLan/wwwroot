<?php
/**
 * The template for displaying category pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package QuotesIn
 */
get_header();
?>
	<?php if ( have_posts() ) : ?>

	<div class="demo-wrap">
		<div class="wrapper">
			<div class="quote-archive">
				<h1 class="archive-title"><?php single_cat_title( __( 'Quotes by ', 'quotesin' ) ); ?></h1>
				<?php the_archive_description( '<div class="archive-description">', '</div>' ); ?>
			</div>
			<div class="masonry" id="scroll-wrapper">
			<?php
			/* Start the Loop */
			while ( have_posts() ) :
				the_post();

				/*
				 * Include the Post-Type-specific template for the content.
				 * If you want to override this in a child theme, then include a file
				 * called content-___.php (where ___ is the Post Type name) and that will be used instead.
				 */
				get_template_part( 'template-parts/content', get_post_type() );
				?>
				<?php endwhile; ?>
			</div>
			<div class="pagination">
				<?php
				// use Jetpack infinite scroll, fallback to default navigation
				if ( !class_exists( 'The_Neverending_Home_Page' ) ) {
					quotesin_pagination();
				} else {
					//echo '<div id="infinite-handle" class="visible"><span>' . __( 'Older posts', 'quotesin' ) . '</span></div>';
				}
				?>
			</div>
		</div>
	</div>
<?php else : ?>
	<?php get_template_part( 'template-parts/content', 'none' ); ?>
<?php endif; ?>
<?php get_footer(); ?>
