<?php
/*
Plugin Name:Baidu Sitemap Generator Plus
Plugin URI: https://www.stayma.cn/Baidu-Sitemap-Generator-Plus.html
Description: 生成百度 Sitemap XML 文件。就相当于网站被百度--全球最大的中文搜索引擎订阅，进而为您的网站带来潜在的流量。同时生成一个静态的站点地图页面，对所有的搜索引擎都有利。
Author: STAYMA
Version: 1.0.0
Author URI: https://www.stayma.cn/
*/


/** define the field name of database **/
define('NEW_BAIDU_SITEMAP_OPTION','new_baidu_sitemapoption');


require_once("sitemap-function.php");

/** add a Menu,like "Baidu Sitemap" **/
function baidu_sitemap_menu() {
   /** Add a page to the options section of the website **/
   if (current_user_can('manage_options'))
        add_options_page("Baidu-Sitemap","Baidu-Sitemap", 'manage_options', __FILE__, 'baidu_sitemap_optionpage');
}

/** custom message **/
function baidu_sitemap_topbarmessage($msg) {
	 echo '<div class="updated fade" id="message"><p>' . $msg . '</p></div>';
}

function get_baidu_sitemap_options(){
	$array_baidu_sitemap_options = array();
	$get_baidu_sitemap_options = get_option(NEW_BAIDU_SITEMAP_OPTION);
	if( $get_baidu_sitemap_options ){
		list( $array_baidu_sitemap_options['lc_is_Enabled_XML_Sitemap'], $array_baidu_sitemap_options['lc_is_Enabled_Html_Sitemap'], $array_baidu_sitemap_options['lc_is_update_sitemap_when_post'], $array_baidu_sitemap_options['lc_post_limit1000'], $array_baidu_sitemap_options['lc_post_select'], $array_baidu_sitemap_options['lc_page_select'], $array_baidu_sitemap_options['lc_category_select'], $array_baidu_sitemap_options['lc_tag_select'], $array_baidu_sitemap_options['is_sina_sae'], $array_baidu_sitemap_options['lc_XML_FileName']) = explode("|",$get_baidu_sitemap_options);
	}else{
		if( !$array_baidu_sitemap_options['lc_XML_FileName'] ){ $array_baidu_sitemap_options['lc_XML_FileName'] = 'sitemap_baidu'; }
		if( !$array_baidu_sitemap_options['lc_is_Enabled_XML_Sitemap'] ){ $array_baidu_sitemap_options['lc_is_Enabled_XML_Sitemap'] = '1'; }
		if( !$array_baidu_sitemap_options['lc_is_update_sitemap_when_post'] ){ $array_baidu_sitemap_options['lc_is_update_sitemap_when_post'] = '1'; }
		if( !$array_baidu_sitemap_options['lc_post_limit1000'] ){ $array_baidu_sitemap_options['lc_post_limit1000'] = '1'; }
		if( !$array_baidu_sitemap_options['lc_post_select'] ){ $array_baidu_sitemap_options['lc_post_select'] = '1'; }
		if( !$array_baidu_sitemap_options['lc_page_select'] ){ $array_baidu_sitemap_options['lc_page_select'] = '1'; }
		if( !$array_baidu_sitemap_options['lc_category_select'] ){ $array_baidu_sitemap_options['lc_category_select'] = '1'; }
	}
	return $array_baidu_sitemap_options;
}

