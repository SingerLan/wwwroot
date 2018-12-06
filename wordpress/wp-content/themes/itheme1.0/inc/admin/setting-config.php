<?php
function loobo_get_option_labels(){
	$option_group               =   'barley_group';
	$option_name = $option_page =   'barley';
	$field_validate				=	'barley_validate';
	$home = home_url();
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
		'profile'=> array(
		'title'=>'首页头像',	
		'type'=>'image',	
		'description'=>'图像为正方形，建议尺寸：300px * 300px'
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
	$jiyan_fields = array(
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
    	'jiyan'		=>array('title'=>'',	    'fields'=>$jiyan_fields,	'callback'=>'',	),
	);

	return compact('option_group','option_name','option_page','sections','field_validate');
}
function loobo_option_defaults(){
	$name = get_bloginfo('name');
	$logoimage =  get_template_directory_uri() . '/static/images/logo.png';
	$faviconimage =  get_template_directory_uri() . '/static/images/favicon.png';
	$weixinimage =  get_template_directory_uri() . '/static/images/weixin.png';
	$profileimage =  get_template_directory_uri() . '/static/images/index.jpg';
	$defaults = array(
			'description'	    =>	'itheme博客主题',
			'keyword'	        =>	'https://loobo.me',
			'page_sign'		    =>	'_',
			'favicon'		    =>	$faviconimage,
			'logo'		    	=>	$logoimage,
			'profile'			=>	$profileimage,
			'smtp-name'         =>	'主题笔记',
			'smtp-account'      =>	'',
			'smtp-pass'         =>	'',
			'smtp-host'         =>	'smtp.qq.com',
			'social-qq'			=>	'100041385',
			'social-weibo'		=>	'https://weibo.com/5080890941',
			'social-weixin'		=>	$weixinimage,
			'social-github'		=>	''
		);
	return $defaults;
}
?>