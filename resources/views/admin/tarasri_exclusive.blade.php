@extends('layouts.admin.app')
@section('title','Tarasri Exclusive')
@section('content')
<section class="content">
      <div class="container-fluid">
        <!-- COLOR PALETTE -->
        <div class="card card-default color-palette-box">
          <div class="card-body">
          <form action="{{ url('admin/tarasri_exclusive') }}" class="database_operation_form" data-image="{{ url('admin/upload_tarasri_exclusive_image') }}">
            <div class="row">
                <div class="col-sm-12">
                    <div class="form-group">
                        <label>Title</label>
                        {{ csrf_field() }}
                        <input type="text" value="{{ $tarasri_ex->title }}" name="title" placeholder="Title" class="form-control">
                    </div>
                </div>
				<div class="col-sm-12">
                    <div class="form-group">
                        <label>Status</label>
                        <select class="form-control" name="status">
							<option <?php if(get_setting('tarasri_exclusive_status')==1) { echo "selected"; } ?> value="1">Active</option>
							<option <?php if(get_setting('tarasri_exclusive_status')==0) { echo "selected"; } ?> value="0">Inactive</option>
						</select>
                    </div>
                </div>
                <div class="col-sm-12">
                    <div class="form-group">
                        <label>Banner</label>
                        <div id="drop-fevicon" data-id="#drop-fevicon" class="drop-control drop-area drop-area-custom" data-key="banner" data-url="{{ url('admin/upload_tarasri_exclusive_image') }}">
                            <h4 class="text-center" id="drag_image_text" style="<?php if($tarasri_ex->banner_url) { ?>display:none;<?php } ?>">Drag Your Image Here</h4>
                            <input type="hidden" value="{{ $tarasri_ex->banner_url }}" id="image" name="image" />    
                            <input style="z-index:20" type="file"  name="banner" data-from=".database_operation_form" data-parent="#drop-logo" class="upload_image custom_img" >
                            <div class="upload_placeholder">
                                <img  id="disp_image" class="disp_img_after" src="{{ url($tarasri_ex->banner_url) }}" alt="logo" >
                            </div>
                        </div>
                        <p>** Image Dimensions Min of 1920 W & 660 H</p>
                    </div>
                </div>
                <div class="col-sm-12">
                    <div class="form-group">
                        <label>Enter Banner Alt Text</label>
                        <input type="text" name="alt_text" value="{{ $tarasri_ex->alt_text }}" placeholder="Banner Alt Text" class="form-control">
                    </div>
                </div>
                <div class="col-sm-12">
                    <div class="form-group">
                        <label>Description</label>
                        <textarea name="description" class="form-control blog_description" id="blog_description" cols="30" rows="10">
                        {{ $tarasri_ex->description }}
                        </textarea>
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
</section>
@endsection