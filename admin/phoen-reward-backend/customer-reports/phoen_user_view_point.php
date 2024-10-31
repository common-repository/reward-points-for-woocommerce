<?php if ( ! defined( 'ABSPATH' ) ) exit; 

	include_once(PHOEN_REWPTSPLUGPATH.'main_function.php');

	global $woocommerce;

	$current_user_id = $_GET['user'];

	$user_total_point = 0;

	$total_point_reward = 0;

	$used_reward_point = 0;

	$products_order = get_posts( array(
		'numberposts' => -1,
		'meta_key'    => '_customer_user',
		'meta_value'  => $current_user_id,
		'post_type'   => 'shop_order',
		'order'       => 'ASC',
		'post_status' => 'wc-completed',
	));

	//instand point

	//first login point value
	    $phoen_reward_user_first_login_points = (int)get_post_meta($current_user_id,['phoen_reward_points_for_register_user'][0],true);

	    ($phoen_reward_user_first_login_points!='' && $phoen_reward_user_first_login_points!='0') ? $total_point_reward+= $phoen_reward_user_first_login_points : $total_point_reward;

	//birthday point
	    $phoen_reward_user_birthday_gift_point = (int)get_post_meta($current_user_id,'phoeni_rewards_gift_dob_point',true);

	   ($phoen_reward_user_birthday_gift_point!='' && $phoen_reward_user_birthday_gift_point!='0') ? $total_point_reward+= $phoen_reward_user_birthday_gift_point : $total_point_reward;

	//admin point
		$phoni_get_admin_points = (int)get_post_meta($current_user_id,'phoes_customer_points_update_valss',true);

		($phoni_get_admin_points>0 && !empty($phoni_get_admin_points)) ? $total_point_reward+= $phoni_get_admin_points : $total_point_reward;
	

    //referral point

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

		(!empty($phoen_reward_referral_user_pointsss) && $phoen_reward_referral_user_pointsss>0)?$total_point_reward=($total_point_reward+$phoen_reward_referral_user_pointsss):$total_point_reward;
	

		for($i=0;$i<count($products_order);$i++){	
				
			$products_detail=get_post_meta($products_order[$i]->ID); 
					
			$gen_settings=get_post_meta( $products_order[$i]->ID, 'phoe_rewpts_order_status', true );
					
		   	$order_user_id = $ptsperprice=isset($gen_settings['user_id'])?$gen_settings['user_id']:'';
					
			if( (is_array($gen_settings)) && !empty($gen_settings)  ){
						
				$get_reward_point=isset($gen_settings['get_reward_point'])?$gen_settings['get_reward_point']:'';
						
				$used_reward_point = isset($gen_settings['used_reward_point'])?$gen_settings['used_reward_point']:'';

				$phoen_order_point_val=isset($gen_settings['order_point'])?$gen_settings['order_point']:'';

				$payment_gatway_val_exp=isset($gen_settings['payment_gatway_val'])?$gen_settings['payment_gatway_val']:'';

				$phoen_data_reviews_exp = isset($gen_settings['first_comment_rev'])?$gen_settings['first_comment_rev']:'';


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
			}		
		} 

		$user_total_point = $total_point_reward;
?>
<style>
table {
  border-collapse: collapse;
  border-spacing: 0;
  width: 100%;
  border: 1px solid grey;
  width: 100%;
}

th, td {
  text-align: left;
  padding: 8px;
}

