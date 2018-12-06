<?php get_header();if(have_posts()) : while (have_posts()) : the_post();?>
			<div class="thw-title-wrap">
				<div class="container">
					<div class="row">
						<div class="col-lg-12">
							<h2 class="entry-single-title"><?php the_title();?></h2>
						</div>
					</div>
				</div>
			</div>
			<div class="main-container">
				<div class="container">
					<div class="row">
						<div class="col-lg-12 col-md-12 col-sm-12">
							<div class="page">
								<?php if ( has_post_thumbnail() ) { ?> 
								<div class="thw-featured-image">
									<img src="<?php echo zb_get_background_image($post->ID);?>" data-original="<?php echo zb_get_background_image($post->ID);?>" class="lazy img-fluid" alt="<?php the_title(); ?>">
								</div>
								<?php } ?>
								<div class="thw-page-content">
									<?php the_content(); ?> 
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
<?php endwhile; endif;get_footer();?>