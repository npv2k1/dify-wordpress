<?php
/**
 * Plugin Name: Dify for WordPress
 * Plugin URI: https://github.com/npv2k1/dify-wordpress
 * Description: Integrate Dify AI chatbot into your WordPress site with shortcodes and Gutenberg blocks.
 * Version: 1.0.0
 * Author: Dify WordPress Team
 * Author URI: https://github.com/npv2k1
 * License: GPL v2 or later
 * License URI: https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain: dify-wordpress
 * Domain Path: /languages
 *
 * @package DifyWordPress
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * Current plugin version.
 */
define( 'DIFY_WORDPRESS_VERSION', '1.0.0' );

/**
 * Plugin directory path.
 */
define( 'DIFY_WORDPRESS_PLUGIN_DIR', plugin_dir_path( __FILE__ ) );

/**
 * Plugin directory URL.
 */
define( 'DIFY_WORDPRESS_PLUGIN_URL', plugin_dir_url( __FILE__ ) );

/**
 * The code that runs during plugin activation.
 */
function activate_dify_wordpress() {
	require_once DIFY_WORDPRESS_PLUGIN_DIR . 'includes/class-dify-wordpress-activator.php';
	Dify_WordPress_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 */
function deactivate_dify_wordpress() {
	require_once DIFY_WORDPRESS_PLUGIN_DIR . 'includes/class-dify-wordpress-deactivator.php';
	Dify_WordPress_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_dify_wordpress' );
register_deactivation_hook( __FILE__, 'deactivate_dify_wordpress' );

/**
 * The core plugin class.
 */
require DIFY_WORDPRESS_PLUGIN_DIR . 'includes/class-dify-wordpress.php';

/**
 * Begins execution of the plugin.
 */
function run_dify_wordpress() {
	$plugin = new Dify_WordPress();
	$plugin->run();
}
run_dify_wordpress();
