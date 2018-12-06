							<div class="col-sm-6 col-md-4 col-lg-3">
								<article <?php post_class( 'post' ); ?>>

									<div class="entry-media">
										<div class="placeholder" style="padding-bottom: 66.75%;">
											<a href="<?php the_permalink();?>">
												<img class="lazyload" data-srcset="<?php echo zb_get_background_image($post->ID,270,180);?>" data-sizes="auto" src="data:image/gif;base64,R0lGODlhAQABAAAAACH5BAEKAAEALAAAAAABAAEAAAICTAEAOw==" alt="<?php the_title();?>">
											</a>
										</div>
										<div class="entry-format">
											<?php echo the_article_icon();?>
										</div>
									</div>

									<header class="entry-header">    
										<h2 class="entry-title">
											<a href="<?php the_permalink();?>" rel="bookmark"><?php the_title();?></a>
										</h2>  
									</header>              
									<div class="entry-excerpt u-text-format">
										<?php echo mb_strimwidth(strip_shortcodes(strip_tags(apply_filters('the_content', $post->post_content))), 0, 90,"...");?>      
									</div>
									<div class="entry-footer">
										<a href="<?php the_permalink();?>">
											<time itemprop="datePublished" datetime="<?php echo get_the_date( 'c' );?>"><?php echo get_the_date('M d,Y');?></time>
										</a>
									</div>            
								</article>
							</div>