<?php 

global $woocommerce;

$current_currency_symbol    = get_woocommerce_currency_symbol();

$phoen_reward_point_value   = phoen_reward_point_value();

$reedem_value               = $phoen_reward_point_value['reedem_value'];

$total_reward_point         = phoen_rewpts_user_reward_point();
      
$total_reward_amount        = round($total_reward_point/$reedem_value,2);

$cart_total                 = get_cart_total_without_including_tax();

$button_bg_color            = $this->styling_tab_settings['apply_btn_bg_col'];

$button_text_color          = $this->styling_tab_settings['apply_btn_txt_col'];
//_______________________________________________________________________//
    
$phoen_apply_box_notification_cart_page = isset($this->phoen_rewpts_notification_data['phoen_apply_box_notification_cart_page']) ? $this->phoen_rewpts_notification_data['phoen_apply_box_notification_cart_page'] : 'You can apply {points} Points to get {price} Discount.';

$apply_btn_title    = isset($this->styling_tab_settings['apply_btn_title']) ?  $this->styling_tab_settings['apply_btn_title'] : 'APPLY POINTS';

if($total_reward_point > 0 && !empty($total_reward_point)):

  $maximum_price = ($cart_total >= $total_reward_amount) ? $total_reward_point : ($cart_total*$reedem_value);

  $phoen_apply_box_notification_cart_page = str_replace("{points}","$total_reward_point",$phoen_apply_box_notification_cart_page);
          
  $total_reward_point = str_replace("{price}","$current_currency_symbol$total_reward_amount",$phoen_apply_box_notification_cart_page); 


    if(!in_array('reward amount',$woocommerce->cart->get_applied_coupons())):  ?>

        <div style="padding: 1%;font-size: 100%;" class='woocommerce-cart-notice woocommerce-cart-notice-minimum-amount woocommerce-info'>

            <div class="message" style="width: 50%;"><?= _e($total_reward_point)?></div>

            <div class='phoen_rewpts_pts_link_div cart_apply_btn'>

                <form method='post' action=''>
                    
                    <input style="border-bottom: 1px solid black;font-size: 100%;" type='number' name='phoe_set_point_value' min='1' max='<?= _e($maximum_price)?>' value='' placeholder='Enter the points' class='phoen_edit_points_input' required>
                    
                    <input style="font-size: 100%;background: <?= _e($button_bg_color)?>;color: <?= _e($button_text_color)?>;" type='submit'  value='<?= _e($apply_btn_title)?>' name='apply_points'>
                    
                </form>

            </div>
                
        </div>
    
  <?php endif; ?>

<?php endif; ?>