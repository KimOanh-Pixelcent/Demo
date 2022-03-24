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


	public function create_boat_page(){

		$content_shop = "[shop_page]";
	    $postTitle_shop = 'Shop page';
	    $content_reserve_shop = "[shop_reserve]";
	    $postTitle_reserve_shop = 'Shop reserve';


	    global $wpdb;

	    $query = $wpdb->prepare(
	        'SELECT ID FROM ' . $wpdb->posts . '
	            WHERE post_title = %s
	            AND post_type = \'page\'',
	        $postTitle_shop
	    );
	    $wpdb->query( $query );

	    $query_reserve = $wpdb->prepare(
	        'SELECT ID FROM ' . $wpdb->posts . '
	            WHERE post_title = %s
	            AND post_type = \'page\'',
	        $postTitle_reserve_shop
	    );
	    $wpdb->query( $query_reserve );

	    if ( $wpdb->num_rows ) {
	        // Title already exists
	    } else {
	        $page = array(
	            'post_title'   => $postTitle_shop,
	            'post_content' => $content_shop,
	            'post_status'  => 'publish',
	            'post_author'  => 1,
	            'post_type'    => 'page',
	            'post_parent'  => 0,
	            'comment_status' => 'closed',
	        );

	        $page_reserve = array(
	            'post_title'   => $postTitle_reserve_shop,
	            'post_content' => $content_reserve_shop,
	            'post_status'  => 'publish',
	            'post_author'  => 1,
	            'post_type'    => 'page',
	            'post_parent'  => 0,
	            'comment_status' => 'closed',
	        );

	        // Add page
	        $insert_id = wp_insert_post( $page );
	        $insert_id = wp_insert_post( $page_reserve );
	    }
	}
	public function boat_insert_tax_item(){

		global $wpdb;
		$array = array("Alcohol", "Fishing", "Glass bottles", "Kids under 12", "Liveaboard", "Pets", "Red wine", "Shoes", "Smoking", "Swimming");

		$features = array("Air conditioning", "Anchor", "Bathroom", "Bluetooth audio", "Children’s life jacket", "Cooler / Ice chest", "Deck shower", "Depth finder", "Fish finder", "Floating mat", "GPS", "Radar", "Refrigerato", "Shower", "Sonar", "Swim ladde", "VHF radio");

		$boat_types = array("Bay Boats", "Bowrider", "Center Consoles", "Pontoon Boats", "	Runabouts", "Saltwater Fishing", "Ski and Wakeboard Boats", "Sports Fishing Boats");

		$makes = array("Chaparral", "Grady-White", "Premier", "	Robalo");

		$models = array("23 SSi OB", "246 Cayman SD", "250 Grand Majestic", "251 Coastal Explorer", "Canyon 336", "Canyon 456", "R360");

		$pricing = array("2 hours", "6 hours", "Full-day", "Half-day", "Multiple Days");

		foreach ($array as $val) {		

		    $query = $wpdb->prepare(
		        'SELECT term_id FROM '.$wpdb->terms.' WHERE name = %s', $val
		    );
		    $wpdb->query( $query );
		     if ( $wpdb->num_rows ) {
		        // Title already exists
		    } else{
		    	$insert_data = wp_insert_term(
					$val,   // new term
					'services', // taxonomy
					array(
						'description' => '',
						'slug'        => $val,
					)
				);
	    	}            
        }	
        foreach ($features as $val_fea) {		

		    $query = $wpdb->prepare(
		        'SELECT term_id FROM '.$wpdb->terms.' WHERE name = %s', $val_fea
		    );
		    $wpdb->query( $query );
		     if ( $wpdb->num_rows ) {
		        // Title already exists
		    } else{
		    	$insert_data = wp_insert_term(
					$val_fea,   // new term
					'features', // taxonomy
					array(
						'description' => '',
						'slug'        => $val_fea,
					)
				);
	    	}            
        }
        foreach ($boat_types as $val_type) {		

		    $query = $wpdb->prepare(
		        'SELECT term_id FROM '.$wpdb->terms.' WHERE name = %s', $val_type
		    );
		    $wpdb->query( $query );
		     if ( $wpdb->num_rows ) {
		        // Title already exists
		    } else{
		    	$insert_data = wp_insert_term(
					$val_type,   // new term
					'boat_types', // taxonomy
					array(
						'description' => '',
						'slug'        => $val_type,
					)
				);
	    	}            
        }	
        foreach ($makes as $val_makes) {		

		    $query = $wpdb->prepare(
		        'SELECT term_id FROM '.$wpdb->terms.' WHERE name = %s', $val_makes
		    );
		    $wpdb->query( $query );
		     if ( $wpdb->num_rows ) {
		        // Title already exists
		    } else{
		    	$insert_data = wp_insert_term(
					$val_makes,   // new term
					'makes', // taxonomy
					array(
						'description' => '',
						'slug'        => $val_makes,
					)
				);
	    	}            
        }	
        foreach ($models as $val_models) {		

		    $query = $wpdb->prepare(
		        'SELECT term_id FROM '.$wpdb->terms.' WHERE name = %s', $val_models
		    );
		    $wpdb->query( $query );
		     if ( $wpdb->num_rows ) {
		        // Title already exists
		    } else{
		    	$insert_data = wp_insert_term(
					$val_models,   // new term
					'models', // taxonomy
					array(
						'description' => '',
						'slug'        => $val_models,
					)
				);
	    	}            
        }		
        foreach ($pricing as $val_pri) {		

		    $query = $wpdb->prepare(
		        'SELECT term_id FROM '.$wpdb->terms.' WHERE name = %s', $val_pri
		    );
		    $wpdb->query( $query );
		     if ( $wpdb->num_rows ) {
		        // Title already exists
		    } else{
		    	$insert_data = wp_insert_term(
					$val_pri,   // new term
					'pricing', // taxonomy
					array(
						'description' => '',
						'slug'        => $val_pri,
					)
				);
	    	}            
        }	
	}
	public function boat_add_feate_img_to_media(){

		global $wpdb;

		$image_url = plugin_dir_url( __FILE__ ).'/img/Boat-default-feature.jpg';

		$upload_dir = wp_upload_dir();

		$image_data = file_get_contents( $image_url );

		$filename = basename( $image_url );

		if ( wp_mkdir_p( $upload_dir['path'] ) ) {
		  $file = $upload_dir['path'] . '/' . $filename;
		}
		else {
		  $file = $upload_dir['basedir'] . '/' . $filename;
		}

		file_put_contents( $file, $image_data );

		$wp_filetype = wp_check_filetype( $filename, null );

		$attachment = array(
		  'post_mime_type' => $wp_filetype['type'],
		  'post_title' => sanitize_file_name( $filename ),
		  'post_content' => '',
		  'post_status' => 'inherit'
		);
		$query = $wpdb->prepare(
		    'SELECT ID FROM '.$wpdb->posts.' WHERE post_title = "Boat-default-feature.jpg" AND post_type = "attachment"'
		);
	    $wpdb->query( $query );
	    if ( $wpdb->num_rows != 0 ) {	      
	    	//
	    }
	    else{
	    	$attach_id = wp_insert_attachment( $attachment, $file );
			require_once( ABSPATH . 'wp-admin/includes/image.php' );
			$attach_data = wp_generate_attachment_metadata( $attach_id, $file );
			wp_update_attachment_metadata( $attach_id, $attach_data );
			
			$boat_pro = array("Boat products 1", "Boat products 2", "Boat products 3", "Boat products 4", "Boat products 5", "Boat products 6", "Boat products 7", "Boat products 8", "Boat products 9", "Boat products 10");

			foreach ($boat_pro as $val_boat) {	

			    $thepost = $wpdb->get_row( $wpdb->prepare( "SELECT * FROM ".$wpdb->posts." WHERE post_title = %s", $val_boat) );

					$res2= set_post_thumbnail( $thepost->ID, $attach_id );
	        }   
	    }		
	}
	public function boat_add_img_to_media(){

		global $wpdb;

		$img_list = array("bg-840x523.jpg");

		foreach ($img_list as $val_img) {

			$image_url = plugin_dir_url( __FILE__ ).'/img/'.$val_img;

			$upload_dir = wp_upload_dir();

			$image_data = file_get_contents( $image_url );

			$filename = basename( $image_url );

			if ( wp_mkdir_p( $upload_dir['path'] ) ) {
			  $file = $upload_dir['path'] . '/' . $filename;
			}
			else {
			  $file = $upload_dir['basedir'] . '/' . $filename;
			}

			file_put_contents( $file, $image_data );

			$wp_filetype = wp_check_filetype( $filename, null );

			$attachment = array(
			  'post_mime_type' => $wp_filetype['type'],
			  'post_title' => sanitize_file_name( $filename ),
			  'post_content' => '',
			  'post_status' => 'inherit'
			);
			$query = $wpdb->prepare(
			    'SELECT ID FROM '.$wpdb->posts.' WHERE post_title = %s AND post_type = "attachment"', $val_img
			);
		    $wpdb->query( $query );
		    if ( $wpdb->num_rows != 0 ) {	      
		    	//
		    }
		    else{
		    	$attach_id = wp_insert_attachment( $attachment, $file );
				require_once( ABSPATH . 'wp-admin/includes/image.php' );
				$attach_data = wp_generate_attachment_metadata( $attach_id, $file );
				wp_update_attachment_metadata( $attach_id, $attach_data );
		    }		
		}		
	}
	public function boat_insert_product(){
		global $wpdb, $post; 

		$boat_pro = array("Boat products 1", "Boat products 2", "Boat products 3", "Boat products 4", "Boat products 5", "Boat products 6", "Boat products 7", "Boat products 8", "Boat products 9", "Boat products 10");

		foreach ($boat_pro as $val_boat) {		

		    $query = $wpdb->prepare(
		        'SELECT ID FROM '.$wpdb->posts.' WHERE post_title = %s AND post_type = "product"', $val_boat
		    );
		    $wpdb->query( $query );
		     if ( $wpdb->num_rows ) {
		        // Title already exists		        
		    } else{

				$array_pro = array(
					'post_title'   => $val_boat,
		            'post_content' => '',
		            'post_status'  => 'publish',
		            'post_author'  => 1,
		            'post_type'    => 'product',
		            'post_parent'  => 0,
		            'comment_status' => 'closed',
		            'post_category' => array( get_option( 'default_category' ) ),
	        	);
				$insert_boat = wp_insert_post( $array_pro );
	    	}            
        }       
	 
	}
	public function update_boat_meta_custom(){		

		global $wpdb, $post; 
		
		$year = array("2018", "2019", "2020", "2021");
		$length = array("19", "20", "21", "22");	
		$rand_year = array_rand($year, 2);
		$rand_length = array_rand($length, 2);
		$make = 'Chaparral';
		$models = '23 SSi OB';
		$capacity = '12e';
		$boattype = 'Bay Boats';

		$features = get_terms( array(
	        'taxonomy' => 'features',
	        'orderby' => 'rand',
	        'hide_empty' => false,
	        'number' => 8,
	    ) );  
		foreach ( $features as $r){
			$feature[] = $r->name;
		};	
		$services = get_terms( array(
	        'taxonomy' => 'services',
	        'orderby' => 'rand',
	        'hide_empty' => false,
	        'number' => 8,
	    ) );  
		foreach ( $services as $s){
			$service[] = $s->name;
		};		
	    $pricing = array(
		    "2-hours" => "50",
		    "6-hours" => "200",
		    "full-day" => "300",
		    "half-day" => "150",
		    "multiple-days" => "300",
		);

		$boat_pro = array("Boat products 1", "Boat products 2", "Boat products 3", "Boat products 4", "Boat products 5", "Boat products 6", "Boat products 7", "Boat products 8", "Boat products 9", "Boat products 10");

		foreach ($boat_pro as $val_boat) {	

			$pro_id = $wpdb->get_row( $wpdb->prepare( "SELECT ID FROM ".$wpdb->posts." WHERE post_title = %s", $val_boat) );

			$id_pro = $pro_id->ID;

			$meta_key = array("bbrw_year", "bbrw_length", "bbrw_make", "bbrw_model", "bbrw_capacity", "bbrw_boattype", "bbrw_features", "bbrw_services", "bbrw_pricing_val_", "bbrw_pricing_active");

			foreach ($meta_key as $val_meta){
				$query = $wpdb->prepare(
		        'SELECT post_id FROM '.$wpdb->postmeta.' WHERE meta_key = %s AND post_id = '.$id_pro.'', $val_meta
			    );
			    $wpdb->query( $query );
			    if ( $wpdb->num_rows ) {
			        //       
			    } else{
			    	if($val_meta == 'bbrw_year'):
			    		add_post_meta($id_pro, $val_meta, $year[$rand_year[0]]);
			    	elseif($val_meta == 'bbrw_length'):
			    		add_post_meta($id_pro, $val_meta, $length[$rand_length[0]]);
			    	elseif($val_meta == "bbrw_make"):
			    		add_post_meta($id_pro, $val_meta, $make);
			    	elseif($val_meta == "bbrw_model"):
			    		add_post_meta($id_pro, $val_meta, $models);
			    	elseif($val_meta == "bbrw_capacity"):
			    		add_post_meta($id_pro, $val_meta, $capacity);
			    	elseif($val_meta == "bbrw_boattype"):
			    		add_post_meta($id_pro, $val_meta, $boattype);
			    	elseif($val_meta == "bbrw_features"):
			    		add_post_meta($id_pro, $val_meta, serialize($feature));
			    	elseif($val_meta == "bbrw_services"):
			    		add_post_meta($id_pro, $val_meta, serialize($service));		
					elseif($val_meta == "bbrw_pricing_active"):
						foreach($pricing as $key_pri => $value){
							$price_key = 'bbrw_pricing_val_'.$key_pri;
							add_post_meta($id_pro, $price_key, $value);
						}
						add_post_meta($id_pro, 'bbrw_pricing_active', $pricing);
			    	endif;					
		    	}  
			}
		              
        }  
	}
	public function import_demo_click(){

		$this->create_boat_page();
		$this->boat_insert_product();
		$this->boat_insert_tax_item();
		$this->boat_add_img_to_media();
		$this->boat_add_feate_img_to_media();		
		$this->update_boat_meta_custom();		

		echo 'The import demo is complete'; 
		if (0 == get_option('import_demo_clicked') && 0 == update_option('import_demo_clicked',FALSE)):
			add_option('import_demo_clicked','1');
			update_option('import_demo_clicked','1');
		else:	
			echo 'false'; 		
		endif; 

		die;
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
	            $reordered_columns['date_rent_title'] = __( 'Rental Date','theme_domain');
	            $reordered_columns['starting_time_title'] = __( 'Starting time','theme_domain');	
	            $reordered_columns['duration_title'] = __( 'Duration','theme_domain');	
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
	    }
	}
}


