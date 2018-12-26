<?php
class WPJAM_AdminTopic  {
	public static function get($id){
		$topic = wpjam_remote_request('http://jam.wpweixin.com/api/get_topic.json?id='.$id);
		if(is_wp_error($topic)){
			return $topic;
		}

		$topic['images']	= maybe_unserialize(wp_unslash($topic['images']));

		return $topic;
	}

	public static function insert($data){
		$response	= self::topic($data);
		if(is_wp_error($response)){
			return $response;
		}else{
			return $response['id'];
		}
	}

	public static function update($id, $data){
		return self::topic($data, $id);
	}

	public static function edit2($id, $data){
		if($data['images']){
			$data['images'] = maybe_serialize($data['images']);
		}

		return WPJAM_Topic::update($id, $data);
	}

	public static function delete($id){
		return WPJAM_Topic::delete($id);
	}

	public static function stick($id){
		return WPJAM_Topic::update($id, ['sticky'=>1]);
	}

	public static function unstick($id){
		return WPJAM_Topic::update($id, ['sticky'=>0]);
	}

	public static function close($id){
		return WPJAM_Topic::update($id, ['status'=>1]);
	}

	public static function unclose($id){
		return WPJAM_Topic::update($id, ['status'=>0]);
	}

	public static function topic($data, $id=0){
		$title		= $data['title'];
		$content	= $data['content'];
		$group		= $data['group'];

		if(empty($title)){
			return new WP_Error('empty_title', '标题不能为空。');
		}

		if(empty($title)){
			return new WP_Error('empty_content', '内容不能为空。');
		}

		if($images = $data['images']){
			$images = maybe_serialize($images);
		}

		return wpjam_remote_request('http://jam.wpweixin.com/api/topic.json', [
			'method'	=> 'POST',
			'body'		=> compact('title','content','group','images','id'),
			'headers'	=> ['openid'=>WPJAM_Verify::get_openid()]
		]);
	}

	public static function reply($topic_id, $data){
		$content	= $data['reply_content'];

		if(empty($content)){
			return new WP_Error('empty_reply_content', '回复内容不能为空。');
		}

		return wpjam_remote_request('http://jam.wpweixin.com/api/reply.json', array(
			'method'	=> 'POST',
			'body'		=> compact('topic_id','content'),
			'headers'	=> ['openid'=>WPJAM_Verify::get_openid()]
		));
	}

	public static function get_groups(){
		return [
			'all'		=> '全部',
			'wpjam'		=> 'WPJAM Basic',
			'weixin'	=> '微信机器人',
			'qiniu'		=> '七牛云存储',
			'xintheme'	=> 'xintheme',
			'share'		=> '资源分享',
			'project'	=> '项目交易',
			'wp'		=> '其他帖子'
		];
	}
	public static function views()
	{
		global $wpjam_list_table;

		$groups	= self::get_groups();
		$group	= $_REQUEST['group'] ?? 'all';

		$views = [];
		foreach ($groups as $key => $value) {
			$class         = ($group == $key) ? 'current' : '';
			$views[$value] = $wpjam_list_table->get_filter_link(['group' => $key], $value, $class);
		}

		return $views;
	}

	public static function list($limit, $offset){

		$view	= $_REQUEST['view'] ?? '';
		$s		= $_REQUEST['s'] ?? '';
		$group	= $_REQUEST['group'] ?? 'all';
		$openid	= $_REQUEST['openid'] ?? '';
		$paged	= $_REQUEST['paged'] ?? 1;
		
		// $orderby	= isset($_REQUEST['orderby'])?$_REQUEST['orderby']:'last_reply_time';
		// $order		= isset($_REQUEST['order'])?$_REQUEST['order']:'DESC';

		// $args		= compact('paged','view','s','group','orderby', 'order');
		$args	= compact('paged','view','s','group');
		$url	= add_query_arg($args, 'http://jam.wpweixin.com/api/get_topics.json');

		$response = wpjam_remote_request($url);

		if(is_wp_error($response)){
			wpjam_admin_add_error($response->get_error_message(),'error');
			$total	= 0;
			$items	= [];
		}else{
			$total	= $response['total'];
			$items	= $response['topics'];
		}

		return compact('items', 'total');
	}

