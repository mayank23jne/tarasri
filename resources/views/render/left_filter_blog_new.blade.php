@if(isset($blog_limit))
	@if($blog_list)
		<input type="hidden" id="blog-load-more-offset" value="2">
		<div class="blog_listing load-more-blog" id="section_four">
			@foreach($blog_list as $blog)
			<div class="single_listing">
				<div class="sl_image">
					<img src="{{ url(blog_image($blog['reffrence'])) }}">
				</div>
				<div class="sl_content">
					<div class="sl_date light">{{date('d M Y', strtotime($blog['created_at']))}}</div>
					<div class="sl_heading"><a href="{{url('blog').'/'.str_replace(' ','-',$blog['slug'])}}">{{ $blog['title'] }}</a></div>
					<div class="sl_category bold">{{ $blog['cat_name'] }}</div>
				</div>
			</div>
			@endforeach
		</div>
		@if(count($blog_list)==10)
		<div class="load_more">
			<a href="javascript:;" class="load_more_btn size_15">Load More</a>
		</div>
		@endif
	@else 
		<div class="col-sm-12">
			<h2>
				<div class="not_found text-center"> 
					<img height="200" src="{{ asset('public/assets/images/blog_not_found3.gif') }}"> 
					<div class="not_found_text">Blog Not Found</div> 
				</div>
			</h2>
		</div>
	@endif
@else
	@if($blog_list)
		@foreach($blog_list as $blog)
		<div class="single_listing">
			<div class="sl_image">
				<img src="{{ url(blog_image($blog['reffrence'])) }}">
			</div>
			<div class="sl_content">
				<div class="sl_date light">{{date('d M Y', strtotime($blog['created_at']))}}</div>
				<div class="sl_heading"><a href="{{url('blog').'/'.str_replace(' ','-',$blog['slug'])}}">{{ $blog['title'] }}</a></div>
				<div class="sl_category bold">{{ $blog['cat_name'] }}</div>
			</div>
		</div>
		@endforeach
		<input type="hidden" id="blog-count" value="{{count($blog_list)}}">
		@if(count($blog_list)==10)
		<div class="load_more">
			<a href="javascript:;" class="load_more_btn size_15">Load More</a>
		</div>
		@endif
	@else 
		@if($load_more_button_count==0)
		<div class="col-sm-12">
			<h2>
				<div class="not_found text-center"> 
					<img height="200" src="{{ asset('public/assets/images/blog_not_found3.gif') }}"> 
					<div class="not_found_text">Blog Not Found</div> 
				</div>
			</h2>
		</div>
		@endif
	@endif
@endif