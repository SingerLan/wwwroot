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
				<div class="row content-grid content-grid-2">
				<?php
					if ( is_home() ) {
					$args = array(
					'caller_get_posts' => 1,
					'paged' => $paged
					);
					query_posts($args);}
					if ( have_posts() ) :
					$i = 1;
					while ( have_posts() ) : the_post(); ?>
						<?php if ( 1 === $i ) : ?>
							<?php get_template_part( 'template-parts/excerpt/list3', 'big'); ?>
						<?php elseif ( 6 === $i ) : ?>
							<?php get_template_part( 'template-parts/excerpt/list3', 'big'); ?>
						<?php else : ?>
							<?php get_template_part( 'template-parts/excerpt/list3', get_post_format()); ?>
						<?php endif; ?>

				<?php $i++; endwhile;endif; ?>
				</div>
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