<?php get_header();
$tag_type = wpjam_get_setting('wpjam_theme', 'tag_region');
if($tag_type == 'list1' ) : include( 'template-parts/list-1.php' );
elseif($tag_type == 'list2') : include( 'template-parts/list-2.php' );
elseif($tag_type == 'list3') : include( 'template-parts/list-3.php' );
elseif($tag_type == 'list4') : include( 'template-parts/list-4.php' );
else : include( 'template-parts/list-1.php' );
endif;
get_footer(); 