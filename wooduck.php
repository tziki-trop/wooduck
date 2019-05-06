<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              https:\\www.webduck.co.il
 * @since             1.0.0
 * @package           Wooduck
 *
 * @wordpress-plugin
 * Plugin Name:       Webduck for woocommerce
 * Plugin URI:        https:\\www.webduck.co.il
 * Description:       This is a short description of what the plugin does. It's displayed in the WordPress admin area.
 * Version:           1.0.0
 * Author:            webduck
 * Author URI:        https:\\www.webduck.co.il
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       wooduck
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
define( 'WOODUCK_VERSION', '1.0.0' );

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-wooduck-activator.php
 */
function activate_wooduck() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-wooduck-activator.php';
	Wooduck_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-wooduck-deactivator.php
 */
function deactivate_wooduck() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-wooduck-deactivator.php';
	Wooduck_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_wooduck' );
register_deactivation_hook( __FILE__, 'deactivate_wooduck' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-wooduck.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_wooduck() {

	$plugin = new Wooduck();
	$plugin->run();

}
run_wooduck();
