@extends('layouts.app')
@section('title',getSinglerow('seo_meta','title',array('page_name'=>'aboutus-user')))
@section('seo_description',getSinglerow('seo_meta','description',array('page_name'=>'aboutus-user')))
@section('seo_keywords',getSinglerow('seo_meta','keywords',array('page_name'=>'aboutus-user')))
@section('content')
<?php  $s3_bucket_url = \Config::get('app.s3_bucket_url');?>
<div class="container about_us">
  <div class="row">
    <div class="col-sm-12 margin_top_bottom mobile">
        <div class="center_content center size_21">
            {{ $about_us->description }}
        </div>
        <div class="separator center">
            <img src="{{url('public/assets/images/element.png')}}">
        </div>
        <div class="center_content center size_21 bottom_180">
           {{ $about_us->description2 }}
        </div>
        @php $member_info = json_decode($about_us->member_info); @endphp
        <div class="founders">
			@if(isset($member_info[0]))
            <div class="single_founder">
                <div class="founder_title">{{$member_info[0]->designation}}</div>
                <div class="founder_image">
                    <img src="{{ $s3_bucket_url.$member_info[0]->image }}">
                    <div class="founder_name ball-pen name_left">
                        {{ $member_info[0]->name }}
                    </div>
                </div>
                <div class="founder_desc right_desc default">
                    {{ $member_info[0]->about }}
                </div>
            </div>
            @endif
			@if(isset($member_info[1]))
            <div class="single_founder flip bottom_1080 second">
                <div class="founder_title">{{$member_info[1]->designation}}</div>
                <div class="founder_image">
                    <img src="{{ $s3_bucket_url.$member_info[1]->image }}">
                    <div class="founder_name ball-pen name_right">
                        {{ $member_info[1]->name }}
                    </div>
                </div>
                <div class="founder_desc width_370">
                    {{ $member_info[1]->about }}
                </div>
            </div>
            @endif
			@if(isset($member_info[2]))
            <div class="single_founder third_section">
                <div class="founder_title">{{$member_info[2]->designation}}</div>
                <div class="founder_image">
                    <img src="{{ $s3_bucket_url.$member_info[2]->image }}">
                    <div class="founder_name ball-pen name_left">
                       {{$member_info[2]->name}}
                    </div>
                </div>
                <div class="founder_desc right_desc default third">
                    {{ $member_info[2]->about }}
                </div>
            </div>
            @endif
            @if(isset($member_info[3]))
            <div class="single_founder flip fourth">
                <div class="founder_title">{{$member_info[3]->designation}}</div>
                <div class="founder_image">
                    <img src="{{ $s3_bucket_url.$member_info[3]->image }}">
                    <div class="founder_name ball-pen name_right">
                        {{$member_info[3]->name}}
                    </div>
                </div>
                <div class="founder_desc width_370">
                   {{ $member_info[3]->about }}
                </div>
            </div>
			@endif
        </div>
        
        <div class="center_content_big center size_18">
            {{ $about_us->description3 }}
        </div>
        <div class="separator center">
           <img src="{{url('public/assets/images/element.png')}}">
        </div>
        <div class="center_content_big center size_18" style="max-width: 466px;">
            {{ $about_us->description4 }}
        </div>
    </div>
  </div>
</div>
@endsection