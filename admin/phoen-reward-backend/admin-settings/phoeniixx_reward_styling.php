<?php if ( ! defined( 'ABSPATH' ) ) exit; 

	if ( ! empty( $_POST ) && check_admin_referer( 'phoen_rewpts_btncreate_action', 'phoen_rewpts_btncreate_action_field' ) ) {

		if(isset( $_POST['custom_btn'] ) && $_SERVER["REQUEST_METHOD"] == "POST"){
			
			$apply_btn_title = (isset($_POST['apply_btn_title']))?sanitize_text_field( $_POST['apply_btn_title'] ):'APPLY POINTS'; //1
			$phoen_select_text_product_page = (isset($_POST['phoen_select_text_product_page']))?sanitize_text_field( $_POST['phoen_select_text_product_page'] ):'above_add_cart';//2
			$apply_btn_bg_col   = (isset($_POST['apply_btn_bg_col']))?sanitize_text_field( $_POST['apply_btn_bg_col'] ):'#f7f7f7';//3
			$apply_btn_txt_col  = (isset($_POST['apply_btn_txt_col']))?sanitize_text_field( $_POST['apply_btn_txt_col'] ):'#000000';//4
			$div_bg_col  		= (isset($_POST['div_bg_col']))?sanitize_text_field( $_POST['div_bg_col'] ):'';//5
			$toaster_bg_color  	= (isset($_POST['toaster_bg_color']))?sanitize_text_field( $_POST['toaster_bg_color'] ):'';//6
			$toaster_text_color = (isset($_POST['toaster_text_color']))?sanitize_text_field( $_POST['toaster_text_color'] ):'';//7

			$save_all_style_settings=array(
				
				'apply_btn_title'		 		 =>	$apply_btn_title,
				'phoen_select_text_product_page' => $phoen_select_text_product_page,
				'apply_btn_bg_col'				 =>	$apply_btn_bg_col,
				'apply_btn_txt_col'		 		 =>	$apply_btn_txt_col,
				'div_bg_col' 			 		 => $div_bg_col,
				'toaster_bg_color' 				 => $toaster_bg_color,
				'toaster_text_color' 			 => $toaster_text_color
			);
			
			update_option('phoen_rewpts_custom_btn_styling',$save_all_style_settings);
			
		}
	}

$fetch_style_setting = get_option('phoen_rewpts_custom_btn_styling'); ?>


<div id="phoeniixx_phoe_book_wrap_profile-page" style="background:white;padding: 10px;margin-top: 2%;"  class=" phoeniixx_phoe_book_wrap_profile_div">
		
	<form method="post" name="phoen_woo_btncreate">
				
		<?php wp_nonce_field( 'phoen_rewpts_btncreate_action', 'phoen_rewpts_btncreate_action_field' ); ?>
				
		<table class="form-table" >
			
			<tr class="phoen-user-user-login-wrap">
				<th>
					<?php _e('Apply Button title','phoen-rewpts'); ?>
				</th>
				
				<td>
					<input type="text" pattern="[a-zA-Z ]*$" title="Only alphabets is allow" class="apply_btn_title" name="apply_btn_title" value="<?php echo(isset($fetch_style_setting['apply_btn_title'])) ?$fetch_style_setting['apply_btn_title']:'APPLY POINTS';?>">
				</td>
			</tr>
							
			<tr class="phoen-user-user-login-wrap">
				<th>
					<?php _e('Reward Points Notification Text Position on Product Page','phoen-rewpts'); ?>				
				</th>
				
				<td>
					<?php $selected_text_cart = $fetch_style_setting['phoen_select_text_product_page'];
					?>
					<select readonly name="phoen_select_text_product_page">
					
						<option value="below_add_cart"  <?= ($selected_text_cart=='below_add_cart')?_e('selected'):'' ?> >Below Add To Cart</option>
						<option value="above_add_cart" <?= ($selected_text_cart=='above_add_cart')?_e('selected'):'' ?> >Above Add To Cart</option>
						
					</select>
				</td>
			</tr>
			
			<tr class="phoen-user-user-login-wrap">
				
				<th>
					<?php _e('Button Background Color','phoen-rewpts'); ?>			
				</th>
				
				<td>
					<input class="btn_color_picker btn_bg_col" type="text" name="apply_btn_bg_col" value="<?php echo(isset($fetch_style_setting['apply_btn_bg_col'])) ?$fetch_style_setting['apply_btn_bg_col']:'#000000';?>">
				</td>
			
			</tr>
			
			<tr class="phoen-user-user-login-wrap">
				<th>
					<?php _e('Button Text color','phoen-rewpts'); ?>				
				</th>
				
				<td>
					<input class="btn_color_picker btn_txt_col" type="text" name="apply_btn_txt_col" value="<?php echo(isset($fetch_style_setting['apply_btn_txt_col'])) ?$fetch_style_setting['apply_btn_txt_col']:'#fff';?>">
				</td>
				
			</tr>
			
			
			<tr class="phoen-user-user-login-wrap">
			
				<th>
					<?php _e('Div Background Color','phoen-rewpts'); ?>						
				</th>
				
				<td>
					<input  class="btn_color_picker" type="text" style="max-width:105px;" name="div_bg_col" value="<?php echo(isset($fetch_style_setting['div_bg_col'])) ?$fetch_style_setting['div_bg_col']:'#fff';?>">
				</td>
				
			</tr>

			<tr class="phoen-user-user-login-wrap">
			
				<th>
					<?php _e('Toaster Background Color','phoen-rewpts'); ?>						
				</th>
				
				<td>
					<input  class="btn_color_picker" type="text" style="max-width:105px;" name="toaster_bg_color" value="<?php echo(isset($fetch_style_setting['toaster_bg_color'])) ?$fetch_style_setting['toaster_bg_color']:'#3f3f3f';?>">
				</td>
				
			</tr>

			<tr class="phoen-user-user-login-wrap">
			
				<th>
					<?php _e('Toaster Text Color','phoen-rewpts'); ?>						
				</th>
				
				<td>
					<input  class="btn_color_picker" type="text" style="max-width:105px;" name="toaster_text_color" value="<?php echo(isset($fetch_style_setting['toaster_text_color'])) ?$fetch_style_setting['toaster_text_color']:'#ffffff';?>">
				</td>
				
			</tr>
					
		</table>

		<br /><input type="submit" class="button button-primary" value="Save" name="custom_btn">

	</form>
	
</div>