/** Baidu sitemap page **/
function baidu_sitemap_form() {
	$array_baidu_sitemap_options = get_baidu_sitemap_options();
	?>
		<div class="postbox-container" style="width:75%;">
		<div class="metabox-holder">
		<div class="meta-box-sortables">	
						
		<div class="tool-box">
			<h3 class="title"><?php _e('常规');?></h3>
			<p><?php _e('百度站点地图生成器插件的参数设置。 ');?></p>
			<a name="baidu_sitemap_options"></a><form name="baidu_sitemap_options" method="post" action="">
			<input type="hidden" name="action" value="build_options" />
			<table>
				<tr><td><h3><?php _e('General Options');?></h3></td></tr>
				<tr><td><?php _e('模式');?></td><td><input type="radio" name="lc_XML_FileName" value="sitemap_baidu" <?php if( $array_baidu_sitemap_options['lc_XML_FileName']=='sitemap_baidu' ) { echo 'checked="checked"'; } ?> />sitemap_baidu</td></tr>
				<tr><td></td><td><input type="radio" name="lc_XML_FileName" value="sitemap" <?php if( $array_baidu_sitemap_options['lc_XML_FileName']=='sitemap' ) { echo 'checked="checked"'; } ?> />sitemap</td></tr>

				<tr><td><?php _e('启用XML站点地图');?></td><td><input type="checkbox" name="lc_is_Enabled_XML_Sitemap" value="1" <?php if( $array_baidu_sitemap_options['lc_is_Enabled_XML_Sitemap'] ) { echo 'checked="checked"'; } ?> /></td></tr>
				<tr><td><?php _e('启用HTML站点地图');?></td><td><input type="checkbox" name="lc_is_Enabled_Html_Sitemap" value="1" <?php if( $array_baidu_sitemap_options['lc_is_Enabled_Html_Sitemap'] ) { echo 'checked="checked"'; } ?> /></td><td><a title="<?php _e('Also Build a real Static Sitemap-Page for all Search Engine.');?>">[?]</a><td></tr>
				<tr><td><?php _e('发布文章时更新站点地图');?></td><td><input type="checkbox" name="lc_is_update_sitemap_when_post" value="1" <?php if( $array_baidu_sitemap_options['lc_is_update_sitemap_when_post'] ) { echo 'checked="checked"'; } ?> /></td></tr>
				<tr><td><?php _e('限制1000篇文章');?></td><td><input type="checkbox" name="lc_post_limit1000" value="1" <?php if( $array_baidu_sitemap_options['lc_post_limit1000'] ) { echo 'checked="checked"'; } ?> /></td><td><a title="<?php _e('XML file just need include the Recent Post and Update Post. Needs much more memory if increase the Post Count.');?>">[?]</a><td></tr>
				<tr><td>链接包括：</td><td><input type="checkbox" name="lc_post_select" value="1" <?php if( $array_baidu_sitemap_options['lc_post_select'] ) { echo 'checked="checked"'; } ?> readonly />文章</td></tr>
				<tr><td></td><td><input type="checkbox" name="lc_page_select" value="1" <?php if( $array_baidu_sitemap_options['lc_page_select'] ) { echo 'checked="checked"'; } ?> />页面</td></tr>
				<tr><td></td><td><input type="checkbox" name="lc_category_select" value="1" <?php if( $array_baidu_sitemap_options['lc_category_select'] ) { echo 'checked="checked"'; } ?> />目录</td></tr>
				<tr><td></td><td><input type="checkbox" name="lc_tag_select" value="1" <?php if( $array_baidu_sitemap_options['lc_tag_select'] ) { echo 'checked="checked"'; } ?> />标签</td></tr>
				<tr><td><?php _e('sina sae');?></td><td><input type="checkbox" name="is_sina_sae" value="1" <?php if( $array_baidu_sitemap_options['is_sina_sae'] ) { echo 'checked="checked"'; } ?> /></td><td><a title="<?php _e('如果是新浪的SAE平台请打勾');?>">[?]</a><td></tr>
			</table>
			<p class="submit"><input type="submit" class="button-primary" /></p>
			</form>
		</div>


		<div class="tool-box">
		<h3 class="title"><?php _e('生成XML文件');?></h3>
				<form name="baidu_sitemap_build" method="post" action="">
				<input type="hidden" name="action" value="build_xml" />
				<p class="submit"><input type="submit" class="button-primary" value="更新XML地图" /></p>
				</form>
		</div>


			<?php
			/** show the XML file if exist **/ 
			xml_file_exist();

			/** Show others information **/
			LCZ_text();
			LCZ_for_SAE();
			?>
		</div>
		</div>
		</div>
	<?php
}


