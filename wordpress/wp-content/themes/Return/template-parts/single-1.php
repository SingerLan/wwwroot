<div id="content" class="site-content">
	<div class="container">
		<div class="row">
			<div id="primary" class="col-md-8 content-area">
				<main id="main" class="site-main">
				<article>
				<header class="entry-header">
				<h1 class="entry-title"><?php the_title(); ?></h1>
				<div class="entry-header-meta">
					<?php if( wpjam_get_setting('wpjam_theme', 'single_category') ) : ?>
					<span class="cat-links">
					<?php  
						$category = get_the_category();
						if($category[0]){
						echo '<a href="'.get_category_link($category[0]->term_id ).'">'.$category[0]->cat_name.'</a>';
						};
					?>
					</span>
					<?php endif; ?>
					<?php if( wpjam_get_setting('wpjam_theme', 'list_time') ) : ?><span class="posted-on"><?php the_time('Y-m-d') ?></span><?php endif; ?>
					<?php if( wpjam_get_setting('wpjam_theme', 'single_read') ) : ?><span class="posted-on"><?php wpjam_theme_post_views('',''); ?> 次浏览</span><?php endif; ?>
					<?php if( wpjam_get_setting('wpjam_theme', 'single_comment') ) : ?><span class="posted-on"><?php comments_popup_link ('0 条评论','1 条评论','% 条评论'); ?></span><?php endif; ?>
					<?php edit_post_link('[编辑文章]'); ?>
				</div>
				</header>
				<div class="entry-content">
				<?php while( have_posts() ): the_post(); $p_id = get_the_ID(); ?>
					<?php the_content(); wpjam_theme_post_pages('before=<div class="nav-links xintheme">&after=&next_or_number=next&previouspagelink=上一页&nextpagelink=');  wpjam_theme_post_pages('before=&after='); wpjam_theme_post_pages('before=&after=</div>&next_or_number=next&previouspagelink=&nextpagelink=下一页'); ?>
				<?php endwhile; ?>
				</div>
				<footer class="entry-footer">
				<div class="entry-footer-meta">
					<span class="tags-links">
					<?php the_tags('', ' ', ''); ?>
					</span>
				</div>
				<?php if( wpjam_get_setting('wpjam_theme', 'single_share') ) : ?>
				<div class="fxxxxx">
					<ul class="social bdsharebuttonbox">
						<li><a class="weibo" rel="nofollow" target="_blank" href="https://service.weibo.com/share/share.php?url=<?php the_permalink(); ?>&amp;type=button&amp;language=zh_cn&amp;title=<?php the_title_attribute(); ?>&amp;pic=<?php the_post_thumbnail_url(); ?>&amp;searchPic=true"><i class="fa fa-weibo"></i></a></li>
						<li><a data-module="miPopup" data-selector="#post_qrcode" class="weixin" rel="nofollow" href="javascript:;"><i class="fa fa-weixin"></i></a></li>
						<li><a class="qq" rel="nofollow" target="_blank" href="https://connect.qq.com/widget/shareqq/index.html?url=<?php the_permalink(); ?>&amp;title=<?php the_title_attribute(); ?>&amp;pics=<?php the_post_thumbnail_url(); ?>&amp;summary=<?php echo mb_strimwidth(strip_tags(apply_filters('the_content', $post->post_content)), 0, 200,"……"); ?>"><i class="fa fa-qq"></i></a></li>
						<?php wpjam_theme_postlike();?>
					</ul>
					<div class="dialog-xintheme" id="post_qrcode">
						<div class="dialog-content dialog-wechat-content">
							<p>
								微信扫一扫,分享到朋友圈
							</p>
							<img src="https://bshare.optimix.asia/barCode?site=weixin&url=<?php the_permalink(); ?>" alt="<?php the_title_attribute(); ?>">
							<div class="btn-close">
								<i class="icon icon-close"></i>
							</div>
						</div>
					</div>
				</div>
				<?php endif; ?>
				<?php include( 'single-ad.php' );?>
				</footer>
				</article>
				<nav class="navigation post-navigation">
				<div class="nav-links">
				<?php
					$prev_post = get_previous_post();
					if(!empty($prev_post)):?>
					<div class="nav-previous">
						<a href="<?php echo get_permalink($prev_post->ID);?>" rel="prev">
						<span class="nav-link-thumbnail"><img src="<?php echo wpjam_get_post_thumbnail_src($prev_post, '160x160'); ?>" alt="<?php echo $prev_post->post_title;?>"></span>
						<span class="nav-link-meta">
						<span class="meta-nav" aria-hidden="true">上一篇</span>
						<span class="post-title"><?php echo $prev_post->post_title;?></span>
						</span>
						</a>
					</div>
				<?php endif;?>
				<?php
					$next_post = get_next_post();
					if(!empty($next_post)):?>
					<div class="nav-next">
						<a href="<?php echo get_permalink($next_post->ID);?>" rel="next">
						<span class="nav-link-meta">
						<span class="meta-nav" aria-hidden="true">下一篇</span>
						<span class="post-title"><?php echo $next_post->post_title;?></span>
						</span>
						<span class="nav-link-thumbnail"><img src="<?php echo wpjam_get_post_thumbnail_src($next_post, '160x160'); ?>" alt="<?php echo $next_post->post_title;?>"></span>
						</a>
					</div>
				<?php endif;?>
				</div>
				</nav>
				<?php if( wpjam_get_setting('wpjam_theme', 'xintheme_author') ) : ?>
				<div class="author-info">
					<div class="author-avatar">
						<?php echo get_avatar( get_the_author_meta('email'), '150' );?>
					</div>
					<div class="author-description">
						<h2 class="author-title">
						<a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ) ) ?>" title="<?php echo get_the_author() ?>" rel="author"><?php echo get_the_author() ?></a>
						</h2>
						<p class="author-bio">
							<?php if(get_the_author_meta('description')){ echo the_author_meta( 'description' );}else{echo'我还没有学会写个人说明！'; }?>
						</p>
					</div>
				</div>
				<?php endif; ?>
				<?php if( wpjam_get_setting('wpjam_theme', 'xintheme_relevant') ) : include( 'related.php' ); endif; ?>
				<?php comments_template( '', true ); ?>
				</main>
			</div>
			<?php get_sidebar();?>
			<?php if( wpjam_get_setting('wpjam_theme', 'xintheme_new2') ) : include( 'latest-posts.php' ); endif; ?>
		</div>
	</div>
</div>