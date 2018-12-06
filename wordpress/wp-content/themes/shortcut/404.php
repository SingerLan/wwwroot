<?php get_header();?>
		<div class="site-content">
			<div class="container">
				<div class="row">
					<div class="col-lg-12">
						<div class="content-area">
							<main class="site-main">
								<div class="_404">
									<div class="_404-inner">
										<h1 class="entry-title">未找到结果</h1>
										<div class="entry-content">你可以尝试搜索关键字</div>
										<form method="get" class="search-form inline" action="<?php echo esc_url( home_url( '/' ) ); ?>">
											<input type="search" class="search-field inline-field" placeholder="输入关键词..." autocomplete="off" value="" name="s" required="required">
											<button type="submit" class="search-submit"><i class="icon-search"></i></button>
										</form>
									</div>
								</div>
							</main>
						</div>
					</div>
				</div>
			</div>
		</div>
<?php get_footer();?>