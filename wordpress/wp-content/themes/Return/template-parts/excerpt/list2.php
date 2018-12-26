<?php if( has_post_format( 'aside' ) ){ //小图?>
<div class="col-sm-6 col-md-4 grid-item">
	<article class="post-card has-post-thumbnail">
	<div class="post-card-media">
		<a class="post-card-thumbnail" href="<?php the_permalink(); ?>" aria-hidden="true">
			<?php wpjam_post_thumbnail(array(768,512),$crop=1);?>
		</a>
	</div>
	<div class="post-card-caption">
		<header class="post-card-header">
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
		<h2 class="post-card-title"><a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a></h2>
		</header>
		<div class="post-card-content">
			<?php echo mb_strimwidth(strip_tags(apply_filters('the_content', $post->post_content)), 0, 130,"……"); ?>
		</div>
	</div>
	</article>
</div>
<?php } else if ( has_post_format( 'gallery' )) { //特色 ?>
<div class="col-sm-6 col-md-4 grid-item">
	<article class="post-card has-post-thumbnail post-card-image">
	<div class="post-card-media">
		<a class="post-card-thumbnail" href="<?php the_permalink(); ?>" aria-hidden="true">
			<?php wpjam_post_thumbnail(array(830,553),$crop=1);?>
		</a>
	</div>
	<div class="post-card-caption">
		<header class="post-card-header">
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
		<h2 class="post-card-title"><a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a></h2>
		</header>
	</div>
	</article>
</div>
<?php } else{ //标准 ?>
<div class="col-sm-6 col-md-4 grid-item">
	<article class="post-card has-post-thumbnail">
	<div class="post-card-media">
		<a class="post-card-thumbnail" href="<?php the_permalink(); ?>" aria-hidden="true">
			<?php wpjam_post_thumbnail(array(768,512),$crop=1);?>
		</a>
	</div>
	<div class="post-card-caption">
		<header class="post-card-header">
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
		<h2 class="post-card-title"><a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a></h2>
		</header>
		<div class="post-card-content">
		<?php
			$meta_data = get_post_meta($post->ID, 'post_abstract', true);
			$post_abstract = isset($meta_data) ?$meta_data : '';
			if(!empty($post_abstract)){
				echo $post_abstract;
			}else{
				echo mb_strimwidth(strip_tags(apply_filters('the_content', $post->post_content)), 0, 130,"……");
			}
		?>
		</div>
	</div>
	</article>
</div>
<?php } ?>