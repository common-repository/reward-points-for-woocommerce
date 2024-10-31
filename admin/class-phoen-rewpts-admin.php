<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       http://www.phoeniixx.com/
 * @since      1.0.0
 *
 * @package    Phoen_Rewpts
 * @subpackage Phoen_Rewpts/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Phoen_Rewpts
 * @subpackage Phoen_Rewpts/admin
 * @author     phoeniixx <contact@phoeniixx.com>
 */
class Phoen_Rewpts_Admin {

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
	 * @param      string    $plugin_name       The name of this plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name 					= $plugin_name;
		$this->version 						= $version;

		add_action( 'wp_ajax_phoe_referral_code_completed', array($this,'phoe_referral_code_completed_fun' ));

		add_action( 'wp_ajax_nopriv_phoe_referral_code_completed', array($this,'phoe_referral_code_completed_fun' ));	

	}

	/**
	 * Register the stylesheets for the admin area.
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

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/phoen-rewpts-admin.css', array(), $this->version, 'all' );
		
		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ). "css/phoen_rewpts_backend.css", array(), $this->version, 'all'  );

		wp_enqueue_style( 'wp-color-picker');	

	}

	/**
	 * Register the JavaScript for the admin area.
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

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ).'js/phoen-rewpts-admin.js', array( 'jquery' ), $this->version, false );

		// wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ )."js/phoen_rewpts_backend.js", array() ,$this->version, false );
		
		// wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ )."js/phoen_rewpts_backend_second.js", array() ,$this->version, false );	
		
		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ).'js/pagination.js', array( 'pagination' ), $this->version, false );
			
		wp_enqueue_script( 'wp-color-picker');

	}

	
	public function phoe_rewpts_menu_booking() {
			
			add_submenu_page('woocommerce',
				__( 'Reward Points', 'phoen-rewpts' ) ,
				__( 'Reward Points', 'phoen-rewpts' ) ,
				'manage_options', 
				'Phoeniixx_reward_settings',
				array($this,'phoen_reward_point_callback_function'));
	
	}

	
	public function phoen_reward_point_callback_function(){ 

		$tab = (isset($_GET['tab'])) ? sanitize_text_field( $_GET['tab'] ) : "" ; ?>

		<div id="profile-page" class="wrap">

		    <h2 style="text-transform: uppercase;color: #0c5777;font-size: 22px;font-weight: 700;text-align: left;display: inline-block;box-sizing: border-box;">  <?php _e('Reward Points For Woocommerce','phoen-rewpts'); ?></h2>

		    <h2 class="nav-tab-wrapper woo-nav-tab-wrapper">
			
				<a style="<?= ($tab == 'phoen_rewpts_setting' || $tab == '')?_e('background:#336374;color:white'):_e('background:white;color:black;')?>" class="nav-tab <?php if($tab == 'phoen_rewpts_setting' || $tab == ''){ echo esc_html( "nav-tab-active" ); } ?>" href="?page=Phoeniixx_reward_settings&amp;tab=phoen_rewpts_setting"><?php _e( 'SETTINGS','phoen-rewpts'); ?></a>
			
				<a style="<?= ($tab == 'phoen_rewpts_set_points')?_e('background:#336374;color:white'):_e('background:white;color:black;')?>" class="nav-tab <?php if($tab == 'phoen_rewpts_set_points'){ echo esc_html( "nav-tab-active" ); } ?>"
		            href="?page=Phoeniixx_reward_settings&amp;tab=phoen_rewpts_set_points"><?php _e('SET POINTS','phoen-rewpts'); ?></a>
				
				<a style="<?= ($tab == 'phoen_rewpts_customer')?_e('background:#336374;color:white'):_e('background:white;color:black;')?>" class="nav-tab <?php if($tab == 'phoen_rewpts_customer'){ echo esc_html( "nav-tab-active" ); } ?>"
		            href="?page=Phoeniixx_reward_settings&amp;tab=phoen_rewpts_customer"><?php _e('CUSTOMER\'S POINTS','phoen-rewpts'); ?></a>
		        
		        <a style="<?= ($tab == 'phoen_rewpts_notification')?_e('background:#336374;color:white'):_e('background:white;color:black;')?>" class="nav-tab <?php if($tab == 'phoen_rewpts_notification'){ echo esc_html( "nav-tab-active" ); } ?>"
		            href="?page=Phoeniixx_reward_settings&amp;tab=phoen_rewpts_notification"><?php _e('NOTIFICATIONS','phoen-rewpts'); ?></a>
		       
		        <a style="<?= ($tab == 'phoen_rewpts_styling')?_e('background:#336374;color:white'):_e('background:white;color:black;')?>" class="nav-tab <?php if($tab == 'phoen_rewpts_styling'){ echo esc_html( "nav-tab-active" ); } ?>"
		            href="?page=Phoeniixx_reward_settings&amp;tab=phoen_rewpts_styling"><?php _e('STYLING','phoen-rewpts'); ?></a>


		        <a style="<?= ($tab == 'phoen_rewpts_pro_feature')?_e('background:#336374;color:white'):_e('background:white;color:black;')?>" class="nav-tab <?php if($tab == 'phoen_rewpts_pro_feature'){ echo esc_html( "nav-tab-active" ); } ?>"
		            href="?page=Phoeniixx_reward_settings&amp;tab=phoen_rewpts_pro_feature"><?php _e('PRO FEATURES','phoen-rewpts'); ?></a>

		    </h2>

		</div>

		<?php $this->phoen_rewpts_active_tab($tab);
	
	}

	private function phoen_rewpts_active_tab($tab=''){

		switch ($tab) {
			case 'phoen_rewpts_setting':
				$this->phoen_rewpts_settingPage();
				break;

			case 'phoen_rewpts_set_points':
				$this->phoen_rewpts_set_points();
				break;

			case 'phoen_rewpts_customer':
				$this->phoen_rewpts_customer();
				break;

			case 'phoen_rewpts_notification':
				$this->phoen_rewpts_notification();
				break;

			case 'phoen_rewpts_styling':
				$this->phoen_rewpts_styling();
				break;

			case 'phoen_rewpts_pro_feature':
				$this->phoen_rewpts_pro_feature();
				break;
			
			default:
				$this->phoen_rewpts_settingPage();
				break;
		}
	}

	private function phoen_rewpts_settingPage(){

		include_once(PHOEN_REWPTSPLUGPATH.'admin/phoen-reward-backend/admin-settings/phoen_rewpts_general_setting.php');

	}

	private function phoen_rewpts_set_points(){
		ob_start();
			include_once(PHOEN_REWPTSPLUGPATH.'admin/phoen-reward-backend/admin-settings/phoen_rewpts_set_points.php');
			$contents = ob_get_contents();
		ob_end_clean();
			echo $contents;

	} 

	private function phoen_rewpts_customer(){
		ob_start();
			include_once(PHOEN_REWPTSPLUGPATH.'admin/phoen-reward-backend/phoeniixx_rewpts_admin_panel.php');
			$contents = ob_get_contents();
		ob_end_clean();
			echo $contents;

	}

	private function phoen_rewpts_notification(){
		ob_start();
			include_once(PHOEN_REWPTSPLUGPATH.'admin/phoen-reward-backend/admin-settings/phoen_rewpts_notification.php');
			$contents = ob_get_contents();
		ob_end_clean();
			echo $contents;

	}

	private function phoen_rewpts_styling(){
		ob_start();
			include_once(PHOEN_REWPTSPLUGPATH.'admin/phoen-reward-backend/admin-settings/phoeniixx_reward_styling.php');
			$contents = ob_get_contents();
		ob_end_clean();
			echo $contents;

	}

	private function phoen_rewpts_pro_feature(){
		ob_start();
			include_once(PHOEN_REWPTSPLUGPATH.'admin/phoen-reward-backend/admin-settings/phoeniixx_reward_pro_feature.php');
			$contents = ob_get_contents();
		ob_end_clean();
			echo $contents;
	}

	function phoen_reward_create_extra_profile_dob_fields( $user ) { ?>

		<h3><?php _e('Date Of Birth'); ?></h3>
	    <table class="form-table">
	        <tr>
	            <th>
	            	<label for="phoen_reward_dob_user"><?php _e( 'Date of Birth', 'phoen-rewpts' ); ?> <span class="required">*</span></label>
	            </th>
	            <td>
	           		<input type="Date" name="phoen_reward_dob_user" id="phoen_reward_dob_user" class="regular-text phoen_reward_dob_date" value="<?php echo esc_attr( get_the_author_meta( 'date_of_birth', $user->ID) );?>">
	            </td>
	        </tr>
	    </table>
		<?php
	}

	function phoen_reward_save_extra_profile_dob_fields( $user_id ) {

	    if ( !current_user_can( 'edit_user', $user_id ) )
	        return false;

	    /* Edit the following lines according to your set fields */
	    $get_user_dob = isset($_POST['phoen_reward_dob_user']) ? sanitize_text_field( $_POST['phoen_reward_dob_user'] ) :'';

	    (!empty($get_user_dob) && $get_user_dob != null) ? update_usermeta( $user_id, 'date_of_birth', $get_user_dob ) :'';
		
	}

	function phoe_referral_code_completed_fun(){
			
		$phoen_code_id= sanitize_text_field($_POST['data']);
			
		$phoen_ref_site_url= sanitize_text_field($_POST['ref_site_url']);
			
		$phoen_ref_user_email_id= sanitize_text_field($_POST['ref_user_email_id']);
			
		$subject="Referral Code";
			
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
																	<h3>Referral Code</h3>
																	<h3>'.$phoen_code_id.'</h3>
																	<p>'.$phoen_ref_site_url.'</p>
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
				</div>';  
				
				
			if($phoen_ref_user_email_id!=''){
					
				wp_mail( $phoen_ref_user_email_id, $subject,$msg,$headers);
					
				echo $complit="completed";
			}
				
			die();
	}

}
