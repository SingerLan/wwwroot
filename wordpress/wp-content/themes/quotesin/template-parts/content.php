<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package QuotesIn
 */

?>
<div <?php post_class( 'item' ); ?>>
<div class="quotecolor" style="background-color: <?php quotesin_random_color(); ?>;"></div>

<div class="quotebox">
	<h2 class="quotetitle"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>

	<div class="qauthor">
	<?php the_category( ' ' ); ?>
	</div>
</div>
	<div class="qtopic">
		<?php the_tags( __( 'Topics: ', 'quotesin' ), ', ', '<br/>' ); ?>
	</div>
	<?php the_excerpt(); ?>
</div><!--End Post -->
