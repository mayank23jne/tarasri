@extends('layouts.app')
@section('title','my Favourites')
@section('content')
<?php
$s3_bucket_url = \Config::get('app.s3_bucket_url');
?>
<div class="container-fluid py-5">
    <div class="container custom-container">
        <div class="filter-by-heading mb-3">
            My Selections:
           <a href="javascript:;" data-toggle="modal" data-target="#myModal11" class="btn btn-info btn-sm float-right">Request a quote for my favourites</a>
        </div>
        
        <!-- The Modal -->
        <div class="modal" id="myModal11">
          <div class="modal-dialog">
            <div class="modal-content">
              <!-- Modal body -->
              <div class="modal-body">
                <div class="popup">
                		<a data-dismiss="modal" style="margin-right: 13px !important;margin-top: -29px;opacity: 0.9;text-decoration: none;position: absolute;right: 0;color: #767676;" class="close" href="#">&times;</a>
                		<div class="content">
                			<div class="product_form">
                			    <div class="qoute_heading1">
                			        Request a qoute
                			    </div>
                			    <div class="form_inner" style="box-shadow:none !important">
										{{ csrf_field() }}
										<input id="fev_user_id" type="hidden" name="user_id" value="{{ Session::get('usersession')->user_id }}" />
									
										<textarea id="message" rows="5" required placeholder="Enter message here..." name="message"></textarea>
										<button class="product_form_submit">Submit</button>
                			    </div>
                			</div>
                		</div>
                	</div>
              </div>
            </div>
          </div>
        </div>

		@if($favourites)
		<div class="row">                
			@foreach($favourites as $fev)
			<div class="col-12 col-sm-12 col-md-6 col-lg-4 col-xl-2 mb-3 px-md-2 fav-block fev_{{ $fev['product_id'] }}">
				<div class="products-single position-relative">
					<div class="img-hover">
						<div class="fav">
							<button data-id="{{ $fev['product_id'] }}" data-user="<?php if(Session::get('usersession')) { echo  Session::get('usersession')->user_id; } ?>"  class="bg-transparent border-0 remove_fevrate_on_page remove_to_fevrate">
								<img src="{{ url('') }}/public/assets/images/fav_fill.svg">
							</button>
						</div>
						<div class="position-relative text-center">
							<a href="{{ url('collection-single/'.getSinglerow('products','slug',array('id'=>$fev['product_id']))) }}">
								<!--<img src="" alt="" class="img-fluid"/>-->
								<div style="height:250px;" class="overflow-hidden">
								    <?php 
                    				if($fev['meta_thumb'])
                    				{
                    					$img_arr = explode('public/',$fev['meta_thumb']);
                    				}
                    				else 
                    				{
                    					$img_arr = explode('public/',$fev['meta_link']);
                    				}
                    				
                    					if(isset($img_arr[1]))
                    						$im=$img_arr[1];
                    					else 
                    						$im=$img_arr[0];
                    				// $show_image = '/public/'.$im;
                    				$show_image = $s3_bucket_url.$im;
								    ?>
									<div class="jewellery-image bg-img" style="background:url('<?php echo $show_image; ?>') no-repeat center / cover">
									  
									</div>
								</div>
							</a>

							<span class="product-name font-16">{{ getSinglerow('products','product_name',array('id'=>$fev['product_id'])) }}-{{ getSinglerow('products','design_model_no',array('id'=>$fev['product_id'])) }}</span>
						</div>
					</div>
				</div>
			</div>
			@endforeach
        </div>
        @else 
        <div class="no-favourite-wrapper no-fav-available">
            No favourites Added!
        </div>
		@endif
    </div>
</div>
@endsection