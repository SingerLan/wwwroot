<div id="content" class="site-content">
	<div class="container">
		<div class="row">
			<div id="primary" class="col-md-8 content-area">
				<main id="main" class="site-main">
				<?php if ( is_category() ) { ?>
				<header class="page-header">
					<h1 class="page-title"><?php $thiscat = get_category($cat); echo $thiscat ->name;?></h1>
				</header>
				<?php } ?>
				<?php if ( is_search() ) { ?>
				<header class="page-header">
					<h1 class="page-title">“<?php echo $s; ?>” 的搜索结果</h1>
				</header>
				<?php } ?>
				<?php if ( is_author() ) { ?>
				<header class="page-header">
					<h1 class="page-title">作者：<?php echo get_the_author() ?></h1>
					<div class="taxonomy-description"><?php if(get_the_author_meta('description')){ echo the_author_meta( 'description' );}else{echo'我还没有学会写个人说明！'; }?></div>
				</header>
				<?php } ?>
				<?php if ( is_tag() ) { ?>
				<header class="page-header">
					<h1 class="page-title">标签：<?php single_cat_title(); ?></h1>
				</header>
				<?php } ?>
				<?php
					if ( is_home() ) {
					$args = array(
					'ignore_sticky_posts' => 1,
					'paged' => $paged
					);	
					query_posts($args);}
				if ( have_posts() ) : ?>
				<?php while(have_posts()) : the_post(); ?>
				<article><a class="post-thumbnail" href="<?php the_permalink(); ?>" aria-hidden="true">
				<?php wpjam_post_thumbnail(array(1920,1280),$crop=1);?>
				</a>
				<header class="entry-header">
				<h2 class="entry-title"><a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a></h2>
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
				</header>
				<div class="entry-content">
					<p>
					<?php
						$meta_data = get_post_meta($post->ID, 'post_abstract', true);
						$post_abstract = isset($meta_data) ?$meta_data : '';
						if(!empty($post_abstract)){
							echo $post_abstract;
						}else{
							echo mb_strimwidth(strip_tags(apply_filters('the_content', $post->post_content)), 0, 160,"……");
						}
					?>
					</p>
					<p>
						<a href="<?php the_permalink(); ?>" class="more-link">阅读更多</a>
					</p>
				</div>
				</article>
				<?php endwhile; endif ;?>
				<?php wp_reset_query(); ?>
				<nav class="navigation pagination" role="navigation">
				<div class="nav-links">
					<?php wpjam_theme_pagenavi();?>
				</div>
				</nav>
				</main>
			</div>
			<?php get_sidebar();?>
		</div>
	</div>
</div>