<div id="product_settings_data" class="panel woocommerce_options_panel">
    <h3><?php _e('Settings', 'booking-boat-rental-woocommerce'); ?></h3>
	<h4><?php _e('Configure Pricing Plan (required)', 'booking-boat-rental-woocommerce'); ?></h4>
<?php 

	$pricing = get_post_meta($post_id, 'bbrw_pricing_active', true); 

	$args_pricing = get_terms([
			'taxonomy' => 'pricing',
			'hide_empty' => false,
		]);
		
	$pricing_options[''] = __('Choose Pricing Plan', 'booking-boat-rental-woocommerce');
	if(!empty($args_pricing)){
		foreach($args_pricing as $item){
			$pricing_options[$item->slug] =  __($item->name, 'booking-boat-rental-woocommerce');
		}
	} ?>
	<p class=" form-field bbrw_pricing_plan_field">
		<label for="bbrw_pricing_plan">Choose pricing plan</label>
		<select style="" id="bbrw_pricing_plan" name="bbrw_pricing_plan" class="select short">
			<option value="" selected="selected">Choose Pricing Plan</option>
			<?php if(!empty($args_pricing)): 
					foreach($args_pricing as $item):?>
						<option <?php if(!empty($pricing[$item->slug])) echo 'disabled'; ?> value="<?= $item->slug;?>"><?= $item->name; ?></option>
			<?php 	endforeach; 
				endif; ?>
		</select>
	</p>
	<div class="pricing-container">
		<?php if(!empty($pricing)){
			foreach($pricing as $key => $val){ ?>
				<div class="pricing-day-tier-item">
					<p class="form-field">
						<label>Plan Type</label>
						<input class="pricing-type-input" type="hidden" value="<?= $key;?>" name="bbrw_pricing_type[]">
						<input type="text" class="short" readonly value="<?= !empty($pricing_options[$key]) ? $pricing_options[$key]:'';?>" placeholder="">
					</p>
					<p class="form-field label-text-change">
						<label>Pricing ($)</label>
						<input type="text" class="short" name="bbrw_pricing_regular[]" placeholder="Enter Value" value="<?= $val?>">
					</p>
					<a class="delete-pricing-type" href="#"><img src="<?php echo plugin_dir_url( __DIR__ ) .'icon/delete_icon.png'; ?>"></a>
				</div>
<?php 		}
		} ?>
	</div>
	<div class="action-pricing">
		<a class="button add-pricing">Add pricing</a>
	</div>
	<!--<h4><?php _e('Availability', 'booking-boat-rental-woocommerce'); ?></h4>-->
	<?php 
		/*woocommerce_wp_text_input(
            array(
                'id'          => 'min_day',
                'name'        => 'min_day',
                'label'       => __('Minimum days', 'booking-boat-rental-woocommerce'),
                'placeholder' => __('Enter Minimum days', 'booking-boat-rental-woocommerce'),
                'type'        => 'text',
                'value'       => '',
            )
        );
		woocommerce_wp_text_input(
            array(
                'id'          => 'max_day',
                'name'        => 'max_day',
                'label'       => __('Maximum days', 'booking-boat-rental-woocommerce'),
                'placeholder' => __('Enter Maximum days', 'booking-boat-rental-woocommerce'),
                'type'        => 'text',
                'value'       => '',
            )
        );
		woocommerce_wp_text_input(
            array(
                'id'          => 'min_hour',
                'name'        => 'min_hour',
                'label'       => __('Minimum hours', 'booking-boat-rental-woocommerce'),
                'placeholder' => __('Enter Minimum hours', 'booking-boat-rental-woocommerce'),
                'type'        => 'text',
                'value'       => '',
            )
        );
		woocommerce_wp_text_input(
            array(
                'id'          => 'max_hour',
                'name'        => 'max_hour',
                'label'       => __('Maximum hours', 'booking-boat-rental-woocommerce'),
                'placeholder' => __('Enter Maximum hours', 'booking-boat-rental-woocommerce'),
                'type'        => 'text',
                'value'       => '',
            )
        );*/
	?>
