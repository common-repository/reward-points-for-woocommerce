<?php 

if ( ! class_exists( 'WP_List_Table' ) ) {
	require_once( ABSPATH . 'wp-admin/includes/class-wp-list-table.php' );
}

class Phoen_Reward_All_User extends WP_List_Table {

	/** Class constructor */
	public function __construct() {

		parent::__construct( [
			'singular' => __( 'Reward', ' phoen-rewpts' ), //singular name of the listed records
			'plural'   => __( 'Rewards', ' phoen-rewpts' ), //plural name of the listed records
			'ajax'     => false //should this table support ajax?
		] );

		//form subtting add reward 
		if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['update_points'])){   

			$get_add_reward_nonce=isset($_POST['_addRewardNonce'])?sanitize_text_field($_POST['_addRewardNonce']):"";

	 		if (!wp_verify_nonce($get_add_reward_nonce,'_add_reward_nonce')) {
	 			die("This form is submit only for correct nonce");
	 		} 
			
			$phoen_update_data = isset($_POST['phoen_update_data'])?$_POST['phoen_update_data']:'';
			
			$phoen_hidden_user_id=isset($_POST['phoen_hidden_user_id'])?$_POST['phoen_hidden_user_id']:'';

			$phoen_remarks=isset($_POST['phoen_remarks'])?sanitize_textarea_field($_POST['phoen_remarks']):'';
			
			$phoen_current_dates_update = new DateTime();
			
			$phoen_current_dates_updates = $phoen_current_dates_update->format('d-m-Y H:i:s');
			
			update_post_meta( $phoen_hidden_user_id, 'phoes_customer_points_update_valss', $phoen_update_data);

			update_post_meta( $phoen_hidden_user_id, 'phoes_customer_remarks_update_values',$phoen_remarks);
			
			update_post_meta($phoen_hidden_user_id,'phoeni_update_dates_checkeds',$phoen_current_dates_updates);
			
			update_post_meta( $phoen_hidden_user_id, 'phoes_customer_points_update_valss_empty', $phoen_update_data );
			
			update_option('phoeni_update_dates',$phoen_current_dates_updates);

			update_user_meta( $phoen_hidden_user_id, 'phoen_update_customer_points', $phoen_update_data);
				
			update_user_meta( $phoen_hidden_user_id, 'phoen_update_date', $phoen_current_dates_updates);
			
			update_user_meta($phoen_hidden_user_id,'phoen_update_customer_hiden_val',$phoen_update_data);
		}
		//closed add reward form
	}//constructor closed

	function prepare_items(){

        global $wpdb;
		
        $table_name = $wpdb->prefix . 'users'; // do not forget about tables prefix
       
        $per_page = 10; // constant, how much records will be shown per page
       
        $columns = $this->get_columns();
       
        $hidden = array();
       
        $sortable = $this->get_sortable_columns();
		
		$search = ( isset( $_REQUEST['s'] ) ) ? $_REQUEST['s'] : false;
		
		$do_search = ( $search ) ? $wpdb->prepare(" AND user_email LIKE '%%%s%%' ", $search ) : ''; 
        // here we configure table headers, defined in our methods
        $this->_column_headers = array($columns, $hidden, $sortable);
        // will be used in pagination settings
		$total_items = $wpdb->get_var("SELECT COUNT(*) FROM $table_name WHERE 1 ORDER BY ID");
        // prepare query params, as usual current page, order by and order direction
        $paged = isset($_REQUEST['paged']) ? max(0, intval($_REQUEST['paged']) - 1) : 0;
        
        $orderby = (isset($_REQUEST['orderby']) && in_array($_REQUEST['orderby'], array_keys($this->get_sortable_columns()))) ? $_REQUEST['orderby'] : 'user_email';
        
        $order = (isset($_REQUEST['order']) && in_array($_REQUEST['order'], array('asc', 'desc'))) ? $_REQUEST['order'] : 'asc';
        // [REQUIRED] define $items array
        // notice that last argument is ARRAY_A, so we will retrieve array
        ob_start();
			include_once(PHOEN_REWPTSPLUGPATH.'admin/phoen-reward-backend/customer-reports/phoen_all_user_function.php');
			$content = ob_get_contents();
       ob_end_clean();
       		echo $content;
       // [REQUIRED] configure pagination
		$this->set_pagination_args(array(
            'total_items' => $total_items, // total items defined above
            'per_page' => $per_page, // per page constant defined at top of method
            'total_pages' => ceil($total_items / $per_page) // calculate pages count
        ));
    } 

    function get_columns(){
	  $columns = array(
		'user_email' 		 => __('Email','phoen-rewpts'),
		'order_count'        => __('No. Of Completed Order ','phoen-rewpts'),
		'amount_spent'       => __('Total Order Amount','phoen-rewpts'),
		'total_point_reward' => __('Total Reward Points','phoen-rewpts'),
		'amount_in_wallet'   => __('Total Reward Amount ','phoen-rewpts'),
		'add_reward'         => __('Add Reward','phoen-rewpts'),
	  );
	  return $columns;
	}

	function column_default( $item, $column_name ) {
		
	  switch( $column_name ) { 
		case 'user_email': 			
		case 'order_count':
		case 'amount_spent':
		case 'total_point_reward':
		case 'amount_in_wallet':
		case 'add_reward':
			
		 return $item[ $column_name ];
		default:
		 return print_r( $item, true ) ; //Show the whole array for troubleshooting purposes
	  }
	}

	function column_user_email( $item ) {
		
		// create a nonce
		$view_nonce = wp_create_nonce( 'phoen_user_list_delete_user' );
  
		$title = '<strong>' . $item['user_email'] . '</strong>';
  
		$actions = [
		 
		'view' => sprintf( '<a href="?page=%s&action=%s&user=%s&_wpnonce=%s">View</a>', esc_attr( $_REQUEST['page'] ).'&tab=phoen_rewpts_customer', 'view', absint( $item['ID'] ), $view_nonce )
		];
  
		return $title . $this->row_actions( $actions );
	}

	function column_add_reward( $item ) {
			
		$total_points_rewards=get_post_meta( $item['ID'] , 'phoes_customer_points_update_valss',true);
        	
       	$get_remarks = get_post_meta( $item['ID'],'phoes_customer_remarks_update_values',true);
       	?>
       	<link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.3/css/font-awesome.min.css">

		<form method="post" action="<?= _e($_SERVER['PHP_SELF'])?>?page=Phoeniixx_reward_settings&tab=phoen_rewpts_customer">

			<?php $add_reward_nonce = wp_create_nonce( '_add_reward_nonce' ); ?>
		 	<input type="hidden" name="_addRewardNonce" value="<?php echo($add_reward_nonce);?>">
							
			<i class="fa fa-minus-square" aria-hidden="true" style="position:absolute;font-size:20px;cursor: pointer;font-size:25px;margin-left:6px;margin-top:4px;" id="minus_<?= _e($item['ID'])?>"></i>
								
			<input type="number" min="0" name="phoen_update_data" value="<?= ($total_points_rewards)?_e($total_points_rewards):0;?>" style="height:20px;width:100%;text-align:center;margin:0px;padding: 0px;" id="phoen_update_data_<?= _e($item['ID'])?>">
								
			<i class="fa fa-plus-square" aria-hidden="true" style="font-size:25px;cursor: pointer;border-radius: 50px;font-size:25px;margin-left:-27px;position: absolute;margin-top:4px;" id="plus_<?= _e($item['ID'])?>"></i>
								
			<input style="text-align:center;" type="hidden" name="phoen_hidden_user_id" value="<?php _e($item['ID']); ?>"><br>
								
			<textarea style="margin-top:2px;" cols="17" rows="2" name="phoen_remarks" placeholder="Write the remarks here"><?= ($get_remarks)?_e($get_remarks):''?></textarea><br>

			<input type="submit" name="update_points" value="Update" style="background-color: #4c5daf;color: white;padding: 7px 7px;text-align: center;display: inline-block;font-size: 13px;margin-left: 20%;width: 100px;border: none;">
									
		</form>
		<script>
			jQuery('#minus_'+<?= _e($item['ID'])?>).click(function(){
				const currentValue=Number(jQuery('#phoen_update_data_<?= _e($item['ID'])?>').val());
				if(currentValue>0){
					jQuery('#phoen_update_data_<?= _e($item['ID'])?>').val(currentValue-1);
				}
			});
			jQuery('#plus_'+<?= _e($item['ID'])?>).click(function(){
				const currentValue=Number(jQuery('#phoen_update_data_<?= _e($item['ID'])?>').val());
				if(currentValue>0 || currentValue==0){
					jQuery('#phoen_update_data_<?= _e($item['ID'])?>').val(currentValue+1);
				}
			});
		</script>
       	<?php
	}
	
}