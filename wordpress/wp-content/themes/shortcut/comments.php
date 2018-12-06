<div class="bottom-area">
<div class="container small">
<?php
if ( post_password_required() ) { ?>
	<p class="nocomments">This post is password protected. Enter the password to view comments.</p>
<?php
	return;
}
?>
<div id="comments" class="comments-area">
	<h3 class="comments-title"><?php echo number_format_i18n( get_comments_number() );?>条评论</h3>
	<div class="commentshow">
		<ol class="comment-list">
			<?php
				wp_list_comments( array(
				    //'callback'    =>'comment',
					'avatar_size' => 96,
					'per_page' => get_option('comments_per_page'),
					'style'       => 'ol',
					'short_ping'  => true,
					'reply_text'  => '<span class="icon-reply"></span>',
				) );
			?>
		</ol>
		<?php zb_comment_nav(); ?>
	</div>
		<?php 
		if(barley_get_setting('geetest_off')){
			$geetestdiv1='<div class="col-md-4"><p class="comment-form-url"><label for="url">站点</label>';
			$geetestdiv2='<input id="url" name="url" type="text" value="" size="30"></p></div></div>';
		}else{
			$geetestdiv1='<div class="col-md-4"><label for="gt_reply">极验证</label>';
			$geetestdiv2='<div id="gt_reply"></div></p></div></div>';
		}
		$comments_args = array(
        'label_submit'=>'提交评论',
		
        'title_reply'=>'发表评论',
		
        'comment_field' => '<p class="comment-form-comment"><textarea id="comment" name="comment" rows="8" aria-required="true"></textarea></p><div class="row comment-author-inputs">',

        'fields' => apply_filters( 'comment_form_default_fields', array(

			'author' =>
			  '<div class="col-md-4"><p class="comment-form-author"><label for="author">名称*</label>'  .
			  '<input id="author" class="blog-form-input" name="author" type="text" value="' . esc_attr( $commenter['comment_author'] ) .
			  '" size="30" aria-required="true" /></p></div>',

			'email' =>
			  '<div class="col-md-4"><p class="comment-form-email"><label for="email">电子邮件*</label>'.
			  '<input id="email" class="blog-form-input" name="email" type="text" value="' . esc_attr(  $commenter['comment_author_email'] ) .
			  '" size="30" aria-required="true"/></p></div>',

			'url' =>
			  ''.$geetestdiv1.''.
			  ''.$geetestdiv2.''
		)),
	);
	comment_form($comments_args);?>
</div>
</div>
</div>