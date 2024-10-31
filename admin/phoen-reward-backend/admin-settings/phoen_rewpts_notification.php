<?php if ( ! defined( 'ABSPATH' ) ) exit;

// echo "<pre>";print_r(get_option('phoen_rewpts_notification_settings')); echo "</pre>";
    
if ( ! empty( $_POST ) && check_admin_referer( 'phoen_rewpts_notification_form_action', 'phoen_rewpts_notification_form_action_form_nonce_field' ) ) {

    if(sanitize_text_field( $_POST['rewpts_noti_submit'] ) == 'Save'){

        $enable_review_point_product_page    = (isset($_POST['enable_review_point_product_page']))?sanitize_text_field( $_POST['enable_review_point_product_page'] ):'0';

        $phoen_rewpts_review_notification_product_page    = (isset($_POST['phoen_rewpts_review_notification_product_page']))?sanitize_text_field( $_POST['phoen_rewpts_review_notification_product_page'] ):'';

        $enable_first_order_point    = (isset($_POST['enable_first_order_point']))?sanitize_text_field( $_POST['enable_first_order_point'] ):'0';

        $phoen_rewpts_first_order_notification    = (isset($_POST['phoen_rewpts_first_order_notification']))?sanitize_text_field( $_POST['phoen_rewpts_first_order_notification'] ):'';

        
        $enable_plugin_product_page    = (isset($_POST['enable_plugin_product_page']))?sanitize_text_field( $_POST['enable_plugin_product_page'] ):'0';
            
        $phoen_rewpts_notification_product_page    = isset($_POST['phoen_rewpts_notification_product_page'])?$_POST['phoen_rewpts_notification_product_page'] :'You Will get {points} Points On Completing This Order';
        
        $enable_plugin_cart_page    = (isset($_POST['enable_plugin_cart_page']))?sanitize_text_field( $_POST['enable_plugin_cart_page'] ):'0';
            
        $phoen_rewpts_notification_cart_page    = isset($_POST['phoen_rewpts_notification_cart_page'])?$_POST['phoen_rewpts_notification_cart_page'] :'You Will get {points} Points On Completing This Order';
        
        $enable_plugin_checkout_page    = (isset($_POST['enable_plugin_checkout_page']))?sanitize_text_field( $_POST['enable_plugin_checkout_page'] ):'0';
        
        $phoen_rewpts_notification_checkout_page    = isset($_POST['phoen_rewpts_notification_checkout_page'])?$_POST['phoen_rewpts_notification_checkout_page'] :'You Will get {points} Points On Completing This Order';
        
        $apply_box_enable_on_cart    = (isset($_POST['apply_box_enable_on_cart']))?sanitize_text_field( $_POST['apply_box_enable_on_cart'] ):'0';


        $apply_box_enable_on_checkout    = (isset($_POST['apply_box_enable_on_checkout']))?sanitize_text_field( $_POST['apply_box_enable_on_checkout'] ):'0';

    
        $phoen_apply_box_notification_cart_page    = isset($_POST['phoen_apply_box_notification_cart_page'])?$_POST['phoen_apply_box_notification_cart_page'] :'You can apply {points} Points to get {price} Discount.';

        $phoen_apply_box_notification_checkout_page    = isset($_POST['phoen_apply_box_notification_checkout_page'])?$_POST['phoen_apply_box_notification_checkout_page'] :'You can apply {points} Points to get {price} Discount.';

        $phoen_rewpts_enable_notify_using_paypal=isset($_POST['phoen_rewpts_enable_notify_using_paypal'])?$_POST['phoen_rewpts_enable_notify_using_paypal']:'0';

        $phoen_rewpts_paypal_notification = isset($_POST['phoen_rewpts_paypal_notification'])?$_POST['phoen_rewpts_paypal_notification'] :'If you go ahead with PayPal you will get   {points} Point as a Reward after completing of your order';

        //get referral point mail data 
        $phoen_rewts_referral_point_mail_message    = (isset($_POST['phoen_rewts_referral_point_mail_message']))?wp_kses_post( $_POST['phoen_rewts_referral_point_mail_message'] ):'';

        //get order point mail data
        $phoen_rewts_order_point_mail_heading_color = (isset($_POST['phoen_rewts_order_point_mail_heading_color']))?sanitize_text_field( $_POST['phoen_rewts_order_point_mail_heading_color'] ):'#e98fd7';

        $phoen_rewts_order_point_mail_heading    = (isset($_POST['phoen_rewts_order_point_mail_heading']))?sanitize_text_field( $_POST['phoen_rewts_order_point_mail_heading'] ):'';

        $phoen_rewts_order_point_mail_subject    = (isset($_POST['phoen_rewts_order_point_mail_subject']))?sanitize_text_field( $_POST['phoen_rewts_order_point_mail_subject'] ):'';
        
        $phoen_rewts_order_point_mail_message    = (isset($_POST['phoen_rewts_order_point_mail_message']))?wp_kses_post( $_POST['phoen_rewts_order_point_mail_message'] ):'';

        //birthday message
        $phoen_rewts_birthday_mail_message = (isset($_POST['phoen_rewts_birthday_mail_message']))?wp_kses_post( $_POST['phoen_rewts_birthday_mail_message'] ):'You have been got {points} on your Birthday';        


        $btn_settings=array(

            'enable_review_point_product_page'=>$enable_review_point_product_page,

            'phoen_rewpts_review_notification_product_page'=>$phoen_rewpts_review_notification_product_page,

            'enable_first_order_point'=>$enable_first_order_point,

            'phoen_rewpts_first_order_notification'=>$phoen_rewpts_first_order_notification,

            'enable_plugin_product_page'=>$enable_plugin_product_page,

            'phoen_rewpts_notification_product_page'=>$phoen_rewpts_notification_product_page,
            
            'enable_plugin_cart_page'=>$enable_plugin_cart_page ,
            
            'phoen_rewpts_notification_cart_page'=>$phoen_rewpts_notification_cart_page ,
            
            'enable_plugin_checkout_page'=>$enable_plugin_checkout_page ,
            
            'phoen_rewpts_notification_checkout_page'=>$phoen_rewpts_notification_checkout_page ,
            
            'apply_box_enable_on_cart'=>$apply_box_enable_on_cart ,
            
            'phoen_apply_box_notification_cart_page'=>$phoen_apply_box_notification_cart_page ,
            
            'apply_box_enable_on_checkout'=>$apply_box_enable_on_checkout ,
            
            'phoen_apply_box_notification_checkout_page'=>$phoen_apply_box_notification_checkout_page ,
            
            'phoen_rewpts_enable_notify_using_paypal'=>$phoen_rewpts_enable_notify_using_paypal,
            
            'phoen_rewpts_paypal_notification'=>$phoen_rewpts_paypal_notification,

            'phoen_rewts_referral_point_mail_message'=>$phoen_rewts_referral_point_mail_message,

            'phoen_rewts_order_point_mail_heading_color'=>$phoen_rewts_order_point_mail_heading_color,

            'phoen_rewts_order_point_mail_heading'=>$phoen_rewts_order_point_mail_heading,

            'phoen_rewts_order_point_mail_subject'=>$phoen_rewts_order_point_mail_subject,

            'phoen_rewts_order_point_mail_message'=>$phoen_rewts_order_point_mail_message,

            'phoen_rewts_birthday_mail_message'=> $phoen_rewts_birthday_mail_message,
        );
        
        update_option('phoen_rewpts_notification_settings',$btn_settings);
        
    }
    
}

    $phoen_rewpts_notification_data = get_option('phoen_rewpts_notification_settings');

    $enable_review_point_product_page = isset($phoen_rewpts_notification_data['enable_review_point_product_page'])?$phoen_rewpts_notification_data['enable_review_point_product_page']:'1';

    $enable_first_order_point = isset($phoen_rewpts_notification_data['enable_first_order_point'])?$phoen_rewpts_notification_data['enable_first_order_point']:'1';

    $phoen_rewpts_review_notification_product_page = isset($phoen_rewpts_notification_data['phoen_rewpts_review_notification_product_page'])?$phoen_rewpts_notification_data['phoen_rewpts_review_notification_product_page']:'You Will get {points} Points On Completing This Order';

    $phoen_rewpts_first_order_notification = isset($phoen_rewpts_notification_data['phoen_rewpts_first_order_notification'])?$phoen_rewpts_notification_data['phoen_rewpts_first_order_notification']:'You Will get {points} Points On Completing This Order';


    
    $enable_plugin_product_page = isset($phoen_rewpts_notification_data['enable_plugin_product_page'])?$phoen_rewpts_notification_data['enable_plugin_product_page']:'1';
    
    $enable_plugin_cart_page = isset($phoen_rewpts_notification_data['enable_plugin_cart_page'])?$phoen_rewpts_notification_data['enable_plugin_cart_page']:'1';
    
    $phoen_rewpts_notification_product_page = isset($phoen_rewpts_notification_data['phoen_rewpts_notification_product_page'])?$phoen_rewpts_notification_data['phoen_rewpts_notification_product_page']:'You Will get {points} Points On Completing This Order';
    
    $phoen_rewpts_notification_cart_page = isset($phoen_rewpts_notification_data['phoen_rewpts_notification_cart_page'])?$phoen_rewpts_notification_data['phoen_rewpts_notification_cart_page']:'You Will get {points} Points On Completing This Order';
    
    $enable_plugin_checkout_page = isset($phoen_rewpts_notification_data['enable_plugin_checkout_page'])?$phoen_rewpts_notification_data['enable_plugin_checkout_page']:'1';
    
    $phoen_rewpts_notification_checkout_page = isset($phoen_rewpts_notification_data['phoen_rewpts_notification_checkout_page'])?$phoen_rewpts_notification_data['phoen_rewpts_notification_checkout_page']:'You Will get {points} Points On Completing This Order';
    
    $phoen_rewpts_notification_cart_apply_box = isset($phoen_rewpts_notification_data['apply_box_enable_on_cart'])?$phoen_rewpts_notification_data['apply_box_enable_on_cart']:'1';
    
    $phoen_apply_box_notification_cart_page = isset($phoen_rewpts_notification_data['phoen_apply_box_notification_cart_page'])?$phoen_rewpts_notification_data['phoen_apply_box_notification_cart_page']:'You can apply {points} Points to get {price} Discount.';

    $phoen_rewpts_notification_checkout_apply_box = isset($phoen_rewpts_notification_data['apply_box_enable_on_checkout'])?$phoen_rewpts_notification_data['apply_box_enable_on_checkout']:'1';

    $phoen_apply_box_notification_checkout_page = isset($phoen_rewpts_notification_data['phoen_apply_box_notification_checkout_page'])?$phoen_rewpts_notification_data['phoen_apply_box_notification_checkout_page']:'You can apply {points} Points to get {price} Discount.';

    $phoen_rewpts_enable_notify_using_paypal=isset($phoen_rewpts_notification_data['phoen_rewpts_enable_notify_using_paypal'])?$phoen_rewpts_notification_data['phoen_rewpts_enable_notify_using_paypal']:'1';

    $phoen_rewpts_paypal_notification = isset($_POST['phoen_rewpts_paypal_notification'])?$_POST['phoen_rewpts_paypal_notification'] :'If you go ahead with PayPal you will get   {points} Point as a Reward after completing of your order';

    $phoen_rewts_referral_point_mail_message = isset($phoen_rewpts_notification_data['phoen_rewts_referral_point_mail_message'])?$phoen_rewpts_notification_data['phoen_rewts_referral_point_mail_message']:'';

    $phoen_rewts_order_point_mail_heading_color = isset($phoen_rewpts_notification_data['phoen_rewts_order_point_mail_heading_color'])?$phoen_rewpts_notification_data['phoen_rewts_order_point_mail_heading_color']:'#e98fd7';

     $phoen_rewts_order_point_mail_heading = isset($phoen_rewpts_notification_data['phoen_rewts_order_point_mail_heading'])?$phoen_rewpts_notification_data['phoen_rewts_order_point_mail_heading']:'';

    $phoen_rewts_order_point_mail_subject = isset($phoen_rewpts_notification_data['phoen_rewts_order_point_mail_subject'])?$phoen_rewpts_notification_data['phoen_rewts_order_point_mail_subject']:'';

    $phoen_rewts_order_point_mail_message = isset($phoen_rewpts_notification_data['phoen_rewts_order_point_mail_message'])?$phoen_rewpts_notification_data['phoen_rewts_order_point_mail_message']:'';

    $phoen_rewts_birthday_mail_message = isset($phoen_rewpts_notification_data['phoen_rewts_birthday_mail_message'])?$phoen_rewpts_notification_data['phoen_rewts_birthday_mail_message']:'';

        
 ?>

