@extends('layouts.admin.app')
@section('title','Manage Users')
@section('content')
<section class="content">
      <div class="container-fluid">
        <!-- COLOR PALETTE -->
        <div class="card card-default color-palette-box">
          <div class="card-header">
            <div class="row">
              <div class="col-sm-4">
                <div class="form-group">
                  <label>Select Role</label>
                  <select class="form-control" id="role_filter" name="role">
                      <option value="">Select</option>
                      @foreach($roles as $role)
                      <option value="{{ $role['id'] }}">{{ $role['title'] }}</option>
                      @endforeach
                  </select>
                </div>
              </div>
              <div class="col-sm-8">
              <button class="btn btn-info btn-sm float-right mt-4" type="button" data-toggle="modal" data-target="#addNewRole">Add New User</button>
              </div>
            </div>
          </div>
          <div class="card-body">
            <div class="col-12">
            <table  class="table table-striped table-bordered datatable" json-url="{{ url('admin/get_json/user') }}" data-url="{{ url('admin/users/get_user') }}" style="width:100%">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>E-Mail</th>
                        <th>Mobile No</th>
                        <th>Role</th>
                        <th>Registered On</th>
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
        <h4 class="modal-title">Add User</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <!-- Modal body -->
      <div class="modal-body">
      <form action="{{ url('admin/users/manage_user_operation') }}" class="database_operation_form" data-pop="#addNewRole">
        <div class="row">
          <?php 
          echo csrf_field();
          $permission = get_permission();
          ?>
          <div class="col-sm-12">
            <div class="form-group">
              <label>Enter  Name</label>
              <input type="hidden" name="action" value="insert" />
              <input type="text" required="required" class="form-control" name="name" placeholder="Enter Name" />
            </div>
          </div>
          <div class="col-sm-12">
            <div class="form-group">
              <label>Enter E-Mail</label>
              <input type="email" required="required" class="form-control" name="email" placeholder="Enter E-Mail" />
            </div>
          </div>
          <div class="col-sm-12">
            <div class="form-group">
              <label>Enter Mobile No</label>
              <input type="text" required="required" class="form-control" name="mobile_no" placeholder="Enter Mobile No" />
            </div>
          </div>
          <div class="col-sm-12">
            <div class="form-group">
              <label>Select Role</label>
              <select class="form-control" name="role">
                  <option value="">Select</option>
                  @foreach($roles as $role)
                   <option value="{{ $role['id'] }}">{{ $role['title'] }}</option>
                  @endforeach
              </select>
            </div>
          </div>
          <div class="col-sm-6">
            <div class="form-group">
              <label>Enter Password</label>
              <input type="password" required="required" class="form-control" name="password" placeholder="Enter Password" />
            </div>
          </div>
          <div class="col-sm-6">
            <div class="form-group">
              <label>Enter Confirm Password</label>
              <input type="password" required="required" class="form-control" name="confirm_password" placeholder="Enter Confirm Password" />
            </div>
          </div>
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


<div class="modal" id="update_user_popup">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">Update User</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <!-- Modal body -->
      <div class="modal-body" id="form_block">
      <form action="{{ url('admin/users/manage_user_operation') }}" class="database_operation_form" data-pop="#update_user_popup">
        <div class="row">
          <?php 
          echo csrf_field();
          $permission = get_permission();
          ?>
          <div class="col-sm-12">
            <div class="form-group">
              <label>Enter  Name</label>
              <input type="hidden" name="action" value="update" />
              <input type="hidden" name="id" id="id" value="" />
              <input type="text" id="name" required="required" class="form-control" name="name" placeholder="Enter Name" />
            </div>
          </div>
          <div class="col-sm-12">
            <div class="form-group">
              <label>Enter E-Mail</label>
              <input type="email" id="email" required="required" class="form-control" name="email" placeholder="Enter E-Mail" />
            </div>
          </div>
          <div class="col-sm-12">
            <div class="form-group">
              <label>Enter Mobile No</label>
              <input type="text" id="mobile" required="required" class="form-control" name="mobile_no" placeholder="Enter Mobile No" />
            </div>
          </div>
          <div class="col-sm-12">
            <div class="form-group">
              <label>Select Role</label>
              <select class="form-control" name="role">
                  <option id="r1" value="">Select</option>
                  @foreach($roles as $role)
                   <option id="role_{{ $role['id'] }}" value="{{ $role['id'] }}">{{ $role['title'] }}</option>
                  @endforeach
              </select>
            </div>
          </div>
          <div class="col-sm-6">
            <div class="form-group">
              <label>Enter Password</label>
              <input type="password"  class="form-control" name="password" placeholder="Enter Password" />
            </div>
          </div>
          <div class="col-sm-6">
            <div class="form-group">
              <label>Enter Confirm Password</label>
              <input type="password"  class="form-control" name="confirm_password" placeholder="Enter Confirm Password" />
            </div>
          </div>
          <div class="col-sm-12">
            <div class="form-group">
              <button class="btn rounded-0 bg-success text-white form_btn">Update</button>
            </div>
          </div>
        </div>
      </div>
      </form>
    </div>
  </div>
</div>
@endsection