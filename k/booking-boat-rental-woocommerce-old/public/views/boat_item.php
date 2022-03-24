<div class="item col-xs-4 col-lg-4 grid-group-item">
	<div class="thumbnail">
		<div class="img-inner">
			<div class="product-item__thumbnail_overlay"></div>
			<img class="group list-group-image" src="<?= $image[0]; ?>" alt="" />
			<div class="price">
				<div class="normal-price">
					<span class="heading-font" itemprop="price">$<?= number_format($pricing); ?> / 
						<span class="type-price"><?= $type;?></span>
					</span>
				</div>
			</div>
			<div class="product-item__description--actions">
				<!--<a data-toggle="tooltip" title="Book Now" href="#" class="">
					<i class="bi bi-calendar-plus"></i>
				</a>-->
				<a title="Detail" href="<?php the_permalink(); ?>" class="">
					<i class="bi bi-eye"></i> View yacht 
				</a>
			</div>
		</div>
		<div class="caption">
			<h4 class="group inner list-group-item-heading"><?php the_title(); ?>
				<span>
					<i class="bi bi-star-fill"></i>
					<i class="bi bi-star-fill"></i>
					<i class="bi bi-star-fill"></i>
					<i class="bi bi-star-fill"></i>
					<i class="bi bi-star-fill"></i>
				</span>
			</h4>
										
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
				<!--<a class="btn" href="#"><i class="bi bi-calendar-plus"></i> Booking Now</a>-->
				<a class="btn" href="<?php the_permalink(); ?>"><i class="bi bi-eye"></i> View yacht</a>
			</div>
		</div>
	</div>
</div>