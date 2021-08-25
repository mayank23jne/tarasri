@extends('layouts.app')
@section('title',getSinglerow('seo_meta','title',array('page_name'=>'contactus-user')))
@section('seo_description',getSinglerow('seo_meta','description',array('page_name'=>'contactus-user')))
@section('seo_keywords',getSinglerow('seo_meta','keywords',array('page_name'=>'contactus-user')))
@section('content')
<section class="contact">
<div class="container contact">
    <div class="row">
        <div class="col-md-12">
                <div class="contact_title grey noto-somibold">Hello. Let`s get in touch</div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-7">
            <form action="{{ url('contact-us') }}" class="database_operation_form">
            <div class="contact_form">
                <div class="single_field">
                    <div class="contact_label noto-regular size_15 dark_grey">Name</div>
                    <div class="colon noto-regular size_15 dark_grey">:</div>
                    <div class="contact_fields">
                        <div class="field">
                            {{ csrf_field() }}
                            <input type="text" placeholder="Enter your name" name="name" id="name" class="size_12 remove-validation-form-field">
                            
                        </div>
                    </div>
                </div>
                <div class="single_field">
                    <div class="contact_label noto-regular size_15 dark_grey desktop_view">Contact Number</div>
                    <div class="contact_label noto-regular size_15 dark_grey mobile_view">Contact No</div>
                    <div class="colon noto-regular size_15 dark_grey">:</div>
                    <div class="contact_fields two_columns">
                        <select name="code" class="mdb-select md-form md-outline colorful-select dropdown-primary noto-regular size_12">
                          <option value="" disabled selected>India +91</option>
                          @foreach(country_mobile_no_code() as $key => $code)
                            <option <?php if($key=='IN') { ?> selected <?php } ?> value="{{ $code['code'] }}">{{ $code['name'] }} (+{{ $code['code'] }})</option>
                         @endforeach
                        </select>
                        <div class="field">
                            <input type="number" placeholder="Enter your mobile no." name="mobile_no" id="mobile_no" class="size_12 remove-validation-form-field">
                        </div>
                    </div>
                </div>
                <div class="single_field">
                    <div class="contact_label noto-regular size_15 dark_grey">Email ID</div>
                    <div class="colon noto-regular size_15 dark_grey">:</div>
                    <div class="contact_fields">
                        <div class="field">
                            <input type="email" placeholder="Enter your Email" name="email" id="email" class="size_12 remove-validation-form-field">
                        </div>
                    </div>
                </div>
                <div class="single_field">
                    <div class="contact_label noto-regular size_15 dark_grey">Message</div>
                    <div class="colon noto-regular size_15 dark_grey">:</div>
                    <div class="contact_fields">
                        <div class="field">
                            <textarea class="form-control remove-validation-form-field" rows="5" id="comment" placeholder="Enter message here. . ." name="message" class="size_12"></textarea>
                        </div>
                    </div>
                </div>
                <div class="single_field">
                    <div class="contact_label noto-regular size_15 dark_grey"></div>
                    <div class="colon noto-regular size_15 dark_grey"></div>
                    <div class="contact_fields">
                        <div class="text-right mb-2">
							<div class="g-recaptcha brochure__form__captcha r-g-recaptcha" data-sitekey="6Ld8X74ZAAAAAHvu-Ow_lYmAAngODhdnFAQ3s_XB"></div>
						</div>
                    </div>
                </div>
                <div class="single_field">
                    <div class="contact_label noto-regular size_15 dark_grey"></div>
                    <div class="colon noto-regular size_15 dark_grey"></div>
                    <button class="contact_button size_15 noto-medium">Send Message</button>
                </div>
            </div>
            </form>
        </div>
        <div class="col-lg-5">
            <div class="contact_sidebar">
                <div class="sidebar_label size_15 noto-medium">Address</div>
                <div class="sidebar_content size_14 noto-regular">
                    4 & 5 Lumbini Jewel Mall, Road No 2,<br>
                    Banjara Hills, Hyderabad - 500034<br>
                    Telangana, India<br>
                </div>
                <br>
                <div class="sidebar_label size_15 noto-medium">Store Hours</div>
                <div class="sidebar_content size_14 noto-regular">
                    Monday - Saturday<br>
                    11:00 am - 8:30 pm
                </div>
                <br>
                <div class="sidebar_label size_15 noto-medium">Support</div>
                <div class="sidebar_content size_14 noto-regular">
                    info@tibarumals.com<br>
                    040 4032 9900
                </div>
            </div>
        </div>
    </div>
    <div class="row map">
        <div class="col-md-12">
            <div class="contact_title grey noto-somibold">Locate Us</div>
            <div class="contact_map">
                <div style="width: 100%"><iframe width="100%" height="430" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="https://maps.google.com/maps?width=100%25&amp;height=430&amp;hl=en&amp;q=Tarasri,%20Lumbini%20Jewel%20Mall,%20Road%20No%202%20Banjara%20Hills,%20Hyderabad+(Tarasri)&amp;t=&amp;z=14&amp;ie=UTF8&amp;iwloc=B&amp;output=embed"></iframe></div>
            </div>
        </div>
    </div>
</div>
</section>
@endsection