<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<link rel="shortcut icon" href="/favicon.ico" />
<title>{seacms:searchword}-大饼影视手机版</title>
<meta name="keywords" content="">
<meta name="description" content="">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
<meta http-equiv="X-UA-Compatible" content="IE=EmulateIE10"/>
<meta name="renderer" content="webkit|ie-comp|ie-stand">
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
<link rel="shortcut icon" href="favicon.ico" type="image/x-icon"/>
<link rel="stylesheet" href="/templets/aikanV1/images/iconfont.css" type="text/css"/>
<link rel="stylesheet" href="/templets/aikanV1/images/stui_block.css" type="text/css"/>
<link rel="stylesheet" href="/templets/aikanV1/images/stui_default.css" type="text/css"/>
<link rel="stylesheet" href="/templets/aikanV1/images/stui_custom.css" type="text/css"/>
<script type="text/javascript" src="/templets/aikanV1/images/jquery.min.js"></script>
<script type="text/javascript" src="/templets/aikanV1/images/stui_default.js"></script>
<script type="text/javascript">var sitePath='', siteUrl='http://m.yfmovie.top/wap', sitepath=''</script>
<!--[if lt IE 9]>
<script src="https://cdn.bootcss.com/html5shiv/3.7.2/html5shiv.min.js"></script>
<script src="https://cdn.bootcss.com/respond.js/1.4.2/respond.min.js"></script>
<![endif]-->
</head>
<body>
<header class="stui-header__top clearfix" id="header-top">
<div class="container">
	<div class="row">
		<div class="stui-header_bd clearfix">
			<div class="stui-header__logo">
				<a class="logo" href="/"></a>
			</div>
			<div class="stui-header__side">
				<ul class="stui-header__user">
					<!--<li class="hidden-xs"><a href="/login.php"><i class="icon iconfont icon-account"></i></a></li>
					-->
					<li class="visible-xs"><a class="open-popup" href="javascript:;"><i class="icon iconfont icon-viewgallery"></i></a></li>
				</ul>
				<div class="stui-header__search">
					<form name="formsearch" id="formsearch" action='/wap/search.php' method="post" autocomplete="off">
						<input class="form-control" id="wd" placeholder="输入影片关键词..." name="searchword" type="text" id="keyword" required=""><input type="submit" id="searchbutton" value="" class="hide"><button class="submit" id="submit" onclick="$('#formsearch').submit();"><i class="icon iconfont icon-search"></i></button>
					</form>
				</div>
			</div>
			<ul class="stui-header__menu type-slide">
				<li {if:{seacms:currenttypeid}=-444}class="active" id="index1"{end if}><a href="http://www.lookoro.cn/wap/">首页</a></li>
				
				<li {if:1={seacms:currenttypeid}}class="active" id="index1" {end if}><a href="/waplist/?1.html">电影</a></li>
				
				<li {if:2={seacms:currenttypeid}}class="active" id="index1" {end if}><a href="/waplist/?2.html">电视剧</a></li>
				
				<li {if:3={seacms:currenttypeid}}class="active" id="index1" {end if}><a href="/waplist/?3.html">综艺</a></li>
				
				<li {if:4={seacms:currenttypeid}}class="active" id="index1" {end if}><a href="/waplist/?4.html">动漫</a></li>
				
                                <li  id="index2"><a href="/wap/gbook.php">留言求片</a></li>
				<!-- <li ><a href="/topic/?1.html">专题</a></li> -->
                <!-- <li ><a href="/ys/">备用站点</a></li> -->
			</ul>
		</div>
	</div>
