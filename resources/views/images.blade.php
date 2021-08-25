@extends('layouts.app')
@section('content')
<?php
use Illuminate\Support\Facades\Storage;
?>
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">All Images</div>
                <div class="card-body">
                    <table class="table table-bordered">
                        <tr>
                            <!--<th>URL</th>-->
                            <th>Image</th>
                            <th>Title</th>
                            <th>Size</th>
                        </tr>
                        @foreach ($images as $image)
                            <tr>
								<!--<th>{{Storage::disk('s3')->url($image->path)}}</th>-->
								<th><img width="100px" src="{{Storage::disk('s3')->url($image->path)}}"></th>
								<td>{{$image->title}}</td>
								<td>{{$image->size}} KB</td>
                            </tr>
                        @endforeach
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection