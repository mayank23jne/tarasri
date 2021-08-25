@extends('layouts.admin.app')
@section('title','Manage Blog')
@section('content')
<section class="content">
      <div class="container-fluid">
        <!-- COLOR PALETTE -->
        <div class="card card-default color-palette-box">
        <div class="card-header">
            <div class="row">
              <div class="col-sm-4">
			  <select class="form-control blog_manage_status">
				<option <?php if(get_setting('blog_manage_status')==1) { ?>  selected <?php  } ?> value="1">Active</option>
				<option <?php if(get_setting('blog_manage_status')==0) { ?>  selected <?php  } ?> value="0">Inactive</option>
			  </select>
			  </div>
			  <div class="col-sm-8">
              <a href="{{ url('admin/add_new_blog') }}" class="btn btn-info btn-sm float-right" >Add New Blog</a>
              </div>
            </div>
          </div>
          <div class="card-body">
            <div class="col-12">
            <table  class="table table-striped table-bordered local_datatable" style="width:100%">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Image</th>
                        <th>Title</th>
                        <th>Slug</th>
                        <th>Published</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                @foreach($blogs as $key => $blog)
				<?php 
				$image = blog_image($blog['reffrence']);
				?>
                <tr>
                  <td>{{ $key+1 }}</td>
				  @if($image)
					<td><img src="{{ url($image) }}" width="100px" height="100px" ></td> 
				  @else 
					<td><img src="{{ url($blog['image']) }}" width="100px" height="100px" ></td>
                  @endif
				  <td>{{ $blog['title'] }}</td>
                  <td>{{ $blog['slug'] }}</td>
                  <td>{{ date('d M,Y',strtotime($blog['created_at'])) }}</td>
                  <td>
                      <label class="switch">
                        <input type="checkbox" class="manage_status" value="1" name="status_{{ $blog['id'] }}" data-id="{{ $blog['id'] }}" data-url="{{ url('admin/blog_operation/') }}" <?php if($blog['status']==1) { echo "checked"; } ?>>
                        <span class="slider round"></span>
                      </label>
                  </td>
                  <td>
                    <a href="{{ url('admin/edit_blog/'.$blog['id']) }}" class="btn btn-info btn-sm"><i class="fa fa-edit"></i> Edit</a>
                    <a href="javascript:;'" style="display:none" data-id="{{ $blog['id'] }}" class="btn btn-danger btn-sm delete_blog"><i class="fa fa-trash"></i> Delete</a>
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