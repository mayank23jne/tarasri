@extends('layouts.admin.app')
@section('title','Edit Blog')
@section('content')
<section class="content">
      <div class="container-fluid">
        <!-- COLOR PALETTE -->
        <div class="card card-default color-palette-box">
          <div class="card-body">
            <div class="col-12">
            <div class="alert alert-info">
                <strong>Info!</strong> Do not use special characters for slug</div>
            <br>
            <form action="{{ url('admin/edit_blog/'.$blog->id) }}" class="database_operation_form" data-image="{{ url('admin/upload_blog_image/'.$blog->reffrence) }}">    
            <div class="row">
                <div class="col-sm-12">
                    <div class="form-group">
                        {{ csrf_field() }}
                        <label>Enter Title</label>
                        <input type="hidden" value="{{ $blog->id }}" name="id" />
                        <input type="text" name="title" value="{{ $blog->title }}" class="form-control" required="required" placeholder="Enter Title" >
                    </div>
                </div>
                <div class="col-sm-12">
                    <div class="form-group">
                        <label>Enter Slug</label>
                        <input type="text" name="slug" value="{{ $blog->slug }}" class="form-control" required="required" placeholder="Enter Slug" >
                    </div>
                </div>
				<div class="col-sm-12">
                    <div class="form-group">
                        <label>Enter Tags</label>
                        <input type="text" name="tags" value="{{ $blog->tags }}"  class="form-control" required="required" placeholder="Enter Tags" >
                    </div>
                </div>
                <div class="col-sm-12">
                    <div class="form-group">
                        <label>Select Blog Category</label>
                        <select name="blogcategory[]" class="form-control multi-select-dropdown" multiple="multiple" >
                            <option value="">Select</option>
                            @foreach($parent_category as $bcat_new)
                            <option <?php if(in_array($bcat_new['id'],explode(',',$blog->parent_category))) { echo "selected"; } ?>  value="{{ $bcat_new['id'] }}">{{ $bcat_new['name']}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                        <label>Select Category</label>
                        <select name="category[]" class="form-control multi-select-dropdown" multiple="multiple">
                            <option value="">Select</option>
                            @foreach($category as $cat)
                            <option <?php if(in_array($cat['id'],explode(',',$blog->category))) { echo "selected"; } ?>  value="{{ $cat['id'] }}">{{ $cat['categorey_name'] }}</option>
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
                            <option <?php if(in_array($st['id'],explode(',',$blog->stone))) { echo "selected"; } ?> value="{{ $st['id'] }}">{{ $st['name'] }}</option>
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
                            <option <?php if(in_array($oc['id'],explode(',',$blog->occasion))) { echo "selected"; } ?> value="{{ $oc['id'] }}">{{ $oc['occassion_name'] }}</option>
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
                            <option <?php if(in_array($col['id'],explode(',',$blog->collection))) { echo "selected"; } ?>  value="{{ $col['id'] }}">{{ $col['collection_name'] }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-sm-12">
                    <div class="form-group">
                        <label>Enter Description</label>
                        <textarea class="form-control blog_description" id="blog_description"   name="description" required="required" class="form-control">{{ $blog->description }}</textarea>
                    </div>
                </div>
                <div class="col-sm-12">
                    <div class="form-group">
                        <label>Select Image</label>
                        <div id="drop-blog" data-id="#drop-blog" class="drop-control drop-area-blog  drop-area-custom" data-key="file" data-url="{{ url('admin/upload_blog_image/'.$blog->reffrence) }}">
                            <input type="hidden"  id="image" name="image" value="{{ $blog->image }}" />    
                            <input style="z-index: 20;" type="file"  name="file" data-from=".database_operation_form" data-parent="#drop-logo" class="upload_image_blog custom_img" >
							@if($blog_image)
							<div id="product_image_display_box">
							@foreach($blog_image as $blog1)
							<img data-id="{{ $blog1['id'] }}"  data-alt="{{ $blog1['alt_text'] }}" class="product_upload_image blog_image"  src="{{ url($blog1['image']) }}" alt="logo" >
							@endforeach
							</div>	
							@endif 
                            
                        </div>
                    </div>
                    <p>Image Dimensions Min of 1920 W & 660 H</p>
                    <p>Click on image for view and update alt text</p>
                </div>
				<div class="col-sm-6">
                    <div class="form-group">
                        <label>Enter Meta Description</label>
                        <textarea name="meta_description" style="height:150px" required="required" class="form-control">{{ $blog->meta_description }}</textarea>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                        <label>Enter Meta Keyword</label>
						<textarea name="meta_keyword" style="height:150px" required="required" class="form-control">{{ $blog->meta_keyword }}</textarea>
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
					<input type="text" id="alt_text" required="required" name="alt_text" class="form-control" placeholder="Enter Alt text" />
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