@extends('layouts.admin.app')
@section('title','Crimson Bride')
@section('content')
<?php 
$reffrence=date('hs').rand(100,1000);
?>
<section class="content">
      <div class="container-fluid">
        <!-- COLOR PALETTE -->
        <div class="card card-default color-palette-box">
          <div class="card-header">
			<a class="btn btn-info float-right" href="{{ url('admin/add_new_crimsonbride') }}">Add New Crimsonbride</a>
		  </div>
		  <div class="card-body">
            <div class="col-12">
				<table  class="table table-striped table-bordered local_datatable" style="width:100%">
					<thead>
						<tr>
							<th>#</th>
							<th>Title</th>
							<th>Status</th>
							<th>Action</th>
						</tr>
					</thead>
					<tbody>
				    @foreach($crimsonbrides as $key => $cb)
					<tr>
						<td>{{ $key+1 }}</td>
						<td>{{ $cb['title'] }}</td>
						<td>
						  <label class="switch">
							<input type="checkbox" class="manage_status" value="1" name="status_{{ $cb['id'] }}" data-id="{{ $cb['id'] }}" data-url="{{ url('admin/crimsonbride_operation/') }}" <?php if($cb['status']==1) { echo "checked"; } ?>>
							<span class="slider round"></span>
						  </label>
					    </td>
					    <td>
							<a href="{{ url('admin/edit_crimsonbride/'.$cb['id']) }}" class="btn btn-info btn-sm"><i class="fa fa-edit"></i> Edit</a>
							<a href="javascript:;'"  data-id="{{ $cb['id'] }}" class="btn btn-danger btn-sm delete_crimsonbride"><i class="fa fa-trash"></i> Delete</a>
					    </td>
					</tr>
					@endforeach
					</tbody>
				 </table>
            </div>
          </div>
        </div>
</section>
@endsection