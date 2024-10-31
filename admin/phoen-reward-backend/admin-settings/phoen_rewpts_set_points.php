<?php if ( ! defined( 'ABSPATH' ) ) exit;

$data = array();
	
if ( ! empty( $_POST ) && check_admin_referer( 'phoen_rewpts_set_point_form_action', 'phoen_rewpts_set_point_form_action_form_nonce_field' ) ) {

	if(isset($_POST['phoen_rewpts_set_point_submit'] )){

		// GET ONLY GENERAL POINT DATA
		$reward_money    = (isset($_POST['reward_money_all']))?sanitize_text_field( $_POST['reward_money_all'] ):'1';

		$reward_point    = (isset($_POST['reward_point_all']))?sanitize_text_field( $_POST['reward_point_all'] ):'1';

		if(!empty($reward_point) && !empty($reward_money)){
			$data['all_user'] =  array(

				'reward_money'=>$reward_money,
				'reward_point'=>$reward_point
			);
		}

		$reedem_point    = (isset($_POST['reedem_point']))?sanitize_text_field( $_POST['reedem_point'] ):'0';

		$reedem_money    = (isset($_POST['reedem_money']))?sanitize_text_field( $_POST['reedem_money'] ):'0';

		$first_login_points    = (isset($_POST['first_login_points']))?sanitize_text_field( $_POST['first_login_points'] ):'0';

		$link_referral_points    = (isset($_POST['link_referral_points']))?sanitize_text_field( $_POST['link_referral_points'] ):'0';
		
		$first_order_points    = (isset($_POST['first_order_points']))?sanitize_text_field( $_POST['first_order_points'] ):'0';
		
		$first_review_points    = (isset($_POST['first_review_points']))?sanitize_text_field( $_POST['first_review_points'] ):'0';
		
		$use_payment_gateway    = (isset($_POST['use_payment_gateway']))?sanitize_text_field( $_POST['use_payment_gateway'] ):'0';
		
		$gift_birthday_points    = (isset($_POST['gift_birthday_points']))?sanitize_text_field( $_POST['gift_birthday_points'] ):'0';
		

		$phoe_rewpts_value = array(

			'point_type'			=> 'fixed_price',

			'user'					=> 'all_user',
			
			'reward_point_data' 	=> $data,
			
			'reedem_point'			=>$reedem_point,
			
			'reedem_money'			=>$reedem_money,
			
			'first_login_points'	=>$first_login_points,
			
			'link_referral_points'	=>$link_referral_points,
			
			'first_order_points'	=>$first_order_points,
			
			'first_review_points'	=>$first_review_points,
			
			'use_payment_gateway'	=>$use_payment_gateway,
			
			'gift_birthday_points'	=>$gift_birthday_points,
		);
		
		update_option('phoe_set_point_value',$phoe_rewpts_value);
	}
	
}


$phoen_rewpts_set_point_data = get_option('phoe_set_point_value',true);

$reedem_point = (isset($phoen_rewpts_set_point_data['reedem_point']))?sanitize_text_field( $phoen_rewpts_set_point_data['reedem_point'] ):'0';

$reedem_money = (isset($phoen_rewpts_set_point_data['reedem_money']))?sanitize_text_field( $phoen_rewpts_set_point_data['reedem_money'] ):'0';

$first_login_points = (isset($phoen_rewpts_set_point_data['first_login_points']))?sanitize_text_field( $phoen_rewpts_set_point_data['first_login_points'] ):'0';

$link_referral_points = (isset($phoen_rewpts_set_point_data['link_referral_points']))?sanitize_text_field( $phoen_rewpts_set_point_data['link_referral_points'] ):'0';

$first_order_points = (isset($phoen_rewpts_set_point_data['first_order_points']))?sanitize_text_field( $phoen_rewpts_set_point_data['first_order_points'] ):'0';

$first_review_points = (isset($phoen_rewpts_set_point_data['first_review_points']))?sanitize_text_field( $phoen_rewpts_set_point_data['first_review_points'] ):'0';

$use_payment_gateway = (isset($phoen_rewpts_set_point_data['use_payment_gateway']))?sanitize_text_field( $phoen_rewpts_set_point_data['use_payment_gateway'] ):'0';

$gift_birthday_points = (isset($phoen_rewpts_set_point_data['gift_birthday_points']))?sanitize_text_field( $phoen_rewpts_set_point_data['gift_birthday_points'] ):'0';

?>

