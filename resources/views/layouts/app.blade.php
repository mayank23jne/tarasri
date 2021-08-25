<!DOCTYPE html>
<html lang="en">
<head>
	<script>
		var BASE_URL = "{{ url('') }}";
	</script>
	@php
	$user_agent = $_SERVER['HTTP_USER_AGENT'];
	$browser = "";
	if(stripos($user_agent,'Chrome') !== false)
	{
		$browser = "Chrome";
	} elseif(stripos($user_agent,'Safari') !== false) {
		$browser = "Safari";
	} elseif(preg_match('/Firefox/i', $user_agent)) {
		$browser = "FireFox";
	} else {
		$browser = "Other";
	}
	@endphp
	 <meta charset="utf-8">
	 <title>@yield('title')</title>
	 <meta name="description" content="@yield('seo_description')">
	 <meta name="keywords" content="@yield('seo_keywords')">
	 <meta name="author" content="{{ get_setting('site_author') }}">
	 <meta name="viewport" content="width=device-width, initial-scale=1.0">
	 {!! get_setting('head_script') !!}
	<!-- Le styles -->
	<link rel="icon" href="{{ url(get_setting('fevicon')) }}" type="image/gif" sizes="16x16">
	<link href="{{ url('') }}/public/front_assets/css/bootstrap/bootstrap.min.css" @if($browser == 'Chrome') media="screen" rel="preload" as="style" onload="this.onload=null;this.rel='stylesheet'" @else rel="stylesheet" @endif type="text/css">
	<!--<link href="{{ url('') }}/public/front_assets/css/fontawesome/fontawesome.min.css" @if($browser == 'Chrome') media="screen" rel="preload" as="style" onload="this.onload=null;this.rel='stylesheet'" @else rel="stylesheet" @endif type="text/css">-->
	<link href="{{ url('') }}/public/front_assets/css/fontawesome/fontawesome-all.min.css" @if($browser == 'Chrome') media="screen" rel="preload" as="style" onload="this.onload=null;this.rel='stylesheet'" @else rel="stylesheet" @endif type="text/css">
	<link href="{{ url('') }}/public/front_assets/css/animate.min.css" @if($browser == 'Chrome') media="screen" rel="preload" as="style" onload="this.onload=null;this.rel='stylesheet'" @else rel="stylesheet" @endif type="text/css">
	<link href="{{ url('') }}/public/front_assets/css/owl-carousel/owl.carousel.min.css" @if($browser == 'Chrome') media="screen" rel="preload" as="style" onload="this.onload=null;this.rel='stylesheet'" @else rel="stylesheet" @endif type="text/css">
	<link href="{{ url('') }}/public/front_assets/css/owl-carousel/owl.theme.default.min.css" @if($browser == 'Chrome') media="screen" rel="preload" as="style" onload="this.onload=null;this.rel='stylesheet'" @else rel="stylesheet" @endif type="text/css">
	<!--<link href="{{ url('') }}/public/front_assets/css/jquery.mCustomScrollbar.min.css" @if($browser == 'Chrome') media="screen" rel="preload" as="style" onload="this.onload=null;this.rel='stylesheet'" @else rel="stylesheet" @endif type="text/css">-->
	@if(!isset($load_home_utility))
	<link href="{{ url('') }}/public/front_assets/css/tinymce.min.css" @if($browser == 'Chrome') media="screen" rel="preload" as="style" onload="this.onload=null;this.rel='stylesheet'" @else rel="stylesheet" @endif type="text/css">
	@endif
	<link href="{{ url('') }}/public/front_assets/css/1.12.1-jquery-ui.min.css" @if($browser == 'Chrome') media="screen" rel="preload" as="style" onload="this.onload=null;this.rel='stylesheet'" @else rel="stylesheet" @endif type="text/css">
	<!--<link rel="preload" as="style" onload="this.onload=null;this.rel='stylesheet'" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.css" />-->
	<link href="{{ url('') }}/public/front_assets/css_web/easyzoom.css" @if($browser == 'Chrome') media="screen" rel="preload" as="style" onload="this.onload=null;this.rel='stylesheet'" @else rel="stylesheet" @endif type="text/css">
	<link href="{{ url('') }}/public/front_assets/css/lightslider.min.css" @if($browser == 'Chrome') media="screen" rel="preload" as="style" onload="this.onload=null;this.rel='stylesheet'" @else rel="stylesheet" @endif type="text/css">
	
	<link href="{{ url('') }}/public/front_assets/css_web/style.css" @if($browser == 'Chrome') media="screen" rel="preload" as="style" onload="this.onload=null;this.rel='stylesheet'" @else rel="stylesheet" @endif type="text/css">
	@if(Request::segment(1)=='contact-us' || Request::segment(1)=='about'  || Request::segment(1)=='collection-single' || Request::segment(1)=='landing-page' || Request::segment(1)=='blog' || Request::segment(1)=='blog-single' || Request::segment(1)=='test')
	<link href="{{ url('') }}/public/front_assets/css_web/newstyle.css" @if($browser == 'Chrome') media="screen" rel="preload" as="style" onload="this.onload=null;this.rel='stylesheet'" @else rel="stylesheet" @endif type="text/css">
	@endif

	@if(!isset($load_home_utility))
	<link href="{{ url('') }}/public/front_assets/css_web/blog.css" @if($browser == 'Chrome') media="screen" rel="preload" as="style" onload="this.onload=null;this.rel='stylesheet'" @else rel="stylesheet" @endif type="text/css">
	@endif
	@if(Request::segment(1)=='about')
	<link href="{{ url('') }}/public/front_assets/pages/css/about.css" @if($browser == 'Chrome') media="screen" rel="preload" as="style" onload="this.onload=null;this.rel='stylesheet'" @else rel="stylesheet" @endif type="text/css">
	@endif
	<script src="https://www.google.com/recaptcha/api.js"></script>
