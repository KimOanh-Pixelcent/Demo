<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link       https://pixelcent.com
 * @since      1.0.0
 *
 * @package    Booking_Boat_Rental_Woocommerce
 * @subpackage Booking_Boat_Rental_Woocommerce/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the public-facing stylesheet and JavaScript.
 *
 * @package    Booking_Boat_Rental_Woocommerce
 * @subpackage Booking_Boat_Rental_Woocommerce/public
 * @author     Thai <thai@pixelcent.com>
 */
class Booking_Boat_Rental_Woocommerce_Public {

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
	 * @param      string    $plugin_name       The name of the plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		// $this->version = $version;
		$this->version = time();

	}

	/**
	 * Register the stylesheets for the public-facing side of the site.
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

		//wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/booking-boat-rental-woocommerce-public.css', array(), $this->version, 'all' );
	
		wp_register_style('bbrw-bootstrap-css', plugin_dir_url( __FILE__ ) . 'css/bootstrap.min.css', array(), $this->version, 'all');
        wp_enqueue_style('bbrw-bootstrap-css');

		wp_register_style('bbrw-bootstrap-icons-css', plugin_dir_url( __FILE__ ) . 'css/bootstrap-icons.css', array(), $this->version, 'all');
        wp_enqueue_style('bbrw-bootstrap-icons-css');

		wp_register_style('bbrw-daterangepicker-css', plugin_dir_url( __FILE__ ) . 'css/daterangepicker.css', array(), $this->version, 'all');
        wp_enqueue_style('bbrw-daterangepicker-css');

		wp_register_style('bbrw-nouislider-css', plugin_dir_url( __FILE__ ) . 'css/nouislider.css', array(), $this->version, 'all');
        wp_enqueue_style('bbrw-nouislider-css');
		
		wp_register_style('booking-boat-rental-woocommerce-css', plugin_dir_url( __FILE__ ) . 'css/booking-boat-rental-woocommerce-public.css', array(), $this->version, 'all');
        wp_enqueue_style('booking-boat-rental-woocommerce-css');

	}

	/**
	 * Register the JavaScript for the public-facing side of the site.
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
		wp_register_script('bbrw-bootstrap-min', plugin_dir_url( __FILE__ ) . 'js/bootstrap.min.js', array('jquery'),  $this->version, false );
		wp_enqueue_script('bbrw-bootstrap-min');

		wp_register_script('bbrw-moment-min', plugin_dir_url( __FILE__ ) . 'js/moment.min.js', array('jquery'),  $this->version, false );
		wp_enqueue_script('bbrw-moment-min');

		wp_register_script('bbrw-daterangepicker', plugin_dir_url( __FILE__ ) . 'js/daterangepicker.js', array('jquery'),  $this->version, false );
		wp_enqueue_script('bbrw-daterangepicker');

		wp_register_script('bbrw-nouislider', plugin_dir_url( __FILE__ ) . 'js/nouislider.js', array('jquery'),  $this->version, false );
		wp_enqueue_script('bbrw-nouislider');

		wp_register_script('booking-boat-rental-woocommerce-public', plugin_dir_url( __FILE__ ) . 'js/booking-boat-rental-woocommerce-public.js', array('jquery'),  $this->version, false );
		wp_enqueue_script('booking-boat-rental-woocommerce-public');

		//wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/booking-boat-rental-woocommerce-public.js', array( 'jquery' ), $this->version, false );

	}
	/**/
	public function shop_wc() {
		ob_start();
		include_once plugin_dir_path( __FILE__ ) .'views/shop_wc.php';
		$template = ob_get_contents(); 
		ob_end_clean();
		echo $template;
    }
	public function shop_detail() {
		ob_start();
		include_once plugin_dir_path( __FILE__ ) .'views/shop_detail_wc.php';
		$template = ob_get_contents(); 
		ob_end_clean();
		echo $template;
    }
    public function reserve_now() {
		ob_start();
		include_once plugin_dir_path( __FILE__ ) .'views/reserve_now.php';
		$template = ob_get_contents(); 
		ob_end_clean();
		echo $template;
    }
	public function boat_shop_filter(){
		//
		$params = $_POST['params'];
		$price_type = $params['type'];
		$sort = $params['sort'];
		$type = 'per day';
		$pricing_key = 'bbrw_pricing_day';
		$orderby = 'date';
		$order	 = 'desc';
		if($price_type == 'hourly'){
			$type = 'per hour';
			$pricing_key = 'bbrw_pricing_hour';
		}
		//
		switch ($sort) {
		  case 'date_desc':
			$orderby = 'date';
			$order	 = 'desc';
			break;
		  case 'price_asc':
			$orderby = $pricing_key;
			$order	 = 'asc';
			break;
		  case 'price_desc':
			$orderby = $pricing_key;
			$order	 = 'desc';
			break;
		  default:
		}
		$args = array(
				'post_type' => 'product',
				'posts_per_page' => 9,
				's'		=> $params['keyword'],
				'orderby' => $orderby,
				'order' => $order,
				'paged' => $params['paged'],
				'meta_query' => array(
					'relation' => 'AND',
					array(
					   'key' => 'price_type',
					   'value' => $price_type, 
					   'compare' => 'LIKE',
					),
					array(
					   'key' => 'bbrw_boattype',
					   'value' => $params['boat_type'], 
					   'compare' => 'LIKE',
					),
					array(
					   'key' => 'bbrw_year',
					   'value' => $params['year'], 
					   'compare' => 'LIKE',
					),
					array(
					   'key' => 'bbrw_model',
					   'value' => $params['model'], 
					   'compare' => 'LIKE',
					),
					array(
					   'key' => 'bbrw_make',
					   'value' => $params['make'], 
					   'compare' => 'LIKE',
					)
				),
			);
		if(!empty($params['capacity'])){
			$capacity = explode('-',$params['capacity']);
			
			$capacity_lg = array(
				'key'=> 'bbrw_capacity',
				'compare'   => '>=',
				'value'     => $capacity[0],
				'type'      => 'numeric'
			);
			$capacity_sm = array(
				'key' => 'bbrw_capacity',
				'compare'   => '<=',
				'value'     => $capacity[1],
				'type'      => 'numeric'
			);
			array_push($args['meta_query'],$capacity_lg);
			array_push($args['meta_query'],$capacity_sm);
		}	
		if(isset($params['min_b_length']) && isset($params['max_b_length'])){
			$min_length = $params['min_b_length'];
			$max_length = $params['max_b_length'];
			$arg = array( 
			   'key'     => 'bbrw_length',
			   'value'   =>  array($min_length , $max_length),
			   'type'    => 'numeric',
			   'compare' => 'between'                                      
			 
            );
			array_push($args['meta_query'],$arg);
		}
		if(isset($params['min_price']) && isset($params['max_price'])){
			$min_price = str_replace('$','',$params['min_price']);
			$min_price = str_replace(',','',$min_price);
			$max_price = str_replace('$','',$params['max_price']);
			$max_price = str_replace(',','',$max_price);
			$arg = array( 
			   'key'     => $pricing_key,
			   'value'   =>  array($min_price , $max_price),
			   'type'    => 'numeric',
			   'compare' => 'between'                                      
			 
            );
			array_push($args['meta_query'],$arg);
		}
		ob_start();	
		$loop = new WP_Query( $args );
		if ( $loop->have_posts() ) { ?>
			<div class="row result">
				<div class="col-md-12">
					<label><?= $loop->found_posts; ?> boats available</label>
				</div>
			</div>
			<div class="row list-group">
				<?php while ( $loop->have_posts() ) : $loop->the_post();
					$pricing = get_post_meta(get_the_ID(), $pricing_key, true);
					$model = get_post_meta(get_the_ID(), 'bbrw_model', true);
					$year = get_post_meta(get_the_ID(), 'bbrw_year', true);
					$capital = get_post_meta(get_the_ID(), 'bbrw_capacity', true);
					$boat_type = get_post_meta(get_the_ID(), 'bbrw_boattype', true);
					$make = get_post_meta(get_the_ID(), 'bbrw_make', true);
					$length = get_post_meta(get_the_ID(), 'bbrw_length', true);
					$image = wp_get_attachment_image_src( get_post_thumbnail_id(get_the_ID()), 'single-post-thumbnail' );
					include plugin_dir_path( __FILE__ ) .'views/boat_item.php';
				endwhile;
				wp_reset_postdata(); ?>
			</div>
			<div class="pg-row">
				<nav class="pg-pagination">
					<?php $big = 999999999;
						echo paginate_links( array(
							'base' => trailingslashit( home_url('shop-page') ) . "page{$wp_rewrite->pagination_base}/%#%/",
							'format' => '/paged/%#%',
							'current' => max( 1, $params['paged'] ),
							'total' => $loop->max_num_pages,
							'prev_text'    => __('«'),
							'next_text'    => __('»'),
							'type' => 'list'
						) );
					?>
				</nav>
			</div>
<?php	}else{ ?>
			<div class="row">
				<div class="col-md-12">
					<div class="alert alert-warning">
						<strong>No yachts found!</strong>
					</div>
				</div>
			</div>
<?php	}
		$template = ob_get_contents();
		die();
	}
	
	public function redirect_cart_to_checkout(){
		return wc_get_checkout_url();
	}
	public function boat_add_to_cart_link(){
		
	}
	function ipe_product_custom_price( $cart_item_data, $product_id ) {
	
		global $woocommerce;
		$woocommerce->cart->empty_cart();

		if( isset( $_POST['custom_price'] ) && !empty($_POST['custom_price'])) {	    
			
			$cart_item_data[ "custom_price" ] = $_POST['custom_price'];     
		}
		if(isset($_POST['date_rent']) && !empty($_POST['date_rent'])){
			$cart_item_data[ "date_rent" ] = $_POST['date_rent'];
		}
		if(isset($_POST['duration']) && !empty($_POST['duration'])){
			$cart_item_data[ "duration" ] = $_POST['duration'];
		}
		if(isset($_POST['date_range_rent_from']) && !empty($_POST['date_range_rent_from'])){
			$cart_item_data[ "date_range_rent_from" ] = $_POST['date_range_rent_from'];
		}
		if(isset($_POST['date_range_rent_to']) && !empty($_POST['date_range_rent_to'])){
			$cart_item_data[ "date_range_rent_to" ] = $_POST['date_range_rent_to'];
		}
		if(isset($_POST['starting_time']) && !empty($_POST['starting_time'])){
			$cart_item_data[ "starting_time" ] = $_POST['starting_time'];
		}
		return $cart_item_data;
        
    }
	public function ipe_apply_custom_price_to_cart_item( $cart_object ) {  
		if( !WC()->session->__isset( "reload_checkout" )) {
			
			foreach ( $cart_object->cart_contents as $key => $value ) {
				if( isset( $value["custom_price"] ) ) {
					$value['data']->set_price($value['custom_price']);
				}
			}   
		}   
	}
	
	public function add_option_to_review_order(){
		echo '<h2>Purchase Disclaimer2</h2>';
	}
	
	public function get_price_by_duration(){
		if(isset($_POST['params'])){
			$data = $_POST['params'];
			$pricing_plan = get_post_meta($data['product_id'], 'bbrw_pricing_active', true);
			$price = 0;
			if(!empty($pricing_plan)){
				foreach($pricing_plan as $key => $val){
					if($key == $data['duration']){
						$price = $val;
						break;
					}
				}
			}
			$price = $price * $data['count_rental'];
			wp_send_json_success(['price' => $price]);
			die();
		}else{
			wp_send_json_error('Error!');
		}
	}
	public function reorder_checkout_field( $checkout_fields ) {
		$checkout_fields['billing']['billing_email']['priority'] = 25;
		$checkout_fields['billing']['billing_first_name']['class'][0] = 'form-row-wide';
		$checkout_fields['billing']['billing_last_name']['class'][0] = 'form-row-wide';

		unset( $checkout_fields['order']['order_comments'] );

		return $checkout_fields;
	}
	public function boat_remove_fields_checkout($fields){
		unset( $fields['order'][ 'billing_first_name' ] );
		return $fields;
	}
	public function boat_add_field_checkout( $fields ) {

		$fields['billing_birthday'] = array(
			'type'        => 'date',
	        'label'       => __('Birthday'),
	        'class'       => array('form-row-wide'),
	        'priority'    => 26,
	        'required'    => true,
	        'clear'       => true,
	        'custom_attributes' => array( 'extra-checkout-birthday-description'=>"You must be at least 18 years old to sign up. Other Boatsetter users won't see your birthday." ),
	        'input_class' => array( 'append-birthday-description' ),
		);
		return $fields;

	}
	public function check_birth_date(){
	    if( isset($_POST['billing_birthday']) && ! empty($_POST['billing_birthday']) ){
	        $age = date_diff(date_create($_POST['billing_birthday']), date_create('now'))->y;
	        if( $age < 18 ){
	            wc_add_notice( __( "You need at least to be 18 years old, to be able to checkout." ), "error" );
	            // WC()->cart->empty_cart(); // <== Empty cart (optional)
	        }
	    }
	}

	public function wc_billing_field_strings( $translated_text, $text, $domain ) {
		switch ( $translated_text ) {
			case 'Billing details' :
				$translated_text = __( 'Your Infomation', 'woocommerce' );
				break;
		}
		return $translated_text;
	}
	function custom_checkout_before_order_review() {
		echo '<style type="text/css">#order_review_heading { display: none; } </style>';
		echo '<h2 id="reserve_review_heading">Reservation Information</h2>';
		global $woocommerce;
		$items = $woocommerce->cart->get_cart();
		if(!empty($items)){ 
			foreach($items as $key => $val){ 
				$duration = get_term_by('slug', $val['duration'], 'pricing'); 
				$name = $duration->name;
				$_product =  wc_get_product($val['data']->get_id());
				$image = wp_get_attachment_image_src( get_post_thumbnail_id($val['data']->get_id()), 'single-post-thumbnail' );
			?>
				<div class="reservation-information">
					<div class="item">Price: <?= get_woocommerce_currency_symbol().number_format($val['custom_price']); ?></div>

					<?php if($val['duration'] == 'multiple-days'): ?>
						<div class="item">Date From: <?= $val['date_range_rent_from']; ?></div>
						<input type="hidden" name="date_range_rent_from" value="<?= $val['date_range_rent_from']; ?>">

						<div class="item">Date To: <?= $val['date_range_rent_to']; ?></div>
						<input type="hidden" name="date_range_rent_to" value="<?= $val['date_range_rent_to']; ?>">

					<?php else:?>
						<div class="item">Date: <?= $val['date_rent']; ?></div>
						<input type="hidden" name="date_rent" value="<?= $val['date_rent']; ?>">
					<?php endif;?>

					<div class="item">Time: <?= $val['starting_time']; ?></div>
					<input type="hidden" name="checkout_starting_time" value="<?= $val['starting_time']; ?>">

					<div class="item">Duration: <?= $name; ?></div>
					<input type="hidden" name="checkout_duration" value="<?= $name; ?>">
				</div>
				<h2 id="product_name_review_heading"><?= $_product->get_title('woocommerce_thumbnail'); ?></h2>
				<div class="product-information">
					<div class="thumb"><?php if(!empty($image)): ?>
					<img src="<?= $image[0]; ?>"/>
					<?php endif; ?>
					</div>
					<h3>Specifications</h3>
					<div class="d-desc">
						<table>
							<tbody><tr>
								<?php 
									echo !empty(get_post_meta($val['data']->get_id(), 'bbrw_year', true)) ? '<td class="lb">Year</td><td class="vl">'.get_post_meta($val['data']->get_id(), 'bbrw_year', true).'</td>' :'';

									echo !empty(get_post_meta($val['data']->get_id(), 'bbrw_make', true)) ? '<td class="lb">Make</td><td class="vl">'.get_post_meta($val['data']->get_id(), 'bbrw_make', true).'</td>' :'';
								?>
							</tr>
							<tr>
								<?php 
									echo !empty(get_post_meta($val['data']->get_id(), 'bbrw_capacity', true)) ? '<td class="lb">Capacity</td><td class="vl">'.get_post_meta($val['data']->get_id(), 'bbrw_capacity', true).'</td>' :'';

									echo !empty(get_post_meta($val['data']->get_id(), 'bbrw_length', true)) ? '<td class="lb">Length</td><td class="vl">'.get_post_meta($val['data']->get_id(), 'bbrw_length', true).'</td>' :'';
								?>
							</tr>
							<tr>
								<?php 
									echo !empty(get_post_meta($val['data']->get_id(), 'bbrw_model', true)) ? '<td class="lb">Model</td><td class="vl">'.get_post_meta($val['data']->get_id(), 'bbrw_model', true).'</td>' :'';

									echo !empty(get_post_meta($val['data']->get_id(), 'bbrw_boattype', true)) ? '<td class="lb">Boat Type</td><td class="vl">'.get_post_meta($val['data']->get_id(), 'bbrw_boattype', true).'</td>' :'';
								?>
							</tr>
						</tbody></table>
					</div>
				</div>
	<?php	}
		}
	}
	public function add_custom_field_to_billing_form($checkout){
		$val = $checkout->get_value( 'custom_price' );
		if(empty($val)){
			$val = 1;
		}
		woocommerce_form_field( 'custom_price', array(
		'type'          => 'hidden',
		'required'	=> false,
		'label'         => '',
		'label_class'   => '',
		), $val );
	}
	public function boat_save_custom_field_added_checkout( $order_id ){

		if( !empty( $_POST['date_range_rent_from'] ) )
			update_post_meta( $order_id, 'date_range_rent_from', sanitize_text_field( $_POST['date_range_rent_from'] ) );

		if( !empty( $_POST['date_range_rent_to'] ) )
			update_post_meta( $order_id, 'date_range_rent_to', sanitize_text_field( $_POST['date_range_rent_to'] ) );

		if( !empty( $_POST['date_rent'] ) )
			update_post_meta( $order_id, 'date_rent', sanitize_text_field( $_POST['date_rent'] ) );

		if( !empty( $_POST['checkout_starting_time'] ) )
			update_post_meta( $order_id, 'checkout_starting_time', $_POST['checkout_starting_time']);	    

		if( !empty( $_POST['checkout_duration'] ) )
			update_post_meta( $order_id, 'checkout_duration', sanitize_text_field( $_POST['checkout_duration'] ) );

		if( !empty( $_POST['_billing_birthday'] ) )
			update_post_meta( $order_id, '_billing_birthday', sanitize_text_field( $_POST['_billing_birthday'] ) );
	}
	public function boat_change_order_received_text( $str, $order ) {

		echo '<style>.woocommerce-thankyou-order-details li.woocommerce-order-overview__order, .woocommerce-thankyou-order-details .woocommerce-order-overview__date{display: none !important;}</style>';		

		if(!empty(get_post_meta( $order->get_id(), 'date_rent', true ))){
			$new_str = $str . '<ul class="custom_received">
	    				
	    		<li class="order">Order number: <strong>'. $order->get_order_number().'</strong></li>	
	    		<li class="date_rent">Date rent: <strong>'.get_post_meta( $order->get_id(), 'date_rent', true ).'</strong></li>
	    		<li class="starting_time">Starting time: <strong>'.get_post_meta( $order->get_id(), 'checkout_starting_time', true ).'</strong></li>
	    		<li class="duration">Duration: <strong>'.get_post_meta( $order->get_id(), 'checkout_duration', true ).'</strong></li>
	    	</ul>';
		}
		else{
			$new_str = $str . '<ul class="custom_received">
	    				
	    		<li class="order">Order number: <strong>'. $order->get_order_number().'</strong></li>	
	    		<li class="date_rent">Date rent: from <strong>'.get_post_meta( $order->get_id(), 'date_range_rent_from', true ).'</strong> to <strong>'.get_post_meta( $order->get_id(), 'date_range_rent_to', true ).'</strong></li>
	    		<li class="starting_time">Starting time: <strong>'.get_post_meta( $order->get_id(), 'checkout_starting_time', true ).'</strong></li>
	    		<li class="duration">Duration: <strong>'.get_post_meta( $order->get_id(), 'checkout_duration', true ).'</strong></li>

	    	</ul>';
		}		
	    return $new_str;
	}
	public function boat_display_billing_options_value_in_admin_order($order){
		if( $value = get_post_meta( $order->get_id(), '_billing_birthday', true ) )	{	   
		   	echo '<p class="woocommerce-customer-details--birthday"><strong>Birthday:</strong><br>'.$value.'</p>';
		}
	}
	// public function boat_view_order_and_thankyou_page($order_id ){	
	// 	$date_format = get_post_meta( $order_id, '_billing_birthday', true );
	// 	$date_format = date('F j, Y', strtotime($date_format));   
	// 	if(!empty($date_format))	{	
			
	// 	   	echo '<p class="woocommerce-customer-details--birthday">Birthday: '.$date_format.'</p>';
	// 	}
	// }
	public function boat_woocommerce_enable_order_notes_field(){
		return false;
	}
	public function boat_register_session(){
	    if( !session_id() ) {
	        session_start();
		}
	}

}