	public static function item_callback($item){
		global $wpjam_list_table, $current_admin_url;

		$groups	= self::get_groups();

		$reply_count		= $item['reply_count']?'（'.$item['reply_count'].'）':'';
		
		$item['title']		= $wpjam_list_table->get_row_action('reply',['id'=>$item['id'],'title'=>$item['title'].$reply_count]);

		if(time()-$item['time'] < 10*MINUTE_IN_SECONDS && (WPJAM_Verify::get_openid() == $item['openid']) ){
			$item['title']	.= '（'.$wpjam_list_table->get_row_action('edit',['id'=>$item['id']]).'）';
		}

		if($item['sticky']){
			$item['title']	= '<span style="color:#0073aa; width:16px; height:16px; font-size:16px; line-height:18px;" class="dashicons dashicons-sticky"></span> '.$item['title'] ;
		}

		$item['username']	= '<img src="'.str_replace('/0', '/46', $item['user']['avatar']).'" alt="'.$item['user']['nickname'].'" width="24" height="24" />'.$item['user']['nickname'];

		$item['time']		= wpjam_human_time_diff($item['time']);
		
		$item['last_reply']	= $item['last_reply_openid']?$item['last_reply_user']['nickname'].' ('.$wpjam_list_table->get_row_action('reply',['id'=>$item['id'],'title'=>wpjam_human_time_diff($item['last_reply_time'])]).'）':'';

		$item['group']		= $item['group']?$wpjam_list_table->get_filter_link(['group' => $item['group']], $groups[$item['group']]):'';

		if(apply_filters('wpjam_topic_remove_row_actions', true)){
			unset($item['row_actions']);
		}else{
			unset($item['row_actions']['edit']);

			if($item['sticky']){
				unset($item['row_actions']['stick']);
			}else{
				unset($item['row_actions']['unstick']);
			}

			if($item['status']){
				unset($item['row_actions']['close']);
			}else{
				unset($item['row_actions']['unclose']);
			}
		}

		return $item;
	}

	public static function get_actions(){
		return [
			'add'		=>['title'=>'发布',		'page_title'=>'发布新帖'],
			'edit'		=>['title'=>'编辑',		'page_title'=>'编辑贴子'],
			'edit2'		=>['title'=>'编辑',		'page_title'=>'编辑贴子'],
			'reply'		=>['title'=>'回复',		'page_title'=>'贴子详情'],
			'stick'		=>['title'=>'置顶',		'page_title'=>'置顶贴子',		'direct'=>true,	'confirm'=>true],
			'close'		=>['title'=>'关闭',		'page_title'=>'关闭贴子',		'direct'=>true,	'confirm'=>true],
			'unstick'	=>['title'=>'取消置顶',	'page_title'=>'取消置顶贴子',	'direct'=>true,	'confirm'=>true],
			'unclose'	=>['title'=>'取消关闭',	'page_title'=>'取消关闭贴子',	'direct'=>true,	'confirm'=>true],
			'delete'	=>['title'=>'删除',		'page_title'=>'删除贴子',		'direct'=>true,	'confirm'=>true],
		];
	}

