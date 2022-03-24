<?php 
	global $post, $wpdb;

	$img_size = $wpdb->get_row( $wpdb->prepare( "SELECT * FROM ".$wpdb->posts." WHERE post_title = %s", 'bg-840x523.jpg') );
	$url_img_size = wp_get_attachment_url($img_size->ID); 
?>

	<div id="boat-detail" class="boat-detail">
        <div class="container">        
            <div class="row">
                <div class="col-lg-12"><h3 class="pro-name"><strong><?php echo $product->get_name(); ?></strong></h3></div>
                <div class="col-lg-7">
                	<?php  	
            			$srcImage = get_the_post_thumbnail_url( get_the_ID(), 'full' );
            			$product = new WC_product(get_the_ID());
					    $gallery = $product->get_gallery_image_ids(); 					    
					?>
                	<div id="boat-carousel" class="carousel slide relative mb-3 <?php if(empty($gallery)){echo 'gallery-empty'; } ?>" data-ride="carousel">

                		<ul class="carousel-indicators">
                			<?php
						   
						    $i= 0;
						    if(!empty($srcImage)):
						    	?>	
						    		<li data-target="#boat-carousel" data-slide-to="<?php echo $i; ?>" style="background-image: url(<?php echo $srcImage; ?>); background-position: center; background-size: cover;" class="<?php if($i==0): echo 'active'; endif; ?>">
			                            <img src="<?php echo $url_img_size; ?>" alt="" class="fade">
			                       	</li> 
						    	<?php
						    	$i++;
						    else:
						    endif;
						    foreach( $gallery as $attachment_id ) 
						    {
						        
						        $Original_image_url = wp_get_attachment_url( $attachment_id );
						        ?>
						          	<li data-target="#boat-carousel" data-slide-to="<?php echo $i; ?>" style="background-image: url(<?php echo $Original_image_url; ?>); background-position: center; background-size: cover;" class="<?php if($i==0): echo 'active'; endif; ?>">
			                            <img src="<?php echo $url_img_size; ?>" alt="" class="fade">
			                       	</li> 

						        <?php $i++;
						    } ?>
	                    </ul>
	                    <div class="carousel-inner">

	                    	<?php 
	                    		$j = 0; 
	                    		if(!empty($srcImage)):
	                    			
	                    			?>
	                    				<div class="item <?php if($j==0): echo 'active'; endif; ?>" style="background-image: url(<?php echo $srcImage; ?>); background-position: center; background-size: cover;">
				                         	<img src="<?php echo $url_img_size; ?>" alt="" class="fade">
				                        </div>
	                    			<?php
	                    			$j++; 
	                    		else:
	                    		endif;

							    foreach( $gallery as $attachment_id_1 ) 
							    {							        

							        $Original_image_url_1 = wp_get_attachment_url( $attachment_id_1 );
							        ?>

				                       	<div class="item <?php if($j==0): echo 'active'; endif; ?>" style="background-image: url(<?php echo $Original_image_url_1; ?>); background-position: center; background-size: cover;">
				                         	<img src="<?php echo $url_img_size; ?>" alt="" class="fade">
				                        </div>

							        <?php $j++;
							    } ?>			                        
	                                       
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
                </div>
                <div class="col-lg-5">
                	<div class="boat-description">

                		<?php if(!empty(get_post_meta(get_the_ID(), 'bbrw_year', true)) && 
                			!empty(get_post_meta(get_the_ID(), 'bbrw_length', true)) && 
                			!empty(get_post_meta(get_the_ID(), 'bbrw_make', true)) && 
                			!empty(get_post_meta(get_the_ID(), 'bbrw_model', true)) && 
                			!empty(get_post_meta(get_the_ID(), 'bbrw_boattype', true)) && 
                			!empty(get_post_meta(get_the_ID(), 'bbrw_capacity', true))): ?>

	                		<div class="mb-5 spec"> 
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
	                      	</div>

	                    <?php endif; ?>

                      	<div class="reserve-now-container">
							<a href="<?php echo site_url(); ?>/shop-reserve/?vat=<?php echo get_the_ID(); ?>" title="Reserve Now">
								<button class="bnt btn-reserve" type="button">Reserve Now</button>
							</a>
						</div>
                	</div>
                </div>                
            </div>
            <div class="row">
            	<div class="col-lg-12">
					<div class="boat-description">
                      	
                      	<?php if(!empty(get_the_excerpt())): ?>
	                      	<div class="mb-2">
		                        <h3><strong style="font-weight: 500">Boat Description</strong></h3>
		                        <?php echo the_excerpt(); ?>
	                      	</div>			
	                      	<p class="line-bt"></p>		
                      	<?php endif; ?>	

                      	<?php 
                      		$bbrw_features = get_post_meta(get_the_ID(), 'bbrw_features', true);
                  			$arr_bbrw_features = null;
					        if(!empty($bbrw_features)){
					            $arr_bbrw_features = unserialize($bbrw_features);
					        }
                  			$features_terms = get_terms([
					            'taxonomy' => 'features',
					            'hide_empty' => false,
					        ]);
                      		if(!empty($arr_bbrw_features)): ?>
                      		<div class="mb-2">
	                          	<h3><strong style="font-weight: 500">Features</strong></h3>
	                          	<ul> 
	                      		<?php 	                      			
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
                      	<?php endif; 

                      	$bbrw_services = get_post_meta(get_the_ID(), 'bbrw_services', true);
                		$arr_bbrw_services = null;
				        if(!empty($bbrw_services)){
				            $arr_bbrw_services = unserialize($bbrw_services);
				        }
                    	$services_terms = get_terms([
				            'taxonomy' => 'services',
				            'hide_empty' => false,
				        ]); 
                      	if(!empty($arr_bbrw_services)): ?>

	                      	<div class="mb-2">
		                        <h3><strong style="font-weight: 500">Allowed on boat</strong></h3>
		                        <ul>
		                        	<?php 		                        		
							        	foreach($services_terms as $item){
						        			if(!empty($arr_bbrw_services) && in_array($item->name, $arr_bbrw_services)){ ?>

							        			<li><span><?= $item->name?></span></li>

							        		<?php
							                }
							        	}
							        ?>	                           
		                        </ul>               
	                      	</div>   
	                      	<p class="line-bt"></p>

	                    <?php endif; ?>               
                  	</div>                  	
                  	<div class="reserve-now-container text-center">
                  		<a href="<?php echo site_url(); ?>/shop-reserve/?vat=<?php echo get_the_ID(); ?>" title="Reserve Now">
                  			<button class="bnt btn-reserve" type="button">Reserve Now</button>
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
	        wrap: false,
	        interval: false,
	      });
})(jQuery); </script>