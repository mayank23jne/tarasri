@extends('layouts.app')
@section('title',getSinglerow('seo_meta','title',array('page_name'=>'blog-list')))
@section('seo_description',getSinglerow('seo_meta','description',array('page_name'=>'blog-list')))
@section('seo_keywords',getSinglerow('seo_meta','keywords',array('page_name'=>'blog-list')))
@section('content')
<section class="blog">
<div class="blog_head" style="background-image: url(assets/images/header_bg.jpg);">
    <div class="blog_head_inner">
        <div class="sidebar_title">Blog</div>
        <input type="search" placeholder="Search" class="light light_cross size_13">
        
    </div>
</div>    
<div class="container blog_container">
    <div class="row">
        
        <div class="col-lg-3 sibebar">
            
             <div class="main-content">
                <dt class="description-title size_15 dark_grey">Filter By<span class="expand-collapse">&#9013;</span></dt>
                <dd class="description">
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
                            <div class="filter_options">
                              <input type="checkbox" id="design">
                              <label for="design">Design</label>
                            </div>
                            <div class="filter_options">
                              <input type="checkbox" id="gemstones">
                              <label for="gemstones">Gemstones</label>
                            </div>
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
                            <div class="filter_options">
                              <input type="checkbox" id="design">
                              <label for="design">Design</label>
                            </div>
                            <div class="filter_options">
                              <input type="checkbox" id="gemstones">
                              <label for="gemstones">Gemstones</label>
                            </div>
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
                            <div class="filter_options">
                              <input type="checkbox" id="design">
                              <label for="design">Design</label>
                            </div>
                            <div class="filter_options">
                              <input type="checkbox" id="gemstones">
                              <label for="gemstones">Gemstones</label>
                            </div>
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
                            <div class="filter_options">
                              <input type="checkbox" id="design">
                              <label for="design">Design</label>
                            </div>
                            <div class="filter_options">
                              <input type="checkbox" id="gemstones">
                              <label for="gemstones">Gemstones</label>
                            </div>
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
                            <div class="filter_options">
                              <input type="checkbox" id="design">
                              <label for="design">Design</label>
                            </div>
                            <div class="filter_options">
                              <input type="checkbox" id="gemstones">
                              <label for="gemstones">Gemstones</label>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                    </div>
                    
                </dd>
            </div>
            
            
            
            <div class="sidebar_section" id="desktop_sidebar">
                <div class="recent_blog" id="section_two">
                    <div class="filter_title size_15 dark_grey" style="margin-bottom: 13px;">Recent Blogs</div>
                    <div class="single_blog_entry">
                        <div class="sbe_image">
                            <img src="assets/images/blog_img_3.jpg">
                        </div>
                        <div class="sbe_content">
                            <div class="sbe_time light">5 hrs ago</div>
                            <div class="sbe_category" style="font-size: 13px !important;">Diamond Dream</div>
                            <div class="sbe_title">This is an small dummy text you got it I think.</div>
                        </div>
                    </div>
                    <div class="single_blog_entry">
                        <div class="sbe_image">
                            <img src="assets/images/blog_img_3.jpg">
                        </div>
                        <div class="sbe_content">
                            <div class="sbe_time light">5 hrs ago</div>
                            <div class="sbe_category" style="font-size: 13px !important;">Diamond Dream</div>
                            <div class="sbe_title">This is an small dummy text you got it I think.</div>
                        </div>
                    </div>
                    <div class="single_blog_entry">
                        <div class="sbe_image">
                            <img src="assets/images/blog_img_3.jpg">
                        </div>
                        <div class="sbe_content">
                            <div class="sbe_time light">5 hrs ago</div>
                            <div class="sbe_category" style="font-size: 13px !important;">Diamond Dream</div>
                            <div class="sbe_title">This is an small dummy text you got it I think.</div>
                        </div>
                    </div>
                </div>
                
                <div class="tags" id="section_three">
                    <div class="filter_title size_15 dark_grey">Tags</div>
                    <div class="tag"><a href="">Diamond Dream</a></div>
                    <div class="tag"><a href="">Imperial</a></div>
                    <div class="tag"><a href="">Her Highness</a></div>
                    <div class="tag"><a href="">Royal Affair</a></div>
                    <div class="tag"><a href="">Loves Embrace</a></div>
                </div>
            </div>
            
            
        </div>
        <div class="col-lg-9" id="main_content">
            <div class="blog_listing" id="section_four">
                <div class="single_listing">
                    <div class="sl_image">
                        <img src="assets/images/blog_img_1.jpg">
                    </div>
                    <div class="sl_content">
                        <div class="sl_date light">8 June 2020</div>
                        <div class="sl_heading">
                            Lorem ipsum dolor sit amet, consetetur 
                            sadipscing elitr, sed diam nonumy eirmod 
                            tempor invidunt ut labore.
                        </div>
                        <div class="sl_category bold">Vintage Romance</div>
                    </div>
                </div>
                <div class="single_listing">
                    <div class="sl_image">
                        <img src="assets/images/blog_img_2.jpg">
                    </div>
                    <div class="sl_content">
                        <div class="sl_date light">8 June 2020</div>
                        <div class="sl_heading">
                            Lorem ipsum dolor sit amet, consetetur 
                            sadipscing elitr, sed diam nonumy eirmod 
                            tempor invidunt ut labore.
                        </div>
                        <div class="sl_category bold">Imperial</div>
                    </div>
            </div>
            <div class="single_listing">
                    <div class="sl_image">
                        <img src="assets/images/blog_img_3.jpg">
                    </div>
                    <div class="sl_content">
                        <div class="sl_date light">8 June 2020</div>
                        <div class="sl_heading">
                            Lorem ipsum dolor sit amet, consetetur 
                            sadipscing elitr, sed diam nonumy eirmod 
                            tempor invidunt ut labore.
                        </div>
                        <div class="sl_category bold">Diamond Dream</div>
                    </div>
                </div>
            </div>
            <div class="blog_listing">
                <div class="single_listing">
                    <div class="sl_image">
                        <img src="assets/images/blog_img_4.jpg">
                    </div>
                    <div class="sl_content">
                        <div class="sl_date light">8 June 2020</div>
                        <div class="sl_heading">
                            Lorem ipsum dolor sit amet, consetetur 
                            sadipscing elitr, sed diam nonumy eirmod 
                            tempor invidunt ut labore.
                        </div>
                        <div class="sl_category bold">Royal Affair</div>
                    </div>
                </div>
                <div class="single_listing">
                    <div class="sl_image">
                        <img src="assets/images/blog_img_5.jpg">
                    </div>
                    <div class="sl_content">
                        <div class="sl_date light">8 June 2020</div>
                        <div class="sl_heading">
                            Lorem ipsum dolor sit amet, consetetur 
                            sadipscing elitr, sed diam nonumy eirmod 
                            tempor invidunt ut labore.
                        </div>
                        <div class="sl_category bold">Shahi Darbar</div>
                    </div>
                </div>
                <div class="single_listing">
                    <div class="sl_image">
                        <img src="assets/images/blog_img_6.jpg">
                    </div>
                    <div class="sl_content">
                        <div class="sl_date light">8 June 2020</div>
                        <div class="sl_heading">
                            Lorem ipsum dolor sit amet, consetetur 
                            sadipscing elitr, sed diam nonumy eirmod 
                            tempor invidunt ut labore.
                        </div>
                        <div class="sl_category bold">Her Highness</div>
                    </div>
                </div>
            </div>
            <div class="load_more">
                <a href="" class="size_15">Load More</a>
            </div>
        </div>
        
        <div class="col-lg-3 sibebar" id="sidebar_bottom">
            <div class="sidebar_section">
                <div class="recent_blog">
                    <div class="filter_title size_15 dark_grey" style="margin-bottom: 13px;">Recent Blogs</div>
                    <div class="single_blog_entry">
                        <div class="sbe_image">
                            <img src="assets/images/blog_img_3.jpg">
                        </div>
                        <div class="sbe_content">
                            <div class="sbe_time light">5 hrs ago</div>
                            <div class="sbe_category" style="font-size: 13px !important;">Diamond Dream</div>
                            <div class="sbe_title">This is an small dummy text you got it I think.</div>
                        </div>
                    </div>
                    <div class="single_blog_entry">
                        <div class="sbe_image">
                            <img src="assets/images/blog_img_3.jpg">
                        </div>
                        <div class="sbe_content">
                            <div class="sbe_time light">5 hrs ago</div>
                            <div class="sbe_category" style="font-size: 13px !important;">Diamond Dream</div>
                            <div class="sbe_title">This is an small dummy text you got it I think.</div>
                        </div>
                    </div>
                    <div class="single_blog_entry">
                        <div class="sbe_image">
                            <img src="assets/images/blog_img_3.jpg">
                        </div>
                        <div class="sbe_content">
                            <div class="sbe_time light">5 hrs ago</div>
                            <div class="sbe_category" style="font-size: 13px !important;">Diamond Dream</div>
                            <div class="sbe_title">This is an small dummy text you got it I think.</div>
                        </div>
                    </div>
                </div>
                
                <div class="tags">
                    <div class="filter_title size_15 dark_grey">Tags</div>
                    <div class="tag"><a href="">Diamond Dream</a></div>
                    <div class="tag"><a href="">Imperial</a></div>
                    <div class="tag"><a href="">Her Highness</a></div>
                    <div class="tag"><a href="">Royal Affair</a></div>
                    <div class="tag"><a href="">Loves Embrace</a></div>
                </div>
            </div>
            
            
        </div>
        
    </div>
</div>
    
</section>
@endsection