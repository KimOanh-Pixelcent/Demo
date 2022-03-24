<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              https://pixelcent.com
 * @since             1.0.0
 * @package           Booking_Boat_Rental_Woocommerce
 *
 * @wordpress-plugin
 * Plugin Name:       Booking Boat Rental WooCommerce
 * Plugin URI:        https://pixelcent.com
 * Description:       This is a short description of what the plugin does. It's displayed in the WordPress admin area.
 * Version:           1.0.0
 * Author:            Thai
 * Author URI:        https://pixelcent.com
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       booking-boat-rental-woocommerce
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
define( 'BOOKING_BOAT_RENTAL_WOOCOMMERCE_VERSION', '1.0.0' );

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-booking-boat-rental-woocommerce-activator.php
 */
function activate_booking_boat_rental_woocommerce() {
	add_action('admin_notices', 'woo_req_admin_notice');
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-booking-boat-rental-woocommerce-activator.php';
	Booking_Boat_Rental_Woocommerce_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-booking-boat-rental-woocommerce-deactivator.php
 */
function deactivate_booking_boat_rental_woocommerce() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-booking-boat-rental-woocommerce-deactivator.php';
	Booking_Boat_Rental_Woocommerce_Deactivator::deactivate();
}

if (in_array('woocommerce/woocommerce.php', apply_filters('active_plugins', get_option('active_plugins')))) {
	register_activation_hook( __FILE__, 'activate_booking_boat_rental_woocommerce' );
	register_deactivation_hook( __FILE__, 'deactivate_booking_boat_rental_woocommerce' );

	/**
	 * The core plugin class that is used to define internationalization,
	 * admin-specific hooks, and public-facing site hooks.
	 */
	require plugin_dir_path( __FILE__ ) . 'includes/class-booking-boat-rental-woocommerce.php';

	/**
	 * Begins execution of the plugin.
	 *
	 * Since everything within the plugin is registered via hooks,
	 * then kicking off the plugin from this point in the file does
	 * not affect the page life cycle.
	 *
	 * @since    1.0.0
	 */
	function run_booking_boat_rental_woocommerce() {

		$plugin = new Booking_Boat_Rental_Woocommerce();
		$plugin->run();

	}
	run_booking_boat_rental_woocommerce();
}
else{
	function redq_admin_notice(){
		?>
			<div class="error">
				<p><?php _e('Please Install WooCommerce First before using this Plugin. You can download WooCommerce from <a href="http://wordpress.org/plugins/woocommerce/">here</a>.', 'redq-rental'); ?></p>
			</div>
	<?php
	}
	add_action('admin_notices', 'redq_admin_notice');
}
