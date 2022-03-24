<?php 
	$show_form = get_option('show_filter_search_shop');
	$detail_label = !empty(get_option('view_detail')) ? get_option('view_detail') : 'View Detail';
	$reserve_label = !empty(get_option('reserve_now_archive_label'))?get_option('reserve_now_archive_label'):'Reserve Now' ;
?>
<div class="container">
	<h2 class="text-center">Available Boat</h2>
    <div class="well well-sm text-right f-hor">
		<div class="btn-group">
			<div class="form-sort">
				<select id="sort-product" class="form-control">
					<option class="date_desc">Default sorting</option>
					<!--<option>Sort by popularity</option>
					<option>Sort by average rating</option>-->
					<option value="date_desc">Sort by latest</option>
					<option value="price_asc">Sort by price: low to high</option>
					<option value="price_desc">Sort by price: high to low</option>
				</select>
			</div>
		</div>
        <div class="btn-group">
            <a href="#" id="list" class="btn btn-default btn-sm">
                <i class="bi bi-list-task"></i>
			</a>
			<a href="#" id="grid" class="btn btn-default btn-sm">
                <i class="bi bi-grid-3x3-gap"></i>
			</a>
        </div>
    </div>
	<div class="row">
		<?php if($show_form == 'no'): ?>
		<div class="col-md-3 sidebar-left">
			<div class="form-search">
				<h3 class="search__title">Search</h3>
				<form>
					<div class="form-group">
					    <label><span>Enter boat name</span></label>
						<input name='keyword' type="text" class="form-control" placeholder="Enter boat name">
					</div>
					<div class="form-group">
						<label><span>Select Duration</span></label>
						<select id="select-duration" name="duration" type="text" class="form-control">
						<option value="">Choose Duration</option>
						<?php  
							$pricing_options = get_terms([
								'taxonomy' => 'pricing',
								'hide_empty' => false,
							]);
							if(!empty($pricing_options)):
								foreach($pricing_options as $option):
									echo '<option value="'.$option->slug.'">'.$option->name.'</option>';
								endforeach;
							endif;
						?>	
						</select>
					</div>
					<div class="form-group">
					    <label><span>Select Boat Type</span></label>
						<select name="boat_type" type="text" class="form-control">
							<option value="">Choose Boat Type</option>
							<?php  
								$boat_type_options = get_terms([
									'taxonomy' => 'boat_types',
									'hide_empty' => false,
								]);
								if(!empty($boat_type_options)):
									foreach($boat_type_options as $option):
										echo '<option value="'.$option->name.'">'.$option->name.'</option>';
									endforeach;
								endif;
							?>	
						</select>
					</div>
				</form>
			</div>
			<div class="form-filter">
				<h3>Filter</h3>
				<div class="boat-filter__fields">
					<div class="row mt-25">
						<div class="col-sm-12">
							<label>Price</label>
							<div id="price-range"></div>
						</div>
					</div>
					<div class="row slider-labels">
						<div class="col-xs-6 caption">
							<strong>Min:</strong> <span id="price-range-value1"></span>
						</div>
						<div class="col-xs-6 text-right caption">
							<strong>Max:</strong> <span id="price-range-value2"></span>
						</div>
					</div>
					<div class="row mt-25">
						<div class="col-sm-12">
							<label>Length (ft)</label>
							<div id="length-range"></div>
						</div>
					</div>
					<div class="row slider-labels">
						<div class="col-xs-6 caption">
							<strong>Min:</strong> <span id="length-range-value1"></span>
						</div>
						<div class="col-xs-6 text-right caption">
							<strong>Max:</strong> <span id="length-range-value2"></span>
						</div>
					</div>			
					<div class="row mt-25">
						<div class="col-sm-12">
							<label>Year</label>
							<select name="year" class="form-control">
								<option value="">Choose Year</option>
								<option value="2018">2018</option>
								<option value="2019">2019</option>
								<option value="2020">2020</option>
								<option value="2021">2021</option>
							</select>
						</div>
					</div>
					<div class="row mt-25">
						<div class="col-sm-12">
							<label>Model</label>
							<select name="model" class="form-control">
								<option value="">Choose Model</option>
								<?php  
									$model_options = get_terms([
										'taxonomy' => 'models',
										'hide_empty' => false,
									]);
									if(!empty($model_options)):
										foreach($model_options as $option):
											echo '<option value="'.$option->name.'">'.$option->name.'</option>';
										endforeach;
									endif;
								?>
							</select>
						</div>
					</div>
					<div class="row mt-25">
						<div class="col-sm-12">
							<label>Make</label>
							<select name="make" class="form-control">
								<option value="">Choose Make</option>
								<?php  
									$make_options = get_terms([
										'taxonomy' => 'makes',
										'hide_empty' => false,
									]);
									if(!empty($make_options)):
										foreach($make_options as $option):
											echo '<option value="'.$option->name.'">'.$option->name.'</option>';
										endforeach;
									endif;
								?>	
							</select>
						</div>
					</div>
					<div class="row mt-25">
						<div class="col-sm-12">
							<label>Capacity</label>
							<div class="form-check">
								<label class="form-check-label" for="radio1">
									<input type="radio" class="form-check-input" id="radio1" name="capacity" value="" checked>None
								</label>
							</div>
							<div class="form-check">
								<label class="form-check-label" for="radio1">
									<input type="radio" class="form-check-input" id="radio2" name="capacity" value="1-5">1-5 peoples
								</label>
							</div>
							<div class="form-check">
								<label class="form-check-label" for="radio2">
									<input type="radio" class="form-check-input" id="radio3" name="capacity" value="6-10">6-10 peoples
								</label>
							</div>
							<div class="form-check">
								<label class="form-check-label" for="radio2">
									<input type="radio" class="form-check-input" id="radio4" name="capacity" value="11-15">11-15 peoples
								</label>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<?php endif;?>
		<div class="<?php if($show_form == 'no') echo 'col-md-9'; else { echo 'col-md-12'; } ?> product" id="products">
				<?php
					$type_default = '2-hours';
					$args = array(
						'post_type' => 'product',
						'posts_per_page' => 9,
						'paged' => get_query_var('paged') ? get_query_var('paged') : 1,
						'meta_query' => array(
							'relation' => 'AND',
							array(
							   'key' => 'bbrw_pricing_active',
							   'value' => $type_default, 
							   'compare' => 'LIKE',
							),
						),
					);
					$loop = new WP_Query( $args );
					if ( $loop->have_posts() ) { ?>
						<div class="row result">
							<div class="col-md-12">
								<label><?= $loop->found_posts; ?> boats available</label>
							</div>
						</div>
						<div class="row list-group">
			<?php		while ( $loop->have_posts() ) : $loop->the_post();
							$pricing = get_post_meta(get_the_ID(), 'bbrw_pricing_val_2-hours', true);
							$model = get_post_meta(get_the_ID(), 'bbrw_model', true);
							$year = get_post_meta(get_the_ID(), 'bbrw_year', true);
							$capacity = get_post_meta(get_the_ID(), 'bbrw_capacity', true);
							$boat_type = get_post_meta(get_the_ID(), 'bbrw_boattype', true);
							$make = get_post_meta(get_the_ID(), 'bbrw_make', true);
							$length = get_post_meta(get_the_ID(), 'bbrw_length', true);
							$image = wp_get_attachment_image_src( get_post_thumbnail_id(get_the_ID()), 'single-post-thumbnail' );
							
						?>
							<div class="item col-xs-4 col-lg-4">
								<div class="thumbnail">
									<div class="img-inner">
										<div class="product-item__thumbnail_overlay"></div>
										<h4 class="group inner list-group-item-heading title-grid"><?php the_title(); ?></h4>
										<img class="group list-group-image" src="<?php echo $image[0]; ?>" alt="" />
										<div class="price">
											<div class="normal-price">
												<span class="heading-font" itemprop="price">$<?= number_format($pricing); ?> / 
													<span class="type-price">2 hours</span>
												</span>
											</div>
										</div>
										<div class="product-item__description--actions">
											<a title="Detail" href="<?php the_permalink(); ?>" class="">
												<i class="bi bi-eye"></i> <?= $detail_label;?> 
											</a>
											<a data-toggle="tooltip" title="Reserve Now" href="<?php echo site_url(); ?>/shop-reserve/?vat=<?php echo get_the_ID(); ?>" class="">
												<input type="hidden" name="id_tam" value="<?php echo get_the_ID(); ?>">
												<i class="bi bi-calendar-plus"></i> <?= $reserve_label; ?>
											</a>											
										</div>
									</div>
									<div class="caption">
										<h4 class="group inner list-group-item-heading only-list"><?php the_title(); ?></h4>
										<h4 class="group inner list-group-item-heading only-grid">Specifications</h4>									
										<div class="d-desc">
											<table>
												<tr>
													<td class="lb">Year</td>
													<td class="vl"><?= $year; ?></td>
												</tr>
												<tr>
													<td class="lb">Make</td>
													<td class="vl"><?= $make; ?></td>
												</tr>
												<tr>
													<td class="lb">Capacity</td>
													<td class="vl">Up to <?= $capacity; ?> people</td>
												</tr>
												<tr>
													<td class="lb">Length</td>
													<td class="vl"><?= $length; ?> ft.</td>
												</tr>
												<tr>
													<td class="lb">Model</td>
													<td class="vl"><?= $model; ?></td>
												</tr>
												<tr>
													<td class="lb">Boat Type</td>
													<td class="vl"><?= $boat_type; ?></td>
												</tr>
											</table>
										</div>
										<ul class="boat-usp">
											<li>
												<div role="presentation" title="FREE Wifi" class="usp-item">
													<span class="usp-icon"><i class="bi bi-wifi"></i></span>
													<span class="usp-label">FREE Wifi</span>
												</div>
											</li>
											<li>
												<div role="presentation" title="Flat screen TV" class="usp-item">
													<span class="usp-icon">
														<i class="bi bi-tv"></i>
													</span>
													<span class="usp-label">Flat screen TV</span>
												</div>
											</li>
											<li>
												<div role="presentation" title="Bathing platform" class="usp-item">
													<span class="usp-icon">
														<i class="bi bi-geo"></i>
													</span> 
													<span class="usp-label">Bathing platform</span>
												</div>
											</li>
											<li>
												<div role="presentation" title="Bathing platform" class="usp-item">
													<span class="usp-icon">
														<i class="bi bi-mask"></i>
													</span> 
													<span class="usp-label">Shower</span>
												</div>
											</li>
										</ul>
										<div class="action-right pull-right">
											<a class="btn" href="<?php the_permalink(); ?>"><i class="bi bi-eye"></i> <?= $detail_label;?> </a>
											<a class="btn" href="<?php echo site_url(); ?>/shop-reserve/?vat=<?php echo get_the_ID(); ?>"><i class="bi bi-calendar-plus"></i> <?= $reserve_label; ?></a>
										</div>
									</div>
								</div>
							</div>
		<?php			endwhile; ?>
						</div>
		<?php		} else {?>
						<div class="row">
							<div class="col-md-12">
								<div class="alert alert-warning">
									<strong>No boats found!</strong>
								</div>
							</div>
						</div>
		<?php		}
					wp_reset_postdata();
				?>
			<div class="pg-row">
				<nav class="pg-pagination">
					<?php 
						
						$big = 999999999; // need an unlikely integer
						echo paginate_links( array(
							'base' => str_replace( $big, '%#%', get_pagenum_link( $big ) ),
							'format' => '/paged/%#%',
							'current' => max( 1, get_query_var('paged') ),
							'total' => $loop->max_num_pages,
							'prev_text'    => __('«'),
							'next_text'    => __('»'),
							'type' => 'list'
						) );

					?>
				</nav>
			</div>
		</div>
	</div>
	<div id="overlay" style="display: none;">
		<div class="cv-spinner">
		<span class="spinner"></span>
	</div>
	</div>
