<?php
require_once(PHOEN_REWPTSPLUGPATH.'public/phoen-reward-frontend/phoen_cart_page_class.php');
require_once(PHOEN_REWPTSPLUGPATH.'public/phoen-reward-frontend/phoen_single_product_class.php');
require_once(PHOEN_REWPTSPLUGPATH.'public/phoen-reward-frontend/phoen_checkout_page_class.php');
require_once(PHOEN_REWPTSPLUGPATH.'public/phoen-reward-frontend/phoen_customer_point_class.php');
require_once(PHOEN_REWPTSPLUGPATH.'public/phoen-reward-frontend/phoen_rewpts_login_sign-up.php');
/**
 * The public-facing functionality of the plugin.
 *
 * @link       http://www.phoeniixx.com/
 * @since      1.0.0
 *
 * @package    Phoen_Rewpts
 * @subpackage Phoen_Rewpts/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the public-facing stylesheet and JavaScript.
 *
 * @package    Phoen_Rewpts
 * @subpackage Phoen_Rewpts/public
 * @author     phoeniixx <contact@phoeniixx.com>
 */
class Phoen_Rewpts_Public {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of the plugin.
	 * @param      string    $version    The version of this plugin.
	 */

	// GENERAL SETTING
	private $gen_settings 					= array();
	// SET POINT DATA
	private $phoe_set_point_value_data 		= array();
	// SET NOTIFICATION
	private $phoen_rewpts_notification_data = array(); 
	// SET STYLING
	private $styling_tab_settings 			= array();


	use Phoen_Single_Product_Page;
	use Phoen_Cart_Page;
	use Phoen_Checkout_Page_Point_Data;
	use Phoen_Rewpts_Customer_Point;
	use Phoen_Rewpts_Add_Extra_Field;

	public function __construct( $plugin_name, $version ) {

		$this->plugin_name 						= $plugin_name;
		$this->version 							= $version;
		$this->phoe_set_point_value_data 		= get_option('phoe_set_point_value');
		$this->phoen_rewpts_notification_data 	= get_option('phoen_rewpts_notification_settings',true);
		$this->gen_settings 					= get_option('phoe_rewpts_page_settings_value');
		$this->styling_tab_settings 			= get_option('phoen_rewpts_custom_btn_styling');

		/*  BIRTHDAY POINT ENABLE */
		($this->gen_settings['enable_plugin_dob_date'] == '1') ?add_action('init', array($this,'phoen_rewpts_user_birthday_point')) : '';		

		/* SHOW OR NOT POINT IN ORDER HISTORY */
		if($this->gen_settings['show_points_with_order_history']=='1'):
			add_filter( 'woocommerce_account_orders_columns', array($this,'add_reward_point_history_column'));
			add_action( 'woocommerce_my_account_my_orders_column_custom-column', array($this,'add_reward_column_rows' ));
		endif;

	}

