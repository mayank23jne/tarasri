
<?php
$s3_bucket_url = \Config::get('app.s3_bucket_url');
?>
                @if($products)
				<div class="row">
				@foreach($products as $prod)
				@if($prod['meta_link'])
				<?php 
				if($prod['slug'])
				{
					$reff_data=$prod['slug'];
				}
				else 
				{
					$reff_data=$prod['id'];
				}
				?>
					<div class="product-block col-12 col-sm-12 col-md-6 col-lg-4 col-xl-3 mb-0 px-0 ">
						<div class="border products-list position-relative">
							<a target="_blank" href="{{ url('collection-single/'.$reff_data) }}" class="stretched-link"></a>
							<div class="img-hover text-center">
								<div class="fav"> 
								<?php 
								if(Session::get('usersession'))
								{
									if(is_fevrate(Session::get('usersession')->user_id,$prod['id']))
									{
										$fev=1;
									}
									else 
									{
										$fev=0;
									}
								}
								else 
								{
									$fev=0;
								}
								?>
									<button class="<?php if($fev) { ?> remove_to_fevrate <?php } else { ?>add_to_fevrate <?php } ?>" data-id="{{ $prod['id'] }}" data-user="<?php if(Session::get('usersession')) { echo  Session::get('usersession')->user_id; } ?>">
									<?php if($fev) { ?> <img class="fev_icon_{{ $prod['id'] }}" src="{{ url('') }}/public/assets/images/fav_fill.svg"> <?php } else { ?><img class="fev_icon_{{ $prod['id'] }}" src="{{ url('') }}/public/assets/images/fav.svg"><?php } ?>
										
									</button> 
								</div>
								<div style="" class="overflow-hidden">
									<div class="jewellery-image bg-img" style="">
									@if($prod['meta_link'])
									<?php 
								if($prod['meta_thumb'])
								{
									$img_arr = explode('public/',$prod['meta_thumb']);
								}
								else 
								{
									$img_arr = explode('public/',$prod['meta_link']);
								}
										if(isset($img_arr[1]))
											$im=$img_arr[1];
										else 
											$im=$img_arr[0];
									// $show_image = '/public/'.$im;
									$show_image = $s3_bucket_url.$im;
									if($prod['slug'])
									{
										$reff_data=$prod['slug'];
									}
									else 
									{
										$reff_data=$prod['id'];
									}
									?>
									<img src="{{ url($show_image) }}" alt="{{ $prod['alt_text'] }}" class="img-fluid jewellery-image img-load">
									@endif
								</div>
								</div>
							</div>
						</div>
					</div>
				@endif
				@endforeach
				@else
    				@if(!isset($load_more))
    					<div class="no-products-wrapper text-center col-sm-12">
    						<div>
    							<div>
    								<img width="350" class="wow  bounceInLeft animated" data-wow-offset="10" data-wow-delay=".2s" data-wow-duration="0.3s" src="{{ url('public/assets/images/no_products.jpg') }}" style="visibility: visible; animation-duration: 0.3s; animation-delay: 0.2s; animation-name: bounceInLeft;">
    							</div>
    						</div>
    					</div>
    				</div>
    				@endif
				@endif
				@if(!isset($load_more))
               
				@endif