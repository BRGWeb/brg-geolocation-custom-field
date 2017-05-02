<?php

/**
 *
 * @brg-geoloca-custom-field
 * Plugin Name:       BRG Geolocal Custom Field
 * Plugin URI:        https://brgweb.com.br/wordpress/plugins/brg-geolocation-custom-field
 * Description:       Adds a geolocation custom field to any post-type.
 * Version:           0.1.0
 * Author:            BRGWeb
 * Author URI:        http://brgweb.com.br/
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       brg_gcf
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-brg-gcf-activator.php
 */
function activate_brg_gcf() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-brg-gcf-activator.php';
	BRG_GCF_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-brg-gcf-deactivator.php
 */
function deactivate_brg_gcf() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-brg-gcf-deactivator.php';
	BRG_GCF_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_brg_gcf' );
register_deactivation_hook( __FILE__, 'deactivate_brg_gcf' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-brg-gcf.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    0.1.0
 */
function run_brg_gcf() {

	$plugin = new BRG_GCF();
	$plugin->run();

}
run_brg_gcf();