</div>
</header>
<div class="popup clearfix">
	<div class="popup-head bottom-line">
		<h5 class="title pull-right">全部分类</h5>
		<a href="javascript:;" class="close-popup"><i class="icon iconfont icon-back"></i></a>
	</div>
	<div class="popup-body col-pd">
		<ul class="tag tag-type">
		
			<li class="col-xs-4"><a href="/waplist/?1.html">电影</a></li>
		
			<li class="col-xs-4"><a href="/waplist/?2.html">电视剧</a></li>
		
			<li class="col-xs-4"><a href="/waplist/?3.html">综艺</a></li>
		
			<li class="col-xs-4"><a href="/waplist/?4.html">动漫</a></li>
		
			<li class="col-xs-4"><a href="/waplist/?5.html">动作片</a></li>
		
			<li class="col-xs-4"><a href="/waplist/?6.html">爱情片</a></li>
		
			<li class="col-xs-4"><a href="/waplist/?7.html">科幻片</a></li>
		
			<li class="col-xs-4"><a href="/waplist/?8.html">恐怖片</a></li>
		
			<li class="col-xs-4"><a href="/waplist/?9.html">战争片</a></li>
		
			<li class="col-xs-4"><a href="/waplist/?10.html">喜剧片</a></li>
		
			<li class="col-xs-4"><a href="/waplist/?11.html">纪录片</a></li>
		
			<li class="col-xs-4"><a href="/waplist/?12.html">剧情片</a></li>
		
			<li class="col-xs-4"><a href="/waplist/?13.html">大陆剧</a></li>
		
			<li class="col-xs-4"><a href="/waplist/?14.html">港台剧</a></li>
		
			<li class="col-xs-4"><a href="/waplist/?15.html">欧美剧</a></li>
		
			<li class="col-xs-4"><a href="/waplist/?16.html">日韩剧</a></li>
		
		</ul>
	</div>
