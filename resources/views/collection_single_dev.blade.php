@extends('layouts.app')
@section('title',$product_info->product_name.' | '.get_setting('site_title'))
@section('content')
  <style>
  .carousel-inner img {
    width: 100%;
    height: 100%;
  }
  #popup1{
	  display: block !important;
  }
  </style>
<?php
$s3_bucket_url = \Config::get('app.s3_bucket_url');
?>

<div class="container border-top custom_top">
	<div class="row my_blog">
        <div class="col-md-9 single_product">
					<div class="product_img">
						<div id="demo" class="carousel slide" data-ride="carousel">
							  <!-- Indicators -->
							  <ul class="carousel-indicators">
								@foreach($product_image as $key => $image)
								<li data-target="#demo" data-slide-to="{{ $key }}" class="<?php if($key==0) { ?>active <?php } ?>"></li>
							  @endforeach
							  </ul>
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
							  <!-- The slideshow -->
							  <div class="carousel-inner">
							  @foreach($product_image as $key => $image)
							  <?php 
							  $img_arr = explode('public/',$image['meta_link']);
								if(isset($img_arr[1]))
									$im=$img_arr[1];
								else 
									$im=$img_arr[0];
							   // $show_image = '/public/'.$im;
							   $show_image = $s3_bucket_url.$im;
							  ?>
								<div class="carousel-item <?php if($key==0) { ?> active <?php } ?>">
								  <div class="product_favourite">
									<a class="<?php if($fev) { ?> remove_to_fevrate <?php } else { ?>add_to_fevrate <?php } ?>" data-id="{{ $product_info->id }}" data-user="<?php if(Session::get('usersession')) { echo  Session::get('usersession')->user_id; } ?>">
									<?php if($fev) { ?> <img class="fev_icon_{{ $product_info->id }}" src="{{ url('') }}/public/assets/images/fav_fill.svg"> <?php } else { ?><img class="fev_icon_{{ $product_info->id }}" src="{{ url('') }}/public/assets/images/icon_favourite_blank.svg"><?php } ?>
										
									</a> 
								  </div>
								  <img src="{{ url($show_image) }}" alt="{{ $product_info->alt_text }}" >
								</div>
							 @endforeach
								
							  </div>
							  
							  <!-- Left and right controls -->
							  <a class="carousel-control-prev" href="#demo" data-slide="prev">
								<span class="carousel-control-prev-icon"></span>
							  </a>
							  <a class="carousel-control-next" href="#demo" data-slide="next">
								<span class="carousel-control-next-icon"></span>
							  </a>
						</div>
					</div> 
				<iframe  src="{{ url('collection_single_main_slider/'.$product_info->id) }}" style="display:none;width: 100%;height: 100vh;border: none;"></iframe>  
            
        </div>
        <div class="col-md-3">
            <div class="sidebar_item">
    	        <div class="single_product_name">
				{{ $product_info->product_name }}
    	        </div>
	            <div class="single_product_disc">
	               {!! $product_info->description !!}
	            </div>
	        </div>
	        <div class="sidebar_item">
    	        <div class="sidebar_title theme_charecter_big">
    	            Specifications
    	        </div>
	            <div class="single_product_specification">
	                <div class="single_specification">
	                    <div class="single_label specification">
	                        Design style
	                    </div>
	                    <div class="single_devider specification">
	                        :
	                    </div>
	                    <div class="single_value specification">
	                        {{ $product_info->design_style }}
	                    </div>
	                </div>
	                <div class="single_specification">
	                    <div class="single_label specification">
	                        Design number
	                    </div>
	                    <div class="single_devider specification">
	                        :
	                    </div>
	                    <div class="single_value specification">
	                       {{ $product_info->design_model_no }}
	                    </div>
	                </div>
	                <div class="single_specification">
	                    <div class="single_label specification">
	                        Metal
	                    </div>
	                    <div class="single_devider specification">
	                        :
	                    </div>
	                    <div class="single_value specification">
	                        {{ $product_info->metal_name }}
	                    </div>
	                </div>
	                <div class="single_specification">
	                    <div class="single_label specification">
	                        Metal purity
	                    </div>
	                    <div class="single_devider specification">
	                        :
	                    </div>
	                    <div class="single_value specification">
	                        @if($product_info->purity == 1)
								22k
							@elseif($product_info->purity == 2)
								24k
							@else 
								18k
							@endif
	                    </div>
	                </div>
	                <div class="single_specification">
	                    <div class="single_label specification">
	                        Occasion
	                    </div>
	                    <div class="single_devider specification">
	                        :
	                    </div>
	                    <div class="single_value specification">
	                       <?php 
							   $occ= explode(',',$product_info->occasion_type);
							   $occ_str='';
							   foreach($occ as $okey => $oc)
							   {
								   if($okey==0)
										$occ_str.=getSinglerow('occassion','occassion_name',array('id'=>$oc));
									else 
										$occ_str.=','.getSinglerow('occassion','occassion_name',array('id'=>$oc));
								
							   }
							   echo $occ_str;
							   ?>
	                    </div>
	                </div>
	                <div class="single_specification">
	                    <div class="single_label specification">
	                        Diamond type
	                    </div>
	                    <div class="single_devider specification">
	                        :
	                    </div>
	                    <div class="single_value specification">
	                        {{ $product_info->diamond_type }}
	                    </div>
	                </div>
	            </div>
	        </div>
	         <div class="sidebar_item">
			   @if(Session::get('usersession'))
			   <div class="sidebar_title theme_charecter_big">
                	<a class="button" href="#popup1">Request a quote</a>
                	<img class="side_arrow" src="{{ asset('public/assets/images/icon_arrow.svg') }}" alt="arrow">
                </div>
			   <div id="popup1" class="overlay">
                	<div class="popup">
                		<a class="close" href="#">&times;</a>
                		<div class="content">
                			<div class="product_form">
                			    <div class="product_form_heading">
                			        Request a qoute
                			    </div>
                			    <div class="form_inner">
									<form data-pop="#popup1" action="{{ url('product_enquiry') }}" class="database_operation_form">
										{{ csrf_field() }}
										<input type="hidden" name="user_id" value="{{ Session::get('usersession')->user_id }}" />
										<input type="hidden" name="product_id" value="{{ $product_info->id }}" />
										<textarea rows="5" required placeholder="Enter message here..." name="message"></textarea>
										<button class="product_form_submit">Submit</button>
									</form>
                			    </div>
                			</div>
                		</div>
                	</div>
                </div>
				@else 
				<div class="sidebar_title theme_charecter_big">
                	<a class="button collection_single_page" data-toggle="modal" data-target="#loginModal" href="javascript:;">Plese login for request a quote</a>
                	<img class="side_arrow" src="{{ asset('public/assets/images/icon_arrow.svg') }}" alt="arrow">
                </div>
				@endif
    	     </div>
			 <div class="row">
				<div class="col-sm-12">
				@if($product_info->youtube_link)
				<div class="embed-responsive embed-responsive-16by9">
				<iframe class="embed-responsive-item" src="{{ $product_info->youtube_link }}" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
				</div>
				@endif
				@if($product_video)
				<video class="mt-4" style="display:none" style="width:100%" controls>
				  <source src="{{ $product_video->meta_link }}" type="video/mp4">
				  Your browser does not support the video tag.
				</video>
				@endif
				</div>
			 </div>
        </div>
		<br><br>
		
		<div class="col-md-12 carousel_one">
			<div class="filter-by-heading mb-2">
				{{ getSinglerow('collection','collection_name',array('id'=>$product_info->collection_id)) }} Collection
			</div>
			<div class="container-fluid">
			  <div class="row">
				<div class="col-xs-12 col-sm-12 col-md-12">
				<div id="carousel-example-multi" class="carousel slide carousel-multi-item v-2 product-carousel" data-ride="carousel">

					<!--Controls-->
					<div class="controls-top my-3">
					  <a class="btn-floating btn-sm control_left" href="#carousel-example-multi" data-slide="prev"><i class="fas fa-chevron-left"></i></a>
					  <a class="btn-floating btn-sm control_right" href="#carousel-example-multi" data-slide="next"><i class="fas fa-chevron-right"></i></a>
					</div>
					<div class="carousel-inner custom_carousel" role="listbox">
					<?php $jj1=0; ?>
					@foreach($collection_product as $key => $col_prod11)
					 <?php 
					 if($col_prod11['meta_thumb'])
					    $img_arr1 = explode('public/',$col_prod11['meta_thumb']);
					  else 
						  $img_arr1 = explode('public/',$col_prod11['meta_link']);
						if(isset($img_arr1[1]))
							$im1=$img_arr1[1];
						else 
							$im1=$img_arr1[0];
					   // $show_image1 = '/public/'.$im1;
					   $show_image1 = $s3_bucket_url.$im1;
					  ?>
					  @if($key<6)
					  <div class="carousel-item <?php if($jj1==0) {  ?> active mx-auto <?php } ?> ">
						<div class="col-12 col-md-4 col-lg-2 mx-auto">
						<a href="{{ url('collection-single/'.$col_prod11['slug']) }}">
						  <div class="card mb-2">
							<div class="view overlay">
							  <img class="card-img-top" src="{{ url($show_image1) }}" alt="{{ $col_prod11['alt_text'] }}">
							  <a href="#!">
								<div class="mask rgba-white-slight"></div>
							  </a>
							</div>
						  </div>
						</a>
						</div>
					  </div>
					  <?php $jj1++; ?>
					 @endif
					 @endforeach
					</div>

				</div>
				</div>
			  </div>
			</div>
		</div>
		<br><br>
		<div class="col-md-12 carousel_two">
			<div class="filter-by-heading mb-2">
				More {{ $cat_name }} in Trend
			</div>
		<div class="container-fluid">
			  <div class="row">
				<div class="col-xs-12 col-sm-12 col-md-12">
				<div id="carousel-example-multi2" class="carousel slide carousel-multi-item v-3 product-carousel" data-ride="carousel">

					<!--Controls-->
					<div class="controls-top my-3">
					  <a class="btn-floating btn-sm control_left" href="#carousel-example-multi2" data-slide="prev"><i class="fas fa-chevron-left"></i></a>
					  <a class="btn-floating btn-sm control_right" href="#carousel-example-multi2" data-slide="next"><i class="fas fa-chevron-right"></i></a>
					</div>
					<div class="carousel-inner custom_carousel" role="listbox">
					<?php $jj1=0; ?>
					@foreach($categoery_products as $key => $col_prod1)
					<?php 
					if($col_prod1['meta_thumb'])
					    $img_arr2 = explode('public/',$col_prod1['meta_thumb']);
					else 
						$img_arr2 = explode('public/',$col_prod1['meta_link']);
						if(isset($img_arr2[1]))
							$im2=$img_arr2[1];
						else 
							$im2=$img_arr2[0];
					   // $show_image2 = '/public/'.$im2;
					   $show_image2 = $s3_bucket_url.$im2;
					  ?>
					@if($key<6)
					@if($col_prod1['id']!=$product_info->id)
					 
					<div class="carousel-item <?php if($jj1==0) {  ?> active mx-auto <?php } ?> ">
					
						<div class="col-12 col-md-4 col-lg-2 mx-auto">
						<a href="{{ url('collection-single/'.$col_prod1['slug']) }}">
						  <div class="card mb-2">
							<div class="view overlay">
							  <img class="card-img-top" src="{{ url($show_image2) }}" alt="{{ $col_prod1['alt_text'] }}">
							  
								<div class="mask rgba-white-slight"></div>
							  
							</div>
						  </div>
						</a>
						</div>
					  
					  </div>
					  
					  <?php $jj1++; ?>
					 @endif
					 @endif
					 @endforeach
					</div>

				</div>
				</div>
			  </div>
			</div>
		</div>	
		</div>
    </div>
</div>
<script>
</script>
@endsection