<?php
/** DIGIPRO Adapter **/
if(!class_exists('WPDigiPro_Theme_Adapter')):
	require_once('wpdigipro-adapter.php');
endif;
/** DIGIPRO License Listener **/
if(!class_exists('WPDigiPro_Theme_License_Adapter')):
	require_once('wpdigipro-license-adapter.php');
endif;
/** DIGIPRO Updater Listener **/
if(!class_exists('WPDigiPro_Theme_Update_Checker')):
	require_once('wpdigipro-update-checker.php');
endif;
$updateChecker=new WPDigiPro_Theme_Update_Checker();
?>