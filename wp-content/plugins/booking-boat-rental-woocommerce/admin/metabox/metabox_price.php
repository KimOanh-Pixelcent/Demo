<div class="bbrw-form">
<?php
    woocommerce_wp_text_input(
        array(
            'id'          => 'quantity',
            'label'       => __('Set Quantity', 'booking-boat-rental-woocommerce'),
            'placeholder' => __('Add quantity', 'booking-boat-rental-woocommerce'),
            'type'        => 'text',
            'desc_tip'    => 'true',
            'value'       => 1,
            'description' => sprintf(__('Minimum 1 is required for each invenotry to work with.', 'booking-boat-rental-woocommerce'))
        )
    );
?>
    <div class="full-day-pricing-panel">
        <h4><?php _e('Set Full-Day Pricing Plan', 'booking-boat-rental-woocommerce'); ?></h4>
        <?php
            woocommerce_wp_text_input(array(
                'id'          => 'full_day',
                'label'       => __('Full-Day Price ('.$currency.')', 'booking-boat-rental-woocommerce'),
                'placeholder' => __('Enter price here', 'booking-boat-rental-woocommerce'),
                'type'        => 'text',
                'value'       => 0,
            ));
        ?>
    </div>
    <div class="half-day-pricing-panel">
        <h4><?php _e('Set Half-Day Pricing Plan', 'booking-boat-rental-woocommerce'); ?></h4>
        <?php
            $sessions = ['morning', 'afternoon'];
            $half_pricing = get_post_meta($post_id, 'bbrw_half_pricing', true);
            $half_pricing = $half_pricing ? $half_pricing : array();
 
            foreach ($sessions as $key => $session) {
                 woocommerce_wp_text_input(array(
                     'id'          => $session . '_price',
                     'label'       => __(ucfirst($session) . ' ( ' . $currency . ' )', 'booking-boat-rental-woocommerce'),
                     'placeholder' => __('Enter price here', 'booking-boat-rental-woocommerce'),
                     'type'        => 'text',
                     'value'       => isset($half_pricing[$sessions[$key]]) ? $half_pricing[$sessions[$key]] : 0,
                 ));
            }
        ?>
    </div>
    <div class="hourly-pricing-panel">
        <h4><?php _e('Set Hourly Pricing Plan', 'booking-boat-rental-woocommerce'); ?></h4>
        <?php
            woocommerce_wp_text_input(array(
                'id'          => 'hourly_price',
                'label'       => __('Hourly Price ( ' . $currency . ' )', 'booking-boat-rental-woocommerce'),
                'placeholder' => __('Enter price here', 'booking-boat-rental-woocommerce'),
                'type'        => 'text',
                'value'       => 0,
            ));
        ?>
    </div>
</div>