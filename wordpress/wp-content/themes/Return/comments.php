<?php
if ( post_password_required() ) {
	return;
}
?>
<script type="text/javascript" src='<?php bloginfo('url'); ?>/wp-includes/js/comment-reply.min.js'></script>
<div id="comments" class="comments-area">
<h2 class="comments-title"><?php comments_number('', '1 条评论', '% 条评论' );?></h2>
	<?php
	// You can start editing here -- including this comment!
	if ( have_comments() ) :
	?>
		<ol class="comment-list">
			<?php wp_list_comments('type=comment&callback=wpjam_theme_list_comments'); ?>
		</ol>

		<?php
		the_comments_pagination(
			array(
				'prev_text' => '上一页',
				'next_text' => '下一页' ,
			)
		);

	endif; // Check for have_comments().

	// If comments are closed and there are comments, let's leave a little note, shall we?
	if ( ! comments_open() && get_comments_number() && post_type_supports( get_post_type(), 'comments' ) ) :
	?>
		<p class="no-comments"><?php _e( 'Comments are closed.' ); ?></p>
	<?php
	endif;
	comment_form();
	?>
</div><!-- #comments -->
<style>.nav-links{margin-bottom:40px}.page-numbers{margin:0 3px 0 0;padding:12px 16px;color:#202226;border-width:1px;border-style:solid;border-color:#e3e3e9;border-radius:3px;font-size:13px;font-weight:600;line-height:1}.page-numbers.current{color:#fff;border-color:#177add;background-color:#177add}.comments-pagination .nav-links a:hover{color:#fff;border-color:#177add;background-color:#177add;text-decoration:none}</style>