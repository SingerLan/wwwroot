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
 ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" href="<?php echo dirname('http://'.$_SERVER['HTTP_HOST'].$_SERVER["REQUEST_URI"]); ?>/wp-content/plugins/xydown/css/download.css" />
<title><?php echo $title;?> | 下载页面</title>
<meta name="keywords" content="<?php echo $title;?>" />
<meta name="description" content="<?php echo $title;?>下载" />
</head>
<body>
<div id="header">
	
</div>
<!--广告代码开始
<div class="baidu_ad728">
<script src="http://cpro.baidustatic.com/cpro/ui/c.js" type="text/javascript"></script><div id="BAIDU_DUP_wrapper_u1534620_0"><iframe width="728" height="90" align="center,center" id="cproIframe_u1534620_4" src="http://pos.baidu.com/acom?adn=3&at=134&aurl=&cad=1&ccd=24&cec=utf-8&cfv=0&ch=0&col=zh-CN&conOP=0&cpa=1&dai=4&dis=0&layout_filter=rank%2Ctabcloud&ltr=&ltu=http%3A%2F%2Fwenchenhk.com%2Fdl%2Ffrontopen.html&lunum=6&n=27043069_cpr&pcs=1920x445&pis=10000x10000&ps=1020x596&psr=1920x1080&pss=1920x1206&qn=336ad31d3f94faa0&rad=&rsi0=728&rsi1=90&rsi5=4&rss0=%23FFFFFF&rss1=%23FFFFFF&rss2=%230000FF&rss3=%23444444&rss4=%23008000&rss5=&rss6=%23e10900&rss7=&scale=&skin=&td_id=1534620&tn=text_default_728_90&tpr=1432172251201&ts=1&version=2.0&xuanting=0&dtm=BAIDU_DUP2_SETJSONADSLOT&dc=2&di=u1534620&ti=wordpress%E4%B8%BB%E9%A2%98%EF%BC%9A%E5%9B%BD%E4%BA%BA%E5%8E%9F%E5%88%9B%E6%89%81%E5%B9%B3%E5%8C%96%E8%AE%BE%E8%AE%A1frontopen%E4%B8%BB%E9%A2%98%20%7C%20%E6%9A%97%E6%B7%A1%E7%9A%84%E9%BB%91IT%E7%BD%91%E7%BB%9C&tt=1432172251194.387.629.629" frameborder="0" marginwidth="0" marginheight="0" scrolling="no" allowtransparency="true"></iframe></div><script src="http://pos.baidu.com/acom?di=u1534620&dcb=BAIDU_DUP2_define&dtm=BAIDU_DUP2_SETJSONADSLOT&dbv=0&dci=0&dri=0&dis=0&dai=4&dds=&drs=1&dvi=1432002453&ltu=http%3A%2F%2Fwenchenhk.com%2Fdl%2Ffrontopen.html&liu=&ltr=&lcr=&ps=1020x596&psr=1920x1080&par=1920x1040&pcs=1920x445&pss=1920x1206&pis=-1x-1&cfv=0&ccd=24&chi=2&cja=true&cpl=0&cmi=0&cce=true&col=zh-CN&cec=utf-8&cdo=-1&tsr=385&tlm=1432172251&tcn=1432172252&tpr=1432172251201&dpt=none&coa=&ti=wordpress%E4%B8%BB%E9%A2%98%EF%BC%9A%E5%9B%BD%E4%BA%BA%E5%8E%9F%E5%88%9B%E6%89%81%E5%B9%B3%E5%8C%96%E8%AE%BE%E8%AE%A1frontopen%E4%B8%BB%E9%A2%98%20%7C%20%E6%9A%97%E6%B7%A1%E7%9A%84%E9%BB%91IT%E7%BD%91%E7%BB%9C&baidu_id=" charset="utf-8"></script>
</div>
广告代码结束-->
<center><h3><a href="<?php echo get_permalink( $id ); ?> ">去《<?php echo get_bloginfo( 'name' ); ?>》看看关于《<?php echo $title;?>》的详细介绍文章 >></a></h3></center>
<div class="download"><p>本站所刊载内容均为网络上收集整理，并且以计算机技术研究交流为目的，所有仅供大家参考、学习，不存在任何商业目的与商业用途。若您需要使用非免费的软件或服务，您应当购买正版授权并合法使用。如果你下载此文件，表示您同意只将此文件用于参考、学习使用而非任何其他用途。</p>
</div>
<!--广告代码开始
<div class="baidu_ad728">
<script src="http://cpro.baidustatic.com/cpro/ui/c.js" type="text/javascript"></script><div id="BAIDU_DUP_wrapper_u1534620_0"><iframe width="728" height="90" align="center,center" id="cproIframe_u1534620_4" src="http://pos.baidu.com/acom?adn=3&at=134&aurl=&cad=1&ccd=24&cec=utf-8&cfv=0&ch=0&col=zh-CN&conOP=0&cpa=1&dai=4&dis=0&layout_filter=rank%2Ctabcloud&ltr=&ltu=http%3A%2F%2Fwenchenhk.com%2Fdl%2Ffrontopen.html&lunum=6&n=27043069_cpr&pcs=1920x445&pis=10000x10000&ps=1020x596&psr=1920x1080&pss=1920x1206&qn=336ad31d3f94faa0&rad=&rsi0=728&rsi1=90&rsi5=4&rss0=%23FFFFFF&rss1=%23FFFFFF&rss2=%230000FF&rss3=%23444444&rss4=%23008000&rss5=&rss6=%23e10900&rss7=&scale=&skin=&td_id=1534620&tn=text_default_728_90&tpr=1432172251201&ts=1&version=2.0&xuanting=0&dtm=BAIDU_DUP2_SETJSONADSLOT&dc=2&di=u1534620&ti=wordpress%E4%B8%BB%E9%A2%98%EF%BC%9A%E5%9B%BD%E4%BA%BA%E5%8E%9F%E5%88%9B%E6%89%81%E5%B9%B3%E5%8C%96%E8%AE%BE%E8%AE%A1frontopen%E4%B8%BB%E9%A2%98%20%7C%20%E6%9A%97%E6%B7%A1%E7%9A%84%E9%BB%91IT%E7%BD%91%E7%BB%9C&tt=1432172251194.387.629.629" frameborder="0" marginwidth="0" marginheight="0" scrolling="no" allowtransparency="true"></iframe></div><script src="http://pos.baidu.com/acom?di=u1534620&dcb=BAIDU_DUP2_define&dtm=BAIDU_DUP2_SETJSONADSLOT&dbv=0&dci=0&dri=0&dis=0&dai=4&dds=&drs=1&dvi=1432002453&ltu=http%3A%2F%2Fwenchenhk.com%2Fdl%2Ffrontopen.html&liu=&ltr=&lcr=&ps=1020x596&psr=1920x1080&par=1920x1040&pcs=1920x445&pss=1920x1206&pis=-1x-1&cfv=0&ccd=24&chi=2&cja=true&cpl=0&cmi=0&cce=true&col=zh-CN&cec=utf-8&cdo=-1&tsr=385&tlm=1432172251&tcn=1432172252&tpr=1432172251201&dpt=none&coa=&ti=wordpress%E4%B8%BB%E9%A2%98%EF%BC%9A%E5%9B%BD%E4%BA%BA%E5%8E%9F%E5%88%9B%E6%89%81%E5%B9%B3%E5%8C%96%E8%AE%BE%E8%AE%A1frontopen%E4%B8%BB%E9%A2%98%20%7C%20%E6%9A%97%E6%B7%A1%E7%9A%84%E9%BB%91IT%E7%BD%91%E7%BB%9C&baidu_id=" charset="utf-8"></script>
</div>
广告代码结束-->
<div class="download">
  <div class="download-title"><span> 文件信息：</span></div>
  <div class="download-text">
  		<span>文件名称：</span><?php echo $xydown_name;?><br>
		<span>文件大小：</span><?php echo $xydown_size;?><br>
		<span>更新时间：</span><?php echo $xydown_date;?><br>
		<span>作者信息：</span><?php echo $xydown_author;?><br>
		<div class="list"><span>下载地址：</span>
		<?php if($xydown_downurl1){?><a href="<?php echo $xydown_downurl1;?>" target="_blank">百度网盘 <font color="red"> &nbsp;&nbsp;<?php if($xydown_baidumima){?>提取码:<?php echo $xydown_baidumima; }?></font></a><?php } if($xydown_downurl4){?><a href="<?php echo $xydown_downurl4;?>" target="_blank">迅雷快传</a><?php }if($xydown_downurl5){?><a href="<?php echo $xydown_downurl5;?>" target="_blank">360网盘 <font color="red">&nbsp;&nbsp; <?php if($xydown_360mima){?>提取码:<?php echo $xydown_360mima;?></font><?php }?></a><?php }if($xydown_downurl6){?><a href="<?php echo $xydown_downurl6;?>" target="_blank">其他网盘</a><?php }if($xydown_downurl7){?><a href="<?php echo $xydown_downurl7;?>" target="_blank">官方下载</a><?php }if($xydown_downurl2){?><a href="<?php echo $xydown_downurl2;?>" target="_blank">城通网盘</a><?php } if($xydown_downurl3){?><a href="<?php echo $xydown_downurl3;?>" target="_blank"><font color="red">普通下载</font></a><?php }?><br>
		</div></div>
  </div>
