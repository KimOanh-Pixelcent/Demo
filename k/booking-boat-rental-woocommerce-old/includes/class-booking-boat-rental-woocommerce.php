<?php

/**
 * The file that defines the core plugin class
 *
 * A class definition that includes attributes and functions used across both the
 * public-facing side of the site and the admin area.
 *
 * @link       https://pixelcent.com
 * @since      1.0.0
 *
 * @package    Booking_Boat_Rental_Woocommerce
 * @subpackage Booking_Boat_Rental_Woocommerce/includes
 */

/**
 * The core plugin class.
 *
 * This is used to define internationalization, admin-specific hooks, and
 * public-facing site hooks.
 *
 * Also maintains the unique identifier of this plugin as well as the current
 * version of the plugin.
 *
 * @since      1.0.0
 * @package    Booking_Boat_Rental_Woocommerce
 * @subpackage Booking_Boat_Rental_Woocommerce/includes
 * @author     Thai <thai@pixelcent.com>
 */
class Booking_Boat_Rental_Woocommerce {

	/**
	 * The loader that's responsible for maintaining and registering all hooks that power
	 * the plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      Booking_Boat_Rental_Woocommerce_Loader    $loader    Maintains and registers all hooks for the plugin.
	 */
	protected $loader;

	/**
	 * The unique identifier of this plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      string    $plugin_name    The string used to uniquely identify this plugin.
	 */
	protected $plugin_name;

	/**
	 * The current version of the plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      string    $version    The current version of the plugin.
	 */
	protected $version;

