(function( $ ) {
	'use strict';

	/**
	 * All of the code for your admin-facing JavaScript source
	 * should reside in this file.
	 *
	 * Note: It has been assumed you will write jQuery code here, so the
	 * $ function reference has been prepared for usage within the scope
	 * of this function.
	 *
	 * This enables you to define handlers, for when the DOM is ready:
	 *
	 * $(function() {
	 *
	 * });
	 *
	 * When the window is loaded:
	 *
	 * $( window ).load(function() {
	 *
	 * });
	 *
	 * ...and/or other possibilities.
	 *
	 * Ideally, it is not considered best practise to attach more than a
	 * single DOM-ready or window-load handler for a particular page.
	 * Although scripts in the WordPress core, Plugins and Themes may be
	 * practising this, we should strive to set a better example in our own work.
	 */

	jQuery(document).ready(function() {
				
		jQuery('.btn_color_picker').wpColorPicker();
		
		jQuery('#phoen_rewpts_point_type').on('change',function(){
			
			if(jQuery(this).val()=='percentage_price'){
				
				jQuery('#phoen_rewpts_point_type_div2').hide();
				
				jQuery('#phoen_rewpts_point_type_div3').show();
				
				jQuery('#phoen_rewpts_point_type_div').show();
			
			}else{
				jQuery('#phoen_rewpts_point_type_div2').show();
				
				jQuery('#phoen_rewpts_point_type_div3').show();
				
				jQuery('#phoen_rewpts_point_type_div').hide();
			}
		});
		jQuery(".phoen_points_expiry_month,.phoen_points_assignment_dates").datepicker({
			dateFormat : "dd-mm-yy"
			}
		);	
		jQuery('.phoen_reword_select_to').select2();
	});

})( jQuery );
