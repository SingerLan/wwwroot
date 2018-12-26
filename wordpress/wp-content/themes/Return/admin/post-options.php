<?php
add_action('admin_head',function(){
	global $post;

	if(empty($post)){
		return;
	}
	?>

	<style type="text/css">
	#post_layout_options label{
	display:inline-block;
	width:156px;
	height:111px;
	background-repeat:no-repeat;
	background-size: contain;
	margin-right:10px;
	}

	#post_layout_options input{
		display: none;
	}

	<?php for ($i=1; $i<=4; $i++) { ?>

	#label_post_layout_<?php echo $i; ?>{	
	background-image: url(<?php echo get_stylesheet_directory_uri().'/static/images/set/single-'.$i.'.png';?>);
	}

	#post_layout_<?php echo $i; ?>:checked + #label_post_layout_<?php echo $i; ?> {
	border:1px solid #000;
	}

	<?php } ?>
	
	</style>
	<script type="text/javascript">
	jQuery(function($){
		
		$('tr#tr_header_img').hide();
		
		$('body').on('change', '#post_layout_options input', function(){
			$('tr#tr_header_img').hide();

			if ($(this).is(':checked')) {
				if($(this).val() != '1'){
					$('tr#tr_header_img').show();
				}
			} 
		});

		$('select#post_layout').change();
	});
	</script>
	<?php
});



add_filter('wpjam_post_post_options',function ($post_options){
	$post_options['layout-box'] = [
		'title'		=> '布局设置',
		'post_type'	=> 'post',
		'priority'	=> 'high',
		'fields'	=> [
			'post_layout'	=>['title'=>'布局',	'type'=>'radio',	'options'=>['1'=>'','2'=>'','3'=>'','4'=>''],	'show_admin_column'=>true],
			'header_img'	=>['title'=>'头图',	'type'=>'img',		'item_type'=>'url',	'description'=>'上传一张显示在文章顶部的图片'],
		]
	];
	$post_options['abstract-box'] = [
		'title'		=> '摘要设置',
		'post_type'	=> 'post',
		'priority'	=> 'high',
		'fields'	=> [
			'post_abstract'	=>['title'=>'',	'type'=>'textarea',	'description'=>'自定义文章摘要，如留空，则自动调用文章首段文字（只有标准形式的文章才会显示摘要）...'],
			
		]
	];

	return $post_options;
});