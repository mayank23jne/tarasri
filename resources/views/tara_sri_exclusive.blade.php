@extends('layouts.app')
@section('title',getSinglerow('seo_meta','title',array('page_name'=>'tarasri-exclusive-user')))
@section('seo_description',getSinglerow('seo_meta','description',array('page_name'=>'tarasri-exclusive-user')))
@section('seo_keywords',getSinglerow('seo_meta','keywords',array('page_name'=>'tarasri-exclusive-user')))
@section('content')
<div class="container-fluid pt-3 mt-2 border-top ">
	<div class="row mt-4 mb-4">
		<div class="col-sm-12">
		<h3>{{ $exc->title }}</h3>
		</div>
	</div>
    <div class="custom-container">
        @if($exc->banner_url)
		<div class="position-relative d-flex align-items-center jewellery-image-one mb-4">
	  <?php 
		$image=url($exc->banner_url);
	  ?>
            <img src="{{ $image }}" alt="{{ $exc->alt_text }}" class="img-fluid  d-lg-block ml-auto">
           <!-- <img src="<?php /*echo $this->basePath(); */?>/images/tab-banner-3.jpg"
                 class="img-fluid d-none d-md-block d-lg-none">-->
            <div class="row mx-0 jewellery-text w-100 h-100 align-items-center  d-none">
                <div class="col-12 col-md-6 col-lg-4 offset-lg-1 banner pl-md-5 pl-lg-0">
                    <!--Inside the heart-shaped flowers, a pearshaped diamond glitters like a symbol of
                    tender feelings.-->
                </div>
            </div>
        </div>
		@endif
		<div class="row">
			<div class="col-sm-12">
			{!! $exc->description !!}
			</div>
		</div>
	 </div>
</div>
	
@endsection