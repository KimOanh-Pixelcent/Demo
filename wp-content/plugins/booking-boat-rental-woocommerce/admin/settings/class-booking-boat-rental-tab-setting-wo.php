<?php
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

if ( ! class_exists( 'WC_Settings_WO' ) ) :

/**
 * Settings class
 *
 * @since 1.0.0
 */
class WC_Settings_WO extends WC_Settings_Page {
	
    public function __construct() {
        
		$this->id    = 'bbrw_setting';
		$this->label = __( 'Boat Rental Setting', 'booking-boat-rental-woocommerce' );
				
		add_filter( 'woocommerce_settings_tabs_array', array( $this, 'add_settings_page' ), 20 );
		add_action( 'woocommerce_settings_' . $this->id, array( $this, 'output' ) );
		add_action( 'woocommerce_settings_save_' . $this->id, array( $this, 'save' ) );
		add_action( 'woocommerce_sections_' . $this->id,      array( $this, 'output_sections' ) );
	}
	public function get_sections() {
        
		$sections = array(
			''         => __( 'General', 'booking-boat-rental-woocommerce' ),
			'second' => __( 'Display', 'booking-boat-rental-woocommerce' ),
			'third' => __( 'Import Demo', 'booking-boat-rental-woocommerce' )
		);
            
		return apply_filters( 'woocommerce_get_sections_' . $this->id, $sections );
	}
	
