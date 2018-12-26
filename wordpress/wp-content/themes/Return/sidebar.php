<aside id="secondary" class="col-md-4 sidebar">
<div class="sidebar-wrapper">
	<div id="secondary-affix" class="widget-area affix">
	<?php 
	if (function_exists('dynamic_sidebar') && dynamic_sidebar('widget_right')) : endif; 

	if (is_single()){
		if (function_exists('dynamic_sidebar') && dynamic_sidebar('widget_post')) : endif; 
	}

	else if (is_page()){
		if (function_exists('dynamic_sidebar') && dynamic_sidebar('widget_page')) : endif; 
	}

	else if (is_home()){
		if (function_exists('dynamic_sidebar') && dynamic_sidebar('widget_sidebar')) : endif; 
	}
	else {
		if (function_exists('dynamic_sidebar') && dynamic_sidebar('widget_other')) : endif; 
	}
	?>
	</div>
</div>
</aside>