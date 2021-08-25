@extends('layouts.admin.app')
@section('title','Edit Product')
@section('content')

<?php
$s3_bucket_url = \Config::get('app.s3_bucket_url');
?>
<section class="content">
      <div class="container-fluid manage_product_block_page">
        <!-- COLOR PALETTE -->
        <div class="card card-default color-palette-box">
          <div class="card-body">
            <form action="{{ url('admin/products/edit_product/'.$product->id) }}" data-image="{{ url('admin/products/upload_product_image') }}" class="database_operation_form">
            <div class="row">
                <div class="col-sm-3">
                    <div class="form-group">
                        {{ csrf_field() }}
                        <label>Enter product name</label>
                        <input type="text" value="{{ $product->product_name }}" name="product_name" class="form-control" placeholder="Enter product name" />
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="form-group">
                        <label>Select category</label>
                        <select class="multi-select-dropdown" name="category[]" multiple="multiple"> 
                            <option value="">Select</option>
                            @foreach($category as $cat)
                            <option <?php if(in_array($cat['id'],explode(',',$product->categorey_id))) { echo "selected"; } ?> value="{{ $cat['id'] }}">{{ $cat['categorey_name'] }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                        <label>Enter design style</label>
                        <select name="design_style[]" class="multi-select-dropdown" multiple="multiple">
                            <option value="">Select</option>
                            @foreach($designStyle as $ds)
                            <option <?php if(in_array($ds['name'],explode(',',$product->design_style))) { echo "selected"; } ?>>{{ $ds['name'] }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="form-group">
                        <label>Select metal</label>
                        <select class="multi-select-dropdown" name="metal"> 
                            <option value="">Select</option>
                            @foreach($metal as $m1)
                            <option <?php if($product->metal_type==$m1['id']) { echo "selected"; } ?> value="{{ $m1['id'] }}">{{ $m1['name'] }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="form-group">
                        <label>Select purity</label>
                        <select class="multi-select-dropdown" name="purity"> 
                            <option value="">Select</option>
                            @foreach($purity as $p1)
                            <option <?php if($product->purity==$p1['id']) { echo "selected"; } ?> value="{{ $p1['id'] }}">{{ $p1['name'] }}</option>
                            @endforeach
                            </select>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                        <label>Enter design number</label>
                        <input type="text" name="design_number" value="{{ $product->design_model_no }}" class="form-control">
                    </div>
                </div>
                
                <div class="col-sm-3">
                    <div class="form-group">
                        <label>Select occasion</label>
                        <select class="multi-select-dropdown" name="occassion[]"  multiple="multiple" > 
                            <option value="">Select</option>
                            @foreach($occassion as $oc)
                            <option <?php if(in_array($oc['id'],explode(',',$product->occasion_type))) { echo "selected"; } ?> value="{{ $oc['id'] }}">{{ $oc['occassion_name'] }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="form-group">
                        <label>Select Gemstone</label>
                        <select class="multi-select-dropdown" multiple="multiple" name="gemstone[]" > 
                           @foreach($gemstone as $g1)
                            <option <?php if(in_array($g1['id'],explode(',',$product->stone_type))) { echo "selected"; } ?> value="{{ $g1['id'] }}">{{ $g1['name'] }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                        <label>Select diamond type</label>
                        <select name="diamond_type[]" class="multi-select-dropdown" multiple="multiple">
                            <option value="">Select</option>
                            @foreach($diamondtype as $dt1)
                            <option <?php if(in_array($dt1['name'],explode(',',$product->diamond_type))) { echo "selected"; } ?>>{{ $dt1['name'] }}</option>
                            @endforeach   
                        </select>
                    </div>
                </div>

                <div class="col-sm-3">
                    <div class="form-group">
                        <label>Enter enquiry value</label>
                        <input type="text" class="form-control" value="{{ $product->enquiy_value }}" name="enquiry_value"  >
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="form-group">
                        <label>Select collection type</label>
                        <select class="multi-select-dropdown" name="collection" > 
                            <option value="">Select</option>
                            @foreach($collection as $col)
                            <option <?php if($product->collection_id==$col['id']) { echo "selected"; } ?> value="{{ $col['id'] }}">{{ $col['collection_name'] }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-sm-6">
                <div class="form-group">
                        <label>Enter diamond carat</label>
                        <input type="text" name="diamond_carat" value="{{ $product->diamond_carat }}" placeholder="Enter diamond carat"  class="form-control">
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="form-group">
                        <label>Select Gender</label>
                        <select class="multi-select-dropdown" name="gender" > 
                            <option value="">Select</option>
                            <option <?php if($product->gender==1) { echo "selected"; } ?> value="1">Male</option>
                            <option <?php if($product->gender==2) { echo "selected"; } ?> value="2">Female</option>
                            <option <?php if($product->gender==3) { echo "selected"; } ?> value="3">Unisex</option>
                        </select>
                    </div>
                </div>                
                <div class="col-sm-4">
                    <div class="form-group">
                        <label>Enter Slug</label>
                        <input type="text" name="slug" value="{{ $product->slug }}" placeholder="Enter Slug"  class="form-control">
                    </div>
                </div>
                <div class="col-sm-5">
                    <div class="form-group">
                        <label>Enter SEO Title</label>
                        <input type="text" name="seo_title" value="{{ $product->seo_title }}" placeholder="Enter SEO Title"  class="form-control">
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                        <label>Enter SEO Keywords</label>
                        <textarea name="seo_keywords" class="form-control">{{ $product->seo_keywords }}</textarea>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                        <label>Enter SEO Description</label>
                        <textarea name="seo_description" class="form-control">{{ $product->seo_description }}</textarea>
                    </div>
                </div>
                <div class="col-sm-12">
                    <div class="form-group">
                        <label>Enter Image Alt Text</label>
                        <input type="text" name="alt_text" value="{{ $product->alt_text }}" placeholder="Enter Image Alt Text"  class="form-control">
                    </div>
                </div>
				<div class="col-sm-12">
                    <div class="form-group">
                        <label>Enter Youtube Video Link</label>
                        <input type="text" name="youtube_link" value="{{ $product->youtube_link }}" placeholder="Enter Youtube Video Link"  class="form-control">
                    </div>
                </div>
                <div class="col-sm-8">
                    <div class="form-group">
                        <label>Upload image</label>
                        <div id="drop-image" data-id="#drop-image" class="drop-control drop-area drop-area-custom product_image_box edit_prod" data-key="image" data-url="{{ url('admin/products/upload_product_image') }}">
                            
                            <input type="file"  name="image[]" data-from=".database_operation_form" data-parent="#drop-image" class="upload_image custom_img" >
							<div id="product_image_display_box">
                            <?php 
							$img_str='';
							$up_img_count=0;
							$key='';
							foreach($product_meta as $key => $prod)
							{
								if($prod['meta_link'])
								{
									if($key==0)
										$img_str=$prod['meta_link'];
									else 
										$img_str.=','.$prod['meta_link'];
									$img_arr = explode('public/',$prod['meta_link']);
									if(isset($img_arr[1]))
										$im=$img_arr[1];
									else 
										$im=$img_arr[0];
									if($prod['meta_link'])
										// $image=url('public/'.$im);
										$image=$s3_bucket_url.$im;
									else 
										$image=url('public/setting/upload-img.png');	
							?>
							<div class="img_block_small">
							 <a class="delete_image" href="javascript:;" data-id="{{ $prod['id'] }}">X</a>
								<img class="product_upload_image"  src="{{ $image }}" alt="logo" >
							</div>
							<?php 
								}
								$up_img_count++;
							}
							?>
							</div>
                            <input type="hidden" value="{{ $key }}"  name="up_img_count" />
							<input type="hidden" value="{{ $img_str }}" id="image" name="image_name" />
                            <br>
                        </div>
                        <p>**Square Image Dimensions Min of 450 W & 450 H</p>
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="form-group">
                        <label>Upload video</label>
                        <div id="drop-video" data-id="#drop-video" class="drop-control drop-video drop-area-custom" data-key="video" data-url="{{ url('admin/products/upload_product_video') }}">
                            <input type="file"  name="video" data-from=".database_operation_form" data-parent="#drop-video" class="upload_video custom_img" >
                            <input type="hidden" value="{{ $product_meta2[0]['meta_link'] }}" id="video" name="video_name" />    
                            <div id="disp_video">
                                <div id="video_block" class="upload_placeholder">
                                <?php 
                                $img_arr = explode('public/',$product_meta2[0]['meta_link']);
                                if(isset($img_arr[1]))
                                $im=$img_arr[1];
                                else 
                                $im=$img_arr[0];
                                if($product_meta2[0]['meta_link'])
                                    $image = '<video width="150" height="100" controls><source src="'.url('public/'.$im).'" type="video/mp4">Your browser does not support the video tag.</video>';
                                else 
                                    $image='<img  src="'.url('public/setting/upload-video.png').'" alt="logo" >';
                        
                                echo $image;
                                ?>
                                    
                                    <p>Upload Video</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-12">
                    <div class="form-group">
                        <label>Enter product description</label>
                        <textarea name="product_description" class="blog_description" id="blog_description">{{ $product->description }}</textarea>
                    </div>
                </div>
                <div class="col-sm-12">
                    <div class="form-group">
                       <button class="btn rounded-0 bg-success text-white form_btn">Update</button>
                    </div>
                </div>
            </div>
            </form>
          </div>
        </div>
</section>
@endsection