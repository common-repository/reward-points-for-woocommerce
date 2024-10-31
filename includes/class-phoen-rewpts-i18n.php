<?php

/**
 * Define the internationalization functionality
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @link       http://www.phoeniixx.com/
 * @since      1.0.0
 *
 * @package    Phoen_Rewpts
 * @subpackage Phoen_Rewpts/includes
 */

/**
 * Define the internationalization functionality.
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @since      1.0.0
 * @package    Phoen_Rewpts
 * @subpackage Phoen_Rewpts/includes
 * @author     phoeniixx <contact@phoeniixx.com>
 */
class Phoen_Rewpts_i18n {


	/**
	 * Load the plugin text domain for translation.
	 *
	 * @since    1.0.0
	 */
	public function load_plugin_textdomain() {

		load_plugin_textdomain(
			'phoen-rewpts',
			false,
			dirname( dirname( plugin_basename( __FILE__ ) ) ) . '/languages/'
		);

	}



}