</div>
<div class="container">
	<div class="row">
		<div class="col-lg-wide-75 col-xs-1 padding-0">
			<div class="stui-pannel stui-pannel-bg clearfix">
				<div class="stui-pannel-box">
					<div class="stui-pannel_hd">
						<div class="stui-pannel__head active bottom-line clearfix">
							<div class="nav nav-page pull-right">
								<li>{if:{searchlist:page}==1}<a><i class="icon iconfont icon-back"></i></a>{else}<a href="{searchlist:backlink}"><i class="icon iconfont icon-back"></i></a>{end if}</li>
								<li>{if:{searchlist:page}=={searchlist:pagecount}}<a><i class="icon iconfont icon-more"></i></a>{else}<a href="{searchlist:nextlink}"><i class="icon iconfont icon-more"></i></a>{end if}</i></a></li>
							</div>
							<span class="more text-muted pull-right hidden-xs">共有 {seacms:searchnum} 部影片，当前第 {searchlist:page} 页</span>
							<h3 class="title"><img src="/templets/aikanV1/images/icon_27.png"/>与《{seacms:searchword}》相关的影片</h3>
						</div>
					</div>
					<div class="stui-pannel_bd">
						<ul class="stui-vodlist__media col-pd clearfix">
						{seacms:searchlist size=11 order=time}
							<li class="active top-line-dot clearfix">
							<div class="thumb">
								<a class="v-thumb stui-vodlist__thumb lazyload" href="[searchlist:playlink]" title="[searchlist:name]" data-original="[searchlist:pic]"><span class="play hidden-xs"></span><span class="pic-text text-right">{if:[searchlist:state]<1}[searchlist:note]{elseif:[searchlist:state]<1000 and [searchlist:state]>0}更新至第[searchlist:state]集{elseif:[searchlist:state]>1000}第[searchlist:state]期{elseif:[searchlist:state]=0 and "[searchlist:note]"=""}[searchlist:note]{end if}</span></a>
							</div>
							<div class="detail">
								<h3 class="title"><a href="[searchlist:link]">[searchlist:name]</a></h3>
								<p><span class="text-muted">导演：</span>[searchlist:director]</p>
								<p><span class="text-muted">主演：</span>[searchlist:actor]</p>
								<p>
									<span class="text-muted">类型：</span>[searchlist:typename]<span class="lineh"> </span><span class="text-muted">地区：</span>[searchlist:publisharea]<span class="hidden-xs"><span class="lineh"> </span><span class="text-muted">年份：</span>[searchlist:publishtime]</span>
								</p>
								<p class="margin-0 hidden-sm hidden-xs"><span class="text-muted">简介：</span>[searchlist:des len=80]</p>
							</div>
							</li>
						{/seacms:searchlist}
						</ul>
					</div>
				</div>
			</div>
			<!-- 搜索列表 -->
		<ul class="stui-page text-center cleafix">
			<li>{if:{searchlist:page}==1}<a>首页</a>{else}<a href="{searchlist:firstlink}">首页</a>{end if}</li>
			<li>{if:{searchlist:page}==1}<a>上一页</a>{else}<a href="{searchlist:backlink}">上一页</a>{end if}</li>
			{searchlist:pagenumber len=6}
			{if:{searchlist:page}<>[pagenumber:page]}<li class="hidden-xs"><a href="[pagenumber:link]">[pagenumber:page]</a></li>{else}<li class="hidden-xs active"><a>[pagenumber:page]</a></li>{end if}
			{/searchlist:pagenumber}
			<li class="active visible-xs"><span class="num">{searchlist:page}/{searchlist:pagecount}</span></li>
			<li>{if:{searchlist:page}=={searchlist:pagecount}}<a>下一页</a>{else}<a href="{searchlist:nextlink}">下一页</a>{end if}</li>
			<li>{if:{searchlist:page}=={searchlist:pagecount}}<a>尾页</a>{else}<a href="{searchlist:lastlink}">尾页</a>{end if}</li>
		</ul>
			<!-- 列表翻页-->
		</div>
		<div class="col-lg-wide-25 stui-pannel-side hidden-md hidden-sm hidden-xs">
		
			<div class="stui-pannel stui-pannel-bg clearfix">
				<div class="stui-pannel-box">
					<div class="stui-pannel_hd">
						<div class="stui-pannel__head active bottom-line clearfix">
							<h3 class="title"><img src="/templets/aikanV1/images/icon_1.png"/>电影热播榜</h3>
						</div>
					</div>
					<div class="stui-pannel_bd clearfix">
					
						<ul class="stui-vodlist__media active col-pd clearfix">
							<li>
							<div class="thumb">
								<a class="m-thumb stui-vodlist__thumb lazyload" href="/wapdetail/?541.html" title="毒液：致命守护者" data-original="/uploads/allimg/181126/2d3a571b56ecfc78.jpg"><span class="pic-tag pic-tag-h">1</span></a>
							</div>
							<div class="detail detail-side">
								<h4 class="title"><a href="/wapdetail/?541.html"><i class="icon iconfont icon-more text-muted pull-right"></i>毒液：致命守护..</a></h4>
								<p class="font-12">
									<span class="text-muted">类型：</span>动作片 , <span class="text-muted">地区：</span>美国
								</p>
								<p class="font-12 margin-0">
									<span class="text-muted">主演：</span>汤姆·哈迪,米歇尔..
								</p>
							</div>
							</li>
						</ul>
					
						<ul class="stui-vodlist__text active col-pd clearfix">
						
							<li class="col-xs-1 padding-0"><a class="text-overflow" href="/wapdetail/?478.html" title="毒诫"><span class="text-muted pull-right">{if:0<1}BD1280高清国语|粤语中字{elseif:0<1000 and 0>0}更新至第0集{elseif:0>1000}第0期{elseif:0=0 and "BD1280高清国语|粤语中字"=""}BD1280高清国语|粤语中字{end if}</span><em class="text-red">2 . </em>毒诫</a></li>
						
							<li class="col-xs-1 padding-0"><a class="text-overflow" href="/wapdetail/?318.html" title="蚁人2：黄蜂女现身"><span class="text-muted pull-right">{if:0<1}BD1280高清特效国语|原声{elseif:0<1000 and 0>0}更新至第0集{elseif:0>1000}第0期{elseif:0=0 and "BD1280高清特效国语|原声"=""}BD1280高清特效国语|原声{end if}</span><em class="text-red">3 . </em>蚁人2：黄蜂女..</a></li>
						
							<li class="col-xs-1 padding-0"><a class="text-overflow" href="/wapdetail/?439.html" title="釜山行"><span class="text-muted pull-right">{if:0<1}超清{elseif:0<1000 and 0>0}更新至第0集{elseif:0>1000}第0期{elseif:0=0 and "超清"=""}超清{end if}</span><em class="text-red">4 . </em>釜山行</a></li>
						
							<li class="col-xs-1 padding-0"><a class="text-overflow" href="/wapdetail/?510.html" title="控方证人"><span class="text-muted pull-right">{if:0<1}HD高清{elseif:0<1000 and 0>0}更新至第0集{elseif:0>1000}第0期{elseif:0=0 and "HD高清"=""}HD高清{end if}</span><em class="text-red">5 . </em>控方证人</a></li>
						
							<li class="col-xs-1 padding-0"><a class="text-overflow" href="/wapdetail/?310.html" title="低压槽：欲望之城"><span class="text-muted pull-right">{if:0<1}BD1280高清国语中字版丨{elseif:0<1000 and 0>0}更新至第0集{elseif:0>1000}第0期{elseif:0=0 and "BD1280高清国语中字版丨"=""}BD1280高清国语中字版丨{end if}</span><em class="text-red">6 . </em>低压槽：欲望之..</a></li>
						
							<li class="col-xs-1 padding-0"><a class="text-overflow" href="/wapdetail/?315.html" title="大轰炸"><span class="text-muted pull-right">{if:0<1}HD1280高清中英双字版{elseif:0<1000 and 0>0}更新至第0集{elseif:0>1000}第0期{elseif:0=0 and "HD1280高清中英双字版"=""}HD1280高清中英双字版{end if}</span><em class="text-red">7 . </em>大轰炸</a></li>
						
							<li class="col-xs-1 padding-0"><a class="text-overflow" href="/wapdetail/?320.html" title="空中监狱"><span class="text-muted pull-right">{if:0<1}HD1280高清中字版{elseif:0<1000 and 0>0}更新至第0集{elseif:0>1000}第0期{elseif:0=0 and "HD1280高清中字版"=""}HD1280高清中字版{end if}</span><em class="text-red">8 . </em>空中监狱</a></li>
						
							<li class="col-xs-1 padding-0"><a class="text-overflow" href="/wapdetail/?322.html" title="无双"><span class="text-muted pull-right">{if:0<1}HDTC清晰版{elseif:0<1000 and 0>0}更新至第0集{elseif:0>1000}第0期{elseif:0=0 and "HDTC清晰版"=""}HDTC清晰版{end if}</span><em class="text-red">9 . </em>无双</a></li>
						
							<li class="col-xs-1 padding-0"><a class="text-overflow" href="/wapdetail/?323.html" title="古剑奇谭之流月昭明"><span class="text-muted pull-right">{if:0<1}HD1280高清国语中字版{elseif:0<1000 and 0>0}更新至第0集{elseif:0>1000}第0期{elseif:0=0 and "HD1280高清国语中字版"=""}HD1280高清国语中字版{end if}</span><em class="text-red">10 . </em>古剑奇谭之流月..</a></li>
						
						</ul>
					</div>
				</div>
			</div>
		
			<div class="stui-pannel stui-pannel-bg clearfix">
				<div class="stui-pannel-box">
					<div class="stui-pannel_hd">
						<div class="stui-pannel__head active bottom-line clearfix">
							<h3 class="title"><img src="/templets/aikanV1/images/icon_1.png"/>电视剧热播榜</h3>
						</div>
					</div>
					<div class="stui-pannel_bd clearfix">
					
						<ul class="stui-vodlist__media active col-pd clearfix">
							<li>
							<div class="thumb">
								<a class="m-thumb stui-vodlist__thumb lazyload" href="/wapdetail/?513.html" title="绝命毒师第二季" data-original="https://puui.qpic.cn/vcover_vt_pic/0/594igyblmxq85wnt1444841266.jpg/260"><span class="pic-tag pic-tag-h">1</span></a>
							</div>
							<div class="detail detail-side">
								<h4 class="title"><a href="/wapdetail/?513.html"><i class="icon iconfont icon-more text-muted pull-right"></i>绝命毒师第二季</a></h4>
								<p class="font-12">
									<span class="text-muted">类型：</span>欧美剧 , <span class="text-muted">地区：</span>美国
								</p>
								<p class="font-12 margin-0">
									<span class="text-muted">主演：</span>布莱恩·科兰斯顿,..
								</p>
							</div>
							</li>
						</ul>
					
						<ul class="stui-vodlist__text active col-pd clearfix">
						
							<li class="col-xs-1 padding-0"><a class="text-overflow" href="/wapdetail/?308.html" title="你和我的倾城时光"><span class="text-muted pull-right">{if:0<1}更新到31集{elseif:0<1000 and 0>0}更新至第0集{elseif:0>1000}第0期{elseif:0=0 and "更新到31集"=""}更新到31集{end if}</span><em class="text-red">2 . </em>你和我的倾城时..</a></li>
						
							<li class="col-xs-1 padding-0"><a class="text-overflow" href="/wapdetail/?517.html" title="兄弟连第一季"><span class="text-muted pull-right">{if:0<1}完结{elseif:0<1000 and 0>0}更新至第0集{elseif:0>1000}第0期{elseif:0=0 and "完结"=""}完结{end if}</span><em class="text-red">3 . </em>兄弟连第一季</a></li>
						
							<li class="col-xs-1 padding-0"><a class="text-overflow" href="/wapdetail/?301.html" title="将夜"><span class="text-muted pull-right">{if:0<1}更新到32集{elseif:0<1000 and 0>0}更新至第0集{elseif:0>1000}第0期{elseif:0=0 and "更新到32集"=""}更新到32集{end if}</span><em class="text-red">4 . </em>将夜</a></li>
						
							<li class="col-xs-1 padding-0"><a class="text-overflow" href="/wapdetail/?303.html" title="原来你还在这里"><span class="text-muted pull-right">{if:0<1}更新到18集{elseif:0<1000 and 0>0}更新至第0集{elseif:0>1000}第0期{elseif:0=0 and "更新到18集"=""}更新到18集{end if}</span><em class="text-red">5 . </em>原来你还在这里</a></li>
						
							<li class="col-xs-1 padding-0"><a class="text-overflow" href="/wapdetail/?512.html" title="绝命毒师第一季"><span class="text-muted pull-right">{if:0<1}完结{elseif:0<1000 and 0>0}更新至第0集{elseif:0>1000}第0期{elseif:0=0 and "完结"=""}完结{end if}</span><em class="text-red">6 . </em>绝命毒师第一季</a></li>
						
							<li class="col-xs-1 padding-0"><a class="text-overflow" href="/wapdetail/?537.html" title="我的恶魔少爷"><span class="text-muted pull-right">{if:0<1}更新到08集{elseif:0<1000 and 0>0}更新至第0集{elseif:0>1000}第0期{elseif:0=0 and "更新到08集"=""}更新到08集{end if}</span><em class="text-red">7 . </em>我的恶魔少爷</a></li>
						
							<li class="col-xs-1 padding-0"><a class="text-overflow" href="/wapdetail/?297.html" title="我在大理寺当宠物"><span class="text-muted pull-right">{if:0<1}22集全{elseif:0<1000 and 0>0}更新至第0集{elseif:0>1000}第0期{elseif:0=0 and "22集全"=""}22集全{end if}</span><em class="text-red">8 . </em>我在大理寺当宠..</a></li>
						
							<li class="col-xs-1 padding-0"><a class="text-overflow" href="/wapdetail/?304.html" title="风再起时"><span class="text-muted pull-right">{if:0<1}更新到32集{elseif:0<1000 and 0>0}更新至第0集{elseif:0>1000}第0期{elseif:0=0 and "更新到32集"=""}更新到32集{end if}</span><em class="text-red">9 . </em>风再起时</a></li>
						
							<li class="col-xs-1 padding-0"><a class="text-overflow" href="/wapdetail/?305.html" title="惊蛰"><span class="text-muted pull-right">{if:0<1}39集全{elseif:0<1000 and 0>0}更新至第0集{elseif:0>1000}第0期{elseif:0=0 and "39集全"=""}39集全{end if}</span><em class="text-red">10 . </em>惊蛰</a></li>
						
						</ul>
					</div>
				</div>
			</div>
		
			<div class="stui-pannel stui-pannel-bg clearfix">
				<div class="stui-pannel-box">
					<div class="stui-pannel_hd">
						<div class="stui-pannel__head active bottom-line clearfix">
							<h3 class="title"><img src="/templets/aikanV1/images/icon_1.png"/>综艺热播榜</h3>
						</div>
					</div>
					<div class="stui-pannel_bd clearfix">
					
						<ul class="stui-vodlist__media active col-pd clearfix">
							<li>
							<div class="thumb">
								<a class="m-thumb stui-vodlist__thumb lazyload" href="/wapdetail/?484.html" title="超新星全运会" data-original="https://puui.qpic.cn/vcolumn_vt_pic/0/e7m2o61540257358/0"><span class="pic-tag pic-tag-h">1</span></a>
							</div>
							<div class="detail detail-side">
								<h4 class="title"><a href="/wapdetail/?484.html"><i class="icon iconfont icon-more text-muted pull-right"></i>超新星全运会</a></h4>
								<p class="font-12">
									<span class="text-muted">类型：</span>综艺 , <span class="text-muted">地区：</span>大陆
								</p>
								<p class="font-12 margin-0">
									<span class="text-muted">主演：</span>孟美岐,吴宣仪,杨..
								</p>
							</div>
							</li>
						</ul>
					
						<ul class="stui-vodlist__text active col-pd clearfix">
						
							<li class="col-xs-1 padding-0"><a class="text-overflow" href="/wapdetail/?292.html" title="奇葩说第五季"><span class="text-muted pull-right">{if:0<1}20181124期{elseif:0<1000 and 0>0}更新至第0集{elseif:0>1000}第0期{elseif:0=0 and "20181124期"=""}20181124期{end if}</span><em class="text-red">2 . </em>奇葩说第五季</a></li>
						
							<li class="col-xs-1 padding-0"><a class="text-overflow" href="/wapdetail/?291.html" title="妻子的浪漫旅行"><span class="text-muted pull-right">{if:0<1}20181121期{elseif:0<1000 and 0>0}更新至第0集{elseif:0>1000}第0期{elseif:0=0 and "20181121期"=""}20181121期{end if}</span><em class="text-red">3 . </em>妻子的浪漫旅行</a></li>
						
							<li class="col-xs-1 padding-0"><a class="text-overflow" href="/wapdetail/?522.html" title="少年说第二季"><span class="text-muted pull-right">{if:0<1}20181128期{elseif:0<1000 and 0>0}更新至第0集{elseif:0>1000}第0期{elseif:0=0 and "20181128期"=""}20181128期{end if}</span><em class="text-red">4 . </em>少年说第二季</a></li>
						
							<li class="col-xs-1 padding-0"><a class="text-overflow" href="/wapdetail/?293.html" title="明星大侦探第四季"><span class="text-muted pull-right">{if:0<1}20181123期{elseif:0<1000 and 0>0}更新至第0集{elseif:0>1000}第0期{elseif:0=0 and "20181123期"=""}20181123期{end if}</span><em class="text-red">5 . </em>明星大侦探第四..</a></li>
						
							<li class="col-xs-1 padding-0"><a class="text-overflow" href="/wapdetail/?294.html" title="Hi室友"><span class="text-muted pull-right">{if:0<1}20181114期{elseif:0<1000 and 0>0}更新至第0集{elseif:0>1000}第0期{elseif:0=0 and "20181114期"=""}20181114期{end if}</span><em class="text-red">6 . </em>Hi室友</a></li>
						
							<li class="col-xs-1 padding-0"><a class="text-overflow" href="/wapdetail/?501.html" title="RunningMan(2018)"><span class="text-muted pull-right">{if:0<1}20181125期{elseif:0<1000 and 0>0}更新至第0集{elseif:0>1000}第0期{elseif:0=0 and "20181125期"=""}20181125期{end if}</span><em class="text-red">7 . </em>Running..</a></li>
						
							<li class="col-xs-1 padding-0"><a class="text-overflow" href="/wapdetail/?524.html" title="吐槽大会第三季"><span class="text-muted pull-right">{if:0<1}20181125期{elseif:0<1000 and 0>0}更新至第0集{elseif:0>1000}第0期{elseif:0=0 and "20181125期"=""}20181125期{end if}</span><em class="text-red">8 . </em>吐槽大会第三季</a></li>
						
							<li class="col-xs-1 padding-0"><a class="text-overflow" href="/wapdetail/?521.html" title="我就是演员"><span class="text-muted pull-right">{if:0<1}20181124期{elseif:0<1000 and 0>0}更新至第0集{elseif:0>1000}第0期{elseif:0=0 and "20181124期"=""}20181124期{end if}</span><em class="text-red">9 . </em>我就是演员</a></li>
						
							<li class="col-xs-1 padding-0"><a class="text-overflow" href="/wapdetail/?526.html" title="这！就是灌篮第一季"><span class="text-muted pull-right">{if:0<1}20181121期{elseif:0<1000 and 0>0}更新至第0集{elseif:0>1000}第0期{elseif:0=0 and "20181121期"=""}20181121期{end if}</span><em class="text-red">10 . </em>这！就是灌篮第..</a></li>
						
						</ul>
					</div>
				</div>
			</div>
		
			<div class="stui-pannel stui-pannel-bg clearfix">
				<div class="stui-pannel-box">
					<div class="stui-pannel_hd">
						<div class="stui-pannel__head active bottom-line clearfix">
							<h3 class="title"><img src="/templets/aikanV1/images/icon_1.png"/>动漫热播榜</h3>
						</div>
					</div>
					<div class="stui-pannel_bd clearfix">
					
						<ul class="stui-vodlist__media active col-pd clearfix">
							<li>
							<div class="thumb">
								<a class="m-thumb stui-vodlist__thumb lazyload" href="/wapdetail/?485.html" title="全职法师第三季" data-original="http://puui.qpic.cn/vcover_vt_pic/0/8vdu7i5hr7anq5q1535824602/0"><span class="pic-tag pic-tag-h">1</span></a>
							</div>
							<div class="detail detail-side">
								<h4 class="title"><a href="/wapdetail/?485.html"><i class="icon iconfont icon-more text-muted pull-right"></i>全职法师第三季</a></h4>
								<p class="font-12">
									<span class="text-muted">类型：</span>动漫 , <span class="text-muted">地区：</span>大陆
								</p>
								<p class="font-12 margin-0">
									<span class="text-muted">主演：</span>内详
								</p>
							</div>
							</li>
						</ul>
					
						<ul class="stui-vodlist__text active col-pd clearfix">
						
							<li class="col-xs-1 padding-0"><a class="text-overflow" href="/wapdetail/?492.html" title="名侦探柯南"><span class="text-muted pull-right">{if:0<1}更新至第934集{elseif:0<1000 and 0>0}更新至第0集{elseif:0>1000}第0期{elseif:0=0 and "更新至第934集"=""}更新至第934集{end if}</span><em class="text-red">2 . </em>名侦探柯南</a></li>
						
							<li class="col-xs-1 padding-0"><a class="text-overflow" href="/wapdetail/?499.html" title="哥布林杀手"><span class="text-muted pull-right">{if:0<1}更新到08集{elseif:0<1000 and 0>0}更新至第0集{elseif:0>1000}第0期{elseif:0=0 and "更新到08集"=""}更新到08集{end if}</span><em class="text-red">3 . </em>哥布林杀手</a></li>
						
							<li class="col-xs-1 padding-0"><a class="text-overflow" href="/wapdetail/?486.html" title="妖神记之影妖篇"><span class="text-muted pull-right">{if:0<1}更新到19集{elseif:0<1000 and 0>0}更新至第0集{elseif:0>1000}第0期{elseif:0=0 and "更新到19集"=""}更新到19集{end if}</span><em class="text-red">4 . </em>妖神记之影妖篇</a></li>
						
							<li class="col-xs-1 padding-0"><a class="text-overflow" href="/wapdetail/?487.html" title="剑网3·侠肝义胆沈剑心"><span class="text-muted pull-right">{if:0<1}更新到11集{elseif:0<1000 and 0>0}更新至第0集{elseif:0>1000}第0期{elseif:0=0 and "更新到11集"=""}更新到11集{end if}</span><em class="text-red">5 . </em>剑网3·侠肝义..</a></li>
						
							<li class="col-xs-1 padding-0"><a class="text-overflow" href="/wapdetail/?488.html" title="星辰变"><span class="text-muted pull-right">{if:0<1}更新到09集{elseif:0<1000 and 0>0}更新至第0集{elseif:0>1000}第0期{elseif:0=0 and "更新到09集"=""}更新到09集{end if}</span><em class="text-red">6 . </em>星辰变</a></li>
						
							<li class="col-xs-1 padding-0"><a class="text-overflow" href="/wapdetail/?489.html" title="魔法禁书目录3"><span class="text-muted pull-right">{if:0<1}更新到08集{elseif:0<1000 and 0>0}更新至第0集{elseif:0>1000}第0期{elseif:0=0 and "更新到08集"=""}更新到08集{end if}</span><em class="text-red">7 . </em>魔法禁书目录3</a></li>
						
							<li class="col-xs-1 padding-0"><a class="text-overflow" href="/wapdetail/?490.html" title="画江湖之不良人3"><span class="text-muted pull-right">{if:0<1}更新到05集{elseif:0<1000 and 0>0}更新至第0集{elseif:0>1000}第0期{elseif:0=0 and "更新到05集"=""}更新到05集{end if}</span><em class="text-red">8 . </em>画江湖之不良人..</a></li>
						
							<li class="col-xs-1 padding-0"><a class="text-overflow" href="/wapdetail/?493.html" title="海贼王"><span class="text-muted pull-right">{if:0<1}更新至863集{elseif:0<1000 and 0>0}更新至第0集{elseif:0>1000}第0期{elseif:0=0 and "更新至863集"=""}更新至863集{end if}</span><em class="text-red">9 . </em>海贼王</a></li>
						
							<li class="col-xs-1 padding-0"><a class="text-overflow" href="/wapdetail/?494.html" title="名侦探柯南：零的执行人"><span class="text-muted pull-right">{if:0<1}BD1280高清国语|原声中字{elseif:0<1000 and 0>0}更新至第0集{elseif:0>1000}第0期{elseif:0=0 and "BD1280高清国语|原声中字"=""}BD1280高清国语|原声中字{end if}</span><em class="text-red">10 . </em>名侦探柯南：零..</a></li>
						
						</ul>
					</div>
				</div>
			</div>
		
			<!-- 列表翻页-->
		</div>
	</div>
