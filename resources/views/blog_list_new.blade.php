@extends('layouts.app')
@section('title',getSinglerow('seo_meta','title',array('page_name'=>'blog-list')))
@section('seo_description',getSinglerow('seo_meta','description',array('page_name'=>'blog-list')))
@section('seo_keywords',getSinglerow('seo_meta','keywords',array('page_name'=>'blog-list')))
@section('content')
<style>
svg.svg-inline--fa.fa-circle.fa-w-16.fa-stack-2x {
    color: #f7f8f8;
    width: 100%;
    height: 100%;
}
</style>
<section class="blog">
<div class="blog_head" style="background-image: url({{url('public/assets/images/header_bg.jpg')}});">
    <div class="blog_head_inner">
        <div class="sidebar_title">Blog</div>
		<form action="{{url('blog')}}">
			<input type="search" id="search_blog1" placeholder="Search" class="light light_cross size_13">
		</form>
    </div>
</div>    
<div class="container blog_container">
    <div class="row">
        <div class="col-lg-3 sibebar">
             <div class="main-content">
			 <div class="text-right d-md-none mb-4">
                <button class="btn bg-dark rounded-0 text-white collapsed custom_filter" data-toggle="collapse" data-target="#filterCollapseBlogNew" aria-expanded="false">
					Filter By
				</button>
			 </div>
                <div id="filterCollapseBlogNew" class="d-md-block collapse">
                    <div id="section_one">
                        <div id="accordion" class="myaccordion sidebar_section">
                      <!--<div class="filter_title size_15 dark_grey">Filter By</div>-->
                      <div class="card">
                        <div class="card-header" id="headingOne">
                          <h2 class="mb-0">
                            <button class="d-flex align-items-center justify-content-between btn btn-link collapsed" data-toggle="collapse" data-target="#collapseOne" aria-expanded="false" aria-controls="collapseOne">
                              Category
                              <span class="fa-stack fa-2x">
                                <i class="fas fa-circle fa-stack-2x"></i>
                                <i class="fas fa-angle-down fa-stack-1x fa-inverse"></i>
                              </span>
                            </button>
                          </h2>
                        </div>
                        <div id="collapseOne" class="collapse" aria-labelledby="headingOne" data-parent="#accordion">
                          <div class="card-body">
						  @foreach($category as $val)
                            <div class="filter_options">
                              <input type="checkbox" class="left_filter_blog1" name="category" value="{{$val['id']}}" id="{{str_replace(' ','-',strtolower($val['name']))}}">
                              <label for="{{str_replace(' ','-',strtolower($val['name']))}}">{{$val['name']}}</label>
                            </div>
							@endforeach
                          </div>
                        </div>
                      </div>
                      <div class="card">
                        <div class="card-header" id="headingTwo">
                          <h2 class="mb-0">
                            <button class="d-flex align-items-center justify-content-between btn btn-link collapsed" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                              Product Category
                              <span class="fa-stack fa-2x">
                                <i class="fas fa-circle fa-stack-2x"></i>
                                <i class="fas fa-angle-down fa-stack-1x fa-inverse"></i>
                              </span>
                            </button>
                          </h2>
                        </div>
                        <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordion">
                          <div class="card-body">
						  @foreach($product_category as $val)
                            <div class="filter_options">
                              <input class="left_filter_blog1" name="pcategory" value="{{$val['id']}}" type="checkbox" id="{{str_replace(' ','-',strtolower($val['categorey_name']))}}">
                              <label for="{{str_replace(' ','-',strtolower($val['categorey_name']))}}">{{$val['categorey_name']}}</label>
                            </div>
							@endforeach
                          </div>
                        </div>
                      </div>
                      <div class="card">
                        <div class="card-header" id="headingThree">
                          <h2 class="mb-0">
                            <button class="d-flex align-items-center justify-content-between btn btn-link collapsed" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                              Stone Wise
                              <span class="fa-stack fa-2x">
                                <i class="fas fa-circle fa-stack-2x"></i>
                                <i class="fas fa-angle-down fa-stack-1x fa-inverse"></i>
                              </span>
                            </button>
                          </h2>
                        </div>
                        <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordion">
                          <div class="card-body">
						  @foreach($gemstone as $val)
                            <div class="filter_options">
                              <input class="left_filter_blog1" name="stone" value="{{$val['id']}}" type="checkbox" id="{{str_replace(' ','-',strtolower($val['name']))}}">
                              <label for="{{str_replace(' ','-',strtolower($val['name']))}}">{{$val['name']}}</label>
                            </div>
							@endforeach
                          </div>
                        </div>
                      </div>
                      <div class="card">
                        <div class="card-header" id="headingFour">
                          <h2 class="mb-0">
                            <button class="d-flex align-items-center justify-content-between btn btn-link collapsed" data-toggle="collapse" data-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
                              Occasions Wise
                              <span class="fa-stack fa-2x">
                                <i class="fas fa-circle fa-stack-2x"></i>
                                <i class="fas fa-angle-down fa-stack-1x fa-inverse"></i>
                              </span>
                            </button>
                          </h2>
                        </div>
                        <div id="collapseFour" class="collapse" aria-labelledby="headingFour" data-parent="#accordion">
                          <div class="card-body">
                            @foreach($occassion as $val)
                            <div class="filter_options">
                              <input class="left_filter_blog1" name="occassion" value="{{$val['id']}}" type="checkbox" id="{{str_replace(' ','-',strtolower($val['occassion_name']))}}">
                              <label for="{{str_replace(' ','-',strtolower($val['occassion_name']))}}">{{$val['occassion_name']}}</label>
                            </div>
							@endforeach
                          </div>
                        </div>
                      </div>
                      <div class="card">
                        <div class="card-header" id="headingFive">
                          <h2 class="mb-0">
                            <button class="d-flex align-items-center justify-content-between btn btn-link collapsed" data-toggle="collapse" data-target="#collapseFive" aria-expanded="false" aria-controls="collapseFive">
                              Collection Wise
                              <span class="fa-stack fa-2x">
                                <i class="fas fa-circle fa-stack-2x"></i>
                                <i class="fas fa-angle-down fa-stack-1x fa-inverse"></i>
                              </span>
                            </button>
                          </h2>
                        </div>
                        <div id="collapseFive" class="collapse" aria-labelledby="headingFive" data-parent="#accordion">
                          <div class="card-body">
                            @foreach($collection as $val)
                            <div class="filter_options">
                              <input class="left_filter_blog1" name="collection" value="{{$val['id']}}" type="checkbox" id="{{str_replace(' ','-',strtolower($val['collection_name']))}}">
                              <label for="{{str_replace(' ','-',strtolower($val['collection_name']))}}">{{$val['collection_name']}}</label>
                            </div>
							@endforeach
                          </div>
                        </div>
                      </div>
                    </div>
                    </div> 
                </div>
            </div>
            <div class="sidebar_section" id="desktop_sidebar">
                <div class="recent_blog" id="section_two">
                    <div class="filter_title size_15 dark_grey" style="margin-bottom: 13px;">Recent Blogs</div>
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
                
                <div class="tags" id="section_three">
                    <div class="filter_title size_15 dark_grey">Tags</div>
					@foreach(array_unique(get_all_blog_tags()) as $val)
                    <div class="tag"><a href="{{url('blog').'/'.str_replace(' ','-',$val)}}">{{$val}}</a></div>
					@endforeach
                </div>
            </div>
        </div>
        <div class="col-lg-9" id="main_content">
			<input type="hidden" id="blog-load-more-offset" value="10">
            <div class="blog_listing load-more-blog show_result" id="section_four">
				@foreach($blog_list as $blog)
                <div class="single_listing">
                    <div class="sl_image">
                        <img src="{{ url(blog_image($blog['reffrence'])) }}">
                    </div>
                    <div class="sl_content">
                        <div class="sl_date light">{{date('d M Y', strtotime($blog['created_at']))}}</div>
                        <div class="sl_heading"><a href="{{url('blog-single/').'/'.str_replace(' ','-',$blog['slug'])}}">{{ $blog['title'] }}</a></div>
                        <div class="sl_category bold">{{ $blog['cat_name'] }}</div>
                    </div>
                </div>
				@endforeach
				@if($blog_list_count>10)
				<div class="load_more">
					<a href="javascript:;" class="load_more_btn size_15">Load More</a>
				</div>
				@endif
            </div>
        </div>
        
        <div class="col-lg-3 sibebar" id="sidebar_bottom">
            <div class="sidebar_section">
                <div class="recent_blog">
                    <div class="filter_title size_15 dark_grey" style="margin-bottom: 13px;">Recent Blogs</div>
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
					@foreach(array_unique(get_all_blog_tags()) as $val)
                    <div class="tag"><a href="{{url('blog').'/'.str_replace(' ','-',$val)}}">{{$val}}</a></div>
					@endforeach
                </div>
            </div>
            
            
        </div>
        
    </div>
