<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>大饼影视手机版</title>
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
<style type="text/css">
*{margin:0; padding:0;}
a{text-decoration: none;}
img{max-width: 100%; height: auto;}
.weixin-tip{display: none; position: fixed; left:0; top:0; bottom:0; background: rgba(0,0,0,0.8); filter:alpha(opacity=80);  height: 100%; width: 100%; z-index: 100;}
.weixin-tip p{text-align: center; margin-top: 10%; padding:0 5%;}
</style>
<!--[if lt IE 9]>
<script src="https://cdn.bootcss.com/html5shiv/3.7.2/html5shiv.min.js"></script>
<script src="https://cdn.bootcss.com/respond.js/1.4.2/respond.min.js"></script>
<![endif]-->
</head>
<body>
<div class="weixin-tip">
	<p>
		<img src="/wap/templets/aikanV1/html/live_weixin.png" alt="微信打开"/>
	</p>
</div>
<script type="text/javascript">
    $(window).on("load",function(){
        var winHeight = $(window).height();
		function is_weixin() {
		    var ua = navigator.userAgent.toLowerCase();
		    if (ua.match(/MicroMessenger/i) == "micromessenger") {
		        return true;
		    } else {
		        return false;
		    }
		}
		var isWeixin = is_weixin();
		if(isWeixin){
			$(".weixin-tip").css("height",winHeight);
            $(".weixin-tip").show();
			$("#header-top").hide();
			$(".container").hide();
		}
    })
</script>
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
				<li class="active" id="index1"><a href="http://www.lookoro.cn/wap/">首页</a></li>
				
				<li ><a href="/waplist/?1.html">电影</a></li>
				
				<li ><a href="/waplist/?2.html">电视剧</a></li>
				
				<li ><a href="/waplist/?3.html">综艺</a></li>
				
				<li ><a href="/waplist/?4.html">动漫</a></li>
				
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
<div class="container"><a href="https://jq.qq.com/?_wv=1027&k=5RuLzaJ">公众号：大饼影视点击群号加群：874801718免费更新</a>
	<div class="row">
		<!-- D071 by v.shoutu.cn -->
		<div class="stui-pannel stui-pannel-bg clearfix">
			<div class="stui-pannel-box clearfix">
				<div class="stui-pannel-bd">
					<div class="carousel carousel_default flickity-page">
					
						<div class="col-md-2 col-xs-1">
							<a href="/wapdetail/?484.html" class="stui-vodlist__thumb" title="超新星全运会" style="background: url(http://puui.qpic.cn/vupload/0/20181115_1542263756340_otmr02r4itp.jpeg/0) no-repeat; background-position:50% 50%; background-size: cover; padding-top: 45%;"><span class="pic-text text-center">超新星全运会</span></a>
						</div>
					
						<div class="col-md-2 col-xs-1">
							<a href="/wapdetail/?482.html" class="stui-vodlist__thumb" title="超人总动员2" style="background: url(http://img1.xmspc.com/uploads/images/oq11ymjufgdg.jpg) no-repeat; background-position:50% 50%; background-size: cover; padding-top: 45%;"><span class="pic-text text-center">超人总动员2</span></a>
						</div>
					
						<div class="col-md-2 col-xs-1">
							<a href="/wapdetail/?318.html" class="stui-vodlist__thumb" title="蚁人2：黄蜂女现身" style="background: url(http://img1.xmspc.com/uploads/images/pdfz2ygc1n7l.jpg) no-repeat; background-position:50% 50%; background-size: cover; padding-top: 45%;"><span class="pic-text text-center">蚁人2：黄蜂女现身</span></a>
						</div>
					
						<div class="col-md-2 col-xs-1">
							<a href="/wapdetail/?314.html" class="stui-vodlist__thumb" title="黄金兄弟" style="background: url(http://img1.xmspc.com/uploads/images/k8z1ddvla5el.jpg) no-repeat; background-position:50% 50%; background-size: cover; padding-top: 45%;"><span class="pic-text text-center">黄金兄弟</span></a>
						</div>
					
						<div class="col-md-2 col-xs-1">
							<a href="/wapdetail/?313.html" class="stui-vodlist__thumb" title="反贪风暴3" style="background: url(http://img1.xmspc.com/uploads/images/qush1m40f973.jpg) no-repeat; background-position:50% 50%; background-size: cover; padding-top: 45%;"><span class="pic-text text-center">反贪风暴3</span></a>
						</div>
					
                             
                      <!-- 为了持续发展,望各位网友帮忙宣传下本站,可以去经常上的论坛,微博,QQ群,朋友圈等发下本站网址，小编在此谢谢了,有任何问题可以加群告诉我们.
