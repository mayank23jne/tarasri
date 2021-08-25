@extends('layouts.admin.app')
@section('title','Add New Product')
@section('content')
<section class="content">
      <div class="container-fluid  manage_product_block_page">
        <!-- COLOR PALETTE -->
        <div class="card card-default color-palette-box">
          <div class="card-body">
            <form action="{{ url('admin/products/add_new_product') }}" data-image="{{ url('admin/products/upload_product_image') }}" class="database_operation_form">
            <div class="row">
                <div class="col-sm-3">
                    <div class="form-group">
                        {{ csrf_field() }}
                        <label>Enter product name</label>
                        <input type="text" name="product_name" class="form-control" placeholder="Enter product name" />
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="form-group">
                        <label>Select category</label>
                        <select class="multi-select-dropdown" name="category[]" multiple="multiple"> 
                            <option value="">Select</option>
                            @foreach($category as $cat)
                            <option value="{{ $cat['id'] }}">{{ $cat['categorey_name'] }}</option>
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
                           <option>{{ $ds['name'] }}</option>
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
                            <option value="{{ $m1['id'] }}">{{ $m1['name'] }}</option>
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
                            <option value="{{ $p1['id'] }}">{{ $p1['name'] }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                        <label>Enter design number</label>
                        <input type="text" name="design_number"  class="form-control">
                    </div>
                </div>
                
                <div class="col-sm-3">
                    <div class="form-group">
                        <label>Select occasion</label>
                        <select class="multi-select-dropdown" name="occassion[]"  multiple="multiple" > 
                            <option value="">Select</option>
                            @foreach($occassion as $oc)
                            <option value="{{ $oc['id'] }}">{{ $oc['occassion_name'] }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="form-group">
                        <label>Select Gemstone</label>
                        <select class="multi-select-dropdown" multiple="multiple" name="gemstone[]" > 
                            <option value="">Select</option>
                            @foreach($gemstone as $g1)
                            <option value="{{ $g1['id'] }}">{{ $g1['name'] }}</option>
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
                            <option>{{ $dt1['name'] }}</option>
                            @endforeach   
                        </select>
                    </div>
                </div>

                <div class="col-sm-3">
                    <div class="form-group">
                        <label>Enter enquiry value</label>
                        <input type="text" class="form-control" name="enquiry_value"  >
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="form-group">
                        <label>Select collection type</label>
                        <select class="multi-select-dropdown" name="collection" > 
                            <option value="">Select</option>
                            @foreach($collection as $col)
                            <option value="{{ $col['id'] }}">{{ $col['collection_name'] }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-sm-6">
                <div class="form-group">
                        <label>Enter diamond carat</label>
                        <input type="text" name="diamond_carat" placeholder="Enter diamond carat"  class="form-control">
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="form-group">
                        <label>Select Gender</label>
                        <select class="multi-select-dropdown" name="gender" > 
                            <option value="">Select</option>
                            <option value="1">Male</option>
                            <option value="2">Female</option>
                            <option value="3">Unisex</option>
                        </select>
                    </div>
                </div>                
                <div class="col-sm-4">
                    <div class="form-group">
                        <label>Enter Slug</label>
                        <input type="text" name="slug" placeholder="Enter Slug"  class="form-control">
                    </div>
                </div>
                <div class="col-sm-5">
                    <div class="form-group">
                        <label>Enter SEO Title</label>
                        <input type="text" name="seo_title" placeholder="Enter SEO Title"  class="form-control">
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                        <label>Enter SEO Keywords</label>
                        <textarea name="seo_keywords" class="form-control"></textarea>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                        <label>Enter SEO Description</label>
                        <textarea name="seo_description" class="form-control"></textarea>
                    </div>
                </div>
                <div class="col-sm-12">
                    <div class="form-group">
                        <label>Enter Image Alt Text</label>
                        <input type="text" name="alt_text" placeholder="Enter Image Alt Text"  class="form-control">
                    </div>
                </div>
				<div class="col-sm-12">
                    <div class="form-group">
                        <label>Enter Youtube Video Link</label>
                        <input type="text" name="youtube_link" placeholder="Enter Youtube Video Link"  class="form-control">
                    </div>
                </div>
                <div class="col-sm-8">
                    <div class="form-group">
                        <label>Upload image</label>
                        <div id="drop-image" data-id="#drop-image" class="drop-control drop-area drop-area-custom product_image_box" data-key="image" data-url="{{ url('admin/products/upload_product_image') }}">
                            
                            <input type="file"  name="image[]" data-from=".database_operation_form" data-parent="#drop-image" class="upload_image custom_img" >
                            
                            <input type="hidden" value="" id="image" name="image_name" />    
                            <div class="upload_placeholder">
                                <img id="disp_image"   src="{{ url('public/setting/upload-img.png') }}" alt="logo" ><br>
                                <p>Upload Image</p>
                            </div>
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
                            <input type="hidden" value="" id="video" name="video_name" />    
                            <div id="disp_video">
                                <div id="video_block" class="upload_placeholder">
                                <span class="video_delete_btn delete_btn_video">x</span>
                                    <img  src="{{ url('public/setting/upload-video.png') }}" alt="logo" >
                                    <p>Upload Video</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-12">
                    <div class="form-group">
                        <label>Enter product description</label>
                        <textarea name="product_description" class="blog_description" id="blog_description"></textarea>
                    </div>
                </div>
                <div class="col-sm-12">
                    <div class="form-group">
                       <button class="btn rounded-0 bg-success text-white form_btn">Add</button>
                    </div>
                </div>
            </div>
            </form>
          </div>
        </div>
</section>

@endsection