<?php  if ( ! defined( 'ABSPATH' ) ) exit; 

$styling_tab_settings = get_option('phoen_rewpts_custom_btn_styling');

		$toaster_background_color = (!empty($styling_tab_settings['toaster_bg_color'])) ? $styling_tab_settings['toaster_bg_color'] : '#3f3f3f';

		$toaster_text_color = (!empty($styling_tab_settings['toaster_text_color'])) ? $styling_tab_settings['toaster_text_color'] : '#ffffff';

		$get_div_bg_color       = (isset($styling_tab_settings['div_bg_col']))?( $styling_tab_settings['div_bg_col'] ):'#ffffff';

		$get_div_border_style   = (isset($styling_tab_settings['div_border_style']))?( $styling_tab_settings['div_border_style'] ):'solid';

		$get_div_border         = (isset($styling_tab_settings['div_border']))?( $styling_tab_settings['div_border'] ):'1';

		$get_div_bor_col        = (isset($styling_tab_settings['div_bor_col']))?( $styling_tab_settings['div_bor_col'] ):'black';

		$get_div_radius         = (isset($styling_tab_settings['div_radius']))?( $styling_tab_settings['div_radius'] ):'0';

		$get_apply_btn_radius   = (isset($styling_tab_settings['apply_btn_radius']))?( $styling_tab_settings['apply_btn_radius'] ):'0';

		$get_apply_btn_hov_col  = (isset($styling_tab_settings['apply_btn_hov_col']))?( $styling_tab_settings['apply_btn_hov_col'] ):'#ffffff';

		$get_apply_btn_txt_hov_col = (isset($styling_tab_settings['apply_btn_txt_hov_col']))?( $styling_tab_settings['apply_btn_txt_hov_col'] ):'black';

	
$gen_settings=get_option('phoen_rewpts_custom_btn_styling');
	
		$apply_btn_title    = (isset($gen_settings['apply_btn_title']))?( $gen_settings['apply_btn_title'] ):'APPLY POINTS';
		
		
		$apply_topmargin    = (isset($gen_settings['apply_topmargin']))?( $gen_settings['apply_topmargin'] ):'8';
		
		$apply_rightmargin  = (isset($gen_settings['apply_rightmargin']))?( $gen_settings['apply_rightmargin'] ):'10';
		
		$apply_bottommargin = (isset($gen_settings['apply_bottommargin']))?( $gen_settings['apply_bottommargin'] ):'8';
		
		$apply_leftmargin   = (isset($gen_settings['apply_leftmargin']))?( $gen_settings['apply_leftmargin'] ):'10';
						
		$apply_btn_bg_col   = (isset($gen_settings['apply_btn_bg_col']))?( $gen_settings['apply_btn_bg_col'] ):'';
		
		$apply_btn_txt_col  = (isset($gen_settings['apply_btn_txt_col']))?( $gen_settings['apply_btn_txt_col'] ):'#000000';

		$apply_btn_txt_hov_col=  (isset($gen_settings['apply_btn_txt_hov_col']))?( $gen_settings['apply_btn_txt_hov_col'] ):'';
		
		$apply_btn_hov_col    = (isset($gen_settings['apply_btn_hov_col']))?( $gen_settings['apply_btn_hov_col'] ):'';
		
		$apply_btn_border_style    = (isset($gen_settings['apply_btn_border_style']))?( $gen_settings['apply_btn_border_style'] ):'none';
		
		$apply_btn_border    = (isset($gen_settings['apply_btn_border']))?( $gen_settings['apply_btn_border'] ):'0';
		
		$apply_btn_bor_col    = (isset($gen_settings['apply_btn_bor_col']))?( $gen_settings['apply_btn_bor_col'] ):'';
		
		$apply_btn_rad    = (isset($gen_settings['apply_btn_rad']))?( $gen_settings['apply_btn_rad'] ):'0';
		
		$div_rad    = (isset($gen_settings['div_rad']))?( $gen_settings['div_rad'] ):'0';
		
		
				
		$div_bg_col    = (isset($gen_settings['div_bg_col']))?( $gen_settings['div_bg_col'] ):'#fff';
		
		$div_border_style    = (isset($gen_settings['div_border_style']))?( $gen_settings['div_border_style'] ):'solid';
		
		$div_border    = (isset($gen_settings['div_border']))?( $gen_settings['div_border'] ):'1';
		
		$div_bor_col    = (isset($gen_settings['div_bor_col']))?( $gen_settings['div_bor_col'] ):'#ccc';
				
?>

