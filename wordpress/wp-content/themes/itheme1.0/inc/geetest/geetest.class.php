<?php
class Geetest{
    public $options;
    public $plugin_directory;

    function start_plugin(){
        $this->plugin_directory = basename(dirname(__FILE__));
        $this->register_default_options();
		
        $this->register_actions();
        $this->register_filters();
        $this->register_script();
    }

    function register_actions(){
		//add_action('comment_form', array($this, 'show_geetest_in_comments'),10,1);
    }

    function register_filters(){
		add_filter('preprocess_comment', array($this, 'validate_geetest_comment'), 100, 1);
    }
	function register_script(){
		add_action( 'wp_enqueue_scripts', array($this, 'script_geetest_in_comments') );
    }
    function register_default_options(){
        $option_defaults = array();
		$option_defaults['public_key'] = barley_get_setting('public_key');
		$option_defaults['private_key'] = barley_get_setting('private_key');
		$post_data = array('captchaid' => $option_defaults['public_key'], 'privatekey' => $option_defaults['private_key'], 'token' => md5('discuz' . (string)time()));
		$geetestlib = new geetestlib();
		$result_pc = $geetestlib->send_post("http://account.geetest.com/api/discuz/get", $post_data);
		$result = json_decode($result_pc, true);
		$option_defaults['register'] = $result['register'];

		$option_defaults['show_in_comments'] = "1";
		$option_defaults['lang_options'] = "0";

		add_option("geetest_options", $option_defaults);
        $this->options = $option_defaults;
    }
	function show_geetest_in_comments(){
        echo '<div id="gt_reply"></div>';
	}
    
    function script_geetest_in_comments(){
		if(is_singular()){
        wp_enqueue_script('gt', get_template_directory_uri() . '/inc/geetest/assets/gt.js');
        $geetestlib = new geetestlib();

        $output = $geetestlib->get_widget('f9771d116bbf7c89fe6245315e6c22e2', $this->options['register'], 'c42881b00852a86d586999c29e7f5655', "gt_reply", 'zh-cn');

        $js = '';
        $inline = $output . $js;

        wp_add_inline_script('gt', $inline);
		}
    }
    function validate_geetest_comment($comment_data){
		
        if ($comment_data['user_ID'] != '1') {
            $challenge = $_POST['geetest_challenge'];
            $validate = $_POST['geetest_validate'];
            $seccode = $_POST['geetest_seccode'];
            $geetestlib = new geetestlib();
            if ($_SESSION['gtserver'] == 1) {
                $geetest_response = $geetestlib->geetest_check_answer($this->options['private_key'], $challenge, $validate, $seccode);
                if ($geetest_response) {
                    return $comment_data;
                } else {
                    wp_die("<strong>错误</strong>:滑动验证未通过");
                }
            } else if ($_SESSION['gtserver'] == 0) {
                if ($geetestlib->get_answer($validate)) {
                    return $comment_data;
                } else {
                    wp_die("<strong>错误</strong>:滑动验证未通过");
                }
            }


        }
        return $comment_data;
    }
    function is_comment_approved($approved, $commentdata){
        $approved = 0;
        return $approved;
    }
}