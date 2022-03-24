<?php 

	global $wpdb, $post;
	$results = $wpdb->get_results($wpdb->prepare("SELECT * FROM " . $wpdb->prefix . "posts WHERE ID = '%s';", $_GET["vat"]));	

	if(isset($_GET["vat"])){
		if ($results) {
			$post_id = $_GET["vat"]; ?>
			<div id="reserve-now" class="boat-detail alignwide">
				<div class="container">        
					<div class="row">
						<div class="col-lg-6">
							<?php 
								$pricing_active = get_post_meta($post_id,'bbrw_pricing_active', true);
								$args_pricing = get_terms([
									'taxonomy' => 'pricing',
									'hide_empty' => false,
								]);
								$arr_pricing_active = [];
								if($pricing_active && $args_pricing){
									foreach($args_pricing as $item){
										if(array_key_exists($item->slug,$pricing_active)){
											$arr_pricing_active[$item->slug] = $item->name.' '.$item->description;
										}
									}
								}
								$bbrw_capacity  = get_post_meta($post_id, 'bbrw_capacity', true);
								$open_time  = !empty(get_option('open_time'))?get_option('open_time'):'06:00';
								$close_time = !empty(get_option('close_time'))?get_option('close_time'):'18:00';;
								$prefix_open = explode(':',$open_time);
								$prefix_close = explode(':',$close_time);
								$starting_time1 = [];
								for($i = $prefix_open[0]; $i <= $prefix_close[0]; $i++){
									$h = $i;
									if($i < 10){
										$i = str_replace('0','',$i);
										$h = '0'.$i;
									}
									$h = $h.':00';
									$starting_time1[] = $h;
								}
								//Convert time to AM PM
								$starting_time = [];
								foreach($starting_time1 as $item){
									$currentDateTime = '08/04/2010 '.$item;
									$starting_time[] = date('h:i A', strtotime($currentDateTime));
								}
							?>
							<div id="boat-side" class="boat-side">
								<form class="cart" action="<?= get_the_permalink($post_id); ?>" method="post" enctype="multipart/form-data">
									<div class="form-group apply-only-date">
										<label for="dateRental">Date: When would you like to rent?</label>
										<input name="date_rent" type="text" required class="form-control" id="dateRental" aria-describedby="SelectDate" placeholder="Select date">
									</div>
									<div class="form-group">
										<label for="durationRental">Duration: how long would like to enjoy the water?</label>
								<?php if(!empty($arr_pricing_active)){
										$dem = 0;
										foreach($arr_pricing_active as $key => $item){ ?>
											<div class="form-check">
												<input <?php if($dem == 0) echo 'required'; ?> value="<?= $key;?>" class="form-check-input" type="radio" name="duration">
												<label class="form-check-label"><?= $item;?></label>
											</div>
								<?php	$dem++;
										}
									} ?>
									</div>
									<div class="form-group date-range-contain" style="display:none;">
										<label>Choose date range</label>
										<input name="date_range_rent" type="text" class="form-control" id="dateRangeRental" aria-describedby="SelectDate" placeholder="Select Dates">
										<input name="date_range_rent_from" type="hidden" class="form-control" id="dateRangeRentalFrom">
										<input name="date_range_rent_to" type="hidden" class="form-control" id="dateRangeRentalTo">
									</div>
									<div class="form-group">
										<label>Starting time</label>
										<select name="starting_time" id="startingTime" class="form-control" required>
											<option value="">Select a time you will arrive</option>
											<?php if(!empty($starting_time)): 
													foreach($starting_time as $key => $item):
												?>
												<option value="<?= $item; ?>"><?= $item; ?></option>
											<?php endforeach; 
												endif; 
											?>
										</select>
									</div>
									<div class="form-group">
										<label>How many people will be joining you?</label>
										<div class="input-group people-number">
											<span class="input-group-btn">
												<button type="button" class="btn btn-default btn-number" disabled="disabled" data-type="minus" data-field="capacity[1]">
												  <span class="glyphicon glyphicon-minus"></span>
												</button>
											</span>
											<input type="text" name="capacity[1]" class="form-control input-number" value="1" min="1" max="<?= !empty($bbrw_capacity)? $bbrw_capacity : 10; ?>">
											<span class="input-group-btn">
												<button type="button" class="btn btn-default btn-number" data-type="plus" data-field="capacity[1]">
													<span class="glyphicon glyphicon-plus"></span>
												</button>
											</span>
										</div>
									</div>
									<div class="form-group text-center">
										<input type="hidden" name="quantity" value="1" inputmode="numeric">
										<input type="hidden" name="custom_price" value="<?= $pricing; ?>">
										<button class="bnt btn-reserve" type="submit" name="add-to-cart" value="<?= $post_id?>">Continue Reservation</button>
									</div>
								</form>
							</div>
						</div>			
						<div class="col-lg-6">
							<a class="b-link" href="<?php echo get_the_permalink($post_id); ?>">
								<h3 class="pro-name"><strong><?php echo get_the_title($post_id); ?></strong></h3>
								<div class="item active">
									<?php 
									$image = wp_get_attachment_image_src( get_post_thumbnail_id( $post_id ), 'single-post-thumbnail' );?>
									<img src="<?php  echo !empty($image[0])?$image[0]:plugin_dir_url( __FILE__ ) . 'img/boat-default-feature.jpg'; ?>">
								</div>
							</a>
							<p class="line-bt"></p>
							<div class="boat-description">
								<div class="mb-2"> 
									<h3><strong style="font-weight: 500">Specifications</strong></h3>
									<div class="d-desc">
										<table>
											<tbody>
												<tr>
												<?php 

													echo !empty(get_post_meta($post_id, 'bbrw_year', true)) ? '<td class="lb">Year</td><td class="vl">'.get_post_meta($post_id, 'bbrw_year', true).'</td>' :'';

													echo !empty(get_post_meta($post_id, 'bbrw_make', true)) ? '<td class="lb">Make</td><td class="vl">'.get_post_meta($post_id, 'bbrw_make', true).'</td>' :'';

												?>
												</tr>
												<tr>
												<?php 
													echo !empty(get_post_meta($post_id, 'bbrw_capacity', true)) ? '<td class="lb">Capacity</td><td class="vl">'.get_post_meta($post_id, 'bbrw_capacity', true).'</td>' :'';

													echo !empty(get_post_meta($post_id, 'bbrw_length', true)) ? '<td class="lb">Length</td><td class="vl">'.get_post_meta($post_id, 'bbrw_length', true).'</td>' :'';
												?>
												</tr>
												<tr>
												<?php 
													echo !empty(get_post_meta($post_id, 'bbrw_model', true)) ? '<td class="lb">Model</td><td class="vl">'.get_post_meta($post_id, 'bbrw_model', true).'</td>' :'';

													echo !empty(get_post_meta($post_id, 'bbrw_boattype', true)) ? '<td class="lb">Boat Type</td><td class="vl">'.get_post_meta($post_id, 'bbrw_boattype', true).'</td>' :'';
												?>
												</tr>
											</tbody>
										</table>
									</div>
								</div>              
							</div>
						</div>
					</div>
				</div>
			</div>
				
			<script>

				(function($) {
					'use strict';

					$('#dateRental').daterangepicker({
						minDate:new Date(),
						autoUpdateInput: false,
						singleDatePicker: true,
						locale: {
						  format: 'MMMM D, YYYY',
						  cancelLabel: 'Clear'
						},
					});
					$('#dateRental').on('apply.daterangepicker', function(ev, picker) {
						$(this).val(picker.startDate.format('MMMM D, YYYY'));
						//$('#dateRangeRental').data('daterangepicker').setStartDate(picker.startDate.format('MMMM D, YYYY'));
						//$('#dateRangeRental').data('daterangepicker').setEndDate('');
					});
					$('#dateRangeRental').daterangepicker({
						autoUpdateInput:false,
						minDate:new Date(),
						maxSpan: {
							days: 30
						},
						locale: {
						  format: 'MMMM D, YYYY',
						  cancelLabel: 'Clear'
						}
					});
					$('#dateRangeRental').on('apply.daterangepicker', function(ev, picker) {
						$(this).val(picker.startDate.format('MMMM D, YYYY') + ' - ' + picker.endDate.format('MMMM D, YYYY'));
						//$('#dateRental').data('daterangepicker').setStartDate(picker.startDate.format('MMMM D, YYYY'));
						$('#dateRangeRentalFrom').val(picker.startDate.format('MMMM D, YYYY'));
						$('#dateRangeRentalTo').val(picker.endDate.format('MMMM D, YYYY'));
						//$('#dateRental').val(picker.startDate.format('MMMM D, YYYY'));
						let count_rental = betweenDate(picker.startDate.format('MMMM D, YYYY'), picker.endDate.format('MMMM D, YYYY'));
						get_price_by_duration('multiple-days', count_rental, <?= $post_id?>);
					});
					function betweenDate(dateFrom, dateTo){
						const oneDay = 24 * 60 * 60 * 1000; // hours*minutes*seconds*milliseconds
						let firstDate = new Date(dateFrom);
						let secondDate = new Date(dateTo);
						const diffDays = Math.round(Math.abs((firstDate - secondDate) / oneDay));
						return diffDays;
					}
					function get_price_by_duration($duration, $count_rental = 1, $product_id){
						$.ajax({
							type : "post",
							dataType : "json",
							url : "<?php echo admin_url('admin-ajax.php');?>",
							data : {
								action: "get_price_by_duration",
								params:{
									duration: $duration,
									count_rental : $count_rental,
									product_id: $product_id
								}
							},
							success: function(response) {
								if(response.data.price != 0){
									$('input[name="custom_price"]').val(response.data.price);
								}else{
									alert('Duration unvailable.Please choose another options');
								}
							},
							error: function( jqXHR, textStatus, errorThrown ){
								console.log( 'The following error occured: ' + textStatus, errorThrown );
							}
						});
					}
					$('input[name="duration"]').click(function(){
						var duration = $(this).val();
						if(duration == 'multiple-days'){
							$('.date-range-contain').show();
							$('#dateRangeRental').attr('required',true);
							$('.apply-only-date').hide();
						}else{
							$('#dateRangeRentalFrom').val('');
							$('#dateRangeRentalTo').val('');
							$('.date-range-contain').hide();
							$('#dateRangeRental').val('');
							$('#dateRangeRental').removeAttr('required');
							$('.apply-only-date').show();
							get_price_by_duration(duration, 1, <?= $post_id?>);
						}
					});
				$('.btn-number').click(function(e){
					e.preventDefault();
					let fieldName = $(this).attr('data-field');
					let type = $(this).attr('data-type');
					var input = $("input[name='"+fieldName+"']");
					var currentVal = parseInt(input.val());
					if (!isNaN(currentVal)) {
						if(type == 'minus') {
							
							if(currentVal > input.attr('min')) {
								input.val(currentVal - 1).change();
							} 
							if(parseInt(input.val()) == input.attr('min')) {
								$(this).attr('disabled', true);
							}

						} else if(type == 'plus') {

							if(currentVal < input.attr('max')) {
								input.val(currentVal + 1).change();
							}
							if(parseInt(input.val()) == input.attr('max')) {
								$(this).attr('disabled', true);
							}

						}
					} else {
						input.val(0);
					}
				});
				$('.input-number').focusin(function(){
				   $(this).data('oldValue', $(this).val());
				});
				$('.input-number').change(function() {
					
					let minValue =  parseInt($(this).attr('min'));
					let maxValue =  parseInt($(this).attr('max'));
					let valueCurrent = parseInt($(this).val());
					let name = $(this).attr('name');
					if(valueCurrent >= minValue) {
						$(".btn-number[data-type='minus'][data-field='"+name+"']").removeAttr('disabled')
					} else {
						alert('Sorry, the minimum value was reached');
						$(this).val($(this).data('oldValue'));
					}
					if(valueCurrent <= maxValue) {
						$(".btn-number[data-type='plus'][data-field='"+name+"']").removeAttr('disabled')
					} else {
						alert('Sorry, the maximum value was reached');
						$(this).val($(this).data('oldValue'));
					}
				});
				$(".input-number").keydown(function (e) {
					if ($.inArray(e.keyCode, [46, 8, 9, 27, 13, 190]) !== -1 ||
						(e.keyCode == 65 && e.ctrlKey === true) || 
						(e.keyCode >= 35 && e.keyCode <= 39)) {
							return;
					}
					if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {
						e.preventDefault();
					}
				});
			})(jQuery);
			</script>
<?php	}
		else{
			echo "<div class='alignwide' style='font-size: 16px; '>
				<p>Product doesn't exist!. Click <a style='color: #2D7D96' href='".site_url()."'>Home page</a> to back.</a></p>
			</div>";
			exit;
		}
	}else{
		echo "<div class='alignwide' style='font-size: 16px; '>
				<p>Product doesn't exist!. Click <a style='color: #2D7D96' href='".site_url()."'>Home page</a> to back.</a></p>
			</div>";
		exit;
	}

?>