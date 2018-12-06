<?php
/**
 * Loading theme related files
 *
 * @since Shortcut 1.6
 */
define('ZB_VERSION', '1.6');
require get_theme_file_path( 'inc/email.php' );
require get_theme_file_path( 'inc/metaboxes.php' );
require get_theme_file_path( 'inc/admin/setting.php');
require get_theme_file_path( 'inc/admin/setting-config.php');
if(barley_get_setting('admin_date')){
	require get_theme_file_path( 'inc/date.php' );
}
/**
 * Comment geetest validation
 *
 * @since Shortcut 1.6
 */
if(!barley_get_setting('geetest_off')){
	require get_theme_file_path( 'inc/geetest/geetest.class.php');
	require get_theme_file_path( 'inc/geetest/geetestlib.php');
	ob_start();
	session_start();
	$geetest_plugin = new Geetest();
	$geetest_plugin->start_plugin();
}
/**
 * theme update.Later updates are only pushed through the online key. Please keep your key in good order.
 *
 * @since Shortcut 1.2
 */
require get_template_directory() . '/inc/licenses/wpdigipro-adp.php';
$theme_license = new WPDigiPro_Theme_License_Adapter('themes.php', 'shortcut');
$license_data = $theme_license->WPDigiPro_Theme_Get_Code();
/**
 * theme activated redirect setting page
 *
 * @since Shortcut 1.6
 */
add_action( 'load-themes.php', 'zb_theme' );
function zb_theme(){
	global $pagenow;
	if ( 'themes.php' == $pagenow && isset( $_GET['activated'] ) ) {
		wp_redirect( admin_url( '?page=barley' ) );
		exit;
	}
}
/**
 * function setup
 *
 * @since Shortcut 1.0
 */
if ( ! function_exists( 'zb_setup' ) ):
	function zb_setup() {

	if( is_admin() ) {
		add_editor_style();
	}
	add_theme_support( 'post-thumbnails' );

	register_nav_menu( 'main', '菜单');
	add_theme_support(
		'post-formats', array(
			'video',
			'image',
		)
	);
	add_theme_support(
		'html5', array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
		)
	);

}
endif;
add_action( 'after_setup_theme', 'zb_setup' );
/**
 * Add script to Sticky video
 *
 * @since Shortcut 1.6
 */
function zb_add_footer_code(){
	if(is_single()&& has_post_format( 'video' )){
		echo  "<script>new StickyVideo('sticky-container')</script>";
	}
}
add_action('wp_footer','zb_add_footer_code',100);
/**
 * function setup
 *
 * @since Shortcut 1.3
 */
function zb_title( $title, $sep ) {
    global $paged, $page, $wp_query,$post;

    if ( is_feed() || $post->post_type == 'reads')
        return $post->post_title ;

    $title .= get_bloginfo( 'name', 'display' );

    $site_description = get_bloginfo( 'description', 'display' );
    if ( $site_description && ( is_home() || is_front_page() ) )
        $title = "$title $sep $site_description";
    
    if( is_search() )
        $title = get_search_query()."的搜索結果";

    if ( $paged >= 2 || $page >= 2 )
        $title = "第" .max( $paged, $page ) ."页 ". $sep . " " . $title;
    return $title;
}
add_filter( 'wp_title', 'zb_title', 10, 2 );
/**
 * Site description.
 *
 * @since Shortcut 1.3
 */

function zb_description() {
    global $s, $post , $wp_query;
    $description = '';
	$keywords = barley_get_setting('keywords');
    $blog_name = get_bloginfo('name');
    if ( is_singular() ) {
        $ID = $post->ID;
        $title = $post->post_title;
        $author = $post->post_author;
        $user_info = get_userdata($author);
        $post_author = $user_info->display_name;
        if (!get_post_meta($ID, "meta-description", true)) {$description = $title.' - 作者: '.$post_author.',首发于'.$blog_name;}
        else {$description = get_post_meta($ID, "meta-description", true);}
    } elseif ( is_home () )    { $description = barley_get_setting('description');
    } elseif ( is_tag() )      { $description = single_tag_title('', false) . " - ". trim(strip_tags(tag_description()));
    } elseif ( is_category() ) { $description = single_cat_title('', false) . " - ". trim(strip_tags(category_description()));
    } elseif ( is_archive() )  { $description = $blog_name . "'" . trim( wp_title('', false) ) . "'";
    } elseif ( is_search() )   { $description = $blog_name . ": '" . esc_html( $s, 1 ) . "' 的搜索結果";
    }  else { $description = $blog_name . "'" . trim( wp_title('', false) ) . "'";
    }
    $description = mb_substr( $description, 0, 220, 'utf-8' );
    echo "<meta name=\"description\" content=\"$description\">\n";
    echo "<meta name=\"keywords\" content=\"$keywords\">\n";
    $favicon =  barley_get_setting('favicon') ? barley_get_setting('favicon') : get_template_directory_uri()."/images/favicon.png";
    echo '<link type="image/vnd.microsoft.icon" href="'.$favicon.'" rel="shortcut icon">';
}
add_action('wp_head','zb_description',0);
/**
 * scripts_styles
 *
 * @since Shortcut 1.0
 */