</div>
<div class="container">
	<div class="row">
		<div class="stui-foot clearfix">
			<div class="col-pd text-center hidden-xs">
			</div>
			<p class="bdsharebuttonbox text-center margin-0 hidden-sm hidden-xs">
				<strong>分享：</strong><!--注释前面的图标开始<span class="bds_shere"></span>注释结束--><a class="bds_qzone" data-cmd="qzone" title="分享到QQ空间"></a><a class="bds_tsina" data-cmd="tsina" title="分享到新浪微博"></a><a class="bds_weixin" data-cmd="weixin" title="分享到微信"></a><a class="bds_tqq" data-cmd="tqq" title="分享到腾讯微博"></a><a class="bds_sqq" data-cmd="sqq" title="分享到QQ好友"></a><a class="bds_bdhome" data-cmd="bdhome" title="分享到百度新首页"></a><a class="bds_tqf" data-cmd="tqf" title="分享到腾讯朋友"></a><a class="bds_youdao" data-cmd="youdao" title="分享到有道云笔记"></a><a class="bds_more" data-cmd="more" title="更多"></a>
			</p>
          
          <!--<p class="text-muted hidden-sm hidden-xs">本网站内容收集于互联网，《大饼影视手机版》不承担任何由于内容的合法性及健康性所引起的争议和法律责任。<br> 本站永久免费更新最新电影与剧集，欢迎大家使用并推荐朋友。</p>-->
			<p class="margin-0 text-muted" style="text-align: center;">2018-2019
              <span> | </span> 
              视频总数：244
              <span> | </span>
              今天更新：0
              <span> | </span>
              {seacms:runinfo}</p>
          
			<!--底部大图片注释开始<p class="text-center hidden-xs">
				<a href="http://http://m.yfmovie.top/wap" target="_blank" title="大饼影视手机版"><img src="/templets/aikanV1/images/copy.png" width="150" height="48" alt="大饼影视手机版"/></a>
			</p>注释结束-->
			<!--底部版权注释开始，因为原来的版权只有手机才能看到<p class="text-muted text-center visible-xs">Copyright © 2015-2018  All Rights Reserved</p>注释结束-->
		</div>
	</div>
