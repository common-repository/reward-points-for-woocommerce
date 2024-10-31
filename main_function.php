<?php function phoen_get_product_price_from_cart_total($reward_value){

	$total_product_price = 0;
	
	foreach( WC()->cart->get_cart() as $cart_item ){

	   $_product   = wc_get_product( $cart_item['product_id'] );
	   $quantity   = $cart_item['quantity'];

	   if($_product->is_type('variable')){
	      $price = get_post_meta($cart_item['variation_id'], '_price', true)*$quantity;      
	   }else{
	      $price = $cart_item['data']->get_price()*$quantity;
	   }

	   $total_product_price+= round($price*$reward_value,2);
	} 

	return $total_product_price;
}

function phoen_reward_redeem_point(){
	
	global $woocommerce;
	$amount=0;
	
	ob_start();
	
	$coupon_id = strtolower('Reward Amount');
	
	if(in_array($coupon_id, $woocommerce->cart->get_applied_coupons())){
		$amount = WC()->cart->get_coupon_discount_amount( $coupon_id, WC()->cart->display_cart_ex_tax );
	}
	ob_get_clean();
	return $amount;
}


function decimal_and_thousand_seprator($bill_price,$discount_price){
	
	$decimal_separator = wc_get_price_decimal_separator();
			
	$thousand_seprator = wc_get_price_thousand_separator();
	
	if($thousand_seprator !=','){

		if(strpos($bill_price, ',') !== false){
				
			$bill_price = str_replace(',', '.', $bill_price); 
			
			$bill_price = (float) $bill_price;
		}
		
		$bill_price = $bill_price-$discount_price;
		
	}else{
		
		$bill_price =  str_replace($thousand_seprator,'',$bill_price)-$discount_price;
		
	}
	return $bill_price;
		
}


function phoen_reward_order_sub_total($order){
	
	$tax_display = get_option( 'woocommerce_tax_display_cart' );
	
	$subtotal    = 0;
	
	$compound = false;
	
	if ( ! $compound ) {
		
		foreach ( $order->get_items() as $item ) {
			
			$subtotal += $item->get_subtotal();

			if ( 'incl' === $tax_display ) {				
				$subtotal += $item->get_subtotal_tax();			
			}
		}

		//$subtotal = wc_price( $subtotal, array( 'currency' => $order->get_currency() ) );

	} else {
		if ( 'incl' === $tax_display ) {
			return '';
		}

		foreach ( $order->get_items() as $item ) {
			$subtotal += $item->get_subtotal();
		}

		// Add Shipping Costs.
		$subtotal += $order->get_shipping_total();

		// Remove non-compound taxes.
		foreach ( $order->get_taxes() as $tax ) {
			if ( $tax->is_compound() ) {
				continue;
			}
			$subtotal = $subtotal + $tax->get_tax_total() + $tax->get_shipping_tax_total();
		}

		// Remove discounts.
		$subtotal = $subtotal - $order->get_total_discount();
		//$subtotal = wc_price( $subtotal, array( 'currency' => $order->get_currency() ) );
	}
	
	return $subtotal;
}

function phoen_reward_check_first_order(){

	$count_order = array();

	if(is_user_logged_in()){

		$count_order = wc_get_orders( array(
			'meta_key' 		=> '_customer_user',
			'meta_value' 	=> get_current_user_id(),
			'post_status' 	=> array('wc-on-hold', 'wc-processing', 'wc-completed'),
			'numberposts' 	=> -1
		));

	}

	return count($count_order);
}


function phoen_rewpts_first_review_reward_point($user_id,$post_id){

	$recent_comments = get_comments( array(
	    'status'    => 'approve',
	    'user_id'   => $user_id,
	    'post_id'   => $post_id
	));
           
    return count($recent_comments);
}


function get_cart_total_without_including_tax(){

	$cart_total = 0;

	global $woocommerce;

	foreach( $woocommerce->cart->get_cart() as $cart_item ){

		$cart_total+= $cart_item['data']->get_price()*$cart_item['quantity'];
		
	}

	return $cart_total;
}


function phoen_reward_point_value(){

	$set_point 		= get_option('phoe_set_point_value');
	
	$reward_point   = isset($set_point['reward_point_data']['all_user']['reward_point'])?$set_point['reward_point_data']['all_user']['reward_point']:0;
	
	$reedem_point   = isset($set_point['reedem_point'])?$set_point['reedem_point']:0;
	
	$reward_money   = isset($set_point['reward_point_data']['all_user']['reward_money'])?$set_point['reward_point_data']['all_user']['reward_money']:0;
	
	$reedem_money   = isset($set_point['reedem_money'])?$set_point['reedem_money']:0;
	
	($reward_point !=0 || $reward_money !=0) ? $reward_value = ($reward_point/$reward_money): $reward_value = 0;
	
	($reedem_point !=0 || $reedem_money !=0) ? $reedem_value = ($reedem_point/$reedem_money): $reedem_value = 0;
	
	return  array('reward_value'=>$reward_value,'reedem_value'=>$reedem_value);	
}


