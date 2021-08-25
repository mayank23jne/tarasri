@extends('layouts.app')
@section('title',getSinglerow('seo_meta','title',array('page_name'=>'crimson-bride')))
@section('seo_description',getSinglerow('seo_meta','description',array('page_name'=>'crimson-bride')))
@section('seo_keywords',getSinglerow('seo_meta','keywords',array('page_name'=>'crimson-bride')))
@section('content')
<div class="container-fluid py-5">
    <div class="container custom-container">
        <div class="filter-by-heading mb-3">
		{{ $crimsonbride->title }}
        </div>
    </div>
		<div class="container">
			<div id="demo" class="carousel slide" data-ride="carousel">

			  <!-- Indicators -->
			  <ul class="carousel-indicators">
				@foreach($CrimsonbrideImages as $key => $cb)
				<li data-target="#demo" data-slide-to="{{ $key }}" class="<?php if($key==0) { ?> active <?php } ?>"></li>
				@endforeach
			  </ul>
			  
			  <!-- The slideshow -->
			  <div class="carousel-inner">
			  @foreach($CrimsonbrideImages as $key => $cb)
				<div class="carousel-item <?php if($key==0) { ?> active <?php } ?>">
				  <img src="{{ url($cb['image']) }}" alt="$cb['alt_text']" width="1100" height="500">
				</div>
			  @endforeach
			  </div>
			  
			  <!-- Left and right controls -->
			  <a class="carousel-control-prev" href="#demo" data-slide="prev">
				<span class="carousel-control-prev-icon"></span>
			  </a>
			  <a class="carousel-control-next" href="#demo" data-slide="next">
				<span class="carousel-control-next-icon"></span>
			  </a>
			</div>
		</div>
</div>
@endsection