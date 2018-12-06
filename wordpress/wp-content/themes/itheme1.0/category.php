<?php 
get_header();
$term = get_queried_object();if(have_posts()) : ?>
			<div class="thw-title-wrap">
				<div class="container">
					<div class="row">
						<div class="col-lg-12">
							<h2 class="entry-single-title"><span>Category: </span><?php echo $term->name;?></h2>
                        </div>
                    </div>
                </div>
            </div>
			<div class="main-container">
                <div class="container">
                    <div class="row">
					<?php while (have_posts()) : the_post();?>
                        <div class="col-lg-4 col-md-12 col-sm-12">
                            <div class="post-grid">
                                <div class="post-grid-view post-grid-view-lg">
                                    <div class="post-grid-image">
                                        <img class="img-fluid" src="<?php echo zb_get_background_image($post->ID,265,350);?>" alt="post1">
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
					<?php endwhile;?>  
                    </div>
                </div>
            </div>
			<?php endif;?>  
			<?php echo bootstrap_paginate_links();?>
<?php get_footer();?>