	/**
	 * Register the stylesheets for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Phoen_Rewpts_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Phoen_Rewpts_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/phoen-rewpts-public.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Phoen_Rewpts_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Phoen_Rewpts_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/phoen-rewpts-public.js', array( 'jquery' ), $this->version, false );

		wp_register_script( 'Loading-overlay', 'https://cdn.jsdelivr.net/npm/gasparesganga-jquery-loading-overlay@2.1.7/dist/loadingoverlay.min.js', null, null, true );
		wp_enqueue_script('Loading-overlay');

	}

	public function phoen_rewpts_include_main_function_file(){
		ob_start();
	   		include_once(PHOEN_REWPTSPLUGPATH.'main_function.php');
	   		$content = ob_get_contents();
	   	ob_end_clean();
	   		return $content;
	}

	public function phoen_rewpts_add_frontend_styling(){
		ob_start();
			include_once(PHOEN_REWPTSPLUGPATH.'public/phoen-reward-frontend/phoen_rewpts_frontend.php');
			$content = ob_get_contents();
		ob_end_clean();
			echo $content;
	}


	public function phoen_rewpts_woocommerce_applied_coupon() {

		global $woocommerce;
			
		include_once(PHOEN_REWPTSPLUGPATH.'main_function.php');

		$total_user_amount = phoen_rewpts_user_reward_amount(); // get total user point
		
		$coupon_id = 'reward amount';
		
		if(in_array($coupon_id, $woocommerce->cart->get_applied_coupons())) return;
			
		$bill_price = $woocommerce->cart->cart_contents_total;
				
		$u_price=0;
			
		if($total_user_amount >= $bill_price) 	{
				
			$u_price = $bill_price; 
			 
		}
		else if($total_user_amount < $bill_price){
				
			$u_price = $total_user_amount;		
		} 
		
		$coupon_code = 'Reward Amount';
		
		if($u_price != ''){
			   
			$amount = $u_price; // Amount

			$discount_type = 'fixed_cart'; // Type: fixed_cart
		
			if($phoen_coupan_c_data==''){		
					
				$coupon = array(
					'post_title'   => $coupon_code,
					'post_content' => '',
					'post_status'  => 'publish',
					'post_author'  => 1,
					'post_type'    => 'shop_coupon'
				);
									   
				$new_coupon_id = wp_insert_post( $coupon );
			}				   
			
			// Add meta
			update_post_meta( $new_coupon_id, 'discount_type', $discount_type );
			update_post_meta( $new_coupon_id, 'coupon_amount', $amount );
			update_post_meta( $new_coupon_id, 'individual_use', 'no' );
			update_post_meta( $new_coupon_id, 'product_ids', '' );
			update_post_meta( $new_coupon_id, 'exclude_product_ids', '' );
			update_post_meta( $new_coupon_id, 'usage_limit', '' );
			update_post_meta( $new_coupon_id, 'expiry_date', '' );
			update_post_meta( $new_coupon_id, 'apply_before_tax', 'yes' );
			update_post_meta( $new_coupon_id, 'free_shipping', 'no' );
			   
			// your coupon code here
			if ( $woocommerce->cart->has_discount( $coupon_code ) ) return;
				
				WC()->cart->add_discount( $coupon_code );
					
			}else{
				
				WC()->cart->remove_coupon( $coupon_code );
				
			}	
	}

	public function phoeniixx_rewpts_apply_point(){
			
		if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['apply_points']) && is_user_logged_in()){	
			
			$phoe_set_point_value = isset($_POST['phoe_set_point_value']) ? sanitize_text_field($_POST['phoe_set_point_value']) : '';
			
			if(!empty($phoe_set_point_value) && $phoe_set_point_value > 0) 	{	

				$this->phoen_rewpts_woocommerce_applied_coupon();
				$_SESSION['action']= "apply";
				$_SESSION['points']= $phoe_set_point_value;
			}
		}			
	}

	public function phoen_rewpts_click_on_checkout_action( $order_id ){

		if ( ! $order = wc_get_order( $order_id ) ) return;

		$this->phoen_rewpts_include_main_function_file();

		global $woocommerce;
		
		$current_user 				= wp_get_current_user();

		$user_id 					= $current_user->ID;

		$email_id   				= $current_user->user_email;

		$get_discount_value 		= wc_get_order( $order_id )->get_discount_tax();
		
		$bill_price 				= $order->get_total();

		$phoen_reward_point_value 	= phoen_reward_point_value();

		$user_order_count 			= phoen_reward_check_first_order();

		//______________________________________________________________//

		$reward_value 			 = $phoen_reward_point_value['reward_value'];

		$reedem_value 			 = $phoen_reward_point_value['reedem_value'];

		$first_review_points_val = isset($this->phoe_set_point_value_data['first_review_points'])?$this->phoe_set_point_value_data['first_review_points']:'';

		$get_payment_gateway_val = isset($this->phoe_set_point_value_data['use_payment_gateway'])?$this->phoe_set_point_value_data['use_payment_gateway']:'';
		
		$first_order_points_val  = isset($this->phoe_set_point_value_data['first_order_points'])?$this->phoe_set_point_value_data['first_order_points']:'';
		

		// MAIL NOTIFICATION
		$phoen_rewts_order_point_mail_heading_color = isset($this->phoen_rewpts_notification_data['phoen_rewts_order_point_mail_heading_color']) ? $this->phoen_rewpts_notification_data['phoen_rewts_order_point_mail_heading_color'] : '#e98fd7';

	    $phoen_rewts_order_point_mail_heading = isset($this->phoen_rewpts_notification_data['phoen_rewts_order_point_mail_heading'])?$this->phoen_rewpts_notification_data['phoen_rewts_order_point_mail_heading']:'';

	    $phoen_rewts_order_point_mail_subject = isset($this->phoen_rewpts_notification_data['phoen_rewts_order_point_mail_subject'])?$this->phoen_rewpts_notification_data['phoen_rewts_order_point_mail_subject']:'';

	    $phoen_rewts_order_point_mail_message = isset($this->phoen_rewpts_notification_data['phoen_rewts_order_point_mail_message'])?$this->phoen_rewpts_notification_data['phoen_rewts_order_point_mail_message']:'';
	   

	    //first review point and prodcut based point
		$phoen_reword_comments = get_comments( array( 
			'status'      => 'approve', 
		 	'post_type'   => 'product' 
		));	

		foreach ($order->get_items() as $item) {

			$_product 		= wc_get_product($item->get_product_id());
			$quantity   	= $item['quantity'];
			if($_product->is_type('variable')){
		      $price = get_post_meta($item->get_variation_id(), '_price', true)*$quantity;      
		   	}else{
		      $price = $_product->get_price()*$quantity;
		   	}
			
			$product_purchase_points_val+= $price*$reward_value;

			if(is_array($phoen_reword_comments) && !empty($phoen_reword_comments)){

				foreach ($phoen_reword_comments as $phoe=>$phoen_review_data) {

					$phoen_product_id = $phoen_review_data->comment_post_ID;
					
					$phoen_com_user_id = $phoen_review_data->user_id;
			
					$phoen_review_email = $phoen_review_data->comment_author_email;

					if($phoen_com_user_id == $user_id && $phoen_product_id == $product_id){

						$phoen_rev_data = get_post_meta($product_id,'phoen_review_reward_point',true);

						if(empty($phoen_rev_data)){

							if(!empty($first_review_points_val) && $first_review_points_val>0){

								$first_review_points_vals = $first_review_points_vals+$first_review_points_val;

								$data = array($phoen_review_email);

								update_post_meta($product_id,'phoen_review_reward_point', $data);
							}
						}else{

							$data = $phoen_rev_data;

						    if( !in_array($phoen_review_email, $phoen_rev_data) ) { 

						    	if(!empty($first_review_points_val) && $first_review_points_val>0){

						    		$first_review_points_vals = $first_review_points_vals+$first_review_points_val;

							        array_push($data, $phoen_review_email);

							        update_post_meta($product_id,'phoen_review_reward_point',$data);    
							    }
						    }
						}
					}
				}
			}	
		}

		update_post_meta($order_id,'pho_reward_review_point',$first_review_points_vals);
	
	// GET AND SAVED USED REWARD POINT
		$used_reward_amount = phoen_reward_redeem_point();
		$used_reward_point  = $used_reward_amount*$reedem_value;

	// FIRST ORDER POINT 
		if( !empty($first_order_points_val) && $user_order_count == 0 ){

			$first_order_point = $first_order_points_val;
		}

	//GET PAYPAL POINT
		$phoen_payment_method = $order->get_payment_method();
	
		if($phoen_payment_method == 'paypal'){

			if ($get_payment_gateway_val>0 && !empty($get_payment_gateway_val)) {
				
				$paypal_point = $get_payment_gateway_val;
			}
		}

	// review point
		$review_point = get_post_meta($order_id,'pho_reward_review_point',true);

		$phoen_current_dates_updatse = new DateTime();
		$phoen_current_dates_update = $phoen_current_dates_updatse->format('d-m-Y');

		/*************** update data  **************/
		
