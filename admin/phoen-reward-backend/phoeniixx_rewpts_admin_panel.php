<?php if ( ! defined( 'ABSPATH' ) ) exit;

if(!isset($_GET['pagination']) && !isset($_GET['user_view_points'] ) &&  !isset($_GET['user']) || isset($_GET['pagination'])){

	//include customer reard list table
	ob_start();
		include_once(PHOEN_REWPTSPLUGPATH.'admin/phoen-reward-backend/customer-reports/phoen_all_user_wp_list_table.php');
		$contents = ob_get_contents();
	ob_end_clean();
		echo $contents;
	//end customer table
	
	$phoen_reward_all_user_obj = new Phoen_Reward_All_User(); ?>

	<div class="wrap">
		<form method="POST">
			
			<?php 
				$phoen_reward_all_user_obj->prepare_items();
				$phoen_reward_all_user_obj->search_box('Search User', 'search_id');
				$phoen_reward_all_user_obj->display();
			?>
		</form>	
	</div>
	<?php
	
}


//for view the customer data
if(isset($_GET['user']) && $_GET['action']=='view'){

	ob_start();
		include_once(PHOEN_REWPTSPLUGPATH.'admin/phoen-reward-backend/customer-reports/phoen_user_view_point.php');
	$contents = ob_get_contents();
	ob_end_clean();
		echo $contents;
	
}

//for editing the customer data
else if(isset($_GET['user'])  && $_GET['action']=='edit')
{
	ob_start();
	include_once(PHOEN_REWPTSPLUGPATH.'admin/phoen-reward-backend/customer-reports/phoen_user_edit_points.php');
	$contents = ob_get_contents();
	ob_end_clean();
		echo $contents;
}

?>