</head>
<body @if(Request::segment(1)=="") id="main" @else id="{{Request::segment(1)}}" @endif class="d-flex flex-column @if(isset(Request::segments()[1])) @if(Request::segments()[count(Request::segments())-1]=='tara-mask') tara-mask @endif @endif">
<div class="overlay" style="width: 100%;height: 3000px;background: #fff;position: absolute;z-index: 999999;text-align: center;padding-top: 200px;" id="page_overlay">
<img src="{{ url('public/assets/images/ajax-loader.gif') }} " />
</div>
{{ csrf_field() }}
{!! get_setting('body_script') !!}
	<div class="container-fluid navbar-fluid p-0">
		<div class="container">
			<div class="custom-nav pt-2 text-right d-flex flex-column-reverse flex-md-column">
				<form action="{{ url('collection-list') }}" method="get">
				<div class="account">
					<div class="d-inline-flex align-items-center flex-row-reverse flex-md-row account_button_block">
						
							<div class="d-flex align-items-center justify-content-end searchbar-box">
								<div class="position-relative searchbar fadeIn animated d-none mr-3">
									<input name="search" type="text" placeholder="Search here..." id="search_field" class="global-search-jewel rounded p-1 border">
								</div>
								<a title="Search" href="javascript:void(0);" class="searchbar-icon">
									<img src="{{ url('') }}/public/assets/images/search.svg">
								</a>
							</div>
						
						@if(!Session::get('usersession'))
						<a title="Login" href="javascript:void(0);" class="d-inline-block mx-2 my-account" data-toggle="modal" data-target="#loginModal">
							<img src="{{ url('') }}/public/assets/images/my-account.svg">
						</a>
						@endif
						@if(Session::get('usersession'))
						<a title="My Favourites" href="{{ url('my-favourites') }}" class="my-selection mx-2">
							<img src="{{ url('') }}/public/assets/images/fav.svg">
						</a>
						<a title="Logout" href="{{ url('logout') }}" class="my-selection mx-2">
							<img src="{{ url('') }}/public/assets/images/logout.svg">
						</a>
						@endif
					</div>
				</div>
				</form>
				<div class="logo-section d-flex align-items-center justify-content-end flex-column flex-md-row position-relative py-2">
					<div class="big-logo logo-image w-100 text-center">
						<a href="{{ env('APP_URL').'home' }}">
							<img src="{{ url(get_setting('logo')) }}" alt="{{ get_setting('site_title') }}" class="img-fluid logo_black">
							<img src="{{ url('') }}/public/assets/images/logo_white.svg" alt="{{ get_setting('site_title') }}" class="img-fluid logo_white">
						</a>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="flex-fill">
		<div class="container-fluid">
			<div class="container">
				<nav class="navbar navbar-expand-md p-0 nav-menu">
					<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar"> <span class="navbar-toggler-icon"></span>
					</button>
					<div class="collapse navbar-collapse px-3" id="collapsibleNavbar">
						<ul class="navbar-nav w-100 d-block d-md-flex align-items-center justify-content-center navbar-light">
							<li class="nav-item"> <a class="nav-link px-md-4 text-uppercase" href="{{ env('APP_URL').'home' }}">Home</a>
							</li>
							<li class="nav-item">
								<div class="dropdown navbar-dropdown">
									<button class="btn rounded-0 nav-link px-md-4 text-uppercase dropdown-toggle " type="button" id="dropdownMenuButton" data-toggle="dropdown">Collection</button>
									<div class="dropdown-menu rounded-0 m-0" aria-labelledby="dropdownMenuButton">
									@foreach(get_collection() as $col)
										<a href="{{ env('APP_URL').'collection-list/'.$col['slug'] }}" class="dropdown-item " style="text-transform: capitalize">{{ $col['collection_name'] }}</a>
									@endforeach
									@foreach(get_landing_page(2) as $page_inner)
										<a href="{{ env('APP_URL').'landing-page/'.$page_inner['slug'] }}" class="dropdown-item " style="text-transform: capitalize">{{ $page_inner['title'] }}</a>
									@endforeach
									@if(get_setting('about_page_location')==2)
									@if(get_setting('about_page_status')==1)
										<a href="{{ env('APP_URL').'about' }}" class="dropdown-item " style="text-transform: capitalize">About Us</a>
									@endif
									@endif
									@if(get_setting('privacy_policy_status')==1 && get_setting('privacy_policy_location')==2)
									<a href="{{ env('APP_URL').'privacy-policy' }}" class="dropdown-item " style="text-transform: capitalize">
										Privacy policy
									</a>
									@endif
									@if(get_setting('terms_conditions_status')==1 && get_setting('terms_conditions_location')==2)
									<a href="{{ env('APP_URL').'terms-conditions' }}" class="dropdown-item " style="text-transform: capitalize">
										Terms & Conditions
									</a>
									@endif
									</div>
								</div>
							</li>
							@if(get_setting('about_page_location')==1)
							@if(get_setting('about_page_status')==1)
							<li class="nav-item"> <a class="nav-link px-md-4 text-uppercase" href="{{ env('APP_URL').'about' }}">About Us</a>
							</li>
							@endif
							@endif
							@if(get_setting('privacy_policy_status')==1 && get_setting('privacy_policy_location')==1)
							<li class="nav-item"> <a class="nav-link px-md-4 text-uppercase" href="{{ env('APP_URL').'privacy-policy' }}">Privacy policy</a>
							</li>
							@endif
							@if(get_setting('terms_conditions_status')==1 && get_setting('terms_conditions_location')==1)
								<li class="nav-item"> <a class="nav-link px-md-4 text-uppercase" href="{{ env('APP_URL').'terms-conditions' }}">Terms & Conditions</a>
							</li>
							@endif
							@if(get_setting('blog_manage_status')==1)
							<li class="nav-item" id="home-news-tab"> <a class="nav-link px-md-4 text-uppercase" href="{{ url('blog1') }}">Blog</a>
							</li>
							@endif
							<li class="nav-item"> <a class="nav-link px-md-4 text-uppercase" href="{{ env('APP_URL').'contact-us' }}">Contact Us</a>
							</li>
							@foreach(get_landing_page(1) as $page_main)
							<li class="nav-item"> <a class="nav-link px-md-4 text-uppercase" href="{{ env('APP_URL').'landing-page/'.$page_main['slug'] }}">{{ $page_main['title'] }}</a>
							</li>
							@endforeach
							@if(Session::get('usersession'))
							<li class="nav-item"> <a data-toggle="modal" data-target="#testimonial_popup" class="nav-link px-md-4 text-uppercase" href="javascript:;">Testimonial</a>
							</li>
							@endif
						</ul>
					</div>
				</nav>
			</div>
		</div>
		@yield('content')
	</div>
	
	
	<div>
		<div class="container-fluid py-3 pb-lg-2 pt-lg-3 border-bottom mt-3">
			<div class="container">
				<div class="footer text-center">
					<div class="pb-2">
						<a href="{{ url('') }}"> 
							<img src="{{ url(get_setting('logo')) }}" class="img-fluid logo_black">
							<img src="{{ url('') }}/public/assets/images/logo_white.svg" alt="{{ get_setting('site_title') }}" class="img-fluid logo_white">
						</a>
					</div>
					<div class="social-icons d-inline-block">
						<a href="https://www.facebook.com/pg/tarasri.tibarumals/photos/?ref=page_internal" class="d-inline-block wow fadeIn"> <i class="fab fa-facebook-f fa-fw"></i>
						</a>
						<a href="https://in.pinterest.com/tarasrijewels/" class="d-inline-block wow fadeIn" data-wow-delay="0.2s"> <i class="fab fa-pinterest fa-fw"></i>
						</a>
						<a href="https://www.instagram.com/tarasri.tibarumals/?hl=en" class="d-inline-block wow fadeIn" data-wow-delay="0.2s"> <i class="fab fa-instagram fa-fw"></i>
						</a>
						<a href="https://wa.me/{{ get_setting('site_whatsapp_no') }}" class="d-inline-block wow fadeIn" data-wow-delay="0.2s"> <i class="fab fa-whatsapp fa-fw"></i>
						</a>
					</div>
				</div>
			</div>
		</div>
		<div class="container-fluid py-2 footer-fluid">
			<div class="container">
				<div class="text-center d-md-flex justify-content-between">
					<div class="mx-auto">
						<div class="d-inline-block position-relative footer-links px-3">
							©Copyright TARASRI - Tibarumal Gems & Jewels All Rights Reserved</div>
						<div class="d-inline-block text-capitalize">
							@if(get_setting('privacy_policy_status')==1 && get_setting('privacy_policy_location')==3)
							<a href="{{ env('APP_URL').'privacy-policy' }}" class="position-relative footer-links px-3">
								privacy policy
							</a>
							@endif
							@if(get_setting('terms_conditions_status')==1 && get_setting('terms_conditions_location')==3)
							<a href="{{ env('APP_URL').'terms-conditions' }}" class="position-relative footer-links px-3">
								Terms & Conditions
							</a>
							@endif
							@if(get_setting('tarasri_exclusive_status')==1)
							<a href="{{ env('APP_URL').'tara-sri-exclusive' }}" id="footer-tara-exclusive" class="position-relative footer-links px-3">
								Tara sri Exclusive
							</a>
							@endif
							@if(get_setting('about_page_location')==3)
							@if(get_setting('about_page_status')==1)
								<a href="{{ env('APP_URL').'about' }}" id="AboutUs" class="position-relative footer-links px-3">
								About Us
								</a>
							</li>
							@endif
							@endif
							@foreach(get_landing_page(4) as $fpage_main)
							<a class="position-relative footer-links px-3" href="{{ env('APP_URL').'landing-page/'.$fpage_main['slug'] }}">{{ $fpage_main['title'] }}</a>
							@endforeach
						</div> <a href="https://www.instamojo.com/@TibarumalGemsAndJewels/" class="d-inline-block border-0 rounded bg-666 text-white text-capitalize pay-online-btn my-2 my-md-0">
                                    pay online
                                </a> 
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="modal fade" id="loginModal" style="z-index: 99999;">
		<div class="modal-dialog animated">
			<div class="modal-content">
				<div style="display: block!important;" class="modal-header user">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					<div class="text-uppercase text-center pt-4">
						<div class="headding d-inline-block">Login</div>
					</div>
				</div>
				<div class="modal-body">
					<div class="box" id="loginModalBody">
						<div class="login-account-wrapper">
							<form action="{{ url('userlogin') }}" class="database_operation_form">
							<div>
								<div class="mb-3">
									<div> 
										<span class="registration-heading-text">EMAIL / MOBILE</span>
									</div>
									<div> 
										<span>
										{{ csrf_field() }}
                                           <input type="text" required="required"  class="form-control" placeholder="Enter Your Email / Mobile " name="username" />
                                          </span>
									</div>
								</div>
								<div class="mb-3">
									<div> 
										<span class="registration-heading-text">PASSWORD</span>
									</div>
									<div> 
										<span>
											<input type="password" required="required" name="password" class="form-control" placeholder="Enter Your Password" />
										</span>
									</div>
								</div>
								<div>
									<div class="mb-3">
										<div class="custom_theme_btn_div"> 
											<button class="custom_theme_btn">Login</button>
										</div>
									</div>
									<div class="mb-2 custom_bottom_links">
										<div> <a class="link-href-wrapper" data-target="#registerModal" data-toggle="modal" data-dismiss="modal">Create account</a>&nbsp;&nbsp;
											or &nbsp;&nbsp;<a class="link-href-wrapper" data-target="#resetPwdModal" data-toggle="modal" data-dismiss="modal">Reset password</a>
										</div>
									</div>
								</div>
							</div>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="modal fade" id="registerModal">
		<div class="modal-dialog animated">
			<div class="modal-content">
				<div class="modal-header user" style="display: block!important;">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					<div class="text-uppercase text-center pt-4">
						<div class="headding d-inline-block">Register</div>
					</div>
				</div>
				<div class="modal-body">
					<div class="box" id="registerModalBody">
						<div class="registration-wrapper">
							<form action="{{ url('user_signup') }}" class="signup_form">
							<div>
								<div class="mb-3">
									<div> 
										<span class="registration-heading-text">NAME</span>
									</div>
									<div> 
										<span>
										{{ csrf_field() }}
											<input type="text" required="required" name="name" id="r_name" class="form-control registration-input remove-validation-form-field"  placeholder="Enter Your Name" />
										</span>
									</div>
								</div>
								<div class="mb-3">
									<div> 
										<span class="registration-heading-text">MOBILE NUMBER</span>
									</div>
									<div>
										<select class="form-control" name="code" style="width: 33%;float: left;">
										 @foreach(country_mobile_no_code() as $key => $code)
											<option <?php if($key=='IN') { ?> selected <?php } ?> value="{{ $code['code'] }}">{{ $code['name'] }} (+{{ $code['code'] }})</option>
										 @endforeach
										</select>
										<span style=" width: 65%; float: right; ">
											<input type="number" name="mobile_no" id="r_mobile_no" class="form-control registration-input remove-validation-form-field" placeholder="Enter Your Mobile" />
										</span>
									</div>
								</div>
								<div class="mb-3" style="margin-top: 53px;">
									<div> 
										<span class="registration-heading-text">EMAIL</span>
									</div>
									<div> 
										<span>
											<input type="text" name="email" id="r_email"  class="form-control registration-input remove-validation-form-field" placeholder="Enter Your Email" />
										</span>
									</div>
								</div>
								<div class="mb-3">
									<div> 
										<span class="registration-heading-text">PASSWORD</span>
									</div>
									<div> 
										<span>
											<input type="password" name="password" id="r_password" class="form-control registration-input remove-validation-form-field" placeholder="Enter Password" />
										</span>
									</div>
								</div>
								<!-- secret key = 6LdsD7wZAAAAAIVuEVchDp3Fr6TOTwmJjFh9O4ym -->
								<div class="text-right mb-2">
									<div class="g-recaptcha brochure__form__captcha r-g-recaptcha" data-sitekey="6Ld8X74ZAAAAAHvu-Ow_lYmAAngODhdnFAQ3s_XB"></div>
								</div>
								<div>
									<div class="mb-3">
										<div class="custom_theme_btn_div"> 
											<button class="custom_theme_btn" id="register-form">
												Register
											</button>
										</div>
									</div>
									<div class="mb-2 custom_bottom_links">
										<div> 
											<a class="link-href-wrapper" data-target="#loginModal" data-toggle="modal" data-dismiss="modal">Login</a> &nbsp;&nbsp;
											or &nbsp;&nbsp;
											<a class="link-href-wrapper" data-target="#resetPwdModal" data-toggle="modal" data-dismiss="modal">Reset Password</a>
										</div>
									</div>
								</div>
							</div> 
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
</div>
	<div class="modal fade" id="resetPwdModal">
		<div class="modal-dialog animated">
			<div class="modal-content">
				<div class="modal-header user" style="display: block!important;">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					<div class="text-uppercase text-center pt-4">
						<div class="headding d-inline-block">reset password</div>
					</div>
				</div>
				<div class="modal-body">
					<div class="box">
						<form action="{{ url('reset_password') }}" class="database_operation_form" data-pop="#resetPwdModal">
						<div class="reset-account-wrapper account-wrapper">
							<div>
								<div class="mb-3">
									<div> 
										<span class="registration-heading-text">EMAIL</span>
									</div>
									<div> 
										<span>
										{{ csrf_field() }}
                                            <input type="text" name="email" class="form-control" placeholder="Enter Your Registered Email" />
                                        </span>
									</div>
								</div>
								<div>
									<div class="mb-3">
										<div class="custom_theme_btn_div""> 
											<button class="custom_theme_btn">Reset Password</button>
										</div>
									</div>
									<div class="mb-1 custom_bottom_links">
										<div> <a class="link-href-wrapper" data-target="#registerModal" data-toggle="modal" data-dismiss="modal">Create account</a>&nbsp;&nbsp;
											or &nbsp;&nbsp;<a class="link-href-wrapper" data-target="#loginModal" data-toggle="modal" data-dismiss="modal">Login</a>
										</div>
									</div>
								</div>
							</div>
						</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="modal fade" id="otp_popup">
		<div class="modal-dialog animated">
			<div class="modal-content">
				<div class="modal-header user" style="display: block!important;">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					<div class="text-uppercase text-center pt-4">
						<div class="headding d-inline-block">One Time Password</div>
					</div>
				</div>
				<div class="modal-body">
					<div class="box">
						<form action="{{ url('otp_check') }}" class="database_operation_form" data-pop="#otp_popup">
						<div class="reset-account-wrapper account-wrapper">
							<div>
								<div class="mb-3">
									<div> 
										<span class="registration-heading-text">Please Enter OTP</span>
									</div>
									<div> 
										<span>
										{{ csrf_field() }}
											<input type="hidden" id="otp_user_id" name="user_id" />
                                            <input type="text" name="otp" class="form-control" placeholder="Enter OTP" />
                                        </span>
									</div>
								</div>
								<div>
									<div class="mb-1 custom_bottom_links">
										<div>
											<button class="custom_theme_btn">Verify</button>
										</div>
									</div>
									<div class="mb-2 custom_bottom_links">
										<div class="text-center"> 
											<a class="link-href-wrapper" id="resend_otp">Resend OTP</a>
										</div>
									</div>
								</div>
							</div>
						</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="modal fade" id="testimonial_popup">
		<div class="modal-dialog animated">
			<div class="modal-content">
				<div class="modal-header user" style="display: block!important;">
					<button data-dismiss="modal" type="button" class="close" aria-hidden="true">&times;</button>
					<div class="text-uppercase text-center pt-4">
						<div class="headding d-inline-block">Send Testimonial</div>
					</div>
				</div>
				<div class="modal-body">
					<div class="box">
						<form action="{{ url('testimonial') }}" data-pop="#testimonial_popup" class="database_operation_form">
							<div class="otp-account-wrapper">
								<div>
									<div class="mb-3">
										<div> 
											<span class="registration-heading-text">Enter Message</span>
										</div>
										<div> 
											<span>
											{{ csrf_field() }}
												<textarea rows="10" cols="20" class="form-control" name="message"></textarea>
											</span>
										</div>
									</div>
									<div class="mb-3">
										<div class="two-otp-button-wrapper">
											<div class="mb-1 custom_bottom_links">
												<div>
													<button class="custom_theme_btn">Submit</button>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="feedback-section" id="feedbackSection"><span></span>
	</div>
{!! get_setting('footer_script') !!}
<!--<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>-->
<script src="{{ url('') }}/public/front_assets/js/3.5.1-jquery.min.js"></script>
<script src="{{url('public/assets/plugins/blog-carousal/js/Carousel.js')}}"></script>
@if(Request::segment(1)=='collection-list')
<script type="text/javascript"  async src="{{ url('') }}/public/front_assets/js/collection_list.js"></script>
@endif
<script type="text/javascript"  async src="{{ url('') }}/public/front_assets/js/bootstrap/popper.min.js"></script>
<script type="text/javascript"  async src="{{ url('') }}/public/front_assets/js/bootstrap/bootstrap.min.js"></script>
<script type="text/javascript"  async src="{{ url('') }}/public/front_assets/js/wow.min.js"></script>
<!--<script type="text/javascript"  async src="{{ url('') }}/public/front_assets/js/fontawesome/fontawesome.min.js"></script>-->
<script type="text/javascript"  async src="{{ url('') }}/public/front_assets/js/fontawesome/fontawesome-all.min.js"></script>
<script type="text/javascript"  async src="{{ url('') }}/public/front_assets/js/owl-carousel/owl.carousel.min.js"></script>
<!--<script type="text/javascript"  async src="{{ url('') }}/public/front_assets/js/light-bootstrap-dashboard.js"></script>-->
<script type="text/javascript"  async src="{{ url('') }}/public/front_assets/js/jquery.mCustomScrollbar.min.js"></script>
<!--<script type="text/javascript"  async src="{{ url('') }}/public/front_assets/js/jquery.dataTables.min.js"></script>
<script type="text/javascript"  async src="{{ url('') }}/public/front_assets/js/dataTables.bootstrap4.min.js"></script>-->
@if(!isset($load_home_utility))
<script type="text/javascript"  async src="{{ url('') }}/public/front_assets/js/tinymce.min.js"></script>
@endif
<script type="text/javascript"  async src="{{ url('') }}/public/front_assets/js/vendor/easyzoom.js"></script>
<script type="text/javascript"  async src="{{ url('') }}/public/front_assets/js/global5e1f.js"></script>
<script type="text/javascript"  async src="{{ url('') }}/public/front_assets/js/blocksit.min.js"></script>

<script type="text/javascript"  async src="{{ url('') }}/public/front_assets/js/1.12.1-jquery-ui.min.js"></script>
<!--<script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>-->

<script src="{{url('public/assets/plugins/blog-carousal/js/custom.js')}}"></script>
@if(Request::segment(1)=='about')
<script type="text/javascript"  async src="{{ url('') }}/public/front_assets/pages/js/about.js"></script>	
@endif
<?php
if(Request::segment(1)=='blognew' || Request::segment(1)=='blog')
{
?>
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
<?php 
} 
if(Session::get('ev'))
{
	$request->session()->forget('ev');
	?>
	<script>
		$(document).ready(function(){
			$('#feedbackSection').css({'background':'green','height':'80px','display':'block'});
			$('#feedbackSection').html('<span>Your Account Successfully verify</span>');
			setTimeout(function(){
				$('#feedbackSection').css({'display':'none'});
			},3000)
		});
	</script>
	<?php 
}
?>
<script>
// console.clear();
</script>

</body>
</html>