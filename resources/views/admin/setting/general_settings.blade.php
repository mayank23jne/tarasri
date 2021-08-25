@extends('layouts.admin.app')
@section('title','General Settings')
@section('content')
<section class="content">
      <div class="container-fluid">
        <!-- COLOR PALETTE -->
        <div class="card card-default color-palette-box">
          <div class="card-body">
            <div class="col-12">
            <ul class="nav nav-tabs" role="tablist">
                <li class="nav-item">
                <a class="nav-link active" data-toggle="tab" href="#home">Basic Setting</a>
                </li>
                <li class="nav-item">
                <a class="nav-link" data-toggle="tab" href="#menu1">Image Setting</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#menu2">Source Code</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#menu3">Files Setting</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#menu4">SEO Meta Setting</a>
                </li>
            </ul>

            <!-- Tab panes -->
            <div class="tab-content">
                <div id="home" class="container tab-pane active"><br>
                    <form action="{{ url('admin/setting/save_setting') }}" class="database_operation_form">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label>Site Title</label>
                                {{ csrf_field() }}
                                <input type="text" value="{{ get_setting('site_title') }}" class="form-control" name="site_title" placeholder="Enter Site Title" />
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label>Site Author</label>
                                <input type="author" class="form-control" value="{{ get_setting('site_author') }}" name="site_author" placeholder="Enter Site Author" />
                            </div>
                        </div>
                        <div class="col-sm-12" style="display:none">
                            <div class="form-group">
                                <label>Site Copyright</label>
                                <input type="text" class="form-control" value="{{ get_setting('site_copyright') }}" name="site_copyright" placeholder="Enter Site Copyright" />
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label>Address</label>
                                <textarea placeholder="Address"  class="form-control" name="site_address">{{ get_setting('site_address') }}</textarea>
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label>Phone Number</label>
                                <input type="text" class="form-control" value="{{ get_setting('site_phone') }}" name="site_phone" placeholder="Enter Phone No" />
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label>Whatsapp Number</label>
                                <input type="text" class="form-control" value="{{ get_setting('site_whatsapp_no') }}" name="site_whatsapp_no" placeholder="Enter Whatsapp No" />
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label>E-Mail For Contact Us</label>
                                <input type="text" class="form-control" value="{{ get_setting('contactus_email') }}" name="contactus_email" placeholder="E-Mail For Contact Us" />
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label>E-Mail For Enquiry</label>
                                <input type="text" class="form-control" value="{{ get_setting('enquiry_email') }}" name="enquiry_email" placeholder="E-Mail For Enquiry" />
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
                <div id="menu1" class="container tab-pane fade"><br>
                    <form action="{{ url('admin/setting/save_image') }}" data-image="{{ url('admin/setting/save_image') }}" class="database_operation_form_logo">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label>Select Logo</label>
                                
                                <input type="hidden" name="action" value="logo" />
                                {{ csrf_field() }}  
                                <div id="drop-logo" data-id="#drop-logo" class="drop-control drop-area  drop-area-custom" data-key="logo" data-url="{{ url('admin/setting/save_image') }}">
                                <input type="file" required="required" name="logo" data-from=".database_operation_form_logo" data-parent="#drop-logo" class="upload_image custom_img" >
                                <div class="upload_placeholder">
                                    <img   id="disp_image" class="disp_img_after" src="{{ url(get_setting('logo')) }}" alt="logo">
                                </div>
                                   
                                </div>
                                <p>Image Dimensions Min of 450 W & 40 H</p>
                            </div>
                        </div>
                    </div>
                    </form>
                    <form action="{{ url('admin/setting/save_image') }}" data-image="{{ url('admin/setting/save_image') }}" class="database_operation_form_fevicon">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label>Select Fevicon</label>
                                <input type="hidden" name="action" value="fevicon" />
                                {{ csrf_field() }}  
                               <div id="drop-fevicon" data-id="#drop-fevicon" class="drop-control drop-area-custom" data-key="fevicon" data-url="{{ url('admin/setting/save_image') }}">
                               <input type="file"  data-from=".database_operation_form_fevicon" data-parent="#drop-fevicon" class="upload_image custom_img" required="required" name="fevicon" >
                               <div class="upload_placeholder">
                                    <img width="32px" id="fevicon_show"   height="32px" src="{{ url(get_setting('fevicon')) }}" alt="fevicon" style="margin-top:53px">
                                </div>
                                </div>
                                <p>Image Dimensions Min of 32 W & 32 H</p>
                            </div>
                        </div>
                    </div> 
                    </form>               
                </div>
                <div id="menu2" class="container tab-pane fade"><br>
                <form action="{{ url('admin/setting/save_setting') }}" class="database_operation_form">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label>Head Script</label>
                                {{ csrf_field() }}
                                <textarea name="head_script" class="form-control" placeholder="Enter Head Script"  cols="30" rows="10">{{ get_setting('head_script') }}</textarea>
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label>Body Script</label>
                                <textarea name="body_script" class="form-control" placeholder="Enter Body Script"  cols="30" rows="10">{{ get_setting('body_script') }}</textarea>
                            </div>
                        </div>
						<div class="col-sm-12">
                            <div class="form-group">
                                <label>Footer Script</label>
                                <textarea name="footer_script" class="form-control" placeholder="Enter Footer Script"  cols="30" rows="10">{{ get_setting('footer_script') }}</textarea>
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
                <div id="menu3" class="container tab-pane fade"><br>
                    <button data-toggle="modal" data-target="#add_seo_file" class="btn btn-info float-right btn-sm">Add New</button>
                    <br>
                    <br>
                    <table  class="table table-striped table-bordered datatable_local"  style="width:100%">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Title</th>
                                <th>File</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach($files as $key => $file)
                            <tr>
                                <td>{{ $key+1 }}</td>
                                <td>{{ $file['title'] }}</td>
                                <td>{{ $file['file'] }}</td>
                                <td>
                                    <a href="javascript:;" data-id="{{ $file['id'] }}" data-title="{{ $file['title'] }}" class="btn btn-info btn-sm update_seo_file"><i class="fa fa-edit"></i> Edit</a>
                                    <a href="javascript:;" data-id="{{ $file['id'] }}" class="btn btn-danger btn-sm delete_seo_file"><i class="fa fa-trash"></i> Delete</a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
                <div id="menu4" class="container tab-pane fade"><br>
                 <button style="display:none" data-toggle="modal" data-target="#add_meta_data" class="btn btn-info float-right btn-sm">Add New</button>
                 <br>
                 <br>
                 <table  class="table table-striped table-bordered datatable" json-url="{{ url('admin/get_json/meta_seo_setting') }}" data-url="{{ url('admin/setting/get_meta_seo') }}" style="width:100%">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Page Name</th>
                            <th>Title</th>
                            <th>Description</th>
                            <th>Keyword</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
                </div>
            </div>
            </div>
          </div>
        </div>