</div>
<div id="product_feature_data" class="panel woocommerce_options_panel">
    <h3><?php _e('Specifications', 'booking-boat-rental-woocommerce'); ?></h3>
    <?php
        $bbrw_year = get_post_meta($post_id, 'bbrw_year', true);
        $bbrw_length = get_post_meta($post_id, 'bbrw_length', true);
        $bbrw_make = get_post_meta($post_id, 'bbrw_make', true);
        $bbrw_model = get_post_meta($post_id, 'bbrw_model', true);
        $bbrw_capacity = get_post_meta($post_id, 'bbrw_capacity', true);
        $bbrw_boattype = get_post_meta($post_id, 'bbrw_boattype', true);
        $bbrw_features = get_post_meta($post_id, 'bbrw_features', true);
        $bbrw_services = get_post_meta($post_id, 'bbrw_services', true);
        $bbrw_display = get_post_meta($post_id, 'bbrw_display', true);
		// Make taxonomy
        $bbrw_make_options = get_terms([
					'taxonomy' => 'makes',
					'hide_empty' => false,
				]);
		$make_options[''] = __('Choose Make', 'booking-boat-rental-woocommerce');
		if(!empty($bbrw_make_options)){
			foreach($bbrw_make_options as $item){
				$make_options[$item->name] =  __($item->name, 'booking-boat-rental-woocommerce');
			}
		}
		//Model taxonomy
        $bbrw_model_options = get_terms([
					'taxonomy' => 'models',
					'hide_empty' => false,
				]);
		$model_options[''] = __('Choose Model', 'booking-boat-rental-woocommerce');
		if(!empty($bbrw_model_options)){
			foreach($bbrw_model_options as $item){
				$model_options[$item->name] =  __($item->name, 'booking-boat-rental-woocommerce');
			}
		}
		//Boat type taxonomy
        $bbrw_boat_types_options = get_terms([
					'taxonomy' => 'boat_types',
					'hide_empty' => false,
				]);
		$boat_types_options[''] = __('Choose Boat Type', 'booking-boat-rental-woocommerce');
		if(!empty($bbrw_boat_types_options)){
			foreach($bbrw_boat_types_options as $item){
				$boat_types_options[$item->name] =  __($item->name, 'booking-boat-rental-woocommerce');
			}
		}
		
        $arr_bbrw_features = null;
        $arr_bbrw_services = null;
        if(!empty($bbrw_features)){
            $arr_bbrw_features = unserialize($bbrw_features);
        }
        if(!empty($bbrw_services)){
            $arr_bbrw_services = unserialize($bbrw_services);
        }
        woocommerce_wp_select(
            array(
            'id' => 'bbrw_year', 
            'label' => __('Year', 'booking-boat-rental-woocommerce'), 
            'name'        => 'bbrw_year',
            'value'    => !empty($bbrw_year) ? $bbrw_year:'',
            'options' => array(
            '' => __('Choose Year', 'booking-boat-rental-woocommerce'),
            '2018' => __('2018', 'booking-boat-rental-woocommerce'),
            '2019'   => __('2019', 'booking-boat-rental-woocommerce'),
            '2020' => __('2020', 'booking-boat-rental-woocommerce'),
            '2021'      => __('2021', 'booking-boat-rental-woocommerce'),
        )));
        woocommerce_wp_text_input(
            array(
                'id'          => 'bbrw_length',
                'name'        => 'bbrw_length',
                'label'       => __('Length (ft)', 'booking-boat-rental-woocommerce'),
                'placeholder' => __('Enter Boat Length', 'booking-boat-rental-woocommerce'),
                'type'        => 'text',
                'value'    => !empty($bbrw_length) ? $bbrw_length:'',
            )
        );
        woocommerce_wp_select(
            array(
            'id'            => 'bbrw_make', 
            'label'         => __('Make', 'booking-boat-rental-woocommerce'), 
            'name'          => 'bbrw_make',
            'value'    => !empty($bbrw_make) ? $bbrw_make:'',
            'options'       => $make_options
		));
        woocommerce_wp_select(
            array(
            'id'                    => 'bbrw_model', 
            'label'                 => __('Model', 'booking-boat-rental-woocommerce'), 
            'name'                  => 'bbrw_model',
            'value'    => !empty($bbrw_model) ? $bbrw_model:'',
            'options'               => $model_options
		));
        woocommerce_wp_text_input(
            array(
                'id'          => 'bbrw_capacity',
                'name'        => 'bbrw_capacity',
                'label'       => __('Capacity', 'booking-boat-rental-woocommerce'),
                'placeholder' => __('Enter Boat Capacity', 'booking-boat-rental-woocommerce'),
                'type'        => 'text',
                'value'       => !empty($bbrw_capacity) ? $bbrw_capacity:'',
            )
        );
        woocommerce_wp_select(
            array(
            'id'                        => 'bbrw_boattype', 
            'label'                     => __('Boat Type', 'booking-boat-rental-woocommerce'), 
            'name'                      => 'bbrw_boattype',
            'value'                     => !empty($bbrw_boattype) ? $bbrw_boattype:'',
            'options'                   => $boat_types_options
		));
    ?>
    <h3><?php _e('Features & Allowed On Boat', 'booking-boat-rental-woocommerce'); ?></h3>
    <?php 
        woocommerce_wp_select(
            array(
            'id'                        => 'bbrw_display', 
            'label'                     => __('Choose Setting for Display', 'booking-boat-rental-woocommerce'), 
            'name'                      => 'bbrw_display',
            'value'                     => !empty($bbrw_display) ? $bbrw_display:'global_settings',
            'options'                   => array(
            'local_settings'            => __('Local Settings', 'booking-boat-rental-woocommerce'),
            'global_settings'           => __('Global Settings', 'booking-boat-rental-woocommerce'),
        )));
    ?>
    <h4><?php _e('Features', 'booking-boat-rental-woocommerce'); ?></h4>
    <?php 
        $features_terms = get_terms([
            'taxonomy' => 'features',
            'hide_empty' => false,
        ]);
        if(!empty($features_terms)){
            echo '<div class="options_group options_group-custom">';
            foreach($features_terms as $item){
                $checked = '';
                if(!empty($arr_bbrw_features) && in_array($item->name, $arr_bbrw_features)){
                    $checked = 'checked';
                } ?>
                <p class="form-field">
                    <label><?= $item->name?></label>
                    <input <?= $checked ?> type="checkbox" class="checkbox" name="bbrw_features[]" value="<?= $item->name; ?>">
                </p>
<?php        }
            echo '</div>';
        }

    ?>
    <h4><?php _e('Allowed On Boat', 'booking-boat-rental-woocommerce'); ?></h4>
    <?php 
        $services_terms = get_terms([
            'taxonomy' => 'services',
            'hide_empty' => false,
        ]);
        if(!empty($services_terms)){
            echo '<div class="options_group options_group-custom">';
            foreach($services_terms as $item){
                $checked = '';
                if(!empty($arr_bbrw_services) && in_array($item->name, $arr_bbrw_services)){
                    $checked = 'checked';
                }?>
                <p class="form-field">
                    <label><?= $item->name?></label>
                    <input <?= $checked ?> type="checkbox" class="checkbox" name="bbrw_services[]" value="<?= $item->name; ?>">
                </p>
 <?php  }
            echo '</div>';
        }

    ?>
