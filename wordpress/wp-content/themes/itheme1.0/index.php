<?php get_header();?>
			<section class="thw-autohr-bio-wrap">
                <div class="container">
                    <div class="row">
						<div class="col-lg-8 col-md-12">
							<div class="thw-autohr-bio">
								<h2>Hello, 欢迎来到 <strong><?php bloginfo('name'); ?></strong> </h2>
								<p>这是一段简单的描述文字，你可以自由的更改它为你想展示的文字</p>
								<div class="bio-share">
									<span>关注我</span>
									<ul class="thw-share">
										<li><a href="<?php echo barley_get_setting('social-github');?>"><i class="iconfont icon-github" aria-hidden="true"></i></a></li>
										<li><a class="openweixin weixin" title="微信"><i class="iconfont icon-weixin" aria-hidden="true"></i></a></li>
										<li><a href="<?php echo barley_get_setting('social-weibo');?>"><i class="iconfont icon-weibo" aria-hidden="true"></i></a></li>
										<li><a href="<?php echo social_link();?>"><i class="iconfont icon-qq" aria-hidden="true"></i></a></li>
									</ul>
								</div>
							</div>
						</div>
						<div class="col-lg-4 col-md-12">
                            <div class="thw-autohr-bio-img">
                                <div class="thw-img-border">
									<?php if(barley_get_setting('profile')){?>
									<img class="lazy img-fluid" src="<?php echo barley_get_setting('profile');?>" data-original="<?php echo barley_get_setting('profile');?>" alt="<?php bloginfo('name');?>" />
									<?php }else{?>
									<img class="lazy img-fluid" src="<?php bloginfo('template_url')?>/static/images/index.jpg"  data-original="<?php bloginfo('template_url')?>/static/images/index.jpg" alt="<?php bloginfo('name');?>" />
									<?php }?>
                                </div>
                            </div>
                         </div>
                    </div>
                </div>
            </section>
			<div class="main-container">
                <div class="container">
                    <div class="row">
					<?php  $i= 1;if(have_posts()) : while (have_posts()) : the_post();
						if($i == 1 ){
							$col ='col-lg-8';
							$width='556';
						}else{
							$col ='col-lg-4';
							$width='265';
					}?>
                        <div class="<?php echo $col;?> col-md-12 col-sm-12">
                            <div class="post-grid">
                                <div class="post-grid-view post-grid-view-lg">
                                    <div class="post-grid-image">
										<img class="lazy img-fluid" src="<?php echo zb_get_background_image($post->ID,$width,350);?>" data-original="<?php echo zb_get_background_image($post->ID,$width,350);?>" alt="<?php the_title();?>">
                                    </div>
									<div class="post-content post-content-overlay"> 
                                        <div class="post-header"> 
                                            <span class="category-meta"><?php the_category(',')?></span>
                                            <h3 class="entry-post-title">
                                                <a href="<?php the_permalink(); ?>"><?php the_title();?></a>
                                            </h3>
                                        </div>
                                        <div class="post-meta-footer">
                                            <span class="grid-post-date">
												<?php echo get_the_date('M d,Y');?>
                                            </span>
                                            <span class="grid-post-author">
                                                <?php echo zb_post_action_button($post->ID);?> 喜欢 
												<i style="margin: 0 5px;" class="iconfont icon-views"></i><?php echo custom_the_views(get_the_ID());?> 浏览
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
					<?php $i++;endwhile;endif;?>    
                    </div>
                </div>
            </div>
			<?php echo bootstrap_paginate_links();?>
<?php get_footer();?>