	public static function get_fields($action_key='', $id=0){
		if($action_key == ''){
			return [
				'title'		=> ['title'=>'帖子',		'type'=>'view',	'show_admin_column'=>true],
				'username'	=> ['title'=>'提问者',	'type'=>'view',	'show_admin_column'=>true],
				'group'		=> ['title'=>'分组',		'type'=>'view',	'show_admin_column'=>true],
				'time'		=> ['title'=>'发布时间',	'type'=>'view',	'show_admin_column'=>true],
				'last_reply'=> ['title'=>'最后回复',	'type'=>'view',	'show_admin_column'=>true],
			];
		}elseif(in_array($action_key, ['add', 'edit', 'edit2'])){
			$groups	= self::get_groups();

			$fields = [
				'group'		=> ['title'=>'分组',	'type'=>'select',	'options'=>$groups],
				'title'		=> ['title'=>'标题',	'type'=>'text'],
				'content'	=> ['title'=>'内容',	'type'=>'textarea',	'rows'=>10,'description'=>'不支持 HTML 标签，代码请放入[code][/code]中。<br />尽量输入相关的地址，否则无法分析和回答你的帖子。'],
				'images'	=> ['title'=>'相关图片',	'type'=>'mu-img',	'item_type'=>'url',	'description'=>'如果文字无法描述你的帖子，请添加截图。'],
			];

			if($action_key == 'edit2'){
				$fields['images']['item_type']	= 'url';
			}

			return $fields;
		}elseif($action_key == 'reply'){
			$groups	= self::get_groups();

			$wpjam_topic = self::get($id);

			if(is_wp_error( $wpjam_topic )){
				wpjam_admin_add_error($wpjam_topic->get_error_message(),'error');
				return [];
			}

			$topic_title	= '<h2>'.convert_smilies($wpjam_topic['title']).'</h2>';

			if($wpjam_topic['modified']){
				$last_reply	= ' - <span class="topic-last_reply">最后编辑于'.wpjam_human_time_diff($wpjam_topic['modified']).'</span>';
			}else{
				$last_reply	= '';
			}

			$topic_avatar	= '<div class="topic-avatar"><img src="'.str_replace('/0', '/132', $wpjam_topic['user']['avatar']) .'" width="60" alt="'.$wpjam_topic['user']['nickname'].'" /></div>';

			$topic_meta		= '<div class="topic-meta">
				<span class="topic-author">'.$wpjam_topic['user']['nickname'].'</span>
				- <span class="topic-time">'. wpjam_human_time_diff($wpjam_topic['time']).'</span>
				'.$last_reply.'
			</div>';

			$topic_content	= wpautop(convert_smilies($wpjam_topic['content']));

			if($wpjam_topic['images'] && ($images = maybe_unserialize(wp_unslash($wpjam_topic['images'])))){
				foreach ($images as $image ) {
					$topic_content	.= '<img srcset="'.$image.' 2x" src="'.$image.'" />'."\n";
				}
			}

			$topic_content	= '<div class="topic-content">
				'.$topic_content.'
			</div>';

			$topic_replies	= '';

			if($wpjam_topic['replies']){
				foreach ($wpjam_topic['replies'] as $wpjam_reply) { $alternate = empty($alternate)?'alternate':'';
				$topic_replies .= '
					<li id="reply-'. $wpjam_reply['id'].'" class="'.$alternate.'">
						<div class="reply-avatar"><img src="'. str_replace('/0', '/132', $wpjam_reply['user']['avatar']).'" width="48" alt="'.$wpjam_reply['user']['nickname'].'" /></div>
						<div class="reply-meta">
							<span class="reply-author">'. $wpjam_reply['user']['nickname'].'</span>
							- <span class="reply-time">'. wpjam_human_time_diff($wpjam_reply['time']).'</span>
						</div>
						<div class="reply-content">
							'.wpautop(convert_smilies($wpjam_reply['content'])).'
						</div>
					</li>
				';
				// （<a class="reply-to" data-reply_id="'. $wpjam_reply['id'].'" href="javascript:;">回复他</a>）
				}

				$topic_replies	= '<h3>'.$wpjam_topic['reply_count'].'条回复'.'</h3><ul class="replies">'.$topic_replies.'</ul>';
			}

			if($wpjam_topic['status']){
				$content_field	= ['title'=>'',	'type'=>'view',	'value'=>'<p>帖子已关闭，不能再留言！</p>'];

			}else{
				$content_field	= ['title'=>'',	'type'=>'textarea',	'rows'=>6,'description'=>'不支持 HTML 标签，代码请放入[code][/code]中。'];
			}

			return [
				'topic'			=> ['title'=>'',	'type'=>'view',		'value'=>$topic_avatar.$topic_title.$topic_meta.$topic_content],
				'topic_replies'	=> ['title'=>'',	'type'=>'view',		'value'=>$topic_replies],
				'topic_reply'	=> ['title'=>'',	'type'=>'view',		'value'=>'<h3>我要回复</h3>'],
				'reply_to'		=> ['title'=>'',	'type'=>'hidden',	'value'=>''],
				'reply_content'	=> $content_field,
				// 'images'		=> ['title'=>'',	'type'=>'mu-img',	'description'=>''],
			];
		}
	}

	public static function list_page(){ ?>
	<script type="text/javascript">
	jQuery(function ($) {
		$('body').on('click','.reply_to',function(){

		});
	});
	</script>
	<?php }
}