</div>
    
</section>

<script>
    $("#accordion").on("hide.bs.collapse show.bs.collapse", e => {
  $(e.target)
    .prev()
    .find("i:last-child")
    .toggleClass("fa-angle-down fa-angle-up");
});

</script>


<!--filter toggle in mobile view-->
<script>
if (document.readyState !== 'loading') {
    console.log("ready!");
    ready();
} else {
    document.addEventListener('DOMContentLoaded', ready);
}

function ready() {
    var accordion = document.getElementsByTagName("dt");

    for (var i = 0; i<accordion.length; i++){
        accordion[i].addEventListener('click', function(){
            accordionClick(event);
        
        });
    }
}

var accordionClick = (eventHappened) => {
    console.log(eventHappened);
    var targetClicked =event.target;
    console.log(targetClicked);
    var classClicked = targetClicked.classList;
    console.log("target clicked: " + targetClicked);
    console.log(classClicked[0]);
    while ((classClicked[0] !="description-title")){
        console.log("parent element: " + targetClicked.parentElement);
        targetClicked = targetClicked.parentElement;
        classClicked = targetClicked.classList;
        console.log("target clicked while in loop:" + targetClicked);
        console.log("class clicked while in loop: " + classClicked);
    }
    var description = targetClicked.nextElementSibling;
    console.log(description);
    var expander = targetClicked.children[0];
    if (description.style.maxHeight){
        description.style.maxHeight = null;
        expander.innerHTML = "&#9013;"
        
    }
    else {
        var allDescriptions = document.getElementsByTagName("dd");
        for (var i = 0; i < allDescriptions.length; i++){
            console.log("current description: " + allDescriptions[i]);
            if (allDescriptions[i].style.maxHeight){
                console.log("there is a description already open");
                allDescriptions[i].style.maxHeight = null;
                allDescriptions[i].previousElementSibling.children[0].innerHTML = "&#9013;"
            }
        }
        description.style.maxHeight = description.scrollHeight + "px";
        expander.innerHTML = "&#9747;";
        
    }
}
</script>

@endsection