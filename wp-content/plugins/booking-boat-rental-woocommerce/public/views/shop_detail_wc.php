<?php 
	global $post;
	$reserve_label = !empty(get_option('reserve_now_archive_label'))?get_option('reserve_now_archive_label'):'Reserve Now' ;
?>

	<div id="boat-detail" class="boat-detail">
        <div class="container">        
            <div class="row">
                <div class="col-lg-12"><h3 class="pro-name"><strong><?php echo $product->get_name(); ?></strong></h3></div>
                <div class="col-lg-7">
					<?php 
						$attachment_ids = $product->get_gallery_image_ids();
						if(!empty($attachment_ids)):
					?>
					<div id="boat-carousel" class="carousel slide relative mb-3" data-ride="carousel">
						<ul class="carousel-indicators">
						<?php
							foreach( $attachment_ids as $key => $attachment_id ) {  
								$image_link = wp_get_attachment_url( $attachment_id ); ?>
								<li data-target="#boat-carousel" data-slide-to="<?= $key; ?>" style="background-image: url('<?= $image_link?>');" class="<?php if($key == 0) echo 'active'; ?>">
									<img src="<?= $image_link?>" alt="" class="fade">
								 </li> 
						<?php } ?>                     
						</ul>				  
					  <!-- The slideshow -->
					  <div class="carousel-inner">
						<?php
							foreach( $attachment_ids as $key => $attachment_id ) { 
								$image_link = wp_get_attachment_url( $attachment_id ); ?>
								<div class="item <?php if($key == 0) echo 'active'; ?>">
								  <img src="<?= $image_link; ?>" alt="" width="1100" height="500">
								</div>
						<?php } ?>                     
					  </div>
					  
					  <div class="arrow">
						  <a class="carousel-control carousel-control-prev" href="#boat-carousel" data-slide="prev">
							<span class="carousel-control-prev-icon"></span>
						  </a>
						  <a class="carousel-control carousel-control-next" href="#boat-carousel" data-slide="next">
							<span class="carousel-control-next-icon"></span>
						  </a>
					  </div>
					</div>
					<?php else: ?>
					<?php 
						$image = wp_get_attachment_image_src( get_post_thumbnail_id( $post_id ), 'single-post-thumbnail' );?>
						<div class="boat-image">
							<img src="<?php  echo !empty($image[0])?$image[0]:plugin_dir_url( __FILE__ ) . 'img/boat-default-feature.jpg'; ?>">
						</div>
					<?php endif; ?>
                </div>
                <div class="col-lg-5">
					<div class="boat-description spec"> 
						<h3><strong style="font-weight: 500">Specifications</strong></h3>
						<ul class="gray-span">

						<?php 
							echo !empty(get_post_meta(get_the_ID(), 'bbrw_year', true)) ? '<li><span>Year: </span><span>'.get_post_meta(get_the_ID(), 'bbrw_year', true).'</span></li>' :'';
							echo !empty(get_post_meta(get_the_ID(), 'bbrw_length', true)) ? '<li><span>Length: </span><span>'.get_post_meta(get_the_ID(), 'bbrw_length', true).'</span></li>' :'';
							echo !empty(get_post_meta(get_the_ID(), 'bbrw_make', true)) ? '<li><span>Make: </span><span>'.get_post_meta(get_the_ID(), 'bbrw_make', true).'</span></li>' :'';
							echo !empty(get_post_meta(get_the_ID(), 'bbrw_model', true)) ? '<li><span>Model: </span><span>'.get_post_meta(get_the_ID(), 'bbrw_model', true).'</span></li>' :'';
							echo !empty(get_post_meta(get_the_ID(), 'bbrw_boattype', true)) ? '<li><span>Boat Type: </span><span>'.get_post_meta(get_the_ID(), 'bbrw_boattype', true).'</span></li>' :'';
							echo !empty(get_post_meta(get_the_ID(), 'bbrw_capacity', true)) ? '<li><span>Capacity: </span><span>'.get_post_meta(get_the_ID(), 'bbrw_capacity', true).'</span></li>' :'';
						?>
						</ul>
						<div class="reserve-now-container">
							<a href="<?php echo site_url(); ?>/shop-reserve/?vat=<?php echo get_the_ID(); ?>" title="<?= $reserve_label;?>">
								<button class="bnt btn-reserve" type="button"><?= $reserve_label;?></button>
							</a>
						</div>
					</div>
                </div>                
            </div>
            <div class="row">
            	<div class="col-lg-12">
				    <div class="boat-description">
                		<div class="mb-2">
	                        <h3><strong style="font-weight: 500">Boat Description</strong></h3>
	                        <?php echo the_excerpt(); ?>
                      	</div>
                	</div>
					<p class="line-bt"></p>
					<div class="boat-description">
                      	<?php $bbrw_features = get_post_meta(get_the_ID(), 'bbrw_features', true); ?>
						<?php if(!empty($bbrw_features)): ?>
                      	<div class="mb-2">
                          	<h3><strong style="font-weight: 500">Features</strong></h3>
                          	<ul> 
                      		<?php 
						        $arr_bbrw_features = unserialize($bbrw_features);
                      			$features_terms = get_terms([
						            'taxonomy' => 'features',
						            'hide_empty' => false,
						        ]);
						        foreach($features_terms as $item){
						        	if(!empty($arr_bbrw_features) && in_array($item->name, $arr_bbrw_features)){
						        		?>
						        			<li><span><?= $item->name?></span></li>
						        		<?php
					                    
					                }
						        }
                      		 ?>
                          	</ul>
                      	</div>
                      	<p class="line-bt"></p>
						<?php endif; ?>
						<?php $bbrw_services = get_post_meta(get_the_ID(), 'bbrw_services', true); ?>
						<?php if(!empty($bbrw_services)): ?>
                      	<div class="mb-2 allowed-boat">
	                        <h3><strong style="font-weight: 500">Allowed on boat</strong></h3>
	                        <ul>
	                        	<?php 
							        $arr_bbrw_services = unserialize($bbrw_services);
		                        	$services_terms = get_terms([
							            'taxonomy' => 'services',
							            'hide_empty' => false,
							        ]); 
						        	foreach($services_terms as $item){
					        			if(!empty($arr_bbrw_services) && in_array($item->name, $arr_bbrw_services)){ ?>

						        			<li class="checked"><span><?= $item->name?></span></li>
						        		<?php
						                }else{ ?>
											<li class="unchecked"><span><?= $item->name?></span></li>
						<?php 			}
						        	}
						        ?>	                           
	                        </ul>               
                      	</div>
						<?php endif; ?>
                  	</div>
                  	<div class="reserve-now-container text-center">
                  		<a href="<?php echo site_url(); ?>/shop-reserve/?vat=<?php echo get_the_ID(); ?>" title="<?= $reserve_label;?>">
                  			<button class="bnt btn-reserve" type="button"><?= $reserve_label;?></button>
                  		</a>			    	
				    </div>
                </div>
            </div>
        </div>
    </div>    

<script>
	(function($) {
		'use strict';
		jQuery('#boat-carousel').carousel({
	        wrap: true,
	        interval: 5000,
	      });
})(jQuery); </script>