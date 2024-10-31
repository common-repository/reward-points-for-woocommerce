<?php

/**
 * The file that defines the core plugin class
 *
 * A class definition that includes attributes and functions used across both the
 * public-facing side of the site and the admin area.
 *
 * @link       http://www.phoeniixx.com/
 * @since      1.0.0
 *
 * @package    Phoen_Rewpts
 * @subpackage Phoen_Rewpts/includes
 */

/**
 * The core plugin class.
 *
 * This is used to define internationalization, admin-specific hooks, and
 * public-facing site hooks.
 *
 * Also maintains the unique identifier of this plugin as well as the current
 * version of the plugin.
 *
 * @since      1.0.0
 * @package    Phoen_Rewpts
 * @subpackage Phoen_Rewpts/includes
 * @author     phoeniixx <contact@phoeniixx.com>
 */
class Phoen_Rewpts {

	/**
	 * The loader that's responsible for maintaining and registering all hooks that power
	 * the plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      Phoen_Rewpts_Loader    $loader    Maintains and registers all hooks for the plugin.
	 */
	protected $loader;

	/**
	 * The unique identifier of this plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      string    $plugin_name    The string used to uniquely identify this plugin.
	 */
	protected $plugin_name;

	/**
	 * The current version of the plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      string    $version    The current version of the plugin.
	 */
	protected $version;

	/**
	 * Define the core functionality of the plugin.
	 *
	 * Set the plugin name and the plugin version that can be used throughout the plugin.
	 * Load the dependencies, define the locale, and set the hooks for the admin area and
	 * the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function __construct() {
		if ( defined( 'PHOEN_REWPTS_VERSION' ) ) {
			$this->version = PHOEN_REWPTS_VERSION;
		} else {
			$this->version = '1.0.0';
		}
		$this->plugin_name = 'phoen-rewpts';

		$this->load_dependencies();
		$this->set_locale();
		$this->define_admin_hooks();
		$this->define_public_hooks();

	}

	/**
	 * Load the required dependencies for this plugin.
	 *
	 * Include the following files that make up the plugin:
	 *
	 * - Phoen_Rewpts_Loader. Orchestrates the hooks of the plugin.
	 * - Phoen_Rewpts_i18n. Defines internationalization functionality.
	 * - Phoen_Rewpts_Admin. Defines all hooks for the admin area.
	 * - Phoen_Rewpts_Public. Defines all hooks for the public side of the site.
	 *
	 * Create an instance of the loader which will be used to register the hooks
	 * with WordPress.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function load_dependencies() {

		/**
		 * The class responsible for orchestrating the actions and filters of the
		 * core plugin.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-phoen-rewpts-loader.php';

		/**
		 * The class responsible for defining internationalization functionality
		 * of the plugin.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-phoen-rewpts-i18n.php';

		/**
		 * The class responsible for defining all actions that occur in the admin area.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'admin/class-phoen-rewpts-admin.php';

		/**
		 * The class responsible for defining all actions that occur in the public-facing
		 * side of the site.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'public/class-phoen-rewpts-public.php';

		$this->loader = new Phoen_Rewpts_Loader();

	}

	/**
	 * Define the locale for this plugin for internationalization.
	 *
	 * Uses the Phoen_Rewpts_i18n class in order to set the domain and to register the hook
	 * with WordPress.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function set_locale() {

		$plugin_i18n = new Phoen_Rewpts_i18n();

		$this->loader->add_action( 'plugins_loaded', $plugin_i18n, 'load_plugin_textdomain' );

	}

	/**
	 * Register all of the hooks related to the admin area functionality
	 * of the plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function define_admin_hooks() {

		$plugin_admin = new Phoen_Rewpts_Admin( $this->get_plugin_name(), $this->get_version() );
		
		$this->loader->add_action( 'admin_enqueue_scripts', $plugin_admin, 'enqueue_styles' );
		$this->loader->add_action( 'admin_enqueue_scripts', $plugin_admin, 'enqueue_scripts' );
		$this->loader->add_action( 'admin_menu', $plugin_admin, 'phoe_rewpts_menu_booking' );

		$this->loader->add_action( 'show_user_profile', $plugin_admin,'phoen_reward_create_extra_profile_dob_fields', 10 );
		$this->loader->add_action( 'edit_user_profile', $plugin_admin,'phoen_reward_create_extra_profile_dob_fields', 10 );
		$this->loader->add_action( 'personal_options_update',  $plugin_admin, 'phoen_reward_save_extra_profile_dob_fields' );
		$this->loader->add_action( 'edit_user_profile_update',  $plugin_admin, 'phoen_reward_save_extra_profile_dob_fields' );
	}

	/**
	 * Register all of the hooks related to the public-facing functionality
	 * of the plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function define_public_hooks() {

		$plugin_public = new Phoen_Rewpts_Public( $this->get_plugin_name(), $this->get_version() );
		$plugin_public->phoen_rewpts_show_cart_page_data();
		$plugin_public->phoen_rewpts_show_points_single_product_page();
		$plugin_public->phoen_rewpts_check_all_enable_setting_checkout_page();
		$plugin_public->phoen_rewpts_showing_point_Infrontend();
		$plugin_public->phoen_rewpts_login_signup_point();

		$this->loader->add_action( 'wp_enqueue_scripts', $plugin_public, 'enqueue_styles' );
		
		$this->loader->add_action( 'wp_enqueue_scripts', $plugin_public, 'enqueue_scripts' );

		$this->loader->add_action( 'wp_head', $plugin_public, 'phoen_rewpts_add_frontend_styling' );

		$this->loader->add_action( 'wp_loaded', $plugin_public ,'phoeniixx_rewpts_apply_point',30);

		$this->loader->add_action( 'woocommerce_checkout_order_processed', $plugin_public, 'phoen_rewpts_click_on_checkout_action',  1, 1  );

		$this->loader->add_filter( 'woocommerce_review_order_before_submit', $plugin_public, 'phoen_rewards_notification_paypal_payment' );

		$this->loader->add_action( 'woocommerce_checkout_order_processed', $plugin_public, 'phoen_rewpts_click_on_checkout_action',  1, 1  );

		$this->loader->add_action( 'woocommerce_edit_account_form', $plugin_public, 'phoen_reward_edit_account_form' );

		$this->loader->add_action( 'woocommerce_save_account_details', $plugin_public, 'phoen_reward_save_account_details' );
	}

	/**
	 * Run the loader to execute all of the hooks with WordPress.
	 *
	 * @since    1.0.0
	 */
	public function run() {
		$this->loader->run();
	}

	/**
	 * The name of the plugin used to uniquely identify it within the context of
	 * WordPress and to define internationalization functionality.
	 *
	 * @since     1.0.0
	 * @return    string    The name of the plugin.
	 */
	public function get_plugin_name() {
		return $this->plugin_name;
	}

	/**
	 * The reference to the class that orchestrates the hooks with the plugin.
	 *
	 * @since     1.0.0
	 * @return    Phoen_Rewpts_Loader    Orchestrates the hooks of the plugin.
	 */
	public function get_loader() {
		return $this->loader;
	}

	/**
	 * Retrieve the version number of the plugin.
	 *
	 * @since     1.0.0
	 * @return    string    The version number of the plugin.
	 */
	public function get_version() {
		return $this->version;
	}

}
