<?php get_header();?>
<div class="site-content">
	<div class="content-area">
		<main class="site-main">
		<?php while (have_posts()) : the_post(); ?>
			<article <?php post_class( 'page' ); ?>>
				<div class="container small">
					<header class="entry-header">    
						<h1 class="entry-title"><?php the_title(); ?></h1>
					</header>  
					<h2 class="entry-subheading"></h2>
				</div>
				<div class="container medium"></div>
				<div class="container small">
					<div class="entry-wrapper">
						<div class="entry-content u-text-format u-clearfix">
							<?php the_content(); ?>
						</div>
					</div>
				</div>
			</article>
		<?php endwhile;?>
		</main>
	</div>
</div>
<?php if ( comments_open() || get_comments_number() ) :
            comments_template();
              endif;
        ?>
<?php get_footer();?>