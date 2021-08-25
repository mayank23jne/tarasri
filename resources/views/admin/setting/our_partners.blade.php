@extends('layouts.admin.app')
@section('title','Our Partners')
@section('content')
<section class="content">
      <div class="container-fluid">
        <!-- COLOR PALETTE -->
        <div class="card card-default color-palette-box">
          <div class="card-header">
			<button class="btn btn-info float-right" data-toggle="modal" data-target="#myModal">Add New</button>
		  </div>
		  <div class="card-body">
			<table  class="table table-striped table-bordered datatable local_datatable"  style="width:100%">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Logo</th>
                        <th>Alt text</th>
                        <th>Title</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
				@foreach($our_partner as $key => $partner)
					<tr>
						<td>{{ $key+1 }}</td>
						<td><img src="{{ url($partner['logo']) }}" width="100px" height="100px"  /></td>
						<td>{{ $partner['alt_text'] }}</td>
						<td>{{ $partner['title'] }}</td>
						<td>
						<label class="switch">
							<input value="1" <?php if($partner['status']==1) { ?>  checked <?php  }  ?> class="manage_status" name="status_{{ $partner['id'] }}" data-id="{{ $partner['id'] }}" data-url="{{ url('admin/setting/our_partners_manage_operation/') }}" type="checkbox" >
							<span class="slider round"></span>
						</label>
						</td>
						<td>
						<a data-url="{{ url('admin/setting/our_partners_manage_operation/') }}" href="javascript:;" class="btn btn-info update_our_partners" data-id="{{ $partner['id'] }}" data-title="{{ $partner['title'] }}" data-alt="{{ $partner['alt_text'] }}">
							<i class="fa fa-edit"></i>
						</a>
						<a data-url="{{ url('admin/setting/our_partners_manage_operation/') }}" href="javascript:;" class="btn btn-danger delete_our_partners" data-id="{{ $partner['id'] }}" >
							<i class="fa fa-trash"></i>
						</a>
						</td>
					</tr>
				@endforeach
                </tbody>
              </table>
          </div>
        </div>
	  </div>
</section>
<!-- The Modal -->
<div class="modal" id="myModal">
  <div class="modal-dialog">
    <div class="modal-content">

      <!-- Modal Header myModal-->
      <div class="modal-header">
        <h4 class="modal-title">Add New Our Partners</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <!-- Modal body -->
      <div class="modal-body">
	  <form data-pop="#myModal" action="{{ url('admin/setting/our_partners_manage_operation/') }}" class="database_operation_form">
        <div class="row">
			<div class="col-sm-12">
				<div class="form-group">
					<label>Enter Title</label>
					{{ csrf_field() }}
					<input type="hidden" name="action" value="insert" />
					<input type="text" required="required" name="title" placeholder="Enter  Title" class="form-control" />
				</div>
			</div>
			<div class="col-sm-12">
				<div class="form-group">
					<label>Select Logo</label>
					<input type="file" name="logo" required="required"  class="form-control" />
				</div>
				<p>** Image Dimensions Min of 100 W & 100 H</p>
			</div>
			<div class="col-sm-12">
				<div class="form-group">
					<label>Enter Alt text</label>
					<input type="text" name="alt_text" required="required" placeholder="Enter Alt text" class="form-control" />
				</div>
			</div>
			<div class="col-sm-12">
				<div class="form-group">
					<button class="btn btn-info form_btn">Add</button>
				</div>
			</div>
		</div>
		</form>
      </div>
    </div>
  </div>
</div>


<div class="modal" id="up_myModal">
  <div class="modal-dialog">
    <div class="modal-content">

      <!-- Modal Header myModal-->
      <div class="modal-header">
        <h4 class="modal-title">Update Our Partners</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <!-- Modal body -->
      <div class="modal-body">
	  <form data-pop="#up_myModal" action="{{ url('admin/setting/our_partners_manage_operation/') }}" class="database_operation_form">
        <div class="row">
			<div class="col-sm-12">
				<div class="form-group">
					<label>Enter Title</label>
					{{ csrf_field() }}
					<input type="hidden" name="action" value="update" />
					<input type="hidden" name="id" id="id" value="" />
					<input type="text" required="required" name="title" id="title" placeholder="Enter  Title" class="form-control" />
				</div>
			</div>
			<div class="col-sm-12">
				<div class="form-group">
					<label>Select Logo</label>
					<input type="file" name="logo"  class="form-control" />
				</div>
				<p>** Image Dimensions Min of 100 W & 100 H</p>
			</div>
			<div class="col-sm-12">
				<div class="form-group">
					<label>Enter Alt text</label>
					<input type="text" name="alt_text" id="alt_text" required="required" placeholder="Enter Alt text" class="form-control" />
				</div>
			</div>
			<div class="col-sm-12">
				<div class="form-group">
					<button class="btn btn-info form_btn">Update</button>
				</div>
			</div>
		</div>
		</form>
      </div>
    </div>
  </div>
</div>
@endsection