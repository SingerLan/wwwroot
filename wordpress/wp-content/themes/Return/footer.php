	<footer id="colophon" class="site-footer">
	<div class="container">
		<?php if( wpjam_get_setting('wpjam_theme', 'foot_tools') ) : ?>
		<aside id="footer-widgets" class="site-footer-widgets">
		<div class="widget-area">
			<section id="text-2" class="widget widget_text">
			<h2 class="widget-title">热门标签</h2>
			<div class="textwidget tag">
			<?php 
				$tag_num = wpjam_get_setting('wpjam_theme', 'footer_tag_num'); 
				$args = array('orderby'=>'count','order'=>'DESC','number'=>$tag_num);
				$tags_list = get_tags($args);
				if ($tags_list) { 
					foreach($tags_list as $tag) {
						echo '<li><a class="tagname" href="'.get_tag_link($tag).'">'. $tag->name .'</a><strong>x '. $tag->count .'</strong></li>'; 
					} 
				} 
			?>
			</div>
			</section><section id="recent-posts-2" class="widget widget_recent_entries">
			<h2 class="widget-title">热评文章</h2>
			<ul>
				<?php
					$post_num = 3; 
					$args = array(
					'post_password' => '',
					'post_status' => 'publish', 
					'post__not_in' => array($post->ID),
					'ignore_sticky_posts' => 1, 
					'orderby' => 'comment_count', 
					'posts_per_page' => $post_num
					);
					$query_posts = new WP_Query();
					$query_posts->query($args);
				while( $query_posts->have_posts() ) { $query_posts->the_post(); ?>
				<li>
				<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
				<span class="post-date"><?php the_time('Y-m-d') ?></span>
				</li>
					<?php } wp_reset_query();?>
			</ul>
			</section><section id="recent-comments-2" class="widget widget_recent_comments">
			<h2 class="widget-title">最新评论</h2>
			<ul id="recentcomments">
				<?php
					$comments = get_comments('status=approve&number=3&order=Desc');
					foreach($comments as $comment) :
					$output =  '<li class="recentcomments"><span class="comment-author-link">' .get_comment_author().'</span>  <a href="' . esc_url( get_comment_link($comment->comment_ID) ) . '">' . $comment->comment_content . '</a></li>';
					echo $output;
				endforeach;?>
			</ul>
			</section>
		</div>
		</aside>
		<?php endif; ?>
		<div class="site-footer-info">
			<div class="footer-info-wrapper">
				<nav class="footer-navigation" aria-label="Secondary Menu">
				<div class="menu-footer-menu-container">
					<?php if( wpjam_get_setting('wpjam_theme', 'foot_menu') ) : ?>
					<ul id="menu-footer-menu" class="foot-menu secondary-menu">
						<?php if(function_exists('wp_nav_menu')) wp_nav_menu(array('container' => false, 'items_wrap' => '%3$s', 'theme_location' => 'foot')); ?>
					</ul>
					<?php endif; ?>
					<?php if( wpjam_get_setting('wpjam_theme', 'foot_link') ) : ?>
					<ul id="menu-footer-menu" class="secondary-menu">
						<li style="color: #c2c2c7;font-size: 14px;line-height: 1.4;">友情链接：</li><?php wp_list_bookmarks('title_li=&categorize=0&orderby=rand&limit=24'); ?>
					</ul>
					<?php endif; ?>
				</div>
				</nav>
				<span class="copyright">
					Copyright <?php the_time('Y') ?>. All rights reserved. <a rel="nofollow" target="_blank" href="http://www.miibeian.gov.cn/"><?php echo wpjam_get_setting('wpjam_theme', 'footer_icp');?></a> Powered by 
				<a href="http://m.lookoro.cn" target="_blank">大巧不工</a> + <a href="http://www.lookoro.cn/" target="_blank">大饼影视</a><?php if( wpjam_get_setting('wpjam_theme', 'foot_timer') ) : ?>. 页面加载时间：<?php timer_stop(1);?> 秒. <?php endif; ?><span id="runtime_span"></span>
				</span>
				<script type="text/javascript">function show_runtime(){window.setTimeout("show_runtime()",1000);X=new 
Date("12/01/2018 00:00:00");
Y=new Date();T=(Y.getTime()-X.getTime());M=24*60*60*1000;
a=T/M;A=Math.floor(a);b=(a-A)*24;B=Math.floor(b);c=(b-B)*60;C=Math.floor((b-B)*60);D=Math.floor((c-C)*60);
runtime_span.innerHTML="本站安全运行: "+A+"天"+B+"小时"+C+"分"+D+"秒"}show_runtime();</script>
			</div>
			<nav class="social-navigation" aria-label="Social Links Menu">
			<div class="menu-social-menu-container" ontouchstart>
				<ul id="menu-social-menu" class="social-links-menu">
					<?php if( wpjam_get_setting('wpjam_theme', 'footer_qq') ) : ?>
					<li><a class="qq" rel="nofollow" target="_blank" href="http://wpa.qq.com/msgrd?v=3&uin=<?php echo wpjam_get_setting('wpjam_theme', 'footer_qq'); ?>&site=qq&menu=yes"></a></li>
					<?php endif; ?>
					
					<?php if( wpjam_get_setting('wpjam_theme', 'footer_weibo') ) : ?>
					<li><a class="weibo" rel="nofollow" target="_blank" href="<?php echo wpjam_get_setting('wpjam_theme', 'footer_weibo'); ?>"></a></li>
					<?php endif; ?>
					
					<?php if( wpjam_get_setting('wpjam_theme', 'footer_weixin') ) : ?>
					<li class="wechat"><a class="weixin"></a><div class="wechatimg"><img src="<?php echo wpjam_get_setting('wpjam_theme', 'footer_weixin');?>"></div></li>
					<?php endif; ?>
					
					<?php if( wpjam_get_setting('wpjam_theme', 'footer_mail') ) : ?>
					<li><a class="mail" rel="nofollow" target="_blank" href="http://mail.qq.com/cgi-bin/qm_share?t=qm_mailme&email=<?php echo wpjam_get_setting('wpjam_theme', 'footer_mail'); ?>"></a></li>
					<?php endif; ?>
					
					<?php if( wpjam_get_setting('wpjam_theme', 'footer_facebook') ) : ?>
					<li><a class="facebook" rel="nofollow" target="_blank" href="<?php echo wpjam_get_setting('wpjam_theme', 'footer_facebook'); ?>"></a></li>
					<?php endif; ?>
					
					<?php if( wpjam_get_setting('wpjam_theme', 'footer_twitter') ) : ?>
					<li><a class="twitter" rel="nofollow" target="_blank" href="<?php echo wpjam_get_setting('wpjam_theme', 'footer_twitter'); ?>"></a></li>
					<?php endif; ?>
					
					<?php if( wpjam_get_setting('wpjam_theme', 'footer_instagram') ) : ?>
					<li><a class="instagram" rel="nofollow" target="_blank" href="<?php echo wpjam_get_setting('wpjam_theme', 'footer_instagram'); ?>"></a></li>
					<?php endif; ?>
				</ul>
			</div>
			</nav>
		</div>
	</div>
	</footer>
</div>
<a id="scroll-to-top" class="scroll-to-top" href="#"></a>
<div id="search-overlay" class="search-overlay">
	<button type="button" class="search-overlay-close" aria-label="Close"><span class="screen-reader-text">Close</span></button>
	<form role="search" method="get" class="search-form" action="<?php bloginfo('url'); ?>">
		<label>
		<input type="search" class="search-field" placeholder="Search …" value="" name="s"/>
		</label>
		<button type="submit" class="search-submit"><span class="screen-reader-text">Search</span></button>
	</form>
</div>
<script type="text/javascript">
var screenReaderText = {"expand":"expand child menu","collapse":"collapse child menu"};
<?php if( wpjam_get_setting('wpjam_theme', 'xintheme_copy') ) :?>
document.getElementById("body").onselectstart = function(){return false;};
<?php endif;?>
</script>
<?php include( 'template-parts/color.php' ); wp_footer(); ?>
</body>
</html>