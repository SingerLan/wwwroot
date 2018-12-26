<?php
if(!WPJAM_Verify::verify()){
	wp_redirect(admin_url('admin.php?page=wpjam-basic'));
	exit;		
}

add_filter('wpjam_theme_setting', function(){
	
	$list_sub_fields		= [
		'list_read'			=> '是否显示列表页 文章阅读数量',
		'list_time'			=> '是否显示列表页 文章发布时间',
	];

	$single_sub_fields		= [
		'single_category'	=> '是否显示文章页 分类目录',
		'single_time'		=> '是否显示文章页 发布时间',
		'single_read'		=> '是否显示文章页 阅读数量',
		'single_comment'	=> '是否显示文章页 评论数量',
		'single_share'		=> '是否显示文章页 分享和点赞',
		'xintheme_author'	=> '是否显示文章页 作者模块',
		'xintheme_relevant'	=> '是否显示文章页 相关推荐模块',
		'xintheme_new2'		=> '是否显示文章页 最新文章模块'
	];
	$list_sub_fields		= array_map(function($desc){return ['title'=>'','type'=>'checkbox','description'=>$desc]; }, $list_sub_fields);
	$single_sub_fields		= array_map(function($desc){return ['title'=>'','type'=>'checkbox','description'=>$desc]; }, $single_sub_fields);
	
	$sections	= [ 
		'icon'	=>[
			'title'		=>'网站图标', 
			'fields'	=>[
				'logo'		=> ['title'=>'网站 LOGO',			'type'=>'img',	'item_type'=>'url',	'size'=>'120*40', 'description'=>'尺寸：120x40'],
				'favicon'	=> ['title'=>'网站 Favicon图标',	'type'=>'img',	'item_type'=>'url'],
			]
		],
		'layout'	=>[
			'title'		=>'布局设置', 
			'fields'	=>[
				'slide_region'		=> ['title'=>'首页轮播区域（置顶文章）',	'type'=>'select',	'options'=>['magazine'=>'多篇轮播','silide'=>'单篇轮播（导航栏透明）','silide2'=>'单篇轮播（黑底导航栏）','close'=>'关闭幻灯片']],
				'list_region'		=> ['title'=>'首页列表样式',		'type'=>'select',	'options'=>['list1'=>'小图、标准、特色三种文章形式堆砌显示','list2'=>'第1和7篇文章大图显示','list3'=>'同上，增加侧边栏','list4'=>'经典博客列表']],
				'search_region'		=> ['title'=>'搜索页面列表样式',	'type'=>'select',	'options'=>['list1'=>'小图、标准、特色三种文章形式堆砌显示','list2'=>'第1和7篇文章大图显示','list3'=>'同上，增加侧边栏','list4'=>'经典博客列表']],
				'author_region'		=> ['title'=>'作者页面列表样式',	'type'=>'select',	'options'=>['list1'=>'小图、标准、特色三种文章形式堆砌显示','list2'=>'第1和7篇文章大图显示','list3'=>'同上，增加侧边栏','list4'=>'经典博客列表']],
				'tag_region'		=> ['title'=>'标签页面列表样式',	'type'=>'select',	'options'=>['list1'=>'小图、标准、特色三种文章形式堆砌显示','list2'=>'第1和7篇文章大图显示','list3'=>'同上，增加侧边栏','list4'=>'经典博客列表']],
			]
		],
		'foot_setting'	=>[
			'title'		=>'底部设置', 
			'fields'	=>[
				'foot_tools'		=> ['title'=>'底部小工具',			'type'=>'checkbox',	'description'=>'显示底部小工具（热门标签、热评文章*3篇、最新评论*3条）'],
				'footer_tag_num'	=> ['title'=>'标签显示数量',		'type'=>'text',		'rows'=>4],
				'footer_icp'		=> ['title'=>'网站备案号',			'type'=>'text',		'rows'=>4],
				'foot_menu'			=> ['title'=>'页脚菜单',			'type'=>'checkbox',	'description'=>'菜单请到【后台->外观->菜单】中设置，注意要勾选显示位置，这个选项仅为控制显示与隐藏'],
				'foot_link'			=> ['title'=>'友情链接',			'type'=>'checkbox',	'description'=>'显示首页底部友情链接'],
				'foot_timer'		=> ['title'=>'页面加载时间',			'type'=>'checkbox',	'description'=>'页脚显示当前页面加载时间'],
			],	
		],
		'extend'	=>[
			'title'		=>'扩展选项', 
			'summary'	=>'<p>下面的选项，可以让你选择性显示或关闭一些功能。</p>',
			'fields'	=>[
				'list'		=>['title'=>'文章列表页面',	'type'=>'fieldset',	'fields'=>$list_sub_fields],
				'single'	=>['title'=>'文章详情页面',	'type'=>'fieldset',	'fields'=>$single_sub_fields],
			],	
		],
		'social'	=>[
			'title'		=>'社交工具', 
			'fields'	=>[
				'footer_weixin'		=> ['title'=>'上传微信二维码',	'type'=>'img',		'item_type'=>'url'],
				'footer_qq'			=> ['title'=>'输入QQ号码',		'type'=>'text',		'rows'=>4],
				'footer_weibo'		=> ['title'=>'输入微博链接',		'type'=>'text',		'rows'=>4],
				'footer_mail'		=> ['title'=>'输入邮箱账号',		'type'=>'text',		'rows'=>4],
				'footer_facebook'	=> ['title'=>'输入Facebook链接',	'type'=>'text',		'rows'=>4],
				'footer_twitter'	=> ['title'=>'输入Twitter链接',	'type'=>'text',		'rows'=>4],
				'footer_instagram'	=> ['title'=>'输入Instagram链接',	'type'=>'text',		'rows'=>4],
			],	
		],
		'single-ad'	=>[
			'title'		=>'广告设置', 
			'fields'	=>[
				//'ad_type'		=> ['title'=>'选择广告类型',			'type'=>'select',	'options'=>['img'=>'图片广告','code'=>'广告代码']],
				'ad_tips'			=> ['title'=>'显示广告标识',		'type'=>'checkbox', 'description'=>'广告位置会显示“广告”两个字',],
				'single_ad_pc'		=> ['title'=>'广告代码(电脑端)',	'type'=>'textarea', 'description'=>'广告位于文章页内容底部',	'rows'=>4],
				'single_ad_mobile'	=> ['title'=>'广告代码(手机端)',	'type'=>'textarea', 'description'=>'广告位于文章页内容底部',	'rows'=>4],
			],	
		],
		'optimization'	=>[
			'title'		=>'优化加速', 
			'fields'	=>[
				'xintheme_v2ex'		=> ['title'=>'Gravatar镜像服务',		'type'=>'checkbox',	'description'=>'使用国内的Gravatar镜像服务，提高网站加载速度，https://cdn.v2ex.com/gravatar'],
				'xintheme_copy'		=> ['title'=>'整站禁止复制',			'type'=>'checkbox',	'description'=>'用js onselectstart事件禁止选中文字，有效防止内容被访客复制'],
				'xintheme_up_img'	=> ['title'=>'上传图片使用日期重命名',	'type'=>'checkbox',	'description'=>'上传中文名称的图片文件诸多弊端，建议开启'],
				'xintheme_article'	=> ['title'=>'登陆后台跳转到文章列表',	'type'=>'checkbox',	'description'=>'WordPress登陆后台后默认是显示仪表盘页面，开启这个功能登陆后台默认显示文章列表'],
				'xintheme_feed'		=> ['title'=>'关闭Feed',				'type'=>'checkbox',	'description'=>'Feed易被利用采集，造成不必要的资源消耗，建议关闭'],
			],	
		],
		'color'	=>[
			'title'		=>'主题配色', 
			'fields'	=>[
				'theme_color'		=> ['title'=>'选择主题配色',		'type'=>'select',	'options'=>['blue'=>'蓝色','green'=>'绿色','red'=>'红色']],
			],	
		]
	];
	
	return compact('sections');
});