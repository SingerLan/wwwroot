<?php
function loobo_get_option_labels(){
	$option_group               =   'barley_group';
	$option_name = $option_page =   'barley';
	$field_validate				=	'barley_validate';
	$style_gird = get_template_directory_uri().'/images/style/style-gird.png';
	$style_list = get_template_directory_uri().'/images/style/style-list.png';
	$home = home_url();
	$version = ZB_VERSION;
    //常规
	$general_fields = array(
		'description'	=> array(
		'title'=>'网站描述',	
		'type'=>'textarea',	
		'description'=>''
		),
		
		'keywords'	    => array(
		    'title'=>'关键词',	
			'type'=>'textarea',	
			'description'=>''
		),
			
		'title_sep'	    => array(
		'title'=>'标题链接符号',	
		'type'=>'select',	
		'description'=>'选择后切勿更改,对SEO不友好',
			'options'=>array(
				'中横线- '=>'-',
			    '下划线_'=>'_'
				)
		)
	);
    //外观
	$skin_fields = array(
		'favicon'	=> array(
		'title'=>'网站Favicon图标',	
	    'type'=>'image',	
		'description'=>''
		),
		'logo'	=> array(
		'title'=>'高清Logo',	
		'type'=>'image',	
		'description'=>'像素大小为264px * 52px'
		),
		'home-style'	=> array(
			'title'=>'首页风格',
			'type'=>'select',
			'description'=>'',
			'options'=>array(
				'网格-4'=>'style-gird-4',
				'网格-2'=>'style-gird-2',
				'列表'=>'style-list'
			)
		)
	);
    //邮箱账户
	$mail_fields = array(
	    'smtp-name'	=> array(
		'title'=>'发信人名称',	
	    'type'=>'text',	
		'description'=>''
		),
		'smtp-account'	=> array(
		'title'=>'邮箱账户',	
	    'type'=>'text',	
		'description'=>''
		),
		'smtp-pass'	=> array(
		'title'=>'密码',	
	    'type'=>'password',	
		'description'=>''
		),
		'smtp-host'	=> array(
		'title'=>'smtp服务器',	
	    'type'=>'text',	
		'description'=>''
		)
	);
	//社交
	$social_fields = array(
		'social-qq'	=> array(
		    'title'=>'qq号码',	
			'type'=>'text',	
			'description'=>''
		),
		'social-weixin'	=> array(
		    'title'=>'微信图片',	
			'type'=>'image',	
			'description'=>'微信添加好友二维码'
		),
		'social-weibo'	=> array(
		    'title'=>'微博主页',	
			'type'=>'text',	
			'description'=>'微博主页地址'
		),
		'social-github'	=> array(
		    'title'=>'GitHub主页',	
			'type'=>'text',	
			'description'=>'GitHub主页地址'
		)
	);
	$other_fields = array(
		'home_cate'	=> array(
		'title'=>'首页分类展示',	
	    'type'=>'checkbox',	
		'description'=>'在首页展示所有分类，Tips:每个分类下至少又三篇文章，否则样式会错位'
		),
		'admin_date'	=> array(
		'title'=>'后台文章筛选',	
	    'type'=>'checkbox',	
		'description'=>'在后台文章列表可使用日期功能搜索文章'
		),
		'related_posts'	=> array(
		'title'=>'猜你喜欢',	
	    'type'=>'checkbox',	
		'description'=>'在文章内容页面是否显示推荐同类型文章'
		),
		'social_widget'	=> array(
		'title'=>'侧栏社交信息',	
	    'type'=>'checkbox',	
		'description'=>'选择是否开启侧栏社交信息'
		),
		'hot_posts'	=> array(
		'title'=>'热门文章数量',	
	    'type'=>'range',	
		'description'=>'设置显示的热门文章数量,默认显示3篇文章'
		),
		'geetest_off'	=> array(
		'title'=>'关闭评论验证',	
	    'type'=>'checkbox',	
		'description'=>'默认开启，如果你不需要在评论出使用极验证功能，可以关闭它'
		),
		'public_key'	=> array(
		    'title'=>'极验public_key',	
			'type'=>'text',	
			'description'=>'免费<a href="http://www.geetest.com/" target="_blank">申请地址</a>'
		),
		'private_key'	=> array(
		    'title'=>'极验private_key',	
			'type'=>'text',	
			'description'=>'免费<a href="http://www.geetest.com/" target="_blank">申请地址</a>'
		)
	);
	
	$sections = array( 
    	'general'	=>array('title'=>'',		'fields'=>$general_fields,	'callback'=>'',	),
    	'skin'		=>array('title'=>'',		'fields'=>$skin_fields,	    'callback'=>'',	),
		'mail'		=>array('title'=>'',		'fields'=>$mail_fields,	    'callback'=>'',	),
    	'social'	=>array('title'=>'',	    'fields'=>$social_fields,	'callback'=>'',	),
    	'other'		=>array('title'=>'',	    'fields'=>$other_fields,	'callback'=>'',	),
	);

	return compact('option_group','option_name','option_page','sections','field_validate');
}
function loobo_option_defaults(){
	$name = get_bloginfo('name');
	$logoimage =  get_template_directory_uri() . '/images/logo.png';
	$faviconimage =  get_template_directory_uri() . '/images/favicon.png';
	$weixinimage =  get_template_directory_uri() . '/images/weixin.png';
	$defaults = array(
			'description'	    =>	'shortcut博客主题',
			'keyword'	        =>	'https://loobo.me',
			'page_sign'		    =>	'_',
			'hot_posts'		    =>	'3',
			'favicon'		    =>	$faviconimage,
			'logo'		    	=>	$logoimage,
			'smtp-name'         =>	'主题笔记',
			'smtp-account'      =>	'',
			'smtp-pass'         =>	'',
			'smtp-host'         =>	'smtp.qq.com',
			'social-qq'			=>	'100041385',
			'social-weibo'		=>	'https://weibo.com/5080890941',
			'social-weixin'		=>	$weixinimage,
			'social-github'		=>	'https://github.com/themenote'
		);
	return $defaults;
}
?>