function phoen_rewpts_user_reward_point($current_user_id = 0){

	$current_user_id = ($current_user_id == 0) ? get_current_user_id() : $current_user_id;

	global $woocommerce;
		
	$total_reward_point = $total_used_point = 0;	

	$products_order = get_posts( array(
		'numberposts' => -1,
		'meta_key'    => '_customer_user',
		'meta_value'  => $current_user_id,
		'post_type'   => 'shop_order',
		'order'       => 'ASC',
		'post_status' => array_keys(wc_get_order_statuses()),
	));


	// FIRST ORDER POINT
    $phoen_reward_user_first_login_points = (int)get_post_meta($current_user_id,['phoen_reward_points_for_register_user'][0],true);

    (!empty($phoen_reward_user_first_login_points) && $phoen_reward_user_first_login_points != 0) ? $total_reward_point+= $phoen_reward_user_first_login_points : $total_reward_point;

	// BIRTHDAY POINT
    $phoen_reward_user_birthday_gift_point = (int)get_post_meta($current_user_id,'phoeni_rewards_gift_dob_point',true);

   (!empty($phoen_reward_user_birthday_gift_point) && $phoen_reward_user_birthday_gift_point != 0) ? $total_reward_point+= $phoen_reward_user_birthday_gift_point : $total_reward_point;

	// ADMIN POINT
	$phoni_get_admin_points = (int)get_post_meta($current_user_id,'phoes_customer_points_update_valss',true);

	($phoni_get_admin_points != 0 && !empty($phoni_get_admin_points)) ? $total_reward_point+= $phoni_get_admin_points : $total_reward_point;
	
    // REFERRAL POINT
    $phoen_reward_referral_user_points = get_user_meta( $current_user_id, 'phoen_reward_referral_user_points', true );
    
    $phoen_reward_referral_user_id = get_user_meta( $current_user_id, 'phoen_reward_referral_user_id', true );
    
    $phoen_reward_referral_user_pointsss=0;

    if(!empty($phoen_reward_referral_user_points)){

		for($j=0; $j<count($phoen_reward_referral_user_points); $j++){

			if($phoen_reward_referral_user_id==$current_user_id){

				$phoen_reward_referral_user_pointsss+= (int)$phoen_reward_referral_user_points[$j];		
			}
		}
	}

	(!empty($phoen_reward_referral_user_pointsss) && $phoen_reward_referral_user_pointsss>0)?$total_reward_point=($total_reward_point+$phoen_reward_referral_user_pointsss):$total_reward_point;

			
	for($i=0;$i<count($products_order);$i++){	
				
		$gen_settings = get_post_meta( $products_order[$i]->ID, 'phoe_rewpts_order_status', true );
				
		if( (is_array($gen_settings)) && !empty($gen_settings)  ){
					
			$get_reward_point  = isset($gen_settings['get_reward_point'])?$gen_settings['get_reward_point']:'';
					
			$used_reward_point+= isset($gen_settings['used_reward_point'])?$gen_settings['used_reward_point']:'';

			$used_coupon = isset($gen_settings['used_coupon_point'])?$gen_settings['used_coupon_point']:'';
	
			$phoen_order_point_val = isset($gen_settings['order_point'])?$gen_settings['order_point']:'';

			$payment_gatway_val_exp = isset($gen_settings['payment_gatway_val'])?$gen_settings['payment_gatway_val']:'';

			$phoen_data_reviews_exp = isset($gen_settings['first_comment_rev'])?$gen_settings['first_comment_rev']:'';


			if($products_order[$i]->post_status=="wc-completed" ){

				(!empty($phoen_order_point_val) && $phoen_order_point_val > 0) ? $total_reward_point+= $phoen_order_point_val : $total_reward_point;

				(!empty($payment_gatway_val_exp) && $payment_gatway_val_exp > 0) ? $total_reward_point+= $payment_gatway_val_exp : $total_reward_point;
				

				(!empty($phoen_data_reviews_exp) && $phoen_data_reviews_exp > 0) ? $total_reward_point+= $phoen_data_reviews_exp : $total_reward_point;
				
				$total_reward_point+= $get_reward_point;
			}
		}		
	} 
	
	return round($total_reward_point-($used_reward_point+$used_coupon),2);
}

function phoen_rewpts_user_reward_amount(){
			
	$total_point_reward 	= phoen_rewpts_user_reward_point();
			
	$reedem_value 			= phoen_reward_point_value()['reedem_value'];
		
	$phoe_set_point_value 	= isset($_POST['phoe_set_point_value']) ? sanitize_text_field($_POST['phoe_set_point_value']) :'';

	return (!empty($phoe_set_point_value)) ? round($phoe_set_point_value/$reedem_value,2) : round($total_point_reward/$reedem_value,2);			
}

?>