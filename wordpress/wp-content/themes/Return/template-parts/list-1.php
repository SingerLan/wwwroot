<div id="content" class="site-content">
	<div class="container">
		<div class="row">
			<div id="primary" class="col-lg-12 content-area">
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
				<div class="row">
					<div id="content-masonry" class="content-masonry content-masonry-2">
						<div class="col-xs-12 col-sm-6 col-md-4 masonry-grid-sizer">
						</div>
						<?php
							if ( is_home() ) {
							$args = array(
							'ignore_sticky_posts' => 1,
							'paged' => $paged
							);	
							query_posts($args);}
							if ( have_posts() ) : ?>
						<?php while ( have_posts() ) : the_post();?>
						<?php if( has_post_format( 'aside' )) { //小图 ?>
						<?php include( 'excerpt/list1-excerpt-aside.php' );?>
						<?php } else if ( has_post_format( 'gallery' )) { //特色 ?>
						<?php include( 'excerpt/list1-excerpt-gallery.php' );?>
						<?php } else{ //标准 ?>
						<?php include( 'excerpt/list1-excerpt.php' );?>
						<?php } ?>
						<?php endwhile; endif ;?>
					</div>
				</div>
				<nav class="navigation pagination" role="navigation">
				<div class="nav-links">
					<?php wpjam_theme_pagenavi();?>
				</div>
				</nav>
				</main>
			</div>
		</div>
	</div>
</div>