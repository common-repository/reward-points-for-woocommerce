<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css" rel="stylesheet" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>
<div id="phoeniixx_phoe_book_wrap_profile-page" style="background:white;padding: 10px;margin-top: 2%;"  class=" phoeniixx_phoe_book_wrap_profile_div">
		
	<form method="post" name="phoen_woo_btncreate">
				
		<table class="form-table">

			<h2 style="color: #58504d;border-bottom: 1px solid #ccbbb6;"><?= _e('Available Features On Our Premium Reward Points Plugin') ?></h2>
		
			<tbody>

				<table class="form-table">
					<tr class="phoeniixx_phoe_rewpts_wrap phoen-user-user-login-wrap">
    					<th>
    						<label><?= _e(ucwords('if you want to purchase premium version , click go to premium link'),'phoen-rewpts') ?></label>
    					</th>
    					<td>
    						<a style="border:1px solid #eaea8c;padding:8px;background:#eaea8c;text-decoration: none;" target="_blank" href="https://www.phoeniixx.com/product/reward-points-for-woocommerce/?utm_source=Wordpress&utm_medium=cpc&utm_campaign=Free%20Reward%20Point&utm_term=Free%20Reward%20Point&utm_content=Free%20Reward%20Point">Go To Premium</a> 
    					</td>
	                </tr>
	    		</table>

	    		<h2 style="color: #58504d;border-bottom: 1px solid #ccbbb6;">General Setting Features</h2>

	    		<table class="form-table">

	    			<tr class="phoeniixx_phoe_rewpts_wrap phoen-user-user-login-wrap">
						<th>
							<label><?php _e('Assign Points When','phoen-rewpts'); ?> </label>
						</th>
							
						<td>
							<select id="multiple" name="assign_point_when_order_status[]" class="js-example-responsive" multiple="multiple" style="width: 75%">

								<option value="wc-completed" selected ><?= _e('Complete ')?></option>
								
								<option value="wc-processing"><?= _e('Processing ')?></option>

								<option value="wc-pending" ><?= _e('Pending ')?></option>
								
								<option value="wc-on-hold" ><?= _e('On Hold ')?></option>
							
							</select>
							<p style="font-size: 13px;line-height: 20px;margin-top: 10px;color: #716269;">Choose based on which order status to assign points to users</p>
						</td>
					</tr>


	    			<tr class="phoeniixx_phoe_rewpts_wrap phoen-user-user-login-wrap">
						<th>
							<label><?php _e(ucwords('Give Reward On Shipping'),'phoen-rewpts'); ?> </label>
						</th>
							
						<td>
							<input type="checkbox" checked="">
						</td>
					</tr>

					<tr class="phoeniixx_phoe_rewpts_wrap phoen-user-user-login-wrap">
						<th>
							<label><?php _e(ucwords('Give Reward On Tax'),'phoen-rewpts'); ?> </label>
						</th>
							
						<td>
							<input type="checkbox" checked="">	
						</td>
					</tr>

					<tr class="phoeniixx_phoe_rewpts_wrap phoen-user-user-login-wrap">
						<th>
							<label><?php _e(ucwords('Enable Product Based Points'),'phoen-rewpts'); ?> </label>
						</th>
							
						<td>
							<input type="checkbox" checked="">	
							<p style="font-size: 13px;line-height: 20px;margin-top: 10px;color: #716269;">Set the points for every specfic product</p>
						</td>
					</tr>

					<tr class="phoeniixx_phoe_rewpts_wrap phoen-user-user-login-wrap">
						<th>
							<label><?php _e(ucwords('Enable Category Based Points'),'phoen-rewpts'); ?> </label>
						</th>
							
						<td>
							<input type="checkbox" checked="">	
							<p style="font-size: 13px;line-height: 20px;margin-top: 10px;color: #716269;">Set the points for every specfic product category</p>
						</td>
					</tr>

					<tr class="phoeniixx_phoe_rewpts_wrap phoen-user-user-login-wrap">
						<th>
							<label><?php _e(ucwords('Manually Give Points For Old Customer'),'phoen-rewpts'); ?> </label>
						</th>
							
						<td>
							<input type="checkbox" checked="">	
						</td>
					</tr>

					<tr class="phoeniixx_phoe_rewpts_wrap phoen-user-user-login-wrap">
				
						<th>
						
							<label><?php _e('Enable To Give Old Order Points To User','phoen-rewpts'); ?> </label>
							
						</th>
						
						<td>
						
							<input type="checkbox"  name="enable_manually_points_old_order" id="enable_manually_points_old_order" value="1">
							<p style="font-size: 13px;line-height: 20px;margin-top: 10px;color: #716269;">Enable to assign points on old order to user when reward point plugin was not activated</p>

							
						</td>
						
					</tr>

					<tr class="phoeniixx_phoe_rewpts_wrap phoen-user-user-login-wrap">
				
						<th>
						
							<label><?php _e('Remove points When Order is Refunded ','phoen-rewpts'); ?> </label>
							
						</th>
						
						<td>

							<?php $enable_for_reassign_point = ($enable_for_reassign_point_val=='1')?'checked':'';?>
						
							<input type="checkbox"  name="enable_for_reassign_point" id="" value="1" >
							<p style="font-size: 13px;line-height: 20px;margin-top: 10px;color: #716269;"><?= _e('Enable you want to remove the points to a customer when order is refunded ')?></p>
							
						</td>
						
					</tr>

					
					<tr class="phoeniixx_phoe_rewpts_wrap phoen-user-user-login-wrap">
				
						<th>
							<label><?php _e('Add Days For Expiry Points ','phoen-rewpts'); ?> </label>
						</th>
						
						<td>
							<input type="number" min="0" step="any" name="phoen_points_expiry_month" class="phoen_points_expiry_month" value=""> Days 
						</td>
						
					</tr>
					<tr class="phoeniixx_phoe_rewpts_wrap phoen-user-user-login-wrap">
				
						<th>
							<label><?php _e('Add Days For Assignment Points','phoen-rewpts'); ?></label>
						</th>
						
						<td>
							<input type="number" min="0" step="any" name="phoen_points_assignment_date" class="phoen_points_assignment_dates" value="" > Days 
						</td>
						
					</tr>
					
					<tr class="phoeniixx_phoe_rewpts_wrap phoen-user-user-login-wrap">
				
						<th>
							<label><?php _e('User Can Use Number Of Points Per Order','phoen-rewpts'); ?> </label>
						</th>
						
						<td>
						
							<input type="number" min="0" step="any" name="limit_use_points" class="limit_use_points" value="" > Points
							<p style="font-size: 13px;line-height: 20px;margin-top: 10px;color: #716269;">leave blank for no limit</p>
						
						</td>
						
					</tr>

					<tr class="phoeniixx_phoe_rewpts_wrap phoen-user-user-login-wrap">
				
						<th>
							<label><?php _e('Minimum Order Cart Value to Redeem Points','phoen-rewpts'); ?> </label>
						</th>
						
						<td>
						
							<input type="number" min="0" step="any" name="min_order_cart_value_redeem_points" class="min_order_cart_value_redeem_points" value="" ><?= _e(get_woocommerce_currency_symbol())?>
							<p style="font-size: 13px;line-height: 20px;margin-top: 10px;color: #716269;">leave blank for no limit</p>
						
						</td>
						
					</tr>

				</table>

				<h2 style="color: #58504d;border-bottom: 1px solid #ccbbb6;">Extra Features For Set Points</h2>

	    		<table class="form-table">

					<tr class="phoeniixx_phoe_rewpts_wrap phoen-user-user-login-wrap">
						<th>
							<label>Bonus Points (Range)</label>
						</th>
						<td colspan="2">
						<div class="phoeniixx_red_points_div" style="display:none;">
							<div class="phoeniixx_rewd_min_max_div">
									
								<label>From </label>
									<input type="number" readonly min="0" name="phoen_range_from[]" value="" style="width:10%;">
										
								<label>To </label>
									<input type="number" readonly min="0" name="phoen_range_to[]" value="" style="width:10%;">
										
								<label>Points </label>
									<input type="number" readonly min="0" name="phoen_range_points[]" value="">
									<button name="remove_b" class="phoe_remove_range_disc_div button" style="background:white;font-weight:bolder;">x</button>
										
							</div>   
						</div>
							<!--Blank div for include html -->
						<div class="phoeniixx_range_html_content_div"></div>
						<br>
							<input type="button" value="Add Range" class="phoe_range_add_disc_more button">
							<p style="font-size: 13px;line-height: 20px;margin-top: 10px;color: #716269;">Range Points works basis on cart total.</p>
						</td>	
						
					</tr>

					<tr class="phoeniixx_phoe_rewpts_wrap phoen-user-user-login-wrap">
						<th>
							<label>Upload CSV File</label>
						</th>
						<td>
							<input type="file" name="" disabled>
							<p style="font-size: 13px;line-height: 20px;margin-top: 10px;color: #716269;">upload csv file for manually get the points to user based on email and points according by admin. </p>
						</td>
					</tr>

					<tr class="phoeniixx_phoe_rewpts_wrap phoen-user-user-login-wrap">
						<th>
							<label>Download CSV File</label>
						</th>
						<td>
							<input type="button" name="" value="Download CSV file" disabled>
							<p style="font-size: 13px;line-height: 20px;margin-top: 10px;color: #716269;">download csv file of points of every particular user </p>
						</td>
					</tr>

				</table>
				
			</tbody>
		</table>
	
	</form>
	
</div>
<script>
jQuery(document).ready(function (){
	var phoen_music_val = jQuery('.phoeniixx_red_points_div').html();

	jQuery('.phoe_range_add_disc_more').click(function(){
   
		jQuery('.phoeniixx_range_html_content_div').append(phoen_music_val);

	});
	jQuery(document).on('click','.phoe_remove_range_disc_div',function(){

		let confirm_delete = confirm("Are you sure you want to delete this?");

		if(confirm_delete){

			jQuery(this).parent('div').remove();

		}

	}); 

	jQuery("#multiple").select2({
	  placeholder: "Select User Order Status",
	  allowClear: true,
	  width: 'resolve' // need to override the changed default
	});

});
</script>