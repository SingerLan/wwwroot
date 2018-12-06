<?php
/**
 * Template part for displaying page content in page.php
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package QuotesIn
 */

?>

<div <?php post_class( 'inside item' ); ?>>
	<div class="quotesingle">
		<a href="<?php the_permalink(); ?>"><?php the_post_thumbnail( 'quotesin-page', array( 'class' => 'featured-image' ) ); ?></a>

		<h2 class="quotetitle"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
		<div class="qauthor">
		<?php the_category( ' ' ); ?>
		</div>
	</div>
	<div id="content">
		<?php
			wp_link_pages();
			the_content();
		?>
	</div>