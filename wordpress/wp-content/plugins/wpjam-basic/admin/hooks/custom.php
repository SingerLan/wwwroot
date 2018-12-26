<?php
if(wpjam_basic_get_setting('disable_auto_update')){  
	remove_action('admin_init', '_maybe_update_core');
	remove_action('admin_init', '_maybe_update_plugins');
	remove_action('admin_init', '_maybe_update_themes');
}

add_action('admin_head', function(){
	remove_action('admin_bar_menu', 'wp_admin_bar_wp_menu', 10);
	
	add_action('admin_bar_menu', function ($wp_admin_bar){
		if(wpjam_basic_get_setting('admin_logo')){
			$title 	= '<img src="'.wpjam_get_thumbnail(wpjam_basic_get_setting('admin_logo'),40,40).'" style="height:20px; padding:6px 0">';
		}else{
			$title	= '<span class="ab-icon"></span>';
		}
		$wp_admin_bar->add_menu( array(
			'id'    => 'wp-logo',
			'title' => $title,
			'href'  => self_admin_url(),
			'meta'  => array(
				'title' => __('About'),
			),
		) );
	});

	echo wpjam_basic_get_setting('admin_head');

	if(wpjam_basic_get_setting('favicon')){ 
		echo '<link rel="shortcut icon" href="'.wpjam_basic_get_setting('favicon').'">';
	}
});

// 修改 WordPress Admin text
add_filter('admin_footer_text', function($text){
	if(wpjam_basic_get_setting('admin_footer')){
		return wpjam_basic_get_setting('admin_footer');
	}
	return $text;
});

//去除后台首页面板的功能 

add_action('wp_dashboard_setup', function(){
	global $wp_meta_boxes;

	// wpjam_print_r($wp_meta_boxes['dashboard']);

	unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_primary']);

	add_meta_box( 'dashboard_wpjam', 'WordPress资讯及技巧', 'wpjam_update_dashboard_widget_callback','dashboard', 'side', 'core' );

}, 1);

