<?php 

trait Phoen_Checkout_Page_Point_Data{

   	public function phoen_rewpts_check_all_enable_setting_checkout_page(){

		$enable_plugin_checkout_page = isset($this->phoen_rewpts_notification_data['enable_plugin_checkout_page']) ? $this->phoen_rewpts_notification_data['enable_plugin_checkout_page']:'0';
		$enable_apply_point = isset($this->phoen_rewpts_notification_data['apply_box_enable_on_checkout']) ? $this->phoen_rewpts_notification_data['apply_box_enable_on_checkout'] : '';

		if($enable_plugin_checkout_page == '1'):
			add_action( 'woocommerce_before_checkout_form', array($this,'phoen_rewpts_checkout_action_get_reward_points'),10,0);
		endif;
		
		if($enable_apply_point == '1'):
			add_action( 'woocommerce_before_checkout_form', array($this,'phoen_reward_apply_points_checkout_page'));
		endif;
	}

	public function phoen_rewpts_checkout_action_get_reward_points() {
		$this->phoen_rewpts_include_main_function_file();
		include_once(PHOEN_REWPTSPLUGPATH.'public/phoen-reward-frontend/checkout/checkout_notification.php');
	}

	public function phoen_reward_apply_points_checkout_page(){

		if(is_user_logged_in()):
			$this->phoen_rewpts_include_main_function_file();
			include_once(PHOEN_REWPTSPLUGPATH.'public/phoen-reward-frontend/checkout/apply_point_checkout_page.php');
		endif;
		
	}
}
?>