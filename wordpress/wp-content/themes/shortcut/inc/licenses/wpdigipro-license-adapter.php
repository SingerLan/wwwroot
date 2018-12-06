<?php
class WPDigiPro_Theme_License_Adapter extends WPDigiPro_Theme_Adapter {

	public $menu_slug = ''; public $text_domain = '';

	public function __construct($menu_slug, $text_domain) {
		$this->menu_slug = $menu_slug; $this->text_domain = $text_domain;
		add_action( 'admin_menu', array( $this, 'WPDigiPro_Adapter_AssetsMenu' ) );
		add_action('admin_enqueue_scripts', array(&$this, 'WPDigiPro_Adapter_Assets'));

		add_action('wp_ajax_wpdigipro_theme_license_action', array(&$this, 'WPDigiPro_Theme_License_Action'));
		add_action('wp_ajax_nopriv_wpdigipro_theme_license_action', array(&$this, 'WPDigiPro_Theme_License_Action'));
		$this->WPDigiPro_Check_License();
	}

	public function WPDigiPro_Adapter_Assets() {
		wp_register_script('wpdigipro-theme-license-js', get_template_directory_uri().'/inc/licenses/js/wpdigipro-license.js', array());
	}

	public function WPDigiPro_Adapter_Enqueue() {
		wp_enqueue_script('wpdigipro-theme-license-js');
	}

	public function WPDigiPro_Adapter_AssetsMenu() {
		global $menu;
		if($this->menu_slug!='') :
			$wpdigiproPage = add_submenu_page($this->menu_slug, __("授权更新"), __("授权更新"), 'manage_options', $this->menu_slug.'-licence', array($this, "WPDigiPro_Adapter_AssetsLicenseForm"));
		else :
			$wpdigiproPage = add_menu_page(__("授权更新"), __("授权更新"), 'manage_options', $this->text_domain.'-licence', array($this, "WPDigiPro_Adapter_AssetsLicenseForm"));
		endif;
		add_action("admin_print_styles-{$wpdigiproPage}", array(&$this, 'WPDigiPro_Adapter_Enqueue'));
	}

