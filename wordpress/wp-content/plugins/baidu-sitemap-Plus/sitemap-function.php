<?php
/** Plugin Author **/
$lc_author = 'STAY MA BLOG';
$lc_authorurl = 'https://www.stayma.cn/';
$lc_plugin = 'Baidu Sitemap Generator plus';
$lc_pluginversion = '1.0.0';
$lc_pluginurl = 'https://www.stayma.cn/Baidu-Sitemap-Generator-Plus.html';

/**  End **/
/*
*@author arnee
*google-sitemap-generator
*/
#region PHP5 compat functions

if (!function_exists('file_get_contents')) {
	function file_get_contents($filename, $incpath = false, $resource_context = null) {
		if (false === $fh = fopen($filename, 'rb', $incpath)) {
			user_error('file_get_contents() failed to open stream: No such file or directory', E_USER_WARNING);
			return false;
		}
		clearstatcache();
		if ($fsize = @filesize($filename)) {
			$data = fread($fh, $fsize);
		} else {
			$data = '';
			while (!feof($fh)) {
				$data .= fread($fh, 8192);
			}
		}
		
		fclose($fh);
		return $data;
	}
}


if(!function_exists('file_put_contents')) {
	
	if (!defined('FILE_USE_INCLUDE_PATH')) {
		define('FILE_USE_INCLUDE_PATH', 1);
	}
	
	if (!defined('LOCK_EX')) {
		define('LOCK_EX', 2);
	}
	
	if (!defined('FILE_APPEND')) {
		define('FILE_APPEND', 8);
	}
	
	function file_put_contents($filename, $content, $flags = null, $resource_context = null) {
		// If $content is an array, convert it to a string
		if (is_array($content)) {
			$content = implode('', $content);
		}
		
		// If we don't have a string, throw an error
		if (!is_scalar($content)) {
			user_error('file_put_contents() The 2nd parameter should be either a string or an array',E_USER_WARNING);
			return false;
		}
		
		// Get the length of data to write
		$length = strlen($content);
		
		// Check what mode we are using
		$mode = ($flags & FILE_APPEND)?'a':'wb';
		
		// Check if we're using the include path
		$use_inc_path = ($flags & FILE_USE_INCLUDE_PATH)?true:false;
		
		// Open the file for writing
		if (($fh = @fopen($filename, $mode, $use_inc_path)) === false) {
			user_error('file_put_contents() failed to open stream: Permission denied',E_USER_WARNING);
			return false;
		}
		
		// Attempt to get an exclusive lock
		$use_lock = ($flags & LOCK_EX) ? true : false ;
		if ($use_lock === true) {
			if (!flock($fh, LOCK_EX)) {
				return false;
			}
		}
		
		// Write to the file
		$bytes = 0;
		if (($bytes = @fwrite($fh, $content)) === false) {
			$errormsg = sprintf('file_put_contents() Failed to write %d bytes to %s',$length,$filename);
			user_error($errormsg, E_USER_WARNING);
			return false;
		}
		
		// Close the handle
		@fclose($fh);
		
		// Check all the data was written
		if ($bytes != $length) {
			$errormsg = sprintf('file_put_contents() Only %d of %d bytes written, possibly out of free disk space.',$bytes,$length);
			user_error($errormsg, E_USER_WARNING);
			return false;
		}
		
		// Return length
		return $bytes;
	}
	
}
#endregion


/*
*@author arnee
*google-sitemap-generator
*/
if (!function_exists('LCZ_GetHomePath')) {
function LCZ_GetHomePath() {
	
	if(LCZ_IS_SAE()){ return "saestor://wordpress/"; } ## SAE»·¾³
	#if(LCZ_IS_SAE()){ return "saekv://wordpress/"; } ## SAE»·¾³, saestorÎÞ·¨ÓÃµÄ£¬¿É¸ÄÎªsaekv, Á½¸öSAE_XXX.phpµÄÎÄ¼þÒ²ÐèÍ¬Ê±ÐÞ¸Ä
	$res="";
	//Check if we are in the admin area -> get_home_path() is avaiable
	if(function_exists("get_home_path")) {
		$res = get_home_path();
	} else {
		//get_home_path() is not available, but we can't include the admin
		//libraries because many plugins check for the "check_admin_referer"
		//function to detect if you are on an admin page. So we have to copy
		//the get_home_path function in our own...
		$home = get_option( 'home' );
		if ( $home != '' && $home != get_option( 'siteurl' ) ) {
			$home_path = parse_url( $home );
			$home_path = $home_path['path'];
			$root = str_replace( $_SERVER["PHP_SELF"], '', $_SERVER["SCRIPT_FILENAME"] );
			$home_path = trailingslashit( $root.$home_path );
		} else {
			$home_path = ABSPATH;
		}

		$res = $home_path;
	}
	return $res;
}
}