function zb_scripts_styles() {

	$version = wp_get_theme()->Version;
	
	wp_enqueue_style( 'zb-style', get_stylesheet_uri() );
	
	wp_enqueue_style( 'zb-font-css', get_template_directory_uri() . "/css/fonts.css", array(), $version, 'screen' );

	// Register jQuery
	wp_enqueue_script( 'jquery' );
	wp_enqueue_script( 'qrcode', get_template_directory_uri() . '/js/qrcode.min.js', array( 'jquery' ), $version , true );
	wp_enqueue_script( 'imagesloaded', get_template_directory_uri() . '/js/imagesloaded.min.js', array( 'jquery' ), $version , true );
	wp_enqueue_script( 'modernizr', get_template_directory_uri() . '/js/modernizr.js', array( 'jquery' ), $version , true );
	wp_enqueue_script( 'masonry', get_template_directory_uri() . '/js/masonry.min.js', array( 'jquery' ), $version , true );
	if(is_single()&& has_post_format( 'video' )){
	wp_enqueue_script( 'video', get_template_directory_uri() . '/js/video.js', array( 'jquery' ), $version , true );
	}

	// JS
	wp_enqueue_script( 'shortcut-js', get_template_directory_uri() . '/js/shortcut.min.js', array( 'jquery' ), $version , true );
	

	wp_localize_script( 'shortcut-js', 'zb', array(
		'home_url' => home_url(),
		'admin_url'=>admin_url('admin-ajax.php'),
		'post_url'=>get_current_page_url(),
		'logo_regular'=>'',
		'logo_contrary'=>''
	) );
	wp_enqueue_script( 'comment', get_template_directory_uri() . '/js/comment.js', array( 'jquery' ));
	wp_localize_script( 'comment', 'comment_objc', array(
		'ajaxurl'=>admin_url('admin-ajax.php')
	) );

}
add_action( 'wp_enqueue_scripts', 'zb_scripts_styles' );
/**
 * scripts_styles to setting page
 *
 * @since Shortcut 1.3
 */
add_action( 'admin_enqueue_scripts', 'barley_setting_scripts' );
function barley_setting_scripts(){
    global $pagenow;
	$version = wp_get_theme()->Version;
    if( $pagenow == "admin.php" && $_GET['page'] == "barley" || $_GET['page'] == "barley" ){
		wp_enqueue_media();
		wp_enqueue_style( 'wp-color-picker' );
        wp_enqueue_style('setting', get_template_directory_uri() . '/inc/admin/css/seting.css', array(), $version);
        wp_enqueue_script('setting', get_template_directory_uri() . '/inc/admin/js/setting.js' , array('jquery') , $version, true);
    }

}
/**
 * GET PAGE URL
 *
 * @since Shortcut 1.2
 */
function get_current_page_url(){
	global $wp;
	return get_option( 'permalink_structure' ) == '' ? add_query_arg( $wp->query_string, '', home_url( $wp->request ) ) : home_url( add_query_arg( array(), $wp->request ) );
}
/**
 * Ajax comment submit
 *
 * @since Shortcut 1.6
 */
add_action( 'wp_ajax_ajaxcomments', 'zb_ajax_comment' ); 
add_action( 'wp_ajax_nopriv_ajaxcomments', 'zb_ajax_comment' ); 

