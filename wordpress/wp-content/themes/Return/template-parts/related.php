<section class="related-posts-section">
<div class="related-posts-title">
	<h3>相关推荐</h3>
</div>
<div class="related-posts">
	<?php
    $post_num = 3;
    $exclude_id = $post->ID;
    $posttags = get_the_tags(); $i = 0;
    if ( $posttags ) {
	$tags = ''; foreach ( $posttags as $tag ) $tags .= $tag->term_id . ',';
	$args = array(
	'post_status' => 'publish',
	'tag__in' => explode(',', $tags),
	'post__not_in' => explode(',', $exclude_id),
	'ignore_sticky_posts' => 1,
	'orderby' => 'comment_date',
    'posts_per_page' => $post_num
    );
	query_posts($args);
	while( have_posts() ) { the_post(); ?>
	<div class="related-posts-item">
		<article class="post-item has-post-thumbnail">
		<div class="post-item-media">
			<a class="post-item-thumbnail" href="<?php the_permalink(); ?>" aria-hidden="true">
				<?php wpjam_post_thumbnail(array(150,150),$crop=1);?>
			</a>
		</div>
		<div class="post-item-caption">
			<header class="post-item-header">
			<div class="post-item-header-meta">
			<span class="cat-links">
			<?php  
				$category = get_the_category();
				if($category[0]){
				echo '<a href="'.get_category_link($category[0]->term_id ).'">'.$category[0]->cat_name.'</a>';
				};
			?>
			</span>
			<span class="posted-on">
				<a href="<?php the_permalink(); ?>" rel="bookmark">
					<time class="entry-date published" datetime="<?php the_time('Y-m-d h:m:s') ?>"><?php the_time('Y-m-d') ?></time>
				</a>
			</span>	
			</div>
			<h2 class="post-item-title"><a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a></h2>
			</header>
		</div>
		</article>
	</div>
	<?php
	$exclude_id .= ',' . $post->ID; $i ++;
    } wp_reset_query();
    }
    if ( $i < $post_num ) {
	$cats = ''; foreach ( get_the_category() as $cat ) $cats .= $cat->cat_ID . ',';
	$args = array(
	'category__in' => explode(',', $cats),
	'post__not_in' => explode(',', $exclude_id),
	'ignore_sticky_posts' => 1,
	'orderby' => 'comment_date',
	'posts_per_page' => $post_num - $i
    );
	query_posts($args);
	while( have_posts() ) { the_post(); ?>
	<div class="related-posts-item">
		<article class="post-item has-post-thumbnail">
		<div class="post-item-media">
			<a class="post-item-thumbnail" href="<?php the_permalink(); ?>" aria-hidden="true">
				<?php wpjam_post_thumbnail(array(150,150),$crop=1);?>
			</a>
		</div>
		<div class="post-item-caption">
			<header class="post-item-header">
			<div class="post-item-header-meta">
			<span class="cat-links">
			<?php  
				$category = get_the_category();
				if($category[0]){
				echo '<a href="'.get_category_link($category[0]->term_id ).'">'.$category[0]->cat_name.'</a>';
				};
			?>
			</span>
			<span class="posted-on">
				<a href="<?php the_permalink(); ?>" rel="bookmark">
					<time class="entry-date published" datetime="<?php the_time('Y-m-d h:m:s') ?>"><?php the_time('Y-m-d') ?></time>
				</a>
			</span>	
			</div>
			<h2 class="post-item-title"><a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a></h2>
			</header>
		</div>
		</article>
	</div>
	<?php $i++;
	} wp_reset_query();
    }
    if ( $i  == 0 )  echo '<h2 class="post-item-title">暂无相关文章!</h2>';
    ?>
</div>
</section>