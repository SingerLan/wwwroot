<?php
require( dirname(__FILE__) . '/wp-load.php' );
$id=$_GET['id'];
$title = get_post($id)->post_title;
$xydown_name=get_post_meta($id, 'xydown_name', true);
$xydown_size=get_post_meta($id, 'xydown_size', true);
$xydown_date=get_post_meta($id, 'xydown_date', true);
$xydown_version=get_post_meta($id, 'xydown_version', true);
$xydown_author=get_post_meta($id, 'xydown_author', true);
$xydown_downurl1=get_post_meta($id, 'xydown_downurl1', true);
$xydown_downurl2=get_post_meta($id, 'xydown_downurl2', true);
$xydown_downurl3=get_post_meta($id, 'xydown_downurl3', true);
$xydown_downurl4=get_post_meta($id, 'xydown_downurl4', true);
$xydown_downurl5=get_post_meta($id, 'xydown_downurl5', true);
$xydown_downurl6=get_post_meta($id, 'xydown_downurl6', true);
$xydown_downurl7=get_post_meta($id, 'xydown_downurl7', true);
$xydown_baidumima=get_post_meta($id, 'xydown_baidumima', true);
$xydown_360mima=get_post_meta($id, 'xydown_360mima', true);
$xydown_yanshi=get_post_meta($id, 'xydown_yanshi', true);
 ?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"/>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
<title><?php echo $title;?>演示效果</title>
<meta name="keywords" content="<?php echo $title;?>" />
<meta name="description" content="<?php echo $title;?>演示" />
<meta name="robots" content="noindex,follow">
<link rel="stylesheet" href="<?php echo dirname('http://'.$_SERVER['HTTP_HOST'].$_SERVER["REQUEST_URI"]); ?>/wp-content/plugins/xydown/css/demo.css" />
<style type="text/css">
	html body{color:#eee;font-family:Verdana,Helvetica,Arial,sans-serif;font-size:10px;height:100%;margin:0;overflow:hidden;padding:0;width:100%;}
	
</style>

<script type="text/javascript" src="http://libs.baidu.com/jquery/1.8.3/jquery.min.js"></script>

<script type="text/javascript">
      var calcHeight = function() {
        var headerDimensions = $('#header-bar').height();
        $('#preview-frame').height($(window).height() - headerDimensions);
      }
      
      $(document).ready(function() {
        calcHeight();
        $('#header-bar a.close').mouseover(function() {
          $('#header-bar a.close').addClass('activated');
        }).mouseout(function() {
          $('#header-bar a.close').removeClass('activated');
        });
      });
      
      $(window).resize(function() {
        calcHeight();
      }).load(function() {
        calcHeight();
      });
</script>
<script>
var _hmt = _hmt || [];
(function() {
  var hm = document.createElement("script");
  hm.src = "//hm.baidu.com/hm.js?8b3a162167f2f2761aff816155d2f005";
  var s = document.getElementsByTagName("script")[0]; 
  s.parentNode.insertBefore(hm, s);
})();
</script>
</head>
<body>
   <div id="header-bar">
     <div class="close-header">
       <script type="text/javascript">document.write("<a id=\"close-button\" title=\"关闭工具条\" class=\"close\" href=\"<?php echo $xydown_yanshi;?>\">X</a>");</script>
     </div>
     
     <p class="meta-data">
       <script type="text/javascript">document.write("<a target=\"_blank\" class=\"close\" href=\"<?php echo $xydown_yanshi;?>\">移除顶部</a>");</script> <a class="back" href="http://m.lookoro.cn/" target="_blank" >大巧不工</a><a class="back" href="<?php echo dirname('http://'.$_SERVER['HTTP_HOST'].$_SERVER["REQUEST_URI"]); ?>/index.php/<?php echo $id;?>.html" target="_blank" >返回介绍</a> 
<a class="back" target="_blank" href="<?php echo dirname('http://'.$_SERVER['HTTP_HOST'].$_SERVER["REQUEST_URI"]); ?>/download.php?id=<?php echo $id;?>" >下载资源</a> <a class="back">温馨提示：演示页面</a>
     
</p>

   
   </div>

<script type="text/javascript">
document.write("<iframe id=\"preview-frame\" src=\"<?php echo $xydown_yanshi;?>\" name=\"preview-frame\" frameborder=\"0\" noresize=\"noresize\"></iframe>");
</script>
</body>
</html>
 