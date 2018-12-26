<?php
/*
Template Name: 全宽页面（无图）
*/
get_header();?>
<div id="content" class="site-content">
	<div class="container">
		<div class="row">
			<div id="primary" class="col-md-12 content-area">
				<main id="main" class="site-main">
				<article>
				<header class="entry-header">
				<h1 class="entry-title"><?php the_title(); ?></h1>
				</header>
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