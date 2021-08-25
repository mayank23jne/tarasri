@extends('layouts.app')
@section('title',get_setting('site_title'))
@section('content')
<div>
<section class="mask">
<div class="container">
    <div class="row" style="margin:50px 0px;">
        <div class="col-md-12">
            <div class="mask_video">
                <video width="100%" controls playsinline autoplay muted loop>
                  <source src="{{\Config::get('app.s3_bucket_url').'Video2.mov'}}" type="video/mp4">
                </video>
            </div>
        </div>
    </div>
</div>   
<div class="block_two mask_section">
    <div class="mask_thumb mask_thumb_left">
        <img src="{{url('public/assets/images/tara-mask/mask_img_1.jpg')}}">
    </div>
    <div class="mask_desc">
        <div class="mask_desc_inner poor container_padding">
            Your Wedding Day is as important to us
            as it is to you. Tarasri aims at making your
            big day, a memorable with our new edition
            Bejewelled  Tara mask.
        </div>
    </div>
</div>
<div class="block_tree mask_section">
    <div class="mask_thumb mask_thumb_right mobile_img">
        <img src="{{url('public/assets/images/tara-mask/mask_img_2.jpg')}}">
    </div>
    <div class="mask_desc">
        <div class="mask_desc_inner mdi_left poor container_padding">
            Hoping your smile shines brighter
            than ever, dazzle them with our custom
            made diamond Bejewelled Tara mask.
        </div>
    </div>
    <div class="mask_thumb mask_thumb_right desktop_img">
        <img src="{{url('public/assets/images/tara-mask/mask_img_2.jpg')}}">
    </div>
</div>
<div class="block_four mask_section">
    <div class="mask_center">
        <div class="mask_name">
            <div class="allura_small allura-normal size_50 light_cream">Bejewelled</div>
            <div class="allura_big allura-normal size_64 light_cream" style="margin-top: -7px;">Tara Masks</div>
        </div>
        <img src="{{url('public/assets/images/tara-mask/mask_img_3.jpg')}}">
    </div>
</div>
<div class="block_five">
    <div class="fullsize_image">
        <img src="{{url('public/assets/images/tara-mask/mask_img_4.jpg')}}">
    </div>
</div>
<div class="block_six container_padding">
    <div class="big_content poor size_32 cream">
        Made with care for your care,
        to add sparkle to your joy.
    </div>
</div>
<div class="container block_seven" style="margin: 150px auto;">
    <div class="row" style="margin:50px 0px;">
        <div class="col-md-12">
            <div class="mask_video">
                <video width="100%" controls playsinline autoplay muted loop>
                  <source src="{{\Config::get('app.s3_bucket_url').'Video3.mov'}}" type="video/mp4">
                </video>
            </div>
        </div>
    </div>
</div> 
<div class="block_eight container_padding center">
    <div class="big_content poor size_32 cream">
        Our artisians have carefully crafted our special edition
    </div>
    <div class="allura_small allura-normal size_50 light_cream">Bejewelled</div>
    <div class="allura_big allura-normal size_64 light_cream">Tara Masks</div>
</div>
<div class="block_nine container_padding center">
    <img src="{{url('public/assets/images/tara-mask/border_top.png')}}">
    <div class="big_content poor size_28 cream">
        25% of our profits from this collection will be donated to
        Shri Shanti Ashram and other organisations.<br>
        Tara Sri would like to thanks its valuable customers<br>
        for helping us in this initiative.
    </div>
    <img src="{{url('public/assets/images/tara-mask/border_bottom.png')}}">
</div>
</section>
</div>
@endsection