<div id="phoeniixx_phoe_book_wrap_profile-page" style="background:white;padding: 10px;margin-top: 2%;"  class=" phoeniixx_phoe_book_wrap_profile_div">

    <form method="post" id="phoeniixx_phoe_book_wrap_profile_form" action="">

    <?php wp_nonce_field( 'phoen_rewpts_notification_form_action', 'phoen_rewpts_notification_form_action_form_nonce_field' ); ?>

        <table class="form-table">

            <tbody>

               <!-- <h2 style="color:#58504d;border-bottom: 1px solid #ccbbb6;"><?= _e(' Notification Setting','phoen-rewpts') ?></h2> -->

               <tr class="phoeniixx_phoe_rewpts_wrap phoen-user-user-login-wrap">

                    <th>

                        <label><?php _e('Enable Review Points on Product Page ','phoen-rewpts'); ?> </label>

                    </th>

                    <td>

                        <input type="checkbox" name="enable_review_point_product_page" id="enable_review_point_product_page"
                            value="1" <?php checked( $enable_review_point_product_page, 1 ); ?>>

                    </td>

                </tr>

                <tr class="phoeniixx_phoe_rewpts_wrap phoen-user-user-login-wrap">

                    <th>

                        <label><?php _e('Review Notification Message on Product Page','phoen-rewpts'); ?> </label>

                    </th>

                    <td>
                        <textarea rows="3" cols="50" name="phoen_rewpts_review_notification_product_page"><?php echo esc_html($phoen_rewpts_review_notification_product_page);?></textarea>
                        <br />{points} number of points earned;
                    </td>

                </tr>


                <tr class="phoeniixx_phoe_rewpts_wrap phoen-user-user-login-wrap">

                    <th>

                        <label><?php _e('Enable First Order Points on Cart/Checkout Page ','phoen-rewpts'); ?> </label>

                    </th>

                    <td>

                        <input type="checkbox" name="enable_first_order_point" id="enable_first_order_point"
                            value="1" <?php checked( $enable_first_order_point, 1 ); ?>>

                    </td>

                </tr>

                <tr class="phoeniixx_phoe_rewpts_wrap phoen-user-user-login-wrap">

                    <th>

                        <label><?php _e('First Order Notification Message on Cart/Checkout Page','phoen-rewpts'); ?> </label>

                    </th>

                    <td>
                        <textarea rows="3" cols="50" name="phoen_rewpts_first_order_notification"><?php echo esc_html($phoen_rewpts_first_order_notification);?></textarea>
                        <br />{points} number of points earned;
                    </td>

                </tr>


                <tr class="phoeniixx_phoe_rewpts_wrap phoen-user-user-login-wrap">

                    <th>

                        <label><?php _e('Enable Points Notification on Product Page ','phoen-rewpts'); ?> </label>

                    </th>

                    <td>

                        <input type="checkbox" name="enable_plugin_product_page" id="enable_plugin_product_page"
                            value="1" <?php checked( $enable_plugin_product_page, 1 ); ?>>

                    </td>

                </tr>

                <tr class="phoeniixx_phoe_rewpts_wrap phoen-user-user-login-wrap">

                    <th>

                        <label><?php _e('Notification Message on Product Page','phoen-rewpts'); ?> </label>

                    </th>

                    <td>
                        <textarea rows="3" cols="50" name="phoen_rewpts_notification_product_page"><?php echo esc_html($phoen_rewpts_notification_product_page);?></textarea>
                        <br />{points} number of points earned;
                    </td>

                </tr>

                <tr class="phoeniixx_phoe_rewpts_wrap phoen-user-user-login-wrap">

                    <th>

                        <label><?php _e('Enable Points Notification on Cart Page','phoen-rewpts'); ?> </label>

                    </th>

                    <td>

                        <input type="checkbox" name="enable_plugin_cart_page" id="enable_plugin_cart_page" value="1"
                            <?php checked( $enable_plugin_cart_page, 1 ); ?>>

                    </td>

                </tr>
                <tr class="phoeniixx_phoe_rewpts_wrap phoen-user-user-login-wrap">

                    <th>

                        <label><?php _e('Notification Message on Cart Page','phoen-rewpts'); ?> </label>

                    </th>

                    <td>
                        <textarea rows="3" cols="50" name="phoen_rewpts_notification_cart_page"><?php echo esc_html($phoen_rewpts_notification_cart_page);?></textarea>
                        <br />{points} number of points earned;
                    </td>

                </tr>
                <tr class="phoeniixx_phoe_rewpts_wrap phoen-user-user-login-wrap">

                    <th>

                        <label><?php _e('Enable Points Notification on Checkout Page','phoen-rewpts'); ?> </label>

                    </th>

                    <td>

                        <input type="checkbox" name="enable_plugin_checkout_page" id="enable_plugin_checkout_page"
                            value="1" <?php checked( $enable_plugin_checkout_page, 1 ); ?>>

                    </td>

                </tr>
                <tr class="phoeniixx_phoe_rewpts_wrap phoen-user-user-login-wrap">

                    <th>

                        <label><?php _e('Notification Message on Checkout Page','phoen-rewpts'); ?> </label>

                    </th>

                    <td>
                        <textarea rows="3" cols="50" name="phoen_rewpts_notification_checkout_page"><?php echo esc_html($phoen_rewpts_notification_checkout_page);?></textarea>
                        <br />{points} number of points earned;
                    </td>

                </tr>
                <tr class="phoen-user-user-login-wrap">

                    <th>

                        <label><?php _e('Enable Apply Point On Cart Page','phoen-rewpts'); ?> </label>

                    </th>

                    <td>

                        <input type="checkbox" name="apply_box_enable_on_cart" id="apply_box_enable_on_cart" value="1"
                            <?php checked( $phoen_rewpts_notification_cart_apply_box, 1 ); ?>>

                    </td>

                </tr>
                <tr class="phoeniixx_phoe_rewpts_wrap phoen-user-user-login-wrap">

                    <th>

                        <label><?php _e('Apply Box Notification Message on Cart Page','phoen-rewpts'); ?> </label>

                    </th>

                    <td>
                        <textarea rows="3" cols="50" name="phoen_apply_box_notification_cart_page"><?php echo esc_html($phoen_apply_box_notification_cart_page);?></textarea>
                        <br />{points} number of points earned;<br />
                        {price} amount of point;
                    </td>

                </tr>
                <tr class="phoen-user-user-login-wrap">
            
                    <th>
                    
                        <label><?php _e('Enable Apply Point On Checkout Page','phoen-rewpts'); ?> </label>
                        
                    </th>
                    
                    <td>
                    
                        <input type="checkbox"  name="apply_box_enable_on_checkout" id="apply_box_enable_on_checkout" value="1" <?php checked( $phoen_rewpts_notification_checkout_apply_box, 1 ); ?>>
                        
                    </td>
                    
                </tr>
                <tr class="phoeniixx_phoe_rewpts_wrap phoen-user-user-login-wrap">
                
                    <th>
                    
                        <label><?php _e('Apply Box Notification Message on Checkout Page','phoen-rewpts'); ?> </label>
                        
                    </th>
                    
                    <td>
                        <textarea rows="3" cols="50" name="phoen_apply_box_notification_checkout_page"><?php echo esc_html($phoen_apply_box_notification_checkout_page);?></textarea>
                        <br />{points} number of points earned;<br />
                        {price} amount of point;
                    </td>
                    
                </tr>

                <tr class="phoen-user-user-login-wrap">
            
                        <th>
                        
                            <label><?php _e('Enable Notification For Using Paypal Gateway','phoen-rewpts'); ?> </label>
                            
                        </th>
                        
                        <td>
                        
                            <input type="checkbox"  name="phoen_rewpts_enable_notify_using_paypal" id="phoen_rewpts_enable_notify_using_paypal" value="1" <?php checked( $phoen_rewpts_enable_notify_using_paypal, 1 ); ?>>
                            
                        </td>
                        
                </tr>

                <tr class="phoeniixx_phoe_rewpts_wrap phoen-user-user-login-wrap">
                
                    <th>
                    
                        <label><?php _e('Notification For Using Paypal Payment Gateway','phoen-rewpts'); ?> </label>
                        
                    </th>
                    
                    <td>
                        <textarea rows="3" cols="50" name="phoen_rewpts_paypal_notification"><?php echo esc_html($phoen_rewpts_paypal_notification);?></textarea>
                    <br />{points} number of points earned;<br />
                    </td>
                
                </tr>

            </tbody>

        </table><br><br>

        <table class="form-table">

            <tbody>
            
                <h3 style="color:#58504d;border-bottom: 1px solid #ccbbb6;"><?php _e(' Send Referral Message with Referral Code to User Via Mail','phoen-rewpts') ?></h3>

                <tr class="phoeniixx_phoe_rewpts_wrap phoen-user-user-login-wrap">
                    
                    <th>
                         <label><?php _e('Referral Message ','phoen-rewpts'); ?> </label>
                    </th>
                    
                    <td>
                        <?php

                            wp_editor( $phoen_rewts_referral_point_mail_message , 'phoen_rewts_referral_point_mail_message', array(
                                'wpautop'       => true,
                                'media_buttons' => false,
                                'textarea_name' => 'phoen_rewts_referral_point_mail_message',
                                'textarea_rows' => 7
                            ));

                        ?>
                        <br />{points} number of points earned;
                    </td>

                </tr>

            </tbody>

        </table><br><br>

        <table class="form-table">

            <tbody>
            
                <h3 style="color:#58504d;border-bottom: 1px solid #ccbbb6;"><?php _e('Notification For Send Order Points Via Mail','phoen-rewpts') ?></h3>

                <tr class="phoeniixx_phoe_rewpts_wrap phoen-user-user-login-wrap">

                    <th>
                         <label><?php _e('Heading Background Color ','phoen-rewpts'); ?> </label>
                    </th>
                
                    <td>
                        <input class="btn_color_picker btn_bor_col" type="text" name="phoen_rewts_order_point_mail_heading_color" value="<?php _e($phoen_rewts_order_point_mail_heading_color)?>">
                    </td>
               
               </tr>
            
                <tr class="phoeniixx_phoe_rewpts_wrap phoen-user-user-login-wrap">

                    <th>
                         <label><?php _e('Heading ','phoen-rewpts'); ?> </label>
                    </th>
                
                    <td>
                        <input style="width: 40%;" type="text" name="phoen_rewts_order_point_mail_heading" value="<?php _e($phoen_rewts_order_point_mail_heading)?>">
                    </td>
               
               </tr>

                <tr class="phoeniixx_phoe_rewpts_wrap phoen-user-user-login-wrap">
                    
                    <th>
                         <label><?php _e('Subject ','phoen-rewpts'); ?> </label>
                    </th>
                
                    <td>
                        <input style="width: 40%;" type="text" name="phoen_rewts_order_point_mail_subject" value="<?php _e($phoen_rewts_order_point_mail_subject)?>">
                    </td>

                </tr>

                <tr class="phoeniixx_phoe_rewpts_wrap phoen-user-user-login-wrap">
                    
                    <th>
                         <label><?php _e('Message ','phoen-rewpts'); ?> </label>
                    </th>
                    
                    <td>
                        <?php

                            wp_editor( $phoen_rewts_order_point_mail_message , 'phoen_rewts_order_point_mail_message', array(
                                'wpautop'       => true,
                                'media_buttons' => false,
                                'textarea_name' => 'phoen_rewts_order_point_mail_message',
                                'textarea_rows' => 7
                            ));

                        ?>
                    </td>

                </tr>

            </tbody>

        </table>

        <table class="form-table">

             <tbody>
            
                 <h3 style="color:#58504d;border-bottom: 1px solid #ccbbb6;"><?php _e(' Birthday Points Notification Mail','phoen-rewpts') ?></h3>

                <tr class="phoeniixx_phoe_rewpts_wrap phoen-user-user-login-wrap">

                    <th>
                         <label><?php _e(' Message ','phoen-rewpts'); ?> </label>
                    </th>
                
                    <td>
                        <?php

                            wp_editor( $phoen_rewts_birthday_mail_message , 'phoen_rewts_birthday_mail_message', array(
                                'wpautop'       => true,
                                'media_buttons' => false,
                                'textarea_name' => 'phoen_rewts_birthday_mail_message',
                                'textarea_rows' => 7
                            ));

                        ?>
                        <br />{points} number of points earned;
                    </td>
               
               </tr>

            </tbody>
            
        </table>

        <br />

       <input type="submit" value="Save" name="rewpts_noti_submit" id="submit" class="button button-primary">
    </form>

</div>