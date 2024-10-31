<?php 

trait Phoen_Single_Product_Page{

	public function phoen_rewpts_show_points_single_product_page(){

		if($this->phoen_rewpts_enable_plugin_product_page() == '1'):
			
			if( $this->phoen_rewpts_showing_point_notification_place() == 'below_add_cart' ) : 
				add_action( 'woocommerce_after_add_to_cart_button', array($this,'phoen_rewpts_show_notification_point_single_product_page' ));
			else:
				add_action( 'woocommerce_before_add_to_cart_button', array($this,'phoen_rewpts_show_notification_point_single_product_page' ));
			endif;

		endif;
	}

	private function phoen_rewpts_enable_plugin_product_page(){
		
		return (!empty($this->phoen_rewpts_notification_data['enable_plugin_product_page'])) ? $this->phoen_rewpts_notification_data['enable_plugin_product_page'] : '0';
	}

	private function phoen_rewpts_showing_point_notification_place(){

		return isset($this->styling_tab_settings['phoen_select_text_product_page']) ? $this->styling_tab_settings['phoen_select_text_product_page'] : '';
	}

	public function phoen_rewpts_show_notification_point_single_product_page() {

		$this->phoen_rewpts_include_main_function_file();

		global $product ,$post;

		$_product = wc_get_product( $post->ID );

		$product_price = $_product->get_price();

		$phoen_reward_point_value = phoen_reward_point_value();

		$reward_value = $phoen_reward_point_value['reward_value'];

		$phoen_rewards_point = round($product_price*$reward_value,2);

		$phoen_rewpts_first_review = phoen_rewpts_first_review_reward_point(get_current_user_id(),$post->ID);
	   	
	   	include_once(PHOEN_REWPTSPLUGPATH.'public/phoen-reward-frontend/single-product/single-product-notification.php');

	}    
}
?>