	public function get_settings( $current_section = '' ) {
		if ( 'second' == $current_section ) {
				
			/**
			 * Filter Plugin Section 2 Settings
			 *
			 * @since 1.0.0
			 * @param array $settings Array of the plugin settings
			 */
			$settings = apply_filters( 'bbrw_setting_label_settings', array(
				array(
					'name' => __( 'Display Config', 'booking-boat-rental-woocommerce' ),
					'type' => 'title',
					'desc' => '',
					'id'   => 'display_config',
				),	
				array(
					'type'     => 'checkbox',
					'id'       => 'show_filter_search_shop',
					'name'     => __( 'Hide search/filter form', 'booking-boat-rental-woocommerce' ),
					'desc'     => __( 'Check to hide from boat available page', 'booking-boat-rental-woocommerce' ),
					'default'  => 'no',
				),	
				array(
					'name' => __( 'View Detail Label Button', 'booking-boat-rental-woocommerce' ),
					'type' => 'text',
					'desc' => '',
					'id'   => 'view_detail',
				),
				array(
					'name' => __( 'Reserve Now Label Button', 'booking-boat-rental-woocommerce' ),
					'type' => 'text',
					'desc' => '(Only applied to boat available and detail pages)',
					'id'   => 'reserve_now_archive_label',
				),	
				array(
					'name' => __( 'Continue Reserve Label Button', 'booking-boat-rental-woocommerce' ),
					'type' => 'text',
					'desc' => '(Only applied to reserve page)',
					'id'   => 'continue_reserve_label',
				),
				array(
					'name' => __( 'Checkout Label Button', 'booking-boat-rental-woocommerce' ),
					'type' => 'text',
					'desc' => '(Only applied to checkout page)',
					'id'   => 'checkout_label_button',
				),
				array(
					'type'  => 'sectionend',
					'id'    => 'rnb_instastant_payment_options',
				),
			) );
					
		} 
		else if ( 'third' == $current_section ){
			$settings = apply_filters( 'bbrw_setting_label_settings', array(

				array(
					'type' => 'sectionend',
					'id'   => 'myplugin_import_options',
				),

				$this->boat_import_html()
					
			) );
		}
		else {
					
			/**
			 * Filter Plugin Section 1 Settings
			 *
			 * @since 1.0.0
			 * @param array $settings Array of the plugin settings
			 */
			$settings = apply_filters( 'bbrw_setting_general_settings', array(
				
				array(
					'name' => __( 'Config Working Time', 'booking-boat-rental-woocommerce' ),
					'type' => 'title',
					'desc' => '',
					'id'   => 'config_working_time',
				),
				array(
					'name' => __( 'Open Time', 'booking-boat-rental-woocommerce' ),
					'type' => 'time',
					'id'   => 'open_time'
				),	
				array(
					'type' => 'time',
					'name' => __( 'Close Time', 'booking-boat-rental-woocommerce' ),
					'id'   => 'close_time'
				),	
				/*array(
					'type' => 'select',
					'name' => __( 'Date Format', 'booking-boat-rental-woocommerce' ),
					'options'  => array(
						'F j, Y'    	=> __( 'F j, Y', 'booking-boat-rental-woocommerce' ),
						'MMMM D, YYYY'    	=> __( 'MMMM D, YYYY', 'booking-boat-rental-woocommerce' ),
						'Y/m/d' => __( 'Y/m/d', 'booking-boat-rental-woocommerce' ),
						'm/d/Y' 	=> __( 'm/d/Y', 'booking-boat-rental-woocommerce' ),
						'd/m/Y'    	=> __( 'd/m/Y', 'booking-boat-rental-woocommerce' ),
					),
					'class'    => 'wc-enhanced-select',
					'id'   => 'date_format',
					'desc'     => 'F j, Y - August 20, 2021, Y/m/d - MMMM D, YYYY - August 20, 2021, Y/m/d - 2021-08-20, m/d/Y - 08/20/2021, d/m/Y - 20/08/2021',
					'desc_tip' => true,
				),	
				array(
					'type' => 'select',
					'name' => __( 'Time Format', 'booking-boat-rental-woocommerce' ),
					'options'  => array(
						'12h' => __( '12 hours', 'booking-boat-rental-woocommerce' ),
						'24h' 	=> __( '24 hours', 'booking-boat-rental-woocommerce' ),
					),
					'class'    => 'wc-enhanced-select',
					'id'   => 'time_format',
				),	
				array(
					'type' => 'sectionend',
					'id'   => 'myplugin_important_options'
				),
				array(
					'type' => 'title',
					'name' => __( 'Availability', 'booking-boat-rental-woocommerce' ),
					'id'   => 'available'
				),	
				array(
					'name' => __( 'Day Available', 'booking-boat-rental-woocommerce' ),
					'type'     => 'textarea',
					'id'       => 'day_available',
                    'placeholder' => __('Write weekday name in comma separated e.g. - Sun, Mon, Tue, Wed, Thu, Fri, Sat', 'booking-boat-rental-woocommerce'),
					'custom_attributes' => array(
                            'rows'  => '3',
                        ),
				),
				array(
					'type' => 'number',
					'name' => __( 'Min Booking Days', 'booking-boat-rental-woocommerce' ),
					'id'   => 'min_booking_day',
					'placeholder' => 'Default is 1 day',
					'desc'     => 'Min : 1',
					'desc_tip' => true,
				),
				array(
					'type' => 'number',
					'name' => __( 'Max Booking Days', 'booking-boat-rental-woocommerce' ),
					'id'   => 'max_booking_day'
				),
				array(
					'type' => 'number',
					'name' => __( 'Min Bookings Hours', 'booking-boat-rental-woocommerce' ),
					'id'   => 'min_booking_hour',
					'placeholder' => 'Default is 1 hour',
					'desc'     => 'Min : 1',
					'desc_tip' => true,
				),
				array(
					'type' => 'number',
					'name' => __( 'Max Bookings Hours', 'booking-boat-rental-woocommerce' ),
					'id'   => 'max_booking_hour'
				),*/					
				array(
					'type'  => 'sectionend',
					'id'    => 'rnb_instastant_payment_options',
				),
				
			) );
				
		}
				
		/**
		 * Filter MyPlugin Settings
		 *
		 * @since 1.0.0
		 * @param array $settings Array of the plugin settings
		 */
		return apply_filters( 'woocommerce_get_settings_' . $this->id, $settings, $current_section );
				
	}
	function boat_import_html() { ?>

		<p>Choose file to import: </p>
		<button type="button" name="demo_import" id="demo_import">Import</button>
		<script type="text/javascript">
	    (function($){
	        $(document).ready(function(){
	            $('#demo_import').click(function(){
	                $.ajax({
	                    type : "post", //Ph????ng th???c truy???n post ho???c get
	                    dataType : "json", //D???ng d??? li???u tr??? v??? xml, json, script, or html
	                    url : '<?php include_once plugin_dir_path( __FILE__ ).'/import-demo-ajax.php'; ?> ', //???????ng d???n ch???a h??m x??? l?? d??? li???u. M???c ?????nh c???a WP nh?? v???y
	                    data : {
	                        action: "Import Demo", //T??n action
	                        website : '',//Bi???n truy???n v??o x??? l??. $_POST['website']
	                    },
	                    context: this,
	                    beforeSend: function(){
	                        //L??m g?? ???? tr?????c khi g???i d??? li???u v??o x??? l??
	                    },
	                    success: function(response) {
	                        //L??m g?? ???? khi d??? li???u ???? ???????c x??? l??
	                        if(response.success) {
	                            alert(response.data);
	                        }
	                        else {
	                            alert('The error occured.');
	                        }
	                    },
	                    error: function( jqXHR, textStatus, errorThrown ){
	                        //L??m g?? ???? khi c?? l???i x???y ra
	                        console.log( 'The following error occured: ' + textStatus, errorThrown );
	                    }
	                })
	                return false;
	            })
	        })
	    })(jQuery)
	</script>
		 <?php
	}
	
}
endif;
new WC_Settings_WO();