function zb_ajax_comment(){
	
	$comment = wp_handle_comment_submission( wp_unslash( $_POST ) );
	if ( is_wp_error( $comment ) ) {
		$error_data = intval( $comment->get_error_data() );
		if ( ! empty( $error_data ) ) {
			wp_die( '<p>' . $comment->get_error_message() . '</p>', __( '评论提交失败' ), array( 'response' => $error_data, 'back_link' => true ) );
		} else {
			wp_die( '未知错误' );
		}
	}
	$user = wp_get_current_user();
	do_action('set_comment_cookies', $comment, $user);

	$comment_depth = 1;
	$comment_parent = $comment->comment_parent;
	while( $comment_parent ){
		$comment_depth++;
		$parent_comment = get_comment( $comment_parent );
		$comment_parent = $parent_comment->comment_parent;
	}
	
	$GLOBALS['comment'] = $comment;
	$GLOBALS['comment_depth'] = $comment_depth;
	
	$comment_html = '<li ' . comment_class('', null, null, false ) . ' id="comment-' . get_comment_ID() . '">
		<article class="comment-body" id="div-comment-' . get_comment_ID() . '">
			<footer class="comment-meta">
				<div class="comment-author vcard">
					' . get_avatar( $comment, 100 ) . '
					<b class="fn">' . get_comment_author_link() . '</b> <span class="says">says:</span>
				</div>
				<div class="comment-metadata">
					<a href="' . esc_url( get_comment_link( $comment->comment_ID ) ) . '">' . sprintf('<time>%1$s at %2$s</time>', get_comment_date(),  get_comment_time() ) . '</a>';
 
					if( $edit_link = get_edit_comment_link() )
						$comment_html .= '<span class="edit-link"><a class="comment-edit-link" href="' . $edit_link . '">Edit</a></span>';
 
				$comment_html .= '</div>';
				if ( $comment->comment_approved == '0' )
					$comment_html .= '<p class="comment-awaiting-moderation"><svg viewBox="0 0 1024 1024" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="45" height="45"><path d="M522.2 525.8h61v28.1h-61zM522.2 481.7h61v27.9h-61zM442.9 481.7h60.7v27.9h-60.7z" fill="" p-id="1671"></path><path d="M65.8 237.6v533.9h34.9c0-19.3 15.6-34.9 34.9-34.9 19.3 0 34.9 15.6 34.9 34.9h23.3c0-19.3 15.6-34.9 34.9-34.9 19.3 0 34.9 15.6 34.9 34.9h23.3c0-19.3 15.6-34.9 34.9-34.9s34.9 15.6 34.9 34.9H380c0-19.3 15.6-34.9 34.9-34.9 19.3 0 34.9 15.6 34.9 34.9h23.3c0-19.3 15.6-34.9 34.9-34.9 19.3 0 34.9 15.6 34.9 34.9h23.3c0-19.3 15.6-34.9 34.9-34.9 19.3 0 34.9 15.6 34.9 34.9h23.3c0-19.3 15.6-34.9 34.9-34.9 19.3 0 34.9 15.6 34.9 34.9h23.3c0-19.3 15.6-34.9 34.9-34.9 19.3 0 34.9 15.6 34.9 34.9h23.3c0-19.3 15.6-34.9 34.9-34.9 19.3 0 34.9 15.6 34.9 34.9h46.6V237.6H65.8zM208 387.1l16.9 9.8c-20.2 30-41.7 54.8-64.6 74.3-2.9-5.6-6.1-11.2-9.8-16.9 22.5-17.6 41.6-40 57.5-67.2z m-5 106.5V623h-17.9V517.8c-8.8 11.1-17.7 21.2-26.7 30.1-2.4-6.2-5.2-12.5-8.3-19.1 20.6-19.5 40-45.6 58.1-78.1l16.7 8.6c-7.3 12.2-14.6 23.7-21.9 34.3z m20.7-21.7h71.2v-34.3h-60.7v-16.4h60.7v-33.4H314v33.4h61.2v16.4H314v34.3h70.8v16.7h-161v-16.7z m17.6 81.7l13.8-10.7c11.4 12.4 21.5 24.1 30.3 35l-15.2 11.7c-8.9-12.2-18.5-24.2-28.9-36z m145.3-18.3h-37.2V591c0 18.7-9.9 28.1-29.8 28.1-9.2 0-21.7-0.1-37.4-0.2-1-5.7-2.2-12.4-3.8-20 13.8 1.1 26.2 1.7 37.2 1.7 9.8 0 14.8-5.4 14.8-16.2v-49.1H224.2v-16.7h106.2V496h19.1v22.6h37.2v16.7z m214.2 46.4h-17.6v-11.2h-61v51.9h-18.6v-51.9h-60.7v11.2h-17.6V465h78.4v-25.7h18.6V465h78.6v116.7zM622 459.8h-18.6v-27.4H422.6v27.4H404v-44.5h104.1c-4-6.6-8.7-13.5-13.8-20.7l16.4-9.8c6.5 8.3 12.2 16.1 17.2 23.6l-11.2 6.9H622v44.5z m70 41.4v122.4h-17.9V497.4c-8.1 26-17.6 46.9-28.3 62.7-2.1-6.8-4.6-13.8-7.6-21 17-27 28.9-55.7 35.7-86.2h-34.1v-16.7h34.3v-47.4H692v47.4h27.2v16.7H692v41.9l7.4-7.9c10.2 8.6 19.6 17.2 28.3 25.7l-12.1 12.1c-7.8-8.3-15.6-16.2-23.6-23.5z m21.5 60.5c31.6-16.4 58.1-35.7 79.6-58.1-15.6 1.6-30 3.1-43.4 4.5-5.9 0.6-11.4 1.7-16.4 3.3l-8.8-17.4c6.5-3.5 11.6-7.6 15.2-12.4 10-12.2 19.8-26.2 29.3-41.9h-45.3v-17.2h73.1c-6.5-9.7-12.5-18.3-18.1-26l15.5-9.8c6 7.5 13 16.6 21 27.4l-12.6 8.3h72.9v17.2h-84.3c-11.6 17.6-23.6 34.2-36 49.8 17.5-1 35.2-2 53.1-3.1 9.1-11.3 17-23.3 23.8-36l17.4 9.3c-27.2 47.6-68 86.5-122.4 116.5-4.5-4.8-9-9.6-13.6-14.4z m149.6 58.4c-14.9-14.8-31.6-30.5-50-47.2-24 21.1-50.6 38.3-79.8 51.5-3-4.3-7.2-9.5-12.6-15.7 54.3-22.9 99-60.2 134.1-112l16.2 11c-13.7 19.7-28.6 37.4-44.8 53.1 18.3 14.9 35.4 29.5 51.5 43.8l-14.6 15.5z" fill="" p-id="1672"></path><path d="M442.9 525.8h60.7v28.1h-60.7z" fill="" p-id="1673"></path></svg></p>';
 
			$comment_html .= '</footer>
			<div class="comment-content">' . apply_filters( 'comment_text', get_comment_text( $comment ), $comment ) . '</div>
		</article>
	</li>';
	echo $comment_html;
	die();
}
/**
 * comment_nav
 *
 * @since Shortcut 1.2
 */
