<div class="off-canvas">
	<div class="canvas-close"><i class="icon-close"></i></div>
	  <div class="mobile-menu hidden-lg hidden-xl"></div>
      <aside class="widget-area">
		<div class="widget category_widget"><h5 class="widget-title">Categories | 分类</h5>
          <ul>
		  <?php $index = 1;foreach (get_categories() as $cat) : ?>
            <li class="category-item">
              <a href="<?php echo get_category_link($cat->term_id); ?>" title="<?php echo $cat->cat_name; ?>">
                <span class="category-name">
                  <i class="dot category-color-<?php echo $index ?>"></i><?php echo $cat->cat_name; ?> </span>
                <span class="category-count"><?php echo $cat->count; ?></span>
              </a>
            </li>
			<?php $index++;endforeach; ?>
          </ul> 
		</div>
		<?php if ( barley_get_setting('social_widget') ){?>
		<div class="widget social_widget"><h5 class="widget-title">关注我</h5>
			<div class="links">
				<?php if(barley_get_setting('social-weibo')){?>
				<a style="background-color: #ec3d51;" href="<?php echo barley_get_setting('social-weibo');?>" target="_blank">
					<i class="mdi icon-wb"></i>
					<span>新浪微博</span>
				</a>
				<?php }?>
				<?php if(barley_get_setting('social-qq')){?>
				<a style="background-color: #12aae8;" href="http://wpa.qq.com/msgrd?v=3&uin=<?php echo barley_get_setting('social-qq');?>&site=qq&menu=yes" target="_blank">
					<i class="mdi icon-qq"></i>
					<span>QQ</span>
				</a>
				<?php }?>
				<?php if(barley_get_setting('social-github')){?>
				<a style="background-color: #000000;" href="<?php echo barley_get_setting('social-github');?>" target="_blank">
					<i class="mdi icon-gb"></i>
					<span>Github</span>
				</a>
				<?php }?>
          </div>
		</div>
		<?php } ?>
		<?php echo get_hot_posts();?>
	</aside>
</div>