<?php 
trait Phoen_Rewpts_Customer_Point{

	public function phoen_rewpts_showing_point_Infrontend(){
		$this->phoen_rewpts_enable_customer_points();
	}

	private function phoen_rewpts_enable_customer_points(){

		if($this->gen_settings['enable_plugin_myaccount'] == '1'):

			add_action( 'init', array($this, 'phoen_rewpts_my_account_endpoints_reward_point' ));
			add_filter( 'query_vars', array($this, 'phoen_rewpts_my_account_query_vars_reward_point'), 0 );
			add_action( 'woocommerce_account_reward-point_endpoint', array($this, 'phoen_rewpts_my_accountendpoint_content' ));
			add_filter( 'woocommerce_account_menu_items',array($this, 'phoen_rewpts_my_account_menu_items_with_reward_point' ));
		
		else:
			
			add_filter( 'woocommerce_account_menu_items',array($this, 'phoen_rewpts_my_account_menu_items_without_reward_point' ));
		endif;

		add_action( 'wp_loaded', array($this, 'phoen_rewpts_flush_rewrite_rules' ));
	

	}

	public function phoen_rewpts_my_account_endpoints_reward_point() {
		add_rewrite_endpoint( 'reward-point', EP_ROOT | EP_PAGES );	
	}

	public function phoen_rewpts_my_account_query_vars_reward_point( $vars ) {
		$vars[] = 'reward-point';
		return $vars;
	}

	public function phoen_rewpts_flush_rewrite_rules() {
		flush_rewrite_rules();
	}

	public function phoen_rewpts_my_accountendpoint_content() {
		
		ob_start();
	   		include_once(PHOEN_REWPTSPLUGPATH.'public/phoen-reward-frontend/my-account/reward.php');
	   		$content = ob_get_contents();
	   	ob_end_clean();
	   		echo $content;
	}
	public function phoen_rewpts_my_account_menu_items_without_reward_point($items){

		$items = array(
			'dashboard'         => __( 'Dashboard', 'woocommerce' ),
			'orders'            => __( 'Orders', 'woocommerce' ),
			'downloads'       	=> __( 'Downloads', 'woocommerce' ),
			'edit-address'    	=> __( 'Addresses', 'woocommerce' ),
			'payment-methods' 	=> __( 'Payment Methods', 'woocommerce' ),
			'edit-account'      => __( 'Edit Account', 'woocommerce' ),
			'customer-logout'   => __( 'Logout', 'woocommerce' ),
		);
	
		return $items;
	}

	public function phoen_rewpts_my_account_menu_items_with_reward_point( $items ) {
			
		$items = array(
			'dashboard'         => __( 'Dashboard', 'woocommerce' ),
			'orders'            => __( 'Orders', 'woocommerce' ),
			'downloads'       	=> __( 'Downloads', 'woocommerce' ),
			'edit-address'    	=> __( 'Addresses', 'woocommerce' ),
			'payment-methods' 	=> __( 'Payment Methods', 'woocommerce' ),
			'edit-account'      => __( 'Edit Account', 'woocommerce' ),
			'reward-point'      => __( 'Reward Points', 'woocommerce' ),
			'customer-logout'   => __( 'Logout', 'woocommerce' ),
		);
	
		return $items;
	}	
}

?>