function zb_comment_nav() {
	if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) :
	?>
	<nav class="commentnav" role="navigation">
		<div class="nav-links">
			<?php
			$prevsvg = '<svg class="svgIcon" width="21" height="21" viewBox="0 0 21 21"><path d="M13.402 16.957l-6.478-6.479L13.402 4l.799.71-5.768 5.768 5.768 5.77z" fill-rule="evenodd"></path></svg>';
			$nextsvg = '<svg class="svgIcon" width="21" height="21" viewBox="0 0 21 21"><path d="M8.3 4.2l6.4 6.3-6.4 6.3-.8-.8 5.5-5.5L7.5 5" fill-rule="evenodd"></path></svg>';
				if ( $prev_link = get_previous_comments_link( 'Older Comments' ) ) :
					printf( '<span class="cnav-item">'.$prevsvg.'%s</span>', $prev_link );
				else:
					printf( '<span class="cnav-item disabled">'.$prevsvg.' Older Comments</span>');
				endif;
				echo'<span class="chartPage-verticalDivider"></span>';
				if ( $next_link = get_next_comments_link( 'Newer Comments') ) :
					printf( '<span class="cnav-item">%s'.$nextsvg.'</span>', $next_link );
				else:
					printf( '<span class="cnav-item disabled">Newer Comments'.$nextsvg.'</span>');
				endif;
			?>
		</div>
	</nav>
	<?php
	endif;
}
/**
 * Thumbnail functions.
 *
 * @since Shortcut 1.0
 */

function zb_get_background_image($post_id,$width = null,$height = null){
    /**
     *if( has_post_thumbnail($post_id) ){
     *   $timthumb_src = wp_get_attachment_image_src(get_post_thumbnail_id($post_id),'full');
     *   $output = $timthumb_src[0];
     *} else {
     *   $content = get_post_field('post_content', $post_id);
     *   $defaltthubmnail = 'data:image/gif;base64,R0lGODlhAQABAAAAACH5BAEKAAEALAAAAAABAAEAAAICTAEAOw==';
     *   preg_match_all('/<img.*?(?: |\\t|\\r|\\n)?src=[\'"]?(.+?)[\'"]?(?:(?: |\\t|\\r|\\n)+.*?)?>/sim', $content, $strResult, PREG_PATTERN_ORDER);
     *  $n = count($strResult[1]);
     *    if($n > 0){
     *        $output = $strResult[1][0];
     *   } else {
     *       $output = $defaltthubmnail;
     *   }
     *}
     *if ( $height && $width ) {
     *    $result = get_template_directory_uri() . "/timthumb.php?src={$output}&w={$width}&h={$height}&zc=1&q=100";
     * } else {
     *     $result = $output;
     *}
     */
     $json = file_get_contents(home_url().'/img.json');
     $result = json_decode($json, true);
     if(array_key_exists($post_id , $result)) {
        return $result[$post_id];
     } else {
        return "https:\/\/ws4.sinaimg.cn\/large\/0075auPSly1fra2gaitbgj31680t3n72.jpg";
     }
}
/**
 * avatar
 *
 * @since Shortcut 1.0
 */
