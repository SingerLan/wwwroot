<?php get_header();

$post_extend = get_post_meta($post->ID, 'post_layout', true);
if( $post_extend ){
	$template_name = $post_extend;
}else{
	$template_name = '1';
}

get_template_part( 'template-parts/single', $template_name );

get_footer();