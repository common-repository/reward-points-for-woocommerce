<?php if ( ! defined( 'ABSPATH' ) ) exit;
	
if ( ! empty( $_POST ) && check_admin_referer( 'phoen_rewpts_form_action', 'phoen_rewpts_form_action_form_nonce_field' ) ) {


	$enable_plugin_myaccount = ( isset( $_POST['enable_plugin_myaccount'] ) ? sanitize_text_field( $_POST['enable_plugin_myaccount'] ) : "" );
	
		
	$enable_plugin_dob_date = ( isset( $_POST['enable_plugin_dob_date'] ) ? sanitize_text_field( $_POST['enable_plugin_dob_date'] ) : "" );
	
	
	$enable_plugin_reff_code = ( isset( $_POST['enable_plugin_reff_code'] ) ? sanitize_text_field( $_POST['enable_plugin_reff_code'] ) : "" );


	$show_points_with_order_history = ( isset( $_POST['show_points_with_order_history'] ) ? sanitize_text_field( $_POST['show_points_with_order_history'] ) : "" );


	$enable_points_with_order_details_sending_email = ( isset( $_POST['enable_points_with_order_details_sending_email'] ) ? sanitize_text_field( $_POST['enable_points_with_order_details_sending_email'] ) : "" );
	
		
	$phoen_rewpts_get_basic_setting_data = array(
	
		'enable_plugin'									=>'1',
		
		'enable_plugin_myaccount'						=>$enable_plugin_myaccount,
		
		'enable_plugin_dob_date'						=>$enable_plugin_dob_date,
		
		'enable_plugin_reff_code'						=>$enable_plugin_reff_code,
		
		'show_points_with_order_history'				=>$show_points_with_order_history,

		'enable_points_with_order_details_sending_email'=>$enable_points_with_order_details_sending_email,

	);
		
	update_option('phoe_rewpts_page_settings_value',$phoen_rewpts_get_basic_setting_data);?>

	<div class="updated notice is-dismissible below-h2" id="message"><p>Successfully Saved Data. </p></div>

<?php } $gen_settings = get_option('phoe_rewpts_page_settings_value'); ?>

<div id="phoeniixx_phoe_book_wrap_profile-page" style="background:white;padding: 10px;margin-top: 2%;"  class=" phoeniixx_phoe_book_wrap_profile_div">
	
	<form method="post" id="phoeniixx_phoe_book_wrap_profile_form" action="" >
	
		<?php wp_nonce_field( 'phoen_rewpts_form_action', 'phoen_rewpts_form_action_form_nonce_field' ); ?>
		
		<table class="form-table" >

			<!-- <h2 style="color: #58504d;border-bottom: 1px solid #ccbbb6;"><?= _e('General Settings') ?></h2> -->
			
			<tbody>	

				<tr class="phoeniixx_phoe_rewpts_wrap phoen-user-user-login-wrap">
			
					<th>
					
						<label><?php _e('Enable Birthday Points','phoen-rewpts'); ?> </label>
						
					</th>
					
					<td>
					
						<input type="checkbox"  name="enable_plugin_dob_date" id="enable_plugin_dob_date" value="1" <?php echo(isset($gen_settings['enable_plugin_dob_date']) && $gen_settings['enable_plugin_dob_date'] == '1')?'checked':'';?>>
						
						<p style="font-size: 13px;line-height: 20px;margin-top: 10px;color: #716269;">Enable to show birthday field on woocommerce registeration page and get points during on birthday </p>
					</td>
					
				</tr>
				
				<tr class="phoeniixx_phoe_rewpts_wrap phoen-user-user-login-wrap">
			
					<th>
					
						<label><?php _e('Enable Referral Points','phoen-rewpts'); ?> </label>
						
					</th>
					
					<td>
					
						<input type="checkbox"  name="enable_plugin_reff_code" id="enable_plugin_reff_code" value="1" <?php echo(isset($gen_settings['enable_plugin_reff_code']) && $gen_settings['enable_plugin_reff_code'] == '1')?'checked':'';?>>
						
						<p style="font-size: 13px;line-height: 20px;margin-top: 10px;color: #716269;">Enable to show referral field on woocommerce registration page and get points while on registration</p>
					</td>
					
				</tr>
				
				<tr class="phoeniixx_phoe_rewpts_wrap phoen-user-user-login-wrap">
			
					<th>
					
						<label><?php _e('Enable To Show Customer Points','phoen-rewpts'); ?> </label>
						
					</th>
					
					<td>
					
						<input type="checkbox"  name="enable_plugin_myaccount" id="enable_plugin_myaccount" value="1" <?php echo(isset($gen_settings['enable_plugin_myaccount']) && $gen_settings['enable_plugin_myaccount'] == '1')?'checked':'';?>>

						<p style="font-size: 13px;line-height: 20px;margin-top: 10px;color: #716269;">Enable to show point's table on my account page</p>
				
					</td>
					
				</tr>

				<tr class="phoeniixx_phoe_rewpts_wrap phoen-user-user-login-wrap">
			
					<th>
					
						<label><?php _e('Enable To Show Points with Order Details','phoen-rewpts'); ?> </label>
						
					</th>
					
					<td>
					
						<input type="checkbox"  name="show_points_with_order_history" id="show_points_with_order_history" value="1" <?php echo(isset($gen_settings['show_points_with_order_history']) && $gen_settings['show_points_with_order_history'] == '1')?'checked':'';?>>
						
						<p style="font-size: 13px;line-height: 20px;margin-top: 10px;color: #716269;">Show points according to order in order history</p>
						
					</td>
					<td></td>
					
				</tr>

				<tr class="phoeniixx_phoe_rewpts_wrap phoen-user-user-login-wrap">
				
						<th>
						
							<label><?php _e('Enable To Show Points Via Mail','phoen-rewpts'); ?> </label>
							
						</th>
						
						<td>
						
							<input type="checkbox"  name="enable_points_with_order_details_sending_email" id="enable_points_with_order_details_sending_email" value="1" <?php echo(isset($gen_settings['enable_points_with_order_details_sending_email']) && $gen_settings['enable_points_with_order_details_sending_email'] == '1')?'checked':'';?>> 

							<p style="font-size: 13px;line-height: 20px;margin-top: 10px;color: #716269;">Enable to send points via email when order is placed</p>
							
						</td>
						<td></td>
						
					</tr>
				
				<tr class="phoeniixx_phoe_rewpts_wrap phoen-user-user-login-wrap">
				
					<td colspan="2">
					
						<input type="submit" value="<?php _e('Save','phoen-rewpts'); ?>" name="rewpts_submit" id="submit" class="button button-primary">
					
					</td>
					
				</tr>
	
			</tbody>
			
		</table>
		
	</form>
	
</div>