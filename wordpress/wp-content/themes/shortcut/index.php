<?php
get_header();?>
		<div class="site-content">
			<div class="content-area">
				<main class="site-main">
					<?php if ( barley_get_setting('home_cate') ){?>
					<div class="section widget_magsy_module_category_boxes">
						<div class="container">
							<div class="module category-boxes owl">
								<?php get_category_posts_list();?>
							</div>
						</div>
					</div>
					<?php } ?>
	 				<div class="section module_post_grid">
	 					<div class="container">
							<h3 class="latest-title">最新文章</h3>
							<div class="module grid u-module-margin">
								<div class="row posts-wrapper">
								<?php if ( have_posts() ) :while ( have_posts() ) :the_post();
									get_template_part( 'content', get_post_format() );
								endwhile;endif;?>
            					</div>
								<div class="numeric-pagination">
									<ul class="page-numbers">
										<?php echo paginate_links(array('prev_text'=> '<i class="icon-navigate_before"></i>','next_text'=> '<i class="icon-navigate_next"></i>',) ); ?>
									</ul>
								</div>
          					</div>
          				</div>
          			</div>
				</main>
			</div>
		</div>
<?php get_footer();?>