/** Baidu sitemap page **/
function baidu_sitemap_optionpage()
{
      /** Perform any action **/
		if(isset($_POST["action"])) {
			if ($_POST["action"]=='build_options') {update_baidu_sitemap_options(); }
		    if ($_POST["action"]=='build_xml') { build_baidu_sitemap($mes=1);}
		}
		
		/** Definition **/
      echo '<div class="wrap"><div style="background: url('.LCZ_GetPluginUrl().'img/liucheng_name32.png) no-repeat;" class="icon32"><br /></div>';
		echo '<h2>Baidu Sitemap Generator Plus</h2>';

		/** Introduction **/ 
		echo '<p>'. _e('Baidu Sitemap Generator Plus用于WordPress生成百度专用的Sitemap静态页面') .'</p>';

		
		/** show the option Form **/ 
		baidu_sitemap_form();
		//test_form();

		/** Show the plugins Author **/
		LCZ_sidebar();
	
        
		//echo '</div>';
}

/** update the options **/
function update_baidu_sitemap_options() {
	if ($_POST['action']=='build_options'){
		$lc_is_Enabled_XML_Sitemap = $_POST['lc_is_Enabled_XML_Sitemap'];
		if(!$lc_is_Enabled_XML_Sitemap){ $lc_is_Enabled_XML_Sitemap = 0; }
		$lc_is_Enabled_Html_Sitemap = $_POST['lc_is_Enabled_Html_Sitemap'];
		if(!$lc_is_Enabled_Html_Sitemap){ $lc_is_Enabled_Html_Sitemap = 0; }
		$lc_is_update_sitemap_when_post = $_POST['lc_is_update_sitemap_when_post'];
		if(!$lc_is_update_sitemap_when_post){ $lc_is_update_sitemap_when_post = 0; }
		$lc_post_limit1000 = $_POST['lc_post_limit1000'];
		if(!$lc_post_limit1000){ $lc_post_limit1000 = 0; }
		################## NEW~
		$lc_post_select = $_POST['lc_post_select'];
		if(!$lc_post_select){ $lc_post_select = 1; }
		$lc_page_select = $_POST['lc_page_select'];
		if(!$lc_page_select){ $lc_page_select = 0; }
		$lc_category_select = $_POST['lc_category_select'];
		if(!$lc_category_select){ $lc_category_select = 0; }
		$lc_tag_select = $_POST['lc_tag_select'];
		if(!$lc_tag_select){ $lc_tag_select = 0; }
		##################
		$is_sina_sae = $_POST['is_sina_sae'];
		if(!$is_sina_sae){ $is_sina_sae = 0; }

		$lc_XML_FileName = $_POST['lc_XML_FileName'];
		if(!$lc_XML_FileName){ $lc_XML_FileName = 'sitemap_baidu'; }
		$baidu_sitemap_options = implode('|',array($lc_is_Enabled_XML_Sitemap, $lc_is_Enabled_Html_Sitemap, $lc_is_update_sitemap_when_post, $lc_post_limit1000, $lc_post_select, $lc_page_select, $lc_category_select, $lc_tag_select, $is_sina_sae, $lc_XML_FileName));
		update_option(NEW_BAIDU_SITEMAP_OPTION,$baidu_sitemap_options); 
        baidu_sitemap_topbarmessage(__('Congratulate, Update options success'));
	}
}


