<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              https://themes.zone
 * @since             1.0.0
 * @package           Dici_Feature_Pack
 *
 * @wordpress-plugin
 * Plugin Name:       DiCi Theme Feature Pack
 * Plugin URI:        https://themes.zone/dici-feature-pack
 * Description:       This is a feature pack plugin for Diamond City (DiCi) WordPress Theme.
 * Version:           1.0.0
 * Author:            Themes Zone
 * Author URI:        https://themes.zone
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       dici-feature-pack
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

define( 'DICI_FEATURE_PACK_VERSION', '1.0.0' );

define( 'DICI_FEATURE_PACK_URI', plugin_dir_url( __FILE__ ) );

define( 'DICI_FEATURE_PACK_ROOT', plugin_dir_path( __FILE__ ) );

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-dici-feature-pack-activator.php
 */
function activate_dici_feature_pack() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-dici-feature-pack-activator.php';
	Dici_Feature_Pack_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-dici-feature-pack-deactivator.php
 */
function deactivate_dici_feature_pack() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-dici-feature-pack-deactivator.php';
	Dici_Feature_Pack_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_dici_feature_pack' );
register_deactivation_hook( __FILE__, 'deactivate_dici_feature_pack' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-dici-feature-pack.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_dici_feature_pack() {

	$plugin = new Dici_Feature_Pack();
	$plugin->run();

}

add_action( 'plugins_loaded', 'run_dici_feature_pack' );