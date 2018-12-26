<?php
function wpjam_theme_get_setting($setting_name){
    return wpjam_get_setting('wpjam_theme', $setting_name);
}

function wpjam_theme_post_views($before = '(点击 ', $after = ' 次)', $echo = 1){
	global $post;
	$post_ID	= $post->ID;
	$views		= (int)get_post_meta($post_ID, 'views', true);
	if ($echo) {
		echo $before, number_format($views), $after;
	}else{
		return $views;
	}
};

//点赞
function wpjam_theme_postlike(){  
    global $wpdb, $post;  
    $dot_good = get_post_meta($post->ID, 'dotGood', true) ? get_post_meta($post->ID, 'dotGood', true) : '0';  
    $done = isset($_COOKIE['dotGood_' . $post->ID]) ? 'done' : '';  
    echo '<a href="javascript:;" data-action="topTop" data-id="'.$post->ID.'" class="dotGood '.$done.'"><i class="fa fa-heart"></i> <span class="count">'.$dot_good.'</span></a>';  
}  


// 分页代码
if ( !function_exists('wpjam_theme_pagenavi') ) {
	function wpjam_theme_pagenavi( $p = 2 ) { // 取当前页前后各 2 页
		if ( is_singular() ) return; // 文章与插页不用
		global $wp_query, $paged;
		$max_page = $wp_query->max_num_pages;
		if ( $max_page == 1 ) return; // 只有一页不用
		if ( empty( $paged ) ) $paged = 1;
		
		if ( $paged > 1 ) p_link( $paged - 1, '上一页', '&lt;' );/* 如果当前页大于1就显示上一页链接 */
		if ( $paged > $p + 1 ) p_link( 1, '最前页' );
		if ( $paged > $p + 2 ) echo '<a class="page-numbers">...</a>';
		for( $i = $paged - $p; $i <= $paged + $p; $i++ ) { // 中间页
			if ( $i > 0 && $i <= $max_page ) $i == $paged ? print "<a class='page-numbers current' href='javascript:void(0);'>{$i}</a> " : p_link( $i );
		}
		if ( $paged < $max_page - $p - 1 ) echo '<a class="page-numbers" href="javascript:void(0);">...</a> ';
		if ( $paged < $max_page - $p ) p_link( $max_page, '最后页' );
		if ( $paged < $max_page ) p_link( $paged + 1,'下一页', ' &gt;' );/* 如果当前页不是最后一页显示下一页链接 */
		echo '<a class="page-numbers" href="javascript:void(0);">' . $paged . ' / ' . $max_page . ' </a> '; // 显示页数
	}
	function p_link( $i, $title = '', $linktype = '' ) {
		if ( $title == '' ) $title = "第 {$i} 页";
		if ( $linktype == '' ) { $linktext = $i; } else { $linktext = $linktype; }
		echo "<a class='page-numbers' href='", esc_html( get_pagenum_link( $i ) ), "' title='{$title}'>{$linktext}</a> ";
	}
}
//文章内分页
function wpjam_theme_post_pages($args = '') {      
    $defaults = array(      
        'before' => '<p>' . __('Pages:'), 
        'after' => '</p>',      
        'link_before' => '', 
        'link_after' => '',      
        'next_or_number' => 'number', 
        'nextpagelink' => __('下一页'),      
        'previouspagelink' => __('上一页'), 
        'pagelink' => '%',      
        'echo' => 1      
    );      
    $r = wp_parse_args( $args, $defaults );      
    $r = apply_filters( 'wp_link_pages_args', $r );      
    extract( $r, EXTR_SKIP );      
    global $page, $numpages, $multipage, $more, $pagenow;      
    $output = '';      
    if ( $multipage ) {      
        if ( 'number' == $next_or_number ) {      
            $output .= $before;      
            for ( $i = 1; $i < ($numpages+1); $i = $i + 1 ) {      
                $j = str_replace('%',$i,$pagelink);      
                $output .= ' ';      
                if ( ($i != $page) || ((!$more) && ($page==1)) ) {      
                    $output .= _wp_link_page($i);      
                    $output .= $link_before . $j . $link_after;//将原本在下面的那句移进来了      
                }else{  //加了个else语句，用来判断当前页，如果是的话输出下面的      
                    $output .= '<a href="javascript:void(0);" class="page-numbers current">' . $j . '</a>';      
                }      
                //原本这里有一句，移到上面去了      
                if ( ($i != $page) || ((!$more) && ($page==1)) )      
                    $output .= '</a>';      
            }      
            $output .= $after;      
        } else {      
            if ( $more ) {      
                $output .= $before;      
                $i = $page - 1;      
                if ( $i && $more && $previouspagelink ) { //if里面的条件加了$previouspagelink也就是只有参数有“上一页”这几个字才显示      
                    $output .= _wp_link_page($i);      
                    $output .= $link_before. $previouspagelink . $link_after . '</a>';      
                }      
                $i = $page + 1;      
                if ( $i <= $numpages && $more && $nextpagelink ) {      
                //if里面的条件加了$nextpagelink也就是只有参数有“下一页”这几个字才显示      
                    $output .= _wp_link_page($i);      
                    $output .= $link_before. $nextpagelink . $link_after . '</a>';      
                }      
                $output .= $after;      
            }      
        }      
    }      
    if ( $echo )      
        echo $output;      
    return $output;      
}  


//评论列表
function wpjam_theme_list_comments($comment, $args, $depth) {
   $GLOBALS['comment'] = $comment;
global $commentcount,$wpdb, $post;
     if(!$commentcount) { 
          $comments = $wpdb->get_results("SELECT * FROM $wpdb->comments WHERE comment_post_ID = $post->ID AND comment_type = '' AND comment_approved = '1' AND !comment_parent");
          $cnt = count($comments);
          $page = get_query_var('cpage');
          $cpp=get_option('comments_per_page');
         if (ceil($cnt / $cpp) == 1 || ($page > 1 && $page  == ceil($cnt / $cpp))) {
             $commentcount = $cnt + 1;
         } else {
             $commentcount = $cpp * $page + 1;
         }
     }
?>
<li id="comment-<?php comment_ID() ?>" <?php comment_class(); ?>>
<article id="div-comment-<?php comment_ID() ?>" class="comment-body">
<footer class="comment-meta">
<div class="comment-author vcard">
	<?php echo get_avatar($comment,60); ?>
	<b class="fn"><?php comment_author_link() ?></b>
</div>
<!-- .comment-author -->
<div class="comment-metadata">
	<time>
		<?php comment_date() ?><?php comment_time() ?>
	</time>
</div>
</footer>
<div class="comment-content">

		<?php comment_text() ?>
		<?php if ( $comment->comment_approved == '0' ) : ?>
			<font style="color:#C00; font-style:inherit">您的评论正在等待审核中...</font>
		<?php endif; ?>

</div>
<div class="reply">
	<?php comment_reply_link(array_merge( $args, array('depth' => $depth, 'max_depth' => $args['max_depth'], 'reply_text' => "回复"))) ?>
</div>
</article>
<?php }
function weisay_end_comment() {
    echo '</li>';
}