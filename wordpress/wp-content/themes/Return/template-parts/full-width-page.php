<?php
/*
Template Name: 全宽页面
*/
get_header();?>
<script>
document.getElementById('body').className="featured-has-media single"; 
</script>
<style>.featured-item .entry-header {max-width: 100%}</style>
<div id="featured" class="featured featured-height-full">
	<div class="featured-item">
		<div class="featured-media">
			<?php wpjam_post_thumbnail(array(1920,1280),$crop=1);?>
			<div class="featured-media-overlay">
			</div>
		</div>
		<div class="featured-caption">
			<div class="container">
				<header class="entry-header">
				<h1 class="entry-title"><?php the_title(); ?></h1>
				</header>
			</div>
		</div>
	</div>
</div>
<div id="content" class="site-content">
	<div class="container">
		<div class="row">
			<div id="primary" class="col-md-12 content-area">
				<main id="main" class="site-main">
				<article>
				<div class="entry-content">
				<?php while( have_posts() ): the_post(); $p_id = get_the_ID(); ?>
					<?php the_content(); ?>
				<?php endwhile; ?>
				</div>
				<footer class="entry-footer">
				<div class="entry-footer-meta">
					<span class="tags-links">
					<?php the_tags('', ' ', ''); ?>
					</span>
				</div>
				</footer>
				</article>
				</main>
			</div>
		</div>
	</div>
</div>
<?php get_footer();?>