		$phoe_set_point_value = array(

			'user_id'					=> $user_id,

			'email_id'					=> $email_id, 

			'phoen_order_id'			=> $order_id,
			
			'points_per_price'			=> $reward_value, 
			
			'reedem_per_price'			=> $reedem_value, 

			'used_reward_point'			=> $used_reward_point, 
			
			'used_reward_amount'		=> $used_reward_amount, 
			
			'get_reward_point' 			=> $product_purchase_points_val,

			'get_reward_amount' 		=> $product_purchase_points_val,

			'order_point'				=> $first_order_point,

			'payment_gatway_val' 		=> $paypal_point,

			'first_comment_rev' 		=> $review_point,

			'bill_price_checked_value' 	=> $bill_price,

			'discount_value' 			=> $get_discount_value,

			'current_date'				=> $phoen_current_dates_update,		
		);

		$total_earn_point = array();

		(!empty($product_purchase_points_val) && $product_purchase_points_val>0) ? array_push($total_earn_point,array('get_reward_point'=>$product_purchase_points_val)):array_push($total_earn_point,array('get_reward_point'=>''));

		(!empty($first_order_point) && $first_order_point>0) ? array_push($total_earn_point,array('order_point'=>$first_order_point)) : array_push($total_earn_point,array('order_point'=>''));

