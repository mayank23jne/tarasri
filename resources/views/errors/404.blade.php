@extends('layouts.app')
@section('title',getSinglerow('seo_meta','title',array('page_name'=>'terms-conditions')))
@section('seo_description',getSinglerow('seo_meta','description',array('page_name'=>'terms-conditions')))
@section('seo_keywords',getSinglerow('seo_meta','keywords',array('page_name'=>'terms-conditions')))
@section('content')
<div class="container-fluid pt-3 mt-2 border-top ">
    <div class="custom-container">
		<div class="row">
			<div class="col-sm-12">
				<div class="page_not_found text-center">
					<img src="{{ url('public/assets/images/404.png') }}" />
					<p>Page Not Found</p>
				</div>
			</div>
		</div>
	 </div>
</div>
@endsection