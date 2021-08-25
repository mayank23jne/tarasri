@extends('layouts.admin.app')
@section('title','About US')
@section('content')<?php  $s3_bucket_url = \Config::get('app.s3_bucket_url');?>
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
                        <input type="text" required="required" value="{{ $about_info->title }}" name="title" placeholder="Title" class="form-control">
                    </div>
                </div>
				<div class="col-sm-12">
                    <div class="form-group">
                        <label>Status</label>
                        <select required="required" class="form-control" name="status">
							<option <?php if(get_setting('about_page_status')==1) { echo "selected"; } ?> value="1">Active</option>
							<option <?php if(get_setting('about_page_status')==0) { echo "selected"; } ?> value="0">Inactive</option>
						</select>
                    </div>
                </div>
				<div class="col-sm-12">
                    <div class="form-group">
                        <label>Show On</label>
                        <select required="required" class="form-control" name="about_page_location">
							<option <?php if(get_setting('about_page_location')==1) { echo "selected"; } ?> value="1">Main Menu</option>
							<option <?php if(get_setting('about_page_location')==2) { echo "selected"; } ?> value="2">Collection Menu</option>
							<option <?php if(get_setting('about_page_location')==3) { echo "selected"; } ?> value="3">Footer Menu</option>
						</select>
                    </div>
                </div>
                <div class="col-sm-12">
                    <div class="form-group">
                        <label>Top Description 1</label>
                        <textarea required="required" name="description1"  class="form-control" cols="30" rows="4">
                        {{ $about_info->description }}
                        </textarea>
                    </div>
                </div>
                <div class="col-sm-12">
                    <div class="form-group">
                        <label>Top Description 2</label>
                        <textarea required="required" name="description2"  class="form-control" cols="30" rows="4">
                        {{ $about_info->description2 }}
                        </textarea>
                    </div>
                </div>
                <div class="col-sm-12">
                    <div class="form-group">
                        <label>Bottom Description 1</label>
                        <textarea required="required" name="description3"  class="form-control" cols="30" rows="4">
                        {{ $about_info->description3 }}
                        </textarea>
                    </div>
                </div>
                <div class="col-sm-12">
                    <div class="form-group"> 
                        <label>Bottom Description 2</label>
                        <textarea required="required" name="description4"  class="form-control" cols="30" rows="4">
                        {{ $about_info->description4 }}
                        </textarea>
                    </div>
                </div>
                <?php 
                $Members = json_decode($about_info->member_info);
                ?>
                <div class="col-sm-12 mb-2">
                    <div class="form-group">
                        <h4>Team Members <a href="javascript:;" class="btn btn-primary float-right add_new_items">+</a></h4>
                    </div>
                </div>
                <div class="col-sm-12 show_items">
                @foreach($Members as $member)
                    <div class="row mb-2 item_element">
                        <div class="col-sm-12">
                            <a  href="javascript:;" class="remove_item btn-sm btn btn-danger float-right">X</a>
                            <img src="{{$s3_bucket_url.$member->image}}" width="100px">
                        </div>
                        <div class="col-sm-12">
                            <label style="width:100%;">Name </label>
                            <input required="required" value="{{ $member->name }}" type="text" name="name[]" class="form-control" placeholder="Enter Name" />
                        </div>
                        <div class="col-sm-5">
                            <div class="form-group">
                                <label>Designation</label>
                                <input required="required" value="{{ $member->designation }}" type="text" name="designation[]" placeholder="Designation" class="form-control">
                                <label>Image</label>
                                <input type="hidden" name="img[]" value="{{ $member->image }}"> 
                                <input  type="file" name="image[]" class="form-control">
                            </div>
                        </div>
                        <div class="col-sm-7">
                            <div class="form-group">
                                <label style="width:100%">About </label>
                                <textarea required="required" style=" height: 105px; " name="about[]" cols="4" class="form-control">{{ $member->about }}</textarea>
                            </div>
                        </div>
                        <hr />
                    </div>
                @endforeach
                </div>
                <div class="col-sm-12">
                    
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