@extends('layouts.admin.app')
@section('title','Blog Comment')
@section('content')
<section class="content">
      <div class="container-fluid">
        <!-- COLOR PALETTE -->
        <div class="card card-default color-palette-box">
          <div class="card-body">
            <div class="col-12">
            <table  class="table table-striped table-bordered local_datatable" style="width:100%">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Customer Name</th>
                        <th>Blog</th>
                        <th>Comment</th>
                        <th>Date</th>
                    </tr>
                </thead>
                <tbody>
				@foreach($blog_comments as $key => $comment)
					<tr>
						<td>{{ $key+1 }}</td>
						<td>{{ $comment['name'] }}</td>
						<td>{{ $comment['title'] }}</td>
						<td>{{ $comment['comment'] }}</td>
						<td>{{ date('d M,Y',strtotime($comment['created_at'])) }}</td>
					</tr>
				@endforeach
                </tbody>
              </table>
            </div>
          </div>
        </div>
</section>
@endsection