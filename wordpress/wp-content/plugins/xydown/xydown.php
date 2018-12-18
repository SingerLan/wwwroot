<?php
/*
Plugin Name: xydown独立下载页面-我爱资源网修改版
Plugin URI: http://www.52-zyw.com/zyw-2727.html
Description: 实现wordpress独立下载页面的一款插件
Version: 1.0.2
Author:我爱资源网
Author URI: http://www.52-zyw.com
*/
global $wpdb;
define("xydown",plugin_dir_path(__FILE__));

function xydown_style() {
	echo'<link rel="stylesheet" href="'.plugin_dir_url( __FILE__ ).'css/style.css" type="text/css" />';
}
add_action('wp_head', 'xydown_style');

function xydown_show_down($content)
{
	if(is_single())
	{
		$xydown_start=get_post_meta(get_the_ID(), 'xydown_start', true);
		$xydown_name=get_post_meta(get_the_ID(), 'xydown_name', true);
		$xydown_size=get_post_meta(get_the_ID(), 'xydown_size', true);
		$xydown_date=get_post_meta(get_the_ID(), 'xydown_date', true);
		$xydown_author=get_post_meta(get_the_ID(), 'xydown_author', true);
		$xydown_downurl1=get_post_meta(get_the_ID(), 'xydown_downurl1', true);
		$xydown_downurl2=get_post_meta(get_the_ID(), 'xydown_downurl2', true);
		$xydown_downurl3=get_post_meta(get_the_ID(), 'xydown_downurl3', true);
		$xydown_yanshi=get_post_meta(get_the_ID(), 'xydown_yanshi', true);
		////资源名称、资源大小、更新时间、适用版本、作者信息
		if($xydown_yanshi)
		{
		$yanshi_content .= '<strong><a class="yanshibtn" rel="external nofollow"   href="'.site_url().'/demo.php?id='.get_the_ID().'" target="_blank" title="'.$xydown_name.' ">查看演示</a></strong>';
		
		}
		if($xydown_start)
		{
			$content .= '<br />';
			$content .= '
			<div class="paydown" id="paydown"><div class="down-title"><br>附<br>件<br>下<br>载</div><div class="down-detail"><p class="down-price">文件名称：<span>'.$xydown_name.'</span></p><p class="down-ordinary">更新日期：'.$xydown_date.'</p>
			<p class="down-vip">作者信息：'.$xydown_author.'</p><p class="down-tip">提示：下载后请检查MD5值，欢迎捐赠本站以及广告合作！</p><p class="down-tip">下载地址：<strong><a class="downbtn" rel="external nofollow" title="'.$xydown_name.'" href="'.site_url().'/download.php?id='.get_the_ID().'"  target="_blank">点击下载</a></strong> '.$yanshi_content.'<a style="color: #FF0000;"> 【文件大小：'.$xydown_size.'】</a></p></div><div class="clear"></div></div>';
		}
	}
	
	return $content;
}
add_action('the_content','xydown_show_down');
?>
<?php include('meta-box.php'); ?>