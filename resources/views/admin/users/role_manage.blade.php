@extends('layouts.admin.app')
@section('title','Role Manage')
@section('content')
<section class="content">
      <div class="container-fluid">
        <!-- COLOR PALETTE -->
        <div class="card card-default color-palette-box">
          <div class="card-header">
            <button class="btn btn-info btn-sm float-right" type="button" data-toggle="modal" data-target="#addNewRole">Add New Role</button>
          </div>
          <div class="card-body">
            <div class="col-12">
            <table  class="table table-striped table-bordered datatable" json-url="{{ url('admin/get_json/user_role') }}" data-url="{{ url('admin/users/get_role') }}" style="width:100%">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Title</th>
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
  <div class="modal-dialog modal-lg">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">Add New Role</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <!-- Modal body -->
      <div class="modal-body">
      <form action="{{ url('admin/users/role_manage_operation') }}" class="database_operation_form" data-pop="#addNewRole">
        <div class="row">
          <?php 
          echo csrf_field();
          $permission = get_permission();
          ?>
          <div class="col-sm-12">
            <div class="form-group">
              <label>Enter Role Name</label>
              <input type="hidden" name="action" value="insert" />
              <input type="text" required="required" class="form-control" name="role_name" placeholder="Enter Role Name" />
            </div>
          </div>
          <div class="col-sm-12">
            <div class="form-group">
              <label>Select Permission</label>
            </div>
          </div>
          @foreach($permission as $per)
          <div class="col-sm-4">
            <div class="icheck-primary">
              <input type="checkbox" name="{{ $per['key'] }}" id="{{ $per['key'] }}" class="mr-4" value="1" />
               <label for="{{ $per['key'] }}">{{ $per['title'] }}</label>
            </div>
          </div>
          @endforeach
          <div class="col-sm-12">
            <div class="form-group">
              <button class="btn rounded-0 bg-success text-white form_btn">Add</button>
            </div>
          </div>
        </div>
      </div>
      </form>
    </div>
  </div>
</div>


<div class="modal" id="update_role_popup">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">Update Role</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <!-- Modal body -->
      <div class="modal-body" id="form_block">

    </div>
  </div>
</div>
@endsection