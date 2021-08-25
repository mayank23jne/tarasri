@extends('layouts.app')
@section('title',getSinglerow('seo_meta','title',array('page_name'=>'terms-conditions')))
@section('seo_description',getSinglerow('seo_meta','description',array('page_name'=>'terms-conditions')))
@section('seo_keywords',getSinglerow('seo_meta','keywords',array('page_name'=>'terms-conditions')))
@section('content')
<div class="container-fluid container-fluid-custom pt-3 mt-2 border-top ">
    <div class="custom-container">
		<div class="row">
			<div class="col-sm-12" style="text-align: justify;">
			{!! get_setting('term_and_condition_description') !!}
			</div>
		</div>
	 </div>
</div>
	
@endsection