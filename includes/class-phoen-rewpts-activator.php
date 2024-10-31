<?php

/**
 * Fired during plugin activation
 *
 * @link       http://www.phoeniixx.com/
 * @since      1.0.0
 *
 * @package    Phoen_Rewpts
 * @subpackage Phoen_Rewpts/includes
 */

/**
 * Fired during plugin activation.
 *
 * This class defines all code necessary to run during the plugin's activation.
 *
 * @since      1.0.0
 * @package    Phoen_Rewpts
 * @subpackage Phoen_Rewpts/includes
 * @author     phoeniixx <contact@phoeniixx.com>
 */
class Phoen_Rewpts_Activator {

	/**
	 * Short Description. (use period)
	 *
	 * Long Description.
	 *
	 * @since    1.0.0
	 */

    private $setting;

    private $set_point;
    
    private $notification;
    
    private $styling;

    private $default_value = '1';

    public function __construct(){

        $this->setting      = $this->phoen_rewpts_save_default_setting();
        $this->set_point    = $this->phoen_rewpts_save_default_set_point();
        $this->notification = $this->phoen_rewpts_save_default_notification();
        $this->styling      = $this->phoen_rewpts_save_default_styling();
    }
    

	public function activate() {

        $this->phoen_rewpts_save_plugin_activation_date();

        update_option('phoe_rewpts_page_settings_value',$this->setting);
        update_option('phoe_set_point_value',$this->set_point);
        update_option('phoen_rewpts_notification_settings',$this->notification);
        update_option('phoen_rewpts_custom_btn_styling',$this->styling);
	}

    private function phoen_rewpts_save_plugin_activation_date(){

        $check_date_is_exists = get_option('phoen_reward_point_plugin_acivation_date');

        if(empty($check_date_is_exists)):

            update_option('phoen_reward_point_plugin_acivation_date',date("d-m-Y"));

        endif;
    }

    private function phoen_rewpts_save_default_setting(){

        return array(
    
            'enable_plugin'                                 =>$this->default_value,
            
            'enable_plugin_myaccount'                       =>$this->default_value,
            
            'enable_plugin_dob_date'                        =>$this->default_value,
            
            'enable_plugin_reff_code'                       =>$this->default_value,
            
            'show_points_with_order_history'                =>$this->default_value,

            'enable_points_with_order_details_sending_email'=>$this->default_value,

        );
    }

    private  function phoen_rewpts_save_default_set_point(){

        $data['all_user'] =  array('reward_money'=>$this->default_value,'reward_point'=>$this->default_value);

        return array(

            'point_type'            => 'fixed_price',

            'user'                  => 'all_user',
            
            'reward_point_data'     => $data,
            
            'reedem_point'          => $this->default_value,
            
            'reedem_money'          => $this->default_value,
            
            'first_login_points'    => '10',
            
            'link_referral_points'  => '10',
            
            'first_order_points'    => '10',
            
            'first_review_points'   => '10',
            
            'use_payment_gateway'   => '10',
            
            'gift_birthday_points'  => '10',
        );

    }

    private  function phoen_rewpts_save_default_notification(){

        return array(

            'enable_review_point_product_page'              => $this->default_value,

            'phoen_rewpts_review_notification_product_page' => 'You Can Get {points} On First Approved Product Review After Successfully Purchasing This Product',

            'enable_first_order_point'                      => $this->default_value,

            'phoen_rewpts_first_order_notification'         => 'You Will get {points} Points On Your First order',

            'enable_plugin_product_page'                    => $this->default_value,

            'phoen_rewpts_notification_product_page'        => 'You Will get {points} Points On Completing This Order.',
            
            'enable_plugin_cart_page'                       => $this->default_value,
            
            'phoen_rewpts_notification_cart_page'           => 'You Will get {points} Points On Completing This Order.',
            
            'enable_plugin_checkout_page'                   => $this->default_value,
            
            'phoen_rewpts_notification_checkout_page'       => 'You Will get {points} Points On Completing This Order.' ,
            
            'apply_box_enable_on_cart'                      => $this->default_value,
            
            'phoen_apply_box_notification_cart_page'        => 'You can apply {points} Points to get {price} Discount.',
            
            'apply_box_enable_on_checkout'                  => $this->default_value,
            
            'phoen_apply_box_notification_checkout_page'    => 'You can apply {points} Points to get {price} Discount.',
            
            'phoen_rewpts_enable_notify_using_paypal'       => $this->default_value,
            
            'phoen_rewpts_paypal_notification'              => 'If you go ahead with PayPal you will get   {points} Point as a Reward after completing of your order',

            'phoen_rewts_order_point_mail_heading_color'    => '#e98fd7',

            'phoen_rewts_order_point_mail_heading'          => 'Show Point of Current Order',

            'phoen_rewts_order_point_mail_subject'          => 'reward point',

            'phoen_rewts_order_point_mail_message'          => 'Here is the current order point details.',

            'phoen_rewts_birthday_mail_message'             => 'You got {points} points on your birthday.',
        );

    }

    private  function phoen_rewpts_save_default_styling(){

        return array(
                
            'apply_btn_title'        => 'APPLY POINTS',
            'div_bg_col'             => '#d6d6d6',      
        );

    }


}
