@extends('layouts.app')
@section('title',getSinglerow('seo_meta','title',array('page_name'=>'collections-user')))
@section('seo_description',getSinglerow('seo_meta','description',array('page_name'=>'collections-user')))
@section('seo_keywords',getSinglerow('seo_meta','keywords',array('page_name'=>'collections-user')))
@section('content')
<style>
.box_content {
  display: none;

}
</style>
<?php
$s3_bucket_url = \Config::get('app.s3_bucket_url');
?>
<div class="container-fluid pt-3 mt-2 border-top ">
    <div class="custom-container">
        @if($banner)
		<div class="position-relative d-flex align-items-center jewellery-image-one mb-4">
	  <?php 
	    $img_arr = explode('public/',$banner);
		if(isset($img_arr[1]))
		$im=$img_arr[1];
		else 
		$im=$img_arr[0];
		$image=url('public/'.$im);
		// $image=$s3_bucket_url.$im;
	  ?>
            <img src="{{ $image }}" alt="{{ $banner_alt }}" class="img-fluid  d-lg-block ml-auto">
           <!-- <img src="<?php /*echo $this->basePath(); */?>/images/tab-banner-3.jpg"
                 class="img-fluid d-none d-md-block d-lg-none">-->
            <div class="row mx-0 jewellery-text w-100 h-100 align-items-center  d-none">
                <div class="col-12 col-md-6 col-lg-4 offset-lg-1 banner pl-md-5 pl-lg-0">
                    <!--Inside the heart-shaped flowers, a pearshaped diamond glitters like a symbol of
                    tender feelings.-->
                </div>
            </div>
        </div>
		@endif
        <div class="row">
            <div class="col-12 col-sm-12 col-md-3 col-lg-3 col-xl-2    ">
                <div class="d-none d-md-flex align-items-center justify-content-between flex-wrap mb-3">
                    <div class="filter-by-heading">
                        Filter by:
                    </div>
                    <a href="javascript:void(0);"
                       class="d-inline-block border-0 rounded bg-666 text-white text-capitalize pay-online-btn my-2 my-md-0"
                       id="btnClearall">
                        clear all
                    </a>
                </div>
                <div class="text-right d-md-none mb-4">
                    <button class="btn bg-dark rounded-0 text-white" data-toggle="collapse"
                            data-target="#filterCollapse">
                        Filters
                    </button>

                </div>
                <div class="collapse <?php if(!preg_match("/(android|avantgo|blackberry|bolt|boost|cricket|docomo 
							|fone|hiptop|mini|mobi|palm|phone|pie|tablet|up\.browser|up\.link|webos|wos)/i" 
							, $_SERVER["HTTP_USER_AGENT"])) { ?> show <?php  } ?> d-md-block" id="filterCollapse">
                    <div class="filter-type mb-3">
                        <div data-toggle="collapse" data-target="#collapseCollectionName"
                             class="pointer mb-2 position-relative filter-heading">
                            Collection Name
                        </div>
                        <div class="collapse <?php if($collection_id) {?>show<?php } ?>" id="collapseCollectionName">
                            <ul class="list-unstyled m-0">
                                @foreach ($collections as $collection)
                                    <li>
                                        <label class="options-checkbox position-relative pointer">
                                            <input class="left_filter" <?php if($collection_id==$collection['id']) { echo "checked"; } ?>   name="collection" value="{{ $collection['id'] }}"
                                                   type="checkbox">
                                            <span class="custom-checkbox"></span>
                                            <span>{{ $collection['collection_name'] }}</span>
                                        </label>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                    <div class="filter-type mb-3">
                        <div data-toggle="collapse" data-target="#collapseItemType"
                             class="pointer mb-2 position-relative filter-heading">
                            Item Type/Category
                        </div>
                        <div class="collapse" id="collapseItemType">
                            <ul class="list-unstyled m-0  category-sec">
                                @foreach ($categories as $category)
                                    <li>
                                        <label class="options-checkbox position-relative pointer">
                                            <input class="left_filter" value="{{ $category['id'] }}" name="category" type="checkbox">
                                            <span class="custom-checkbox"></span>
                                            <span>
											{{ $category['categorey_name'] }}
                                            </span>
                                        </label>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                    <div class="filter-type mb-3">
                        <div data-toggle="collapse" data-target="#collapseItemStyle"
                             class="pointer mb-2 position-relative filter-heading">
                            <!--Style--> Occassions
                        </div>
                        <div class="collapse" id="collapseItemStyle">
                            <ul class="list-unstyled m-0 occation-sec">
                              @foreach ($occassion as $occassion) 
                                    <li>
                                        <label class="options-checkbox position-relative pointer">
                                            <input name="occassion" class="left_filter" value="{{ $occassion['id'] }}"
                                                   type="checkbox">
                                            <span class="custom-checkbox"></span>
                                            <span>{{ $occassion['occassion_name'] }}</span>
                                        </label>
                                    </li>
                               @endforeach
                            </ul>
                        </div>
                    </div>
                    <div class="filter-type mb-3">
                        <div data-toggle="collapse" data-target="#collapseGender"
                             class="pointer mb-2 position-relative filter-heading">
                            Gender
                        </div>
                        <div class="collapse" id="collapseGender">
                            <ul class="list-unstyled m-0">
                                <li>
                                    <label  class="options-checkbox position-relative pointer">
                                        <input class="left_filter" type="radio" value="1" name="gender">
                                        <span class="custom-radio"></span>
                                        <span>Male</span>
                                    </label>
                                </li>
                                <li>
                                    <label class="options-checkbox position-relative pointer">
                                        <input class="left_filter" value="2"  type="radio" name="gender">
                                        <span class="custom-radio"></span>
                                        <span>Female</span>
                                    </label>
                                </li>
                                <li>
                                    <label class="options-checkbox position-relative pointer">
                                        <input class="left_filter" value="3" type="radio" name="gender">
                                        <span class="custom-radio"></span>
                                        <span>Unisex</span>
                                    </label>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="filter-type mb-3">
                        <div data-toggle="collapse" data-target="#collapseItemStone"
                             class="pointer mb-2 position-relative filter-heading">
                            Gemstones
                        </div>
                        <div class="collapse" id="collapseItemStone">
                            <ul class="list-unstyled m-0 stone-sec">
								@foreach($all_stones as $stone)
									<li>
										<label class="options-checkbox position-relative pointer">
											<input class="left_filter" value="{{ $stone['id'] }}" name="stone" type="checkbox">
											<span class="custom-checkbox"></span>
											<span>{{ $stone['name'] }}</span>
										</label>
									</li>
								@endforeach
                                                  
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-12 col-sm-12 col-md-9 col-lg-9 col-xl-10   side-collection-section" id="collection_list">
                <div class="row" id="add-load-more-product">
				@if($products)
				@foreach($products as $prod)
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
				@if($prod['meta_link'])
					<div class="product-block col-12 col-sm-12 col-md-6 col-lg-4 col-xl-3 mb-0 px-0  box_content">
						<div class="border products-list position-relative">
							<a target="_blank"  href="{{ url('collection-single/'.$reff_data) }}" class="stretched-link"></a>
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
					<div class="no-products-wrapper text-center col-sm-12">
						<div>
							<div>
								<img width="350" class="wow  bounceInLeft animated" data-wow-offset="10" data-wow-delay=".2s" data-wow-duration="0.3s" src="{{ url('public/assets/images/no_products.jpg') }}" style="visibility: visible; animation-duration: 0.3s; animation-delay: 0.2s; animation-name: bounceInLeft;">
							</div>
						</div>
					</div>
				</div>
				@endif 
            </div>
			<div class="row text-center">
					@if(!isset($_GET['search']))
					@if(count($products)>=8)
					   
						<div class="col-md-12 mt-4 text-center">
						  <button class="d-inline-block border-0 rounded bg-666 text-white text-capitalize pay-online-btn my-2 my-md-0" data-slug="{{request()->segment(count(request()->segments()))}}" data-limit="9" id="load-more-product-btn">Load More</button>
						</div>
					@endif
					@endif
				</div>
        </div>
    </div>
</div>
<input type="hidden" value="0" id = "cHJvZHVjdHNPZmZzZXQ" />
@endsection