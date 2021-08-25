@extends('layouts.admin.app')
@section('title','Profile')
@section('content')
<section class="content">
      <div class="container-fluid">
        <!-- COLOR PALETTE -->
        <div class="row">
            <div class="col-sm-8 mx-auto">
                <div class="card card-default color-palette-box">
                    <div class="card-body">
                        <form action="{{ url('admin/profile') }}" class="database_operation_form">
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label>Name</label>
                                    {{ csrf_field() }}
                                    <input type="text" value="{{ $user_info->name }}" required="required" name="name" placeholder="Name" class="form-control">
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label>Mobile No</label>
                                    <input type="text" value="{{ $user_info->mobile }}" required="required" name="mobile_no" placeholder="Mobile No" class="form-control">
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label>E-Mail</label>
                                    <input type="email" required="required" value="{{ $user_info->email }}" name="email" placeholder="E-Mail" class="form-control">
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label>Password</label>
                                    <input type="password"  name="password" placeholder="Password" class="form-control">
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label>Confirm Password</label>
                                    <input type="password"  name="confirm_password" placeholder="Confirm Password" class="form-control">
                                </div>
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
        </div>
       
</section>
@endsection