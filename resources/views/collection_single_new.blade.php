@extends('layouts.app')
@section('title',$product_info->product_name.' | '.get_setting('site_title'))
@section('seo_keywords', $product_info->seo_keywords)
@section('seo_description', $product_info->seo_description)
@section('content')
 <style>
  #popup1{
	  /* display: block !important; */
  }
  </style>
 <link href="{{url('public/assets/plugins/blog-carousal/jquerysctipttop.css')}}" rel="stylesheet" type="text/css">
<section class="collection">
<div class="container">
    <div class="row">
        <div class="col-md-12 slider_collection">
            
            <div class="collection_slider_one  blog-carousel">
                <div class="container-slider">
					<ul>
						@foreach($product_image as $image)
						<?php 
							$s3_bucket_url = \Config::get('app.s3_bucket_url');
							$img_arr = explode('public/',$image['meta_link']);
							if(isset($img_arr[1]))
								$im=$img_arr[1];
							else         
								$im=$img_arr[0];
							$show_image = $s3_bucket_url.$im;
						?>
						<li>
							<img src="{{$show_image}}" alt="" />
						</li>
						@endforeach
						@if(count($product_image)>1)
						<img src="{{url('public/assets/plugins/blog-carousal/img/left_short_arrow.svg')}}" class="left short_left">
						<img src="{{url('public/assets/plugins/blog-carousal/img/right_short_arrow.svg')}}" class="right short_right">
						@endif
					</ul>
				</div>         
            </div>
            
            <div class="collection_info custom_width">
                <div class="collection_info_title">
                    <hr>
                    <div class="dancing-bold dark_grey size_28">{{ $product_info->product_name }}</div>
                </div>
                <div class="collection_info_desc">
                    <div class="cid_left dancing-normal size_24">
                        {!! $product_info->description !!}
                    </div>
                    <div class="cid_right">                
                        <div class="cid_right_single">
                            <div class="cid_one size_15 noto-regular">Design style</div>
                            <div class="cid_two size_15 noto-regular">:</div>
                            <div class="cid_three size_15 noto-regular">{{ $product_info->design_style }}</div>
                        </div>
                        <div class="cid_right_single">
                            <div class="cid_one size_15 noto-regular">Design number</div>
                            <div class="cid_two size_15 noto-regular">:</div>
                            <div class="cid_three size_15 noto-regular">{{ $product_info->design_model_no }} </div>
                        </div>                
                        <div class="cid_right_single">
                            <div class="cid_one size_15 noto-regular">Occasion</div>
                            <div class="cid_two size_15 noto-regular">:</div>
                            <div class="cid_three size_15 noto-regular"><?php 
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
							   ?></div>
                        </div>
                        <div class="cid_right_single">
                            <div class="cid_one size_15 noto-regular">Diamond type</div>
                            <div class="cid_two size_15 noto-regular">:</div>
                            <div class="cid_three size_15 noto-regular"> {{ $product_info->diamond_type }}</div>
                        </div>
                        <div class="cid_right_link">
						 @if(Session::get('usersession'))
						 <div class="sidebar_title theme_charecter_big">
								<a class="button size_14 noto-regular dark_grey" data-toggle="modal" data-target="#popup1" href="javascript:;">Request a quote</a>
								<img class="side_arrow" src="{{ asset('public/assets/images/icon_arrow.svg') }}" alt="arrow">
							</div>
						   <div class="modal fade" id="popup1" style="z-index: 99999;">
							<div class="modal-dialog animated">
								<div class="modal-content">
								<div class="popup">
									<a class="close" href="#" data-dismiss="modal" aria-hidden="true">&times;</a>
									<div class="content">
										<div class="product_form">
											<div class="qoute_heading">
												Request a qoute
											</div>											
											<div class="form_inner">
												<form data-pop="#popup1" action="{{ url('product_enquiry') }}" class="database_operation_form">
													{{ csrf_field() }}
													<input type="hidden" name="user_id" value="{{ Session::get('usersession')->user_id }}" />
													<input type="hidden" name="product_id" value="{{ $product_info->id }}" />
													<input type="hidden" id="uniqe_test" value="1" />
													<textarea rows="5" required placeholder="Enter message here..." id="pop_msg" name="message"></textarea>
													<button class="custom_theme_btn">Submit</button>
												</form>
												<form action="https://webto.salesforce.com/servlet/servlet.WebToLead?encoding=UTF-8" method="POST" id="sale_force_form">
													<input type="hidden" name="oid" value="00D2w00000EvKtv">
													<input type="hidden" name="retURL" value="https://www.tarasri.in/">
													<input type="hidden" name="last_name" value="{{ getSinglerow('user','name',array('user_id'=>Session::get('usersession')->user_id)) }}" />   
													<input type="hidden" name="email" value="{{ getSinglerow('user','email',array('user_id'=>Session::get('usersession')->user_id)) }}" /> 
													<input type="hidden" name="mobile" value="{{ getSinglerow('user','mobile',array('user_id'=>Session::get('usersession')->user_id)) }}" />
													<input type="hidden" name="00N2w00000J72QT" value="{{ $product_info->product_name }}" /> 
													<input type="hidden" name="00N2w00000J6k2d" id="sale_comment" value="" />
													<input type="hidden" name="00N2w00000J6k0N" value="{{url()->current()}}" />
													<input type="hidden" name="company" value="None" />
													<input type="hidden" name="lead_source" value="Website" />
													<input type="hidden" name="00N2w00000HcBjR" value="Website Quotation Asked for" />
													<input type="hidden" name="00N2w00000HcBuK" value="Sales Inquiry" />
													<input type="hidden" name="url" value="https://www.tarasri.in/" />
													<input type="hidden" name="recordType" value="Website Lead" />
													
												</form>
											</div>
										</div>
									</div>
								</div>
							</div>
							</div>
							</div>
							@else 
                            <a data-toggle="modal" data-target="#loginModal" href="javascript:;" class="size_14 noto-regular dark_grey">Please login to request a quote</a>
                            <img src="{{url('public/assets/images/icon_arrow.svg')}}">
							@endif
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="collection_slider_two  relative">
                <div class="container-slider">
					<div class="cs_title center allura-normal dark_grey size_28">{{ getSinglerow('collection','collection_name',array('id'=>$product_info->collection_id)) }} Collection</div>
					<ul class="border_design">
					<?php $i=1; if(count($categoery_products)>3){ ?>
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
						<li>
							<div class="no-hover-fav">
								<?php
								$fev=0;
								if(Session::get('usersession'))
								{
									if(is_fevrate(Session::get('usersession')->user_id,$col_prod11['id']))
									{
										$fev=1;
									}
								}
								?>
								<button class="btn <?php if($fev) { ?> remove_to_fevrate <?php } else { ?>add_to_fevrate <?php } ?>" data-id="{{ $col_prod11['id'] }}" data-user="<?php if(Session::get('usersession')) { echo  Session::get('usersession')->user_id; } ?>">
								<?php if($fev) { ?><img class="fev_icon_{{ $col_prod11['id'] }}" src="{{ url('') }}/public/assets/images/fav_fill.svg"><?php } else { ?>
								<img class="fev_icon_{{ $col_prod11['id'] }}" src="{{ url('') }}/public/assets/images/fav.svg"><?php } ?>	
								</button> 
							</div>
							<img src="{{ url($show_image1) }}" alt="{{ $col_prod11['alt_text'] }}">
						</li>
						<?php if($i==7){ break; } $i++; ?>
						@endforeach
						<?php } ?>
						<img src="{{url('public/assets/plugins/blog-carousal/img/left_short_arrow.svg')}}" class="left short_left">
						<img src="{{url('public/assets/plugins/blog-carousal/img/right_short_arrow.svg')}}" class="right short_right">
					</ul>
				</div>
            </div>
            
            <div class="collection_slider_three  relative">
                <div class="container-slider">
					<div class="cs_title center allura-normal dark_grey size_28">More {{ $cat_name }} in Trend</div>
					<ul class="border_design">
						<?php $i=1; if(count($categoery_products)>3){ ?>
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
						<li>
							<div class="no-hover-fav">
								<?php
								$fev=0;
								if(Session::get('usersession'))
								{
									if(is_fevrate(Session::get('usersession')->user_id,$col_prod1['id']))
									{
										$fev=1;
									}
								}
								?>
								<button class="btn <?php if($fev) { ?> remove_to_fevrate <?php } else { ?>add_to_fevrate <?php } ?>" data-id="{{ $col_prod1['id'] }}" data-user="<?php if(Session::get('usersession')) { echo  Session::get('usersession')->user_id; } ?>">
								<?php if($fev) { ?><img class="fev_icon_{{ $col_prod1['id'] }}" src="{{ url('') }}/public/assets/images/fav_fill.svg"><?php } else { ?>
								<img class="fev_icon_{{ $col_prod1['id'] }}" src="{{ url('') }}/public/assets/images/fav.svg"><?php } ?>	
								</button> 
							</div>
							<img src="{{ url($show_image2) }}" alt="{{ $col_prod1['alt_text'] }}">
						</li>
						<?php
						if(count($categoery_products)<5){
							if($i==3){ break; }
						}
						if(count($categoery_products)>5 && (count($categoery_products)<7)){
							 if($i==5){ break; } 
						}
						if(count($categoery_products)>7){
							if($i==7){ break; }
						}
						$i++;
						?>
						@endforeach
						<?php } ?>
						<img src="{{url('public/assets/plugins/blog-carousal/img/left_short_arrow.svg')}}" class="left short_left">
						<img src="{{url('public/assets/plugins/blog-carousal/img/right_short_arrow.svg')}}" class="right short_right">
					</ul>
				</div>
            </div>
            
        </div>
        
    </div>
</div>    
</section>

@endsection