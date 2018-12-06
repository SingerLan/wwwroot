<?php get_header();?>
			<div class="main-container">
                  <div class="container">
                        <div class="row">
                              <div class="col-lg-12 col-md-12">
									<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
									
                                    <div id="post-<?php the_ID(); ?>" class="post-single">
                                        <?php echo single_posts_head();if ( has_post_thumbnail() ) { ?> 
                                          <div class="featured-image">
                                                <img src="<?php echo zb_get_background_image($post->ID);?>" data-original="<?php echo zb_get_background_image($post->ID);?>" class="img-fluid" alt="<?php the_title(); ?>">
                                          </div>
										  <?php } ?>

                                          <div class="entry-content">
                                               <?php the_content(); ?> 
                                          </div>
                                    </div>
                                    <div class="post-footer clearfix">
                                          <?php barley_tags();?>
                                          <?php echo post_share();?>
                                    </div>
									<?php endwhile; endif; ?>

								<?php 	
								$prev_post = get_previous_post(false,'');
								$next_post = get_next_post(false,'');?>
                            
								<nav class="post-navigation thw-sept">
									<?php if(!empty( $prev_post )): ?>
                                    <div class="post-previous">
                                          <a href="<?php echo get_permalink( $prev_post->ID ); ?>" title="<?php echo $prev_post->post_title; ?>">
                                          <span><i class="iconfont icon-left"></i>Previous Post</span>
                                          <h4><?php echo $prev_post->post_title; ?></h4>
                                          </a>
                                    </div>
									<?php endif;if(!empty( $next_post )): ?>
                                    <div class="post-next">
                                          <a href="<?php echo get_permalink( $next_post->ID ); ?>" title="<?php echo $next_post->post_title; ?>">
                                          <span>Next Post <i class="iconfont icon-right"></i></span>
                                          <h4><?php echo $next_post->post_title; ?></h4>
                                          </a>
                                    </div>
									<?php endif;?>									
								</nav>
								<?php if ( comments_open() || get_comments_number() ) :
									comments_template();
									endif;
								?>
                             
                              </div>
                        </div>
                  </div>
            </div>
<?php get_footer();?>