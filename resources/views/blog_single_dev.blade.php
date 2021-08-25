@extends('layouts.app')
@section('title',$blog_list->title)
@section('seo_description',getSinglerow('seo_meta','description',array('page_name'=>'aboutus-user')))
@section('seo_keywords',getSinglerow('seo_meta','keywords',array('page_name'=>'aboutus-user')))
@section('content')
<script src="http://code.jquery.com/jquery-1.11.3.min.js"></script>
<link href="http://www.jqueryscript.net/css/jquerysctipttop.css" rel="stylesheet" type="text/css">
<style>
  .carousel-inner img {
    width: 100%;
    height: 100%;
  }
.collapse.navbar-collapse.px-3 {
    margin-bottom: 8px;
}  
</style>
<script src="{{url('public/assets/plugins/blog-carousal/js/Carousel.js')}}"></script>
<script src="{{url('public/assets/plugins/blog-carousal/js/custom.js')}}"></script>
<div class="container border-top ">
	<div class="row my_blog">
	    <div class="col-md-9">
	        <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 imgframe">
                    
				<div id="demo" class="carousel slide" data-ride="carousel">

				  <!-- Indicators -->
				  <ul class="carousel-indicators">
				  @foreach($blog_images as $key => $image)
					<li data-target="#demo" data-slide-to="{{ $key }}" class="<?php if($key=0) { ?>active<?php } ?>"></li>
				 @endforeach
				  </ul>
				  
				  <!-- The slideshow -->
				  <div class="carousel-inner">
					@foreach($blog_images as $key1 => $image_slide)
					<div class="carousel-item <?php if($key1==0) { ?> active<?php } ?>">
					  <img src="{{ asset($image_slide['image']) }}" alt="{{ $image_slide['alt_text'] }}" >
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
            <div class="row single_blog_meta">
                <div class="col-sm-12">
                    <div class="blog_author">
                        <img src="{{ asset('public/assets/images/author_icon.png') }}">
                        <div class="author_name red">{{ getSinglerow('user','name',array('user_id'=>$blog_list->created_by)) }}</div>
                    </div>
                    <div class="blog_time">
                        <img src="{{ asset('public/assets/images/time_icon.png') }}">
                        <div class="time_single red">{{ day_ago($blog_list->created_at) }}</div>
                    </div>
                </div>
                
            </div>
            <div class="row">
                <div class="col-sm-12">
                    <div class="single_blog_title black">
					{{ $blog_list->title }}
                    </div>
                </div>
            </div>  
            <div class="row">
                <div class="col-sm-12">
                    <div class="single_category">{{ $blog_list->cat_name }}</div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12">
                    <div class="single_content">
                       {!! $blog_list->description !!}
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12">
                    <div class="social_share">
                        Share this post 
						<?php 
						$url=url(Request::segment(1).'/'.Request::segment(2));
						?>
                        <a target="_blank" href="https://facebook.com/sharer/sharer.php?u={{ $url }}"><img src="{{ asset('public/assets/images/icon_facebook.svg') }}"></a>
                        <a target="_blank" href="https://twitter.com/share?url={{ $url }}"><img src="{{ asset('public/assets/images/icon_twitter.svg') }}"></a> 
                        <a style="display:none" target="_blank" href="#"><img src="{{ asset('public/assets/images/icon_instagram.svg') }}"></a> 
                        <a target="_blank" href="https://pinterest.com/pin/create/bookmarklet/?media={{ $url }}"><img src="{{ asset('public/assets/images/icon_pinterest.svg') }}"></a> 
                    </div>
                </div>
            </div>
            <hr class="custom_line">
            <div class="row single_related">
                <div class="col-md-12">
                    <div class="single_related_title">
                        Related Blog
                    </div>
                </div>
               <?php foreach($latest_list as $list): ?>
			   <div class="col-sm-6">
                    <a href="{{ url('blog-single/'.$list['slug']) }}">
                        <div class="left_arrow arrow">
                            <!--<img class="left_arrow" src="{{ asset('public/assets/images/icon_left_arrow.svg') }}">-->
                            <div class="single_related_bottom">
                                <div class="bottom_img">
                                    <img alt="{{ blog_image_alt($list['reffrence']) }}" src="{{ asset(blog_image($list['reffrence'])) }}">
                                </div>
                                <div class="single_bottom_title">
								{{ $list['title'] }}
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
			<?php endforeach; ?>
            </div>
			
			<form action="{{ url('blog_comment') }}" class="database_operation_form">
			<div class="row single_comment">
                <div class="col-md-12">
                    <div class="single_comment_title">
                        Leave a comment
                    </div>
                </div>
				@if(Session::get('usersession'))
                <div class="col-md-12 type_comment">
				{{ csrf_field() }}
                    <label>Your Comment</label>
					<input type="hidden" name="blog_id" value="{{ $blog_list->id }}" />
					<input type="hidden" name="user_id" value="{{ Session::get('usersession')->user_id }}" />
                     <textarea class="form-control" rows="7" required name="comment" placeholder="Type your comment..."></textarea>
                </div>
                <div class="col-md-12">
                    <button class="custom_btn">Submit</button>
                </div>
				@else 
				<div class="col-md-12">
                    <p>Please login for comment this blog 
					<a title="Login" href="javascript:void(0);" class="btn-secondary btn-sm d-inline-block mx-2 my-account pay-online-btn my-2 my-md-0" data-toggle="modal" data-target="#loginModal">Login</a>
					</p>
                </div>
				@endif
            </div>
			</form>
	    </div>
	    <div class="col-md-3">
	        <div class="sidebar_item"> 
    	        <div class="sidebar_title red">
    	            Related Blog
    	        </div>
	            <div class="recent_blog">
	                @foreach($related_list as $rlist)
					<a href="{{ url('blog-single/'.$rlist['slug']) }}">
    	                <div class="recent_single_blog">
        	                <div class="blog_thumb">
        	                    <img src="{{ asset(blog_image($rlist['reffrence'])) }}" alt="{{ blog_image_alt($rlist['reffrence']) }}">
        	                </div>
        	                <div class="recent_title">
							{{ $rlist['title'] }}
        	                </div>
        	                <div class="recent_blog_meta">{{ day_ago($rlist['created_at']) }}</div>
    	                </div>
	                </a>
	                @endforeach
	            </div>
	        </div>
	        <div class="sidebar_item">
    	        <div class="sidebar_title red">
    	            Tags
					<?php 
					$tags=$blog_list->tags;
					if($tags)
					{
						$tags=explode(',',$tags);
					}
					else
					{
						$tags=array();
					}
					?>
    	        </div>
	            <div class="tags">
	               @foreach($tags as $tag)
	               @if($tag!='')
					<a href="{{ url('blog/'.strtolower(str_replace(' ','-',$tag))) }}">
	                    <div class="d-inline-block border-0 rounded bg-666 text-white text-capitalize mb-2 p-1">{{ $tag }}</div>
	                </a>
	                @endif
	                @endforeach
	            </div>
	        </div>
	    </div>
	</div>
</div> 
@endsection