</div>
<ul class="stui-extra clearfix">
	<li><a class="backtop" href="javascript:scroll(0,0)" style="display: none;"><i class="icon iconfont icon-less"></i></a></li>
	<li class="visible-xs"><a class="open-share" href="javascript:;"><i class="icon iconfont icon-share"></i></a></li>
	<li class="hidden-xs"><span><i class="icon iconfont icon-qrcode"></i></span>
	<div class="sideslip">
		<div class="col-pd">
			<img class="qrcode" width="150" height="150"/>
			<p class="text-center font-12">
				<strong>手机扫码访问这个页面</strong>
			</p>
		</div>
	</div>
	</li>
</ul>
<div class="hide">
<script>
var _hmt = _hmt || [];
(function() {
  var hm = document.createElement("script");
  hm.src = "https://hm.baidu.com/hm.js?951e1c4e49fc2c956865811f5f7a4d84";
  var s = document.getElementsByTagName("script")[0]; 
  s.parentNode.insertBefore(hm, s);
})();
</script>

</div>
<script type="text/javascript" charset="utf-8">
	window._bd_share_config = {
		common: {
			bdText: '',
			bdDesc: '',
			bdUrl: '',
			bdPic: ''
		},
		share: [{
			"bdSize": 24,
			bdCustomStyle: '/templets/aikanV1/images/stui_default.css'
		}]
	}
	with(document) 0[(getElementsByTagName('head')[0] || body).appendChild(createElement('script')).src = 'http://bdimg.share.baidu.com/static/api/js/share.js?cdnversion=' + ~(-new Date() / 36e5)];
</script>
</body>
</html>