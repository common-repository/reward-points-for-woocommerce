<?php

// free version reward-points-for-woocommerce

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              http://www.phoeniixx.com/
 * @since             1.0.0
 * @package           Phoen_Rewpts
 *
 * @wordpress-plugin
 * Plugin Name:       Reward Points For Woocommerce
 * Plugin URI:        https://www.phoeniixx.com/product/reward-points-for-woocommerce/
 * Description:      It is a plugin which provides the customers to get the reward points on the basis of the  purchase of the products or the money spent by them.
 * Version:           4.6.0
 * Author:            Phoeniixx
 * Author URI:        http://www.phoeniixx.com/
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       phoen-rewpts
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * Currently plugin version.
 * Start at version 1.0.0 and use SemVer - https://semver.org
 * Rename this for your plugin and update it as you release new versions.
 */
define('PHOEN_REWPTS_VERSION', '1.0.0' );
define('PHOEN_REWPTSPLUGURL',plugins_url(  "/", __FILE__));
define('PHOEN_REWPTSPLUGPATH',plugin_dir_path(  __FILE__));

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-phoen-rewpts-activator.php
 */
function activate_phoen_rewpts() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-phoen-rewpts-activator.php';
	$activated_plugin = new Phoen_Rewpts_Activator();
    $activated_plugin->activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-phoen-rewpts-deactivator.php
 */
function deactivate_phoen_rewpts() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-phoen-rewpts-deactivator.php';
	Phoen_Rewpts_Deactivator::deactivate();
}
register_activation_hook( __FILE__, 'activate_phoen_rewpts' );
register_deactivation_hook( __FILE__, 'deactivate_phoen_rewpts' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-phoen-rewpts.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_phoen_rewpts() {

	$plugin = new Phoen_Rewpts();
	$plugin->run();

}
run_phoen_rewpts();
