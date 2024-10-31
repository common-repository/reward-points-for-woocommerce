<?php

defined( 'ABSPATH' ) || exit;

$phoen_rewts_order_point_mail_heading_color = unserialize (HEADING_COLOR);
$phoen_rewts_order_point_mail_heading 		= unserialize (ORDER_HEADING);
$phoen_rewts_order_point_mail_message 		= unserialize (ORDER_MESSAGE);

$order_id 									= unserialize (ORDER_ID);
$user_id 									= unserialize (USER_ID);
$phoen_current_dates_update 				= unserialize (ORDER_DATE);
$bill_price 								= unserialize (ORDER_AMOUNT);
$total_earn_point 							= unserialize (TOTAL_EARN_POINT);
?>

<div marginwidth="0" marginheight="0" style="padding:0">
	<div dir="ltr" style="background-color:#f5f4f4;margin:0;padding:70px 0;width:100%">
		<table border="0" cellpadding="0" cellspacing="0" height="100%" width="100%">
		<tbody>
			<tr>
				<td align="center" valign="top">
						
				<table border="0" cellpadding="0" cellspacing="0" width="600" style="background-color:#ffffff;border:1px solid #dcdcdc;border-radius:3px">
				<tbody>
					<tr>
						<td align="center" valign="top">
									
						<table border="0" cellpadding="0" cellspacing="0" width="100%" id="m_119838982930841718template_header" style="background-color:<?php (!empty($phoen_rewts_order_point_mail_heading_color))?_e($phoen_rewts_order_point_mail_heading_color):'red'; ?>;color:#202020;border-bottom:0;font-weight:bold;line-height:100%;vertical-align:middle;font-family:&quot;Helvetica Neue&quot;,Helvetica,Roboto,Arial,sans-serif;border-radius:3px 3px 0 0">
						<tbody>
							<tr>
								<td id="m_119838982930841718header_wrapper" style="padding:36px 48px;display:block">
												
									<h1 style="font-family:&quot;Helvetica Neue&quot;,Helvetica,Roboto,Arial,sans-serif;font-size:30px;font-weight:300;line-height:150%;margin:0;text-align:left;color:#202020;">
										<?php (!empty($phoen_rewts_order_point_mail_heading))?_e($phoen_rewts_order_point_mail_heading):'Your Reward Point Recent Purchasing Order'?>
									</h1>
											
								</td>
							</tr>
						</tbody>
						</table>

						</td>
					</tr>

					<tr>
						<td align="center" valign="top">
									
						<table border="0" cellpadding="0" cellspacing="0" width="600" id="m_119838982930841718template_body"><tbody><tr>
							<td valign="top" id="m_119838982930841718body_content" style="background-color:#ffffff">
												
							<table border="0" cellpadding="20" cellspacing="0" width="100%">
							<tbody>
								<tr>
									<td valign="top" style="padding:48px 48px 32px">
														
									<div id="m_119838982930841718body_content_inner" style="color:#636363;font-family:&quot;Helvetica Neue&quot;,Helvetica,Roboto,Arial,sans-serif;font-size:14px;line-height:150%;text-align:left">
											<h2 style="color:#5a114c;display:block;font-family:&quot;Helvetica Neue&quot;,Helvetica,Roboto,Arial,sans-serif;font-size:15px;font-weight:bold;line-height:130%;margin:0 0 18px;text-align:left">

												<p style="margin:0 0 16px">Hi, <?php _e(get_user_by( 'id', $user_id )->display_name); ?> </p>
												<p style="margin:0 0 16px">Your Order ID : <?php (isset($order_id))?_e($order_id):''; ?> </p>
											</h2>
									<div style="margin-bottom:40px">
	
									<table cellspacing="0" cellpadding="6" border="1" style="color:#636363;border:1px solid #e5e5e5;vertical-align:middle;width:100%;font-family:'Helvetica Neue',Helvetica,Roboto,Arial,sans-serif">
									<thead>
										<tr style="background:#eac1c1;">
											<th scope="col" style="color:#231919;border:1px solid #e5e5e5;vertical-align:middle;padding:12px;text-align:left">
												<span><?php _e('Date','phoen-rewpts'); ?></span>
											</th>
													
											<th scope="col" style="color:#231919;border:1px solid #e5e5e5;vertical-align:middle;padding:12px;text-align:left">
												<span><?php _e('Event Name','phoen-rewpts'); ?></span>
											</th>

											<th scope="col" style="color:#231919;border:1px solid #e5e5e5;vertical-align:middle;padding:12px;text-align:left">
												<span><?php _e('Order Amount','phoen-rewpts'); ?></span>
											</th>
											<th scope="col" style="color:#231919;border:1px solid #e5e5e5;vertical-align:middle;padding:12px;text-align:left">
												<span><?php _e('Point','phoen-rewpts'); ?></span>
											</th>
										</tr>
									</thead>
													
									<tbody>	
									<?php if(is_array($total_earn_point)): ?>

										<?php if(!empty($total_earn_point[0]['get_reward_point'])) { ?>

											<?php $total_point = $total_earn_point[0]['get_reward_point']; ?>
											<tr>
												<td style="color:#231919;border:1px solid #e5e5e5;padding:12px;text-align:left;vertical-align:middle;font-family:'Helvetica Neue',Helvetica,Roboto,Arial,sans-serif;word-wrap:break-word"> <?php (isset($phoen_current_dates_update))? _e($phoen_current_dates_update):''; ?>
												</td>

												<td style="color:#231919;border:1px solid #e5e5e5;padding:12px;text-align:left;vertical-align:middle;font-family:'Helvetica Neue',Helvetica,Roboto,Arial,sans-serif"> <?php _e('Purchasing Point'); ?>
												</td>

												<td style="color:#231919;border:1px solid #e5e5e5;padding:12px;text-align:left;vertical-align:middle;font-family:'Helvetica Neue',Helvetica,Roboto,Arial,sans-serif"> <?php (isset($bill_price))? _e($bill_price):''; ?>
												</td>
												<td style="color:#231919;border:1px solid #e5e5e5;padding:12px;text-align:left;vertical-align:middle;font-family:'Helvetica Neue',Helvetica,Roboto,Arial,sans-serif"> <?php _e($total_earn_point[0]['get_reward_point']); ?>
												</td>
											</tr>
										<?php } ?>

										<?php if(!empty($total_earn_point[1]['order_point'])) { ?>

											<?php $total_point+= $total_earn_point[1]['order_point']; ?>
											<tr>
												<td style="color:#231919;border:1px solid #e5e5e5;padding:12px;text-align:left;vertical-align:middle;font-family:'Helvetica Neue',Helvetica,Roboto,Arial,sans-serif;word-wrap:break-word"> <?php (isset($phoen_current_dates_update))? _e($phoen_current_dates_update):''; ?>
												</td>

												<td style="color:#231919;border:1px solid #e5e5e5;padding:12px;text-align:left;vertical-align:middle;font-family:'Helvetica Neue',Helvetica,Roboto,Arial,sans-serif"> <?php _e('First Order Point'); ?>
												</td>

												<td style="color:#231919;border:1px solid #e5e5e5;padding:12px;text-align:left;vertical-align:middle;font-family:'Helvetica Neue',Helvetica,Roboto,Arial,sans-serif"> <?php _e('-'); ?>
												</td>
												<td style="color:#231919;border:1px solid #e5e5e5;padding:12px;text-align:left;vertical-align:middle;font-family:'Helvetica Neue',Helvetica,Roboto,Arial,sans-serif"> <?php _e($total_earn_point[1]['order_point']); ?>
												</td>
											</tr>
										<?php } ?>


										<?php if(!empty($total_earn_point[2]['use_payment_gateway_val'])) { ?>

											<?php $total_point+= $total_earn_point[2]['use_payment_gateway_val']; ?>

											<tr>
												<td style="color:#231919;border:1px solid #e5e5e5;padding:12px;text-align:left;vertical-align:middle;font-family:'Helvetica Neue',Helvetica,Roboto,Arial,sans-serif;word-wrap:break-word"> <?php (isset($phoen_current_dates_update))? _e($phoen_current_dates_update):''; ?>
												</td>

												<td style="color:#231919;border:1px solid #e5e5e5;padding:12px;text-align:left;vertical-align:middle;font-family:'Helvetica Neue',Helvetica,Roboto,Arial,sans-serif"> <?php _e('PayPal Payement Point'); ?>
												</td>

												<td style="color:#231919;border:1px solid #e5e5e5;padding:12px;text-align:left;vertical-align:middle;font-family:'Helvetica Neue',Helvetica,Roboto,Arial,sans-serif"> <?php _e('-'); ?>
												</td>
												<td style="color:#231919;border:1px solid #e5e5e5;padding:12px;text-align:left;vertical-align:middle;font-family:'Helvetica Neue',Helvetica,Roboto,Arial,sans-serif"> <?php _e($total_earn_point[2]['use_payment_gateway_val']); ?>
												</td>
											</tr>
										<?php } ?>


										<?php if(!empty($total_earn_point[3]['phoen_data_reviews'])) { ?>

											<?php $total_point+= $total_earn_point[3]['phoen_data_reviews']; ?>
											<tr>
												<td style="color:#231919;border:1px solid #e5e5e5;padding:12px;text-align:left;vertical-align:middle;font-family:'Helvetica Neue',Helvetica,Roboto,Arial,sans-serif;word-wrap:break-word"> <?php (isset($phoen_current_dates_update))? _e($phoen_current_dates_update):''; ?>
												</td>

												<td style="color:#231919;border:1px solid #e5e5e5;padding:12px;text-align:left;vertical-align:middle;font-family:'Helvetica Neue',Helvetica,Roboto,Arial,sans-serif"> <?php _e('Review Point'); ?>
												</td>

												<td style="color:#231919;border:1px solid #e5e5e5;padding:12px;text-align:left;vertical-align:middle;font-family:'Helvetica Neue',Helvetica,Roboto,Arial,sans-serif"> <?php _e('-'); ?>
												</td>
												<td style="color:#231919;border:1px solid #e5e5e5;padding:12px;text-align:left;vertical-align:middle;font-family:'Helvetica Neue',Helvetica,Roboto,Arial,sans-serif"> <?php _e($total_earn_point[3]['phoen_data_reviews']); ?>
												</td>
											</tr>
										<?php } ?>


										<?php if(!empty($total_earn_point[4]['points_range'])) { ?>

											<?php $total_point+= $total_earn_point[4]['points_range']; ?>
											<tr>
												<td style="color:#231919;border:1px solid #e5e5e5;padding:12px;text-align:left;vertical-align:middle;font-family:'Helvetica Neue',Helvetica,Roboto,Arial,sans-serif;word-wrap:break-word"> <?php (isset($phoen_current_dates_update))? _e($phoen_current_dates_update):''; ?>
												</td>

												<td style="color:#231919;border:1px solid #e5e5e5;padding:12px;text-align:left;vertical-align:middle;font-family:'Helvetica Neue',Helvetica,Roboto,Arial,sans-serif"> <?php _e('Bonus Point'); ?>
												</td>

												<td style="color:#231919;border:1px solid #e5e5e5;padding:12px;text-align:left;vertical-align:middle;font-family:'Helvetica Neue',Helvetica,Roboto,Arial,sans-serif"> <?php _e('-'); ?>												
												</td>
												<td style="color:#231919;border:1px solid #e5e5e5;padding:12px;text-align:left;vertical-align:middle;font-family:'Helvetica Neue',Helvetica,Roboto,Arial,sans-serif"> <?php _e($total_earn_point[4]['points_range']); ?>
												</td>
											</tr>
										<?php } ?>


										<?php if(!empty($total_earn_point[5]['order_shipping'])) { ?>

											<?php $total_point+= $total_earn_point[5]['order_shipping']; ?>
											<tr>
												<td style="color:#231919;border:1px solid #e5e5e5;padding:12px;text-align:left;vertical-align:middle;font-family:'Helvetica Neue',Helvetica,Roboto,Arial,sans-serif;word-wrap:break-word"> <?php (isset($phoen_current_dates_update))? _e($phoen_current_dates_update):''; ?>
												</td>

												<td style="color:#231919;border:1px solid #e5e5e5;padding:12px;text-align:left;vertical-align:middle;font-family:'Helvetica Neue',Helvetica,Roboto,Arial,sans-serif"> <?php _e('Shipping Point'); ?>
												</td>

												<td style="color:#231919;border:1px solid #e5e5e5;padding:12px;text-align:left;vertical-align:middle;font-family:'Helvetica Neue',Helvetica,Roboto,Arial,sans-serif"> <?php _e('-'); ?>
												</td>
												<td style="color:#231919;border:1px solid #e5e5e5;padding:12px;text-align:left;vertical-align:middle;font-family:'Helvetica Neue',Helvetica,Roboto,Arial,sans-serif"> <?php _e($total_earn_point[5]['order_shipping']); ?>
												</td>
											</tr>
										<?php } ?>


										<?php if(!empty($total_earn_point[6]['order_tax'])) { ?>

											<?php $total_point+= $total_earn_point[6]['order_tax']; ?>
											<tr>
												<td style="color:#231919;border:1px solid #e5e5e5;padding:12px;text-align:left;vertical-align:middle;font-family:'Helvetica Neue',Helvetica,Roboto,Arial,sans-serif;word-wrap:break-word"> <?php (isset($phoen_current_dates_update))? _e($phoen_current_dates_update):''; ?>
												</td>

												<td style="color:#231919;border:1px solid #e5e5e5;padding:12px;text-align:left;vertical-align:middle;font-family:'Helvetica Neue',Helvetica,Roboto,Arial,sans-serif"> <?php _e('Tax Point'); ?>
												</td>

												<td style="color:#231919;border:1px solid #e5e5e5;padding:12px;text-align:left;vertical-align:middle;font-family:'Helvetica Neue',Helvetica,Roboto,Arial,sans-serif"> <?php _e('-'); ?>
												</td>
												<td style="color:#231919;border:1px solid #e5e5e5;padding:12px;text-align:left;vertical-align:middle;font-family:'Helvetica Neue',Helvetica,Roboto,Arial,sans-serif"> <?php _e($total_earn_point[6]['order_tax']); ?>
												</td>
											</tr>
										<?php } ?>


										<?php if(!empty($total_earn_point[7]['used_reward_point'])) { ?>

											<tr>
												<td style="color:#231919;border:1px solid #e5e5e5;padding:12px;text-align:left;vertical-align:middle;font-family:'Helvetica Neue',Helvetica,Roboto,Arial,sans-serif;word-wrap:break-word"> <?php (isset($phoen_current_dates_update))? _e($phoen_current_dates_update):''; ?>
												</td>

												<td style="color:#231919;border:1px solid #e5e5e5;padding:12px;text-align:left;vertical-align:middle;font-family:'Helvetica Neue',Helvetica,Roboto,Arial,sans-serif"> <?php _e('Used Point'); ?>
												</td>

												<td style="color:#231919;border:1px solid #e5e5e5;padding:12px;text-align:left;vertical-align:middle;font-family:'Helvetica Neue',Helvetica,Roboto,Arial,sans-serif"> <?php _e('-'); ?>
												</td>
												<td style="color:#231919;border:1px solid #e5e5e5;padding:12px;text-align:left;vertical-align:middle;font-family:'Helvetica Neue',Helvetica,Roboto,Arial,sans-serif"> <?php _e($total_earn_point[7]['used_reward_point']); ?>
												</td>
											</tr>
										<?php } ?>


											<tr style="background:#eac1c1;font-weight: bold;">
												<td colspan="3" style="color:#231919;border:1px solid #e5e5e5;padding:12px;text-align:left;vertical-align:middle;font-family:'Helvetica Neue',Helvetica,Roboto,Arial,sans-serif;word-wrap:break-word"> <?php _e('Total Earn Point On Purchasing Current Product')?>
												</td>

												<td style="color:#231919;border:1px solid #e5e5e5;padding:12px;text-align:left;vertical-align:middle;font-family:'Helvetica Neue',Helvetica,Roboto,Arial,sans-serif"> <?php _e(round($total_point)) ?>
												</td>
											</tr>
												

									<?php endif; ?>
									</tbody>

									</table>
									</div>
									<p><?php _e($phoen_rewts_order_point_mail_message) ?></p>
									<table class="wrapper" width="100%" cellspacing="0" cellpadding="0" border="0" bgcolor="#ffffff">
									<tbody>
										<tr>
											<td height="60" valign="top" align="center">

											<table width="100%" cellspacing="0" cellpadding="0" border="0" align="center">
											<tbody>
												<tr>	
													<td width="90" bgcolor="#ffffff">&nbsp;
													</td>
													
													<td style="border:3px solid #2b870c;" height="35" width="200" bgcolor="#3b941e" align="center">
														<a href="<?php echo $_SERVER['SERVER_NAME'].'/shop'; ?>" style="font-family:Verdana, Geneva, sans-serif;font-size:15px;color:#ffffff;text-transform:uppercase;text-decoration:none;font-weight:bold;letter-spacing:1px;" class="button480content" target="_blank">CONTINUE SHOPPING &#187;
														</a>
													</td>

													<td width="90" bgcolor="#ffffff">&nbsp;
													</td>
												</tr>
											</tbody>
											</table>
											</td>
										</tr>
									</tbody>
									</table>
									</div>
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
</table>
</div>
</div>
</body>
</html>