	public function WPDigiPro_Adapter_AssetsLicenseForm() {
		$datas=$this->WPDigiPro_Theme_Get_Code();
		if(isset($datas->licenseStatus)&&($datas->licenseStatus=='active')) : $license_action = true; else : $license_action = false; endif; ?>
		<style>.wpdigipro-licenses-form{background:#fff;border:1px solid #e0e0e0;border-radius:3px;margin:0 auto;margin-top:15px;padding:30px;width:50%}.wpdigipro-licenses-form input.wpdigipro-license-key{background-color:transparent;border:1px solid #e3e3e3;border-radius:4px;color:#565656;padding:8px 13px;height:36px;-webkit-box-shadow:none;box-shadow:none;position:relative;z-index:1;min-width:150px}.btn-info.btn-fill,.btn-info.btn-fill:active,.btn-info.btn-fill:hover{color:#FFF;background:rgba(251,0,0,.8);border:0;padding:8px 16px;outline:0;line-height:1.42857143;transition:all .3s ease-in-out}.btn{display:inline-block;padding:6px 12px;margin-bottom:0;font-size:14px;font-weight:400;line-height:1.42857143;text-align:center;white-space:nowrap;-ms-touch-action:manipulation;touch-action:manipulation;cursor:pointer;-webkit-user-select:none;-moz-user-select:none;-ms-user-select:none;user-select:none;border:1px solid transparent;border-radius:4px}</style>
		<form name="wpdigipro-licenses-form" class="wpdigipro-licenses-form" id="wpdigipro-licenses-form" method="post" data-action="<?php echo (($license_action)?'deactive':'active'); ?>">
			<div class="title-border wpdigipro-gird-md-12" style="display:inline-block;">
				<div class="wpdigipro-gird-md-12">
					<div class="form-group wpdigipro-gird-md-5">
						<?php $license_key='';if(isset($datas->key)&&$datas->key!=''): $license_key = substr($datas->key, 0, 2).'******************'.substr($datas->key, -2); endif; ?>
						<input class="wpdigipro-license-key" placeholder="输入更新密钥..." <?php if($license_action): echo 'readonly'; endif; ?> type="text" class="wpdigipro-license-key" id="wpdigipro-license-key" name="wpdigipro-license-key" value="<?php echo $license_key; ?>" >
					</div>	
					<div class="wpdigipro-gird-md-3" style="margin-top:10px;">
						<button type="submit" name="license-action" value="Deactivate" class="btn btn-info btn-fill"><?php (($license_action)? _e('停用', $this->text_domain): _e('激活', $this->text_domain)); ?></button>
					</div>
				</div>

				<div class="wpdigirpo-license-message wpdigipro-gird-md-12">
					<?php $digiproMessages = (isset($datas->message)?$this->DIGIPROSetMessage($datas->message):''); ?>
					<?php if(!empty($digiproMessages)) : //echo (isset($datas->message)?$datas->message:''); ?>
					<?php foreach($digiproMessages as $message) : ?>
						<p class="<?php if($datas->validityStatus==false): echo 'wpdigipro-error'; endif; ?>"><?php echo $message; ?></p>
					<?php endforeach; endif; ?>
				</div>
			</div>
		</form><?php
	}

	public function WPDigiPro_Theme_License_Action() {
		if(isset($_POST['license_action'])&&($_POST['license_action']!='')) :
			if($_POST['license_action']=='active') {
				$wpdigipro_license_request_args = array(
					'action'	=> 'wpdigipro-activate',
					'key'		=> $_POST['license_key'],
				);
			} else if($_POST['license_action']=='deactive'){
				$data=$this->WPDigiPro_Theme_Get_Code();
				$wpdigipro_license_request_args = array(
					'action'	=> 'wpdigipro-deactive',
					'key'		=> (isset($data->key)?$data->key:''),
				);
			}

			$wpdigipro_response_data = $this->WPDigiPro_Theme_API_Action($wpdigipro_license_request_args); 
			$wpdigipro_return_response = array(); $wpdigipro_option_name='wpdigipro-'.WPDIGIPROTHEME_DIRECTORY_NAME.'-theme-secure-license-material';
			if($wpdigipro_response_data) :
				if(isset($wpdigipro_response_data->status) && ($wpdigipro_response_data->status=='success')) :
					$wpdigipro_return_response=$args=array('key'=>$_POST['license_key'],'status'=>$wpdigipro_response_data->status,'message'=>$wpdigipro_response_data->message,'scheme'=>$wpdigipro_response_data->scheme,'licenseStatus'=>$wpdigipro_response_data->licenseStatus,'validityStatus'=>$wpdigipro_response_data->validityStatus);
					$materialString=$this->DIGIPROLicenseMaterialClose($args);
					update_option($wpdigipro_option_name,$materialString);
				else :
					$wpdigipro_return_response=$args=array('key'=>$data->key,'status'=>$wpdigipro_response_data->status,'message'=>$wpdigipro_response_data->message,'scheme'=>$wpdigipro_response_data->scheme,'licenseStatus'=>$wpdigipro_response_data->licenseStatus,'validityStatus'=>$wpdigipro_response_data->validityStatus);
					$materialString='';
					update_option($wpdigipro_option_name,$materialString);
				endif;
			endif;
			echo json_encode($wpdigipro_return_response); exit;
		endif;
	}
	public function WPDigiPro_Check_License() {
		$datas=$this->WPDigiPro_Theme_Get_Code();
		if(($this->WPDigiPro_Theme_Schedule())&&(!empty($datas))&&(isset($datas->key))&&($datas->key!='')) :
			$wpdigipro_license_request_args = array('action'=>'wpdigipro-check','key'=>$datas->key);
			$wpdigipro_response_data = $this->WPDigiPro_Theme_API_Action($wpdigipro_license_request_args);
			if($wpdigipro_response_data) :
				$args=array('key'=>$datas->key,'status'=>$wpdigipro_response_data->status,'message'=>$wpdigipro_response_data->message,'scheme'=>$wpdigipro_response_data->scheme,'licenseStatus'=>$wpdigipro_response_data->licenseStatus,'validityStatus'=>$wpdigipro_response_data->validityStatus);
				$materialString=$this->DIGIPROLicenseMaterialClose($args);
				$wpdigipro_option_name='wpdigipro-'.WPDIGIPROTHEME_DIRECTORY_NAME.'-theme-secure-license-material';
				update_option($wpdigipro_option_name,$materialString);
			endif;
		endif;return true;
	}
	public function DIGIPROSetMessage($messageString) {
		$messages = array(); if($messageString!='') { $messages = explode('|', $messageString); } return $messages;
	}
}
?>