tr:nth-child(even){background-color: #f2f2f2}
</style>
<div class="wrap" style="overflow-x:auto;background: white;padding: 15px;">

	<h1 class="wp-heading-inline"><?php _e(get_userdata($current_user_id)->display_name.'\'s point','phoen-rewpts'); ?></h1>

	<a class="page-title-action" href="?page=Phoeniixx_reward_settings&tab=phoen_rewpts_customer"><?php _e('Back To Report','phoen-rewpts');?></a>

	<br /><br />
	
	<table id="example">

	<thead>	

		<tr class="phoen_rewpts_user_reward_point_tr" style="border-bottom: 1px solid grey;">
			
			<th class=" column-customer_name " scope="col"><span><?php _e('Date','phoen-rewpts'); ?></span></th>
			<th class=" column-spent" scope="col"><span><?php _e('Event Name','phoen-rewpts'); ?></span></th>
			<th class=" column-spent" scope="col"><span><?php _e('Order Amount','phoen-rewpts'); ?></span></th>
			<th class=" column-spent" scope="col"><span><?php _e('Credit','phoen-rewpts'); ?></span></th>
			<th class=" column-spent" scope="col"><span><?php _e('Debit','phoen-rewpts'); ?></span></th>
			<th class=" column-spent" scope="col"><span><?php _e('Total Point','phoen-rewpts'); ?></span></th>
			<th class=" column-spent" scope="col"><span><?php _e('Status','phoen-rewpts'); ?></span></th>
			
		</tr>
		
	</thead>
	
		<tbody>	
	
		<?php

		//loop start here for product point

		for($i=count($products_order) - 1 ; $i >= 0; $i--) {

        	$products_detail = get_post_meta($products_order[$i]->ID); 
        
        	$gen_settings = get_post_meta( $products_order[$i]->ID, 'phoe_rewpts_order_status', true );

        	if(!empty($gen_settings)){

            	// echo "<pre>"; print_r($gen_settings);echo "</pre>";

            	$bill_price_checked_value = isset($gen_settings['bill_price_checked_value'])?$gen_settings['bill_price_checked_value']:'';
				
				$get_reward_amount=isset($gen_settings['get_reward_amount'])?$gen_settings['get_reward_amount']:'';
				
				$get_reward_point=isset($gen_settings['get_reward_point'])?$gen_settings['get_reward_point']:'';
				
				$used_reward_point=isset($gen_settings['used_reward_point'])?$gen_settings['used_reward_point']:'';

				$get_payment_gatway_val=isset($gen_settings['payment_gatway_val'])?$gen_settings['payment_gatway_val']:'';

				$first_comment_rev=isset($gen_settings['first_comment_rev'])?$gen_settings['first_comment_rev']:'';

				$first_order_point=isset($gen_settings['order_point'])?$gen_settings['order_point']:'';

				$phoen_complited_date_exp=isset($gen_settings['current_date'])?$gen_settings['current_date']:'';

				if($products_order[$i]->post_status=="wc-completed"){

					$phoen_get_assign_point_date = 'Active';

					if (!empty($get_reward_amount) && $get_reward_point!='0') {

				    ?>
			            <tr>
			            	<td><?= _e($phoen_complited_date_exp) ?></td>
			               	<td><?= _e('Product Purchasing Get Point ','phoen-rewpts'); ?> </td>
			               	<td><?= _e(round($bill_price_checked_value,2)) ?> </td>
			                <td><?= _e(round($get_reward_point,2)) ?></td>
			                <td><?= _e('-'); ?></td>
			                <td>
			                	<?php
			                		
			                		($user_total_point>=0) ? _e(round($user_total_point,2)) : _e(abs(round($user_total_point,2)));

			                		$user_total_point-= $get_reward_point;
			                	?>
			                </td>
			               <td class="assign_date"><?php _e($phoen_get_assign_point_date);?></td>
			            </tr>
					<?php
					}

					if($first_order_point > 0 && !empty($phoen_complited_date_exp)){
					?>
						<tr>
							<td><?php _e($phoen_complited_date_exp) ?></td>
							<td><?php _e('First Order Point','phoen-rewpts'); ?></td>
							<td>-</td>
							<td><?= _e(round($first_order_point,2)) ?></td>
							<td>-</td>
							<td>
			                	<?php
			                		
			                		($user_total_point>=0) ? _e(round($user_total_point,2)) : _e(abs(round($user_total_point)));

			                		$user_total_point-= $first_order_point;
			                	?>
			                </td>
							<td class="assign_date"><?php _e($phoen_get_assign_point_date);?></td>
						</tr>
					<?php
					}

					if(!empty($get_payment_gatway_val) && !empty($phoen_complited_date_exp)){
					?>
						<tr>
							<td><?php _e($phoen_complited_date_exp) ;?></td>
							<td><?php _e('Paypal Payment Point','phoen-rewpts'); ?>  </td>
							<td>-</td>
							<td><?php _e(round($get_payment_gatway_val,2)) ;?></td>
							<td>-</td>
							<td>
			                	<?php
			                		
			                		($user_total_point>=0) ? _e(round($user_total_point,2)) : _e(abs(round($user_total_point)));

			                		$user_total_point-= $get_payment_gatway_val;
			                	?>
			                </td>
							<td class="assign_date"><?php _e($phoen_get_assign_point_date);?></td>
						</tr>
					<?php 
					}

					if(!empty($first_comment_rev) && !empty($phoen_complited_date_exp)){
					?>
						<tr>
							<td><?php _e($phoen_complited_date_exp) ;?></td>
							<td><?php _e('First Product Review Point','phoen-rewpts'); ?> </td>
							<td>-</td>
							<td><?php _e(round($first_comment_rev,2)) ;?></td>
							<td>-</td>
							<td>
			                	<?php
			                		
			                		($user_total_point>=0) ? _e(round($user_total_point,2)) : _e(abs(round($user_total_point)));

			                		$user_total_point-= $first_comment_rev;
			                	?>
			                </td>
							<td class="assign_date"><?php _e($phoen_get_assign_point_date);?></td>
						</tr>
					<?php
					}

				}

				// used point
				if (!empty($used_reward_point) && $used_reward_point!='0') { ?>
		            <tr>
		            	<td><?= _e($phoen_complited_date_exp) ?></td>
		               	<td><?= _e('Product Purchasing Used Point ','phoen-rewpts'); ?> </td>
		               	<td><?= _e(round($bill_price_checked_value,2)) ?> </td>
		                <td><?= _e('-') ?></td>
		                <td><?= _e(round($used_reward_point,2)) ?></td>
		                <td>
		                	<?php
		                		
		                		($user_total_point>=0) ? _e(round($user_total_point,2)) : _e(abs(round($user_total_point,2)));

								$user_total_point+= $used_reward_point;
		                	?>
		                </td>
		               <td class="assign_date"><?php _e('-');?></td>
		            </tr>
				<?php }

			}
		}
		//end loop for product


		//show point referral point
			$phoen_rewards_referral_user_points_date = get_user_meta( $current_user_id, 'phoen_reward_referral_user_date', true );

			$phoen_reward_referral_user_points = get_user_meta( $current_user_id, 'phoen_reward_referral_user_points', true );
			// echo "<pre>";print_r($phoen_reward_referral_user_points);echo "</pre>";
			$phoen_reward_referral_user_id = get_user_meta( $current_user_id, 'phoen_reward_referral_user_id', true );
		
			if(!empty($phoen_reward_referral_user_points))
			{
				for($j=0; $j<count($phoen_reward_referral_user_points); $j++)
				{
					if($phoen_reward_referral_user_id==$current_user_id)
					{	

						?>
						<tr>
							<td><?php echo $phoen_rewards_referral_user_points_date[$j] ;?></td>
							<td><?php _e('Referral Point','phoen-rewpts'); ?> </td>
							<td>-</td>
							<td><?php echo round($phoen_reward_referral_user_points[$j],2) ;?></td>
							<td><?php echo "-"; ?></td>
							<td>
			                	<?php
			                		
			                		($user_total_point>=0) ? _e(round($user_total_point,2)) : _e(abs(round($user_total_point)));

			                		$user_total_point-= $phoen_reward_referral_user_points[$j];
			                	?>
			                </td>
							<td class="assign_date"><?= _e('Active');?></td>
						</tr>
						<?php 
						
					}
						
				}
			}
		//closed here for referral point


		//admin points
			$phoni_get_admin_points = (int)get_post_meta($current_user_id,'phoes_customer_points_update_valss',true);
			
			if($phoni_get_admin_points>0 && !empty($phoni_get_admin_points)){

				$phoeni_phoeni_update_dates_checkeds = date_create(get_post_meta( $current_user_id,'phoeni_update_dates_checkeds',true));

				?>
				<tr>
					<td><?php _e(date_format($phoeni_phoeni_update_dates_checkeds,'d-m-Y'))?></td>
					<td><?php _e(ucwords('Admin Points'),'phoen-rewpts'); ?> </td>
					<td>-</td>
					<td><?php _e(round($phoni_get_admin_points,2))?></td>
					<td></td>
					<td>
	                	<?php
	                		
	                		($user_total_point>=0) ? _e(round($user_total_point,2)) : _e(abs(round($user_total_point)));

	                		$user_total_point-= $phoni_get_admin_points;
	                	?>
	                </td>
					<td class="assign_date"><?= _e('Active');?></td>
				</tr>
				<?php 
			}
		//closed admin points


		//show here for birthday point
			$phoeni_rewards_gift_dob_point_date = get_post_meta($current_user_id,'phoeni_rewards_gift_dob_point_date',true);

			 $phoen_reward_user_birthday_gift_point = (int)get_post_meta($current_user_id,'phoeni_rewards_gift_dob_point',true);

			if($phoen_reward_user_birthday_gift_point!='' && $phoen_reward_user_birthday_gift_point!='0'){
				
				?>
					<tr>
					   	<td><?php echo $phoeni_rewards_gift_dob_point_date  ;?></td>
						<td><?php _e('BirthDay Point','phoen-rewpts'); ?> </td>
						<td>-</td>
						<td><?php echo round($phoen_reward_user_birthday_gift_point,2) ;?></td>
						<td><?php echo "-"; ?></td>
						<td>
		                	<?php
		                		
		                		($user_total_point>=0) ? _e(round($user_total_point,2)) : _e(abs(round($user_total_point)));

		                		$user_total_point-= $phoen_reward_user_birthday_gift_point;
		                	?>
		                </td>
						<td class="assign_date"><?= _e('Active');?></td>
					</tr>
				<?php 
			}
		//closed here for birthday point


		//show point for first signup 
			$phoen_reward_points_for_register_userdate = get_post_meta($current_user_id,'phoen_reward_points_for_register_userdate',true);	
	
			$phoen_reward_points_for_register_user_id = get_post_meta($current_user_id,'phoen_reward_points_for_register_user_id',true);

			$phoen_reward_user_first_login_points = (int)get_post_meta($current_user_id,['phoen_reward_points_for_register_user'][0],true);

			if($phoen_reward_points_for_register_user_id==$current_user_id ) {				

				if($phoen_reward_user_first_login_points!='' && $phoen_reward_user_first_login_points!='0'){

					?>
					<tr>
						<td><?php _e( $phoen_reward_points_for_register_userdate )?></td>
						<td><?php _e('Account Signup point','phoen-rewpts'); ?> </td>
						<td>-</td>
						<td><?php _e(round($phoen_reward_user_first_login_points,2)) ?></td>
						<td></td>
						<td>
		                	<?php
		                		
		                		($user_total_point>=0) ? _e(round($user_total_point,2)) : _e(abs(round($user_total_point)));

		                		$user_total_point-= $phoen_reward_user_first_login_points;
		                	?>
		                </td>
						<td class="assign_date"><?= _e('Active');?></td>
					</tr>
					<?php 
				}
			}
		//closed here for first point

		
		
		?>
		</tbody>
		
		<tfoot>
				
			<tr class="phoen_rewpts_user_reward_point_tr" style="background: #f7f5f7">
			
				<th class=" column-customer_name " scope="col"><span><?php _e(' Date','phoen-rewpts'); ?></span></th>
				<th class=" column-spent" scope="col"><span><?php _e('Event Name','phoen-rewpts'); ?></span></th>
				<th class=" column-spent" scope="col"><span><?php _e('Order Amount','phoen-rewpts'); ?></span></th>
				<th class=" column-spent" scope="col"><span><?php _e('Credit','phoen-rewpts'); ?></span></th>
				<th class=" column-spent" scope="col"><span><?php _e('Debit','phoen-rewpts'); ?></span></th>
				<th class=" column-spent" scope="col"><span><?php _e('Total Point','phoen-rewpts'); ?></span></th>
				<th class=" column-spent" scope="col"><span><?php _e('Status','phoen-rewpts'); ?></span></th>

			</tr>
	
		</tfoot>
	
</table>
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.24/css/jquery.dataTables.min.css">
</div>
<script type="text/javascript" src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
<script>
	$(document).ready(function() {

	    $('#example').DataTable( {
	    	 "pageLength": 20,      
	         "searching": false,
	         "info": false,         
	         "lengthChange":false,
	         "ordering": false
	    });

	} );


</script>