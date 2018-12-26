<?php
add_filter('pre_option_link_manager_enabled', '__return_true');	/*激活友情链接后台*/

add_filter( 'esc_html', function ( $safe_text ) {
	if ( $safe_text == '日志' ){
		return '小图';
	}elseif ( $safe_text == '相册' ){
		return '特色';
	}else{
		return $safe_text;
	}
} );


//禁止代码标点转换
remove_filter('the_content', 'wptexturize');


add_action('wp_enqueue_scripts', function () {
	wp_deregister_script( 'jquery' );//注销自带JQ

	if (!is_admin()) {
		wp_enqueue_style('bootstrap',		get_stylesheet_directory_uri().'/static/css/bootstrap.css');
		wp_enqueue_style('style',			get_stylesheet_directory_uri().'/static/css/style.css');
		wp_enqueue_style('slick',			get_stylesheet_directory_uri().'/static/css/slick.css');
		wp_enqueue_style('slick-theme',		get_stylesheet_directory_uri().'/static/css/slick-theme.css');
		wp_enqueue_style('font-awesome',	get_stylesheet_directory_uri().'/static/css/font-awesome.css');
		wp_enqueue_style('ionicons',		get_stylesheet_directory_uri().'/static/css/ionicons.min.css');

		wp_enqueue_script('jquery',			get_stylesheet_directory_uri() . '/static/js/jquery.js');
		wp_enqueue_script('init-masonry',	get_stylesheet_directory_uri() . '/static/js/init-masonry.js', ['jquery'], '', true);
		wp_enqueue_script('slick',			get_stylesheet_directory_uri() . '/static/js/slick.min.js', ['jquery'], '', true);
		wp_enqueue_script('functions',		get_stylesheet_directory_uri() . '/static/js/functions.js', ['jquery'], '', true);
		wp_enqueue_script('masonry',		get_stylesheet_directory_uri() . '/static/js/masonry.min.js', ['jquery'], '', true);
		wp_enqueue_script('affix-sidebar',	get_stylesheet_directory_uri() . '/static/js/affix-sidebar.js', ['jquery'], '', true);
	}
});

//删除菜单多余css class
function wpjam_css_attributes_filter($classes) {
	return is_array($classes) ? array_intersect($classes, array('current-menu-item','current-post-ancestor','current-menu-ancestor','current-menu-parent','menu-item-has-children','menu-item')) : '';
}
add_filter('nav_menu_css_class',	'wpjam_css_attributes_filter', 100, 1);
add_filter('nav_menu_item_id',		'wpjam_css_attributes_filter', 100, 1);
add_filter('page_css_class', 		'wpjam_css_attributes_filter', 100, 1);

if( wpjam_get_setting('wpjam_theme', 'xintheme_article') ) {
	add_filter('login_redirect', function ($redirect_to, $request){
		if( empty( $redirect_to ) || $redirect_to == 'wp-admin/' || $redirect_to == admin_url() ){
			return home_url("/wp-admin/edit.php");
		}else{
			return $redirect_to;
		}

	}, 10, 3);
}


add_filter('wpjam_post_thumbnail_uri', function($post_thumbnail_uri, $post){
	if(get_post_meta($post->ID, 'header_img', true)){
		return get_post_meta($post->ID, 'header_img', true);
	}elseif($post_thumbnail_uri){
		return $post_thumbnail_uri;
	}else{
		return wpjam_get_post_first_image($post->post_content);
	}
},10,2);

//去掉分类描述P标签
add_filter('category_description', function ($description) {
	return wp_strip_all_tags($description, true);
});

/* 评论作者链接新窗口打开 */

add_filter('get_comment_author_link', function () {
	$url	= get_comment_author_url();
	$author = get_comment_author();
	if ( empty( $url ) || 'http://' == $url ){
		return $author;
	}else{
		return "<a target='_blank' href='$url' rel='external nofollow' class='url'>$author</a>";
	}
});

//搜索结果排除所有页面
add_filter('pre_get_posts', function ($query) {
	if ($query->is_search) {
		$query->set('post_type', 'post');
	}
	return $query;
});

/* 搜索关键词为空 */
add_filter( 'request', function ( $query_variables ) {
	if (isset($_GET['s']) && !is_admin()) {
		if (empty($_GET['s']) || ctype_space($_GET['s'])) {
			wp_redirect( home_url() );
			exit;
		}
	}
	return $query_variables;
} );

//禁止头部加载s.w.org
add_filter( 'wp_resource_hints', function ( $hints, $relation_type ) {
	if ( 'dns-prefetch' === $relation_type ) {
		return array_diff( wp_dependencies_unique_hosts(), $hints );
	}
	return $hints;
}, 10, 2 );


//给文章图片自动添加alt和title信息
add_filter('the_content', function ($content) {
	global $post;
	$pattern		= "/<a(.*?)href=('|\")(.*?).(bmp|gif|jpeg|jpg|png)('|\")(.*?)>/i";
	$replacement	= '<a$1href=$2$3.$4$5 alt="'.$post->post_title.'" title="'.$post->post_title.'"$6>';
	$content = preg_replace($pattern, $replacement, $content);
	return $content;
});