</section>
<div class="modal" id="add_meta_data">
  <div class="modal-dialog">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">Add SEO Meta</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <!-- Modal body -->
      <div class="modal-body">
      <form data-pop="#add_meta_data" action="{{ url('admin/setting/meta_seo_manage_operation') }}" class="database_operation_form">
        <div class="">
            <div class="mb-3">
                <label class="form-label">Select Page</label>
                <div>
                    {{ csrf_field() }}
                    <input type="hidden" value="insert" name="action" />
                    <select required="required" class="form-control" name="page_name" id="page-name">
                        <option value="">Select Page</option>
                        <option value="homepage-user">Home Page</option>
                        <option value="collections-user">Collections</option>
                        <option value="aboutus-user">About Us</option>
                        <option value="contactus-user">Contact Us</option>
                        <option value="tarasri-exclusive-user">Tara sri Exclusive</option>
						<option value="privacy-policy">Privacy Policy</option>
						<option value="terms-conditions">Terms Conditions</option>
						<option value="blog-list">Blog List</option>
                    </select>
                </div>
            </div>
            <div class="mb-3">
                <label  class="form-label">Title</label>
                <div>
                    <input required="required" type="text" name="title" class="form-control" id="seo-title">
                </div>
            </div>
            <div class="mb-3">
                <label class="form-label">Description</label>
                <div>
                    <textarea class="form-control" name="description" id="seo-description" spellcheck="false"></textarea>
                </div>
            </div>
            <div class="mb-3">
                <label class="form-label">Keywords</label>
                <div>
                    <input type="text" name="keywords" class="form-control">
                </div>
            </div>
            <div class="w-100">
                <button  class="btn rounded-0 bg-success text-white form_btn" >Submit</button>
            </div>
        </div>
        </form>
        </div>
    </div>
  </div>
