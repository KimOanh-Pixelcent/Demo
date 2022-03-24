<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       https://pixelcent.com
 * @since      1.0.0
 *
 * @package    Booking_Boat_Rental_Woocommerce
 * @subpackage Booking_Boat_Rental_Woocommerce/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Booking_Boat_Rental_Woocommerce
 * @subpackage Booking_Boat_Rental_Woocommerce/admin
 * @author     Thai <thai@pixelcent.com>
 */
class Booking_Boat_Rental_Woocommerce_Admin {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of this plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

	}

	/**
	 * Register the stylesheets for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Booking_Boat_Rental_Woocommerce_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Booking_Boat_Rental_Woocommerce_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/booking-boat-rental-woocommerce-admin.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Booking_Boat_Rental_Woocommerce_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Booking_Boat_Rental_Woocommerce_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/booking-boat-rental-woocommerce-admin.js', array( 'jquery' ), $this->version, false );

	}
	function rename_products_woo( $args ){
		$labels = array(
			'name'               => __( 'Boats', 'booking-boat-rental-woocommerce' ),
			'singular_name'      => __( 'Boat', 'booking-boat-rental-woocommerce' ),
			'menu_name'          => _x( 'Boats', 'Admin menu name', 'booking-boat-rental-woocommerce' ),
			'add_new'            => __( 'Add Boat', 'booking-boat-rental-woocommerce' ),
			'add_new_item'       => __( 'Add New Boat', 'booking-boat-rental-woocommerce' ),
			'edit'               => __( 'Edit', 'booking-boat-rental-woocommerce' ),
			'edit_item'          => __( 'Edit Boat', 'booking-boat-rental-woocommerce' ),
			'new_item'           => __( 'New Boat', 'booking-boat-rental-woocommerce' ),
			'view'               => __( 'View Boat', 'booking-boat-rental-woocommerce' ),
			'view_item'          => __( 'View Boat', 'booking-boat-rental-woocommerce' ),
			'search_items'       => __( 'Search Boats', 'booking-boat-rental-woocommerce' ),
			'not_found'          => __( 'No Boats found', 'booking-boat-rental-woocommerce' ),
			'not_found_in_trash' => __( 'No Boats found in trash', 'booking-boat-rental-woocommerce' ),
			'parent'             => __( 'Parent Boats', 'booking-boat-rental-woocommerce' )
		);
	
		$args['labels'] = $labels;
		$args['description'] = __( 'This is where you can add new boats to your store.', 'booking-boat-rental-woocommerce' );
		return $args;
	}
	function is_rental_product($product_id)
	{
		$is_product = wc_get_product($product_id);
		$product_type = $is_product ? $is_product->get_type() : '';
		$rental_product = isset($product_type) && $product_type === 'redq_rental' ? true : false;
		return $rental_product;
	}
	public function brw_rental_product_type($product_types)
    {
        $product_types['brw_rental'] = __('Rental Product', 'booking-boat-rental-woocommerce');
        return $product_types;
    }
	#Add tab to woo setting
	public function bbrw_rental_get_settings_pages($settings){
		$settings[] = include('settings/class-booking-boat-rental-tab-setting-wo.php');
        return $settings;
	}
	#end
	public function create_master_table_post_type(){
		// Set UI labels for Custom Post Type
		$labels = array(
			'name'                => _x( 'Master Table', 'Post Type General Name', 'booking-boat-rental-woocommerce' ),
			'singular_name'       => _x( 'Master Table', 'Post Type Singular Name', 'booking-boat-rental-woocommerce' ),
			'menu_name'           => __( 'Master Table', 'booking-boat-rental-woocommerce' ),
			'parent_item_colon'   => __( 'Parent Master Table', 'booking-boat-rental-woocommerce' ),
			'all_items'           => __( 'All Master Tables', 'booking-boat-rental-woocommerce' ),
			'view_item'           => __( 'View Master Table', 'booking-boat-rental-woocommerce' ),
			'add_new_item'        => __( 'Add New Master Table', 'booking-boat-rental-woocommerce' ),
			'add_new'             => __( 'Add New', 'booking-boat-rental-woocommerce' ),
			'edit_item'           => __( 'Edit Master Table', 'booking-boat-rental-woocommerce' ),
			'update_item'         => __( 'Update Master Table', 'booking-boat-rental-woocommerce' ),
			'search_items'        => __( 'Search Master Table', 'booking-boat-rental-woocommerce' ),
			'not_found'           => __( 'Not Found', 'booking-boat-rental-woocommerce' ),
			'not_found_in_trash'  => __( 'Not found in Trash', 'booking-boat-rental-woocommerce' ),
		);
		 
		$args = array(
			'label'               => __( 'Master Table', 'booking-boat-rental-woocommerce' ),
			'description'         => __( 'Master Table description', 'booking-boat-rental-woocommerce' ),
			'labels'              => $labels,
			'supports'            => array(), 
			'taxonomies'          => array('features', 'services', 'boat_types'),
			'hierarchical'        => false,
			'public'              => true,
			'show_ui'             => true,
			'show_in_menu'        => true,
			'show_in_nav_menus'   => true,
			'show_in_admin_bar'   => true,
			'menu_icon'           => 'dashicons-open-folder',
			'menu_position'       => 5,
			'can_export'          => true,
			'has_archive'         => true,
			'exclude_from_search' => false,
			'publicly_queryable'  => true,
			'capability_type'     => 'post',
			'show_in_rest' => true,
		);
		register_post_type( 'master-table', $args );
	}
	//Create taxonomy feature
	public function create_feature_taxonomy() {
		$labels = array(
			'name' => _x( 'Features', 'taxonomy general name' ),
			'singular_name' => _x( 'Feature', 'taxonomy singular name' ),
			'search_items' =>  __( 'Search Features' ),
			'popular_items' => __( 'Popular Features' ),
			'all_items' => __( 'All Features' ),
			'parent_item' => null,
			'parent_item_colon' => null,
			'edit_item' => __( 'Edit Feature' ), 
			'update_item' => __( 'Update Feature' ),
			'add_new_item' => __( 'Add New Feature' ),
			'new_item_name' => __( 'New Feature Name' ),
			'separate_items_with_commas' => __( 'Separate features with commas' ),
			'add_or_remove_items' => __( 'Add or remove features' ),
			'choose_from_most_used' => __( 'Choose from the most used features' ),
			'menu_name' => __( 'Features' ),
		); 

		register_taxonomy('features','master-table',array(
			'hierarchical' => false,
			'labels' => $labels,
			'show_ui' => true,
			'show_in_rest' => true,
			'show_admin_column' => true,
			'hierarchical' => true,
			'update_count_callback' => '_update_post_term_count',
			'query_var' => true,
			'rewrite' => array( 'slug' => 'feature' ),
		));
	}
	//create taxonomy service
	public function create_service_taxonomy() {
		$labels = array(
			'name' => _x( 'Services', 'taxonomy general name' ),
			'singular_name' => _x( 'Service', 'taxonomy singular name' ),
			'search_items' =>  __( 'Search Services' ),
			'popular_items' => __( 'Popular Services' ),
			'all_items' => __( 'All Services' ),
			'parent_item' => null,
			'parent_item_colon' => null,
			'edit_item' => __( 'Edit Service' ), 
			'update_item' => __( 'Update Service' ),
			'add_new_item' => __( 'Add New Service' ),
			'new_item_name' => __( 'New Service Name' ),
			'separate_items_with_commas' => __( 'Separate services with commas' ),
			'add_or_remove_items' => __( 'Add or remove services' ),
			'choose_from_most_used' => __( 'Choose from the most used services' ),
			'menu_name' => __( 'Services' ),
		); 

		register_taxonomy('services','master-table',array(
			'hierarchical' => false,
			'labels' => $labels,
			'show_ui' => true,
			'show_in_rest' => true,
			'show_admin_column' => true,
			'hierarchical' => true,
			'update_count_callback' => '_update_post_term_count',
			'query_var' => true,
			'rewrite' => array( 'slug' => 'service' ),
		));
	}
	//
	public function create_pricing_taxonomy() {
		$labels = array(
			'name' => _x( 'Pricing', 'taxonomy general name' ),
			'singular_name' => _x( 'Pricing', 'taxonomy singular name' ),
			'search_items' =>  __( 'Search Pricing' ),
			'popular_items' => __( 'Popular Pricing' ),
			'all_items' => __( 'All Pricing' ),
			'parent_item' => null,
			'parent_item_colon' => null,
			'edit_item' => __( 'Edit Pricing' ), 
			'update_item' => __( 'Update Pricing' ),
			'add_new_item' => __( 'Add New Pricing' ),
			'new_item_name' => __( 'New Pricing Name' ),
			'separate_items_with_commas' => __( 'Separate pricing with commas' ),
			'add_or_remove_items' => __( 'Add or remove pricing' ),
			'choose_from_most_used' => __( 'Choose from the most used pricing' ),
			'menu_name' => __( 'Pricing' ),
		); 

		register_taxonomy('pricing','master-table',array(
			'hierarchical' => false,
			'labels' => $labels,
			'show_ui' => true,
			'show_in_rest' => true,
			'show_admin_column' => true,
			'hierarchical' => true,
			'update_count_callback' => '_update_post_term_count',
			'query_var' => true,
			'rewrite' => array( 'slug' => 'pricing' ),
		));
	}

	public function boat_add_services_icon($term) {
    	?>
			<div class="form-field">
				<label for="term_meta[icon_meta]"><?php _e( 'Icon', '' ); ?></label>
				<input type="text" name="term_meta[icon_meta]" id="term_meta[icon_meta]" value="">
				<p class="description"><?php _e( 'Enter a value for this field','' ); ?></p>
			</div>
		<?php    
	}	
	public function boat_edit_services_icon($term) {
		$t_id = $term->term_id;
		$term_meta = get_option( "taxonomy_$t_id" ); ?>
		<tr class="form-field">
		<th scope="row" valign="top"><label for="term_meta[icon_meta]"><?php _e( 'Icon', '' ); ?></label></th>
			<td>
				<input type="text" name="term_meta[icon_meta]" id="term_meta[icon_meta]" value="<?php echo esc_attr( $term_meta['icon_meta'] ) ? esc_attr( $term_meta['icon_meta'] ) : ''; ?>">
				<p class="description"><?php _e( 'Enter a value for this field','' ); ?></p>
			</td>
		</tr>
	<?php
	}
	public function boat_save_services_icon( $term_id ) {
		if ( isset( $_POST['term_meta'] ) ) {
			$t_id = $term_id;
			$term_meta = get_option( "taxonomy_$t_id" );
			$cat_keys = array_keys( $_POST['term_meta'] );
			foreach ( $cat_keys as $key ) {
				if ( isset ( $_POST['term_meta'][$key] ) ) {
					$term_meta[$key] = $_POST['term_meta'][$key];
				}
			}
			// Save the option array.
			update_option( "taxonomy_$t_id", $term_meta );
		}
	} 
	function boat_add_services_columns( $columns ) {
	    $columns['services_icon'] = 'Icon';
	    return $columns;
	}
	function boat_add_services_column_content($content,$column_name,$term_id){
	    $term= get_term($term_id, 'services');
	    $t_id = $term->term_id;
	    $term_meta = get_option( "taxonomy_$t_id" );
	    switch ($column_name) {
	        case 'services_icon':
	            $content = esc_attr( $term_meta['icon_meta'] );
	            break;
	        default:
	            break;
	    }
	    return $content;
	}

	// feature taxonomy
	public function boat_add_features_icon($term) {
    	?>
			<div class="form-field">
				<label for="term_meta[icon_meta]"><?php _e( 'Icon', '' ); ?></label>
				<input type="text" name="term_meta[icon_meta]" id="term_meta[icon_meta]" value="">
				<p class="description"><?php _e( 'Enter a value for this field','' ); ?></p>
			</div>
		<?php    
	}	
	public function boat_edit_features_icon($term) {
		$t_id = $term->term_id;
		$term_meta = get_option( "taxonomy_$t_id" ); ?>
		<tr class="form-field">
		<th scope="row" valign="top"><label for="term_meta[icon_meta]"><?php _e( 'Icon', '' ); ?></label></th>
			<td>
				<input type="text" name="term_meta[icon_meta]" id="term_meta[icon_meta]" value="<?php echo esc_attr( $term_meta['icon_meta'] ) ? esc_attr( $term_meta['icon_meta'] ) : ''; ?>">
				<p class="description"><?php _e( 'Enter a value for this field','' ); ?></p>
			</td>
		</tr>
	<?php
	}
	public function boat_save_features_icon( $term_id ) {
		if ( isset( $_POST['term_meta'] ) ) {
			$t_id = $term_id;
			$term_meta = get_option( "taxonomy_$t_id" );
			$cat_keys = array_keys( $_POST['term_meta'] );
			foreach ( $cat_keys as $key ) {
				if ( isset ( $_POST['term_meta'][$key] ) ) {
					$term_meta[$key] = $_POST['term_meta'][$key];
				}
			}
			// Save the option array.
			update_option( "taxonomy_$t_id", $term_meta );
		}
	} 
	function boat_add_features_columns( $columns ) {
	    $columns['features_icon'] = 'Icon';
	    return $columns;
	}
	function boat_add_features_column_content($content,$column_name,$term_id){
	    $term= get_term($term_id, 'features');
	    $t_id = $term->term_id;
	    $term_meta = get_option( "taxonomy_$t_id" );
	    switch ($column_name) {
	        case 'features_icon':
	            $content = esc_attr( $term_meta['icon_meta'] );
	            break;
	        default:
	            break;
	    }
	    return $content;
	}

	//Create taxonomy Boat type
	public function create_boat_type_taxonomy() {
		$labels = array(
			'name' => _x( 'Boat Types', 'taxonomy general name' ),
			'singular_name' => _x( 'Boat Type', 'taxonomy singular name' ),
			'search_items' =>  __( 'Search Boat Type' ),
			'popular_items' => __( 'Popular Boat Type' ),
			'all_items' => __( 'All Boat Type' ),
			'parent_item' => null,
			'parent_item_colon' => null,
			'edit_item' => __( 'Edit Boat Type' ), 
			'update_item' => __( 'Update Boat Type' ),
			'add_new_item' => __( 'Add New Boat Type' ),
			'new_item_name' => __( 'New Boat Type Name' ),
			'separate_items_with_commas' => __( 'Separate boat types with commas' ),
			'add_or_remove_items' => __( 'Add or remove boat types' ),
			'choose_from_most_used' => __( 'Choose from the most used boat types' ),
			'menu_name' => __( 'Boat Types' ),
		); 

		register_taxonomy('boat_types','master-table',array(
			'hierarchical' => false,
			'labels' => $labels,
			'show_ui' => true,
			'show_in_rest' => true,
			'show_admin_column' => true,
			'hierarchical' => true,
			'update_count_callback' => '_update_post_term_count',
			'query_var' => true,
			'rewrite' => array( 'slug' => 'boat_types' ),
		));
	}
	//Create taxonomy make
	public function create_make_taxonomy() {
		$labels = array(
			'name' => _x( 'Makes', 'taxonomy general name' ),
			'singular_name' => _x( 'Makes', 'taxonomy singular name' ),
			'search_items' =>  __( 'Search Makes' ),
			'popular_items' => __( 'Popular Make' ),
			'all_items' => __( 'All Make' ),
			'parent_item' => null,
			'parent_item_colon' => null,
			'edit_item' => __( 'Edit Make' ), 
			'update_item' => __( 'Update Make' ),
			'add_new_item' => __( 'Add New Make' ),
			'new_item_name' => __( 'New Make Name' ),
			'separate_items_with_commas' => __( 'Separate makes with commas' ),
			'add_or_remove_items' => __( 'Add or remove make' ),
			'choose_from_most_used' => __( 'Choose from the most used make' ),
			'menu_name' => __( 'Makes' ),
		); 

		register_taxonomy('makes','master-table',array(
			'hierarchical' => false,
			'labels' => $labels,
			'show_ui' => true,
			'show_in_rest' => true,
			'show_admin_column' => true,
			'hierarchical' => true,
			'update_count_callback' => '_update_post_term_count',
			'query_var' => true,
			'rewrite' => array( 'slug' => 'makes' ),
		));
	}
	//Create taxonomy model
	public function create_model_taxonomy() {
		$labels = array(
			'name' => _x( 'Models', 'taxonomy general name' ),
			'singular_name' => _x( 'Models', 'taxonomy singular name' ),
			'search_items' =>  __( 'Search Model' ),
			'popular_items' => __( 'Popular Model' ),
			'all_items' => __( 'All Make' ),
			'parent_item' => null,
			'parent_item_colon' => null,
			'edit_item' => __( 'Edit Model' ), 
			'update_item' => __( 'Update Model' ),
			'add_new_item' => __( 'Add New Model' ),
			'new_item_name' => __( 'New Model Name' ),
			'separate_items_with_commas' => __( 'Separate models with commas' ),
			'add_or_remove_items' => __( 'Add or remove model' ),
			'choose_from_most_used' => __( 'Choose from the most used model' ),
			'menu_name' => __( 'Models' ),
		); 

		register_taxonomy('models','master-table',array(
			'hierarchical' => false,
			'labels' => $labels,
			'show_ui' => true,
			'show_in_rest' => true,
			'show_admin_column' => true,
			'hierarchical' => true,
			'update_count_callback' => '_update_post_term_count',
			'query_var' => true,
			'rewrite' => array( 'slug' => 'models' ),
		));
	}
	//Show metabox
	public function bbrw_add_custom_meta_box() {
		add_meta_box(
			'bbrw_meta_box_prices',    // $id
			'Configure Pricing Plans',    // $title
			array($this,'show_meta_box_prices'),    // $callback
			'inventory',                 // $page
			'normal',                  // $context
			'low'                      // $priority
		);
	}
	public function show_meta_box_prices(){
		global $custom_meta_fields, $post;
		$post_id = $post->ID;
    	$currency = get_woocommerce_currency_symbol();
		ob_start();
		include_once plugin_dir_path( __FILE__ ) .'metabox/metabox_price.php';
		$output = ob_get_contents();
		ob_end_clean();
		echo $output;
	}
	public function add_rental_setting_product_data_tab($product_data_tabs){
		$product_data_tabs['featured'] = array(
            'label'    => __('Features & Specifications', 'booking-boat-rental-woocommerce'),
            'target'   => 'product_feature_data',
            'class'    => array('hide_if_grouped', 'show_if_redq_rental', 'hide_if_simple', 'hide_if_external', 'hide_if_variable'),
            'priority' => '110'
        );
		$product_data_tabs['settings'] = array(
            'label'    => __('Pricing', 'booking-boat-rental-woocommerce'),
            'target'   => 'product_settings_data',
            'class'    => array('hide_if_grouped', 'show_if_redq_rental', 'hide_if_simple', 'hide_if_external', 'hide_if_variable'),
            'priority' => '110'
        );
        return $product_data_tabs;
	}
	public function add_rental_setting_product_data_fields(){
		global $post;
        $post_id = $post->ID;
		ob_start();
        include_once plugin_dir_path( __FILE__ ) .'settings/setting_tab_product_data.php';
		$output = ob_get_contents();
		ob_end_clean();
		echo $output;
	}
	public function bbrw_rental_save_meta($post_id){
		//Get key from list plan
		if(isset($_POST['bbrw_pricing_type'])){
			$pricing_types = $_POST['bbrw_pricing_type'];
			$pricing_types_label = $_POST['bbrw_pricing_type_label'];
			$prices = $_POST['bbrw_pricing_regular'];
			$pricing = [];
			foreach($pricing_types as $key => $item){
				if(!empty($prices[$key])){
					$pricing[$item] = $prices[$key];
					$price_key = 'bbrw_pricing_val_'.$item;
					update_post_meta($post_id, $price_key, $prices[$key]);
				}
			}
			update_post_meta($post_id, 'bbrw_pricing_active', $pricing);
		}else{
			update_post_meta($post_id, 'bbrw_pricing_active', []);
		}
		
		if(isset($_POST['bbrw_year'])){
			update_post_meta($post_id, 'bbrw_year', $_POST['bbrw_year']);
		}
		if(isset($_POST['bbrw_length'])){
			update_post_meta($post_id, 'bbrw_length', $_POST['bbrw_length']);
		}
		if(isset($_POST['bbrw_make'])){
			update_post_meta($post_id, 'bbrw_make', $_POST['bbrw_make']);
		}
		if(isset($_POST['bbrw_model'])){
			update_post_meta($post_id, 'bbrw_model', $_POST['bbrw_model']);
		}
		if(isset($_POST['bbrw_capacity'])){
			update_post_meta($post_id, 'bbrw_capacity', $_POST['bbrw_capacity']);
		}
		if(isset($_POST['bbrw_boattype'])){
			update_post_meta($post_id, 'bbrw_boattype', $_POST['bbrw_boattype']);
		}
		if(isset($_POST['bbrw_display'])){
			update_post_meta($post_id, 'bbrw_display', $_POST['bbrw_display']);
		}
		if(isset($_POST['bbrw_features'])){
			update_post_meta($post_id, 'bbrw_features', serialize($_POST['bbrw_features']));
		}
		if(isset($_POST['bbrw_services'])){
			update_post_meta($post_id, 'bbrw_services', serialize($_POST['bbrw_services']));
		}
	}


	public function bbrw_rental_before_single_product_summary(){
		global $post;
		global $product;
	    $post_id = $post->ID;
		ob_start();
	    include_once plugin_dir_path( __FILE__ ) .'../public/views/shop_detail_wc.php';
		$output = ob_get_contents();
		ob_end_clean();
		echo $output;
	}
	public function wp_remove_hooks(){
		
		remove_action( 'woocommerce_before_single_product_summary', 'woocommerce_show_product_images', 20 );
		remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_rating', 10 );
		remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_title', 5 );
		remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_price', 10 );
		remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_meta', 40 );
		remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_output_related_products', 20 );
		/*remove_action( 'woocommerce_before_checkout_form', 'woocommerce_checkout_coupon_form', 10 );*/
	}
	public function woo_remove_product_tabs( $tabs ) {

		unset( $tabs['description'] );      	// Remove the description tab
		unset( $tabs['reviews'] ); 			// Remove the reviews tab
		unset( $tabs['additional_information'] );  	// Remove the additional information tab

		return $tabs;

	}
	public function wpa104760_default_price( $post_id) {
		var_dump($post_id);
		if ( isset( $_POST['_regular_price'] ) && trim( $_POST['_regular_price'] ) == '' ) {
			update_post_meta( $post_id, '_regular_price', '0' );
		}
	}
	public function purchasable(){
		return true;
	}

	public function boat_custom_shop_order_column($columns)
	{
	    $reordered_columns = array();

	    foreach( $columns as $key => $column){
	        $reordered_columns[$key] = $column;
	        if( $key ==  'order_status' ){
	            $reordered_columns['date_rent_title'] = __( 'Rental Date','booking-boat-rental-woocommerce');
	            $reordered_columns['starting_time_title'] = __( 'Starting time','booking-boat-rental-woocommerce');	
	            $reordered_columns['duration_title'] = __( 'Duration','booking-boat-rental-woocommerce');
				$reordered_columns['capacity'] = __( 'Capacity','booking-boat-rental-woocommerce');
	        }
	    }
	    return $reordered_columns;
	}	
	public function boat_custom_orders_list_column_content( $column, $post_id )
	{
	    switch ( $column )
	    {
	        case 'date_rent_title' :

	            // Get custom post meta data
	            $date_rent = get_post_meta( $post_id, 'date_rent', true );
	            $date_rent_from = get_post_meta( $post_id, 'date_range_rent_from', true );
	            $date_rent_to = get_post_meta( $post_id, 'date_range_rent_to', true );

	            if(!empty($date_rent))
	                echo $date_rent;

	            else if(empty($starting_time) && !empty($date_rent_from))
	            	echo '<small>From:</small><br>'.$date_rent_from.'<br><small>To:</small><br>'.$date_rent_to;
	            else
	                echo '<small>(<em>no value</em>)</small>';

	            break;

	        case 'starting_time_title' :

	            $starting_time = get_post_meta( $post_id, 'checkout_starting_time', true );	

	            if(!empty($starting_time))
	                echo $starting_time;
	            else
	                echo '<small>(<em>no value</em>)</small>';

	            break;

	        case 'duration_title' :

	            $duration = get_post_meta( $post_id, 'checkout_duration', true );
	            if(!empty($duration))
	                echo $duration;

	            else
	                echo '<small>(<em>no value</em>)</small>';

	            break;
			case 'capacity' :
	            $capacity = get_post_meta( $post_id, 'capacity', true );
	            if(!empty($capacity))
	                echo $capacity;

	            else
	                echo '--';
	            break;
	    }
	}
}


