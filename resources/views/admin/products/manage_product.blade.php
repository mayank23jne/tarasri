<@extends('layouts.admin.app')
@section('title','Manage Product')
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
              <a href="{{ url('admin/products/add_new_product') }}" class="btn btn-info btn-sm float-right mt-4" >Add New</a>
              </div>
            </div>
          </div>
          <div class="card-body">
            <div class="col-12">
            <table  class="table table-striped table-bordered datatable" json-url="{{ url('admin/get_json/products') }}" data-url="{{ url('admin/products/get_products') }}" style="width:100%">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Product Title</th>
                        <th>Design No</th>
                        <th>Category</th>
                        <th>Description</th>
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
@endsection