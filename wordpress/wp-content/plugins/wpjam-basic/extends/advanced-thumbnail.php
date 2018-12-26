<?php
/*
Plugin Name: 高级缩略图
Plugin URI: http://blog.wpjam.com/project/wpjam-basic/
Description: 可以在后台设置分类，标签缩略图，并且将文章获取缩略图的顺序更改为：特色图片 > 标签缩略图 > 第一张图片 > 分类缩略图 > 默认缩略图。
Version: 1.0
*/

/* term thumbnail */
function wpjam_has_term_thumbnail(){
	return wpjam_get_term_thumbnail_url()? true : false;
}

function wpjam_term_thumbnail($size='thumbnail', $crop=1, $class="wp-term-image", $retina=2){
	echo  wpjam_get_term_thumbnail(null, $size, $crop, $class);
}

function wpjam_get_term_thumbnail($term=null, $size='thumbnail', $crop=1, $class="wp-term-image", $retina=2){
	if($term_thumbnail_url = wpjam_get_term_thumbnail_url($term, $size, $crop, $retina)){
		return  '<img src="'.$term_thumbnail_url.'" class="'.$class.'"'.wpjam_image_hwstring($size).' />';
	}else{
		return '';
	}
}

function wpjam_get_term_thumbnail_url($term=null, $size='full', $crop=1, $retina=1){
	$term	= ($term)?:get_queried_object();
	$term	= get_term($term);

	if(!$term) {
		return false;
	}

	$thumbnail_url	= '';

	$thumbnail_url	= get_term_meta($term->term_id, 'thumbnail', true);
	$thumbnail_url	= apply_filters('wpjam_term_thumbnail_url', $thumbnail_url, $term);

	if($thumbnail_url){
		return wpjam_get_thumbnail($thumbnail_url, $size, $crop, $retina);
	}else{
		return '';
	}
}

add_filter('wpjam_post_thumbnail_url', function($thumbnail_url, $post){
	if(has_post_thumbnail($post)){
		return $thumbnail_url;
	}

	$thumbnail_order	= wpjam_cdn_get_setting('post_thumbnail_order') ?: 1;

	if($thumbnail_order == 1){
		if($thumbnail_url = wpjam_get_post_first_image($post)){
			return $thumbnail_url;
		}

		if($thumbnail_url = wpjam_get_post_thumbnail_by_terms($post)){
			return $thumbnail_url;
		}

		if($thumbnail_url = wpjam_get_post_thumbnail_by_categories($post)){
			return $thumbnail_url;
		}
	}elseif($thumbnail_order == 2){
		if($thumbnail_url = wpjam_get_post_thumbnail_by_terms($post)){
			return $thumbnail_url;
		}

		if($thumbnail_url = wpjam_get_post_first_image($post)){
			return $thumbnail_url;
		}

		if($thumbnail_url = wpjam_get_post_thumbnail_by_categories($post)){
			return $thumbnail_url;
		}
	}elseif($thumbnail_order == 3){
		if($thumbnail_url = wpjam_get_post_thumbnail_by_categories($post)){
			return $thumbnail_url;
		}

		if($thumbnail_url = wpjam_get_post_first_image($post)){
			return $thumbnail_url;
		}

		if($thumbnail_url = wpjam_get_post_thumbnail_by_terms($post)){
			return $thumbnail_url;
		}
	}

	return '';
}, 10, 2);

function wpjam_get_post_thumbnail_by_categories($post){
	$post_taxonomies	= get_post_taxonomies($post);
	if($post_taxonomies && in_array('category', $post_taxonomies)){
		$categories = get_the_category($post);
		if($categories){
			foreach ($categories as $category) {
				if($category_thumbnail = wpjam_get_category_thumbnail_url($category)){
					return $category_thumbnail;
				}
			}
		}
	}

	return '';
}

function wpjam_get_post_thumbnail_by_terms($post){
	$post_taxonomies	= get_post_taxonomies($post);
	if($post_taxonomies){
		foreach($post_taxonomies as $taxonomy){
			if($taxonomy == 'category') continue;
			if($terms = get_the_terms($post,$taxonomy)){
				foreach ($terms as $term) {
					if($term_thumbnail = wpjam_get_term_thumbnail_url($term)){
						return $term_thumbnail;
					}
				}
			}
		}
	}

	return '';
}


