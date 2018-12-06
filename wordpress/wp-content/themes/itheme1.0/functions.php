<?php
/**
 * Loading theme related files
 *
 * @since itheme 1.0
 */
require get_theme_file_path( 'inc/email.php');
require get_theme_file_path( 'inc/navwalker.php');
require get_theme_file_path( 'inc/admin/setting.php');
require get_theme_file_path( 'inc/admin/setting-config.php');
require get_theme_file_path( 'inc/geetest/geetest.class.php');
require get_theme_file_path( 'inc/geetest/geetestlib.php');
/**
 * Comment geetest validation
 *
 * @since itheme 1.0
 */
ob_start();
session_start();
$geetest_plugin = new Geetest();
$geetest_plugin->start_plugin();
/**
 * function setup
 *
 * @since itheme 1.0
 */
if ( ! function_exists( 'zb_setup' ) ):
	function zb_setup() {

	if( is_admin() ) {
		add_editor_style();
	}
	add_theme_support( 'post-thumbnails' );
	//add_theme_support( 'title-tag' );

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
 * scripts_styles
 *
 * @since itheme 1.0
 */
function zb_scripts_styles() {

	$version = wp_get_theme()->Version;
	
	
	
	wp_enqueue_style( 'bootstrap', get_template_directory_uri() . "/static/css/bootstrap.min.css", array(), $version);
	wp_enqueue_style( 'iconfont', get_template_directory_uri() . "/static/css/iconfont.css", array(), $version);
	
	wp_enqueue_style( 'style', get_stylesheet_uri() );
	wp_enqueue_style( 'responsive', get_template_directory_uri() . "/static/css/responsive.css", array(), $version);

	// Register jQuery
	wp_enqueue_script( 'zb-jquery', get_template_directory_uri() . '/static/js/jquery.min.js');
	wp_enqueue_script( 'bootstrap', get_template_directory_uri() . '/static/js/bootstrap.min.js', array( 'zb-jquery' ), $version , true );
	wp_enqueue_script( 'main', get_template_directory_uri() . '/static/js/main.js', array( 'zb-jquery' ), $version , true );
	wp_localize_script( 'main', 'zb', array(
		'home_url' => home_url(),
		'admin_url'=>admin_url('admin-ajax.php'),
	) );

}
add_action( 'wp_enqueue_scripts', 'zb_scripts_styles' );
/**
 * scripts_styles to setting page
 *
 * @since itheme 1.0
 */
add_action( 'admin_enqueue_scripts', 'barley_setting_scripts' );
function barley_setting_scripts(){
    global $pagenow;
	$version = wp_get_theme()->Version;
    if( $pagenow == "admin.php" && $_GET['page'] == "barley" || $_GET['page'] == "barley" ){
		wp_enqueue_media();
        wp_enqueue_style('setting', get_template_directory_uri() . '/inc/admin/css/seting.css', array(), $version);
        wp_enqueue_script('setting', get_template_directory_uri() . '/inc/admin/js/setting.js' , array('jquery') , $version, true);
    }

}
/**
 * Title hook.
 *
 * @since itheme 1.0
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
 * @since itheme 1.0
 */

function zb_description() {
    global $s, $post , $wp_query;
    $description = '';
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
    $favicon =  barley_get_setting('favicon') ? barley_get_setting('favicon') : get_template_directory_uri()."/static/images/favicon.png";
    echo '<link type="image/vnd.microsoft.icon" href="'.$favicon.'" rel="shortcut icon">';
}
add_action('wp_head','zb_description',0);
/**
 * head code
 *
 * @since itheme 1.0
 */
function add_head_code(){
    $code = '<style></style>';
	if(is_page('sing-up')||is_page('login')){
        echo  $code;
	}
}
add_action('wp_head','add_head_code',100);
/**
 * post links
 *
 * @since itheme 1.0
 */
function bootstrap_paginate_links() {
	ob_start();
	?>
		<div class="paging">
			<?php
				global $wp_query;
				$current = max( 1, absint( get_query_var( 'paged' ) ) );
				$pagination = paginate_links( array(
					'base' => str_replace( PHP_INT_MAX, '%#%', esc_url( get_pagenum_link( PHP_INT_MAX ) ) ),
					'format' => '?paged=%#%',
					'current' => $current,
					'total' => $wp_query->max_num_pages,
					'type' => 'array',
					'prev_text' => '&laquo;',
					'next_text' => '&raquo;',
				) ); ?>
			<?php if ( ! empty( $pagination ) ) : ?>
				<ul class="pagination justify-content-center">
					<?php foreach ( $pagination as $key => $page_link ) : ?>
						<li class="<?php if ( strpos( $page_link, 'current' ) !== false ) { echo ' active'; } ?>"><?php echo $page_link ?></li>
					<?php endforeach ?>
				</ul>
			<?php endif ?>
		</div>
	<?php
	$links = ob_get_clean();
	return apply_filters( 'bootstap_paginate_links', $links );
}
/**
 * tags
 *
 * @since itheme 1.0
 */
function barley_tags() {
	if ( is_singular() && 'post' === get_post_type() ) { ?>
		<?php
		$tags_list = get_the_tag_list( '', '' );

		if ( ! $tags_list ) {
			return;
		}
		if ( $tags_list ) {
			printf( '<div class="post-tags">%s</div>', $tags_list );
		}
	}
}
/**
 * pc & mobile qq link
 *
 * @since itheme 1.0
 */
function social_link(){
	$qq = barley_get_setting('social-qq');
	if ( wp_is_mobile() ) {
	    $output .= 'mqqwpa://im/chat?chat_type=wpa&uin='.$qq.'&version=1&src_type=web&web_src='.home_url().'';
	}else{
		$output .= 'tencent://AddContact/?fromId=45&fromSubId=1&subcmd=all&uin='.$qq.'';
	}
	return $output;
}
/**
 * comment reply link
 *
 * @since Shortcut 1.0
 */
function typable_cancel_comment_reply_button( $html, $link, $text ) {
	$style = isset( $_GET['replytocom'] ) ? '' : ' style="display:none;"';
	$button = '<a rel="nofollow" id="cancel-comment-reply-link"' . $style . '>';
	return $button . '<i class="iconfont icon-close"></i> </a>';
}
add_action( 'cancel_comment_reply_link', 'typable_cancel_comment_reply_button', 10, 3 );
/**
 * comment_nav
 *
 * @since itheme 1.0
 */
function twentyfifteen_comment_nav() {
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
 * auto add @
 *
 * @since itheme 1.0
 */
add_filter('comment_text','comment_add_at_parent');
function comment_add_at_parent($comment_text){
    $comment_ID = get_comment_ID();
    $comment = get_comment($comment_ID);
    if ($comment->comment_parent ) {
        $parent_comment = get_comment($comment->comment_parent);
        $comment_text = '<a href="#comment-' . $comment->comment_parent . '" rel="nofollow" class="cute">@'.$parent_comment->comment_author.'</a> ' . $comment_text;
    }
    return $comment_text;
}
/**
 * commentlist
 *
 * @since itheme 1.0
 */
function comment($comment, $args, $depth) {
    $GLOBALS['comment'] = $comment;
    switch ( $comment->comment_type ) :
        case 'pingback' :
        case 'trackback' :
            ?>
			<li <?php comment_class(); ?> id="comment-<?php comment_ID(); ?>">
            <p>Pingback: <?php comment_author_link(); ?> </p>
            <?php
            break;
        default :
            global $post;
            ?>     
			<li id="comment-<?php comment_ID(); ?>" <?php comment_class(); ?> itemtype="http://schema.org/Comment" itemscope="" itemprop="comment">
				<div class="comment commentfirst">
					 <div class="author-box">
						<div class="thw-autohr-bio-img">
							<div class="thw-img-border">
								<img class="lazy img-fluid" src="<?php echo zb_sss_get_avatar($comment->user_id);?>" data-original="<?php echo zb_sss_get_avatar($comment->user_id);?>">
							</div>
						</div>
					</div>
					<div class="comment-body">
						<div class="meta-data">
							<?php comment_reply_link( array_merge( $args, array(
							'depth'      => $depth,
							'max_depth'  => $args['max_depth'],
							'reply_text' => '回复',
							'login_text' => '登录回复',
							'before'     => '<span class="pull-right">',
							'after'      => '</span>'
							) ) ) ?>
                            </span>
                            <span class="comment-author"><?php echo get_comment_author_link(); ?></span>
                            <span class="comment-date"><?php echo get_comment_date('Y-m-d'); ?></span>
                        </div>
                        <div class="comment-content">
                            <?php comment_text(); ?>
						</div>   
                    </div>
				</div>
            <?php
            break;
    endswitch;
}
/**
 * Thumbnail functions.
 *
 * @since itheme 1.0
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
        return "https:\/\/ws2.sinaimg.cn\/large\/0072Vf1pgy1foxlnayk8fj31kw0w0tve.jpg";
     }

}
/**
 * avatar
 *
 * @since itheme 1.0
 */
function zb_get_ssl_avatar($avatar) {
    $avatar = str_replace(array("www.gravatar.com", "0.gravatar.com", "1.gravatar.com", "2.gravatar.com"), "cn.gravatar.com", $avatar);
    return $avatar;
}
add_filter('get_avatar', 'zb_get_ssl_avatar');
/**
 * avatar url
 *
 * @since itheme 1.0
 */
function zb_sss_get_avatar($uid){
	$photo = get_user_meta($uid, 'photo', true);
	if($photo) return $photo;
	else return get_bloginfo('template_url').'/static/images/avatar.jpg';
}
/**
 * POST LIKE
 *
 * @since itheme 1.0
 */
add_action( 'wp_ajax_postlike', 'zb_ajax_post_action_callback');
add_action( 'wp_ajax_nopriv_postlike', 'zb_ajax_post_action_callback');

function zb_ajax_post_action_callback(){
    global $post;
    $id = $_POST["actionValue"];
    if( zb_is_post_liked($id) ) {
        echo json_encode(array('status'=>500,'data'=>'done!'));
        die;
    }
    zb_update_postlike($id);

    echo json_encode( array('status' => 200, 'data'=>zb_get_post_like_num($id) ));

    die;
}
function zb_is_post_liked($id){
    $id = $id ? $id : get_the_ID();
    if( isset($_COOKIE['post_action_'.$id])) {
        return true;
    } else {
        return false;
    }
}
function zb_get_post_like_num($id){
    $id = $id ? $id : get_the_ID();
    $num = get_post_meta($id,'_postlikes',true) ? get_post_meta($id,'_postlikes',true) : 0;
    return $num;
}



function zb_update_postlike($id=null){
    $id = $id ? $id : get_the_ID();
    $expire = time() + 99999999;
    $domain = ($_SERVER['HTTP_HOST'] != 'localhost') ? $_SERVER['HTTP_HOST'] : false; // make cookies work with localhost
    $likenum = zb_get_post_like_num($id) + 1;
    update_post_meta($id,'_postlikes',$likenum);
    setcookie('post_action_'.$id,'ding',$expire,'/',$domain,false);
}

function zb_post_action_button($id){
    $id = $id ? $id : get_the_ID();
    $cookie = zb_is_post_liked($id) ? ' is-active' : '';
    $output = '<a class="button like js-action button--primary button--chromeless' . $cookie .'" data-action="postlike" data-action-value="'. $id .'">
	<span class="singlelike button-defaultState icon"><i class="iconfont icon-like"></i></span><span class="singlelike button-activeState icon"><i class="iconfont icon-liked"></i></span><span class="count">'.zb_get_post_like_num($id).'</span></a>';
    return $output;
}
/**
 *Time Ago
 *
 * @since itheme 1.0
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
 * @since itheme 1.0
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
 * single_posts_head
 *
 * @since Shortcut 1.0
 */
function single_posts_head(){
	global $post;
	$pid = $post->ID;
	$author= get_the_author();
	$categories = get_the_category();
	if ( ! empty( $categories ) ) {
		$categories ='<a href="' . esc_url( get_category_link( $categories[0]->term_id ) ) . '" rel="category"><i class="dot" style="background-color: #ff7473;"></i>' . esc_html( $categories[0]->name ) . '</a>';
	}
	$output ='<div class="entry-header single-entry-header"><span class="category-meta">'.$categories.'</span><h2 class="entry-title">'.get_the_title().'</h2><div class="post-meta author-box"><div class="thw-autohr-bio-img"><div class="thw-img-border"><img src="'. zb_sss_get_avatar(get_the_author_meta( 'ID' ) ).'" class="img-fluid" alt="'. get_the_author().'"></div></div><div class="post-meta-content"><span class="list-post-date">Post on '. get_the_date('M d,Y').'</span><span class="post-author">By<a href="'. get_author_posts_url( get_the_author_meta( 'ID' ) ).'"> '. get_the_author().'</a></span><span class="list-post-comment">'.  get_comments_number('0', '1 ', '% ').' Comments</span></div></div></div>';
	return $output;
}
/**
 * post share
 *
 * @since itheme 1.0
 */
function post_share(){
	global $post;
	$pid =$post->ID;
	$title   = rawurlencode( html_entity_decode( get_the_title(), ENT_COMPAT, 'UTF-8' ) );
	$picture =zb_get_background_image($pid);
	$weibo_url = 'http://service.weibo.com/share/share.php?title=' . $title .'&appkey=4221439169&searchPic=true&pic ='.$picture.'&url=' . get_the_permalink() .''; 
	$qq_url = 'https://connect.qq.com/widget/shareqq/index.html?title='.$title.'&url=' . get_the_permalink() .''; 
	$weixin_url ='http://qr.liantu.com/api.php?text=' . get_the_permalink() .'';
	$output ='<div class="post-share-items">
				<strong>Share : </strong>
				<ul class="thw-share">
                    <li><a class="weixin" href="'.$weixin_url.'" target="_blank"><i class="iconfont icon-weixin"></i></a></li>
					<li><a class="weibo" href="'.$weibo_url.'" target="_blank"><i class="iconfont icon-weibo"></i></a></li>
					<li><a class="qq" href="'.$qq_url.'" target="_blank"><i class="iconfont icon-qq"></i></a></li>
				</ul>
			</div>';
	return $output;
}
/**
 * related_posts
 *
 * @since itheme 1.0
 */
function sierra_related_posts(){
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
 * remove_action
 *
 * @since itheme 1.0
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