/** build the XML file, sitemap.xml **/
function build_baidu_sitemap($mes=0) {
    global $wpdb, $posts;
	$array_baidu_sitemap_options = get_baidu_sitemap_options();
	if($array_baidu_sitemap_options['lc_post_limit1000']){ $lc_limit = '1000'; } else { $lc_limit = '10000'; }

    ## $lc_contents , $lc_limit = '1000'
	$sql_mini = "select ID,post_modified,post_date,post_type FROM $wpdb->posts
	        WHERE post_password = ''
			AND (post_type='post' or post_type='page')
			AND post_status = 'publish'
			ORDER BY post_modified DESC
			LIMIT 0,$lc_limit
	       ";
	$recentposts_mini = $wpdb->get_results($sql_mini);
	if($recentposts_mini){
		foreach ($recentposts_mini as $post){
			if( $post->post_type == 'page' ){
				if(!$array_baidu_sitemap_options['lc_page_select']){ continue; } ###跳过
				$loc = get_page_link($post->ID);
				$loc = LCZ_EscapeXML($loc);
				if(!$loc){ continue; }
				if($post->post_modified == '0000-00-00 00:00:00'){ $post_date = $post->post_date; } else { $post_date = $post->post_modified; } 
				$lastmod = date("Y-m-d\TH:i:s+00:00",LCZ_GetTimestampFromMySql($post_date));
				$changefreq = 'weekly';
				$priority = '0.3';
				$xml_contents_page .= "<url>";
				$xml_contents_page .= "<loc>$loc</loc>";
				$xml_contents_page .= "<lastmod>$lastmod</lastmod>";
				$xml_contents_page .= "<changefreq>$changefreq</changefreq>";
				$xml_contents_page .= "<priority>$priority</priority>";
				$xml_contents_page .= "</url>";
			}else{
				if(!$array_baidu_sitemap_options['lc_post_select']){ continue; } ###跳过
				$loc = get_permalink($post->ID);
				$loc = LCZ_EscapeXML($loc);
				if(!$loc){ continue; }
				if($post->post_modified == '0000-00-00 00:00:00'){ $post_date = $post->post_date; } else { $post_date = $post->post_modified; } ##$post->post_date_gmt
				$lastmod = date("Y-m-d\TH:i:s+00:00",LCZ_GetTimestampFromMySql($post_date));
				$changefreq = 'monthly';
				$priority = '0.6';
				$xml_contents_post .= "<url>";
				$xml_contents_post .= "<loc>$loc</loc>";
				$xml_contents_post .= "<lastmod>$lastmod</lastmod>";
				$xml_contents_post .= "<changefreq>$changefreq</changefreq>";
				$xml_contents_post .= "<priority>$priority</priority>";
				$xml_contents_post .= "</url>";
			}
		}
		## get_category_link
		if($array_baidu_sitemap_options['lc_category_select']){ 
			$category_ids = get_all_category_ids();
			if($category_ids){
				foreach($category_ids as $cat_id) {
					$loc = get_category_link($cat_id);
					$loc = LCZ_EscapeXML($loc);
					if(!$loc){ continue; }
					$lastmod = date("Y-m-d\TH:i:s+00:00",current_time('timestamp', '1'));
					$changefreq = 'Weekly';
					$priority = '0.3';
					$xml_contents_cat .= "<url>";
					$xml_contents_cat .= "<loc>$loc</loc>";
					$xml_contents_cat .= "<lastmod>$lastmod</lastmod>";
					$xml_contents_cat .= "<changefreq>$changefreq</changefreq>";
					$xml_contents_cat .= "<priority>$priority</priority>";
					$xml_contents_cat .= "</url>";
				}
			}
		}
		##

		###tag
		if($array_baidu_sitemap_options['lc_tag_select']){
			$all_the_tags = get_tags();
			if($all_the_tags){
				foreach($all_the_tags as $this_tag) {
					$tag_id = $this_tag->term_id;
					$loc = get_tag_link($tag_id);
					$loc = LCZ_EscapeXML($loc);
					if(!$loc){ continue; }
					$lastmod = date("Y-m-d\TH:i:s+00:00",current_time('timestamp', '1'));
					$changefreq = 'Weekly';
					$priority = '0.3';
					$xml_contents_tag .= "<url>";
					$xml_contents_tag .= "<loc>$loc</loc>";
					$xml_contents_tag .= "<lastmod>$lastmod</lastmod>";
					$xml_contents_tag .= "<changefreq>$changefreq</changefreq>";
					$xml_contents_tag .= "<priority>$priority</priority>";
					$xml_contents_tag .= "</url>";
				}
			}
		}
		###end tag
		$xml_contents = $xml_contents_post.$xml_contents_page.$xml_contents_cat.$xml_contents_tag;
	}


	## XML
	if($array_baidu_sitemap_options['lc_is_Enabled_XML_Sitemap']){
		build_baidu_sitemap_xml($xml_contents,$mes);
	}
	## Html
	if($array_baidu_sitemap_options['lc_is_Enabled_Html_Sitemap']){
		build_baidu_sitemap_html();
	}

}
function build_baidu_sitemap_xml($xml_contents,$mes){
	$array_baidu_sitemap_options = get_baidu_sitemap_options();
	$lc_blog_url = home_url();
	$blogtime = current_time('timestamp', '1');
	$lc_blog_time = date("Y-m-d\TH:i:s+00:00",$blogtime);

	$xml_begin = '<?xml version="1.0" encoding="UTF-8"?>'.xml_annotate().'<urlset xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xsi:schemaLocation="http://www.sitemaps.org/schemas/sitemap/0.9 http://www.sitemaps.org/schemas/sitemap/0.9/sitemap.xsd" xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">';
	$xml_home = "<url><loc>$lc_blog_url</loc><lastmod>$lc_blog_time</lastmod><changefreq>daily</changefreq><priority>1.0</priority></url>";
	$xml_end = '</urlset>';
	if($xml_contents){
		$baidu_xml = $xml_begin.$xml_home.$xml_contents.$xml_end;

		/** save XML file as sitemap_baidu.xml **/
		$LCZ_GetHomePath = LCZ_GetHomePath();
		$filename = $LCZ_GetHomePath.$array_baidu_sitemap_options['lc_XML_FileName'].'.xml';
		if( LCZ_IsFileWritable($LCZ_GetHomePath) || LCZ_IsFileWritable($filename) ){ 
			file_put_contents("$filename","$baidu_xml"); 
			@chmod($filename, 0777);
			/** Messages  **/
			if($mes){
			baidu_sitemap_topbarmessage(__('Congratulate, Build the XML file success'));
			}
		}else{ 
			/** Messages  **/
			if(!$mes){
			baidu_sitemap_topbarmessage(__('Directory is not writable. please chmod your directory to 777.'));
			}
		}
	}
}
function build_baidu_sitemap_html(){
	global $wpdb;
	$array_baidu_sitemap_options = get_baidu_sitemap_options();

	/** Get the current time **/
	$blogtime = current_time('mysql'); 
	list( $today_year, $today_month, $today_day, $hour, $minute, $second ) = preg_split( '([^0-9])', $blogtime );

    ##文章
	$html_contents = '';
	$sql_html = "select ID FROM $wpdb->posts
	        WHERE post_password = ''
			AND post_type='post'
			AND post_status = 'publish'
			ORDER BY post_modified DESC
			LIMIT 0,2000
	       ";
	$recentposts_html = $wpdb->get_results($sql_html);
	if($recentposts_html){
		foreach ($recentposts_html as $post){
			$html_contents .= '<li><a href="'.get_permalink($post->ID).'" title="'.get_the_title($post->ID).'" target="_blank">'.get_the_title($post->ID).'</a></li>';
		}
	}
	
	//$post = query_posts( 'ignore_sticky_posts=1&posts_per_page=1000' );
	//while (have_posts()) : the_post();
	//$html_contents .= '<li><a href="'.get_permalink().'" title="'.get_the_title().'" target="_blank">'.get_the_title().'</a></li>';
	//endwhile;

    if($array_baidu_sitemap_options['lc_category_select']){ 
		$html_category_contents = wp_list_categories('echo=0');
	}
	if($array_baidu_sitemap_options['lc_page_select']){ 
		$html_page_contents = wp_list_pages('echo=0');
	}
	if($array_baidu_sitemap_options['lc_tag_select']){ 
		$html_tag_contents = wp_tag_cloud('echo=0&number=245');
		$html_tag_contents = '<br /><h3>Tag Cloud</h3>'.$html_tag_contents;
	}


	$blog_title = __('SiteMap');
	$blog_name = get_bloginfo('name'); 
	$blog_keywords = $blog_title.','.$blog_name;
	$lc_generator = 'Baidu Sitemap Generator Plus';
	$lc_author = 'STAY MA BLOG';
	$lc_copyright = 'STAY MA BLOG';
	$blog_home = get_bloginfo('url');
	$sitemap_url = get_bloginfo('url').'/sitemap.html';
	$xml_url = get_bloginfo('url').'/'.$array_baidu_sitemap_options['lc_XML_FileName'].'.xml';
	$recentpost = __('RecentPost');
	$footnote = __('HomePage');
	$updated_time = "$today_year-$today_month-$today_day $hour:$minute:$second";

	if($html_contents) { 
		$path_html  = LCZ_GetPluginPath().'sitemap.html';
		$html = file_get_contents("$path_html");
		$html = str_replace("%blog_title%",$blog_title,$html);
		$html = str_replace("%blog_name%",$blog_name,$html);
		$html = str_replace("%blog_home%",$blog_home,$html);
		$html = str_replace("%blog_keywords%",$blog_keywords,$html);
		$html = str_replace("%lc_generator%",$lc_generator,$html);
		$html = str_replace("%lc_author%",$lc_author,$html);
		$html = str_replace("%lc_copyright%",$lc_copyright,$html);
		$html = str_replace("%sitemap_url%",$sitemap_url,$html);
		$html = str_replace("%blog_sitemap%",$xml_url,$html);
		$html = str_replace("%footnote%",$footnote,$html);
		$html = str_replace("%RecentPost%",$recentpost,$html);
		$html = str_replace("%updated_time%",$updated_time,$html);
		$html = str_replace("%contents%",$html_contents,$html);
		$html = str_replace("%Lc_category_contents%",$html_category_contents,$html);
		$html = str_replace("%Lc_page_contents%",$html_page_contents,$html);
		$html = str_replace("%Lc_tag_contents%",$html_tag_contents,$html);
		$LCZ_GetHomePath = LCZ_GetHomePath();
		$filename_html = $LCZ_GetHomePath.'sitemap.html';
		if( LCZ_IsFileWritable($LCZ_GetHomePath) || LCZ_IsFileWritable($filename_html) ){ 
			file_put_contents("$filename_html","$html");
			@chmod($filename_html, 0777);
			/** Messages  **/
			/*baidu_sitemap_topbarmessage(__('Congratulate, Build the Html file success'));*/
		}
	}
}
	

