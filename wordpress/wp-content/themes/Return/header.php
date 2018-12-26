<?php
$slide_type = wpjam_get_setting('wpjam_theme', 'slide_region');
if($slide_type == 'magazine' ) : include( 'template-parts/magazine.php' );
elseif($slide_type == 'silide') : include( 'template-parts/silide.php' );
elseif($slide_type == 'silide2') : include( 'template-parts/silide2.php' );
elseif($slide_type == 'close') : include( 'template-parts/slider-close.php' );
else : include( 'template-parts/magazine.php' );
endif;?>