@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">Upload New File</div>

            <div class="card-body">
                <form action="{{ route('uploadfile') }}" enctype="multipart/form-data" method="post">
                {{ csrf_field() }}
                    <div class="form-group">
                        <input type="file" name="file[]" id="" multiple>
                        <span class="help-block text-danger">{{$errors->first('file')}}</span>
                    </div>
                    <button class="btn btn-primary">Upload</button>
                </form>                    
            </div>
        </div>
        @if (session('success'))
            <div class="alert alert-success alert-dismissable">
                <button type="button" class="close" data-dismiss="alert">&times;</button>
                {{session('success')}}
            </div>
        @endif
    </div> 
    </div>
</div>
@endsection