add_filter('wpjam_post_json', function($post_json, $post_id, $args){
	if(empty($post_json['thumbnail'])){
		$post_json['thumbnail']	= wpjam_get_post_thumbnail_url($post_id, $args['thumbnail_size']);
	}

	return $post_json;

}, 10, 3);

add_filter('wpjam_related_post_json', function($related_json, $post_id, $args){
	if(empty($related_json['thumbnail'])){
		$related_json['thumbnail']	= wpjam_get_post_thumbnail_url($post_id, $args['thumbnail_size']);
	}

	return $related_json;

},10,3);




/* tag thumbnail */
function wpjam_has_tag_thumbnail(){
	return wpjam_has_term_thumbnail();
}

function wpjam_get_tag_thumbnail_url($term=null, $size='full', $crop=1, $retina=1){
	return wpjam_get_term_thumbnail_url($term, $size, $crop, $retina);
}

function wpjam_get_tag_thumbnail($term=null, $size='thumbnail', $crop=1, $class="wp-tag-image", $retina=2){
	return wpjam_get_term_thumbnail($term, $size, $crop, $class, $retina);
}

function wpjam_tag_thumbnail($size='thumbnail', $crop=1, $class="wp-tag-image", $retina=2){
	wpjam_term_thumbnail($size, $crop, $class, $retina);
}

/* category thumbnail */
function wpjam_has_category_thumbnail(){
	return wpjam_has_term_thumbnail();
}

function wpjam_get_category_thumbnail_url($term=null, $size='full', $crop=1, $retina=1){
	return wpjam_get_term_thumbnail_url($term, $size, $crop, $retina);
}

function wpjam_get_category_thumbnail($term=null, $size='thumbnail', $crop=1, $class="wp-category-image", $retina=2){
	return wpjam_get_term_thumbnail($term, $size, $crop, $class, $retina);
}

function wpjam_category_thumbnail($size='thumbnail', $crop=1, $class="wp-category-image", $retina=2){
	wpjam_term_thumbnail($size, $crop, $class, $retina);
}


function wpjam_get_category_thumbnail_src($term=null, $size='thumbnail', $crop=1, $retina=1){
	_deprecated_function(__FUNCTION__, 'WPJAM Basic 3.2', 'wpjam_get_term_thumbnail_url');
	return wpjam_get_term_thumbnail_url($term, $size, $crop, $retina);	
}

function wpjam_get_category_thumbnail_uri($term=null){
	_deprecated_function(__FUNCTION__, 'WPJAM Basic 3.2', 'wpjam_get_term_thumbnail_url');
	return wpjam_get_term_thumbnail_url($term, 'full');
}

function wpjam_get_tag_thumbnail_src($term=null, $size='thumbnail', $crop=1, $retina=1){
	_deprecated_function(__FUNCTION__, 'WPJAM Basic 3.2', 'wpjam_get_term_thumbnail_url');
	return wpjam_get_term_thumbnail_url($term, $size, $crop, $retina);	
}

function wpjam_get_tag_thumbnail_uri($term=null){
	_deprecated_function(__FUNCTION__, 'WPJAM Basic 3.2', 'wpjam_get_term_thumbnail_url');
	return wpjam_get_term_thumbnail_url($term, 'full');
}

function wpjam_get_term_thumbnail_src($term=null, $size='thumbnail', $crop=1, $retina=1){
	_deprecated_function(__FUNCTION__, 'WPJAM Basic 3.2', 'wpjam_get_term_thumbnail_url');
	return wpjam_get_term_thumbnail_url($term, $size, $crop, $retina);	
}

function wpjam_get_term_thumbnail_uri($term=null){
	_deprecated_function(__FUNCTION__, 'WPJAM Basic 3.2', 'wpjam_get_term_thumbnail_url');
	return wpjam_get_term_thumbnail_url($term, 'full');
}