//文章自动nofollow
add_filter( 'the_content', function ( $content ) {
	$regexp = "<a\s[^>]*href=(\"??)([^\" >]*?)\\1[^>]*>";
	if(preg_match_all("/$regexp/siU", $content, $matches, PREG_SET_ORDER)) {
		if( !empty($matches) ) {
   
			$srcUrl = get_option('siteurl');
			for ($i=0; $i < count($matches); $i++)
			{
				$tag = $matches[$i][0];
				$tag2 = $matches[$i][0];
				$url = $matches[$i][0];
   
				$noFollow = '';
				$pattern = '/target\s*=\s*"\s*_blank\s*"/';
				preg_match($pattern, $tag2, $match, PREG_OFFSET_CAPTURE);
				if( count($match) < 1 )
					$noFollow .= ' target="_blank" ';
   
				$pattern = '/rel\s*=\s*"\s*[n|d]ofollow\s*"/';
				preg_match($pattern, $tag2, $match, PREG_OFFSET_CAPTURE);
				if( count($match) < 1 )
					$noFollow .= ' rel="nofollow" ';
   
				$pos = strpos($url,$srcUrl);
				if ($pos === false) {
					$tag = rtrim ($tag,'>');
					$tag .= $noFollow.'>';
					$content = str_replace($tag2,$tag,$content);
				}
			}
		}
	}
	$content = str_replace(']]>', ']]>', $content);
	return $content;
});


//修复 WordPress 找回密码提示“抱歉，该key似乎无效”
add_filter('retrieve_password_message', function ( $message, $key ) {
	if ( strpos($_POST['user_login'], '@') ) {
		$user_data = get_user_by('email', trim($_POST['user_login']));
	} else {
		$login = trim($_POST['user_login']);
		$user_data = get_user_by('login', $login);
	}
	
	$user_login = $user_data->user_login;
	$msg	= __('有人要求重设如下帐号的密码：'). "\r\n\r\n";
	$msg	.= network_site_url() . "\r\n\r\n";
	$msg	.= sprintf(__('用户名：%s'), $user_login) . "\r\n\r\n";
	$msg	.= __('若这不是您本人要求的，请忽略本邮件，一切如常。') . "\r\n\r\n";
	$msg	.= __('要重置您的密码，请打开下面的链接：'). "\r\n\r\n";
	$msg	.= network_site_url("wp-login.php?action=rp&key=$key&login=" . rawurlencode($user_login), 'login') ;

	return $msg;
}, null, 2);


//禁止FEED
if( wpjam_get_setting('wpjam_theme', 'xintheme_feed') ) {
	function wpjam_disable_feed() {
		wp_die(__('<h1>Feed已经关闭, 请访问网站<a href="'.get_bloginfo('url').'">首页</a>!</h1>'));
	}

	add_action('do_feed',		'wpjam_disable_feed', 1);
	add_action('do_feed_rdf',	'wpjam_disable_feed', 1);
	add_action('do_feed_rss',	'wpjam_disable_feed', 1);
	add_action('do_feed_rss2',	'wpjam_disable_feed', 1);
	add_action('do_feed_atom',	'wpjam_disable_feed', 1);
}

//使用v2ex镜像avatar头像
if( wpjam_get_setting('wpjam_theme', 'xintheme_v2ex') ) {
	add_filter( 'get_avatar', function ($avatar) {
		return str_replace(['cn.gravatar.com/avatar', '0.gravatar.com/avatar', '1.gravatar.com/avatar', '2.gravatar.com/avatar'], 'cdn.v2ex.com/gravatar', $avatar);
	}, 10, 3 );
}

if(!function_exists('the_views')){
	add_action('wp_head', function (){
		if (is_singular()) {global $post;
			if($post_ID = $post->ID){
				$post_views = (int)get_post_meta($post_ID, 'views', true);
				if(!update_post_meta($post_ID, 'views', ($post_views+1))){
					add_post_meta($post_ID, 'views', 1, true);
				}
			}
		}
	});  
}

function dotGood(){  
    global $wpdb, $post;  
    $id = $_POST["um_id"];  
    if ($_POST["um_action"] == 'topTop') {  
        $specs_raters = get_post_meta($id, 'dotGood', true);  
        $expire = time() + 99999999;  
        $domain = ($_SERVER['HTTP_HOST'] != 'localhost') ? $_SERVER['HTTP_HOST'] : false; // make cookies work with localhost  
        setcookie('dotGood_' . $id, $id, $expire, '/', $domain, false);  
        if (!$specs_raters || !is_numeric($specs_raters)) update_post_meta($id, 'dotGood', 1);  
        else update_post_meta($id, 'dotGood', ($specs_raters + 1));  
        echo get_post_meta($id, 'dotGood', true);  
    }  
    die;  
}  
add_action('wp_ajax_nopriv_dotGood', 'dotGood');  
add_action('wp_ajax_dotGood', 'dotGood');