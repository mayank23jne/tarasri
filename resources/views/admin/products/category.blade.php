@extends('layouts.admin.app')
@section('title','Manage Category')
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
            <table  class="table table-striped table-bordered datatable" json-url="{{ url('admin/get_json/category') }}" data-url="{{ url('admin/products/get_category') }}" style="width:100%">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Category Name</th>
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
        <h4 class="modal-title">Add New Category</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <!-- Modal body -->
      <div class="modal-body">
      <form data-pop="#addNewRole" action="{{ url('admin/products/category_manage_operation/') }}" class="database_operation_form">
        <div class="">
            <div class="mb-3">
                <label  class="form-label">Enter Category Name</label>
                <div>
                    {{ csrf_field() }}
                    <input type="hidden" name="action" value="insert" />
                    <input required="required" type="text" id="category_name" name="category_name" class="form-control">
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

<div class="modal" id="update_cat_popup">
  <div class="modal-dialog">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">Edit Category</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <!-- Modal body -->
      <div class="modal-body">
      <form data-pop="#update_cat_popup" action="{{ url('admin/products/category_manage_operation/') }}" class="database_operation_form">
        <div class="">
            <div class="mb-3">
                <label  class="form-label">Enter Category Name</label>
                <div>
                    {{ csrf_field() }}
                    <input type="hidden" name="action" value="update" />
                    <input type="hidden" name="id" id="cat_id" value="update" />
                    <input required="required" type="text" id="cat_name" name="category_name" class="form-control">
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