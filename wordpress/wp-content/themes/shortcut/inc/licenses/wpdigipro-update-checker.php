<?php
if ( !class_exists('WPDigiPro_Theme_Update_Checker') ):

class WPDigiPro_Theme_Update_Checker extends WPDigiPro_Theme_Adapter {
	public $theme = '';			
	public $metadataUrl = '';	
	public $enableAutomaticChecking = true; 
	
	protected $optionName = '';		
	protected $automaticCheckDone = false;
	protected static $filterPrefix = 'tuc_request_update_';


	public function __construct($enableAutomaticChecking = true){
		$this->metadataUrl = WPDIGIPRO_REMOTE_URL;
		$this->theme = WPDIGIPROTHEME_DIRECTORY_NAME;
		$this->productReference = WPDIGIPROTHEME_REFERENCE;
		$this->enableAutomaticChecking = $enableAutomaticChecking;
		$this->optionName = 'external_theme_updates-'.$this->theme;
		$this->installHooks();
	}
	
	public function installHooks(){
		
		if ( $this->enableAutomaticChecking ){
			add_filter('pre_set_site_transient_update_themes', array($this, 'onTransientUpdate'));
		}
		
		
		add_filter('site_transient_update_themes', array($this,'injectUpdate')); 
		
		add_action('delete_site_transient_update_themes', array($this, 'deleteStoredData'));
	}
	
	public function requestUpdate($queryArgs = array()){
		
		$currentVersion = $this->getInstalledVersion();
		$queryArgs['installed_version'] = $currentVersion;
		$queryArgs['wpdigipro-action'] = 'wpdigipro-update';
		$datas=$this->WPDigiPro_Theme_Get_Code();
		if(isset($datas->status)&&($datas->status=="success")&&($datas->validityStatus==true)):
			$queryArgs['license-key'] = base64_encode($datas->key);
			$queryArgs['registered-site'] = base64_encode(home_url());
			$queryArgs['item-type'] = 'themes';
			$queryArgs['current-version'] = $currentVersion;
			$queryArgs['reference'] = $this->productReference;
		endif;
		
		$queryArgs = apply_filters(self::$filterPrefix.'query_args-'.$this->theme, $queryArgs);
		
		$options = array(
			'timeout' => 10,
		);
		$options = apply_filters(self::$filterPrefix.'options-'.$this->theme, $options);
		
		$url = $this->metadataUrl; 
		if ( !empty($queryArgs) ){
			$url = add_query_arg($queryArgs, $url);
		}
		
		$result = wp_remote_get($url, $options);
		
		$themeUpdate = null;
		$code = wp_remote_retrieve_response_code($result);
		$body = wp_remote_retrieve_body($result);
		if ( ($code == 200) && !empty($body) ){
			$themeUpdate = ThemeUpdate::fromJson($body);
			
			if ( ($themeUpdate != null) && version_compare($themeUpdate->version, $this->getInstalledVersion(), '<=') ){
				$themeUpdate = null;
			}
		}
		
		$themeUpdate = apply_filters(self::$filterPrefix.'result-'.$this->theme, $themeUpdate, $result);
		return $themeUpdate;
	}
	
	public function getInstalledVersion(){
		if ( function_exists('wp_get_theme') ) {
			$theme = wp_get_theme($this->theme);
			return $theme->get('Version');
		}
		
		foreach(get_themes() as $theme){
			if ( $theme['Stylesheet'] === $this->theme ){
				return $theme['Version'];
			}
		}
		return '';
	}
	
	public function checkForUpdates(){
		$state = get_option($this->optionName);
		if ( empty($state) ){
			$state = new StdClass;
			$state->lastCheck = 0;
			$state->checkedVersion = '';
			$state->update = null;
		}
		
		$state->lastCheck = time();
		$state->checkedVersion = $this->getInstalledVersion();
		update_option($this->optionName, $state); 
		
		$state->update = $this->requestUpdate();
		update_option($this->optionName, $state);
	}
	
	public function onTransientUpdate($value){
		if ( !$this->automaticCheckDone ){
			$this->checkForUpdates();
			$this->automaticCheckDone = true;
		}
		return $value;
	}
	
	public function injectUpdate($updates){
		$state = get_option($this->optionName);
		
		if ( !empty($state) && isset($state->update) && !empty($state->update) ){
			$updates->response[$this->theme] = $state->update->toWpFormat();
		}
		
		return $updates;
	}
	
	public function deleteStoredData(){
		delete_option($this->optionName);
	} 
	
	public function addQueryArgFilter($callback){
		add_filter(self::$filterPrefix.'query_args-'.$this->theme, $callback);
	}
	
	public function addHttpRequestArgFilter($callback){
		add_filter(self::$filterPrefix.'options-'.$this->theme, $callback);
	}
	
	public function addResultFilter($callback){
		add_filter(self::$filterPrefix.'result-'.$this->theme, $callback, 10, 2);
	}
}
	
endif;

if ( !class_exists('ThemeUpdate') ):

class ThemeUpdate {
	public $version;
	public $details_url;
	public $download_url;
	
	public static function fromJson($json){
		$apiResponse = json_decode($json);
		if ( empty($apiResponse) || !is_object($apiResponse) ){
			return null;
		}
		
		$valid = isset($apiResponse->version) && !empty($apiResponse->version) && isset($apiResponse->details_url) && !empty($apiResponse->details_url);
		if ( !$valid ){
			return null;
		}
		
		$update = new self();
		foreach(get_object_vars($apiResponse) as $key => $value){
			$update->$key = $value;
		}
		
		return $update;
	}
	
	public function toWpFormat(){
		$update = array(
			'new_version' => $this->version,
			'url' => $this->details_url,
		);
		if ( !empty($this->download_url) ){
			$update['package'] = base64_decode($this->download_url); 
		}
		
		return $update;
	}
}
	
endif;
