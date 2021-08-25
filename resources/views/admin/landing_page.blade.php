@extends('layouts.admin.app')
@section('title','Landing Pages')
@section('content')
<section class="content">
      <div class="container-fluid">
        <!-- COLOR PALETTE -->
        <div class="card card-default color-palette-box">
          <div class="card-header">
			<a class="btn btn-info float-right" href="{{ url('admin/add-landing-page') }}">Add New landing Page</a>
		  </div>
		  <div class="card-body">
            <div class="col-12">
				<table  class="table table-striped table-bordered local_datatable" style="width:100%">
					<thead>
						<tr>
							<th>#</th>
							<th>Title</th>
							<th>Show On</th>
							<th>Status</th>
							<th>Action</th>
						</tr>
					</thead>
					<tbody>
				    @foreach($landingpage as $key => $page)
					<tr>
						<td>{{ $key+1 }}</td>
						<td>{{ $page['title'] }}</td>
						<td><?php if($page['show_position']==1) { echo "Main Menu"; } else if($page['show_position']==2) { echo "Collection Menu"; } else if($page['show_position']==3) { echo "Link"; } else { echo "Footer Menu"; } ?></td>
						<td>
						  <label class="switch">
							<input type="checkbox" class="manage_status" value="1" name="status_{{ $page['id'] }}" data-id="{{ $page['id'] }}" data-url="{{ url('admin/landing_page_operation/') }}" <?php if($page['status']==1) { echo "checked"; } ?>>
							<span class="slider round"></span>
						  </label>
					    </td>
					    <td>
							<a href="{{ url('admin/edit-landing-page/'.$page['id']) }}" class="btn btn-info btn-sm"><i class="fa fa-edit"></i> Edit</a>
							<a style="display:none" href="javascript:;'"  data-id="{{ $page['id'] }}" class="btn btn-danger btn-sm delete_landing_page"><i class="fa fa-trash"></i> Delete</a>
							@if($page['show_position']==3)
							<a href="javascript:;'"  data-link="{{  url('landing-page/'.$page['slug']) }}" class="btn btn-primary btn-sm landing_page_link"><i class="fa fa-link"></i> Get Link</a>	
							@endif
					    </td>
					</tr>
					@endforeach
					</tbody>
				 </table>
            </div>
          </div>
        </div>
</section>
<div class="modal" id="ShareableLink">
  <div class="modal-dialog model-sm">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">Shareable Link</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <!-- Modal body -->
      <div class="modal-body">
		<div class="row">
			<div class="col-sm-12 ml-4 mr-4">
				<p id="p1" style=" font-size: 15px; "></p>
			</div>
			<div class="col-sm-12 ml-4 mr-4 text-center">
				<button class="btn btn-primary btn-sm" onclick="copyToClipboard('#p1')">Copy Link</button>
			</div>
		</div>
      </div>
    </div>
  </div>
</div>
@endsection