<div id="phoeniixx_phoe_book_wrap_profile-page" style="background:white;padding: 10px;margin-top: 2%;"  class=" phoeniixx_phoe_book_wrap_profile_div">

	<form method="post" id="phoeniixx_phoe_book_wrap_profile_form" action="" >
	
		<?php wp_nonce_field( 'phoen_rewpts_set_point_form_action', 'phoen_rewpts_set_point_form_action_form_nonce_field' ); ?>


		<table class="form-table">

			<h2 style="color:#58504d;border-bottom: 1px solid #ccbbb6;"><?= _e("Set User's Get Points")?></h2>

			<tbody>

				<tr class="phoeniixx_phoe_rewpts_wrap phoen-user-user-login-wrap" id="phoen_rewpts_point_type_div2">
			
					<th>
						<?php  $curr=get_woocommerce_currency_symbol(); ?>
						
						<label><?php _e('Get Points For All User','phoen-rewpts'); ?> </label>
					</th>
					
					<td>
						<?php

						$reward_money_all = (isset($phoen_rewpts_set_point_data['reward_point_data']['all_user']['reward_money']))?sanitize_text_field( $phoen_rewpts_set_point_data['reward_point_data']['all_user']['reward_money'] ):'';

						$reward_point_all = (isset($phoen_rewpts_set_point_data['reward_point_data']['all_user']['reward_point']))?sanitize_text_field( $phoen_rewpts_set_point_data['reward_point_data']['all_user']['reward_point'] ):'';

						?>
						
						<input type="number" min="0" step="any" class="reward_money_all"  name="reward_money_all" value="<?= _e($reward_money_all) ?>"><?php echo  $curr; ?> =
						

						<input style="margin-left: 10%;" type="number" min="0" step="any" class="reward_point_all" name="reward_point_all" value="<?php _e($reward_point_all) ?>" ><?php _e('Points','phoen-rewpts'); ?>

						<p style="font-size: 13px;line-height: 20px;margin-top: 10px;color: #716269;"><?= _e('points will show/get based on actual product price not for cart total.')?></p>	
					</td>
				</tr>
			</tbody>
		</table>

		<table class="form-table" >

			<h2 style="color:#58504d;border-bottom: 1px solid #ccbbb6;"><?= _e("Set User's Redeem Points")?></h2>
			
			<tbody>

				<tr class="phoeniixx_phoe_rewpts_wrap phoen-user-user-login-wrap">
			
					<th>
						<?php  $curr=get_woocommerce_currency_symbol(); ?>
						
						<label><?php _e('Redemption Value','phoen-rewpts'); ?> </label>
						
					</th>

						<td>
							<input required type="number" min="0" step="any" class="reedem_point" name="reedem_point" value="<?php echo $reedem_point; ?>" ><?php _e('Points =','phoen-rewpts'); ?>
						
							<input style="margin-left: 6%;" required type="number" min="0" step="any" name="reedem_money" class="reedem_money" value="<?php echo $reedem_money; ?>" >
					
							<?php echo $curr; ?>
					
					</td>
					
				</tr>

			</tbody>

		</table><br><br>


		<table class="form-table">

			<h2 style="color:#58504d;border-bottom: 1px solid #ccbbb6;"><?= _e("Set Extra Points For User's")?></h2>
			<tbody>
				
				<tr class="phoeniixx_phoe_rewpts_wrap phoen-user-user-login-wrap">
			
					<th>
						<label><?php _e('First Account SignUp Points','phoen-rewpts'); ?> </label>
					</th>
					
					<td>
					
						<input type="number" min="0" step="any" name="first_login_points" class="first_login_points" value="<?php echo $first_login_points; ?>" >
					
					</td>
					
				</tr>

				<tr class="phoeniixx_phoe_rewpts_wrap phoen-user-user-login-wrap">
			
					<th>
						<label><?php _e('Referral Points','phoen-rewpts'); ?></label>
					</th>
					
					<td>
					
						<input type="number" min="0" step="any" name="link_referral_points" class="link_referral_points" value="<?php echo $link_referral_points; ?>" >
					
					</td>
					
				</tr>
				
				<tr class="phoeniixx_phoe_rewpts_wrap phoen-user-user-login-wrap">
			
					<th>
						<label><?php _e('First Order Points','phoen-rewpts'); ?></label>
					</th>
					
					<td>
					
						<input type="number"  min="0" step="any" name="first_order_points" class="first_order_points" value="<?php echo $first_order_points; ?>" >
					
					</td>
					
				</tr>
				
				<tr class="phoeniixx_phoe_rewpts_wrap phoen-user-user-login-wrap">
			
					<th>
						<label><?php _e('First Review Points','phoen-rewpts'); ?></label>
					</th>
					
					<td>
					
						<input type="number" min="0" step="any" name="first_review_points" class="first_review_points" value="<?php echo $first_review_points; ?>" >
					
					</td>
					
				</tr>
				
				
				<tr class="phoeniixx_phoe_rewpts_wrap phoen-user-user-login-wrap">
			
					<th>
						<label><?php _e('Use Payment Gateway Points (Only For Pay Pal ) ','phoen-rewpts'); ?></label>
					</th>
					
					<td>
					
						<input type="number" min="0" step="any" name="use_payment_gateway" class="use_payment_gateway" value="<?php echo $use_payment_gateway; ?>" > 
						
					</td>
					
				</tr>
				
				<tr class="phoeniixx_phoe_rewpts_wrap phoen-user-user-login-wrap">
			
					<th>
						<label><?php _e('Gift Birthday Points','phoen-rewpts'); ?></label>
					</th>
					
					<td>
					
						<input type="number" min="0" step="any" name="gift_birthday_points" class="gift_birthday_points" value="<?php echo $gift_birthday_points; ?>" >
					
					</td>
					
				</tr>

				<tr class="phoeniixx_phoe_rewpts_wrap phoen-user-user-login-wrap">
			
					<td colspan="2">
					
						<input  type="submit" value="Save" name="phoen_rewpts_set_point_submit" id="submit" class="button button-primary">
					
					</td>
				
				</tr>	
				
			</tbody>

		</table>

	</form>

</div>