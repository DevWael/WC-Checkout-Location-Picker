<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              https://github.com/DevWael
 * @since             1.0.0
 * @package           Wclp
 *
 * @wordpress-plugin
 * Plugin Name:       WC Checkout Location Picker
 * Plugin URI:        https://github.com/DevWael/WC-Checkout-Location-Picker
 * Description:       Adds google map location picker to woocommerce checkout
 * Version:           1.0.0
 * Author:            Ahmad Wael
 * Author URI:        https://github.com/DevWael
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       wclp
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
define( 'WCLP_VERSION', '1.0.0' );

/**
 * Plugin directory
 */
define( 'WCLP_DIR', plugin_dir_path( __FILE__ ) );

/**
 * Plugin main file name
 * @uses in plugin update checker
 */
define( 'WCLP_FILE_NAME', basename( __FILE__ ) );

/**
 * Register classes autoloader
 */
spl_autoload_register( 'wclp_autoloader' );
function wclp_autoloader( $class_name ) {
	$classes_dir = realpath( plugin_dir_path( __FILE__ ) ) . DIRECTORY_SEPARATOR . 'includes' . DIRECTORY_SEPARATOR;
	$class_file  = $classes_dir . $class_name . '.php';
	if ( file_exists( $class_file ) ) {
		require_once $class_file;
	}

	return false;
}

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-wclp-activator.php
 */
function activate_wclp() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/Wclp_Activator.php';
	Wclp_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-wclp-deactivator.php
 */
function deactivate_wclp() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/Wclp_Deactivator.php';
	Wclp_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_wclp' );
register_deactivation_hook( __FILE__, 'deactivate_wclp' );

/**
 * plugin update checker library
 * @version 4.9
 * @link https://github.com/YahnisElsts/plugin-update-checker
 */
require plugin_dir_path( __FILE__ ) . 'libs/plugin-update-checker/plugin-update-checker.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_wclp() {

	$plugin = new Wclp();
	$plugin->run();

}

run_wclp();

add_action('init',function (){
//	print_r(get_option( 'wclp_checkout_enabled' ));
});