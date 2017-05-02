<?php

/**
 * Define the internationalization functionality
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @link       https://brgweb.com.br/wordpress/plugins/brg-geolocation-custom-field
 * @since      0.1.0
 *
 * @package    BRG_GCF
 * @subpackage BRG_GCF/includes
 */

/**
 * Define the internationalization functionality.
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @since      0.1.0
 * @package    BRG_GCF
 * @subpackage BRG_GCF/includes
 * @author     BRGWeb <wordpress@brgweb.com.br>
 */
class BRG_GCF_i18n {


	/**
	 * Load the plugin text domain for translation.
	 *
	 * @since    1.0.0
	 */
	public function load_plugin_textdomain() {

		load_plugin_textdomain(
			'brg_gcf',
			false,
			dirname( dirname( plugin_basename( __FILE__ ) ) ) . '/languages/'
		);

	}
}