function the_article_icon(){
    if ( is_sticky() ){echo '<i class="icon-sticky"></i>';}
    elseif ( has_post_format('image') ){echo '<i class="icon-image"></i>';}
    elseif ( has_post_format('video') ){echo '<i class="icon-video"></i>';}
    else{echo'<i class="icon-post"></i>';}
}
/**
 * avatar
 *
 * @since Shortcut 1.0
 */
function zb_get_ssl_avatar($avatar) {
    $avatar = str_replace(array("www.gravatar.com", "0.gravatar.com", "1.gravatar.com", "2.gravatar.com"), "cn.gravatar.com", $avatar);
    return $avatar;
}
add_filter('get_avatar', 'zb_get_ssl_avatar');
/**
 * avatar url
 *
 * @since Shortcut 1.0
 */
function zb_sss_get_avatar($uid){
	$photo = get_user_meta($uid, 'photo', true);
	if($photo) return $photo;
	else return get_bloginfo('template_url').'/images/avatar.jpg';
}
/**
 * translate seconds to time.
 *
 * @since Shortcut 1.0
 */

function sec2time($sec){
    $d = floor($sec / 86400);
    $tmp = $sec % 86400;
    $h = floor($tmp / 3600);
    $tmp %= 3600;
    $m = floor($tmp /60);
    $s = $tmp % 60;
    return "<span class='cute'>".$d."</span>天<span class='cute'>".$h."</span>小时<span class='cute'>".$m."</span>分<span class='cute'>".$s."</span>秒";
}
/**
 *Time Ago
 *
 * @since Shortcut 1.0
 */
function barley_timeago( $ptime ) {
    date_default_timezone_set ('ETC/GMT');
    $ptime = strtotime($ptime);
    $etime = time() - $ptime;
    if($etime < 1) return '刚刚';
    $interval = array (
        12 * 30 * 24 * 60 * 60  =>  '年前 ('.date('Y-m-d', $ptime).')',
        30 * 24 * 60 * 60       =>  '个月前 ('.date('m-d', $ptime).')',
        7 * 24 * 60 * 60        =>  '周前 ('.date('m-d', $ptime).')',
        24 * 60 * 60            =>  '天前',
        60 * 60                 =>  '小时前',
        60                      =>  '分钟前',
        1                       =>  '秒前'
    );
    foreach ($interval as $secs => $str) {
        $d = $etime / $secs;
        if ($d >= 1) {
            $r = round($d);
            return $r . $str;
        }
    };
}
/**
 * Post and page view.
 *
 * @since Shortcut 1.0
 */
function restyle_text($number) {
    if($number >= 1000) {
        return round($number/1000,2) . "k";   // NB: you will want to round this
    }
    else {
        return $number;
    }
}

function set_post_views() {
    if (!is_singular()) return;
    global $post;
    $post_id = intval($post->ID);
    $views = get_post_meta($post_id, 'views' ,true);
    if (is_single() || is_page()) {
        if(!update_post_meta($post_id, 'views', ($views + 1))) {
            add_post_meta($post_id, 'views', 1, true);
        }
    }
}
add_action('get_header', 'set_post_views');

function custom_the_views($post_id) {
    $count_key = 'views';
    $views = get_post_custom($post_id);
    $views = intval($views['views'][0]);
    $post_views = intval(post_custom('views'));
    if ($views == '') {
        return 0;
    } else {
        return restyle_text($views);
    }
}
/**
 * get_footer_links
 *
 * @since Shortcut 1.3
 */
function get_footer_links(){
	$weibo = barley_get_setting('social-weibo');
	$qq = barley_get_setting('social-qq');
	$github = barley_get_setting('social-github');
	$output .='<div class="social-bar">';
	$output .='<a class="cd-popup-trigger"><i class="mdi icon-wx"></i><span class="hidden-xs hidden-sm">微信</span></a>';
	if($weibo){
		$output .='<a href="'.$weibo.'" target="_blank"><i class="mdi icon-wb"></i><span class="hidden-xs hidden-sm">微博</span></a>';
	}
	if($qq){
		$output .='<a href="https://wpa.qq.com/msgrd?v=3&uin='.$qq.'" target="_blank"><i class="mdi icon-qq"></i><span class="hidden-xs hidden-sm">QQ</span></a>';
	}
	if($github){
		$output .='<a href="'.$github.'" target="_blank"><i class="mdi icon-gb"></i><span class="hidden-xs hidden-sm">Github</span></a>';
	}
	$output .='</div>';
	return $output;
}
/**
 * category post
 *
 * @since Shortcut 1.3.1
 */
