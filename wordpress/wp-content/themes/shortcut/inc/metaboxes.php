<?php
/**
 *  添加面板到文章（页面）编辑页
 */
function zb_add_metabox() {

	$screens = array( 'post');

	foreach ( $screens as $screen ) {
		add_meta_box(
			'video_metabox',
			'发布视频格式',
			'zb_video_info_callback',
			$screen,
			'normal',
			'high'
		);
	}		
}
add_action( 'add_meta_boxes', 'zb_add_metabox' );
function zb_video_info_callback($post){
	wp_nonce_field( 'zb_meta_box', 'zb_meta_box_nonce' );
	$post_video = get_post_meta($post->ID,'zb_post_video',true);
	$post_image = get_post_meta($post->ID,'zb_post_image',true);
	?>
	<div class="zb-wrap form-table">
		<div id="zb-metabox-video_metabox" class="zb-metabox zb-field-list">
			<div class="zb-row zb-type-oembed">
				<div class="zb-th">
					<label for="zb_post_video">插入视频</label>
				</div>
				<div class="zb-td">
					<input type="text" class="zb-oembed regular-text" name="zb_post_video" id="zb_post_video" value="<?php echo $post_video;?>">
					<p class="zb-metabox-description">输入视频地址iframe格式地址，插入格式如下：</p>
					<p class="zb-metabox-description">优酷：http://player.youku.com/embed/XMzkwMzcyMDI4NA==</p>
					<p class="zb-metabox-description">腾讯：https://v.qq.com/txp/iframe/player.html?vid=y0028eube0u</p>
					<p class="zb-metabox-description">复制个视频网站通用iframe地址即可</p>
				</div>
			</div>
			<div class="zb-row zb-type-oembed">
				<div class="zb-th">
					<label for="zb_post_image">视频封面图</label>
				</div>
				<div class="zb-td">
					<input type="text" class="zb-oembed regular-text" name="zb_post_image" id="zb_post_image" value="<?php echo $post_image;?>">
				</div>
			</div>
		</div>
	</div>
	<?php
}
/**
 * 保存文章时页，保存自定义内容
 *
 * @param int $post_id 这是即将保存的文章ID
 */
function zb_save_meta_box_data( $post_id ) {
	
	if ( ! isset( $_POST['zb_meta_box_nonce'] ) ) {
		return;
	}
	if ( ! wp_verify_nonce( $_POST['zb_meta_box_nonce'], 'zb_meta_box' ) ) {
		return;
	}
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return;
	}
	if ( isset( $_POST['post_type'] ) && 'page' == $_POST['post_type'] ) {

		if ( ! current_user_can( 'edit_page', $post_id ) ) {
			return;
		}

	} else {

		if ( ! current_user_can( 'edit_post', $post_id ) ) {
			return;
		}
	}
	
	if ( isset( $_POST['zb_post_video'] ) ) update_post_meta( $post_id, 'zb_post_video', $_POST['zb_post_video'] );
	
}
add_action( 'save_post', 'zb_save_meta_box_data' );
function zb_metaboxes_script( $hook ) {

	if ( function_exists( 'register_block_type' ) ) {
		return;
	}

	if ( 'edit.php' !== $hook && 'post.php' !== $hook && 'post-new.php' !== $hook ) {
		return;
	}

	wp_enqueue_script( 'zb-post-meta', get_theme_file_uri( '/js/post-meta.js' ), array( 'jquery' ), '1.4.7', true );
	wp_enqueue_style( 'zb-post-meta', get_theme_file_uri( '/css/post-meta.css' ), array(  ), true );
}
add_action( 'admin_enqueue_scripts', 'zb_metaboxes_script' );