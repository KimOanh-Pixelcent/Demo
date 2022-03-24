<?php

/**
 * Define the internationalization functionality
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @link       https://pixelcent.com
 * @since      1.0.0
 *
 * @package    Booking_Boat_Rental_Woocommerce
 * @subpackage Booking_Boat_Rental_Woocommerce/includes
 */

/**
 * Define the internationalization functionality.
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @since      1.0.0
 * @package    Booking_Boat_Rental_Woocommerce
 * @subpackage Booking_Boat_Rental_Woocommerce/includes
 * @author     Thai <thai@pixelcent.com>
 */
class Booking_Boat_Rental_Woocommerce_i18n {


	/**
	 * Load the plugin text domain for translation.
	 *
	 * @since    1.0.0
	 */
	public function load_plugin_textdomain() {

		load_plugin_textdomain(
			'booking-boat-rental-woocommerce',
			false,
			dirname( dirname( plugin_basename( __FILE__ ) ) ) . '/languages/'
		);

	}



}
