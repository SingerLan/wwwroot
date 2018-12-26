<div class="col-xs-12 col-sm-6 col-md-4 masonry-item js-masonry-item">
	<article class="post-item has-post-thumbnail">
	<div class="post-item-media">
		<a class="post-item-thumbnail" href="<?php the_permalink(); ?>" aria-hidden="true">
			<?php wpjam_post_thumbnail(array(150,150),$crop=1);?>
		</a>
	</div>
	<div class="post-item-caption">
		<header class="post-item-header">
		<div class="post-card-header-meta">
			<span class="cat-links">
			<?php  
				$category = get_the_category();
				if($category[0]){
				echo '<a href="'.get_category_link($category[0]->term_id ).'">'.$category[0]->cat_name.'</a>';
				};
			?>
			</span>
			<?php if( wpjam_get_setting('wpjam_theme', 'list_time') ) : ?><span class="posted-on"><?php the_time('Y-m-d') ?></span><?php endif; ?>
			<?php if( wpjam_get_setting('wpjam_theme', 'list_read') ) : ?><span class="posted-on"><?php wpjam_theme_post_views('',''); ?> 次浏览</span><?php endif; ?>
		</div>
		<h2 class="post-item-title"><a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a></h2>
		</header>
	</div>
	</article>
</div>