<?php get_header();?>
<?php if ( have_posts() ) :?><?php while ( have_posts() ) : the_post(); ?>
<?php echo single_posts_head();?>
        <div class="site-content">
          <div class="container">
		    <div class="row">
              <div class="col-lg-12">
				<div class="content-area">
                  <main class="site-main">
					<article <?php post_class( 'post' ); ?>>
                    <div class="container small">
                        <div class="entry-wrapper">
                          <div class="entry-content u-text-format u-clearfix">
                            <?php the_content(); ?>
                          </div>
                          <div class="entry-action">
                            <?php echo post_share();?>
                          </div>
                          
            				<?php 	
            				$next_class = '';
            				$prev_class = '';
            				$prev_post = get_previous_post(false,'');
            				$next_post = get_next_post(false,'');
                            if(!empty( $prev_post )): ?>
							<div class="entry-navigation">
                            <img class="jarallax-img lazyload" data-srcset="<?php echo zb_get_background_image($prev_post->ID);?>" data-sizes="auto" alt="<?php echo $prev_post->post_title; ?>">
                            <div class="navigation-content">
                              <span class="u-border-title">下一篇文章</span>
                              <h4 class="navigation-title"><?php echo $prev_post->post_title; ?></h4>
                            </div>
                            <a class="u-permalink" href="<?php echo get_permalink( $prev_post->ID ); ?>"></a>
							</div>
                            <?php endif;?>
                        </div>
                      </div>
                    </div>
                    </article>
                    <?php endwhile; endif; ?>
                  </main>
                </div>
              </div>
            </div>
          </div>
          <?php if(barley_get_setting('related_posts')):echo zb_related_posts();endif;?>
          <?php if ( comments_open() || get_comments_number() ) :
            comments_template();
              endif;
          ?>
        </div>
<?php get_footer();?>