function get_category_posts_list(){
	global $post;
	$categories_ids = get_terms(
		array( 'category' ), 
		array( 'fields' => 'ids' )
	);
	if($cat_ids=$categories_ids){
		foreach ($cat_ids as $cat_id ){
			$cat = get_category($cat_id);
			if($cat){ 
			echo'<div class="category-box"><div class="entry-thumbnails">';
				$cat_posts_query = array(
					'posts_per_page'		=> 3,
					'ignore_sticky_posts'	=> true,
					'cat'					=> $cat_id,
				);
				$catquery = new WP_Query($cat_posts_query);
				if($catquery->have_posts()){ $i = 0;while($catquery->have_posts()){ $catquery->the_post(); $i++; global $post;if($i == 1){
					echo'<div class="big thumbnail"><img class="lazyload" data-src="'. zb_get_background_image($post->ID,270,180).'"></div>';
				}elseif($i == 2){ 
					echo'<div class="small"><div class="thumbnail"><img class="lazyload" data-src="'. zb_get_background_image($post->ID,80,110).'"></div>';
				}elseif($i == 3){ 
					echo'<div class="thumbnail"><img class="lazyload" data-src="'. zb_get_background_image($post->ID,80,110).'"><span>+'. $cat->count.'</span></div>';
				}  } wp_reset_query();
					echo'</div>';
				} 
				echo'</div><h3 class="entry-title">'. $cat->name.'</h3><a class="u-permalink" href="'. get_category_link($cat_id).'"></a></div>';
			}
		}
	}		
}
/**
 * get_hot_posts
 *
 * @since Shortcut 1.3
 */
function get_hot_posts(){
	global $post;
	$couns = barley_get_setting('hot_posts',3);
	$query_args = array(
		"meta_key" => 'views',
        "posts_per_page" => $couns,
        "post__not_in" => array(get_the_ID()),
		"orderby"=>'meta_value_num',
		"order"=> 'DESC',
    );
	$output = '<div class="widget picks_widget"><h5 class="widget-title">热门文章</h5><div class="picks-wrapper"><div class="icon" data-icon="" style="border-top-color: #EC7357; color: #FFF;"></div><div class="picked-posts owl">';
	$the_query = new WP_Query($query_args);
	while ($the_query->have_posts()) {
		$the_query->the_post();
		$output .= '<article class="post">
						<div class="entry-thumbnail">
							<img class="lazyload" data-src="'. zb_get_background_image($post->ID,100,100).'">
						</div>
						<header class="entry-header">    
							<h6 class="entry-title">'.get_the_title().'</h6>  
						</header>
						<a class="u-permalink" href="' . get_permalink() . '"></a>
					</article>';
	}
    wp_reset_postdata();
    $output .= '</div></div></div></div>';
    return $output;
}
/**
 * single_posts_head
 *
 * @since Shortcut 1.5
 */
function single_posts_head(){
	global $post;
	$pid = $post->ID;
	$author= get_the_author();
	$categories = get_the_category();
	if ( ! empty( $categories ) ) {
		$categories ='<a href="' . esc_url( get_category_link( $categories[0]->term_id ) ) . '" rel="category"><i class="dot" style="background-color: #ff7473;"></i>' . esc_html( $categories[0]->name ) . '</a>';
	}
	if ( has_post_format( 'video' ) ) {
		$output = '<div class="hero lazyload visible" data-bg="'.zb_get_background_image($pid).'"><div class="hero-media"><div class="container video-container"><div class="fluid-width-video-wrapper"><div id="sticky-container"><iframe class="sticky-container__object" src="'.get_post_meta( $post->ID, 'zb_post_video', 1 ,true).'" frameborder=0 "allowfullscreen" allow="autoplay; encrypted-media"></iframe></div></div></div></div></div>';
	}else{
		$output ='<div class="hero lazyload visible" data-bg="'.zb_get_background_image($pid).'"><div class="container small"><header class="entry-header white"><div class="entry-meta"><span class="meta-author"><a href="'. esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ).'">'.get_avatar(get_the_author_meta( 'ID' ) ).''.$author.'</a></span><span class="meta-category">'.$categories.'</span><span class="meta-date"><a href="'.get_the_permalink().'"><time datetime="'. esc_attr( get_the_date( 'c' ) ).'">'. human_time_diff(get_the_date('U')).'前</time></a></span><span>'. custom_the_views(get_the_ID()).' 次浏览</span></div><h1 class="entry-title">'.get_the_title().'</h1></header></div></div>';
	}
	return $output;
}
/**
 * video_posts_title
 *
 * @since Shortcut 1.0
 */