function wpjam_update_dashboard_widget_callback(){
	?>
	<style type="text/css">
		#dashboard_wpjam .inside{margin:0; padding:0;}
		a.jam-post {border-bottom:1px solid #eee; margin: 0 !important; padding:6px 0; display: block; }
		a.jam-post:last-child{border-bottom: 0;}
		a.jam-post p{display: table-row; }
		a.jam-post img{display: table-cell; width:50px; height: 50px; margin:5px 12px; }
		a.jam-post span{display: table-cell; height: 50px; vertical-align: middle;}
	</style>
	<div class="rss-widget">
	<?php 

	$api = 'http://jam.wpweixin.com/api/mag.post.list.json';

	$jam_posts = get_transient('dashboard_jam_posts');

	if($jam_posts === false){
		$response	= wpjam_remote_request($api);

		if(!is_wp_error($response)){
			$jam_posts	= $response['posts'];
			set_transient('dashboard_jam_posts', $jam_posts, 12 * HOUR_IN_SECONDS );
		}

	}
	if($jam_posts){
		// wpjam_print_r($jam_posts);

		$i = 0;
		foreach ($jam_posts as $jam_post){
			if($i == 5) break;
			echo '<a class="jam-post" href="http://blog.wpjam.com'.$jam_post['post_url'].'"><p>'.'<img src="'.str_replace('imageView2/1/w/200/h/200/', 'imageView2/1/w/100/h/100/', $jam_post['thumbnail']).'" /><span>'.$jam_post['title'].'</span></p></a>';
			$i++;
		}
	}	
	?>
	</div>

	<p class="community-events-footer">
		<a href="https://blog.wpjam.com/" target="_blank">WordPress果酱 <span aria-hidden="true" class="dashicons dashicons-external"></span></a> |
		<a href="http://www.xintheme.com/" target="_blank">xintheme <span aria-hidden="true" class="dashicons dashicons-external"></span></a>
	</p>

	<?php
}

//给页面添加摘要
// add_action('add_meta_boxes', function($post_type, $post) {
// 	if($post_type == 'page'){
// 		add_meta_box( 'postexcerpt', __('Excerpt'), 'post_excerpt_meta_box', 'page', 'normal', 'core' );
// 	}
// }, 10, 2);


if(wpjam_basic_get_setting('diable_revision')){
	add_action('wp_print_scripts',function() {
		wp_deregister_script('autosave');
	});
}

if(wpjam_basic_get_setting('diable_block_editor')){
	add_filter('use_block_editor_for_post_type', '__return_false');
}


if(wpjam_basic_get_setting('disable_privacy')){
	add_action('admin_menu', function (){

		global $menu, $submenu;

		unset($submenu['options-general.php'][45]);

		// Bookmark hooks.
		remove_action( 'admin_page_access_denied', 'wp_link_manager_disabled_message' );

		// Privacy tools
		remove_action( 'admin_menu', '_wp_privacy_hook_requests_page' );
		// Privacy hooks
		remove_filter( 'wp_privacy_personal_data_erasure_page', 'wp_privacy_process_personal_data_erasure_page', 10, 5 );
		remove_filter( 'wp_privacy_personal_data_export_page', 'wp_privacy_process_personal_data_export_page', 10, 7 );
		remove_filter( 'wp_privacy_personal_data_export_file', 'wp_privacy_generate_personal_data_export_file', 10 );
		remove_filter( 'wp_privacy_personal_data_erased', '_wp_privacy_send_erasure_fulfillment_notification', 10 );

		// Privacy policy text changes check.
		remove_action( 'admin_init', array( 'WP_Privacy_Policy_Content', 'text_change_check' ), 100 );

		// Show a "postbox" with the text suggestions for a privacy policy.
		remove_action( 'edit_form_after_title', array( 'WP_Privacy_Policy_Content', 'notice' ) );

		// Add the suggested policy text from WordPress.
		remove_action( 'admin_init', array( 'WP_Privacy_Policy_Content', 'add_suggested_content' ), 1 );

		// Update the cached policy info when the policy page is updated.
		remove_action( 'post_updated', array( 'WP_Privacy_Policy_Content', '_policy_page_updated' ) );
	},9);
}


// 屏蔽后台功能提示
// if(wpjam_basic_get_setting('disable_update')){
// 	add_filter ('pre_site_transient_update_core', '__return_null');

// 	remove_action ('load-update-core.php', 'wp_update_plugins');
// 	add_filter ('pre_site_transient_update_plugins', '__return_null');

// 	remove_action ('load-update-core.php', 'wp_update_themes');
// 	add_filter ('pre_site_transient_update_themes', '__return_null');
// }

// 移除 Google Fonts
// if(wpjam_basic_get_setting('disable_google_fonts')){
// 	//add_filter( 'gettext_with_context', 'wpjam_disable_google_fonts', 888, 4);
// 	function wpjam_disable_google_fonts($translations, $text, $context, $domain ) {
// 		$google_fonts_contexts = array('Open Sans font: on or off','Lato font: on or off','Source Sans Pro font: on or off','Bitter font: on or off');
// 		if( $text == 'on' && in_array($context, $google_fonts_contexts ) ){
// 			$translations = 'off';
// 		}

// 		return $translations;
// 	}
// }

add_action('admin_init', function(){
	// 显示 Post ID
	function wpjam_post_row_actions_show_id($actions, $post){
		$actions['post_id'] = 'ID: '.$post->ID;
		return $actions;
	}
	add_filter('post_row_actions',	'wpjam_post_row_actions_show_id', 10, 2);
	add_filter('page_row_actions',	'wpjam_post_row_actions_show_id', 10, 2);
	add_filter('media_row_actions',	'wpjam_post_row_actions_show_id', 10, 2);
	

	// 显示 标签，分类，tax ID
	$custom_taxonomies = get_taxonomies(['public'=>true]); 
	if($custom_taxonomies){
		foreach ($custom_taxonomies as $taxonomy) {
			add_filter($taxonomy.'_row_actions',function ($actions, $term){
				$actions['term_id'] = 'ID：'.$term->term_id;
				return $actions;
			},10,2);
		}
	}

	// 显示用户 ID
	function wpjam_user_row_actions_show_id($actions, $user){
		$actions['user_id'] = 'ID: '.$user->ID;
		return $actions;
	}
	add_filter('ms_user_row_actions',	'wpjam_user_row_actions_show_id',10,2);
	add_filter('user_row_actions',		'wpjam_user_row_actions_show_id', 10, 2);
	

	// 显示留言 ID
	add_filter('comment_row_actions',function ($actions, $comment){
		$actions['comment_id'] = 'ID：'.$comment->comment_ID;
		return $actions;
	},10,2);
	

	// remove_action( 'admin_notices', 'maintenance_nag' );
	// remove_action( 'network_admin_notices', 'maintenance_nag' );
}, 99);


add_filter('wpjam_post_options', function ($wpjam_options){
	// 在后台页面列表显示使用的页面模板
	$wpjam_options['page_template_box']	= [
		'title'		=> '',	// 为空，在 编辑页面不显示
		'post_type'	=> 'page',
		'fields'	=> [
			'template'	=> ['title'=>'模板',	'type'=>'view',	'show_admin_column'=>'only','column_callback'=>'get_page_template_slug']
		]
	];

	$fields	= [
		'thumbnail'	=> [
			'title'				=>'缩略图',
			'type'				=>'view',	
			'show_admin_column'	=>'only',	
			'column_callback'	=>function($post_id){ return wpjam_get_post_thumbnail($post_id, array(50,50)); }
		],
		'views'		=> [
			'title'				=>'浏览',	
			'type'				=>'view',
			'show_admin_column'	=>'only',
			'sortable_column'	=>'meta_value_num',
			'column_callback'	=>function($post_id){ return wpjam_get_post_views($post_id); }
		],
	];

	// if(!function_exists('wpjam_get_post_total_views')){
	// 	unset($fields['views']);
	// }
	
	$wpjam_options['post_columns'] = [
		'title'		=> '',	// 为空，在 编辑页面不显示
		'fields'	=> $fields
	];

	if(wpjam_basic_get_setting('custom_footer')){
		$wpjam_options['wpjam_custom_footer_box'] = [
			'title'		=> '文章底部代码',	
			'fields'	=> [
				'custom_footer'=>[
					'title'=>'', 
					'type'=>'textarea', 
					'description'=>'自定义文章 Footer 代码可以让你在当前文章插入独有的 JS，CSS，iFrame 等类型的代码，让你可以对具体一篇文章设置不同样式和功能，展示不同的内容。'
				]
			]
		];
	}

	return $wpjam_options;
});

if(wpjam_basic_get_setting('timestamp_file_name')){
	add_filter('wp_handle_upload_prefilter', function($file){	// 防止重名造成大量的 SQL 请求
		if(strlen($file['name'])<=15){
			$file['name']	= time().'-'.$file['name'];
		}
		return $file;
	});
}

add_action('wp_loaded', function (){
	if(CDN_NAME == '')
		return;

	add_filter('pre_option_thumbnail_size_w',	'__return_zero');
	add_filter('pre_option_thumbnail_size_h',	'__return_zero');
	add_filter('pre_option_medium_size_w',		'__return_zero');
	add_filter('pre_option_medium_size_h',		'__return_zero');
	add_filter('pre_option_large_size_w',		'__return_zero');
	add_filter('pre_option_large_size_h',		'__return_zero');

	add_filter('intermediate_image_sizes_advanced', function($sizes){
		if(isset($sizes['full'])){
			return ['full'=>$sizes['full']];
		}else{
			return [];
		}
	});

	add_filter('image_size_names_choose', function($sizes){
		if(isset($sizes['full'])){
			return ['full'=>$sizes['full']];
		}else{
			return [];
		}
	});

	add_filter('upload_dir', function($uploads){
		$uploads['url']		= wpjam_cdn_replace_local_hosts($uploads['url']);
		$uploads['baseurl']	= wpjam_cdn_replace_local_hosts($uploads['baseurl']);
		return $uploads;
	});

	add_filter('wp_calculate_image_srcset_meta', '__return_empty_array');
	// add_filter('image_downsize', '__return_true');

	add_filter('wp_prepare_attachment_for_js', function($response, $attachment, $meta){
		$meta = wp_get_attachment_metadata( $attachment->ID );
		if ( false !== strpos( $attachment->post_mime_type, '/' ) )
			list( $type, $subtype ) = explode( '/', $attachment->post_mime_type );
		else
			list( $type, $subtype ) = array( $attachment->post_mime_type, '' );

		if ( $meta && ( 'image' === $type || ! empty( $meta['sizes'] ) ) ) {
			if(isset($response['sizes'])){
				$url			= $response['sizes']['full']['url'];	
				$width			= $response['sizes']['full']['width'];
				$height			= $response['sizes']['full']['height'];
				$orientation	= $response['sizes']['full']['orientation'];

				foreach (['thumbnail', 'medium', 'medium_large', 'large'] as $s) {
					$size	= wpjam_parse_size($s);

					if($size['width'] < $width || $size['height'] < $height){
						$thumbnail_url	= wpjam_get_thumbnail($url, $s);
					}else{
						$thumbnail_url	= $url;
					}

					$thumbnail_width		= 0;
					$thumbnail_height		= 0;
					$thumbnail_orientation	= '';

					if($size['width']){
						if($size['width'] < $width){
							$thumbnail_width	= $size['width']; 
						}else{
							$thumbnail_width	= $width;
						}
					}else{
						$thumbnail_orientation	= $orientation;
					}

					if($size['height']){
						if($size['height'] < $height){
							$thumbnail_height	= $size['height']; 
						}else{
							$thumbnail_height	= $height;
						}
					}else{
						$thumbnail_orientation	= $orientation;
					}

					$thumbnail_orientation = $thumbnail_orientation ?: ($thumbnail_height > $thumbnail_width ? 'portrait' : 'landscape');

					$response['sizes'][$s]	= array(
						'url'			=> $thumbnail_url,
						'width'			=> $thumbnail_width,
						'height'		=> $thumbnail_height,
						'orientation'	=> $thumbnail_orientation
					);
				}
			}
		}

		return $response;
	}, 10, 3);

	// wp_get_attachment_image_src(271);
}, 11);