</div>
<script>
(function($) {
    'use strict';
	function check_option_disable($val){
		var op = document.getElementById("bbrw_pricing_plan").getElementsByTagName("option");
		for (var i = 0; i < op.length; i++) {
		  if(op[i].value.toLowerCase() == $val) 
			op[i].disabled = true 
		}
	}
	function check_option_enable($val){
		var op = document.getElementById("bbrw_pricing_plan").getElementsByTagName("option");
		for (var i = 0; i < op.length; i++) {
		  if(op[i].value.toLowerCase() == $val) 
			op[i].disabled = false 
		}
	}
	$('.add-pricing').click(function(){
		let val = $('#bbrw_pricing_plan').val();
		let text = $('#bbrw_pricing_plan option:selected').text();
		let icon = "<?php echo plugin_dir_url( __DIR__ ) .'icon/delete_icon.png'; ?>";
		if(val){
			var html = '<div class="pricing-day-tier-item">' +
				'<p class="form-field">' +
					'<label>Plan Type</label>' +
					'<input class="pricing-type-input" type="hidden" value="'+val+'" name="bbrw_pricing_type[]">'+
					'<input type="text" class="short" readonly value="'+ text +'" placeholder="">' +
				'</p>' +
				'<p class="form-field label-text-change">' +
					'<label>Pricing ($)</label>' +
					'<input type="text" class="short" name="bbrw_pricing_regular[]" placeholder="Enter Value">' +
				'</p>' +
				'<a class="delete-pricing-type" href="#"><img src="'+icon+'"></a>'
			'</div>';
			$('.pricing-container').append(html);
			check_option_disable(val);
		}else{
			alert('Please choose pricing plan');
		}
	});
	$(".pricing-container").on("click",".delete-pricing-type", function(e){
		e.preventDefault();
		let parent =  $(this).parents('.pricing-day-tier-item');
		let val = parent.find('.pricing-type-input').val();
		parent.remove();
		check_option_enable(val);
	});
    
})(jQuery);
</script> 