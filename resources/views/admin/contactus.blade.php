@extends('layouts.admin.app')
@section('title','Contact Us')
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
                        <th>Message</th>
                        <th>Date</th>
                    </tr>
                </thead>
                <tbody>
                @foreach($all_contact as $key => $contact)
                <tr>
                  <td>{{ $key+1 }}</td>
                  <td>{{ $contact['name'] }}</td>
                  <td>{{ $contact['email'] }}</td>
                  <td>@if($contact['code']) (+{{ $contact['code'] }}) @endif {{ $contact['mobile'] }}</td>
                  <td>{{ $contact['message'] }}</td>
                  <td>{{ date('d M,Y',strtotime($contact['created_at']))  }}</td>
                </tr>
                @endforeach
                </tbody>
              </table>
            </div>
          </div>
        </div>
</section>
@endsection