/*
*@author arnee
*google-sitemap-generator
*/
function LCZ_EscapeXML($string) {
	return str_replace ( array ( '&', '"', "'", '<', '>'), array ( '&amp;' , '&quot;', '&apos;' , '&lt;' , '&gt;'), $string);
}


/**
 * Checks if a file is writable and tries to make it if not.
 *
 * @since 3.05b
 * @access private
 * @author  VJTD3 <http://www.VJTD3.com>
 * @return bool true if writable
 */
if (!function_exists('LCZ_IsFileWritable')) {
function LCZ_IsFileWritable($filename) {
	if(LCZ_IS_SAE()){ return true; } ## SAE»·¾³
	clearstatcache();
	//can we write?
	if(!is_writable($filename)) {
		//no we can't.
		if(!@chmod($filename, 0666)) {
			$pathtofilename = dirname($filename);
			//Lets check if parent directory is writable.
			if(!is_writable($pathtofilename)) {
				//it's not writeable too.
				if(!@chmod($pathtoffilename, 0666)) {
					//darn couldn't fix up parrent directory this hosting is foobar.
					//Lets error because of the permissions problems.
					return false;
				}
			}
		}
	}
	//we can write, return 1/true/happy dance.
	return true;
}
}

/*
*
*Un-quotes quoted string\
*/
if (!function_exists('LCZ_stripslashes_deep')) {
	function LCZ_stripslashes_deep($value)
	{
		$value = is_array($value) ?
					array_map('LCZ_stripslashes_deep', $value) :
					stripslashes($value);

		return $value;
	}
}


/**
 * Returns the path to the directory where the plugin file is located
 * @since 3.0b5
 * @access private
 * @author Arne Brachhold
 * @return string The path to the plugin directory
 */
if (!function_exists('LCZ_GetPluginPath')) {
function LCZ_GetPluginPath() {
	$path = dirname(__FILE__);
	return trailingslashit(str_replace("\\","/",$path));
}
}


/**
 * Returns the URL to the directory where the plugin file is located
 * @since 3.0b5
 * @access private
 * @author Arne Brachhold
 * @return string The URL to the plugin directory
 */
if (!function_exists('LCZ_GetPluginUrl')) {
function LCZ_GetPluginUrl() {
	//Try to use WP API if possible, introduced in WP 2.6
	if (function_exists('plugins_url')) return trailingslashit(plugins_url(basename(dirname(__FILE__))));
	
	//Try to find manually... can't work if wp-content was renamed or is redirected
	$path = dirname(__FILE__);
	$path = str_replace("\\","/",$path);
	$path = trailingslashit(get_bloginfo('wpurl')) . trailingslashit(substr($path,strpos($path,"wp-content/")));
	return $path;
}
}


/**
*Loading language file...
*load_plugin_textdomain('baidu_sitemap');
*@author Arne Brachhold
*/
function load_baidu_language() {

}


function LCZ_sidebar() {
	    global $lc_author, $lc_authorurl, $lc_plugin, $lc_pluginversion, $lc_pluginurl;
		?>
		<style type="text/css">
				
		a.lc_button {
			padding:4px;
			display:block;
			padding-left:25px;
			background-repeat:no-repeat;
			background-position:5px 50%;
			text-decoration:none;
			border:none;
		}
		
		a.lc_button:hover {
			border-bottom-width:1px;
		}

		a.lc_donatePayPal {
			background-image:url(<?php echo LCZ_GetPluginUrl(); ?>img/icon-paypal.gif);
		}
		
		a.lc_donateFavorite {
			background-image:url(<?php echo LCZ_GetPluginUrl(); ?>img/favorite_icon.png);
		}
		
		a.lc_pluginHome {
			background-image:url(<?php echo LCZ_GetPluginUrl(); ?>img/liucheng_name16.png);
		}
		
		a.lc_pluginList {
			background-image:url(<?php echo LCZ_GetPluginUrl(); ?>img/icon-email.gif);
		}
		
		a.lc_pluginBugs {
			background-image:url(<?php echo LCZ_GetPluginUrl(); ?>img/rss_icon.png);
		}
		
		a.lc_resBaidu {
			background-image:url(<?php echo LCZ_GetPluginUrl(); ?>img/baidu.png);
		}
		
		a.lc_resRss {
			background-image:url(<?php echo LCZ_GetPluginUrl(); ?>img/rss_icon.png);
		}
		
		a.lc_resWordpress {
			background-image:url(<?php echo LCZ_GetPluginUrl(); ?>img/wordpress_icon2.png);
		}
		
		</style>


		<div class="postbox-container" style="width:21%;">
			<div class="metabox-holder">	
				<div class="meta-box-sortables">			

			     <div id="lc_smres" class="postbox">
					<h3 class="hndle"><span ><?php _e('About Baidu-Sitemap:');?></span></h3>
					  <div class="inside">最新修复版Baidu-Sitemap版本，兼容PHP7+版本。<br>
						网址：<a href="https://www.stayma.cn/" target="_blank">STAYMA博客</a>
						<p>如果发现不能使用，请在<a href="https://www.stayma.cn/" target="_blank">STAYMA博客</a>下载<a target="_blank" href="https://www.stayma.cn/Baidu-Sitemap-Generator-Plus.html">最新版本</a>，此插件不提供在线更新服务。</p>
					</div>
				</div>
			</div>
		</div>
	</div>
<?php
}

