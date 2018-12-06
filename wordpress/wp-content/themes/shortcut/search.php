<?php
get_header();?>
		<div class="search-bar">
			<h1 class="term-title"><?php global $wp_query; echo '搜索到 ' . $wp_query->found_posts . ' 篇相关的文章';?></h1>
		</div>
		<div class="site-content">
			<div class="content-area">
				<main class="site-main">
	 				<div class="section module_post_grid">
	 					<div class="container">
							<div class="module grid u-module-margin">
								<div class="row">
								<?php if ( have_posts() ) : while ( have_posts() ) :the_post();
									get_template_part( 'content', get_post_format() );
								endwhile;?>
            					</div>
								<div class="numeric-pagination">
									<ul class="page-numbers">
										<?php echo paginate_links(array('prev_text'=> '<i class="icon-navigate_before"></i>','next_text'=> '<i class="icon-navigate_next"></i>',) ); ?>
									</ul>
								</div>
								<?php  endif; ?>
          					</div>
          				</div>
          			</div>
				</main>
			</div>
		</div>
<?php get_footer();?>
