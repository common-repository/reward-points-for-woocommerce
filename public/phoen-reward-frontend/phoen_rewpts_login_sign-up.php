<?php 
trait Phoen_Rewpts_Add_Extra_Field{

	public function phoen_rewpts_login_signup_point(){
		add_action( 'woocommerce_register_form_start', array($this,'Phoen_reward_WC_extra_registation_fields'));
		add_filter( 'woocommerce_process_registration_errors', array($this,'phoen_reward_wooc_validate_extra_register_fields'), 10, 3 );

		add_action( 'woocommerce_created_customer',  array($this,'phoen_reward_wooc_save_extra_register_fields' ),10,1);	
	}

	public function Phoen_reward_WC_extra_registation_fields() { 

		if($this->gen_settings['enable_plugin_dob_date'] == '1'){ ?>

			<p class="form-row form-row-wide">
				<label for="phoen_rewpts_user_dob"><?php _e( 'Date of Birth', 'phoen-rewpts' ); ?> <span class="required">*</span></label></label>
				<input type="date" class="input-text phoen_reward_dob_date" name="phoen_rewpts_user_dob" id="phoen_rewpts_user_dob" value="<?php echo isset($_POST['phoen_rewpts_user_dob']) ? $_POST['phoen_rewpts_user_dob']:'' ?>" />
		
			</p>
		
		<?php }

		if($this->gen_settings['enable_plugin_reff_code']  == '1'){ 

			$digits = 5;

			$phoe_rand_number =  rand(pow(10, $digits-1), pow(10, $digits)-1); ?>	
		
			<p class="form-row form-row-wide">
				<label for=""><?php _e( 'Referral code', 'phoen-rewpts' ); ?> <span class="required">*</span></label></label>
				<input type="hidden" class="input-text" name="phoen_reward_referral_user_hidden" id="phoen_reward_referral_user_hidden" value="<?php echo isset($phoe_rand_number )?$phoe_rand_number:''; ?>" />
				<input type="text" class="input-text" name="phoen_reward_referral_user" id="phoen_reward_referral_user" value="<?php echo isset($_POST['phoen_reward_referral_user']) ? $_POST['phoen_reward_referral_user']:'' ?>" />
			</p>

		<?php } ?> <div class="clear"></div> <?php
	}

	public function phoen_reward_wooc_validate_extra_register_fields( $validation_error, $username, $email) {

		$phoen_validation_ref = get_option('phoen_validation_ref_code');

		if ( isset( $_POST['phoen_rewpts_user_dob'] ) && empty( $_POST['phoen_rewpts_user_dob'] ) ) {
			$validation_error->add('error', ucwords('Date of birth is required field'));
		}
		  
		if ( isset( $_POST['phoen_reward_referral_user'] ) && empty( $_POST['phoen_reward_referral_user'] ) ) {
			if (!in_array($_POST['phoen_reward_referral_user'], $phoen_validation_ref)){ 
				$validation_error->add('error', ucwords('Referral Code is required field'));
			}
		}
	
		return $validation_error;
	}

	private function phoen_reward_first_signup_point($cur_user_id){

		if(empty(get_post_meta($cur_user_id,'phoen_reward_points_for_register_user_id')) && !empty($cur_user_id)){
		
			$first_login_points_val=isset($this->phoe_set_point_value_data['first_login_points'])?$this->phoe_set_point_value_data['first_login_points']:'';
	
			if($first_login_points_val > 0 && !empty($first_login_points_val)){
				
				update_post_meta($cur_user_id,'phoen_reward_points_for_register_user_id',$cur_user_id);
				update_post_meta($cur_user_id,'phoen_reward_points_for_register_user',$first_login_points_val);
				update_post_meta($cur_user_id,'phoen_reward_points_for_register_userdate',date("d-m-Y"));

				return true;
			}
		}
	}