function LCZ_rebuild_message() {
	if(function_exists("wp_next_scheduled")) {
		$next = wp_next_scheduled('do_this_auto');
		if($next) {
			$diff = (time()-$next)*-1;
			if($diff <= 0) {
				$diffMsg = __('Your sitemap is being refreshed at the moment. Depending on your Post Count this might take some time!');
			} else {
				$diffMsg = str_replace("%s",$diff,__('Your sitemap will be refreshed in %s seconds!'));
			}
		}else{
				$diffMsg = __('Donot activate the Auto build the sitema options, you need build the XML file by yourself.');
		}
		echo "<strong><p>$diffMsg</p></strong>";	
	}
}
function xml_file_exist() {
	$array_baidu_sitemap_options = get_baidu_sitemap_options();
	$lc_blog_url = home_url();
	$fileName = LCZ_GetHomePath();
	$filename = $fileName.$array_baidu_sitemap_options['lc_XML_FileName'].'.xml';;
	echo '<div class="tool-box">';
	echo '<h3 class="title">';
	_e('XML File Status');
	print '</h3>';
    if(file_exists($filename)){
		//$filctime=date("Y-m-d H:i:s",filectime("$filename")); 
		$filemtime=date("Y-m-d H:i:s",filemtime("$filename")); 
		//$fileatime=date("Y-m-d H:i:s",fileatime("$filename")); 
		echo "<p>";
		#_e('When you change Path of the XML file(Better not). please use 301 redirect to the new XML-file, or setting as 404 page.');
		echo "</p>";
		echo '<p>'; _e('Check XML-sitemap File: '); echo '<a href="'.$lc_blog_url.'/'.$array_baidu_sitemap_options['lc_XML_FileName'].'.xml'.'" target="_blank">'.$lc_blog_url.'/'.$array_baidu_sitemap_options['lc_XML_FileName'].'.xml'.'</a></p>';
		#echo '<p>'; _e('Last updated: '); print $filemtime.'</p>';
		echo '';
	}else{
		_e('百度站点地图不存在，请生成一个XML地图');
	}
	$sitemap_html = LCZ_GetHomePath().'sitemap.html'; if(file_exists($sitemap_html)) { echo '<p>'; _e('Check SiteMap Html: '); echo '<a href="'.$lc_blog_url.'/sitemap.html'.'" target="_blank">'.$lc_blog_url.'/sitemap.html'.'</a></p>'; }
	echo '</div>';
}
function xml_annotate() {
	global $lc_author, $lc_authorurl, $lc_plugin, $lc_pluginversion, $lc_pluginurl, $wp_version;
	$blogtime = current_time('mysql'); 
	list( $today_year, $today_month, $today_day, $hour, $minute, $second ) = preg_split( '([^0-9])', $blogtime );
	$xml_author_annotate = '<!-- baidu-sitemap-generator-version="'.$lc_pluginversion.'" --><!-- generated-on="'."$today_year-$today_month-$today_day $hour:$minute:$second".'" -->';
    return $xml_author_annotate;
}

function LCZ_GetTimestampFromMySql($mysqlDateTime) {
	list($date, $hours) = explode(' ', $mysqlDateTime);
	list($year,$month,$day) = explode('-',$date);
	list($hour,$min,$sec) = explode(':',$hours);
	return mktime(intval($hour), intval($min), intval($sec), intval($month), intval($day), intval($year));
}

function LCZ_IS_SAE(){

	$array_baidu_sitemap_options = get_baidu_sitemap_options();
	if($array_baidu_sitemap_options['is_sina_sae']){
		return true;
	}else{
		return false;
	}
}
?>