</div>
<!--广告代码开始
<div class="baidu_ad728">
<script src="http://cpro.baidustatic.com/cpro/ui/c.js" type="text/javascript"></script><div id="BAIDU_DUP_wrapper_u1534620_0"><iframe width="728" height="90" align="center,center" id="cproIframe_u1534620_4" src="http://pos.baidu.com/acom?adn=3&at=134&aurl=&cad=1&ccd=24&cec=utf-8&cfv=0&ch=0&col=zh-CN&conOP=0&cpa=1&dai=4&dis=0&layout_filter=rank%2Ctabcloud&ltr=&ltu=http%3A%2F%2Fwenchenhk.com%2Fdl%2Ffrontopen.html&lunum=6&n=27043069_cpr&pcs=1920x445&pis=10000x10000&ps=1020x596&psr=1920x1080&pss=1920x1206&qn=336ad31d3f94faa0&rad=&rsi0=728&rsi1=90&rsi5=4&rss0=%23FFFFFF&rss1=%23FFFFFF&rss2=%230000FF&rss3=%23444444&rss4=%23008000&rss5=&rss6=%23e10900&rss7=&scale=&skin=&td_id=1534620&tn=text_default_728_90&tpr=1432172251201&ts=1&version=2.0&xuanting=0&dtm=BAIDU_DUP2_SETJSONADSLOT&dc=2&di=u1534620&ti=wordpress%E4%B8%BB%E9%A2%98%EF%BC%9A%E5%9B%BD%E4%BA%BA%E5%8E%9F%E5%88%9B%E6%89%81%E5%B9%B3%E5%8C%96%E8%AE%BE%E8%AE%A1frontopen%E4%B8%BB%E9%A2%98%20%7C%20%E6%9A%97%E6%B7%A1%E7%9A%84%E9%BB%91IT%E7%BD%91%E7%BB%9C&tt=1432172251194.387.629.629" frameborder="0" marginwidth="0" marginheight="0" scrolling="no" allowtransparency="true"></iframe></div><script src="http://pos.baidu.com/acom?di=u1534620&dcb=BAIDU_DUP2_define&dtm=BAIDU_DUP2_SETJSONADSLOT&dbv=0&dci=0&dri=0&dis=0&dai=4&dds=&drs=1&dvi=1432002453&ltu=http%3A%2F%2Fwenchenhk.com%2Fdl%2Ffrontopen.html&liu=&ltr=&lcr=&ps=1020x596&psr=1920x1080&par=1920x1040&pcs=1920x445&pss=1920x1206&pis=-1x-1&cfv=0&ccd=24&chi=2&cja=true&cpl=0&cmi=0&cce=true&col=zh-CN&cec=utf-8&cdo=-1&tsr=385&tlm=1432172251&tcn=1432172252&tpr=1432172251201&dpt=none&coa=&ti=wordpress%E4%B8%BB%E9%A2%98%EF%BC%9A%E5%9B%BD%E4%BA%BA%E5%8E%9F%E5%88%9B%E6%89%81%E5%B9%B3%E5%8C%96%E8%AE%BE%E8%AE%A1frontopen%E4%B8%BB%E9%A2%98%20%7C%20%E6%9A%97%E6%B7%A1%E7%9A%84%E9%BB%91IT%E7%BD%91%E7%BB%9C&baidu_id=" charset="utf-8"></script>
</div>
广告代码结束-->
<div class="download">
<p>1.如果您发现本资源下载地址已经失效不能下载，请联系站长修正下载链接！</p>
<p>2.如无特殊说明,本站统一解压密码为:www.lookoro.cn</p>
</div>

<div class="clear"></div>

<div class="copy" style="text-align: center;margin-top:15px;">
	Copyright @ 2019 <a href="http://www.lookoro.cn">大巧不工</a> 版权所有. 
</div>

</body>
</html>