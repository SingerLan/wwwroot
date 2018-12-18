    <?php echo get_footer_links();?>
    <footer class="site-footer">
      <div class="container">
        <!--<nav class="footer-menu">
          <ul class="nav-list u-plain-list">
		    <li class="menu-item"><a href=""></a></li>
            <li class="menu-item"><a href=""></a></li>
            <li class="menu-item"><a href=""></a></li>
          </ul>
        </nav>-->
        <div class="site-info">
          � <?php echo date('Y');?> <a href="https://loobo.me"> 大巧不工 </a> . All rights reserved  
        </div>
      </div>
    </footer>
</div>
<div class="dimmer"></div>
<?php get_sidebar(); ?>
<div class="cd-popup" role="alert">
	<div class="cd-popup-container">
		<p id="qrcode"></p>
		<div class="qrcode-tip">使用微信扫一扫分享</div>
		<a href="#0" class="cd-popup-close img-replace"></a>
	</div>
</div> 
<?php wp_footer(); ?>
</body>
<script>
var _hmt = _hmt || [];
(function() {
  var hm = document.createElement("script");
  hm.src = "https://hm.baidu.com/hm.js?ba33b9416b1edc06857e37f2190a5015";
  var s = document.getElementsByTagName("script")[0]; 
  s.parentNode.insertBefore(hm, s);
})();
</script>
</html>