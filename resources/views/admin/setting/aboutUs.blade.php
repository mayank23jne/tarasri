@extends('layouts.admin.app')
@section('title','About US')
@section('content')
<section class="content">
      <div class="container-fluid">
        <!-- COLOR PALETTE -->
        <div class="card card-default color-palette-box">
          <div class="card-body">
          <form action="{{ url('admin/setting/aboutUs') }}" class="database_operation_form" data-image="{{ url('admin/setting/save_about_us_image') }}">
            <div class="row">
                <div class="col-sm-12">
                    <div class="form-group" style="display:none">
                        <label>Title</label>
                        {{ csrf_field() }}
                        <input type="text" value="{{ $about_info->title }}" name="title" placeholder="Title" class="form-control">
                    </div>
                </div>
				<div class="col-sm-12">
                    <div class="form-group">
                        <label>Status</label>
                        <select class="form-control" name="status">
							<option <?php if(get_setting('about_page_status')==1) { echo "selected"; } ?> value="1">Active</option>
							<option <?php if(get_setting('about_page_status')==0) { echo "selected"; } ?> value="0">Inactive</option>
						</select>
                    </div>
                </div>
				<div class="col-sm-12">
                    <div class="form-group">
                        <label>Show On</label>
                        <select class="form-control" name="about_page_location">
							<option <?php if(get_setting('about_page_location')==1) { echo "selected"; } ?> value="1">Main Menu</option>
							<option <?php if(get_setting('about_page_location')==2) { echo "selected"; } ?> value="2">Collection Menu</option>
							<option <?php if(get_setting('about_page_location')==3) { echo "selected"; } ?> value="3">Footer Menu</option>
						</select>
                    </div>
                </div>
                <div class="col-sm-12">
                    <div class="form-group">
                        <label>Banner</label>
                        <div id="drop-image" data-id="#drop-image" class="drop-control drop-area drop-area-custom" data-key="image" data-url="{{ url('admin/setting/save_about_us_image') }}"> 
                            <input type="file"  name="image" data-from=".database_operation_form" data-parent="#drop-image" class="upload_image custom_img" >
                            <input type="hidden" value="{{ $about_info->banner_url  }}" id="image" name="image_name" />    
                            <div class="upload_placeholder">
                                <?php if($about_info->banner_url) {   $image=url($about_info->banner_url); } else { $image=url('public/setting/upload-img.png'); } ?>
                                <img id="disp_image"  <?php if($about_info->banner_url) {  ?> class="disp_img_after" <?php } ?>  src="{{ $image }}" alt="logo" ><br>
                            </div>
                            <br>
                        </div>
						<p>** Image Dimensions Min of 1920 W & 660 H</p>
                    </div>
                </div>
                <div class="col-sm-12">
                    <div class="form-group">
                        <label>Enter Banner Alt Text</label>
                        <input type="text" name="alt_text" placeholder="Banner Alt Text" class="form-control">
                    </div>
                </div>
                <div class="col-sm-12">
                    <div class="form-group">
                        <label>Description</label>
                        <textarea name="description" id="blog_description" class="blog_description form-control" cols="30" rows="10">
                        {{ $about_info->description }}
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