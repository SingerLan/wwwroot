<?php 
get_header();
$term = get_queried_object();
	$args=array(
	'cat' => $term->name,
	'posts_per_page' => 1,
	);
query_posts($args);if(have_posts()) : while (have_posts()) : the_post();?>
		<div class="term-bar lazyload visible" data-bg="<?php echo zb_get_background_image($post->ID,220,145);?>">
			<h1 class="term-title">Category: <?php echo $term->name;?></h1>
		</div>
		<?php  endwhile; endif; wp_reset_query(); ?>
		<div class="site-content">
			<div class="container">
				<div class="row">
					<div class="col-lg-12">
						<div class="content-area">
							<main class="site-main">
								<div class="row posts-wrapper indexList">
								<?php if ( have_posts() ) :while ( have_posts() ) :the_post();
									get_template_part( 'content', get_post_format() );
								endwhile;endif;?>
								</div>
								<div class="numeric-pagination">
									<ul class="page-numbers">
										<?php echo paginate_links(array('prev_text'=> '<i class="icon-navigate_before"></i>','next_text'=> '<i class="icon-navigate_next"></i>',) ); ?>
									</ul>
								</div>
							</main>
						</div>
					</div>
				</div>
			</div>
		</div>
<?php get_footer();?>