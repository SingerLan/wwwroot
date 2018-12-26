<!DOCTYPE html>
<html lang="zh-cmn-Hans">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title><?php
// Print the <title> tag based on what is being viewed.
global $page, $paged;
wp_title( '|', true, 'right' );
// Add the blog name.
bloginfo( 'name' );
// Add the blog description for the home/front page.
$site_description = get_bloginfo( 'description', 'display' );
if ( $site_description && ( is_home() || is_front_page() ) ) {
	echo " | $site_description";
}
// Add a page number if necessary:
if ( ( $paged >= 2 || $page >= 2 ) && ! is_404() ) {
	echo esc_html( ' | ' . sprintf( __( 'Page %s', 'xintheme' ), max( $paged, $page ) ) );
}
?></title>
<?php if( wpjam_get_setting('wpjam_theme', 'favicon') ) { ?>
<link rel="shortcut icon" href="<?php echo wpjam_get_setting('wpjam_theme', 'favicon');?>"/>
<?php }else{ ?>
<link rel="shortcut icon" href="<?php bloginfo('template_url');?>/static/images/favicon.ico"/>
<?php }?>
<?php wp_head(); ?>
<!--[if lt IE 10]>
<link rel='stylesheet' href='<?php bloginfo('template_url');?>/static/css/ie.css' type='text/css' media='all'/>
<![endif]-->
</head>
<body id="body" <?php if(is_home()&&!is_paged()){ ?><?php body_class('featured-has-media'); ?><?php } ?>>
<div id="page" class="site">
	<header id="masthead" class="site-header">
	<div class="container">
		<div class="site-header-wrapper">
			<div class="site-branding">
				<?php if( wpjam_get_setting('wpjam_theme', 'logo') ) { ?>
				<h1 class="site-title"><a href="<?php bloginfo('url'); ?>" rel="home" style="padding: 0;"><img src="<?php echo wpjam_get_setting('wpjam_theme', 'logo');?>"></a></h1>
				<?php }else{ ?>
				<h1 class="site-title"><a href="<?php bloginfo('url'); ?>" rel="home"><?php bloginfo('name'); ?></a></h1>
				<?php }?>
			</div>
			<button id="menu-toggle" class="menu-toggle">
			<span class="screen-reader-text">Menu</span>
			<span class="icon-bar"></span>
			<span class="icon-bar"></span>
			<span class="icon-bar"></span>
			</button>
			<div id="site-header-menu" class="site-header-menu">
				<nav id="main-navigation" class="main-navigation" aria-label="Primary Menu">
				<div class="menu-main-menu-container">
					<ul id="menu-main-menu" class="primary-menu">
						<?php if(function_exists('wp_nav_menu')) wp_nav_menu(array('container' => false, 'items_wrap' => '%3$s', 'theme_location' => 'main')); ?>
					</ul>
				</div>
				</nav>
				<nav id="additional-navigation" class="additional-navigation" aria-label="Additional Menu">
				<ul class="secondary-menu">
					<li class="menu-item">
					<button id="button-search" class="button-search" type="button"><span class="screen-reader-text">Search</span></button>
					</li>
				</ul>
				</nav>
			</div>
		</div>
	</div>
	</header>
<?php if(is_home()&&!is_paged()){ ?>
<div id="featured" class="featured featured-height-full">
	<div id="featured-carousel" class="featured-carousel">
		<?php  
			$sticky = get_option('sticky_posts');  
			rsort( $sticky );  
			$sticky = array_slice( $sticky, 0, 5);   
			query_posts( array( 'post__in' => $sticky, 'ignore_sticky_posts'=>5, 'posts_per_page'=>5) );
			if (have_posts()) :  
			while (have_posts()) : the_post();  
		?>  
		<div class="featured-item">
			<div class="featured-media">
				<a href="<?php the_permalink(); ?>" aria-hidden="true">
				<?php wpjam_post_thumbnail(array(1920,1280),$crop=1);?>
				<div class="featured-media-overlay">
				</div>
				</a>
			</div>
			<div class="featured-caption">
				<div class="container">
					<div class="entry-header">
						<div class="entry-header-meta">
							<span class="cat-links">
								<?php  
									if( !is_category() ) {
									$category = get_the_category();
									if($category[0]){
									echo '<a href="'.get_category_link($category[0]->term_id ).'">'.$category[0]->cat_name.'</a>';
									}
									};
								?>
							</span>
							<?php if( wpjam_get_setting('wpjam_theme', 'list_time') ) : ?>
							<span class="posted-on">
								<a href="<?php the_permalink(); ?>" rel="bookmark">
									<time class="entry-date published" datetime="<?php the_time('Y-m-d h:m:s') ?>"><?php the_time('Y-m-d') ?></time>
								</a>
							</span>
							<?php endif; ?>
						</div>
						<h2 class="entry-title"><a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a></h2>
					</div>
				</div>
			</div>
		</div>
		<?php endwhile; endif; wp_reset_query();?> 
	</div>
</div>
<script type='text/javascript' src='<?php bloginfo('template_directory'); ?>/static/js/init-carousel-1.js'></script>
<?php } ?>