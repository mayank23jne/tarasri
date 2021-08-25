@extends('layouts.app')
@section('title',getSinglerow('seo_meta','title',array('page_name'=>'blog-list')))
@section('seo_description',getSinglerow('seo_meta','description',array('page_name'=>'blog-list')))
@section('seo_keywords',getSinglerow('seo_meta','keywords',array('page_name'=>'blog-list')))
@section('content')
<style> 
nav.navbar.navbar-expand-md.p-0.nav-menu {
    margin-bottom: 8px;
}
</style>
<div class="container border-top ">
    
	<div class="row my_blog">
	    <div class="col-md-9 show_result">
		@if($blog_list)
		
		    <!--This is for mobile (start)-->
	        <div class="sidebar_item mobile">
    	        <div class="filter-by-heading">
    	            Search
    	        </div>
	            <div class="search">
	                <input type="text" id="search_blog" placeholder="Search">
	                <img src="{{ asset('public/assets/images/search_icon.png') }}">
	            </div>
	        </div>
	        <!--This is for mobile (end)-->
	        
	        <!--This is for mobile (start)-->
	        <div class="sidebar_item mobile">
	            <div class="filter-by-heading">
    	            Filter by:
    	        </div>
    	        <div class="collapse show d-md-block" id="filterCollapse">
                    <div class="filter-type mb-3">
                        <div data-toggle="collapse" data-target="#collapseCollectionName" class="pointer mb-2 position-relative filter-heading" aria-expanded="true">
                            Category 
                        </div>
                        <div class="collapse" id="collapseCollectionName" style="">
                            <ul class="list-unstyled m-0">
								@foreach($category as $cat)
                                    <li>
                                        <label class="options-checkbox position-relative pointer">
                                            <input class="left_filter_blog"  name="category" value="{{ $cat['id'] }}" type="checkbox">
                                            <span class="custom-checkbox"></span>
                                            <span>{{ $cat['name'] }}</span>
                                        </label>
                                    </li>
									@endforeach
                                </ul>
                        </div>
                    </div>
					<div class="filter-type mb-3">
                        <div data-toggle="collapse" data-target="#collapseCollectionName1" class="pointer mb-2 position-relative filter-heading" aria-expanded="true">
                            Product Category 
                        </div>
                        <div class="collapse" id="collapseCollectionName1" style="">
                            <ul class="list-unstyled m-0">
								@foreach($product_category as $pcat)
                                    <li>
                                        <label class="options-checkbox position-relative pointer">
                                            <input class="left_filter_blog"  name="pcategory" value="{{ $pcat['id'] }}" type="checkbox">
                                            <span class="custom-checkbox"></span>
                                            <span>{{ $pcat['categorey_name'] }}</span>
                                        </label>
                                    </li>
									@endforeach
                                </ul>
                        </div>
                    </div>
                    <div class="filter-type mb-3">
                        <div data-toggle="collapse" data-target="#collapseItemType" class="pointer mb-2 position-relative filter-heading">
                            Stone wise
                        </div>
                        <div class="collapse" id="collapseItemType">
                            <ul class="list-unstyled m-0  category-sec">
							@foreach($gemstone as $stone)
                                    <li>
                                        <label class="options-checkbox position-relative pointer">
                                            <input class="left_filter_blog" value="{{ $stone['id'] }}" name="stone" type="checkbox">
                                            <span class="custom-checkbox"></span>
                                            <span>
											{{ $stone['name'] }}
                                            </span>
                                        </label>
                                    </li>
							@endforeach
                            </ul>
                        </div>
                    </div>
                    <div class="filter-type mb-3">
                        <div data-toggle="collapse" data-target="#collapseItemStyle" class="pointer mb-2 position-relative filter-heading">
                            <!--Style--> Occassions wise 
                        </div>
                        <div class="collapse" id="collapseItemStyle">
                            <ul class="list-unstyled m-0 occation-sec">
                               @foreach($occassion as $occ)
                                    <li>
                                        <label class="options-checkbox position-relative pointer">
                                            <input name="occassion" class="left_filter_blog" value="{{ $occ['id'] }}" type="checkbox">
                                            <span class="custom-checkbox"></span>
                                            <span>{{ $occ['occassion_name'] }}</span>
                                        </label>
                                    </li>
                                @endforeach
                                </ul>
                        </div>
                    </div>
                    <div class="filter-type mb-3">
                        <div data-toggle="collapse" data-target="#collapseGender" class="pointer mb-2 position-relative filter-heading">
                            Collection wise 
                        </div>
                        <div class="collapse" id="collapseGender">
                            <ul class="list-unstyled m-0">
							@foreach($collection as $col)
                                <li>
                                    <label class="options-checkbox position-relative pointer">
                                        <input class="left_filter_blog" type="checkbox" value="{{ $col['id'] }}" name="collection">
                                        <span class="custom-checkbox"></span>
                                        <span>{{ $col['collection_name'] }}</span>
                                    </label>
                                </li>
							@endforeach
                            </ul>
                        </div>
                    </div>
                    
                </div>
	        </div>
	        <!--This is for mobile (end)-->
		
	        <div class="row ">
    	      @foreach($blog_list as $blog)
				<div class="col-md-4">
				<a href="{{ url('blog-single/'.$blog['slug']) }}">
    		    <div class="blog_list_box" style="background-image: url({{ url(blog_image($blog['reffrence'])) }})">
    		        <div class="blog_list_content">
    		            
    		            
        		            <div class="blog_title">
        		                {{ $blog['title'] }}
        		            </div>
							<div class="content_head">
        		            <div class="blog_meta">
								{{ day_ago($blog['created_at']) }}
								</div>
							   
									<div class="blog_category red">
									{{ $blog['cat_name'] }}
									</div>
							   
							</div>
    		            
    		        </div>
    		    </div>
        		</a>
				</div>
				
				@endforeach
        	</div>
			@if(count($blog_list)>12)
        	<div class="row">
        		<div class="load_more"> 
        		    <a href="#">Load more</a> 
        		</div>
    		</div>
			@endif
			@else 
			<div class="col-sm-12">
				<h2>
				    <div class="not_found"> 
				        <img src="{{ asset('public/assets/images/blog_not_found3.gif') }}"> 
				        <div class="not_found_text">Blog Not Found</div> 
				    </div>
				</h2>
			</div>
			@endif
		
	    </div>
	    
	    <div class="col-md-3"> 
	        <div class="sidebar_item desktop">
    	        <div class="filter-by-heading">
    	            Search
    	        </div>
	            <div class="search">
	                <input type="text" id="search_blog" placeholder="Search">
	                <img src="{{ asset('public/assets/images/search_icon.png') }}">
	            </div>
	        </div>
	        
	        
	        <div class="sidebar_item desktop">
	            <div class="filter-by-heading">
    	            Filter by:
    	        </div>
    	        <div class="collapse show d-md-block" id="filterCollapse">
                    <div class="filter-type mb-3">
                        <div data-toggle="collapse" data-target="#collapseCollectionName" class="pointer mb-2 position-relative filter-heading" aria-expanded="true">
                            Category 
                        </div>
                        <div class="collapse" id="collapseCollectionName" style="">
                            <ul class="list-unstyled m-0">
								@foreach($category as $cat)
                                    <li>
                                        <label class="options-checkbox position-relative pointer">
                                            <input class="left_filter_blog"  name="category" value="{{ $cat['id'] }}" type="checkbox">
                                            <span class="custom-checkbox"></span>
                                            <span>{{ $cat['name'] }}</span>
                                        </label>
                                    </li>
									@endforeach
                                </ul>
                        </div>
                    </div>
					<div class="filter-type mb-3">
                        <div data-toggle="collapse" data-target="#collapseCollectionName2" class="pointer mb-2 position-relative filter-heading" aria-expanded="true">
                            Product Category 
                        </div>
                        <div class="collapse" id="collapseCollectionName2" style="">
                            <ul class="list-unstyled m-0">
								@foreach($product_category as $pcat)
                                    <li>
                                        <label class="options-checkbox position-relative pointer">
                                            <input class="left_filter_blog"  name="pcategory" value="{{ $pcat['id'] }}" type="checkbox">
                                            <span class="custom-checkbox"></span>
                                            <span>{{ $pcat['categorey_name'] }}</span>
                                        </label>
                                    </li>
								@endforeach
                            </ul>
                        </div>
                    </div>
                    <div class="filter-type mb-3">
                        <div data-toggle="collapse" data-target="#collapseItemType" class="pointer mb-2 position-relative filter-heading">
                            Stone wise
                        </div>
                        <div class="collapse" id="collapseItemType">
                            <ul class="list-unstyled m-0  category-sec">
							@foreach($gemstone as $stone)
                                    <li>
                                        <label class="options-checkbox position-relative pointer">
                                            <input class="left_filter_blog" value="{{ $stone['id'] }}" name="stone" type="checkbox">
                                            <span class="custom-checkbox"></span>
                                            <span>
											{{ $stone['name'] }}
                                            </span>
                                        </label>
                                    </li>
							@endforeach
                            </ul>
                        </div>
                    </div>
                    <div class="filter-type mb-3">
                        <div data-toggle="collapse" data-target="#collapseItemStyle" class="pointer mb-2 position-relative filter-heading">
                            <!--Style--> Occassions wise 
                        </div>
                        <div class="collapse" id="collapseItemStyle">
                            <ul class="list-unstyled m-0 occation-sec">
                               @foreach($occassion as $occ)
                                    <li>
                                        <label class="options-checkbox position-relative pointer">
                                            <input name="occassion" class="left_filter_blog" value="{{ $occ['id'] }}" type="checkbox">
                                            <span class="custom-checkbox"></span>
                                            <span>{{ $occ['occassion_name'] }}</span>
                                        </label>
                                    </li>
                                @endforeach
                                </ul>
                        </div>
                    </div>
                    <div class="filter-type mb-3">
                        <div data-toggle="collapse" data-target="#collapseGender" class="pointer mb-2 position-relative filter-heading">
                            Collection wise 
                        </div>
                        <div class="collapse" id="collapseGender">
                            <ul class="list-unstyled m-0">
							@foreach($collection as $col)
                                <li>
                                    <label class="options-checkbox position-relative pointer">
                                        <input class="left_filter_blog" type="checkbox" value="{{ $col['id'] }}" name="collection">
                                        <span class="custom-checkbox"></span>
                                        <span>{{ $col['collection_name'] }}</span>
                                    </label>
                                </li>
							@endforeach
                            </ul>
                        </div>
                    </div>
                    
                </div>
	        </div>
	        
	        <div class="sidebar_item"> 
    	        <div class="filter-by-heading">
    	            Recent Blog
    	        </div>
	            <div class="recent_blog">
	              @foreach($latest_list as $list)
					<a href="{{ url('blog-single/'.$list['slug']) }}">
    	                <div class="recent_single_blog">
        	                <div class="blog_thumb">
        	                    <img src="{{ url(blog_image($list['reffrence'])) }}" alt="{{ blog_image_alt($list['reffrence']) }}" >
        	                </div>
        	                <div class="recent_title">
							{{ $list['title'] }}
        	                </div>
        	                <div class="recent_blog_meta">{{ day_ago($list['created_at']) }}</div>
    	                </div>
	                </a>
				   @endforeach
	            </div>
	        </div>
	        <!--<div class="sidebar_item">
    	        <div class="filter-by-heading">
    	            Tags
    	        </div>
	            <div class="tags">
				@foreach(get_all_blog_tags() as $tag)
				@if($tag!='')
				   <a href="{{ url('blog/'.strtolower(str_replace(' ','-',$tag))) }}">
	                    <div class="d-inline-block border-0 rounded bg-666 text-white text-capitalize mb-2 p-1">{{ $tag }}</div>
	                </a> 
	            @endif
	            @endforeach
	            </div>
	        </div>-->
	    </div>
	    
	    
	    
	    
		
		
		
	</div>
</div>
@endsection