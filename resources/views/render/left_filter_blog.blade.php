@if($blog_list)
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