</div>

<script>
    (function($) {
    'use strict';
		var $type = '2-hours';
		var $sort_val = 'date_desc';
		var $params = {
			type: '2-hours',
			sort: 'date_desc',
			keyword:'',
			boat_type:'',
			year:'',
			model:'',
			make:'',
			capacity:'',
			min_b_length:null,
			max_b_length:null,
			min_price:null,
			max_price:null,
			paged:1,
			post_per_page:1
			
		};
		$('#products .item').addClass('grid-group-item');
		$('#list').click(function(event){
			event.preventDefault();
			$('#products .item').addClass('list-group-item');
		});
		$('#grid').click(function(event){
			event.preventDefault();
			$('#products .item').removeClass('list-group-item');
		});
		//range price
		$('.noUi-handle').on('click', function() {
			$(this).width(50);
		});
		var rangeSlider = document.getElementById('price-range');
		var moneyFormat = wNumb({
			decimals: 0,
			thousand: ',',
			prefix: '$'
		});
		noUiSlider.create(rangeSlider, {
			start: [10, 1000],
			step: 1,
			range: {
			'min': [10],
			'max': [1000]
			},
			format: moneyFormat,
			connect: true
		});
		rangeSlider.noUiSlider.on('update', function(values, handle) {
			document.getElementById('price-range-value1').innerHTML = values[0];
			document.getElementById('price-range-value2').innerHTML = values[1];
			$params.min_price = values[0];
			$params.max_price = values[1];
		});
		rangeSlider.noUiSlider.on('change', function() {
			ajax_filter();
		});
		//Length
		var lengthRange = document.getElementById('length-range');
		let lengthFormat = wNumb({
			decimals: 0,
			thousand: ',',
			prefix: ''
		});
		noUiSlider.create(lengthRange, {
			start: [10, 1000],
			step: 1,
			range: {
				'min': [10],
				'max': [100]
			},
			format: lengthFormat,
			connect: true
		});
		lengthRange.noUiSlider.on('update', function(values, handle) {
			document.getElementById('length-range-value1').innerHTML = values[0];
			document.getElementById('length-range-value2').innerHTML = values[1];
			$params.min_b_length = values[0];
			$params.max_b_length = values[1];
		});
		lengthRange.noUiSlider.on('change', function() {
			ajax_filter();
		});
		function ajax_filter(){
			$.ajax({
				type : "post",
				dataType : "html",
				url : "<?php echo admin_url('admin-ajax.php');?>",
				data : {
					action: "boat_shop_filter",
					params:$params
				},
				beforeSend: function(){
					$("#overlay").fadeIn(300);
				},
				success: function(response) {
					$('#products').html(response);
					//$('.pg-pagination').html(response.paginate);
					$("#overlay").fadeOut(300);
				},
				error: function( jqXHR, textStatus, errorThrown ){
					$("#overlay").fadeOut(300);
					console.log( 'The following error occured: ' + textStatus, errorThrown );
				}
			});
		}

		//
		$('#sort-product').change(function(){
			$sort_val = $(this).val();
			$params.sort = $(this).val();
			ajax_filter();
		});
		//
		$('input[name="keyword"]').keyup(function(){
			$params.keyword = $(this).val();
			setTimeout(function(){
				ajax_filter();
			},300);
		});
		$('select[name="boat_type"]').change(function(){
			$params.boat_type = $(this).val();
			ajax_filter();
		});
		$('select[name="year"]').change(function(){
			$params.year = $(this).val();
			ajax_filter();
		});
		$('select[name="model"]').change(function(){
			$params.model = $(this).val();
			ajax_filter();
		});
		$('select[name="make"]').change(function(){
			$params.make = $(this).val();
			ajax_filter();
		});
		$('input[name="capacity"]').change(function(){
			$params.capacity = $(this).val();
			ajax_filter();
		});
		//pagination
		$('#products').on('click','.pg-pagination a',function(e){
			e.preventDefault();
			var current_link = $(this).attr('href');
            var current_paged = current_link.match(/\/\d+\//)[0];
            var paged = current_paged.match(/\d+/)[0];
            if(!paged) 
				paged = 1;
			$params.paged = paged;
			ajax_filter();
		});		
		$('#select-duration').change(function(){
			let pricing_type = $(this).val();
			$params.type = pricing_type;
			ajax_filter();
		});
})(jQuery);
</script>