@extends('layouts.admin.app')
@section('title','Diamond Type')
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
            <table  class="table table-striped table-bordered datatable" json-url="{{ url('admin/get_json/category') }}" data-url="{{ url('admin/products/get_diamond_type') }}" style="width:100%">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Diamond Type</th>
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
        <h4 class="modal-title">Add New Diamond Type</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <!-- Modal body -->
      <div class="modal-body">
      <form data-pop="#addNewRole" action="{{ url('admin/products/diamond_type_manage_operation/') }}" class="database_operation_form">
        <div class="">
            <div class="mb-3">
                <label  class="form-label">Enter Diamond Type</label>
                <div>
                    {{ csrf_field() }}
                    <input type="hidden" name="action" value="insert" />
                    <input required="required" type="text"  name="name" class="form-control">
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

<div class="modal" id="design_style_popup">
  <div class="modal-dialog">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">Edit Diamond Type</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <!-- Modal body -->
      <div class="modal-body">
      <form data-pop="#design_style_popup" action="{{ url('admin/products/diamond_type_manage_operation/') }}" class="database_operation_form">
        <div class="">
            <div class="mb-3">
                <label  class="form-label">Enter Diamond Type</label>
                <div>
                    {{ csrf_field() }}
                    <input type="hidden" name="action" value="update" />
                    <input type="hidden" name="id" id="mid" value="update" />
                    <input required="required" type="text" id="mname" name="name" class="form-control">
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