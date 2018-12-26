<?php

include(WPJAM_BASIC_PLUGIN_DIR.'admin/includes/class-wpjam-topic.php');

add_filter('wpjam_topics_list_table', function(){
	return array(
		'title'		=> '讨论组',
		'plural'	=> 'wpjam_topics',
		'singular' 	=> 'wpjam_topics',
		'fixed'		=> false,
		'ajax'		=> true,
		'search'	=> true,
		'model'		=> 'WPJAM_AdminTopic',
		'style'		=> '
			th.column-username{width:160px;}
			th.column-time{width:80px;}
			th.column-group{width:100px;}
			th.column-last_reply{width:150px;}
			th.column-actions{width:16%;}

			#tr_topic td, #tr_topic_replies td, #tr_topic_reply td{padding-top:0px !important;}
			#tr_topic_reply td{padding-bottom:0px !important;}
			.topic-avatar{ float:left; margin:1em 1em 0 0; }
			.topic-content pre, .reply-content pre{ background: #eaeaea; background: rgba(0,0,0,.07); white-space: pre-wrap; word-wrap: break-word; padding:8px; }
			.topic-content code, .reply-content code{ background: none; }
			.topic-content img{max-width: 640px; }
			.topic-meta{margin: 1em 0 2em; }
			.wrap h1 a, .reply-meta a{text-decoration:none;}
			ul.replies li { padding:1px 1em; margin:1em 0; background: #fff;}
			ul.replies li.alternate{background: #f9f9f9;}
			.reply-meta, .reply-content{margin: 1em 0;}
			.reply-meta .dashicons{width:18px; height:18px; font-size:14px; line-height: 18px;}
			.reply-avatar { float:left; margin:1em 1em 0 0; }
		'	
	);
});