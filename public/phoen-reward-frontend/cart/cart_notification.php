<?php 

global $woocommerce;

$user_order_count = phoen_reward_check_first_order();

$phoen_reward_point_value = phoen_reward_point_value();

$reward_value = $phoen_reward_point_value['reward_value'];

$phoen_total_product_point_value = phoen_get_product_price_from_cart_total($reward_value);

//_____________________________________________________________________//

$first_order_points_val = isset($this->phoe_set_point_value_data['first_order_points'])?$this->phoe_set_point_value_data['first_order_points']:'';

$enable_first_order_point = isset($this->phoen_rewpts_notification_data['enable_first_order_point'])?$this->phoen_rewpts_notification_data['enable_first_order_point']:'0';
   
$phoen_rewpts_notification_cart_page = isset($this->phoen_rewpts_notification_data['phoen_rewpts_notification_cart_page'])?$this->phoen_rewpts_notification_data['phoen_rewpts_notification_cart_page']:'You Will get {points} Points On Completing This Order';

$phoen_rewpts_first_order_notification = isset($this->phoen_rewpts_notification_data['phoen_rewpts_first_order_notification'])?$this->phoen_rewpts_notification_data['phoen_rewpts_first_order_notification']:'You Will get {points} Points On Your First order';

//________________________________________________________________//



$cart_message  = '<div class="alert hide" style="z-index: 999;top:8%;">';
$cart_message .= '<span class="msg">'.str_replace("{points}","$phoen_total_product_point_value",$phoen_rewpts_notification_cart_page).'</span></div>';

if( !empty($first_order_points_val) && $user_order_count == 0 && $enable_first_order_point == '1'):

   $cart_message .= '<div class="alert hide" style="z-index: 999;top:17%;">';
   $cart_message .= '<span class="msg">'.str_replace("{points}","$first_order_points_val",$phoen_rewpts_first_order_notification).'</span></div>';

endif; 

_e($cart_message);

?>
<script>
jQuery(document).ready(function(){
   jQuery('.alert').addClass("show");
   jQuery('.alert').removeClass("hide");
   jQuery('.alert').addClass("showAlert");

   setTimeout(function(){
      jQuery('.alert').removeClass("show");
      jQuery('.alert').addClass("hide");
   },15000);

});
</script>