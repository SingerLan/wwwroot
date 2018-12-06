<?php
if(!defined( 'WPDIGIPRO_REMOTE_URL' )) : define('WPDIGIPRO_REMOTE_URL', 'https://bestwppay.com'); endif;
if(!defined( 'WPDIGIPROTHEME_DIRECTORY_NAME' )):define('WPDIGIPROTHEME_DIRECTORY_NAME', 'shortcut');endif;
if(!defined( 'WPDIGIPROTHEME_REFERENCE' )):define('WPDIGIPROTHEME_REFERENCE', 169);endif; 

class WPDigiPro_Theme_Adapter {

	public function WPDigiPro_Theme_API_Action($licenseDatas) {
		if(is_array($licenseDatas)) :
			$licenseParams = array(
				'wpdigipro-action' 	=>	$licenseDatas['action'],
				'license-key' 		=>	base64_encode($licenseDatas['key']),
				'registered-site'	=>	base64_encode(home_url()),
				'reference'			=>	WPDIGIPROTHEME_REFERENCE,
			);
			$remoteQuery=esc_url_raw(add_query_arg($licenseParams, WPDIGIPRO_REMOTE_URL));
			
			$response=wp_remote_get($remoteQuery, array('timeout'=>20,'sslverify'=>false));
			if((isset($response['body']))&&($response['body']!='')):$responseDatas=json_decode($response['body']);return $responseDatas;endif;
		endif; return false;
	}

	public function WPDigiPro_Theme_Schedule() {
		$datas=$this->WPDigiPro_Theme_Get_Code(); if(isset($datas->scheme)) :
		$nextDay=strtotime('+1 day', $datas->scheme);$today=current_time('timestamp');
		if($today>=$nextDay) {return true;} else {return false;} endif; return false;
	}

	public function WPDigiPro_Theme_Get_Code() {$optionName='wpdigipro-'.WPDIGIPROTHEME_DIRECTORY_NAME.'-theme-secure-license-material';return $this->DIGIPROLicenseMaterialOpen(get_option($optionName));}

	public function DIGIPROLicenseMaterialClose($originalDatas) {return base64_encode(serialize($originalDatas));}

	public function DIGIPROLicenseMaterialOpen($encryptionDatas) {return (object)unserialize(base64_decode($encryptionDatas));}
}
?>