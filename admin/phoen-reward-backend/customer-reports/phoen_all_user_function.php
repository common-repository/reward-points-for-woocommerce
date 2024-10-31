<?php 
global $woocommerce, $wpdb;

$curr=get_woocommerce_currency_symbol();
$offset = 0;
$posts_per_page = 500;
$args = array(
		'post_type'      => 'shop_order',
		'offset'         => $paged,
		'posts_per_page' => $posts_per_page,
		'post_status'    =>array('wc-completed')//array_keys(wc_get_order_statuses())
	);
	
$offset += $posts_per_page;
	
$products_order = get_posts( $args ); 

global $wpdb,$post;

$limit = 50;  

if (isset($_GET["paged"])) { $page  = $_GET["paged"]; } else { $page=1; };  

$start_from = ($page-1) * $per_page;

$user_detail = $wpdb->get_results($wpdb->prepare("SELECT * FROM $wpdb->users WHERE 1 $do_search ORDER BY $orderby $order LIMIT %d OFFSET %d", $per_page, $start_from), ARRAY_A);

$data_count=0;

$all_user_list_data = array();

for($a=0;$a<count($user_detail);$a++) {
	
	$total_point_reward=0;
	
	$order_count=0;
	
	$amount_spent=0;

	$admin_point = 0;

	$id = $user_detail[$a]['ID'];
	

		$all_user_list_data [$a]['user_email'] = ($user_detail[$a]['user_email']!='')?$user_detail[$a]['user_email']:$user_detail[$a]['user_login']; 
		
		$all_user_list_data [$a]['ID'] = $user_detail[$a]['ID'];
		
		$gen_val = get_option('phoe_set_point_value');
		
		include_once(PHOEN_REWPTSPLUGPATH.'main_function.php');
		$reward_point_value_data = phoen_reward_point_value();

		extract($reward_point_value_data);
			
		$phoen_update_date = get_option('phoen_update_dates');
			
		for($i=0;$i<count($products_order);$i++)  	{
	
			$products_detail=get_post_meta($products_order[$i]->ID); 
			
			$gen_settings=get_post_meta( $products_order[$i]->ID, 'phoe_rewpts_order_status', true );
			
			if(($products_detail['_customer_user'][0]==$id)&&(is_array($gen_settings))){				

				$get_reward_point=isset($gen_settings['get_reward_point'])?$gen_settings['get_reward_point']:'';
						
				$used_reward_point = isset($gen_settings['used_reward_point'])?$gen_settings['used_reward_point']:'';

				$phoen_order_point_val=isset($gen_settings['order_point'])?$gen_settings['order_point']:'';

				$payment_gatway_val_exp=isset($gen_settings['payment_gatway_val'])?$gen_settings['payment_gatway_val']:'';

				$phoen_data_reviews_exp = isset($gen_settings['first_comment_rev'])?$gen_settings['first_comment_rev']:'';
				
				$order = wc_get_order($products_order[$i]->ID);

				$order_bill = phoen_reward_order_sub_total($order);
				
				
				if($products_order[$i]->post_status=="wc-completed" ){

					if($phoen_order_point_val > 0 && !empty($phoen_order_point_val)){
						$total_point_reward+= $phoen_order_point_val;
					}

					if(!empty($payment_gatway_val_exp) && $payment_gatway_val_exp > 0){
						$total_point_reward+= $payment_gatway_val_exp;
					}

					if(!empty($phoen_data_reviews_exp) && $phoen_data_reviews_exp > 0){
						$total_point_reward+= $phoen_data_reviews_exp;
					}
						
					$total_point_reward+= $get_reward_point;
				}

				$total_point_reward-= $used_reward_point;
			
				$amount_spent+=$order_bill;
				
				$order_count++;
				
			}
			
		}	
	
		$admin_point = (int)get_post_meta($id,'phoes_customer_points_update_valss',true);

	    $phoen_reward_user_first_login_points = (int)get_post_meta($id,['phoen_reward_points_for_register_user'][0],true);

	    $phoen_reward_user_birthday_gift_point = (int)get_post_meta($id,'phoeni_rewards_gift_dob_point',true);	

	    //referral point

	    $phoen_reward_referral_user_points = get_user_meta( $id, 'phoen_reward_referral_user_points', true );
	    
	    $phoen_reward_referral_user_id = get_user_meta( $id, 'phoen_reward_referral_user_id', true );
	    
	    $phoen_reward_referral_user_pointsss=0;

	    if(!empty($phoen_reward_referral_user_points)){

			for($j=0; $j<count($phoen_reward_referral_user_points); $j++){

				if($phoen_reward_referral_user_id==$id){

					$phoen_reward_referral_user_pointsss+= (int)$phoen_reward_referral_user_points[$j];		
				}
			}
		}

		(!empty($phoen_reward_referral_user_pointsss) && $phoen_reward_referral_user_pointsss>0)?$admin_point=($admin_point+$phoen_reward_referral_user_pointsss):$admin_point;

		(!empty($phoen_reward_user_first_login_points) && $phoen_reward_user_first_login_points>0)?$admin_point=($admin_point+$phoen_reward_user_first_login_points):$admin_point;	
		
		(!empty($phoen_reward_user_birthday_gift_point) && $phoen_reward_user_birthday_gift_point>0)?$admin_point=($admin_point+$phoen_reward_user_birthday_gift_point):$admin_point;


		$all_user_list_data [$a]['order_count'] =  $order_count; 
				
		$amount_spent = round($amount_spent) ; 
				
		$all_user_list_data [$a]['amount_spent'] =  $curr.$amount_spent; 

		$all_user_list_data [$a]['total_point_reward'] = round($total_point_reward+$admin_point,2); 

		$all_user_list_data [$a]['amount_in_wallet'] = $curr.round(($total_point_reward+$admin_point)/$reedem_value,2);

}

$this->items = $all_user_list_data;