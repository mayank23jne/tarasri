@extends('layouts.admin.app')
@section('title','Term And Condition')
@section('content')
<section class="content">
      <div class="container-fluid">
        <!-- COLOR PALETTE -->
        <div class="card card-default color-palette-box">
          <div class="card-body">
          <form action="{{ url('admin/setting/save_setting') }}" class="database_operation_form" data-image="{{ url('admin/setting/save_about_us_image') }}">
            <div class="row">
                <div class="col-sm-12">
                    <div class="form-group">
                        <label>Title</label>
                        {{ csrf_field() }}
                        <input type="text" value="{{ get_setting('term_and_condition_title') }}" name="term_and_condition_title" placeholder="Title" class="form-control">
                    </div>
                </div>
				<div class="col-sm-12">
                    <div class="form-group">
                        <label>Status</label>
                        <select class="form-control" name="terms_conditions_status">
							<option <?php if(get_setting('terms_conditions_status')==1) { echo "selected"; } ?> value="1">Active</option>
							<option <?php if(get_setting('terms_conditions_status')==0) { echo "selected"; } ?> value="0">Inactive</option>
						</select>
                    </div>
                </div>
				<div class="col-sm-12">
                    <div class="form-group">
                        <label>Show On</label>
                        <select class="form-control" name="terms_conditions_location">
							<option <?php if(get_setting('terms_conditions_location')==1) { echo "selected"; } ?> value="1">Main Menu</option>
							<option <?php if(get_setting('terms_conditions_location')==2) { echo "selected"; } ?> value="2">Collection Menu</option>
							<option <?php if(get_setting('terms_conditions_location')==3) { echo "selected"; } ?> value="3">Footer Menu</option>
						</select>
                    </div>
                </div>
                <div class="col-sm-12">
                    <div class="form-group">
                        <label>Description</label>
                        <textarea name="term_and_condition_description" class="blog_description form-control" id="blog_description" cols="30" rows="10">
                            {{ get_setting('term_and_condition_description') }}
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