		(!empty($paypal_point) && $paypal_point>0) ? array_push($total_earn_point,array('use_payment_gateway_val'=>$paypal_point)) : array_push($total_earn_point,array('use_payment_gateway_val'=>''));

		(!empty($review_point) && $review_point>0) ? array_push($total_earn_point,array('phoen_data_reviews'=>$review_point)):array_push($total_earn_point,array('phoen_data_reviews'=>''));

		(!empty($used_reward_point) && $used_reward_point>0) ? array_push($total_earn_point,array('used_reward_point'=>$used_reward_point)):array_push($total_earn_point,array('used_reward_point'=>''));

		if( !empty($total_earn_point) && $this->gen_settings['enable_points_with_order_details_sending_email'] == '1' ){

			define ("HEADING_COLOR", serialize ($phoen_rewts_order_point_mail_heading_color));
			define ("ORDER_HEADING", serialize ($phoen_rewts_order_point_mail_heading));
			define ("ORDER_MESSAGE", serialize ($phoen_rewts_order_point_mail_message));

			define ("ORDER_ID", serialize ($order_id));
			define ("USER_ID", serialize ($user_id));
			define ("ORDER_DATE", serialize ($phoen_current_dates_update));
			define ("ORDER_AMOUNT", serialize($bill_price));
			define ("TOTAL_EARN_POINT", serialize ($total_earn_point));

			ob_start();
				wc_get_template('admin/phoen-reward-backend/phoen-reward-point-mail/phoen_reward_point_mail.php',null,PHOEN_REWPTSPLUGPATH,PHOEN_REWPTSPLUGPATH);
				$html = ob_get_contents();
			ob_end_clean();

			$to      =  $email_id;
			$headers = array('Content-Type: text/html; charset=UTF-8');

			wp_mail($to, $phoen_rewts_order_point_mail_subject, $html, $headers);
		}

	   	update_post_meta( $order_id, 'phoe_rewpts_order_status', $phoe_set_point_value );