</div>



<div class="modal" id="update_meta_data">
  <div class="modal-dialog">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">Update SEO Meta</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <!-- Modal body -->
      <div class="modal-body">
      <form data-pop="#update_meta_data" action="{{ url('admin/setting/meta_seo_manage_operation') }}" class="database_operation_form">
        <div class="">
            <div class="mb-3">
                <label class="form-label">Select Page</label>
                <div>
                    {{ csrf_field() }}
                    <input type="hidden" value="update" name="action" />
                    <input type="hidden" name="id" id="id" />
                    <select required="required" class="form-control" name="page_name" >
                        <option value="">Select Page</option>
                        <option value="homepage-user" id="homepage-user">Home Page</option>
                        <option value="collections-user" id="collections-user">Collections</option>
                        <option value="aboutus-user" id="aboutus-user">About Us</option>
                        <option value="contactus-user" id="contactus-user">Contact Us</option>
                        <option value="tarasri-exclusive-user" id="tarasri-exclusive-user">Tara sri Exclusive</option>
						<option value="privacy-policy">Privacy Policy</option>
						<option value="terms-conditions">Terms Conditions</option>
						<option value="blog-list">Blog List</option>
                    </select>
                </div>
            </div>
            <div class="mb-3">
                <label  class="form-label">Title</label>
                <div>
                    <input required="required" type="text" name="title" class="form-control" id="title">
                </div>
            </div>
            <div class="mb-3">
                <label class="form-label">Description</label>
                <div>
                    <textarea class="form-control" name="description" id="description" spellcheck="false"></textarea>
                </div>
            </div>
            <div class="mb-3">
                <label class="form-label">Keywords</label>
                <div>
                    <input type="text" name="keywords" id="keywords" class="form-control">
                </div>
            </div>
            <div class="w-100">
                <button  class="btn rounded-0 bg-success text-white form_btn" >Submit</button>
            </div>
        </div>
        </form>
        </div>
    </div>
  </div>
</div>



<div class="modal" id="add_seo_file">
  <div class="modal-dialog">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">Add New File</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <!-- Modal body -->
      <div class="modal-body">
      <form data-pop="#update_meta_data" action="{{ url('admin/setting/seoFileOperation') }}" class="database_operation_form">
        <div class="">
            <div class="mb-3">
                <label  class="form-label">Title</label>
                <div>
                    {{ csrf_field() }}
                    <input type="hidden" name="action" value="insert" />
                    <input required="required" type="text" name="title" class="form-control">
                </div>
            </div>
            <div class="mb-3">
                <label class="form-label">File</label>
                <div>
                   <input type="file" required="required" name="file"  class="form-control">
                </div>
            </div>
            <div class="w-100">
                <button  class="btn rounded-0 bg-success text-white form_btn" >Save</button>
            </div>
        </div>
        </form>
        </div>
    </div>
  </div>
</div>



<div class="modal" id="edit_seo_file_popup">
  <div class="modal-dialog">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">Update File</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <!-- Modal body -->
      <div class="modal-body">
      <form data-pop="#edit_seo_file_popup" action="{{ url('admin/setting/seoFileOperation') }}" class="database_operation_form">
        <div class="">
            <div class="mb-3">
                <label  class="form-label">Title</label>
                <div>
                    {{ csrf_field() }}
                    <input type="hidden" name="action" value="update" />
                    <input type="hidden" name="id" id="file_id"  value="" />
                    <input required="required" type="text" id="file_title" name="title" class="form-control">
                </div>
            </div>
            <div class="mb-3">
                <label class="form-label">File</label>
                <div>
                   <input type="file" required="required" name="file"  class="form-control">
                </div>
            </div>
            <div class="w-100">
                <button  class="btn rounded-0 bg-success text-white form_btn" >Update</button>
            </div>
        </div>
        </form>
        </div>
    </div>
  </div>
</div>

@endsection