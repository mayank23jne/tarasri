  <link rel='stylesheet' href='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css'>
 <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" >
 <link href="{{ url('') }}/public/front_assets/css_web/blog.css" media="screen" rel="stylesheet" type="text/css">
  <div class="product_img">
 <div id="myCarousel" class="carousel slide" data-ride="carousel">
                      <!-- Indicators -->
                      <ol class="carousel-indicators">
					  @foreach($product_image as $key => $image)
                        <li data-target="#myCarousel" data-slide-to="{{ $key }}" class="<?php if($key==0) { ?>active <?php } ?>"></li>
                      @endforeach
                      </ol>
					   <?php 
					   if(Session::get('usersession'))
						{
							if(is_fevrate(Session::get('usersession')->user_id,$product_info->id))
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
                      <!-- Wrapper for slides -->
                      <div class="carousel-inner" role="listbox">
                       @foreach($product_image as $key => $image)
					   <div class="item <?php if($key==0) { ?> active <?php } ?>">
						 
						  <div class="product_favourite">
                            <a class="<?php if($fev) { ?> remove_to_fevrate <?php } else { ?>add_to_fevrate <?php } ?>" data-id="{{ $product_info->id }}" data-user="<?php if(Session::get('usersession')) { echo  Session::get('usersession')->user_id; } ?>">
							<?php if($fev) { ?> <img class="fev_icon_{{ $product_info->id }}" src="{{ url('') }}/public/assets/images/fav_fill.svg"> <?php } else { ?><img class="fev_icon_{{ $product_info->id }}" src="{{ url('') }}/public/assets/images/icon_favourite_blank.svg"><?php } ?>
								
							</a> 
                          </div>
						  
                          <img src="{{ url($image['meta_link']) }}" alt="{{ $product_info->alt_text }}">
                          <div class="carousel-caption">
                          </div>
                        </div>
                      @endforeach
                      </div>
                    
                      <!-- Left and right controls -->
                      <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev">
                        <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
                        <span class="sr-only">Previous</span>
                      </a>
                      <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next">
                        <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
                        <span class="sr-only">Next</span>
                      </a>
                </div>
				</div> 