@extends('layouts.admin.app')
@section('title','Add New Blog')
@section('content')
<?php 
$reffrence=date('hs').rand(100,1000);
?>
<section class="content">
      <div class="container-fluid">
        <!-- COLOR PALETTE -->
        <div class="card card-default color-palette-box">
          <div class="card-body">
            <div class="col-12">
            <div class="alert alert-info">
                <strong>Info!</strong> Do not use special characters for slug</div>
            <br>
            <form action="{{ url('admin/add_new_blog') }}" class="database_operation_form" data-image="{{ url('admin/upload_blog_image/'.$reffrence) }}">    
            <div class="row">
                <div class="col-sm-12">
                    <div class="form-group">
                        {{ csrf_field() }}
                        <label>Enter Title</label>
						<input type="hidden" id="reffrence" name="reffrence" value="{{ $reffrence }}" /> 
                        <input type="text" name="title" class="form-control" required="required" placeholder="Enter Title" >
                    </div>
                </div>
                <div class="col-sm-12">
                    <div class="form-group">
                        <label>Enter Slug</label>
                        <input type="text" name="slug" class="form-control" required="required" placeholder="Enter Slug" >
                    </div>
                </div>
				<div class="col-sm-12">
                    <div class="form-group">
                        <label>Enter Tags</label>
                        <input type="text" name="tags" class="form-control" required="required" placeholder="Enter Tags" >
                    </div>
                </div>
                <div class="col-sm-12">
                    <div class="form-group">
                        <label>Select Blog Category</label>
                        <select name="blogcategory[]" class="form-control multi-select-dropdown" multiple="multiple" >
                            <option value="">Select</option>
                            @foreach($parent_category as $bcat)
                            <option value="{{ $bcat['id'] }}">{{ $bcat['name'] }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                        <label>Select Category</label>
                        <select name="category[]" class="form-control multi-select-dropdown" multiple="multiple" >
                            <option value="">Select</option>
                            @foreach($category as $cat)
                            <option value="{{ $cat['id'] }}">{{ $cat['categorey_name'] }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
				<div class="col-sm-6">
                    <div class="form-group">
                        <label>Select Stone</label>
                        <select name="stone[]" class="form-control multi-select-dropdown" multiple="multiple">
                            <option value="">Select</option>
                            @foreach($stone as $st)
                            <option value="{{ $st['id'] }}">{{ $st['name'] }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                        <label>Select Occasion</label>
                        <select name="occasion[]" class="form-control multi-select-dropdown" multiple="multiple">
                            <option value="">Select</option>
                            @foreach($occassion as $oc)
                            <option value="{{ $oc['id'] }}">{{ $oc['occassion_name'] }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                        <label>Select Collection</label>
                        <select name="collection[]" class="form-control multi-select-dropdown" multiple="multiple">
                            <option value="">Select</option>
                            @foreach($collection as $col)
                            <option value="{{ $col['id'] }}">{{ $col['collection_name'] }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-sm-12">
                    <div class="form-group">
                        <label>Enter Description</label>
                        <textarea class="form-control blog_description" name="description"  id="blog_description"></textarea>
                    </div>
                </div>
                <div class="col-sm-12">
                    <div class="form-group">
                        <label>Select Image</label>
                        <div id="drop-blog" data-id="#drop-blog" class="drop-area-blog drop-control drop-area-custom " data-key="file" data-url="{{ url('admin/upload_blog_image/'.$reffrence) }}">
                            <input style="z-index: 20;" type="file"  name="file" data-from=".database_operation_form" data-parent="#drop-logo" class="upload_image_blog custom_img" >
                            <input type="hidden" value="" id="image" name="image" /> 
							<div class="product_image_box"></div>
                            <div class="upload_placeholder">
                            <img  id="disp_image"  src="{{ url('public/setting/upload-img.png') }}" alt="logo" >
                            </div>
                        </div>
                    </div>
                    <p>Image Dimensions Min of 1920 W & 660 H </p>
                    <p>Click on image for view and update alt text</p>
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                        <label>Enter Meta Description</label>
                        <textarea name="meta_description" style="height:150px" required="required" class="form-control"></textarea>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                        <label>Enter Meta Keyword</label>
						<textarea name="meta_keyword" style="height:150px" required="required" class="form-control"></textarea>
                    </div>
                </div>
                <div class="col-sm-12">
                    <div class="form-group">
                        <button class="btn rounded-0 bg-success text-white form_btn">Save</button>
                    </div>
                </div>
            </div>
            </form>
            </div>
          </div>
        </div>
</section>
<div class="modal" id="blog_image_alt">
  <div class="modal-dialog">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">Image Alt text</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <!-- Modal body -->
      <div class="modal-body">
	  <form data-pop="#blog_image_alt" action="{{ url('admin/blog_image_alt_text') }}" class="database_operation_form_new" > 
        <div class="row">
			<div class="col-sm-12">
				<div class="form-group">
					<label>Enter Alt text</label>
					{{ csrf_field() }}
					<input type="hidden" id="ref_id" name="id" /> 
					<input type="text" required="required" name="alt_text" class="form-control" placeholder="Enter Alt text" />
				</div>
			</div>
			<div class="col-sm-12">
				<div class="form-group">
					<button class="btn btn-info form_btn">Update</button>
				</div>
			</div>
		</div>
	  </form>
      </div>
    </div>
  </div>
</div>
@endsection