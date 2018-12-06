			<footer class="footer">
				<div class="container">
					<div class="row">
						<div class="col-lg-12 col-md-12">
							<div class="footer-wrap">
								<ul class="footer-social thw-share">
									<li><a href="<?php echo barley_get_setting('social-github');?>"><i class="iconfont icon-github" aria-hidden="true"></i></a></li>
									<li><a class="openweixin weixin" title="微信"><i class="iconfont icon-weixin" aria-hidden="true"></i></a></li>
									<li><a href="<?php echo barley_get_setting('social-weibo');?>"><i class="iconfont icon-weibo" aria-hidden="true"></i></a></li>
									<li><a href="<?php echo social_link();?>"><i class="iconfont icon-qq" aria-hidden="true"></i></a></li>
								</ul>
								<div class="thw-heart">Wordpress theme  <i class="iconfont icon-liked" aria-hidden="true"></i> <a href="https://loobo.me">itheme.</a></div>
								<div class="copyright-info"><span>Copyright &copy; 2018 主题笔记. All Rights Reserved.</span></div>
							</div>
                        </div>
                    </div>
                </div>
            </footer>
         </div>
    </div>
	<div id="login" class="wnahk">
		<div id="weixinpopup" class="">
			<a class="closeweixin">
				<svg width="14.7" height="14.7" viewBox="0 0 14.7 14.7">
					<path d="M1.7.3L14.4 13a1 1 0 0 1-1.4 1.4L.3 1.7A1 1 0 1 1 1.7.3zm12.7 0a1 1 0 0 1 0 1.4L1.7 14.4A1 1 0 0 1 .3 13L13 .3a1 1 0 0 1 1.4 0z"></path>
				</svg>
			</a>
			<img class="lazy" src="<?php echo barley_get_setting('social-weixin');?>" data-original="<?php echo barley_get_setting('social-weixin');?>" alt="添加好友" >
			<p>微信扫描添加好友</p>
		</div>
	</div>
<?php wp_footer(); ?>
</body>
</html>