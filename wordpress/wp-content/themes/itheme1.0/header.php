<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>" />
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<title><?php $sep = barley_get_setting('title_sep') ? barley_get_setting('title_sep') : '-';
        wp_title( $sep, true, 'right' ); ?></title>
<?php if ( is_singular() ) wp_enqueue_script( 'comment-reply' ); wp_head(); ?>
</head>
<body <?php body_class(); ?>>
	<div class="inner-body-wrap">
		<div class="inner-body container">
			<header class="thw-header header-default">
				<div class="container">
					<div class="row align-items-center">
						<div class="col-md-12 col-sm-12">
							<nav class="navbar navbar-expand-lg thw-navbar-light">
								<a class="thw-logo" href="<?php echo home_url( '/' ); ?>">
									<?php if(barley_get_setting('logo')){?>
									<img src="<?php echo barley_get_setting('logo');?>" data-original="<?php echo barley_get_setting('logo');?>" alt="<?php bloginfo('name');?>" />
									<?php }else{?>
									<img src="<?php bloginfo('template_url')?>/static/images/logo.png"  data-original="<?php bloginfo('template_url')?>/static/images/logo.png" alt="<?php bloginfo('name');?>" />
									<?php }?>
								</a>
								<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                                                            aria-expanded="false" aria-label="Toggle navigation">
									<span class="thw-navbar-toggler-icon"><i class="iconfont icon-dropdown"></i></span>
                                </button>
                                <div class="collapse navbar-collapse thw-navbar" id="navbarSupportedContent">
								<?php $args = array(
									'walker' => new WP_Bootstrap_Navwalker(),
									'theme_location' => 'main',
									'menu_class' => 'navbar-nav',
									'container' => 'ul'
								);wp_nav_menu($args);?>
                                </div> 
                                <div class="search-link">
                                    <form role="search" method="get" action="<?php echo esc_url( home_url( '/' ) ); ?>">
                                        <button type="button"><i class="iconfont icon-search show"></i></button>
                                        <button><i class="iconfont icon-close"></i></button>
                                        <div class="search-box">
                                            <input type="search" name="s" id="search" placeholder="搜索...">
                                        </div>
                                    </form>
                                </div>
                            </nav>
                        </div>
                    </div>
                </div>
            </header>