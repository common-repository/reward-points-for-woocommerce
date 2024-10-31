<?php 
trait Phoen_Cart_Page {	

	public function phoen_rewpts_show_cart_page_data(){

		$enable_plugin_cart_page = isset($this->phoen_rewpts_notification_data['enable_plugin_cart_page']) ? $this->phoen_rewpts_notification_data['enable_plugin_cart_page'] : '';
		$enable_apply_point = isset($this->phoen_rewpts_notification_data['apply_box_enable_on_cart']) ? $this->phoen_rewpts_notification_data['apply_box_enable_on_cart'] : '';

		if($enable_plugin_cart_page == '1'):

			$phoen_select_text_cart = isset($this->styling_tab_settings['phoen_select_text'])?$this->styling_tab_settings['phoen_select_text']:'';

			($phoen_select_text_cart==='below_cart') ? add_action( 'woocommerce_after_cart_table',array($this,'phoen_rewpts_show_notification_point_cart_page' )) : add_action( 'woocommerce_before_cart_table',array($this,'phoen_rewpts_show_notification_point_cart_page' ));
		endif;

		if($enable_apply_point == '1'):
			add_action( 'woocommerce_before_cart', array($this,'phoen_rewpts_apply_points_cart_page'), 10, 0);
		endif;
	}

	public function phoen_rewpts_show_notification_point_cart_page(){
		$this->phoen_rewpts_include_main_function_file();
	   	include_once(PHOEN_REWPTSPLUGPATH.'public/phoen-reward-frontend/cart/cart_notification.php');
	}

	public function phoen_rewpts_apply_points_cart_page() { 

		if(is_user_logged_in()):
			$this->phoen_rewpts_include_main_function_file();
			ob_start();
		   		include_once(PHOEN_REWPTSPLUGPATH.'public/phoen-reward-frontend/cart/apply_points_cart_page.php');
		   		$content = ob_get_contents();
		   	ob_end_clean();
		   		echo $content;
		endif;
	}
}
?>