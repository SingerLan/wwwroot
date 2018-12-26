<?php 

function wpjam_theme_support_page(){
	echo "<h1>主题支持</h1>";

	echo '<p><strong>Return 主题</strong>多种布局样式，超强SEO设置，等你体验！</p>';

	echo "<h2>主题更新</h2>";

	$theme_info	= wpjam_remote_request('http://www.xintheme.com/api?id=339');
	$version	= $theme_info['Version'];

	$current_theme	= wp_get_theme();

	if($version > $current_theme->get( 'Version' )){
		echo '<p>主题有更新，<a href="'.$theme_info['Link'].'" target="_blank">请及时查看！</a></p>';
	}else{
		echo '<p>你的主题目前已经是最新版了！</p>';
	}

	echo "<h2>其他问题</h2>";

	echo '<p>使用过程有什么问题，请到 <a href="http://97866.com/s/zsxq/">WordPress 果酱知识星球</a>反馈或者提问。</p>';
}
