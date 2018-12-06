<div class="comments-form border-box thw-sept">
<?php
if ( post_password_required() ) { ?>
	<p class="nocomments">This post is password protected. Enter the password to view comments.</p>
<?php
	return;
}
?>
<div id="comments" class="comments-area">
		<?php $comments_args = array(
		
        'label_submit'=>'Submit',
		'class_submit'=> 'btn btn-primary',
		
        'title_reply'=>'<h3 class="title-normal">Leave a comment</h3>',
		
        'comment_field' => '<div class="row"><div class="col-md-12"><div class="form-group"><textarea id="comment" class="form-control required-field" name="comment" rows="8" aria-required="true"></textarea></div></div>',

        'fields' => apply_filters( 'comment_form_default_fields', array(

			'author' =>
			  '<div class="col-md-4"><div class="form-group">'  .
			  '<input id="author" placeholder="Name**" class="form-control" name="author" type="text" value="' . esc_attr( $commenter['comment_author'] ) .
			  '" size="30" aria-required="true" /></div></div>',

			'email' =>
			  '<div class="col-md-4"><div class="form-group">'.
			  '<input id="email" placeholder="Email**" class="form-control" name="email" type="text" value="' . esc_attr(  $commenter['comment_author_email'] ) .
			  '" size="30" aria-required="true"/></div></div>',

			'url' =>
			  '<div class="col-md-4"><div class="form-group">'.
			  '<div id="gt_reply"></div></div></div>'
		)),
	);
	comment_form($comments_args);?>
	</div>
	<div id="comments" class="comments-area comments-sept">
	<h3 class="comments-heading"><?php echo number_format_i18n( get_comments_number() );?>条评论</h3>
	<ol class="comment-list">
			<?php
				wp_list_comments( array(
				    'callback'    =>'comment',
					'avatar_size' => 96,
					'per_page' => get_option('comments_per_page'),
					'style'       => 'ol',
					'short_ping'  => true,
					'reply_text'  => '',
				) );
			?>
		</ol>
		<?php twentyfifteen_comment_nav(); ?>
	</div>
	</div>
