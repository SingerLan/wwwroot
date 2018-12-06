<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>" />
<meta name="viewport" content="width=device-width, initial-scale=1">
<title><?php $sep = barley_get_setting('title_sep') ? barley_get_setting('title_sep') : '-';
        wp_title( $sep, true, 'right' ); ?></title>
<?php if ( is_singular() ) wp_enqueue_script( 'comment-reply' ); wp_head(); ?>
</head>
<body <?php body_class(); ?>>
	<div class="site">
		<header class="site-header">
			<div class="container">
				<div class="navbar">
					<div class="logo-wrapper">
						<a class="logo text" href="<?php echo home_url( '/' ); ?>"><?php $logo =  barley_get_setting('logo') ? '<img src="'. barley_get_setting('logo') .'">' : 'Shortcut';  echo $logo;?></a>
						
					</div>       
					<div class="sep"></div>
					<nav class="main-menu hidden-xs hidden-sm hidden-md">
						<?php wp_nav_menu( array('theme_location' => 'main', 'menu_class' => 'nav-list u-plain-list' ) ); ?>
					</nav>
					<div class="main-search">
						<form method="get" class="search-form inline" action="<?php echo esc_url( home_url( '/' ) ); ?>">
                            <input type="search" class="search-field inline-field" placeholder="输入关键词搜索..." autocomplete="off" value="" name="s" required="required">
                            <button type="submit" class="search-submit"><i class="icon-search"></i></button>
                        </form>        
						<div class="search-close navbar-button"><i class="icon-close"></i></div>
                    </div>
					<div class="actions">
						<div class="search-open navbar-button"><i class="icon-search"></i></div>
						<div class="burger"></div>
					</div>
				</div>
			</div>
		</header>
		<div class="header-gap"></div>