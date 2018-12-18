<!DOCTYPE html>
<html lang="zh-CN">
<head>
	<meta charset="utf-8">
	<title>{seacms:searchword}-大饼影视</title>
	<meta name="keywords" content="{seacms:searchword},大饼影视" />
	<meta name="description" content="{seacms:searchword},大饼影视" />
	<link href="/favicon.ico" type="image/x-icon" rel="icon">
<link href="/favicon.ico" type="image/x-icon" rel="shortcut icon">
<link rel="stylesheet" href="/templets/id97/images/css/bootstrap.min.css">
<link rel="stylesheet" rev="stylesheet" type="text/css" media="all" href="/templets/id97/images/css/style.css">
<script src="/templets/id97/images/js/jquery.min.js"></script>
<script type="text/javascript">
try {
var urlhash = window.location.hash;
if (!urlhash.match("fromapp")) {
if ((navigator.userAgent.match(/(iPhone|iPod|Android|ios|iPad)/i))) {
window.location = "http://www.lookoro.cn/wap";
}
}
}
catch (err) {
}</script>
<script src="http://apps.bdimg.com/libs/bootstrap/3.3.4/js/bootstrap.min.js"></script>
<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
<!--[if lt IE 9]>
<script src="/templets/id97/images/js/html5shiv.min.js"></script>
<script src="/templets/id97/images/js/respond.min.js"></script>
<![endif]-->
</head>
<body>
<header style="background:#FFF;">

<div style="padding:5px 0;border-bottom:1px solid #DDD;">
    <div class="container">
        <span class="header-help">欢迎来到大饼影视，我们因为电影而相聚。</span>
        <div class="pull-right">
            <a class="header-help" href="javascript:alert('快捷键Ctrl+D可以快速添加到收藏夹。');">Ctrl+D 加入收藏夹</a> -
            <a class="header-help" style="color:red;" href="/desktop.php?url=http://http://m.yfmovie.top&name=大饼影视">保存到桌面</a>
        </div>
    </div>
</div>

<div class="container" style="padding-top:15px;padding-bottom:15px;padding-right:0;">
	<a class="logo pull-left" href="/"></a>
    <div class="pull-right" style="margin-top:8px;">
		<form class="navbar-form pull-right" accept-charset="utf-8" action="/search.php" method="POST" role="search">
            <div class="form-group">
				<input type="text" class="form-control" id="keyword" name="searchword" placeholder="请输入电影名字">
            </div><button type="submit" class="btn btn-primary"><span class="glyphicon glyphicon-search"></span> 搜索</button>
        </form>
    </div>
</div>

<nav class="navbar navbar-default" role="navigation">
    <div class="container">
        <ul class="nav navbar-nav">
			<li id="index1" {if:{seacms:currenttypeid}<0}class="active"{end if}><a href="/">首页</a></li>
			
			<li {if:1=={seacms:currenttypeid}}class="active"{end if}><a target="_self" href="/list/?1.html">电影</a></li>
			
			<li {if:2=={seacms:currenttypeid}}class="active"{end if}><a target="_self" href="/list/?2.html">电视剧</a></li>
			
			<li {if:3=={seacms:currenttypeid}}class="active"{end if}><a target="_self" href="/list/?3.html">综艺</a></li>
			
			<li {if:4=={seacms:currenttypeid}}class="active"{end if}><a target="_self" href="/list/?4.html">动漫</a></li>
			
<li id="index2"><a target="_self" href="/gbook.php">留言求片</a></li>
        </ul>
		<div class="pull-right">
			<ul class="nav navbar-nav">
                <li><a href="#">注册</a></li>
                <li><a href="#">登录</a></li>
			</ul>
		</div>
    </div>
</nav>

</header>
<div class="container">
	<ol class="breadcrumb" style="padding:10px 15px;">
        <li><a href="/">首页</a></li>
        <li>资源搜索</li>
        <li class="active">{seacms:searchword}</li>
    </ol>
{seacms:searchlist size=10 order=time} 
<div class="result-item">
    <div class="row">
        <div class="col-xs-2">
            <a target="_blank" href="[searchlist:link]" style="position:relative;display:block;"><img class="img-thumbnail" alt="[searchlist:name] " src='[searchlist:pic]'>
			<span class="qtag">{if:[searchlist:state]==0}[searchlist:ver]{else}更新至[searchlist:state]集{end if}</span>
			</a>
        </div>
        <div class="col-xs-7">
            <p class="movie-name">名称：<strong><a target="_blank" href="[searchlist:link]">《[searchlist:name]》</a></strong><span class="subtype">[searchlist:typename]</span></p>
            <div class="intro">
            <p>上映时间：[searchlist:publishtime] / 地区：[searchlist:publisharea] / 人气：<strong>[searchlist:hit]</strong></p>
            <p class="movie-introduce">[searchlist:des]</p>
            <p>在线观看：<a target="_blank" href="[searchlist:link]">[searchlist:name]</a></p>
            </div>
        </div>
		<div class="col-xs-3">
        
        </div>
    </div>
</div>
{/seacms:searchlist}
<div class="pager-bg">
<ul class="pagination pagination-sm">{if:{searchlist:page}>1}<li><a href="{searchlist:backlink}">上一页</a></li>{end if}
{searchlist:pagenumber len=8}
<li {if:{searchlist:page}<>[pagenumber:page]}{else}class="active"{end if}><a href="[pagenumber:link]">[pagenumber:page]</a></li>
{/searchlist:pagenumber}
{if:{searchlist:pagecount}>1}
<li><a href="{searchlist:nextlink}">下一页</a></li>
<li><a href="{searchlist:lastlink}">末页</a></li>{end if}</ul></div>
</div>
﻿<footer class="footer">
	<div class="container">
		<div class="row">
			<div class="col-xs-4">
				<p>免责声明：</p>
				<p>本网站所有内容都是靠程序在互联网上自动搜集而来，仅供测试和学习交流。若侵犯了您的权益，请发邮件通知站长。</p>
			</div>
			<div class="col-xs-4">
				<p>联系方式：</p>
				<p>QQ：2189154548</p>
			</div>
			<div class="col-xs-4">
				<em>♥ <a href="/">大饼影视</a> - {seacms:runinfo}</em>
			</div>
		</div>
	</div>
</footer>

</body>
</html>