	public function phoen_reward_wooc_save_extra_register_fields( $customer_id ) {

		$this->phoen_reward_first_signup_point($customer_id);

		if ($this->gen_settings['enable_plugin_dob_date'] == '1' && isset( $_POST['phoen_rewpts_user_dob'] )):
			$get_dob_date = date_create(sanitize_text_field( $_POST['phoen_rewpts_user_dob'] ));
			update_usermeta( $customer_id, 'date_of_birth', date_format($get_dob_date,'d-m-Y'));
		endif;

		if($this->gen_settings['enable_plugin_reff_code']  == '1'):

			if ( isset( $_POST['phoen_reward_referral_user_hidden'] ) ) {
					
				$user_info 		 = get_userdata($customer_id);
				$phoen_user_name = $user_info->user_login;
				
				update_user_meta( $customer_id, 'phoen_reward_referral_user_hidden', sanitize_text_field($phoen_user_name."_". $_POST['phoen_reward_referral_user_hidden'] ) );
				
				$phoen_validation_ref = get_option('phoen_validation_ref_code');
				
				if(empty($phoen_validation_ref)){
					$code = array($phoen_user_name."_". $_POST['phoen_reward_referral_user_hidden']);
					update_option('phoen_validation_ref_code',$code);
				
				}else{
					$phoen_validation_ref = get_option('phoen_validation_ref_code');
					$code = array($phoen_user_name."_". $_POST['phoen_reward_referral_user_hidden']);
					$email_combine_ref=array_merge($code,$phoen_validation_ref);
					update_option('phoen_validation_ref_code',$email_combine_ref);
				}
			}
				
			if ( isset( $_POST['phoen_reward_referral_user'] ) ) {
				
				$user_detail = get_users();
				
				foreach($user_detail as $key=>$phoen_user_details){
					$phoen_user_id = $phoen_user_details->ID;
					$phoen_reward_referral_user_checked = $_POST['phoen_reward_referral_user'];
					$phoen_reward_referral_user_val = get_user_meta( $phoen_user_id, 'phoen_reward_referral_user_hidden', true );
					
					if($phoen_reward_referral_user_val == $phoen_reward_referral_user_checked){
						$phoen_user_id_ref = $phoen_user_details->ID;
						$phoen_user_id_ref_email = $_POST['email'];
					}
				}
				
				$phoen_rewpts_set_point_data = $this->phoe_set_point_value_data;
				
				$link_referral_points_val = isset($phoen_rewpts_set_point_data['link_referral_points'])?$phoen_rewpts_set_point_data['link_referral_points']:'';
				
				$phoen_rewards_referral_user = get_user_meta( $phoen_user_id_ref, 'phoen_reward_referral_user_codes', true );
				
				$phoen_reward_referral_user_array = array($_POST['phoen_reward_referral_user']);
				
				$phoen_current_dates = date("d-m-Y") ;
				
				if(empty($phoen_rewards_referral_user)){

					update_user_meta( $phoen_user_id_ref, 'phoen_reward_referral_user_codes', $phoen_reward_referral_user_array );
					update_user_meta( $phoen_user_id_ref, 'phoen_reward_referral_user_points', array($link_referral_points_val) );
					update_user_meta( $phoen_user_id_ref, 'phoen_reward_referral_user_date', array($phoen_current_dates) );
					
					update_user_meta( $phoen_user_id_ref, 'phoen_reward_referral_user_id', $phoen_user_id_ref );
				
				}else{

					$phoen_current_datesdd=array($phoen_current_dates);
					$phoen_rewards_referral_user = get_user_meta( $phoen_user_id_ref, 'phoen_reward_referral_user_codes', true );
					$phoen_rewards_referral_user_points = get_user_meta( $phoen_user_id_ref, 'phoen_reward_referral_user_points', true );
					$phoen_rewards_referral_user_points_date = get_user_meta( $phoen_user_id_ref, 'phoen_reward_referral_user_date', true );
					$link_referral_points_val=array($link_referral_points_val);
						
					$email_combine_valc_ref_code=array_merge($phoen_reward_referral_user_array,$phoen_rewards_referral_user);
					$email_combine_valc_ref_code_points=array_merge($link_referral_points_val,$phoen_rewards_referral_user_points);
					$phoen_rewards_referral_user_points_date_val=array_merge($phoen_current_datesdd,$phoen_rewards_referral_user_points_date);
				
					update_user_meta( $phoen_user_id_ref, 'phoen_reward_referral_user_codes', $email_combine_valc_ref_code );
					update_user_meta( $phoen_user_id_ref, 'phoen_reward_referral_user_points',$email_combine_valc_ref_code_points);
					update_user_meta( $phoen_user_id_ref, 'phoen_reward_referral_user_date', $phoen_rewards_referral_user_points_date_val );
					update_user_meta( $phoen_user_id_ref, 'phoen_reward_referral_user_id', $phoen_user_id_ref );
				
				}

			}

			$phoen_rewards_referral_user = get_user_meta( $phoen_user_id_ref, 'phoen_reward_referral_user_codes', true );
				
			if(!empty($phoen_user_id_ref_email)){
				
				$phoen_reward_code = get_user_meta( $customer_id, 'phoen_reward_referral_user_hidden', true );
				$referral_message  = $this->phoen_rewpts_notification_data['phoen_rewts_referral_point_mail_message'];
				$this->phoen_rewpts_send_referral_code_via_mail($phoen_user_id_ref_email,$phoen_reward_code,$referral_message);
				
			}

			if($phoen_rewards_referral_user!=''){
				$this->phoen_rewpts_send_using_referral_code_via_mail($phoen_user_id_ref_email);
			}

		endif;
	}

	private function phoen_rewpts_send_referral_code_via_mail($email,$phoen_reward_code,$referral_message){

		$subject = "Referral Code Point";
		$headers = array('Content-Type: text/html; charset=UTF-8');

		define ("REF_SUBJECT", serialize ($subject));
	 	define ("REF_CODE", serialize ($phoen_reward_code));
	 	define ("REF_MESSAGE", serialize ($referral_message));

	 	ob_start();
			wc_get_template('admin/phoen-reward-backend/phoen-reward-point-mail/phoen_rewpts_send_ref_code.php',null,PHOEN_REWPTSPLUGPATH,PHOEN_REWPTSPLUGPATH);
			$html = ob_get_contents();
		ob_end_clean();
		wp_mail( $email, $subject, $html, $headers);
	}

	private function phoen_rewpts_send_using_referral_code_via_mail($email){ 
		
		$subject = "Referral Code";
		$headers = array('Content-Type: text/html; charset=UTF-8');
					
		ob_start();
			wc_get_template('admin/phoen-reward-backend/phoen-reward-point-mail/phoen_rewpts_send_thank_you_mail.php',null,PHOEN_REWPTSPLUGPATH,PHOEN_REWPTSPLUGPATH);
			$html = ob_get_contents();
		ob_end_clean();
		wp_mail( $email, $subject,$html,$headers);
	}

}
?>