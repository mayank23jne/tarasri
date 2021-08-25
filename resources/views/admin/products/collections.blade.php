@extends('layouts.admin.app')
@section('title','Manage Collections')
@section('content')
<section class="content">
      <div class="container-fluid">
        <!-- COLOR PALETTE -->
        <div class="card card-default color-palette-box">
          <div class="card-header">
            <div class="row">
              <div class="col-sm-4">
              
              </div>
              <div class="col-sm-8">
              <button class="btn btn-info btn-sm float-right mt-4" type="button" data-toggle="modal" data-target="#addNewRole">Add New</button>
              </div>
            </div>
          </div>
          <div class="card-body">
            <div class="col-12">
            <table  class="table table-striped table-bordered datatable" json-url="{{ url('admin/get_json/collections') }}" data-url="{{ url('admin/products/get_collections') }}" style="width:100%">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Banner</th>
                        <th>Collections Name</th>
                        <th>Alt Text</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
              </table>
            </div>
          </div>
        </div>
</section>
<div class="modal" id="addNewRole">
  <div class="modal-dialog">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">Add New Collections</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <!-- Modal body -->
      <div class="modal-body">
      <form data-pop="#addNewRole" action="{{ url('admin/products/collections_manage_operation/') }}" class="database_operation_form">
        <div class="">
            <div class="mb-3">
                <label  class="form-label">Enter Collection Name</label>
                <div>
                    {{ csrf_field() }}
                    <input type="hidden" name="action" value="insert" />
                    <input required="required" type="text" id="collection_name" name="collection_name" class="form-control">
                </div>
            </div>
            <div class="mb-3">
                <label  class="form-label">Select Collection Banner</label>
                <div>
                    <input required="required" type="file" id="banner" name="banner" class="form-control">
                </div>
				<p>** Image Dimensions Min of 1920 W & 660 H</p>
            </div>
            <div class="mb-3">
                <label  class="form-label">Slug</label>
                <div>
                <input required="required" type="text"  name="slug" class="form-control">
                </div>
            </div>
            <div class="mb-3">
                <label  class="form-label">Alt Text</label>
                <div>
                <input required="required" type="text"  name="alt_text" class="form-control">
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

<div class="modal" id="update_col_popup">
  <div class="modal-dialog">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">Edit Collections</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <!-- Modal body -->
      <div class="modal-body">
      <form data-pop="#update_col_popup" action="{{ url('admin/products/collections_manage_operation/') }}" class="database_operation_form">
        <div class="">
            <div class="mb-3">
                <label  class="form-label">Enter Collection Name</label>
                <div>
                    {{ csrf_field() }}
                    <input type="hidden" name="action" value="update" />
                    <input type="hidden" name="id" id="col_id" value="update" />
                    <input required="required" type="text" id="col_name" name="collection_name" class="form-control">
                </div>
            </div>
            <div class="mb-3">
                <label  class="form-label">Select Collection Banner</label>
                <div>
                    <input  type="file" id="banner" name="banner" class="form-control">
                </div>
				<p>** Image Dimensions Min of 1920 W & 660 H</p>
            </div>
            <div class="mb-3">
                <label  class="form-label">Slug</label>
                <div>
                <input required="required" type="text"  name="slug" id="slug" class="form-control">
                </div>
            </div>
            <div class="mb-3">
                <label  class="form-label">Alt Text</label>
                <div>
                <input required="required" type="text" id="alt_text" name="alt_text" class="form-control">
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