@extends('layouts.app')
@section('title',getSinglerow('seo_meta','title',array('page_name'=>'privacy-policy')))
@section('seo_description',getSinglerow('seo_meta','description',array('page_name'=>'privacy-policy')))
@section('seo_keywords',getSinglerow('seo_meta','keywords',array('page_name'=>'privacy-policy')))
@section('content')
<div class="container-fluid container-fluid-custom pt-3 mt-2 border-top ">
    <div class="custom-container">
		<div class="row custom_page">
			<div class="col-sm-12" style="text-align: justify;">
			{!! get_setting('privacypolicy_description') !!}
			</div>
		</div>
	 </div>
</div>
	
@endsection