function video_posts_title(){
	global $post;
	$pid = $post->ID;
	$author= get_the_author();
	$categories = get_the_category();
	if ( ! empty( $categories ) ) {
		$categories ='<a href="' . esc_url( get_category_link( $categories[0]->term_id ) ) . '" rel="category"><i class="dot" style="background-color: #ff7473;"></i>' . esc_html( $categories[0]->name ) . '</a>';
	}
	if ( has_post_format( 'video' ) ) {
		$output = '<div class="container small"><header class="entry-header"><div class="entry-meta"><span class="meta-author"><a href="'. esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ).'">'.get_avatar(get_the_author_meta( 'ID' ) ).''.$author.'</a></span><span class="meta-category">'.$categories.'</span><span class="meta-date"><a><time datetime="'. esc_attr( get_the_date( 'c' ) ).'">'. human_time_diff(get_the_date('U')).' 前</time></a></span></div><h1 class="entry-title">'.get_the_title().'</h1></header></div>';
	}else{
		$output ='';
	}
	return $output;
}
/**
 * post share
 *
 * @since Shortcut 1.0
 */
function post_share(){
	global $post;
	$pid =$post->ID;
	$title   = rawurlencode( html_entity_decode( get_the_title(), ENT_COMPAT, 'UTF-8' ) );
	$picture =zb_get_background_image($pid);
	$twitter_url = 'https://twitter.com/intent/tweet?url=' . get_the_permalink() . '&text= ' . $title . '';
	$weibo_url = 'http://service.weibo.com/share/share.php?title=' . $title .'&appkey=4221439169&searchPic=true&pic ='.$picture.'&url=' . get_the_permalink() .''; 
	$qq_url = 'https://connect.qq.com/widget/shareqq/index.html?title='.$title.'&url=' . get_the_permalink() .''; 
	$weixin_url ='http://qr.liantu.com/api.php?text=' . get_the_permalink() .'';
	$output ='<div class="action-share">
				<a class="singleshare weibo" href="'.$weibo_url.'" target="_blank"><i class="icon-wb"></i></a>
				<a class="singleshare qq" href="'.$qq_url.'" target="_blank"><i class="icon-qq"></i></a>
				<a class="singleshare cd-popup-trigger wechat" target="_blank"><i class="icon-wx"></i></a>
				<a class="singleshare twitter" href="'.$twitter_url.'" target="_blank"><i class="icon-tw"></i></a>
			</div>
			<div class="action-ellipsis">
				<a class="btn-bigger-cover cd-popup-trigger ellipsis"><i class="icon-ellipsis"></i></a>
			</div>
			';
	return $output;
}
/**
 * related_posts
 *
 * @since Shortcut 1.3
 */
function zb_related_posts(){
    global $post;
    $query_args = array(
        "posts_per_page" => 4,
        "post__not_in" => array(get_the_ID()),
        "category__in" => wp_get_post_categories(get_the_ID()),
    );
    $output = '<div class="bottom-area"><div class="container medium"><div class="related-posts"><h3 class="u-border-title">你也可能喜欢</h3><div class="row">';
    $the_query = new WP_Query($query_args);
    while ($the_query->have_posts()) {
        $the_query->the_post();
        $output .= '<div class="col-lg-6"><article class="post"><div class="entry-media"><div class="placeholder" style="padding-bottom: 66.666666666667%;">
		<a href="' . get_permalink() . '"><img class="lazyload" data-srcset="' . zb_get_background_image($post->ID,220,145) . '" data-sizes="auto" src="data:image/gif;base64,R0lGODlhAQABAAAAACH5BAEKAAEALAAAAAABAAEAAAICTAEAOw==" alt="' . get_the_title() . '"></a></div></div><div class="entry-wrapper"><header class="entry-header"> <header class="entry-header"><h4 class="entry-title"><a href="' . get_permalink() . '" rel="bookmark">' . get_the_title() . '</a></h4></header><div class="entry-excerpt u-text-format"><p>'.mb_strimwidth(strip_shortcodes(strip_tags(apply_filters('the_content', $post->post_content))), 0, 90,"...").'</p></div></div></div>';
    }
    wp_reset_postdata();
    $output .= '</div></div></div></div>';
    return $output;
}
/**
 * body add class
 *
 * @since Shortcut 1.5
 */
