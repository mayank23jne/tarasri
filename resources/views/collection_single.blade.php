@extends('layouts.app')
@section('title','Collection Single')
@section('content')
<head>
  <link rel='stylesheet' href='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css'><link rel="stylesheet" href="./style.css">
</head>
<?php
$s3_bucket_url = \Config::get('app.s3_bucket_url');
?>
<div class="container border-top custom_top">
	<div class="row my_blog">
        <div class="col-md-9 single_product">
            <div class="product_img">
                <div id="myCarousel" class="carousel slide" data-ride="carousel">
                      <!-- Indicators -->
                      <ol class="carousel-indicators">
                        <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
                        <li data-target="#myCarousel" data-slide-to="1"></li>
                        <li data-target="#myCarousel" data-slide-to="2"></li>
                        <li data-target="#myCarousel" data-slide-to="3"></li>
                      </ol>
                    
                      <!-- Wrapper for slides -->
                      <div class="carousel-inner" role="listbox">
                        <div class="item active">
                          <div class="product_favourite">
                            <img class="favourite_icon" src="{{ asset('public/assets/images/icon_favourite_blank.svg') }}" alt="favourite">
                          </div>
                          <img src="{{ asset('public/assets/images/8.jpg') }}" alt="blog_image">
                          <div class="carousel-caption">
                          </div>
                        </div>
                    
                        <div class="item">
                          <div class="product_favourite">
                            <img class="favourite_icon" src="{{ asset('public/assets/images/icon_favourite_fill.svg') }}" alt="favourite">
                          </div>
                          <img src="{{ asset('public/assets/images/3.jpg') }}" alt="blog_image">
                          <div class="carousel-caption">
                          </div>
                        </div>
                    
                        <div class="item">
                          <div class="product_favourite">
                            <img class="favourite_icon" src="{{ asset('public/assets/images/icon_favourite_fill.svg') }}" alt="favourite">
                          </div>
                          <img src="{{ asset('public/assets/images/7.jpg') }}" alt="blog_image">
                          <div class="carousel-caption">
                          </div>
                        </div>
                      </div>
                    
                      <!-- Left and right controls -->
                      <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev">
                        <span class="glyphicon glyphicon-chevron-left" aria-hidden="true">
                            <img src="{{ asset('public/assets/images/icon_arrow_left.svg') }}" alt="arrow">
                        </span>
                        <span class="sr-only">Previous</span>
                      </a>
                      <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next">
                        <span class="glyphicon glyphicon-chevron-right" aria-hidden="true">
                            <img src="{{ asset('public/assets/images/icon_arrow_right.svg') }}" alt="arrow">
                        </span>
                        <span class="sr-only">Next</span>
                      </a>
                </div>
            </div>   
            
        </div>
        <div class="col-md-3">
            <div class="sidebar_item">
    	        <div class="single_product_name">
    	            Everlasting Charm
    	        </div>
	            <div class="single_product_disc">
	                A beautiful fusion of patchi and nakshi 
                    workmanship in gold, studded with polkis, 
                    these earrings have an understated 
                    charm to them
	            </div>
	        </div>
	        <div class="sidebar_item">
    	        <div class="sidebar_title">
    	            Specifications
    	        </div>
	            <div class="single_product_specification">
	                <div class="single_specification">
	                    <div class="single_label specification">
	                        Design style
	                    </div>
	                    <div class="single_devider specification">
	                        :
	                    </div>
	                    <div class="single_value specification">
	                        Patchi, Antique
	                    </div>
	                </div>
	                <div class="single_specification">
	                    <div class="single_label specification">
	                        Design number
	                    </div>
	                    <div class="single_devider specification">
	                        :
	                    </div>
	                    <div class="single_value specification">
	                        19GT12080001
	                    </div>
	                </div>
	                <div class="single_specification">
	                    <div class="single_label specification">
	                        Metal
	                    </div>
	                    <div class="single_devider specification">
	                        :
	                    </div>
	                    <div class="single_value specification">
	                        Gold
	                    </div>
	                </div>
	                <div class="single_specification">
	                    <div class="single_label specification">
	                        Metal purity
	                    </div>
	                    <div class="single_devider specification">
	                        :
	                    </div>
	                    <div class="single_value specification">
	                        22k
	                    </div>
	                </div>
	                <div class="single_specification">
	                    <div class="single_label specification">
	                        Occasion
	                    </div>
	                    <div class="single_devider specification">
	                        :
	                    </div>
	                    <div class="single_value specification">
	                        Everyday Luxury
	                    </div>
	                </div>
	                <div class="single_specification">
	                    <div class="single_label specification">
	                        Diamond type
	                    </div>
	                    <div class="single_devider specification">
	                        :
	                    </div>
	                    <div class="single_value specification">
	                        Flat Diamond (Polki)
	                    </div>
	                </div>
	            </div>
	        </div>
	         <div class="sidebar_item">
	             <div class="sidebar_title">
                	<a class="button" href="#popup1">Request a quote</a>
                	<img class="side_arrow" src="{{ asset('public/assets/images/icon_arrow.svg') }}" alt="arrow">
                </div>
                
                <div id="popup1" class="overlay">
                	<div class="popup">
                		<a class="close" href="#">&times;</a>
                		<div class="content">
                			<div class="product_form">
                			    <div class="product_form_heading">
                			        Request a qoute
                			    </div>
                			    <div class="form_inner">
                			        <input type="text" placeholder="Enter your name" name="name">
                			        <input type="number" placeholder="Enter your mobile number" name="mobile">
                			        <input type="email" placeholder="Enter your email" name="email">
                			        <textarea rows="5" placeholder="Enter message here..." name="message"></textarea>
                			        <button class="product_form_submit">Submit</button>
                			    </div>
                			</div>
                		</div>
                	</div>
                </div>
    	        
    	     </div>
        </div>
    </div>
</div>
<script src='https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js'></script>
<script src='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js'></script>
<script>
    document.getElementById('btn-modal1').addEventListener('click', function() {
          document.getElementById('overlay').classList.add('is-visible');
          document.getElementById('modal').classList.add('is-visible');
        });
        
        document.getElementById('close-btn').addEventListener('click', function() {
          document.getElementById('overlay').classList.remove('is-visible');
          document.getElementById('modal').classList.remove('is-visible');
        });
        document.getElementById('overlay').addEventListener('click', function() {
          document.getElementById('overlay').classList.remove('is-visible');
          document.getElementById('modal').classList.remove('is-visible');
        });
</script>
@endsection


















