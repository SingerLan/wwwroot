<?php
/**
 * smtp mail
 *
 * @since Shortcut 1.3
 */
function barley_mail_smtp( $phpmailer ) {
	$phpmailer->IsSMTP();
	$phpmailer->FromName = ''.barley_get_setting('smtp-name').''; 
	$phpmailer->SMTPAuth = true;
	$phpmailer->Port = 465;
	$phpmailer->SMTPSecure ="ssl";
	$phpmailer->Host = ''.barley_get_setting('smtp-host').'';
	$phpmailer->Username = ''.barley_get_setting('smtp-account').'';
	$phpmailer->Password =''.barley_get_setting('smtp-pass').'';
}
add_action('phpmailer_init', 'barley_mail_smtp');
function barley_wp_mail_from( $original_email_address ) {
    return ''.barley_get_setting('smtp-account').'';
}
add_filter( 'wp_mail_from', 'barley_wp_mail_from' );
/**
 * add_checkbox
 *
 * @since Shortcut 1.3
 */
add_action('comment_form', 'lb_comment_add_checkbox');
function lb_comment_add_checkbox() {
	echo '<label for="comment_mail_notify" class="autocheckbox"><input type="checkbox" name="comment_mail_notify" id="comment_mail_notify" value="comment_mail_notify" checked="checked"/>有人回复时邮件通知我</label>';
}
/**
 * comment email template
 *
 * @since Shortcut 1.3
 */
function barley_comment_mail_notify($comment_id) {
    $comment = get_comment($comment_id);
    $parent_id = $comment->comment_parent ? $comment->comment_parent : '';
    $spam_confirmed = $comment->comment_approved;
	$blogname =  get_bloginfo('name');
	$bloghome = get_bloginfo('url');
	$logo = barley_get_setting('logo');
    if (($parent_id != '') && ($spam_confirmed != 'spam') && (!get_comment_meta($parent_id,'_deny_email',true)) && (get_option('admin_email') != get_comment($parent_id)->comment_author_email)) {
        $wp_email = 'no-reply@' . preg_replace('#^www\.#', '', strtolower($_SERVER['SERVER_NAME'])); //可以修改为你自己的邮箱地址
        $to = trim(get_comment($parent_id)->comment_author_email);
        $subject = '你在 [' . get_option("blogname") . '] 的留言有了新回复';
        $message = '<table width="100%" cellpadding="0" cellspacing="0" border="0" style="border-collapse:collapse"><tbody><tr><td><table width="600" cellpadding="0" cellspacing="0" border="0" align="center" style="border-collapse:collapse"><tbody><tr><td><table width="100%" cellpadding="0" cellspacing="0" border="0"><tbody><tr><td width="73" align="left" valign="top" style="border-top:1px solid #d9d9d9;border-left:1px solid #d9d9d9;border-radius:5px 0 0 0"></td><td valign="top" style="border-top:1px solid #d9d9d9"><div style="font-size:14px;line-height:10px"><br><br><br><br></div><div style="font-size:18px;line-height:18px;color:#444;font-family:Microsoft Yahei">Hi, ' . trim(get_comment($parent_id)->comment_author) . '<br><br><br></div><div style="font-size:14px;line-height:22px;color:#444;font-weight:bold;font-family:Microsoft Yahei">您在' . get_the_title($comment->comment_post_ID) . '的评论：</div><div style="font-size:14px;line-height:10px"><br></div><div style="font-size:14px;line-height:22px;color:#666;font-family:Microsoft Yahei">&nbsp; &nbsp;&nbsp; &nbsp; ' . trim(get_comment($parent_id)->comment_content) . '</div><div style="font-size:14px;line-height:10px"><br><br></div><div style="font-size:14px;line-height:22px;color:#5DB408;font-weight:bold;font-family:Microsoft Yahei">' . trim($comment->comment_author) . ' 回复您：</div><div style="font-size:14px;line-height:10px"><br></div><div style="font-size:14px;line-height:22px;color:#666;font-family:Microsoft Yahei">&nbsp; &nbsp;&nbsp; &nbsp; ' . trim($comment->comment_content) . '</div><div style="font-size:14px;line-height:10px"><br><br><br><br></div><div style="text-align:center"><a href="' . htmlspecialchars(get_comment_link($parent_id)) . '" target="_blank" style="text-decoration:none;color:#fff;display:inline-block;line-height:32px;font-size:14px;background-color:#27c4b5;border-radius:3px;font-family:Microsoft Yahei">&nbsp; &nbsp;&nbsp; &nbsp;点击查看回复&nbsp; &nbsp;&nbsp; &nbsp;</a><br><br></div></td><td width="65" align="left" valign="top" style="border-top:1px solid #d9d9d9;border-right:1px solid #d9d9d9;border-radius:0 5px 0 0"></td></tr><tr><td style="border-left:1px solid #d9d9d9">&nbsp;</td><td align="left" valign="top" style="color:#999"><div style="font-size:8px;line-height:14px"><br><br></div><div style="min-height:1px;font-size:1px;line-height:1px;background-color:#e0e0e0">&nbsp;</div><div style="font-size:12px;line-height:20px;width:425px;font-family:Microsoft Yahei"><br>此邮件由' . get_option("blogname") . '系统自动发出，请勿回复！</div></td><td style="border-right:1px solid #d9d9d9">&nbsp;</td></tr><tr><td colspan="3" style="border-bottom:1px solid #d9d9d9;border-right:1px solid #d9d9d9;border-left:1px solid #d9d9d9;border-radius:0 0 5px 5px"><div style="min-height:42px;font-size:42px;line-height:42px">&nbsp;</div></td></tr></tbody></table></td></tr><tr><td><div style="min-height:42px;font-size:42px;line-height:42px">&nbsp;</div></td></tr></tbody></table></td></tr></tbody></table>';
        $from = "From: \"" . get_option('blogname') . "\" <$wp_email>";
        $headers = "$from\nContent-Type: text/html; charset=" . get_option('blog_charset') . "\n";
        wp_mail( $to, $subject, $message, $headers );
    }
}
add_action('comment_post', 'lb_comment_mail_notify');
