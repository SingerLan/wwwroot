<?php
/**
 * @package QuotesIn
 */
?>

<div <?php post_class( 'inside item' ); ?>>
<div class="quotesingle">
	<a href="<?php the_permalink(); ?>"><?php the_post_thumbnail( 'quotesin-page', array( 'class' => 'featured-image' ) ); ?></a>

	<h2 class="quotetitle"><?php the_title(); ?></h2>

	<div class="qauthor">
<?php the_category( ' ' ); ?>
	</div>
</div>
	<div id="content">
		<?php
			wp_link_pages();
			the_content();
		?>
		<div id="topicmeta">
			<?php the_tags( __( 'Topics: ', 'quotesin' ), '  ', '' ); ?>
		</div>
		<?php quotesin_post_nav(); ?>
	</div>