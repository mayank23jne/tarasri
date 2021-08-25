@extends('layouts.app')
@section('title','Blog Single')
@section('seo_description',getSinglerow('seo_meta','description',array('page_name'=>'aboutus-user')))
@section('seo_keywords',getSinglerow('seo_meta','keywords',array('page_name'=>'aboutus-user')))
@section('content')
<head>
  <link rel='stylesheet' href='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css'><link rel="stylesheet" href="./style.css">
</head>
<div class="container border-top ">
	<div class="row my_blog">
	    <div class="col-md-9">
	        <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 imgframe">
                    <!--Carousel-->
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
                          <img src="{{ asset('public/assets/images/8.jpg') }}" alt="blog_image">
                          <div class="carousel-caption">
                          </div>
                        </div>
                    
                        <div class="item">
                          <img src="{{ asset('public/assets/images/3.jpg') }}" alt="blog_image">
                          <div class="carousel-caption">
                          </div>
                        </div>
                    
                        <div class="item">
                          <img src="{{ asset('public/assets/images/7.jpg') }}" alt="blog_image">
                          <div class="carousel-caption">
                          </div>
                        </div>
                      </div>
                    
                      <!-- Left and right controls -->
                      <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev">
                        <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
                        <span class="sr-only">Previous</span>
                      </a>
                      <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next">
                        <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
                        <span class="sr-only">Next</span>
                      </a>
                    </div>
                </div>
            </div>
            <div class="row single_blog_meta">
                <div class="col-sm-12">
                    <div class="blog_author">
                        <img src="{{ asset('public/assets/images/author_icon.png') }}">
                        <div class="author_name red">Virat Kohli</div>
                    </div>
                    <div class="blog_time">
                        <img src="{{ asset('public/assets/images/time_icon.png') }}">
                        <div class="time_single red">8 hrs ago</div>
                    </div>
                </div>
                
            </div>
            <div class="row">
                <div class="col-sm-12">
                    <div class="single_blog_title black">
                        A Tell-all Guide on How to Style Gemstone Jewellery with Western Wear.
                    </div>
                </div>
            </div>  
            <div class="row">
                <div class="col-sm-12">
                    <div class="single_category">Necklace</div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12">
                    <div class="single_content">
                        Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's 
                        standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a 
                        type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining 
                        essentially unchanged.
                        <br><br>
                        Lorem Ipsum. Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical 
                        Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney 
                        College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and 
                        going through the cites of the word in classical literature, discovered the undoubtable source. Lorem Ipsum comes 
                        from sections 1.10.32 and 1.10.33 of "de Finibus Bonorum et Malorum" (The Extremes of Good and Evil) by Cicero, 
                        written in 45 BC. This book is a treatise on the theory of ethics, very popular during the Renaissance. The first line of 
                        Lorem Ipsum, "Lorem ipsum dolor sit amet..", comes from a line in section 1.10.32.
                        <br><br>
                        
                        The standard chunk of Lorem Ipsum used since the 1500s is reproduced below for those interested. Sections 1.10.32 
                        and 1.10.33 from "de Finibus Bonorum et Malorum" by Cicero are also reproduced in their exact original form, 
                        accompanied by English versions from the 1914 translation by H. Rackham.
                        <br><br>
                        
                        Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical 
                        Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney 
                        College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and 
                        going through the cites of the word in classical literature, discovered the undoubtable source. Lorem Ipsum comes 
                        from sections 1.10.32 and 1.10.33 of "de Finibus Bonorum et Malorum" (The Extremes of Good and Evil) by Cicero, 
                        written in 45 BC. This book is a treatise on the theory of ethics, very popular during the Renaissance. The first line of 
                        Lorem Ipsum, "Lorem ipsum dolor sit amet..", comes from a line in section 1.10.32.
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12">
                    <div class="social_share">
                        Share this post 
                        <a href="#"><img src="{{ asset('public/assets/images/icon_facebook.svg') }}"></a>
                        <a href="#"><img src="{{ asset('public/assets/images/icon_twitter.svg') }}"></a>
                        <a href="#"><img src="{{ asset('public/assets/images/icon_whatsapp.svg') }}"></a>
                        <a href="#"><img src="{{ asset('public/assets/images/icon_message.svg') }}"></a>
                    </div>
                </div>
            </div>
            <hr class="custom_line">
            <div class="row single_related">
                <div class="col-md-12">
                    <div class="single_related_title font_600">
                        Related Blog
                    </div>
                </div>
                <div class="col-sm-6">
                    <a href="#">
                        <div class="left_arrow arrow">
                            <!--<img class="left_arrow" src="{{ asset('public/assets/images/icon_left_arrow.svg') }}">-->
                            <div class="single_related_bottom">
                                <div class="bottom_img">
                                    <img src="{{ asset('public/assets/images/3.jpg') }}">
                                </div>
                                <div class="single_bottom_title font_600">
                                    A Tell-all Guide on How to Style Gemstone Jewellery with Western Wear.
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-sm-6">
                    <a href="#">
                        <div class="right_arrow arrow">
                            <!--<img class="right_arrow" src="{{ asset('public/assets/images/icon_right_arrow.svg') }}">-->
                            <div class="single_related_bottom">
                                <div class="bottom_img">
                                    <img src="{{ asset('public/assets/images/7.jpg') }}">
                                </div>
                                <div class="single_bottom_title font_600">
                                    A Tell-all Guide on How to Style Gemstone Jewellery with Western Wear.
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
            <div class="row single_comment">
                <div class="col-md-12">
                    <div class="single_comment_title font_600">
                        Leave a comment
                    </div>
                </div>
                <div class="col-md-12 type_comment">
                    <label>Your Comment</label>
                    <textarea class="form-control" rows="7" id="comment" placeholder="Type your comment..."></textarea>
                </div>
                <div class="col-md-6">
                    <label>Name</label><br>
                    <input type="text" placeholder="Enter your name" name="name">
                </div>
                <div class="col-md-6 custom_email">
                    <label>Email</label><br>
                    <input type="email" placeholder="Enter your email" name="email">
                </div>
                <div class="col-md-12">
                    <button class="custom_btn">Submit</button>
                </div>
            </div>
            
            
            
	    </div>
	    <div class="col-md-3"> 
	        <div class="sidebar_item"> 
    	        <div class="sidebar_title red">
    	            Related Blog
    	        </div>
	            <div class="recent_blog">
	                <a href="#">
    	                <div class="recent_single_blog">
        	                <div class="blog_thumb">
        	                    <img src="{{ asset('public/assets/images/blog_thumbnail.jpg') }}">
        	                </div>
        	                <div class="recent_title">
        	                    Winter is Here! Look Trendy With These 7 Piece of Accessories
        	                </div>
        	                <div class="recent_blog_meta">10 hrs ago</div>
    	                </div>
	                </a>
	                <a href="#">
    	                <div class="recent_single_blog">
        	                <div class="blog_thumb">
        	                    <img src="{{ asset('public/assets/images/blog_thumbnail.jpg') }}">
        	                </div>
        	                <div class="recent_title">
        	                    Winter is Here! Look Trendy With These 7 Piece of Accessories
        	                </div>
        	                <div class="recent_blog_meta">10 hrs ago</div>
    	                </div>
	                </a>
	                <a href="#">
    	                <div class="recent_single_blog">
        	                <div class="blog_thumb">
        	                    <img src="{{ asset('public/assets/images/blog_thumbnail.jpg') }}">
        	                </div>
        	                <div class="recent_title">
        	                    Winter is Here! Look Trendy With These 7 Piece of Accessories
        	                </div>
        	                <div class="recent_blog_meta">10 hrs ago</div>
    	                </div>
	                </a>
	                <a href="#">
    	                <div class="recent_single_blog">
        	                <div class="blog_thumb">
        	                    <img src="{{ asset('public/assets/images/blog_thumbnail.jpg') }}">
        	                </div>
        	                <div class="recent_title">
        	                    Winter is Here! Look Trendy With These 7 Piece of Accessories
        	                </div>
        	                <div class="recent_blog_meta">10 hrs ago</div>
    	                </div>
	                </a>
	                <a href="#">
    	                <div class="recent_single_blog">
        	                <div class="blog_thumb">
        	                    <img src="{{ asset('public/assets/images/blog_thumbnail.jpg') }}">
        	                </div>
        	                <div class="recent_title">
        	                    Winter is Here! Look Trendy With These 7 Piece of Accessories
        	                </div>
        	                <div class="recent_blog_meta">10 hrs ago</div>
    	                </div>
	                </a>
	            </div>
	        </div>
	        <div class="sidebar_item">
    	        <div class="sidebar_title red">
    	            Tags
    	        </div>
	            <div class="tags">
	                <a href="#">
	                    <div class="single_tag">Vintage Romance</div>
	                </a>
	                <a href="#">
	                    <div class="single_tag">Loves Embrace</div>
	                </a>
	                
	                <a href="#">
	                    <div class="single_tag">Royal Affair</div>
	                </a>
	                
	                <a href="#">
	                    <div class="single_tag">Diamond Dream</div>
	                </a>
	                
	                <a href="#">
	                    <div class="single_tag">Imperial</div>
	                </a>
	                
	                <a href="#">
	                    <div class="single_tag">Her Highness</div>
	                </a>
	                
	                <a href="#">
	                    <div class="single_tag">Amulya</div>
	                </a>
	                
	                <a href="#">
	                    <div class="single_tag">Shahi Darbar</div>
	                </a>
	            </div>
	        </div>
	    </div>
	</div>
</div>
<script src='https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js'></script>
<script src='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js'></script>
@endsection