<style>
	.phoen_rewpts_pts_link_div {					
		display: inline-block;	
	}
	.phoen_rewpts_redeem_message_on_cart {
		display: inline-block;
		font-size: 14px;
		line-height: 32px;	
	}
	.phoen_rewpts_reward_message_on_cart {
		display: inline-block;
		border-bottom: <?= _e($get_div_border)?>px <?= _e($get_div_border_style)?> <?= _e($get_div_bor_col)?>;
		border-radius: <?= _e($get_div_radius)?>px;
		background-color:<?= _e($get_div_bg_color)?>;
		padding:8px;\
		width: 100%;
	}

	.phoen_rewpts_pts_link_div_main {
	    background: <?php echo $div_bg_col; ?> none repeat scroll 0 0;
	    border: <?php echo $div_border; ?>px <?php echo $div_border_style; ?> <?php echo $div_bor_col; ?>;
	    display: block;
	    margin: 15px 0;
	    overflow: auto;
	    padding: 5px;
		border-radius:<?php echo $div_rad;?>px;
	}

	.phoen_rewpts_pts_link_div_main .phoen_rewpts_pts_link_div {
	    float: right;
	}

	.phoen_rewpts_pts_link_div_main .phoen_rewpts_pts_link_div .button {
		/*padding: <?php echo $apply_topmargin;?>px <?php echo $apply_rightmargin;?>px <?php echo $apply_bottommargin;?>px <?php echo $apply_leftmargin;?>px; */
	    font-weight: 400;
		background: <?php echo $apply_btn_bg_col;?>;
		border: <?php echo $apply_btn_border; ?>px <?php echo $apply_btn_border_style; ?> <?php echo $apply_btn_bor_col; ?>;
		color: <?php echo $apply_btn_txt_col; ?>;
		border-radius:<?php echo $apply_btn_rad;?>px;
	}

	.phoen_rewpts_pts_link_div_main .phoen_rewpts_pts_link_div .button:hover {
		background: <?php echo $apply_btn_hov_col;?>;
		color: <?php echo $apply_btn_txt_hov_col; ?>;
	}

	.woocommerce-cart-notice {
		border-bottom: <?= _e($get_div_border)?>px <?= _e($get_div_border_style)?> <?= _e($get_div_bor_col)?>;
		border-radius: <?= _e($get_div_radius)?>px;
		background-color:<?= _e($get_div_bg_color)?>;
	}

	.woocommerce-cart-notice.woocommerce-cart-notice-minimum-amount.woocommerce-info {
		display: flex;
		align-items: center;
	}

	.woocommerce-cart-notice.woocommerce-cart-notice-minimum-amount.woocommerce-info a:hover{
		background: <?= _e($get_apply_btn_hov_col)?>;
		color:<?= _e($get_apply_btn_txt_hov_col)?>;
		border-radius: <?= _e($get_div_radius)?>px;
		padding:0px;
	}

	.woocommerce-cart .woocommerce-cart-notice-minimum-amount .phoen_rewpts_pts_link_div.cart_apply_btn {
		margin: 0;
		width: 50%;
		max-width: 100%;
	}

	.woocommerce-cart-notice.woocommerce-cart-notice-minimum-amount.woocommerce-info .primary{
		text-decoration: none;
		background: <?= $styling_tab_settings['apply_btn_bg_col']?_e($styling_tab_settings['apply_btn_bg_col']):'#dd3333'?>;
		color: <?= $styling_tab_settings['apply_btn_txt_col']?_e($styling_tab_settings['apply_btn_txt_col']):'#000000'?>;
		border-radius: <?= _e($get_apply_btn_radius)?>
	}

	.woocommerce-cart-notice form {
		display: flex;
	}

	.woocommerce-account .user_reward_total {
					display: flex;
					justify-content: space-between;
				}

	.woocommerce-account .user_reward_total p {
		background-color: #e7e7e7;
		padding: 5px 15px;
		border-radius: 5px;
		text-transform: uppercase;
		font-weight: 500;
		letter-spacing: 0.5px;
		margin-bottom: 5px;
	}

	.woocommerce-account table.phoen_my_account_dashboard_point_table th{
		background-color: #e7e7e7;
	}

	@media only screen and (max-width: 350px) {
 	
		.woocommerce-cart .woocommerce-cart-notice-minimum-amount .phoen_rewpts_pts_link_div.cart_apply_btn {
			margin: 0;
			width: 100%;
			max-width: 100%;
		}
		
		.woocommerce-cart-notice.woocommerce-cart-notice-minimum-amount.woocommerce-info {

			flex-wrap: wrap;
		}
	}


.alert{
  background: <?php _e($toaster_background_color)?>;
  padding: 9px 20px;
  min-width: 420px;
  position: fixed;
  right: 0;
  top: 10px;
  border-radius: 4px;
  /*border-left: 8px solid #0e0e0d;*/
  overflow: hidden;
  opacity: 0;
  pointer-events: none;
}
.alert.showAlert{
  opacity: 1;
  pointer-events: auto;
}
.alert.show{
  animation: show_slide 1s ease forwards;
}
@keyframes show_slide {
  0%{
    transform: translateX(100%);
  }
  40%{
    transform: translateX(-10%);
  }
  80%{
    transform: translateX(0%);
  }
  100%{
    transform: translateX(-10px);
  }
}
.alert.hide{
  animation: hide_slide 1s ease forwards;
}
@keyframes hide_slide {
  0%{
    transform: translateX(-10px);
  }
  40%{
    transform: translateX(0%);
  }
  80%{
    transform: translateX(-10%);
  }
  100%{
    transform: translateX(100%);
  }
}

.alert .msg{
  padding: 0 0px;
  font-size: 16px;
  color: <?php _e($toaster_text_color)?>;;
}
.alert .close-btn{
  position: absolute;
  right: 0px;
  top: 50%;
  transform: translateY(-50%);
  background: #ffd080;
  padding: 20px 18px;
  cursor: pointer;
}
.alert .close-btn:hover{
  background: #ffc766;
}
.alert .close-btn .fas{
  color: #ce8500;
  font-size: 22px;
  line-height: 40px;
}


@media only screen and (max-width: 600px) {
	.alert{
		width: 0;
    max-width:auto;
    min-width:auto;
    width: 75%;
	}

}
</style>