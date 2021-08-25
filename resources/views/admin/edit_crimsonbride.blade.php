@extends('layouts.admin.app')
@section('title','Edit Crimson Bride')
@section('content')
<section class="content">
      <div class="container-fluid">
        <!-- COLOR PALETTE -->
        <div class="card card-default color-palette-box">
		  <div class="card-body">
            <div class="col-12">
			<form action="{{ url('admin/edit_crimsonbride/'.$crimsonbride->id) }}" class="database_operation_form" data-image="{{ url('admin/upload_crimsonbride_image/'.$crimsonbride->reffrence) }}">
				<div class="row">
					<div class="col-sm-12">
						<div class="form-group">
							{{ csrf_field() }}
							<label>Enter Title</label>
							<input type="hidden" id="reffrence" name="reffrence" value="{{ $crimsonbride->reffrence }}" /> 
							<input type="text" name="title" value="{{ $crimsonbride->title }}" class="form-control" required="required" placeholder="Enter Title" >
						</div>
					</div>
					<div class="col-sm-12">
						<div class="form-group">
							<label>Enter Slug</label>
							<input type="text" name="slug" value="{{ $crimsonbride->slug }}" class="form-control" required="required" placeholder="Enter Slug" >
						</div>
					</div>
					<div class="col-sm-12">
						<div class="form-group">
							<label>Select Image</label>
							<div id="drop-blog" data-id="#drop-blog" class="drop-area-blog drop-control drop-area-custom " data-key="file" data-url="{{ url('admin/upload_crimsonbride_image/'.$crimsonbride->reffrence) }}">
								<input style="z-index: 20;" type="file"  name="file" data-from=".database_operation_form" data-parent="#drop-logo" class="upload_image_blog custom_img" >
								<input type="hidden" value="" id="image" name="image" /> 
								<div class="product_image_box" id="product_image_display_box">
								@foreach($crimsonbride_image as $cb_img)
									<img data-alt="{{ $cb_img->alt_text }}" data-id="{{ $cb_img->id }}" class="product_upload_image blog_image"  src="{{ url($cb_img->image) }}" alt="logo" >
								@endforeach
								</div>
							</div>
						</div>
						<p>Image Dimensions Min of 1920 W & 660 H</p>
					</div>
					<div class="col-sm-12">
						<div class="form-group">
							<button class="btn btn-info">Update</button>
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
	  <form data-pop="#blog_image_alt" action="{{ url('admin/crimsonbride_image_alt_text') }}" class="database_operation_form_new" > 
        <div class="row">
			<div class="col-sm-12">
				<div class="form-group">
					<label>Enter Alt text</label>
					{{ csrf_field() }}
					<input type="hidden" id="ref_id" name="id" /> 
					<input type="text" required="required" name="alt_text" id="alt_text" class="form-control" placeholder="Enter Alt text" />
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