function LCZ_text(){
	?>
	<h3>PS:</h3>
	<p>提醒：百度的ping服务地址：http://ping.baidu.com/ping/RPC2, 把它加入ping服务列表，加快百度的收录速度。</p>
	<?php
}

function LCZ_for_SAE(){
	if(LCZ_IS_SAE()) : 
	?>
	<h3>SAE环境:</h3>
	<p>提醒：如果是用SAE平台，打开网站根目录下的config.yaml加入两行代码</p>
	<pre>
	- rewrite:  if ( path ~ "sitemap.xml" ) goto "wp-content/plugins/baidu-sitemap-generator/SAE_xml.php"
	- rewrite:  if ( path ~ "sitemap.html" ) goto "wp-content/plugins/baidu-sitemap-generator/SAE_html.php"
	</pre>
	<?php
	endif;
}

## Auto
add_action( 'wp', 'baidu_sitemap_is_auto_daily' );
function baidu_sitemap_is_auto_daily() {
	if ( ! wp_next_scheduled( 'do_baidu_sitemap_auto_daily' ) ) {
		wp_schedule_event( time(), 'daily', 'do_baidu_sitemap_auto_daily');
	}
}
add_action('do_baidu_sitemap_auto_daily','build_baidu_sitemap');


function baidu_sitemap_by_post($post_ID) {
	$get_baidu_sitemap_options = get_option(NEW_BAIDU_SITEMAP_OPTION);
	if(isset($get_baidu_sitemap_options['lc_is_update_sitemap_when_post'])){
		if($get_baidu_sitemap_options['lc_is_update_sitemap_when_post'] == '1'){
			  build_baidu_sitemap();
		}
	}
	return $post_ID;
}

add_action('publish_post', 'baidu_sitemap_by_post');
add_action('save_post', 'baidu_sitemap_by_post');
add_action('edit_post', 'baidu_sitemap_by_post');
add_action('delete_post', 'baidu_sitemap_by_post');


/** Tie the module into Wordpress **/
add_action('admin_menu','baidu_sitemap_menu');
#add_action('init','baidu_sitemap_is_auto_daily',1001,0);
/** load the language file **/
add_filter('init','load_baidu_language');

?>