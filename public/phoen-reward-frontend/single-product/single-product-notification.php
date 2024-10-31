<?php

$phoen_rewpts_first_review_point = ($this->phoe_set_point_value_data['first_review_points']>0) ? $this->phoe_set_point_value_data['first_review_points']:'';

$enable_review_point_product_page = (!empty($this->phoen_rewpts_notification_data['enable_review_point_product_page']))?$this->phoen_rewpts_notification_data['enable_review_point_product_page']:'0';

$phoen_rewpts_review_notification_product_page = (!empty($this->phoen_rewpts_notification_data['phoen_rewpts_review_notification_product_page'])) ? $this->phoen_rewpts_notification_data['phoen_rewpts_review_notification_product_page'] : 'You Can Get {points} On First Approved Product Review After Successfully Purchasing This Product';
    
$phoen_rewpts_notification_product_page = (!empty($this->phoen_rewpts_notification_data['phoen_rewpts_notification_product_page'])) ? $this->phoen_rewpts_notification_data['phoen_rewpts_notification_product_page'] : 'You Will get {points} Points On Completing This Order';

//______________________________________________________________________________________________________//

if($product->is_type('variable')){

    $product = wc_get_product($post->ID);

    $variations = $product->get_available_variations();
    
    $variations_id = wp_list_pluck( $variations, 'variation_id' );

    foreach ($variations_id as $_id) { 

        $variations_value = get_post_meta($_id, '_regular_price', true);
        
        echo "<input type='hidden' value='{$variations_value}' id='{$_id}'/>";
    }

     echo '<div class="alert hide phoen_rewpts_reward_message_on_cart" style="z-index: 999;top:8%;"><span class="msg" id="phoen_variation_pint_message"></span></div>';
        
        ?>
    <input type="hidden" value="<?php echo get_woocommerce_currency_symbol(); ?>" class="phoen_symbole">
    <script>
        jQuery(document).ready(function() {
            setTimeout(function() {
                if (!jQuery('.woocommerce-variation-add-to-cart .single_add_to_cart_button').hasClass(
                        'disabled')) {
                    variation_notification();
                }else{
                    jQuery('.alert').removeClass("show");
                    jQuery('.alert').addClass("hide");
                }
            }, 500)
        });

        jQuery(document).on("found_variation", ".variations_form", variation_notification);

        function variation_notification() {
            
            jQuery('.alert').addClass("show");
            jQuery('.alert').removeClass("hide");
            jQuery('.alert').addClass("showAlert");
            
            var alt                             = jQuery(".phoen_symbole").val();
            var decimal_point_reward_           = '<?php echo wc_get_price_decimal_separator();?>';
            var thousand_seprator_point_reward_ = '<?php echo wc_get_price_thousand_separator();?>';
            var product_price                   = '0';
            var variations_id = jQuery('.variation_id').val();
            var variations_value = jQuery(`#${variations_id}`).val();

            if (jQuery('.woocommerce-variation-add-to-cart .single_add_to_cart_button').hasClass('disabled')) {
                var price = '0';
            } else {

                if (jQuery(".woocommerce-variation-price .price ins").length == 1) {
                    var price = jQuery(".woocommerce-variation-price .price").find("ins .amount").text();
                } else {
                    var price = jQuery(".woocommerce-variation-price .price").find(".amount").text();
                }
                if (price == '') {
                    var price = jQuery(".entry-summary .price .woocommerce-Price-amount").text();
                }
            }

            if (thousand_seprator_point_reward_ != ',') {
                product_price = price.replace(/[.,]/g, function(m) {
                    return m === ',' ? '.' : '';
                });
            } else {
                var product_price = price.replace(',', '');
            }
            
            var product_price   = product_price.replace(alt, '');
            var product_price   = product_price.split(alt);
            var product_price   = product_price[0];
            var reward_value    = '<?php echo $reward_value ?>';
            var enable_point_notification_message = '<?php echo $phoen_rewpts_notification_product_page ?>';
            var product_price_total = Math.round(product_price);
            var total_price = (parseInt(variations_value) * reward_value);
            // var total_price = Math.round(total_price);

            if (total_price > 0) {
                var phoen_reward_notification_message = enable_point_notification_message.replace("{points}",total_price);
                jQuery('#phoen_variation_pint_message').html(phoen_reward_notification_message);

                setTimeout(function(){
                  jQuery('.alert').removeClass("show");
                  jQuery('.alert').addClass("hide");
               },15000);
            }
        }
    </script>
<?php    
}else{
    if($phoen_rewards_point != 0 ){
       $point_message = '<div class="alert hide" style="z-index: 999;top:8%;" style="background_color:{$toaster_background_color};color:{$toaster_text_color}">';

       $point_message .= '<span class="msg">'.str_replace("{points}","$phoen_rewards_point",$phoen_rewpts_notification_product_page).'</span></div>';
        _e($point_message); ?>

        <script>
            jQuery(document).ready(function(){
                setTimeout(function(){
                   jQuery('.alert').addClass("show");
                   jQuery('.alert').removeClass("hide");
                   jQuery('.alert').addClass("showAlert");

                },1000);

               setTimeout(function(){
                  jQuery('.alert').removeClass("show");
                  jQuery('.alert').addClass("hide");
               },15000);

            });
            </script>
    <?php }   
}

//review point notification
if($phoen_rewpts_first_review == 0 && !empty($phoen_rewpts_first_review_point) && $enable_review_point_product_page == '1'):

    $review_message = '<div class="alert hide" style="z-index: 999;top:17%;"><span class="msg">'.str_replace("{points}","$phoen_rewpts_first_review_point",$phoen_rewpts_review_notification_product_page).'</span></div>';

     _e($review_message);

endif;
?>