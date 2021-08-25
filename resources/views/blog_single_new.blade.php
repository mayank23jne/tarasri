@extends('layouts.app')
@section('title','Blog Single')
@section('seo_description',getSinglerow('seo_meta','description',array('page_name'=>'aboutus-user')))
@section('seo_keywords',getSinglerow('seo_meta','keywords',array('page_name'=>'aboutus-user')))
@section('content')
<style>
 h1 { margin:150px auto 30px auto; text-align:center;}
    .clearfix:after {
        content: ".";
        display: block;
        height: 0;
        clear: both;
        visibility: hidden
    }

    .clearfix {
        *+height: 1%;
    }

    .container-slider {
        /* height: 300px; */
        margin:30px auto;
    }

    .container-slider ul {}

    .container-slider ul li {
         border:1px solid #fff;
    }

    .container-slider ul li img {}

    .left,
    .right {
        cursor: pointer;
    }
</style>
<section class="blog_single">
<div class="container">
    <div class="row">
        <div class="col-md-12">
			@if(count($blog_images)>2)
            <div class="blog_slider blog-carousel">
				<div class="container-slider" id="container" style="margin-top: -25px !important;">
					<ul>
						@foreach($blog_images as $key=>$image)
						<li> <img src="{{url($image['image'])}}" alt="" /> </li>
						<?php if($key>7){ break; } ?>
						@endforeach
						<img src="{{url('public/assets/plugins/blog-carousal/img/left_arrow.svg')}}" class="left">
						<img src="{{url('public/assets/plugins/blog-carousal/img/right_arrow.svg')}}" class="right">
					</ul>
				</div>
            </div>
			@endif
            <div class="blog_autor">
                <div class="author_image">
                    <img src="{{ asset('public/assets/images/blog_author.jpg') }}">
                </div>
                <div class="author_category size_20 dark_grey bold">
                    {{ $blog_list->cat_name }}
                </div>
                <div class="author_name size_17 dark_grey">
                    by {{ getSinglerow('user','name',array('user_id'=>$blog_list->created_by)) }}
                </div>
            </div>
        </div>
    </div>
</div>

<div class="container blog_container blog_single_desc">
    <div class="row">
        <div class="col-lg-3 sibebar" id="single_order_one">
            <div class="sidebar_section">
                <div class="recent_blog">
                    <div class="filter_title size_15 dark_grey" style="margin-top: 2px;">Recent Blogs</div>
                    @foreach($latest_list as $list)
					<a href="{{url('blog-single/').'/'.str_replace(' ','-',$list['slug'])}}">
                    <div class="single_blog_entry">
                        <div class="sbe_image">
                            <img src="{{ url(blog_image($list['reffrence'])) }}" alt="{{ blog_image_alt($list['reffrence']) }}" >
                        </div>
                        <div class="sbe_content">
                            <div class="sbe_time light">{{ day_ago($list['created_at']) }}</div>
                            <div class="sbe_category" style="font-size: 13px !important;">{{ $list['cat_name'] }}</div>
                            <div class="sbe_title">{{ $list['title'] }}</div>
                        </div>
                    </div>
                    </a>
                    @endforeach
                </div>
                
                <div class="tags">
                    <div class="filter_title size_15 dark_grey">Tags</div>
					<?php 
					$tags=$blog_list->tags;
					if($tags)
					{
						$tags=explode(',',$tags);
					} else {
						$tags=array();
					}
					?>
					@foreach($tags as $tag)
	               @if($tag!='')
					<div class="tag"><a href="{{url('blog').'/'.str_replace(' ','-',$tag)}}">{{ $tag }}</a></div>
	                @endif
	                @endforeach
                </div>
            </div>
        </div>
        <div class="col-lg-1 top_margin" id="single_order_two">
            <div class="blog_meta">
                <div class="blog_date">
                    <div class="bm_line"></div>
                    <div class="bm_date playfair-normal dark_grey">23</div>
                    <div class="bm_month size_17 dark_grey">Jan</div>
                </div>
                <div class="blog_social">
					<?php 
					$url=url(Request::segment(1).'/'.Request::segment(2));
					?>
                    <div class="bs_icon">
                        <a href="https://facebook.com/sharer/sharer.php?u={{ $url }}"><img src="{{ asset('public/assets/images/blog_icon_1.svg') }}"></a>
                    </div>
                    <div class="bs_icon">
                        <a href="https://twitter.com/share?url={{ $url }}"><img src="{{ asset('public/assets/images/blog_icon_2.svg') }}"></a>
                    </div>
                    <div class="bs_icon">
                        <a href="https://pinterest.com/pin/create/bookmarklet/?media={{ $url }}"><img src="{{ asset('public/assets/images/blog_icon_3.svg') }}"></a>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-8 top_margin" id="single_order_three">
            <div class="page_content size_17">
                <div class="category_2 size_17">{{ $blog_list->cat_name }}</div><br/>
                {!! $blog_list->description !!}
            </div>
            <div class="blog_single_comment">
				@if(Session::get('usersession'))
				<form action="{{ url('blog_comment') }}" class="database_operation_form">
				{{ csrf_field() }}
				<input type="hidden" name="blog_id" value="{{ $blog_list->id }}" />
				<input type="hidden" name="user_id" value="{{ Session::get('usersession')->user_id }}" />
                <div class="field">
                    <textarea class="form-control" rows="5" id="comment" name="comment" placeholder="Leave a Comment" class="size_19"></textarea>
                </div>
				<div class="row">
					<div class="col-md-12">
						<button class="custom_btn">Submit</button>
					</div>
                </div>
                </form>
				@else
				<div class="col-md-12">
                    <p class="size_12">Please login for comment this blog 
					<a title="Login" href="javascript:void(0);" class="btn-secondary text-white btn-sm d-inline-block mx-2 my-account pay-online-btn my-2 my-md-0" data-toggle="modal" data-target="#loginModal">Login</a>
					</p>
                </div>
				@endif
            </div>
        </div>
    </div>
</div>

</section>
<!--<script src="{{ url('') }}/public/front_assets/js/3.5.1-jquery.min.js"></script>
<script src="{{url('public/assets/plugins/blog-carousal/js/Carousel.js')}}"></script>
<script src="{{url('public/assets/plugins/blog-carousal/js/custom.js')}}"></script>-->
@endsection