	/**
	 * Define the core functionality of the plugin.
	 *
	 * Set the plugin name and the plugin version that can be used throughout the plugin.
	 * Load the dependencies, define the locale, and set the hooks for the admin area and
	 * the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function __construct() {
		if ( defined( 'BOOKING_BOAT_RENTAL_WOOCOMMERCE_VERSION' ) ) {
			$this->version = BOOKING_BOAT_RENTAL_WOOCOMMERCE_VERSION;
		} else {
			$this->version = '1.0.0';
		}
		$this->plugin_name = 'booking-boat-rental-woocommerce';

		$this->load_dependencies();
		$this->set_locale();
		$this->define_admin_hooks();
		$this->define_public_hooks();

	}

	/**
	 * Load the required dependencies for this plugin.
	 *
	 * Include the following files that make up the plugin:
	 *
	 * - Booking_Boat_Rental_Woocommerce_Loader. Orchestrates the hooks of the plugin.
	 * - Booking_Boat_Rental_Woocommerce_i18n. Defines internationalization functionality.
	 * - Booking_Boat_Rental_Woocommerce_Admin. Defines all hooks for the admin area.
	 * - Booking_Boat_Rental_Woocommerce_Public. Defines all hooks for the public side of the site.
	 *
	 * Create an instance of the loader which will be used to register the hooks
	 * with WordPress.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function load_dependencies() {

		/**
		 * The class responsible for orchestrating the actions and filters of the
		 * core plugin.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-booking-boat-rental-woocommerce-loader.php';

		/**
		 * The class responsible for defining internationalization functionality
		 * of the plugin.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-booking-boat-rental-woocommerce-i18n.php';

		/**
		 * The class responsible for defining all actions that occur in the admin area.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'admin/class-booking-boat-rental-woocommerce-admin.php';

		/**
		 * The class responsible for defining all actions that occur in the public-facing
		 * side of the site.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'public/class-booking-boat-rental-woocommerce-public.php';

		$this->loader = new Booking_Boat_Rental_Woocommerce_Loader();

	}

	/**
	 * Define the locale for this plugin for internationalization.
	 *
	 * Uses the Booking_Boat_Rental_Woocommerce_i18n class in order to set the domain and to register the hook
	 * with WordPress.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function set_locale() {

		$plugin_i18n = new Booking_Boat_Rental_Woocommerce_i18n();

		$this->loader->add_action( 'plugins_loaded', $plugin_i18n, 'load_plugin_textdomain' );

	}

	/**
	 * Register all of the hooks related to the admin area functionality
	 * of the plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function define_admin_hooks() {

		$plugin_admin = new Booking_Boat_Rental_Woocommerce_Admin( $this->get_plugin_name(), $this->get_version() );

		$this->loader->add_action( 'admin_enqueue_scripts', $plugin_admin, 'enqueue_styles' );
		$this->loader->add_action( 'admin_enqueue_scripts', $plugin_admin, 'enqueue_scripts' );
		$this->loader->add_action( 'init', $plugin_admin, 'create_master_table_post_type' );
		$this->loader->add_action( 'init', $plugin_admin, 'create_feature_taxonomy', 0 );
		$this->loader->add_action( 'init', $plugin_admin, 'create_service_taxonomy', 0 );
		$this->loader->add_action( 'init', $plugin_admin, 'create_boat_type_taxonomy', 0 );
		$this->loader->add_action( 'init', $plugin_admin, 'create_make_taxonomy', 0 );
		$this->loader->add_action( 'init', $plugin_admin, 'create_model_taxonomy', 0 );
		$this->loader->add_action( 'init', $plugin_admin, 'create_pricing_taxonomy', 0 );


		$this->loader->add_action('add_meta_boxes', $plugin_admin, 'bbrw_add_custom_meta_box');
		$this->loader->add_filter( 'woocommerce_register_post_type_product', $plugin_admin, 'rename_products_woo' );
		$this->loader->add_filter('product_type_selector', $plugin_admin, 'brw_rental_product_type');
		$this->loader->add_filter('woocommerce_get_settings_pages', $plugin_admin, 'bbrw_rental_get_settings_pages');
		
		$this->loader->add_filter( 'woocommerce_product_data_tabs', $plugin_admin, 'add_rental_setting_product_data_tab' , 99 , 1 );
		$this->loader->add_action('woocommerce_product_data_panels', $plugin_admin, 'add_rental_setting_product_data_fields');
		$this->loader->add_action('woocommerce_process_product_meta', $plugin_admin, 'bbrw_rental_save_meta');

				
		$this->loader->add_action('woocommerce_before_single_product_summary', $plugin_admin, 'bbrw_rental_before_single_product_summary');	

		$this->loader->add_action( 'init', $plugin_admin, 'wp_remove_hooks', 0 );
		$this->loader->add_filter( 'woocommerce_product_tabs', $plugin_admin, 'woo_remove_product_tabs', 98 );
		$this->loader->add_action( 'woocommerce_process_product_meta', $plugin_admin, 'wpa104760_default_price');
		$this->loader->add_filter('woocommerce_is_purchasable', $plugin_admin, 'purchasable');

		$this->loader->add_filter( 'manage_edit-shop_order_columns', $plugin_admin, 'boat_custom_shop_order_column', 20 );
		$this->loader->add_action( 'manage_shop_order_posts_custom_column' , $plugin_admin, 'boat_custom_orders_list_column_content', 20, 2 );

		
		$this->loader->add_action('wp_ajax_import_demo_click',$plugin_admin, 'import_demo_click');
	}
	/**
	 * Register all of the hooks related to the public-facing functionality
	 * of the plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function define_public_hooks() {

		$plugin_public = new Booking_Boat_Rental_Woocommerce_Public( $this->get_plugin_name(), $this->get_version() );

		$this->loader->add_action( 'wp_enqueue_scripts', $plugin_public, 'enqueue_styles' );
		$this->loader->add_action( 'wp_enqueue_scripts', $plugin_public, 'enqueue_scripts' );
		add_shortcode("shop_page",array($plugin_public, "shop_wc"));
		add_shortcode("shop_single",array($plugin_public, "shop_detail"));
		add_shortcode("shop_reserve",array($plugin_public, "reserve_now"));
		$this->loader->add_action('wp_ajax_boat_shop_filter',$plugin_public, 'boat_shop_filter');
		$this->loader->add_action('wp_ajax_nopriv_boat_shop_filter',$plugin_public,'boat_shop_filter');
		$this->loader->add_filter ('woocommerce_add_to_cart_redirect',$plugin_public, 'redirect_cart_to_checkout');
		$this->loader->add_filter('woocommerce_loop_add_to_cart_link',$plugin_public, 'boat_add_to_cart_link');
		$this->loader->add_filter( 'woocommerce_add_cart_item_data',$plugin_public, 'ipe_product_custom_price', 99, 2 );
		$this->loader->add_action( 'woocommerce_before_calculate_totals',$plugin_public, 'ipe_apply_custom_price_to_cart_item', 99 );

		$this->loader->add_action('wp_ajax_get_price_by_duration',$plugin_public, 'get_price_by_duration');
		$this->loader->add_action('wp_ajax_nopriv_get_price_by_duration',$plugin_public,'get_price_by_duration');
		
		$this->loader->add_filter( 'woocommerce_checkout_fields',$plugin_public, 'reorder_checkout_field');
		$this->loader->add_filter( 'gettext', $plugin_public ,'wc_billing_field_strings', 20, 3 );
		$this->loader->add_action( 'woocommerce_checkout_before_order_review', $plugin_public  ,'custom_checkout_before_order_review');
		$this->loader->add_action( 'woocommerce_after_checkout_billing_form', $plugin_public, 'add_custom_field_to_billing_form' );

		$this->loader->add_action( 'woocommerce_checkout_update_order_meta', $plugin_public, 'boat_save_custom_field_added_checkout' );	

		$this->loader->add_filter('woocommerce_thankyou_order_received_text', $plugin_public, 'boat_change_order_received_text', 10, 2 );

		$this->loader->add_action( 'init', $plugin_public, 'boat_register_session', 1);

		$this->loader->add_filter( 'woocommerce_billing_fields', $plugin_public, 'boat_add_field_checkout', 20, 1 );
		$this->loader->add_action('woocommerce_checkout_process', $plugin_public, 'check_birth_date');

		$this->loader->add_action( 'woocommerce_admin_order_data_after_billing_address', $plugin_public, 'boat_display_billing_options_value_in_admin_order', 10, 1 );
		$this->loader->add_action( 'woocommerce_view_order', $plugin_public, 'boat_view_order_and_thankyou_page', 20 );
		$this->loader->add_filter('woocommerce_enable_order_notes_field', $plugin_public, 'boat_woocommerce_enable_order_notes_field', 20);
	}

	/**
	 * Run the loader to execute all of the hooks with WordPress.
	 *
	 * @since    1.0.0
	 */
	public function run() {
		$this->loader->run();
	}

	/**
	 * The name of the plugin used to uniquely identify it within the context of
	 * WordPress and to define internationalization functionality.
	 *
	 * @since     1.0.0
	 * @return    string    The name of the plugin.
	 */
	public function get_plugin_name() {
		return $this->plugin_name;
	}

	/**
	 * The reference to the class that orchestrates the hooks with the plugin.
	 *
	 * @since     1.0.0
	 * @return    Booking_Boat_Rental_Woocommerce_Loader    Orchestrates the hooks of the plugin.
	 */
	public function get_loader() {
		return $this->loader;
	}

	/**
	 * Retrieve the version number of the plugin.
	 *
	 * @since     1.0.0
	 * @return    string    The version number of the plugin.
	 */
	public function get_version() {
		return $this->version;
	}

}
