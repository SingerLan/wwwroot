<?php 
$media = wpjam_get_setting('wpjam_theme', 'theme_color');
if(  $media == 'blue' ) : 
?>
<?php endif;

if(  $media == 'green' ) : 
?>
<link rel="stylesheet" href="<?php bloginfo('template_directory'); ?>/static/css/color/green.css" type="text/css" />
<?php endif;

if(  $media == 'red' ) : 
?>
<link rel="stylesheet" href="<?php bloginfo('template_directory'); ?>/static/css/color/red.css" type="text/css" />
<?php endif;?>	