	   	session_destroy();
	}

	
	public function phoen_rewards_notification_paypal_payment() {

		$installed_payment_methods = WC()->payment_gateways->get_available_payment_gateways();
		
		foreach( $installed_payment_methods as $method ) {
			
			if ($method->title=='PayPal'){

				$get_payment_gateway_point = get_option('phoe_set_point_value');
				
				$get_checkout_notification_data = get_option('phoen_rewpts_notification_settings',true);

				$phoen_rewpts_enable_notify_using_paypal = isset($get_checkout_notification_data['phoen_rewpts_enable_notify_using_paypal'])?$get_checkout_notification_data['phoen_rewpts_enable_notify_using_paypal']:'0';

				if($phoen_rewpts_enable_notify_using_paypal!=0){

				
					$phoen_rewpts_get_paypal_point = isset($get_checkout_notification_data['phoen_rewpts_paypal_notification'])?$get_checkout_notification_data['phoen_rewpts_paypal_notification']:'You Will get {points} Points On Completing This Order';

					$phoen_reward_paypal_point = $get_payment_gateway_point['use_payment_gateway'];

					if($phoen_reward_paypal_point>0 && !empty($phoen_reward_paypal_point)){

						$show_message = str_replace("{points}","$phoen_reward_paypal_point",$phoen_rewpts_get_paypal_point);
						?>
						<ul class="wc_payment_methods payment_methods methods" style="width:100%;">
							<li class="wc_payment_method payment_method_paypal">
								<div class="payment_box payment_method_paypal wc_payment_method payment_method_paypal">
									<p><?= _e($show_message);?></p>
								</div>	
							</li>
						</ul>
						<?php
					}
				}
			}
		}		
	}

	function phoen_reward_edit_account_form() {

		$gen_settings = get_option('phoe_rewpts_page_settings_value'); 
		
		$enable_plugin_dob_date=$gen_settings['enable_plugin_dob_date'];

		$enable_plugin_reff=$gen_settings['enable_plugin_reff_code'];

		$user_id = get_current_user_id();
			
		?> 
			   
		<fieldset>
		<?php
		if($enable_plugin_dob_date=='1' ){

			$phoen_edit_reward_dob_data = get_user_meta( $user_id, 'date_of_birth', true );
				
				if($phoen_edit_reward_dob_data!='')
				{
					$phoen_disable_dob ='disabled="disabled"';
				}
				
				?>
				
					<p class="form-row form-row-wide">
						<label for="reg_billing_phone"><?php _e( 'Date of Birth', 'phoen-rewpts' ); ?> <span class="required">*</span></label></label>
						<input type="date" class="input-text phoen_reward_dob_date" name="phoen_reward_edit_dob_user" id="phoen_reward_edit_dob_user" value="<?php echo isset($phoen_edit_reward_dob_data)?$phoen_edit_reward_dob_data:''; ?>" <?php echo isset($phoen_disable_dob)?$phoen_disable_dob:'' ; ?>/>
						<span class="description"><?php _e("You want to edit your birthday date please contact to admin.",'phoen-rewpts'); ?></span>
					</p>
				<?php
			}

			if($enable_plugin_reff=='1')
			{	
				
				$phoen_reward_referral_user_val_data = get_user_meta( $user_id, 'phoen_reward_referral_user_hidden', true );
				
				if($phoen_reward_referral_user_val_data!=''){
					
					$phoen_validation_ref = get_option('phoen_validation_ref_code');
				
					if(empty($phoen_validation_ref))
					{
						$code = array($phoen_reward_referral_user_val_data);
						
						if(!in_array($phoen_reward_referral_user_val_data,$phoen_validation_ref)){
							
							update_option('phoen_validation_ref_code',$code);
						}
						
					}else{
						
						$code = array($phoen_reward_referral_user_val_data);
						
						$email_combine_ref=array_merge($code,$phoen_validation_ref);
						
						if(!in_array($phoen_reward_referral_user_val_data,$phoen_validation_ref)){
							
							update_option('phoen_validation_ref_code',$email_combine_ref);
							
						}
						
					}
					
					$phoen_reward_referral_user_val=$phoen_reward_referral_user_val_data;
				
				}else{
					
					$digits = 5;
					
					$phoe_rand_number =  rand(pow(10, $digits-1), pow(10, $digits)-1);
					
					$user_info = get_userdata($user_id);
					
					$phoen_user_name = $user_info->user_login;
					
					update_user_meta( $user_id, 'phoen_reward_referral_user_hidden', sanitize_text_field($phoen_user_name."_". $phoe_rand_number ) );
					
					$phoen_reward_referral_user_val = get_user_meta( $user_id, 'phoen_reward_referral_user_hidden', true );
					
					$phoen_validation_ref = get_option('phoen_validation_ref_code');
				
					if(empty($phoen_validation_ref))
					{
						$code = array($phoen_user_name."_". $phoe_rand_number);
						
						update_option('phoen_validation_ref_code',$code);
					
					}else{
						
						$phoen_validation_ref = get_option('phoen_validation_ref_code');
						
						$code = array($phoen_user_name."_". $phoe_rand_number);
						
						$email_combine_ref=array_merge($code,$phoen_validation_ref);
						
						update_option('phoen_validation_ref_code',$email_combine_ref);
						
					}
					
				}
				
				$phoen_validation_ref = get_option('phoen_validation_ref_code');
				
				$phoen_rewards_referral_user = get_user_meta( $user_id, 'phoen_reward_referral_user_codes', true );
				
				if($phoen_reward_referral_user_val!='')
				{
					$phoen_disable_ref ='disabled="disabled"';
				}
				if($phoen_reward_referral_user_val!='')
				{
					
					?>
				<p class="form-row form-row-wide phoen_mail_ref_code">
				
				
					<label for="reg_billing_phone"><?php _e( 'Referral Code', 'phoen-rewpts' ); ?></label></label>
					<input type="text" class="input-text referral_code" name="phoen_reward_referral_user_code" id="phoen_reward_referral_user_code" value="<?php echo isset($phoen_reward_referral_user_val)?$phoen_reward_referral_user_val:''; ?>" readonly />
					<label for="reg_billing_phone "><?php _e( 'Site url', 'phoen-rewpts' ); ?></label></label>
					<input type="text" class="input-text referral_url" name="phoen_reward_referral_site_url" id="phoen_reward_referral_site_url" value="<?php echo get_site_url()."/my-account/"; ?>" readonly />
					<label for="reg_billing_phone"><?php _e( 'Enter Referral Email Id', 'phoen-rewpts' ); ?></label></label>
					<input type="text" class="input-text referral_email" name="phoen_reward_referral_email_id" id="phoen_reward_referral_email_id" value="<?php echo isset($phoen_reward_referral_email_id)?$phoen_reward_referral_email_id:''; ?>" />
					<a class="phoen_send_reff_code"><?php _e( 'Send Referral code', 'phoen-rewpts' ); ?></a>
					<span class="transfer_sucessfully" style="display:none"><?php _e( 'Referral code Sent Successfully', 'phoen-rewpts' ); ?>..</span>
				</p>
				
				<script>
				jQuery(document).ready(function()
				{
					jQuery(".phoen_send_reff_code").on("click",function()
					{
						var ref_code = jQuery(".referral_code").val();
						var ref_url  = jQuery(".referral_url").val();
						var ref_email_id = jQuery(".referral_email").val();
						
						var phoen_referral_newurl = '<?php echo admin_url('admin-ajax.php') ;?>';
			
							jQuery.post(
								
								phoen_referral_newurl,
								{
									'action'	:  'phoe_referral_code_completed',
									'data'		:	ref_code,
									'ref_site_url':	ref_url,
									'ref_user_email_id'   : ref_email_id
									
								},
								function(response){
									
									if(response=='completed')
									{
									
										jQuery(".transfer_sucessfully").css("display", "block");
									
									}
								}
								
								
							);
						
					});
				});
				
				</script>
				<style>
				.phoen_send_reff_code {
					border: 1px solid #ccc;
					border-radius: 4px;
					color: #555;
					cursor: pointer;
					display: inline-block;
					float: right;
					font-weight: 600;
					margin: 10px 0;
					padding: 8px 15px;
					text-shadow: none;
				}
				
				.phoen_send_reff_code:hover {
					color: #555;
				}
				
				.woocommerce form .phoen_mail_ref_code {
					background-color: #eee;
					border: 1px solid #eee;
					padding: 15px;
				}
				
				.transfer_sucessfully {
					border: 1px solid #008000;
					color: #008000;
					float: left;
					font-size: 12px;
					padding: 5px;
					text-align: center;
					width: 100%;
				}
				</style>
				<?php }

			}
			?>
				<div class="clear"></div>
			</fieldset>
			<?php
		}

	function phoen_reward_save_account_details( $user_id ) {
		
		if ( isset( $_POST['phoen_reward_edit_dob_user'] ) ) {

			$get_dob_date = date_create(sanitize_text_field($_POST['phoen_reward_edit_dob_user']));
				
			update_user_meta($user_id, 'date_of_birth', date_format($get_dob_date,'d-m-Y'));
		}

	}


	function phoen_rewpts_user_birthday_point(){

		if ( !is_user_logged_in() ) {

			return false;
		}
		
		$current_user = wp_get_current_user();

		$cur_email = $current_user->user_email;

		$curr_user_id = $current_user->ID;

		$gen_settings = get_option('phoe_rewpts_page_settings_value');

		$phoen_rewpts_set_point_data = get_option('phoe_set_point_value',true);

		$phoen_rewpts_notification_settings = get_option('phoen_rewpts_notification_settings');
		$phoen_rewts_birthday_mail_message = isset($phoen_rewpts_notification_settings['phoen_rewts_birthday_mail_message'])?$phoen_rewpts_notification_settings['phoen_rewts_birthday_mail_message']:'You Have Got {points} Points on Your Birthday';
			
		$enable_plugin_dob_date = isset($gen_settings['enable_plugin_dob_date'])?$gen_settings['enable_plugin_dob_date']:'';

		$gift_birthday_points = isset($phoen_rewpts_set_point_data['gift_birthday_points'])?$phoen_rewpts_set_point_data['gift_birthday_points']:'';

		$current_month 		= date("m");
		$current_day 		= date("d");
		$happyBirthDate 	= get_user_meta($curr_user_id, 'date_of_birth',true);
		$happyBirthDate		= explode('-', $happyBirthDate);
		$birth_day 			= $happyBirthDate[0];
		$birth_month		= $happyBirthDate[1]; 


		if($enable_plugin_dob_date=='1'){

			if ($gift_birthday_points>0 && !empty($gift_birthday_points)) {

				if( $current_month === $birth_month && $current_day === $birth_day){


					$check_birthday_points_value = get_post_meta($curr_user_id,'phoeni_rewards_gift_dob_point',true);	

					if (empty($check_birthday_points_value) || $check_birthday_points_value == 0) {

						$phoen_current_dates = date("d-m-Y") ;
						update_post_meta($curr_user_id,'phoeni_rewards_gift_dob_point',$gift_birthday_points);
						update_post_meta($curr_user_id,'phoeni_rewards_gift_dob_point_date',$phoen_current_dates);


						$subject = "Happy Birthday  ".get_user_by( 'id', $curr_user_id )->display_name;

						$headers = array('Content-Type: text/html; charset=UTF-8');

					 	$msg = '<div style="background-color:#f5f5f5;width:100%;margin:0;padding:70px 0 70px 0">
							<table width="100%" height="100%" cellspacing="0" cellpadding="0" border="0">
							<tbody>
								<tr>
									<td valign="top" align="center">
									<div></div>
			                    	<table width="600" cellspacing="0" cellpadding="0" border="0" style="border-radius:6px!important;background-color:#fdfdfd;border:1px solid #dcdcdc;border-radius:6px!important">
									<tbody>
										<tr>
											<td valign="top" align="center">
			                                    
			                                	<table width="600" cellspacing="0" cellpadding="0" border="0" bgcolor="#557da1" style="background-color:#557da1;color:#ffffff;border-top-left-radius:6px!important;border-top-right-radius:6px!important;border-bottom:0;font-family:Arial;font-weight:bold;line-height:100%;vertical-align:middle">
													<tbody>
														<tr>
															<td>
																<h1 style="color:#ffffff;margin:0;padding:28px 24px;display:block;font-family:Arial;font-size:30px;font-weight:bold;text-align:left;line-height:150%">'.
																$subject.
																
																'</h1>
															</td>
														</tr>
													</tbody>
												</table>
											</td>
			                            </tr>
										
										<tr>
											<td valign="top" align="center">
												<table width="600" cellspacing="0" cellpadding="10" border="0" style="border-top:0">
													<tbody>
														<tr>
															<td valign="top">
																<table width="100%" cellspacing="0" cellpadding="10" border="0">
																	<tbody>
																		<tr>
																			<td valign="middle" style="border:0;color:#99b1c7;font-family:Arial;font-size:12px;line-height:125%;text-align:center" colspan="2">
																				<h2 style="float:left;">'.str_replace('{points}',"$gift_birthday_points",$phoen_rewts_birthday_mail_message).'</h2>
																			</td>
																		</tr>
																	</tbody>
																</table>
															</td>
														</tr>
													</tbody>
												</table>
											</td>
			                             </tr>
										
									 </tbody>
									</table>
								  </td>
								</tr>
							</tbody>
							</table>';

						wp_mail( $cur_email, $subject,$msg,$headers);

					}
				}
			}
		}
	}//phoen_rewpts_user_birthday_point
		

	function add_reward_point_history_column( $columns ){
		
	    $columns['custom-column'] = __( 'Earn Reward Point', 'woocommerce' );

	    return $columns;
	}

	function add_reward_column_rows( $order ) {

		$gen_settings=get_post_meta( $order ->ID, 'phoe_rewpts_order_status', true );

		if($gen_settings){
			if($gen_settings['get_reward_amount']>0){
				echo round(abs($gen_settings['get_reward_point'])).' points';
			}else{
				echo '0 points';
			}
		}
	}

/******  extra field  ******/

}//class closed