本站唯一网址：http://m.yfmovie.top/wap-->
                  </div>
				</div>
			</div>
		</div>
		<!-- 幻灯片 -->
		<!-- 顶级分类序号，自己修改：后台管理-数据-分类管理-最右边的“排序” -->
		<div class="stui-pannel stui-pannel-bg clearfix">
			<div class="stui-pannel-box clearfix">
				<div class="col-lg-wide-75 col-xs-1 padding-0">
					<div class="stui-pannel_hd">
						<div class="stui-pannel__head clearfix">
							<a class="more text-muted pull-right" href="/waplist/?1.html"><font color="#FF0000">更多</font><!-- 这个首页的更多我修改了红色的 --> <i class="icon iconfont icon-more"></i></a>
							<h3 class="title"><img src="/templets/aikanV1/images/icon_1.png"/><a href="/waplist/?1.html">电影</a></h3>
							<ul class="nav nav-text pull-right hidden-sm hidden-xs">
							
								<li><a href="/waplist/?5.html" class="text-muted">动作片</a><span class="split-line"></span></li>
							
								<li><a href="/waplist/?6.html" class="text-muted">爱情片</a><span class="split-line"></span></li>
							
								<li><a href="/waplist/?7.html" class="text-muted">科幻片</a><span class="split-line"></span></li>
							
								<li><a href="/waplist/?8.html" class="text-muted">恐怖片</a><span class="split-line"></span></li>
							
								<li><a href="/waplist/?9.html" class="text-muted">战争片</a><span class="split-line"></span></li>
							
								<li><a href="/waplist/?10.html" class="text-muted">喜剧片</a><span class="split-line"></span></li>
							
								<li><a href="/waplist/?11.html" class="text-muted">纪录片</a><span class="split-line"></span></li>
							
								<li><a href="/waplist/?12.html" class="text-muted">剧情片</a><span class="split-line"></span></li>
							
							</ul>
						</div>
					</div>
					<div class="stui-pannel_bd clearfix">
						<ul class="stui-vodlist clearfix">
						<!-- 前面的原版数字是10，我修改了15，修复手机首页显示卡片缺少块问题 -->
							<li class="col-md-5 col-sm-4 col-xs-3">
							<div class="stui-vodlist__box">
								<a class="stui-vodlist__thumb lazyload" href="/wapdetail/?439.html" title="釜山行" data-original="http://img31.mtime.cn/mg/2016/07/25/110810.29899494_270X405X4.jpg"><span class="play hidden-xs"></span><span class="pic-text text-right">超清</span></a>
								<div class="stui-vodlist__detail">
									<h4 class="title text-overflow"><a href="/wapdetail/?439.html" title="釜山行">釜山行</a></h4>
									<p class="text text-overflow text-muted hidden-xs">孔侑,郑有美,马东锡,安昭熙,金义城,崔宇植,金秀安</p>
								</div>
							</div>
							</li>
						<!-- 前面的原版数字是10，我修改了15，修复手机首页显示卡片缺少块问题 -->
							<li class="col-md-5 col-sm-4 col-xs-3">
							<div class="stui-vodlist__box">
								<a class="stui-vodlist__thumb lazyload" href="/wapdetail/?543.html" title="永不言弃" data-original="/uploads/allimg/181204/4bc7623820495466.jpg"><span class="play hidden-xs"></span><span class="pic-text text-right">BD1280高清中字版</span></a>
								<div class="stui-vodlist__detail">
									<h4 class="title text-overflow"><a href="/wapdetail/?543.html" title="永不言弃">永不言弃</a></h4>
									<p class="text text-overflow text-muted hidden-xs">塚田僚一,岩本照,深澤辰哉,渡辺翔太</p>
								</div>
							</div>
							</li>
						<!-- 前面的原版数字是10，我修改了15，修复手机首页显示卡片缺少块问题 -->
							<li class="col-md-5 col-sm-4 col-xs-3">
							<div class="stui-vodlist__box">
								<a class="stui-vodlist__thumb lazyload" href="/wapdetail/?541.html" title="毒液：致命守护者" data-original="/uploads/allimg/181126/2d3a571b56ecfc78.jpg"><span class="play hidden-xs"></span><span class="pic-text text-right">HD1280高清中英双字版</span></a>
								<div class="stui-vodlist__detail">
									<h4 class="title text-overflow"><a href="/wapdetail/?541.html" title="毒液：致命守护者">毒液：致命守护者</a></h4>
									<p class="text text-overflow text-muted hidden-xs">汤姆·哈迪,米歇尔·威廉姆斯,里兹·阿迈德,斯科特·黑兹</p>
								</div>
							</div>
							</li>
						<!-- 前面的原版数字是10，我修改了15，修复手机首页显示卡片缺少块问题 -->
							<li class="col-md-5 col-sm-4 col-xs-3">
							<div class="stui-vodlist__box">
								<a class="stui-vodlist__thumb lazyload" href="/wapdetail/?540.html" title="卧虎藏龙" data-original="/uploads/allimg/181126/2bfa1b1d6770563c.jpg"><span class="play hidden-xs"></span><span class="pic-text text-right">BD1280高清国语中字版</span></a>
								<div class="stui-vodlist__detail">
									<h4 class="title text-overflow"><a href="/wapdetail/?540.html" title="卧虎藏龙">卧虎藏龙</a></h4>
									<p class="text text-overflow text-muted hidden-xs">周润发,杨紫琼,章子怡,张震</p>
								</div>
							</div>
							</li>
						<!-- 前面的原版数字是10，我修改了15，修复手机首页显示卡片缺少块问题 -->
							<li class="col-md-5 col-sm-4 col-xs-3">
							<div class="stui-vodlist__box">
								<a class="stui-vodlist__thumb lazyload" href="/wapdetail/?334.html" title="邪不压正" data-original="http://img5.mtime.cn/mg/2018/07/13/144859.85113276_270X405X4.jpg"><span class="play hidden-xs"></span><span class="pic-text text-right">HD1280高清国语中字版</span></a>
								<div class="stui-vodlist__detail">
									<h4 class="title text-overflow"><a href="/wapdetail/?334.html" title="邪不压正">邪不压正</a></h4>
									<p class="text text-overflow text-muted hidden-xs">彭于晏,廖凡,姜文,周韵</p>
								</div>
							</div>
							</li>
						<!-- 前面的原版数字是10，我修改了15，修复手机首页显示卡片缺少块问题 -->
							<li class="col-md-5 col-sm-4 col-xs-3">
							<div class="stui-vodlist__box">
								<a class="stui-vodlist__thumb lazyload" href="/wapdetail/?534.html" title="前度" data-original="/uploads/allimg/181123/9ce45f124f9a8735.jpg"><span class="play hidden-xs"></span><span class="pic-text text-right">HD1280高清国语|粤语中字版</span></a>
								<div class="stui-vodlist__detail">
									<h4 class="title text-overflow"><a href="/wapdetail/?534.html" title="前度">前度</a></h4>
									<p class="text text-overflow text-muted hidden-xs">陈伟霆,钟欣潼,卫诗雅,曾国祥</p>
								</div>
							</div>
							</li>
						<!-- 前面的原版数字是10，我修改了15，修复手机首页显示卡片缺少块问题 -->
							<li class="col-md-5 col-sm-4 col-xs-3">
							<div class="stui-vodlist__box">
								<a class="stui-vodlist__thumb lazyload" href="/wapdetail/?530.html" title="三傻大闹宝莱坞" data-original="/uploads/allimg/181122/7035bd10c7966150.jpg"><span class="play hidden-xs"></span><span class="pic-text text-right">BD1280高清中字版</span></a>
								<div class="stui-vodlist__detail">
									<h4 class="title text-overflow"><a href="/wapdetail/?530.html" title="三傻大闹宝莱坞">三傻大闹宝莱坞</a></h4>
									<p class="text text-overflow text-muted hidden-xs">阿米尔·汗,卡琳娜·卡普尔,马达范,沙尔曼·乔希</p>
								</div>
							</div>
							</li>
						<!-- 前面的原版数字是10，我修改了15，修复手机首页显示卡片缺少块问题 -->
							<li class="col-md-5 col-sm-4 col-xs-3">
							<div class="stui-vodlist__box">
								<a class="stui-vodlist__thumb lazyload" href="/wapdetail/?523.html" title="那些年，我们的青春岁月" data-original="https://timgsa.baidu.com/timg?image&quality=80&size=b9999_10000&sec=1542699689728&di=e5777b70e21acd40f48e663604fcb55d&imgtype=0&src=http%3A%2F%2Fpic.ywtx.cc%2Fpic%2Fuploadimg%2F2018-11%2F201811191542615278.jpg"><span class="play hidden-xs"></span><span class="pic-text text-right">HD1280高清国语中字版</span></a>
								<div class="stui-vodlist__detail">
									<h4 class="title text-overflow"><a href="/wapdetail/?523.html" title="那些年，我们的青春岁月">那些年，我们的青春岁月</a></h4>
									<p class="text text-overflow text-muted hidden-xs">王越</p>
								</div>
							</div>
							</li>
						<!-- 前面的原版数字是10，我修改了15，修复手机首页显示卡片缺少块问题 -->
							<li class="col-md-5 col-sm-4 col-xs-3">
							<div class="stui-vodlist__box">
								<a class="stui-vodlist__thumb lazyload" href="/wapdetail/?525.html" title="极速杀机" data-original="http://image11.m1905.cn/mdb/uploadfile/2018/0611/thumb_1_283_390_20180611095153532595.jpg"><span class="play hidden-xs"></span><span class="pic-text text-right">BD1280高清中字版</span></a>
								<div class="stui-vodlist__detail">
									<h4 class="title text-overflow"><a href="/wapdetail/?525.html" title="极速杀机">极速杀机</a></h4>
									<p class="text text-overflow text-muted hidden-xs">约翰·特拉沃尔塔,詹迪·莫拉,凯瑟琳·温妮克,米拉·索维诺</p>
								</div>
							</div>
							</li>
						<!-- 前面的原版数字是10，我修改了15，修复手机首页显示卡片缺少块问题 -->
							<li class="col-md-5 col-sm-4 col-xs-3">
							<div class="stui-vodlist__box">
								<a class="stui-vodlist__thumb lazyload" href="/wapdetail/?511.html" title="非常嫌疑犯" data-original="https://gss3.bdstatic.com/-Po3dSag_xI4khGkpoWK1HF6hhy/baike/s%3D220/sign=0e9428fa3901213fcb3349de64e636f8/cdbf6c81800a19d83fba982633fa828ba61e4653.jpg"><span class="play hidden-xs"></span><span class="pic-text text-right">HD高清</span></a>
								<div class="stui-vodlist__detail">
									<h4 class="title text-overflow"><a href="/wapdetail/?511.html" title="非常嫌疑犯">非常嫌疑犯</a></h4>
									<p class="text text-overflow text-muted hidden-xs">史蒂芬·鲍德温,加布里埃尔·伯恩,本尼西奥·德尔·托罗,凯文·波拉克</p>
								</div>
							</div>
							</li>
						<!-- 前面的原版数字是10，我修改了15，修复手机首页显示卡片缺少块问题 -->
							<li class="col-md-5 col-sm-4 col-xs-3">
							<div class="stui-vodlist__box">
								<a class="stui-vodlist__thumb lazyload" href="/wapdetail/?510.html" title="控方证人" data-original="http://img31.mtime.cn/mt/2014/02/23/001732.78814428_270X405X4.jpg"><span class="play hidden-xs"></span><span class="pic-text text-right">HD高清</span></a>
								<div class="stui-vodlist__detail">
									<h4 class="title text-overflow"><a href="/wapdetail/?510.html" title="控方证人">控方证人</a></h4>
									<p class="text text-overflow text-muted hidden-xs">拉尔夫·理查德森,黛博拉·蔻儿,博·布里奇斯,黛安娜·里格</p>
								</div>
							</div>
							</li>
						<!-- 前面的原版数字是10，我修改了15，修复手机首页显示卡片缺少块问题 -->
							<li class="col-md-5 col-sm-4 col-xs-3">
							<div class="stui-vodlist__box">
								<a class="stui-vodlist__thumb lazyload" href="/wapdetail/?505.html" title="楚门的世界" data-original="https://ss0.baidu.com/6ONWsjip0QIZ8tyhnq/it/u=2521426881,315274944&fm=58&s=B52200BE5442F6EE509314E50300F087"><span class="play hidden-xs"></span><span class="pic-text text-right">HD高清</span></a>
								<div class="stui-vodlist__detail">
									<h4 class="title text-overflow"><a href="/wapdetail/?505.html" title="楚门的世界">楚门的世界</a></h4>
									<p class="text text-overflow text-muted hidden-xs">金·凯瑞,劳拉·琳妮,艾德·哈里斯,诺亚·艾默里奇</p>
								</div>
							</div>
							</li>
						<!-- 前面的原版数字是10，我修改了15，修复手机首页显示卡片缺少块问题 -->
							<li class="col-md-5 col-sm-4 col-xs-3">
							<div class="stui-vodlist__box">
								<a class="stui-vodlist__thumb lazyload" href="/wapdetail/?506.html" title="唐人街探案2" data-original="http://img5.mtime.cn/mg/2018/02/05/093620.13079693_270X405X4.jpg"><span class="play hidden-xs"></span><span class="pic-text text-right">HD</span></a>
								<div class="stui-vodlist__detail">
									<h4 class="title text-overflow"><a href="/wapdetail/?506.html" title="唐人街探案2">唐人街探案2</a></h4>
									<p class="text text-overflow text-muted hidden-xs">王宝强,刘昊然,肖央,刘承羽</p>
								</div>
							</div>
							</li>
						<!-- 前面的原版数字是10，我修改了15，修复手机首页显示卡片缺少块问题 -->
							<li class="col-md-5 col-sm-4 col-xs-3">
							<div class="stui-vodlist__box">
								<a class="stui-vodlist__thumb lazyload" href="/wapdetail/?507.html" title="超时空同居" data-original="http://img5.mtime.cn/mg/2018/05/05/175423.17616161_270X405X4.jpg"><span class="play hidden-xs"></span><span class="pic-text text-right">HD</span></a>
								<div class="stui-vodlist__detail">
									<h4 class="title text-overflow"><a href="/wapdetail/?507.html" title="超时空同居">超时空同居</a></h4>
									<p class="text text-overflow text-muted hidden-xs">雷佳音,佟丽娅,张衣,于和伟</p>
								</div>
							</div>
							</li>
						<!-- 前面的原版数字是10，我修改了15，修复手机首页显示卡片缺少块问题 -->
							<li class="col-md-5 col-sm-4 col-xs-3">
							<div class="stui-vodlist__box">
								<a class="stui-vodlist__thumb lazyload" href="/wapdetail/?508.html" title="一出好戏" data-original="http://img5.mtime.cn/mg/2018/09/30/095413.32270331_270X405X4.jpg"><span class="play hidden-xs"></span><span class="pic-text text-right">HD</span></a>
								<div class="stui-vodlist__detail">
									<h4 class="title text-overflow"><a href="/wapdetail/?508.html" title="一出好戏">一出好戏</a></h4>
									<p class="text text-overflow text-muted hidden-xs">黄渤,舒淇,王宝强,张艺兴</p>
								</div>
							</div>
							</li>
						
						</ul>
					</div>
				</div>
			<div class="col-lg-wide-25 hidden-md hidden-sm hidden-xs">
					<div class="stui-pannel_hd">
						<div class="stui-pannel__head clearfix">
							<a class="more text-muted pull-right" href="/search.php?searchtype=5&tid=1&order=hit">更多 <i class="icon iconfont icon-more"></i></a>
							<h3 class="title"><img src="/templets/aikanV1/images/icon_12.png"/>热播榜</h3>
						</div>
					</div>
					<div class="stui-pannel_bd">
						<ul class="stui-vodlist__media active col-pd clearfix">
						
							<li>
							<div class="thumb">
								<a class="m-thumb stui-vodlist__thumb lazyload" href="/wapdetail/?541.html" title="毒液：致命守护者" data-original="/uploads/allimg/181126/2d3a571b56ecfc78.jpg"><span class="pic-tag pic-tag-h">1</span></a>
							</div>
							<div class="detail detail-side">
								<h4 class="title"><a href="/wapdetail/?541.html"><i class="icon iconfont icon-more text-muted pull-right"></i>毒液：致命守护者</a></h4>
								<p class="font-12">
									<span class="text-muted">类型：</span>动作片<span class="text-muted">地区：</span>美国
								</p>
								<p class="font-12 margin-0">
									<span class="text-muted">主演：</span>汤姆·哈迪,米歇尔·威廉姆..
								</p>
							</div>
							</li>
						
						</ul>
						<ul class="stui-vodlist__rank col-pd clearfix">
						
							<li><a href="/wapdetail/?478.html" title="毒诫"><span class="text-muted pull-right">BD1280高清国语|粤语中字</span><span class="badge badge-second">2</span>毒诫</a></li>
						
							<li><a href="/wapdetail/?439.html" title="釜山行"><span class="text-muted pull-right">超清</span><span class="badge badge-third">3</span>釜山行</a></li>
						
							<li><a href="/wapdetail/?318.html" title="蚁人2：黄蜂女现身"><span class="text-muted pull-right">BD1280高清特效国语|原声</span><span class="badge ">4</span>蚁人2：黄蜂女现..</a></li>
						
							<li><a href="/wapdetail/?510.html" title="控方证人"><span class="text-muted pull-right">HD高清</span><span class="badge ">5</span>控方证人</a></li>
						
							<li><a href="/wapdetail/?310.html" title="低压槽：欲望之城"><span class="text-muted pull-right">BD1280高清国语中字版丨</span><span class="badge ">6</span>低压槽：欲望之城</a></li>
						
							<li><a href="/wapdetail/?315.html" title="大轰炸"><span class="text-muted pull-right">HD1280高清中英双字版</span><span class="badge ">7</span>大轰炸</a></li>
						
							<li><a href="/wapdetail/?349.html" title="僵尸世界大战"><span class="text-muted pull-right">BD1280高清中英双字版</span><span class="badge ">8</span>僵尸世界大战</a></li>
						
							<li><a href="/wapdetail/?320.html" title="空中监狱"><span class="text-muted pull-right">HD1280高清中字版</span><span class="badge ">9</span>空中监狱</a></li>
						
							<li><a href="/wapdetail/?322.html" title="无双"><span class="text-muted pull-right">HDTC清晰版</span><span class="badge ">10</span>无双</a></li>
						
						</ul>
					</div>
					<div class="stui-pannel_hd">
						<div class="stui-pannel__head clearfix">
							<a class="more text-muted pull-right" href="/search.php?searchtype=5&tid=1">更多 <i class="icon iconfont icon-more"></i></a>
							<h3 class="title"><img src="/templets/aikanV1/images/icon_25.png"/>筛选</h3>
						</div>
					</div>
					<div class="stui-pannel_bd col-pd">
						<ul class="stui-vodlist__screen clearfix">
							<li><a href="/search.php?searchtype=5&tid=1&area=大陆" title="大陆">大陆</a></li>
							<li><a href="/search.php?searchtype=5&tid=1&area=香港" title="香港">香港</a></li>
							<li><a href="/search.php?searchtype=5&tid=1&area=台湾" title="台湾">台湾</a></li>
							<li><a href="/search.php?searchtype=5&tid=1&area=日本" title="日本">日本</a></li>
							<li><a href="/search.php?searchtype=5&tid=1&area=韩国" title="韩国">韩国</a></li>
							<li><a href="/search.php?searchtype=5&tid=1&area=欧美" title="欧美">欧美</a></li>
							<li><a href="/search.php?searchtype=5&tid=1&area=泰国" title="泰国">泰国</a></li>
							<li><a href="/search.php?searchtype=5&tid=1&area=其他" title="其他">其他</a></li>
						</ul>
						<ul class="stui-vodlist__screen top-line-dot clearfix">
							<li><a href="/search.php?searchtype=5&tid=1&year=2018" title="2018">2018</a></li>
							<li><a href="/search.php?searchtype=5&tid=1&year=2017" title="2017">2017</a></li>
							<li><a href="/search.php?searchtype=5&tid=1&year=2016" title="2016">2016</a></li>
							<li><a href="/search.php?searchtype=5&tid=1&year=2015" title="2015">2015</a></li>
							<li><a href="/search.php?searchtype=5&tid=1&year=2014" title="2014">2014</a></li>
							<li><a href="/search.php?searchtype=5&tid=1&year=2013" title="2013">2013</a></li>
							<li><a href="/search.php?searchtype=5&tid=1&year=2012" title="2012">2012</a></li>
							<li><a href="/search.php?searchtype=5&tid=1&year=2011" title="2011">2011</a></li>
							<li><a href="/search.php?searchtype=5&tid=1&year=2010" title="2010">2010</a></li>
							<li><a href="/search.php?searchtype=5&tid=1&year=2009" title="2009">2009</a></li>
							<li><a href="/search.php?searchtype=5&tid=1&year=2008" title="2008">2008</a></li>
							<li><a href="/search.php?searchtype=5&tid=1&year=more" title="更早">更早</a></li>
						</ul>
					</div>
				</div>
			</div>
		</div>
		<!-- 顶级分类序号，自己修改：后台管理-数据-分类管理-最右边的“排序” -->
		<div class="stui-pannel stui-pannel-bg clearfix">
			<div class="stui-pannel-box clearfix">
				<div class="col-lg-wide-75 col-xs-1 padding-0">
					<div class="stui-pannel_hd">
						<div class="stui-pannel__head clearfix">
							<a class="more text-muted pull-right" href="/waplist/?2.html"><font color="#FF0000">更多</font><!-- 这个首页的更多我修改了红色的 --> <i class="icon iconfont icon-more"></i></a>
							<h3 class="title"><img src="/templets/aikanV1/images/icon_2.png"/><a href="/waplist/?2.html">电视剧</a></h3>
							<ul class="nav nav-text pull-right hidden-sm hidden-xs">
							
								<li><a href="/waplist/?13.html" class="text-muted">大陆剧</a><span class="split-line"></span></li>
							
								<li><a href="/waplist/?14.html" class="text-muted">港台剧</a><span class="split-line"></span></li>
							
								<li><a href="/waplist/?15.html" class="text-muted">欧美剧</a><span class="split-line"></span></li>
							
								<li><a href="/waplist/?16.html" class="text-muted">日韩剧</a><span class="split-line"></span></li>
							
							</ul>
						</div>
					</div>
					<div class="stui-pannel_bd clearfix">
						<ul class="stui-vodlist clearfix">
						<!-- 前面的原版数字是10，我修改了15，修复手机首页显示卡片缺少块问题 -->
							<li class="col-md-5 col-sm-4 col-xs-3">
							<div class="stui-vodlist__box">
								<a class="stui-vodlist__thumb lazyload" href="/wapdetail/?537.html" title="我的恶魔少爷" data-original="http://puui.qpic.cn/vcover_vt_pic/0/rr8phxs26b6e7qj1542601547/0"><span class="play hidden-xs"></span><span class="pic-text text-right">更新到16集</span></a>
								<div class="stui-vodlist__detail">
									<h4 class="title text-overflow"><a href="/wapdetail/?537.html" title="我的恶魔少爷">我的恶魔少爷</a></h4>
									<p class="text text-overflow text-muted hidden-xs">贾征宇,余心恬,文生,李岑奕</p>
								</div>
							</div>
							</li>
						<!-- 前面的原版数字是10，我修改了15，修复手机首页显示卡片缺少块问题 -->
							<li class="col-md-5 col-sm-4 col-xs-3">
							<div class="stui-vodlist__box">
								<a class="stui-vodlist__thumb lazyload" href="/wapdetail/?545.html" title="那座城这家人" data-original="https://gss1.bdstatic.com/9vo3dSag_xI4khGkpoWK1HF6hhy/baike/w%3D268%3Bg%3D0/sign=aa54e53cff1fbe091c5ec412535b6b0e/c2cec3fdfc03924507173b458a94a4c27c1e25de.jpg"><span class="play hidden-xs"></span><span class="pic-text text-right">更新到06集</span></a>
								<div class="stui-vodlist__detail">
									<h4 class="title text-overflow"><a href="/wapdetail/?545.html" title="那座城这家人">那座城这家人</a></h4>
									<p class="text text-overflow text-muted hidden-xs">马元,童蕾,萨日娜,李建义</p>
								</div>
							</div>
							</li>
						<!-- 前面的原版数字是10，我修改了15，修复手机首页显示卡片缺少块问题 -->
							<li class="col-md-5 col-sm-4 col-xs-3">
							<div class="stui-vodlist__box">
								<a class="stui-vodlist__thumb lazyload" href="/wapdetail/?309.html" title="千门江湖之诡面疑云" data-original="https://puui.qpic.cn/vcover_vt_pic/0/u0a57gt7brnyro71541152253/260"><span class="play hidden-xs"></span><span class="pic-text text-right">更新到30集</span></a>
								<div class="stui-vodlist__detail">
									<h4 class="title text-overflow"><a href="/wapdetail/?309.html" title="千门江湖之诡面疑云">千门江湖之诡面疑云</a></h4>
									<p class="text text-overflow text-muted hidden-xs">宁桓宇,金雯昕,李岱昆,朱娅</p>
								</div>
							</div>
							</li>
						<!-- 前面的原版数字是10，我修改了15，修复手机首页显示卡片缺少块问题 -->
							<li class="col-md-5 col-sm-4 col-xs-3">
							<div class="stui-vodlist__box">
								<a class="stui-vodlist__thumb lazyload" href="/wapdetail/?308.html" title="你和我的倾城时光" data-original="http://img5.mtime.cn/mg/2018/10/26/100504.48033232_270X405X4.jpg"><span class="play hidden-xs"></span><span class="pic-text text-right">更新到42集</span></a>
								<div class="stui-vodlist__detail">
									<h4 class="title text-overflow"><a href="/wapdetail/?308.html" title="你和我的倾城时光">你和我的倾城时光</a></h4>
									<p class="text text-overflow text-muted hidden-xs">赵丽颖,金瀚,曹曦文,俞灏明</p>
								</div>
							</div>
							</li>
						<!-- 前面的原版数字是10，我修改了15，修复手机首页显示卡片缺少块问题 -->
							<li class="col-md-5 col-sm-4 col-xs-3">
							<div class="stui-vodlist__box">
								<a class="stui-vodlist__thumb lazyload" href="/wapdetail/?307.html" title="我们的四十年" data-original="http://img5.mtime.cn/mg/2018/11/12/143723.86771027_270X405X4.jpg"><span class="play hidden-xs"></span><span class="pic-text text-right">更新到44集</span></a>
								<div class="stui-vodlist__detail">
									<h4 class="title text-overflow"><a href="/wapdetail/?307.html" title="我们的四十年">我们的四十年</a></h4>
									<p class="text text-overflow text-muted hidden-xs">金世佳,柴碧云,李茂,徐小飒</p>
								</div>
							</div>
							</li>
						<!-- 前面的原版数字是10，我修改了15，修复手机首页显示卡片缺少块问题 -->
							<li class="col-md-5 col-sm-4 col-xs-3">
							<div class="stui-vodlist__box">
								<a class="stui-vodlist__thumb lazyload" href="/wapdetail/?306.html" title="幸福一家人" data-original="http://img5.mtime.cn/mg/2018/11/12/105351.54627213_270X405X4.jpg"><span class="play hidden-xs"></span><span class="pic-text text-right">更新到50集</span></a>
								<div class="stui-vodlist__detail">
									<h4 class="title text-overflow"><a href="/wapdetail/?306.html" title="幸福一家人">幸福一家人</a></h4>
									<p class="text text-overflow text-muted hidden-xs">董洁,翟天临,李立群,邱泽</p>
								</div>
							</div>
							</li>
						<!-- 前面的原版数字是10，我修改了15，修复手机首页显示卡片缺少块问题 -->
							<li class="col-md-5 col-sm-4 col-xs-3">
							<div class="stui-vodlist__box">
								<a class="stui-vodlist__thumb lazyload" href="/wapdetail/?518.html" title="双世宠妃2" data-original="https://gss3.bdstatic.com/7Po3dSag_xI4khGkpoWK1HF6hhy/baike/w%3D268%3Bg%3D0/sign=96d605da05fa513d51aa6bd8055632c6/314e251f95cad1c8a0df6c21723e6709c93d514b.jpg"><span class="play hidden-xs"></span><span class="pic-text text-right">30集全</span></a>
								<div class="stui-vodlist__detail">
									<h4 class="title text-overflow"><a href="/wapdetail/?518.html" title="双世宠妃2">双世宠妃2</a></h4>
									<p class="text text-overflow text-muted hidden-xs">邢昭林,梁洁,王瑞昌,钟祺</p>
								</div>
							</div>
							</li>
						<!-- 前面的原版数字是10，我修改了15，修复手机首页显示卡片缺少块问题 -->
							<li class="col-md-5 col-sm-4 col-xs-3">
							<div class="stui-vodlist__box">
								<a class="stui-vodlist__thumb lazyload" href="/wapdetail/?301.html" title="将夜" data-original="http://img5.mtime.cn/mg/2018/10/25/094114.35579526_270X405X4.jpg"><span class="play hidden-xs"></span><span class="pic-text text-right">更新到32集</span></a>
								<div class="stui-vodlist__detail">
									<h4 class="title text-overflow"><a href="/wapdetail/?301.html" title="将夜">将夜</a></h4>
									<p class="text text-overflow text-muted hidden-xs">陈飞宇,宋伊人,胡军,郑少秋</p>
								</div>
							</div>
							</li>
						<!-- 前面的原版数字是10，我修改了15，修复手机首页显示卡片缺少块问题 -->
							<li class="col-md-5 col-sm-4 col-xs-3">
							<div class="stui-vodlist__box">
								<a class="stui-vodlist__thumb lazyload" href="/wapdetail/?533.html" title="回到明朝当王爷" data-original="/uploads/allimg/181123/01d17b10e50a8bdd.jpg"><span class="play hidden-xs"></span><span class="pic-text text-right">更新到37集</span></a>
								<div class="stui-vodlist__detail">
									<h4 class="title text-overflow"><a href="/wapdetail/?533.html" title="回到明朝当王爷">回到明朝当王爷</a></h4>
									<p class="text text-overflow text-muted hidden-xs">蒋劲夫,袁冰妍,刘芮麟,柳岩</p>
								</div>
							</div>
							</li>
						<!-- 前面的原版数字是10，我修改了15，修复手机首页显示卡片缺少块问题 -->
							<li class="col-md-5 col-sm-4 col-xs-3">
							<div class="stui-vodlist__box">
								<a class="stui-vodlist__thumb lazyload" href="/wapdetail/?305.html" title="惊蛰" data-original="https://puui.qpic.cn/vcover_vt_pic/0/l19x9qoetxc5rh81541150858/260"><span class="play hidden-xs"></span><span class="pic-text text-right">39集全</span></a>
								<div class="stui-vodlist__detail">
									<h4 class="title text-overflow"><a href="/wapdetail/?305.html" title="惊蛰">惊蛰</a></h4>
									<p class="text text-overflow text-muted hidden-xs">杨烁,迟嘉,林雪飘,刘陆</p>
								</div>
							</div>
							</li>
						<!-- 前面的原版数字是10，我修改了15，修复手机首页显示卡片缺少块问题 -->
							<li class="col-md-5 col-sm-4 col-xs-3">
							<div class="stui-vodlist__box">
								<a class="stui-vodlist__thumb lazyload" href="/wapdetail/?300.html" title="盛唐幻夜" data-original="http://img5.mtime.cn/mg/2018/11/06/105422.19042849_270X405X4.jpg"><span class="play hidden-xs"></span><span class="pic-text text-right">更新到42集</span></a>
								<div class="stui-vodlist__detail">
									<h4 class="title text-overflow"><a href="/wapdetail/?300.html" title="盛唐幻夜">盛唐幻夜</a></h4>
									<p class="text text-overflow text-muted hidden-xs">吴倩,郑业成,张雨剑,董琦</p>
								</div>
							</div>
							</li>
						<!-- 前面的原版数字是10，我修改了15，修复手机首页显示卡片缺少块问题 -->
							<li class="col-md-5 col-sm-4 col-xs-3">
							<div class="stui-vodlist__box">
								<a class="stui-vodlist__thumb lazyload" href="/wapdetail/?304.html" title="风再起时" data-original="http://img5.mtime.cn/mg/2018/10/19/093358.93310616_270X405X4.jpg"><span class="play hidden-xs"></span><span class="pic-text text-right">更新到32集</span></a>
								<div class="stui-vodlist__detail">
									<h4 class="title text-overflow"><a href="/wapdetail/?304.html" title="风再起时">风再起时</a></h4>
									<p class="text text-overflow text-muted hidden-xs">陆毅,袁泉,朱雨辰,王维维</p>
								</div>
							</div>
							</li>
						<!-- 前面的原版数字是10，我修改了15，修复手机首页显示卡片缺少块问题 -->
							<li class="col-md-5 col-sm-4 col-xs-3">
							<div class="stui-vodlist__box">
								<a class="stui-vodlist__thumb lazyload" href="/wapdetail/?296.html" title="凉生，我们可不可以不忧伤" data-original="http://img5.mtime.cn/mg/2018/09/10/172937.18070179_270X405X4.jpg"><span class="play hidden-xs"></span><span class="pic-text text-right">70集全</span></a>
								<div class="stui-vodlist__detail">
									<h4 class="title text-overflow"><a href="/wapdetail/?296.html" title="凉生，我们可不可以不忧伤">凉生，我们可不可以不忧伤</a></h4>
									<p class="text text-overflow text-muted hidden-xs">钟汉良,马天宇,孙怡,于朦胧</p>
								</div>
							</div>
							</li>
						<!-- 前面的原版数字是10，我修改了15，修复手机首页显示卡片缺少块问题 -->
							<li class="col-md-5 col-sm-4 col-xs-3">
							<div class="stui-vodlist__box">
								<a class="stui-vodlist__thumb lazyload" href="/wapdetail/?520.html" title="斗破苍穹" data-original="http://puui.qpic.cn/vcover_vt_pic/0/5joaacfgqdo8q8v1535974673/260"><span class="play hidden-xs"></span><span class="pic-text text-right">更新到42集</span></a>
								<div class="stui-vodlist__detail">
									<h4 class="title text-overflow"><a href="/wapdetail/?520.html" title="斗破苍穹">斗破苍穹</a></h4>
									<p class="text text-overflow text-muted hidden-xs">吴磊,林允,李沁,陈楚河</p>
								</div>
							</div>
							</li>
						<!-- 前面的原版数字是10，我修改了15，修复手机首页显示卡片缺少块问题 -->
							<li class="col-md-5 col-sm-4 col-xs-3">
							<div class="stui-vodlist__box">
								<a class="stui-vodlist__thumb lazyload" href="/wapdetail/?517.html" title="兄弟连第一季" data-original="http://puui.qpic.cn/vcover_vt_pic/0/bhy04pna3ewxzv4t1444795169.jpg/0"><span class="play hidden-xs"></span><span class="pic-text text-right">完结</span></a>
								<div class="stui-vodlist__detail">
									<h4 class="title text-overflow"><a href="/wapdetail/?517.html" title="兄弟连第一季">兄弟连第一季</a></h4>
									<p class="text text-overflow text-muted hidden-xs">戴米恩·路易斯,唐尼·沃尔伯格,朗·里维斯顿,马修·塞特尔</p>
								</div>
							</div>
							</li>
						
						</ul>
					</div>
				</div>
			<div class="col-lg-wide-25 hidden-md hidden-sm hidden-xs">
					<div class="stui-pannel_hd">
						<div class="stui-pannel__head clearfix">
							<a class="more text-muted pull-right" href="/search.php?searchtype=5&tid=2&order=hit">更多 <i class="icon iconfont icon-more"></i></a>
							<h3 class="title"><img src="/templets/aikanV1/images/icon_12.png"/>热播榜</h3>
						</div>
					</div>
					<div class="stui-pannel_bd">
						<ul class="stui-vodlist__media active col-pd clearfix">
						
							<li>
							<div class="thumb">
								<a class="m-thumb stui-vodlist__thumb lazyload" href="/wapdetail/?301.html" title="将夜" data-original="http://img5.mtime.cn/mg/2018/10/25/094114.35579526_270X405X4.jpg"><span class="pic-tag pic-tag-h">1</span></a>
							</div>
							<div class="detail detail-side">
								<h4 class="title"><a href="/wapdetail/?301.html"><i class="icon iconfont icon-more text-muted pull-right"></i>将夜</a></h4>
								<p class="font-12">
									<span class="text-muted">类型：</span>大陆剧<span class="text-muted">地区：</span>大陆
								</p>
								<p class="font-12 margin-0">
									<span class="text-muted">主演：</span>陈飞宇,宋伊人,胡军,郑少..
								</p>
							</div>
							</li>
						
						</ul>
						<ul class="stui-vodlist__rank col-pd clearfix">
						
							<li><a href="/wapdetail/?513.html" title="绝命毒师第二季"><span class="text-muted pull-right">完结</span><span class="badge badge-second">2</span>绝命毒师第二季</a></li>
						
							<li><a href="/wapdetail/?308.html" title="你和我的倾城时光"><span class="text-muted pull-right">更新到42集</span><span class="badge badge-third">3</span>你和我的倾城时光</a></li>
						
							<li><a href="/wapdetail/?517.html" title="兄弟连第一季"><span class="text-muted pull-right">完结</span><span class="badge ">4</span>兄弟连第一季</a></li>
						
							<li><a href="/wapdetail/?537.html" title="我的恶魔少爷"><span class="text-muted pull-right">更新到16集</span><span class="badge ">5</span>我的恶魔少爷</a></li>
						
							<li><a href="/wapdetail/?303.html" title="原来你还在这里"><span class="text-muted pull-right">更新到18集</span><span class="badge ">6</span>原来你还在这里</a></li>
						
							<li><a href="/wapdetail/?512.html" title="绝命毒师第一季"><span class="text-muted pull-right">完结</span><span class="badge ">7</span>绝命毒师第一季</a></li>
						
							<li><a href="/wapdetail/?297.html" title="我在大理寺当宠物"><span class="text-muted pull-right">22集全</span><span class="badge ">8</span>我在大理寺当宠物</a></li>
						
							<li><a href="/wapdetail/?304.html" title="风再起时"><span class="text-muted pull-right">更新到32集</span><span class="badge ">9</span>风再起时</a></li>
						
							<li><a href="/wapdetail/?305.html" title="惊蛰"><span class="text-muted pull-right">39集全</span><span class="badge ">10</span>惊蛰</a></li>
						
						</ul>
					</div>
					<div class="stui-pannel_hd">
						<div class="stui-pannel__head clearfix">
							<a class="more text-muted pull-right" href="/search.php?searchtype=5&tid=2">更多 <i class="icon iconfont icon-more"></i></a>
							<h3 class="title"><img src="/templets/aikanV1/images/icon_25.png"/>筛选</h3>
						</div>
					</div>
					<div class="stui-pannel_bd col-pd">
						<ul class="stui-vodlist__screen clearfix">
							<li><a href="/search.php?searchtype=5&tid=2&area=大陆" title="大陆">大陆</a></li>
							<li><a href="/search.php?searchtype=5&tid=2&area=香港" title="香港">香港</a></li>
							<li><a href="/search.php?searchtype=5&tid=2&area=台湾" title="台湾">台湾</a></li>
							<li><a href="/search.php?searchtype=5&tid=2&area=日本" title="日本">日本</a></li>
							<li><a href="/search.php?searchtype=5&tid=2&area=韩国" title="韩国">韩国</a></li>
							<li><a href="/search.php?searchtype=5&tid=2&area=欧美" title="欧美">欧美</a></li>
							<li><a href="/search.php?searchtype=5&tid=2&area=泰国" title="泰国">泰国</a></li>
							<li><a href="/search.php?searchtype=5&tid=2&area=其他" title="其他">其他</a></li>
						</ul>
						<ul class="stui-vodlist__screen top-line-dot clearfix">
							<li><a href="/search.php?searchtype=5&tid=2&year=2018" title="2018">2018</a></li>
							<li><a href="/search.php?searchtype=5&tid=2&year=2017" title="2017">2017</a></li>
							<li><a href="/search.php?searchtype=5&tid=2&year=2016" title="2016">2016</a></li>
							<li><a href="/search.php?searchtype=5&tid=2&year=2015" title="2015">2015</a></li>
							<li><a href="/search.php?searchtype=5&tid=2&year=2014" title="2014">2014</a></li>
							<li><a href="/search.php?searchtype=5&tid=2&year=2013" title="2013">2013</a></li>
							<li><a href="/search.php?searchtype=5&tid=2&year=2012" title="2012">2012</a></li>
							<li><a href="/search.php?searchtype=5&tid=2&year=2011" title="2011">2011</a></li>
							<li><a href="/search.php?searchtype=5&tid=2&year=2010" title="2010">2010</a></li>
							<li><a href="/search.php?searchtype=5&tid=2&year=2009" title="2009">2009</a></li>
							<li><a href="/search.php?searchtype=5&tid=2&year=2008" title="2008">2008</a></li>
							<li><a href="/search.php?searchtype=5&tid=2&year=more" title="更早">更早</a></li>
						</ul>
					</div>
				</div>
			</div>
		</div>
		<!-- 顶级分类序号，自己修改：后台管理-数据-分类管理-最右边的“排序” -->
		<div class="stui-pannel stui-pannel-bg clearfix">
			<div class="stui-pannel-box clearfix">
				<div class="col-lg-wide-75 col-xs-1 padding-0">
					<div class="stui-pannel_hd">
						<div class="stui-pannel__head clearfix">
							<a class="more text-muted pull-right" href="/waplist/?3.html"><font color="#FF0000">更多</font><!-- 这个首页的更多我修改了红色的 --> <i class="icon iconfont icon-more"></i></a>
							<h3 class="title"><img src="/templets/aikanV1/images/icon_3.png"/><a href="/waplist/?3.html">综艺</a></h3>
							<ul class="nav nav-text pull-right hidden-sm hidden-xs">
							
							</ul>
						</div>
					</div>
					<div class="stui-pannel_bd clearfix">
						<ul class="stui-vodlist clearfix">
						<!-- 前面的原版数字是10，我修改了15，修复手机首页显示卡片缺少块问题 -->
							<li class="col-md-5 col-sm-4 col-xs-3">
							<div class="stui-vodlist__box">
								<a class="stui-vodlist__thumb lazyload" href="/wapdetail/?529.html" title="挑战吧！太空第一季" data-original="http://r1.ykimg.com/051600005BC697068B7774115C058FD9"><span class="play hidden-xs"></span><span class="pic-text text-right">20181204期</span></a>
								<div class="stui-vodlist__detail">
									<h4 class="title text-overflow"><a href="/wapdetail/?529.html" title="挑战吧！太空第一季">挑战吧！太空第一季</a></h4>
									<p class="text text-overflow text-muted hidden-xs">王宝强,张雨绮,田亮,吴宣仪</p>
								</div>
							</div>
							</li>
						<!-- 前面的原版数字是10，我修改了15，修复手机首页显示卡片缺少块问题 -->
							<li class="col-md-5 col-sm-4 col-xs-3">
							<div class="stui-vodlist__box">
								<a class="stui-vodlist__thumb lazyload" href="/wapdetail/?532.html" title="新西游记第五季" data-original="/uploads/allimg/181122/12c55aa579ab443c.jpg"><span class="play hidden-xs"></span><span class="pic-text text-right">20181202期</span></a>
								<div class="stui-vodlist__detail">
									<h4 class="title text-overflow"><a href="/wapdetail/?532.html" title="新西游记第五季">新西游记第五季</a></h4>
									<p class="text text-overflow text-muted hidden-xs">姜镐童,李寿根,殷志源,安宰贤</p>
								</div>
							</div>
							</li>
						<!-- 前面的原版数字是10，我修改了15，修复手机首页显示卡片缺少块问题 -->
							<li class="col-md-5 col-sm-4 col-xs-3">
							<div class="stui-vodlist__box">
								<a class="stui-vodlist__thumb lazyload" href="/wapdetail/?522.html" title="少年说第二季" data-original="https://1img.hitv.com/preview/internettv/sp_images/ott/2018/zongyi/326759/20181015171344171-new.jpg_220x308.jpg"><span class="play hidden-xs"></span><span class="pic-text text-right">20181129期</span></a>
								<div class="stui-vodlist__detail">
									<h4 class="title text-overflow"><a href="/wapdetail/?522.html" title="少年说第二季">少年说第二季</a></h4>
									<p class="text text-overflow text-muted hidden-xs">内详</p>
								</div>
							</div>
							</li>
						<!-- 前面的原版数字是10，我修改了15，修复手机首页显示卡片缺少块问题 -->
							<li class="col-md-5 col-sm-4 col-xs-3">
							<div class="stui-vodlist__box">
								<a class="stui-vodlist__thumb lazyload" href="/wapdetail/?521.html" title="我就是演员" data-original="http://i.gtimg.cn/qqlive/images/newcolumn/v1/i/i2ul87.jpg"><span class="play hidden-xs"></span><span class="pic-text text-right">20181201期</span></a>
								<div class="stui-vodlist__detail">
									<h4 class="title text-overflow"><a href="/wapdetail/?521.html" title="我就是演员">我就是演员</a></h4>
									<p class="text text-overflow text-muted hidden-xs">章子怡,徐峥,吴秀波,陈凯歌</p>
								</div>
							</div>
							</li>
						<!-- 前面的原版数字是10，我修改了15，修复手机首页显示卡片缺少块问题 -->
							<li class="col-md-5 col-sm-4 col-xs-3">
							<div class="stui-vodlist__box">
								<a class="stui-vodlist__thumb lazyload" href="/wapdetail/?293.html" title="明星大侦探第四季" data-original="https://puui.qpic.cn/vcolumn_vt_pic/0/z77tt11540534295/0"><span class="play hidden-xs"></span><span class="pic-text text-right">20181123期</span></a>
								<div class="stui-vodlist__detail">
									<h4 class="title text-overflow"><a href="/wapdetail/?293.html" title="明星大侦探第四季">明星大侦探第四季</a></h4>
									<p class="text text-overflow text-muted hidden-xs">何炅,撒贝宁,白敬亭,吴映洁</p>
								</div>
							</div>
							</li>
						<!-- 前面的原版数字是10，我修改了15，修复手机首页显示卡片缺少块问题 -->
							<li class="col-md-5 col-sm-4 col-xs-3">
							<div class="stui-vodlist__box">
								<a class="stui-vodlist__thumb lazyload" href="/wapdetail/?292.html" title="奇葩说第五季" data-original="https://gss1.bdstatic.com/9vo3dSag_xI4khGkpoWK1HF6hhy/baike/w%3D268%3Bg%3D0/sign=0e589473282dd42a5f0906ad3b003c88/dcc451da81cb39db6f8fa64cdd160924ab183059.jpg"><span class="play hidden-xs"></span><span class="pic-text text-right">20181124期</span></a>
								<div class="stui-vodlist__detail">
									<h4 class="title text-overflow"><a href="/wapdetail/?292.html" title="奇葩说第五季">奇葩说第五季</a></h4>
									<p class="text text-overflow text-muted hidden-xs">马东,高晓松,蔡康永,李诞</p>
								</div>
							</div>
							</li>
						<!-- 前面的原版数字是10，我修改了15，修复手机首页显示卡片缺少块问题 -->
							<li class="col-md-5 col-sm-4 col-xs-3">
							<div class="stui-vodlist__box">
								<a class="stui-vodlist__thumb lazyload" href="/wapdetail/?524.html" title="吐槽大会第三季" data-original="http://i.gtimg.cn/qqlive/images/newcolumn/v1/6/6iv334.jpg"><span class="play hidden-xs"></span><span class="pic-text text-right">20181125期</span></a>
								<div class="stui-vodlist__detail">
									<h4 class="title text-overflow"><a href="/wapdetail/?524.html" title="吐槽大会第三季">吐槽大会第三季</a></h4>
									<p class="text text-overflow text-muted hidden-xs">张绍刚,李诞,池子,程璐</p>
								</div>
							</div>
							</li>
						<!-- 前面的原版数字是10，我修改了15，修复手机首页显示卡片缺少块问题 -->
							<li class="col-md-5 col-sm-4 col-xs-3">
							<div class="stui-vodlist__box">
								<a class="stui-vodlist__thumb lazyload" href="/wapdetail/?539.html" title="蒙面唱将猜猜猜第三季" data-original="/uploads/allimg/181126/84a042f7665bd84c.jpg"><span class="play hidden-xs"></span><span class="pic-text text-right">20181125期</span></a>
								<div class="stui-vodlist__detail">
									<h4 class="title text-overflow"><a href="/wapdetail/?539.html" title="蒙面唱将猜猜猜第三季">蒙面唱将猜猜猜第三季</a></h4>
									<p class="text text-overflow text-muted hidden-xs">陶晶莹,巫启贤,大张伟,陈嘉桦</p>
								</div>
							</div>
							</li>
						<!-- 前面的原版数字是10，我修改了15，修复手机首页显示卡片缺少块问题 -->
							<li class="col-md-5 col-sm-4 col-xs-3">
							<div class="stui-vodlist__box">
								<a class="stui-vodlist__thumb lazyload" href="/wapdetail/?501.html" title="RunningMan(2018)" data-original="http://zy.000td.com//Uploads/vod/2018-05-13/5af84eebe8fe9.jpg"><span class="play hidden-xs"></span><span class="pic-text text-right">20181125期</span></a>
								<div class="stui-vodlist__detail">
									<h4 class="title text-overflow"><a href="/wapdetail/?501.html" title="RunningMan(2018)">RunningMan(2018)</a></h4>
									<p class="text text-overflow text-muted hidden-xs"> 刘在石 / 河东勋 / 李光洙 / 金钟国 / 池石镇 </p>
								</div>
							</div>
							</li>
						<!-- 前面的原版数字是10，我修改了15，修复手机首页显示卡片缺少块问题 -->
							<li class="col-md-5 col-sm-4 col-xs-3">
							<div class="stui-vodlist__box">
								<a class="stui-vodlist__thumb lazyload" href="/wapdetail/?535.html" title="火箭少女101研究所" data-original="/uploads/allimg/181123/462772901da033c5.jpg"><span class="play hidden-xs"></span><span class="pic-text text-right">20181122期</span></a>
								<div class="stui-vodlist__detail">
									<h4 class="title text-overflow"><a href="/wapdetail/?535.html" title="火箭少女101研究所">火箭少女101研究所</a></h4>
									<p class="text text-overflow text-muted hidden-xs">孟美岐,吴宣仪,杨超越,段奥娟</p>
								</div>
							</div>
							</li>
						<!-- 前面的原版数字是10，我修改了15，修复手机首页显示卡片缺少块问题 -->
							<li class="col-md-5 col-sm-4 col-xs-3">
							<div class="stui-vodlist__box">
								<a class="stui-vodlist__thumb lazyload" href="/wapdetail/?527.html" title="火星情报局第四季" data-original="/uploads/allimg/181122/8bd378033b79809f.jpg"><span class="play hidden-xs"></span><span class="pic-text text-right">20181123期</span></a>
								<div class="stui-vodlist__detail">
									<h4 class="title text-overflow"><a href="/wapdetail/?527.html" title="火星情报局第四季">火星情报局第四季</a></h4>
									<p class="text text-overflow text-muted hidden-xs">汪涵,李希侃,娄滋博,李诞</p>
								</div>
							</div>
							</li>
						<!-- 前面的原版数字是10，我修改了15，修复手机首页显示卡片缺少块问题 -->
							<li class="col-md-5 col-sm-4 col-xs-3">
							<div class="stui-vodlist__box">
								<a class="stui-vodlist__thumb lazyload" href="/wapdetail/?484.html" title="超新星全运会" data-original="https://puui.qpic.cn/vcolumn_vt_pic/0/e7m2o61540257358/0"><span class="play hidden-xs"></span><span class="pic-text text-right">20181122期</span></a>
								<div class="stui-vodlist__detail">
									<h4 class="title text-overflow"><a href="/wapdetail/?484.html" title="超新星全运会">超新星全运会</a></h4>
									<p class="text text-overflow text-muted hidden-xs">孟美岐,吴宣仪,杨超越,段奥娟</p>
								</div>
							</div>
							</li>
						<!-- 前面的原版数字是10，我修改了15，修复手机首页显示卡片缺少块问题 -->
							<li class="col-md-5 col-sm-4 col-xs-3">
							<div class="stui-vodlist__box">
								<a class="stui-vodlist__thumb lazyload" href="/wapdetail/?526.html" title="这！就是灌篮第一季" data-original="/uploads/allimg/181122/5ec8113c6bc5458a.jpg"><span class="play hidden-xs"></span><span class="pic-text text-right">20181121期</span></a>
								<div class="stui-vodlist__detail">
									<h4 class="title text-overflow"><a href="/wapdetail/?526.html" title="这！就是灌篮第一季">这！就是灌篮第一季</a></h4>
									<p class="text text-overflow text-muted hidden-xs">周杰伦,李易峰,林书豪,郭艾伦</p>
								</div>
							</div>
							</li>
						<!-- 前面的原版数字是10，我修改了15，修复手机首页显示卡片缺少块问题 -->
							<li class="col-md-5 col-sm-4 col-xs-3">
							<div class="stui-vodlist__box">
								<a class="stui-vodlist__thumb lazyload" href="/wapdetail/?291.html" title="妻子的浪漫旅行" data-original="https://puui.qpic.cn/vcolumn_vt_pic/0/kpp7q71536105988/0"><span class="play hidden-xs"></span><span class="pic-text text-right">20181121期</span></a>
								<div class="stui-vodlist__detail">
									<h4 class="title text-overflow"><a href="/wapdetail/?291.html" title="妻子的浪漫旅行">妻子的浪漫旅行</a></h4>
									<p class="text text-overflow text-muted hidden-xs">张杰,谢娜,应采儿,陈小春</p>
								</div>
							</div>
							</li>
						<!-- 前面的原版数字是10，我修改了15，修复手机首页显示卡片缺少块问题 -->
							<li class="col-md-5 col-sm-4 col-xs-3">
							<div class="stui-vodlist__box">
								<a class="stui-vodlist__thumb lazyload" href="/wapdetail/?294.html" title="Hi室友" data-original="https://puui.qpic.cn/vcolumn_vt_pic/0/zpj8lq1538016255/0"><span class="play hidden-xs"></span><span class="pic-text text-right">20181114期</span></a>
								<div class="stui-vodlist__detail">
									<h4 class="title text-overflow"><a href="/wapdetail/?294.html" title="Hi室友">Hi室友</a></h4>
									<p class="text text-overflow text-muted hidden-xs">金星,陈立农,周洁琼,王彦霖</p>
								</div>
							</div>
							</li>
						
						</ul>
					</div>
				</div>
			<div class="col-lg-wide-25 hidden-md hidden-sm hidden-xs">
					<div class="stui-pannel_hd">
						<div class="stui-pannel__head clearfix">
							<a class="more text-muted pull-right" href="/search.php?searchtype=5&tid=3&order=hit">更多 <i class="icon iconfont icon-more"></i></a>
							<h3 class="title"><img src="/templets/aikanV1/images/icon_12.png"/>热播榜</h3>
						</div>
					</div>
					<div class="stui-pannel_bd">
						<ul class="stui-vodlist__media active col-pd clearfix">
						
							<li>
							<div class="thumb">
								<a class="m-thumb stui-vodlist__thumb lazyload" href="/wapdetail/?484.html" title="超新星全运会" data-original="https://puui.qpic.cn/vcolumn_vt_pic/0/e7m2o61540257358/0"><span class="pic-tag pic-tag-h">1</span></a>
							</div>
							<div class="detail detail-side">
								<h4 class="title"><a href="/wapdetail/?484.html"><i class="icon iconfont icon-more text-muted pull-right"></i>超新星全运会</a></h4>
								<p class="font-12">
									<span class="text-muted">类型：</span>综艺<span class="text-muted">地区：</span>大陆
								</p>
								<p class="font-12 margin-0">
									<span class="text-muted">主演：</span>孟美岐,吴宣仪,杨超越,段..
								</p>
							</div>
							</li>
						
						</ul>
						<ul class="stui-vodlist__rank col-pd clearfix">
						
							<li><a href="/wapdetail/?292.html" title="奇葩说第五季"><span class="text-muted pull-right">20181124期</span><span class="badge badge-second">2</span>奇葩说第五季</a></li>
						
							<li><a href="/wapdetail/?291.html" title="妻子的浪漫旅行"><span class="text-muted pull-right">20181121期</span><span class="badge badge-third">3</span>妻子的浪漫旅行</a></li>
						
							<li><a href="/wapdetail/?522.html" title="少年说第二季"><span class="text-muted pull-right">20181129期</span><span class="badge ">4</span>少年说第二季</a></li>
						
							<li><a href="/wapdetail/?293.html" title="明星大侦探第四季"><span class="text-muted pull-right">20181123期</span><span class="badge ">5</span>明星大侦探第四季</a></li>
						
							<li><a href="/wapdetail/?294.html" title="Hi室友"><span class="text-muted pull-right">20181114期</span><span class="badge ">6</span>Hi室友</a></li>
						
							<li><a href="/wapdetail/?501.html" title="RunningMan(2018)"><span class="text-muted pull-right">20181125期</span><span class="badge ">7</span>RunningM..</a></li>
						
							<li><a href="/wapdetail/?524.html" title="吐槽大会第三季"><span class="text-muted pull-right">20181125期</span><span class="badge ">8</span>吐槽大会第三季</a></li>
						
							<li><a href="/wapdetail/?521.html" title="我就是演员"><span class="text-muted pull-right">20181201期</span><span class="badge ">9</span>我就是演员</a></li>
						
							<li><a href="/wapdetail/?526.html" title="这！就是灌篮第一季"><span class="text-muted pull-right">20181121期</span><span class="badge ">10</span>这！就是灌篮第一..</a></li>
						
						</ul>
					</div>
					<div class="stui-pannel_hd">
						<div class="stui-pannel__head clearfix">
							<a class="more text-muted pull-right" href="/search.php?searchtype=5&tid=3">更多 <i class="icon iconfont icon-more"></i></a>
							<h3 class="title"><img src="/templets/aikanV1/images/icon_25.png"/>筛选</h3>
						</div>
					</div>
					<div class="stui-pannel_bd col-pd">
						<ul class="stui-vodlist__screen clearfix">
							<li><a href="/search.php?searchtype=5&tid=3&area=大陆" title="大陆">大陆</a></li>
							<li><a href="/search.php?searchtype=5&tid=3&area=香港" title="香港">香港</a></li>
							<li><a href="/search.php?searchtype=5&tid=3&area=台湾" title="台湾">台湾</a></li>
							<li><a href="/search.php?searchtype=5&tid=3&area=日本" title="日本">日本</a></li>
							<li><a href="/search.php?searchtype=5&tid=3&area=韩国" title="韩国">韩国</a></li>
							<li><a href="/search.php?searchtype=5&tid=3&area=欧美" title="欧美">欧美</a></li>
							<li><a href="/search.php?searchtype=5&tid=3&area=泰国" title="泰国">泰国</a></li>
							<li><a href="/search.php?searchtype=5&tid=3&area=其他" title="其他">其他</a></li>
						</ul>
						<ul class="stui-vodlist__screen top-line-dot clearfix">
							<li><a href="/search.php?searchtype=5&tid=3&year=2018" title="2018">2018</a></li>
							<li><a href="/search.php?searchtype=5&tid=3&year=2017" title="2017">2017</a></li>
							<li><a href="/search.php?searchtype=5&tid=3&year=2016" title="2016">2016</a></li>
							<li><a href="/search.php?searchtype=5&tid=3&year=2015" title="2015">2015</a></li>
							<li><a href="/search.php?searchtype=5&tid=3&year=2014" title="2014">2014</a></li>
							<li><a href="/search.php?searchtype=5&tid=3&year=2013" title="2013">2013</a></li>
							<li><a href="/search.php?searchtype=5&tid=3&year=2012" title="2012">2012</a></li>
							<li><a href="/search.php?searchtype=5&tid=3&year=2011" title="2011">2011</a></li>
							<li><a href="/search.php?searchtype=5&tid=3&year=2010" title="2010">2010</a></li>
							<li><a href="/search.php?searchtype=5&tid=3&year=2009" title="2009">2009</a></li>
							<li><a href="/search.php?searchtype=5&tid=3&year=2008" title="2008">2008</a></li>
							<li><a href="/search.php?searchtype=5&tid=3&year=more" title="更早">更早</a></li>
						</ul>
					</div>
				</div>
			</div>
		</div>
		<!-- 顶级分类序号，自己修改：后台管理-数据-分类管理-最右边的“排序” -->
		<div class="stui-pannel stui-pannel-bg clearfix">
			<div class="stui-pannel-box clearfix">
				<div class="col-lg-wide-75 col-xs-1 padding-0">
					<div class="stui-pannel_hd">
						<div class="stui-pannel__head clearfix">
							<a class="more text-muted pull-right" href="/waplist/?4.html"><font color="#FF0000">更多</font><!-- 这个首页的更多我修改了红色的 --> <i class="icon iconfont icon-more"></i></a>
							<h3 class="title"><img src="/templets/aikanV1/images/icon_4.png"/><a href="/waplist/?4.html">动漫</a></h3>
							<ul class="nav nav-text pull-right hidden-sm hidden-xs">
							
							</ul>
						</div>
					</div>
					<div class="stui-pannel_bd clearfix">
						<ul class="stui-vodlist clearfix">
						<!-- 前面的原版数字是10，我修改了15，修复手机首页显示卡片缺少块问题 -->
							<li class="col-md-5 col-sm-4 col-xs-3">
							<div class="stui-vodlist__box">
								<a class="stui-vodlist__thumb lazyload" href="/wapdetail/?544.html" title="东京食尸鬼第四季" data-original="http://news.youth.cn/sh/201506/W020150611345849759994.jpg"><span class="play hidden-xs"></span><span class="pic-text text-right">更新到09集</span></a>
								<div class="stui-vodlist__detail">
									<h4 class="title text-overflow"><a href="/wapdetail/?544.html" title="东京食尸鬼第四季">东京食尸鬼第四季</a></h4>
									<p class="text text-overflow text-muted hidden-xs">花江夏树,石川界人,藤原夏海,佐仓绫音</p>
								</div>
							</div>
							</li>
						<!-- 前面的原版数字是10，我修改了15，修复手机首页显示卡片缺少块问题 -->
							<li class="col-md-5 col-sm-4 col-xs-3">
							<div class="stui-vodlist__box">
								<a class="stui-vodlist__thumb lazyload" href="/wapdetail/?486.html" title="妖神记之影妖篇" data-original="http://puui.qpic.cn/vcover_vt_pic/0/psigi8ihauekx1d1537514156/260"><span class="play hidden-xs"></span><span class="pic-text text-right">更新到23集</span></a>
								<div class="stui-vodlist__detail">
									<h4 class="title text-overflow"><a href="/wapdetail/?486.html" title="妖神记之影妖篇">妖神记之影妖篇</a></h4>
									<p class="text text-overflow text-muted hidden-xs">内详</p>
								</div>
							</div>
							</li>
						<!-- 前面的原版数字是10，我修改了15，修复手机首页显示卡片缺少块问题 -->
							<li class="col-md-5 col-sm-4 col-xs-3">
							<div class="stui-vodlist__box">
								<a class="stui-vodlist__thumb lazyload" href="/wapdetail/?538.html" title="火影忍者-博人传-次世代继承者" data-original="/uploads/allimg/181126/d9f657aaca7cb097.jpg"><span class="play hidden-xs"></span><span class="pic-text text-right">更新到84集</span></a>
								<div class="stui-vodlist__detail">
									<h4 class="title text-overflow"><a href="/wapdetail/?538.html" title="火影忍者-博人传-次世代继承者">火影忍者-博人传-次世代继承者</a></h4>
									<p class="text text-overflow text-muted hidden-xs">三瓶由布子,菊池心,木岛隆一,小野贤章,阿部敦,早见沙织</p>
								</div>
							</div>
							</li>
						<!-- 前面的原版数字是10，我修改了15，修复手机首页显示卡片缺少块问题 -->
							<li class="col-md-5 col-sm-4 col-xs-3">
							<div class="stui-vodlist__box">
								<a class="stui-vodlist__thumb lazyload" href="/wapdetail/?500.html" title="刀剑神域3" data-original="https://gss3.bdstatic.com/-Po3dSag_xI4khGkpoWK1HF6hhy/baike/w%3D268%3Bg%3D0/sign=68de515baa1ea8d38a227302af315773/42166d224f4a20a41d07da279c529822720ed031.jpg"><span class="play hidden-xs"></span><span class="pic-text text-right">更新到09集</span></a>
								<div class="stui-vodlist__detail">
									<h4 class="title text-overflow"><a href="/wapdetail/?500.html" title="刀剑神域3">刀剑神域3</a></h4>
									<p class="text text-overflow text-muted hidden-xs">松冈祯丞,茅野爱衣,岛崎信长,户松遥</p>
								</div>
							</div>
							</li>
						<!-- 前面的原版数字是10，我修改了15，修复手机首页显示卡片缺少块问题 -->
							<li class="col-md-5 col-sm-4 col-xs-3">
							<div class="stui-vodlist__box">
								<a class="stui-vodlist__thumb lazyload" href="/wapdetail/?499.html" title="哥布林杀手" data-original="http://puui.qpic.cn/vcover_vt_pic/0/5yxjpv8397ngrhc1532404504/260"><span class="play hidden-xs"></span><span class="pic-text text-right">更新到09集</span></a>
								<div class="stui-vodlist__detail">
									<h4 class="title text-overflow"><a href="/wapdetail/?499.html" title="哥布林杀手">哥布林杀手</a></h4>
									<p class="text text-overflow text-muted hidden-xs">梅原裕一郎,小仓唯,井口裕香,内田真礼</p>
								</div>
							</div>
							</li>
						<!-- 前面的原版数字是10，我修改了15，修复手机首页显示卡片缺少块问题 -->
							<li class="col-md-5 col-sm-4 col-xs-3">
							<div class="stui-vodlist__box">
								<a class="stui-vodlist__thumb lazyload" href="/wapdetail/?496.html" title="妖精的尾巴 最终季" data-original="http://puui.qpic.cn/vcover_vt_pic/0/wwpst03t5lmd3m41537410756/0"><span class="play hidden-xs"></span><span class="pic-text text-right">更新到09集</span></a>
								<div class="stui-vodlist__detail">
									<h4 class="title text-overflow"><a href="/wapdetail/?496.html" title="妖精的尾巴 最终季">妖精的尾巴 最终季</a></h4>
									<p class="text text-overflow text-muted hidden-xs">柿原彻也,平野绫,钉宫理惠,中村悠一</p>
								</div>
							</div>
							</li>
						<!-- 前面的原版数字是10，我修改了15，修复手机首页显示卡片缺少块问题 -->
							<li class="col-md-5 col-sm-4 col-xs-3">
							<div class="stui-vodlist__box">
								<a class="stui-vodlist__thumb lazyload" href="/wapdetail/?542.html" title="天空与海洋之间" data-original="/uploads/allimg/181126/73b06512fdefbf91.jpg"><span class="play hidden-xs"></span><span class="pic-text text-right">更新到09集</span></a>
								<div class="stui-vodlist__detail">
									<h4 class="title text-overflow"><a href="/wapdetail/?542.html" title="天空与海洋之间">天空与海洋之间</a></h4>
									<p class="text text-overflow text-muted hidden-xs">高桥花林,立花理香,井上穗乃花,铃木桃子</p>
								</div>
							</div>
							</li>
						<!-- 前面的原版数字是10，我修改了15，修复手机首页显示卡片缺少块问题 -->
							<li class="col-md-5 col-sm-4 col-xs-3">
							<div class="stui-vodlist__box">
								<a class="stui-vodlist__thumb lazyload" href="/wapdetail/?531.html" title="苍天之拳REGENESIS第二季" data-original="http://www.dilidili.wang/uploads/allimg/180314/290_1536274551.jpg"><span class="play hidden-xs"></span><span class="pic-text text-right">更新到09集</span></a>
								<div class="stui-vodlist__detail">
									<h4 class="title text-overflow"><a href="/wapdetail/?531.html" title="苍天之拳REGENESIS第二季">苍天之拳REGENESIS第二季</a></h4>
									<p class="text text-overflow text-muted hidden-xs">山寺宏一,上坂堇,子安武人,佐藤节次</p>
								</div>
							</div>
							</li>
						<!-- 前面的原版数字是10，我修改了15，修复手机首页显示卡片缺少块问题 -->
							<li class="col-md-5 col-sm-4 col-xs-3">
							<div class="stui-vodlist__box">
								<a class="stui-vodlist__thumb lazyload" href="/wapdetail/?488.html" title="星辰变" data-original="http://puui.qpic.cn/vcover_vt_pic/0/0s8n49g3g1rv1oz1529090002/260"><span class="play hidden-xs"></span><span class="pic-text text-right">更新到09集</span></a>
								<div class="stui-vodlist__detail">
									<h4 class="title text-overflow"><a href="/wapdetail/?488.html" title="星辰变">星辰变</a></h4>
									<p class="text text-overflow text-muted hidden-xs">内详</p>
								</div>
							</div>
							</li>
						<!-- 前面的原版数字是10，我修改了15，修复手机首页显示卡片缺少块问题 -->
							<li class="col-md-5 col-sm-4 col-xs-3">
							<div class="stui-vodlist__box">
								<a class="stui-vodlist__thumb lazyload" href="/wapdetail/?487.html" title="剑网3·侠肝义胆沈剑心" data-original="https://gss0.bdstatic.com/-4o3dSag_xI4khGkpoWK1HF6hhy/baike/w%3D268%3Bg%3D0/sign=2161ab7477899e51788e3d127a9cbe0e/902397dda144ad344d19ff0edca20cf430ad8590.jpg"><span class="play hidden-xs"></span><span class="pic-text text-right">更新到11集</span></a>
								<div class="stui-vodlist__detail">
									<h4 class="title text-overflow"><a href="/wapdetail/?487.html" title="剑网3·侠肝义胆沈剑心">剑网3·侠肝义胆沈剑心</a></h4>
									<p class="text text-overflow text-muted hidden-xs">宝木中阳,藤新,图特哈蒙,黎筱濛</p>
								</div>
							</div>
							</li>
						<!-- 前面的原版数字是10，我修改了15，修复手机首页显示卡片缺少块问题 -->
							<li class="col-md-5 col-sm-4 col-xs-3">
							<div class="stui-vodlist__box">
								<a class="stui-vodlist__thumb lazyload" href="/wapdetail/?489.html" title="魔法禁书目录3" data-original="http://puui.qpic.cn/vcover_vt_pic/0/u3r3qhz2icswkw11537951448/260"><span class="play hidden-xs"></span><span class="pic-text text-right">更新到08集</span></a>
								<div class="stui-vodlist__detail">
									<h4 class="title text-overflow"><a href="/wapdetail/?489.html" title="魔法禁书目录3">魔法禁书目录3</a></h4>
									<p class="text text-overflow text-muted hidden-xs">阿部敦,井口裕香,佐藤利奈,冈本信彦</p>
								</div>
							</div>
							</li>
						<!-- 前面的原版数字是10，我修改了15，修复手机首页显示卡片缺少块问题 -->
							<li class="col-md-5 col-sm-4 col-xs-3">
							<div class="stui-vodlist__box">
								<a class="stui-vodlist__thumb lazyload" href="/wapdetail/?485.html" title="全职法师第三季" data-original="http://puui.qpic.cn/vcover_vt_pic/0/8vdu7i5hr7anq5q1535824602/0"><span class="play hidden-xs"></span><span class="pic-text text-right">更新到08集</span></a>
								<div class="stui-vodlist__detail">
									<h4 class="title text-overflow"><a href="/wapdetail/?485.html" title="全职法师第三季">全职法师第三季</a></h4>
									<p class="text text-overflow text-muted hidden-xs">内详</p>
								</div>
							</div>
							</li>
						<!-- 前面的原版数字是10，我修改了15，修复手机首页显示卡片缺少块问题 -->
							<li class="col-md-5 col-sm-4 col-xs-3">
							<div class="stui-vodlist__box">
								<a class="stui-vodlist__thumb lazyload" href="/wapdetail/?492.html" title="名侦探柯南" data-original="http://img31.mtime.cn/mt/2014/02/23/045110.70221116_270X405X4.jpg"><span class="play hidden-xs"></span><span class="pic-text text-right">更新至第934集</span></a>
								<div class="stui-vodlist__detail">
									<h4 class="title text-overflow"><a href="/wapdetail/?492.html" title="名侦探柯南">名侦探柯南</a></h4>
									<p class="text text-overflow text-muted hidden-xs">内详</p>
								</div>
							</div>
							</li>
						<!-- 前面的原版数字是10，我修改了15，修复手机首页显示卡片缺少块问题 -->
							<li class="col-md-5 col-sm-4 col-xs-3">
							<div class="stui-vodlist__box">
								<a class="stui-vodlist__thumb lazyload" href="/wapdetail/?493.html" title="海贼王" data-original="http://puui.qpic.cn/vcover_vt_pic/0/sdp001pd7uh6khh1542172185/260"><span class="play hidden-xs"></span><span class="pic-text text-right">更新至863集</span></a>
								<div class="stui-vodlist__detail">
									<h4 class="title text-overflow"><a href="/wapdetail/?493.html" title="海贼王">海贼王</a></h4>
									<p class="text text-overflow text-muted hidden-xs"> 田中真弓 / 冈村明美 / 中井和哉 / 平田广明 / 山口胜平</p>
								</div>
							</div>
							</li>
						<!-- 前面的原版数字是10，我修改了15，修复手机首页显示卡片缺少块问题 -->
							<li class="col-md-5 col-sm-4 col-xs-3">
							<div class="stui-vodlist__box">
								<a class="stui-vodlist__thumb lazyload" href="/wapdetail/?536.html" title="山河社稷图" data-original="/uploads/allimg/181123/20721383d7639129.jpg"><span class="play hidden-xs"></span><span class="pic-text text-right">更新到05集</span></a>
								<div class="stui-vodlist__detail">
									<h4 class="title text-overflow"><a href="/wapdetail/?536.html" title="山河社稷图">山河社稷图</a></h4>
									<p class="text text-overflow text-muted hidden-xs">内详</p>
								</div>
							</div>
							</li>
						
						</ul>
					</div>
				</div>
			<div class="col-lg-wide-25 hidden-md hidden-sm hidden-xs">
					<div class="stui-pannel_hd">
						<div class="stui-pannel__head clearfix">
							<a class="more text-muted pull-right" href="/search.php?searchtype=5&tid=4&order=hit">更多 <i class="icon iconfont icon-more"></i></a>
							<h3 class="title"><img src="/templets/aikanV1/images/icon_12.png"/>热播榜</h3>
						</div>
					</div>
					<div class="stui-pannel_bd">
						<ul class="stui-vodlist__media active col-pd clearfix">
						
							<li>
							<div class="thumb">
								<a class="m-thumb stui-vodlist__thumb lazyload" href="/wapdetail/?485.html" title="全职法师第三季" data-original="http://puui.qpic.cn/vcover_vt_pic/0/8vdu7i5hr7anq5q1535824602/0"><span class="pic-tag pic-tag-h">1</span></a>
							</div>
							<div class="detail detail-side">
								<h4 class="title"><a href="/wapdetail/?485.html"><i class="icon iconfont icon-more text-muted pull-right"></i>全职法师第三季</a></h4>
								<p class="font-12">
									<span class="text-muted">类型：</span>动漫<span class="text-muted">地区：</span>大陆
								</p>
								<p class="font-12 margin-0">
									<span class="text-muted">主演：</span>内详
								</p>
							</div>
							</li>
						
						</ul>
						<ul class="stui-vodlist__rank col-pd clearfix">
						
							<li><a href="/wapdetail/?482.html" title="超人总动员2"><span class="text-muted pull-right">BD1280高清中英双字版</span><span class="badge badge-second">2</span>超人总动员2</a></li>
						
							<li><a href="/wapdetail/?492.html" title="名侦探柯南"><span class="text-muted pull-right">更新至第934集</span><span class="badge badge-third">3</span>名侦探柯南</a></li>
						
							<li><a href="/wapdetail/?499.html" title="哥布林杀手"><span class="text-muted pull-right">更新到09集</span><span class="badge ">4</span>哥布林杀手</a></li>
						
							<li><a href="/wapdetail/?538.html" title="火影忍者-博人传-次世代继承者"><span class="text-muted pull-right">更新到84集</span><span class="badge ">5</span>火影忍者-博人传..</a></li>
						
							<li><a href="/wapdetail/?486.html" title="妖神记之影妖篇"><span class="text-muted pull-right">更新到23集</span><span class="badge ">6</span>妖神记之影妖篇</a></li>
						
							<li><a href="/wapdetail/?487.html" title="剑网3·侠肝义胆沈剑心"><span class="text-muted pull-right">更新到11集</span><span class="badge ">7</span>剑网3·侠肝义胆..</a></li>
						
							<li><a href="/wapdetail/?488.html" title="星辰变"><span class="text-muted pull-right">更新到09集</span><span class="badge ">8</span>星辰变</a></li>
						
							<li><a href="/wapdetail/?489.html" title="魔法禁书目录3"><span class="text-muted pull-right">更新到08集</span><span class="badge ">9</span>魔法禁书目录3</a></li>
						
							<li><a href="/wapdetail/?490.html" title="画江湖之不良人3"><span class="text-muted pull-right">更新到05集</span><span class="badge ">10</span>画江湖之不良人3</a></li>
						
						</ul>
					</div>
					<div class="stui-pannel_hd">
						<div class="stui-pannel__head clearfix">
							<a class="more text-muted pull-right" href="/search.php?searchtype=5&tid=4">更多 <i class="icon iconfont icon-more"></i></a>
							<h3 class="title"><img src="/templets/aikanV1/images/icon_25.png"/>筛选</h3>
						</div>
					</div>
					<div class="stui-pannel_bd col-pd">
						<ul class="stui-vodlist__screen clearfix">
							<li><a href="/search.php?searchtype=5&tid=4&area=大陆" title="大陆">大陆</a></li>
							<li><a href="/search.php?searchtype=5&tid=4&area=香港" title="香港">香港</a></li>
							<li><a href="/search.php?searchtype=5&tid=4&area=台湾" title="台湾">台湾</a></li>
							<li><a href="/search.php?searchtype=5&tid=4&area=日本" title="日本">日本</a></li>
							<li><a href="/search.php?searchtype=5&tid=4&area=韩国" title="韩国">韩国</a></li>
							<li><a href="/search.php?searchtype=5&tid=4&area=欧美" title="欧美">欧美</a></li>
							<li><a href="/search.php?searchtype=5&tid=4&area=泰国" title="泰国">泰国</a></li>
							<li><a href="/search.php?searchtype=5&tid=4&area=其他" title="其他">其他</a></li>
						</ul>
						<ul class="stui-vodlist__screen top-line-dot clearfix">
							<li><a href="/search.php?searchtype=5&tid=4&year=2018" title="2018">2018</a></li>
							<li><a href="/search.php?searchtype=5&tid=4&year=2017" title="2017">2017</a></li>
							<li><a href="/search.php?searchtype=5&tid=4&year=2016" title="2016">2016</a></li>
							<li><a href="/search.php?searchtype=5&tid=4&year=2015" title="2015">2015</a></li>
							<li><a href="/search.php?searchtype=5&tid=4&year=2014" title="2014">2014</a></li>
							<li><a href="/search.php?searchtype=5&tid=4&year=2013" title="2013">2013</a></li>
							<li><a href="/search.php?searchtype=5&tid=4&year=2012" title="2012">2012</a></li>
							<li><a href="/search.php?searchtype=5&tid=4&year=2011" title="2011">2011</a></li>
							<li><a href="/search.php?searchtype=5&tid=4&year=2010" title="2010">2010</a></li>
							<li><a href="/search.php?searchtype=5&tid=4&year=2009" title="2009">2009</a></li>
							<li><a href="/search.php?searchtype=5&tid=4&year=2008" title="2008">2008</a></li>
							<li><a href="/search.php?searchtype=5&tid=4&year=more" title="更早">更早</a></li>
						</ul>
					</div>
				</div>
			</div>
		</div>
		
		<!-- 分类列表 -->
		<div class="stui-pannel stui-pannel-bg hidden-sm hidden-xs clearfix">
			<div class="stui-pannel-box">
				<div class="stui-pannel_hd">
					<div class="stui-pannel__head clearfix">
						<h3 class="title"><img src="/templets/aikanV1/images/icon_26.png"/>友情链接</h3>
					</div>
				</div>
				<div class="stui-pannel_bd clearfix">
					<div class="col-xs-1">
						<ul class="stui-link__text clearfix">
						
						</ul>
					</div>
				</div>
			</div>
		</div>
		<!-- 友情链接 -->
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
              视频总数：247
              <span> | </span>
              今天更新：9
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