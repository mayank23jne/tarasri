@extends('layouts.app')
@section('title',$pages->seo_title)
@section('seo_description',$pages->seo_description)
@section('seo_keywords',$pages->seo_keyowrd)
@section('content')
<style>
.badge {
    display: none;
}
</style>
<div class="container-fluid pt-3 mt-2 border-top ">
	@if($pages->status==1)
    <div class="custom-container">	
		<div class="row">
			<div class="col-sm-12">
			<?php 
			foreach($page_data as $data)
			{
				echo $data['description'];
			}
			?>
			</div>
		</div>
	 </div>
	 @else 
	<div class="row">
		<div class="col-sm-12">
			<h2>
				<div class="not_found mt-4"> 
					<img src="{{ asset('public/assets/images/blog_not_found3.gif') }}"> 
					<div class="not_found_text">Page Not Found</div> 
				</div>
			</h2>
		</div>
	</div>
	 @endif
</div>
@endsection