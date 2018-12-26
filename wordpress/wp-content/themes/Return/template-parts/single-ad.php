<?php if( wpjam_get_setting('wpjam_theme', 'single_ad_pc') ) { ?>
<div class="single-ad">
	<div class="mobile">
		<?php echo wpjam_get_setting('wpjam_theme', 'single_ad_mobile');?>
		<?php if( wpjam_get_setting('wpjam_theme', 'ad_tips') ) : ?><span>广告</span><?php endif; ?>
	</div>
	<div class="pc">
		<?php echo wpjam_get_setting('wpjam_theme', 'single_ad_pc');?>
		<?php if( wpjam_get_setting('wpjam_theme', 'ad_tips') ) : ?><span>广告</span><?php endif; ?>
	</div>
</div>
<?php }?>