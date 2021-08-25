@extends('layouts.admin.app')
@section('title','Enquiry')
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
                        <th>Name</th>
                        <th>E-Mail</th>
                        <th>Mobile No</th>
						<th>Product</th>
                        <th>Message</th>
                        <th>Date</th>
                    </tr>
                </thead>
                <tbody>
                @foreach($all_enquiry as $key => $enq)
                <tr>
                  <td>{{ $key+1 }}</td>
                  <td>{{ $enq['name'] }}</td>
                  <td>{{ $enq['email'] }}</td>
                  <td>{{ $enq['mobile'] }}</td>
				  <td>{{ getSinglerow('products','product_name',array('id'=>$enq['product_id'])) }}</td>
                  <td>{{ $enq['message'] }}</td>
                  <td>{{ date('d M,Y',strtotime($enq['created_at']))  }}</td>
                </tr>
                @endforeach
                </tbody>
              </table>
            </div>
          </div>
        </div>
</section>
@endsection