function zb_body_classes( $classes ) {
	global $post;
	$classes[] = 'navbar-sticky';
	if ( is_single() && has_post_format( 'video' ) ) {
		$classes[] = 'hero-video';
	}
	return $classes;
}
add_filter( 'body_class', 'zb_body_classes' );
/**
 * comment reply link
 *
 * @since Shortcut 1.3
 */
function zb_cancel_comment_reply_button( $html, $link, $text ) {
	$style = isset( $_GET['replytocom'] ) ? '' : ' style="display:none;"';
	$button = '<a rel="nofollow" id="cancel-comment-reply-link"' . $style . '>';
	return $button . '<i class="icon-close"></i> </a>';
}
add_action( 'cancel_comment_reply_link', 'zb_cancel_comment_reply_button', 10, 3 );
/**
 * remove_action
 *
 * @since Typable 1.0
 */
remove_action( 'wp_head',   'rsd_link' ); 
remove_action( 'wp_head',   'wlwmanifest_link' ); 
remove_action( 'wp_head',   'index_rel_link' ); 
remove_action( 'wp_head',   'start_post_rel_link', 10, 0 ); 
remove_action( 'wp_head',   'wp_generator' ); 
remove_action( 'wp_head',   'wp_resource_hints', 2 );
remove_action( 'wp_head',   'feed_links', 2 );
remove_action( 'wp_head',   'feed_links_extra', 3);
remove_action( 'wp_head',   'wp_shortlink_wp_head' );
remove_action( 'wp_head',   'parent_post_rel_link', 10, 0);
remove_action( 'wp_head',   'adjacent_posts_rel_link', 10, 0);
remove_action( 'wp_head', 	'rest_output_link_wp_head', 10 );
remove_action( 'wp_head', 	'wp_oembed_add_discovery_links', 10 );
remove_filter( 'the_content', 'wptexturize');
add_filter('show_admin_bar', '__return_false');
add_filter( 'wp_revisions_to_keep', 'specs_wp_revisions_to_keep', 10, 2 );
add_filter('comment_form_field_cookies','__return_false');
add_filter( 'add_image_size', create_function( '', 'return 1;' ) );
function specs_wp_revisions_to_keep( $num, $post ) {
    return 0;
}
function remove_open_sans() {
wp_deregister_style( 'open-sans' );
wp_register_style( 'open-sans', false );
wp_enqueue_style('open-sans', '');
}
add_action( 'init', 'remove_open_sans' );
function disable_emojis() {
    remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
    remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
    remove_action( 'wp_print_styles', 'print_emoji_styles' );
    remove_action( 'admin_print_styles', 'print_emoji_styles' );    
    remove_filter( 'the_content_feed', 'wp_staticize_emoji' );
    remove_filter( 'comment_text_rss', 'wp_staticize_emoji' );  
    remove_filter( 'wp_mail', 'wp_staticize_emoji_for_email' );
    add_filter( 'tiny_mce_plugins', 'disable_emojis_tinymce' );
	add_filter( 'widget_text', 'do_shortcode' );
}
add_action( 'init', 'disable_emojis' );
function disable_emojis_tinymce( $plugins ) {
    return array_diff( $plugins, array( 'wpemoji' ) );
}
function convert_pre_entities( $matches ) {
    return str_replace( $matches[1], htmlentities( $matches[1] ), $matches[0] );
}
add_filter('page_css_class', 'my_css_attributes_filter', 100, 1);
function my_css_attributes_filter($var) {
	return is_array($var) ? array() : '';
}
function example_remove_dashboard_widgets() {
    global $wp_meta_boxes;
    unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_recent_drafts']);
    unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_primary']);
    unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_secondary']);
    unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_right_now']);
}
add_action('wp_dashboard_setup', 'example_remove_dashboard_widgets' );

function wpjam_is_mobile() {
if ( empty($_SERVER['HTTP_USER_AGENT']) ) {
        return false;
    } elseif ( ( strpos($_SERVER['HTTP_USER_AGENT'], 'Mobile') !== false  && strpos($_SERVER['HTTP_USER_AGENT'], 'iPad') === false) // many mobile devices (all iPh, etc.)
        || strpos($_SERVER['HTTP_USER_AGENT'], 'Android') !== false
        || strpos($_SERVER['HTTP_USER_AGENT'], 'Silk/') !== false
        || strpos($_SERVER['HTTP_USER_AGENT'], 'Kindle') !== false
        || strpos($_SERVER['HTTP_USER_AGENT'], 'BlackBerry') !== false
        || strpos($_SERVER['HTTP_USER_AGENT'], 'Opera Mini') !== false
        || strpos($_SERVER['HTTP_USER_AGENT'], 'Opera Mobi') !== false ) {
            return true;
    } else {
        return false;
    }
}