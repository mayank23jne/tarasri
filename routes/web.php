<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


/* Admin Route start */

Route::match(['get','post'],'admin','AdminAuth@index');
Route::match(['get','post'],'image_operation','HomeController@image_operation');
Route::match(['get','post'],'forgot_password','AdminAuth@forgot_password');
Route::get('change_blog_manage_status/{status}','AdminController@change_blog_manage_status1')->name('blogstatus');
Route::group(['middleware' => 'authcheck'], function () {
    Route::prefix('admin')->group(function(){
        Route::get('dashboard','AdminController@index');
		Route::get('dashboard/{id}','AdminController@index');
        Route::get('blog','AdminController@blog');
		Route::get('crimsonbride','AdminController@crimsonbride');
		Route::get('edit_crimsonbride/{id}','AdminController@edit_crimsonbride');
		Route::post('crimsonbride_operation','AdminController@crimsonbride_operation');
		Route::match(['get','post'],'add_new_crimsonbride','AdminController@add_new_crimsonbride');
		Route::post('upload_crimsonbride_image/{reff}','AdminController@upload_crimsonbride_image');
		Route::post('crimsonbride_image_alt_text','AdminController@crimsonbride_image_alt_text');
		Route::get('blogcategory','AdminController@manageblogcategory');
		Route::post('blogcategory_manage_operation','AdminController@blogcategory_manage_operation');
		Route::match(['get','post'],'get_blogcategory','AdminController@get_blogcategory');
		Route::get('landing-page','AdminController@landing_page');
		Route::match(['get','post'],'add-landing-page','AdminController@add_landing_page');
		Route::match(['get','post'],'edit-landing-page/{id}','AdminController@edit_landing_page');
		Route::post('landing_page_operation','AdminController@landing_page_operation');
		
        Route::match(['get','post'],'profile','AdminController@profile');
        Route::match(['get','post'],'tarasri_exclusive','AdminController@tarasri_exclusive');
        Route::match(['get','post'],'add_new_blog','AdminController@add_new_blog');
        Route::post('upload_blog_image/{reff}','AdminController@upload_blog_image');
		Route::post('blog_image_alt_text','AdminController@blog_image_alt_text');
        Route::post('upload_tarasri_exclusive_image','AdminController@upload_tarasri_exclusive_image');
        Route::match(['get','post'],'blog_operation','AdminController@blog_operation');
        Route::match(['get','post'],'edit_blog/{id}','AdminController@edit_blog');
		Route::get('blog_comment','AdminController@blog_comment');
		Route::get('testimonial','AdminController@testimonial');
		Route::post('testimonial_manage_operation','AdminController@testimonial_manage_operation');
		Route::match(['get','post'],'get_testimonial','AdminController@get_testimonial');
        Route::get('get_json/{type}','AdminController@get_json');
        Route::get('logout','AdminController@logout');
        Route::get('enquiry','AdminController@enquiry');
        Route::get('contactus','AdminController@contactus');
        Route::post('delete_image','AdminController@delete_image');
        Route::prefix('users')->group(function(){
            Route::get('role_manage','UsersController@role_manage');
            Route::post('role_manage_operation','UsersController@role_manage_operation');
            Route::match(['get','post'],'get_role','UsersController@get_role');
            Route::get('user_manage','UsersController@user_manage');
            Route::post('manage_user_operation','UsersController@manage_user_operation');
            Route::match(['get','post'],'get_user','UsersController@get_user');
        });
        Route::prefix('products')->group(function(){
            Route::get('category','ProductController@category');
			Route::get('delete_prod_image_final/{id}','ProductController@delete_prod_image_final');
            Route::match(['get','post'],'get_category','ProductController@get_category');
            Route::post('category_manage_operation','ProductController@category_manage_operation');
            Route::get('collections','ProductController@collections');
            Route::match(['get','post'],'get_collections','ProductController@get_collections');
            Route::post('collections_manage_operation','ProductController@collections_manage_operation');
            Route::get('occasion','ProductController@occasion');
            Route::match(['get','post'],'get_occasion','ProductController@get_occasion');
            Route::post('occasion_manage_operation','ProductController@occasion_manage_operation');

            Route::get('manage_product','ProductController@manage_product');
            Route::match(['get','post'],'add_new_product','ProductController@add_new_product');
            Route::match(['get','post'],'edit_product/{id}','ProductController@edit_product');
            Route::post('product_manage_operation','ProductController@product_manage_operation');
            Route::match(['get','post'],'get_products','ProductController@get_products');
            Route::post('upload_product_image','ProductController@upload_product_image');
            Route::post('upload_product_video','ProductController@upload_product_video');
            Route::get('design_style','ProductController@design_style');
            Route::match(['get','post'],'get_design_style','ProductController@get_design_style');
            Route::post('design_style_manage_operation','ProductController@design_style_manage_operation');
            Route::get('metal','ProductController@metal');
            Route::match(['get','post'],'get_metal','ProductController@get_metal');
            Route::post('metal_manage_operation','ProductController@metal_manage_operation');
            Route::get('gemstone','ProductController@gemstone');
            Route::match(['get','post'],'get_gemstone','ProductController@get_gemstone');
            Route::post('gemstone_manage_operation','ProductController@gemstone_manage_operation');
            Route::get('purity','ProductController@purity');
            Route::match(['get','post'],'get_purity','ProductController@get_purity');
            Route::post('purity_manage_operation','ProductController@purity_manage_operation');


            Route::get('diamond_type','ProductController@diamond_type');
            Route::match(['get','post'],'get_diamond_type','ProductController@get_diamond_type');
            Route::post('diamond_type_manage_operation','ProductController@diamond_type_manage_operation');

            
        });
        Route::prefix('setting')->group(function(){
            Route::get('general_settings','SettingController@general_settings');
            Route::post('save_setting','SettingController@save_setting'); 
            Route::post('save_about_us_image','SettingController@save_about_us_image'); 
            Route::match(['get','post'],'get_meta_seo','SettingController@get_meta_seo');
            Route::post('meta_seo_manage_operation','SettingController@meta_seo_manage_operation');
            Route::post('save_image','SettingController@save_image');  
            Route::post('seoFileOperation','SettingController@seoFileOperation');  
            Route::post('delete_seo_file','SettingController@delete_seo_file');  
            Route::match(['get','post'],'aboutUs1','SettingController@aboutUs');
            Route::match(['get','post'],'aboutUs','SettingController@aboutUs_new');
            Route::get('home_page','SettingController@home_page');
            Route::post('save_home_page_data','SettingController@save_home_page_data');
            Route::get('get_product_list/{id}','SettingController@get_product_list');
            Route::post('upload_home_page_banner/{name}','SettingController@upload_home_page_banner');
            Route::get('delete_home_page_item/{id}','SettingController@delete_home_page_item');
            Route::get('get_collection','SettingController@get_collection');
            Route::get('get_category','SettingController@get_category');
            Route::get('privacypolicy','SettingController@privacypolicy');
            Route::get('term_and_condition','SettingController@term_and_condition');
			Route::get('our_partners','SettingController@our_partners');
			Route::post('our_partners_manage_operation','SettingController@our_partners_manage_operation');
        });

    });
});

/* Admin Route end */

Route::get('/', function () {
    return view('welcome');
});

//Route::get('/', 'HomeController@redirect_lending_page')->name('redirect_lending_page');
Route::get('/', 'HomeController@redirect_lending_page')->name('redirect_lending_page');
Route::get('/', 'HomeController@index')->name('home');
Route::get('/', function(){
	$current_route = \Request::url();
	if($current_route == 'http://blog.'.env('DOMAIN_NAME') || $current_route == 'https://blog.'.env('DOMAIN_NAME')){
		$url = 'https://blog.tarasri.in/blog';
		return redirect($url);
		die;
	} else {
		$data['home_jewellery']=\App\model\Home_jewellery::where('status',1)->orderBy('index_count','ASC')->get()->toArray();
		$data['load_home_utility']='yes';
		return view('home',$data);
	}
});
Route::get('/home1', 'HomeController@index1');
Route::get('/getFevList/{id}', 'HomeController@getFevList');
Route::get('/home', 'HomeController@index')->name('home');
Route::get('about','HomeController@about');
Route::get('resend_otp/{user_id}','HomeController@resend_otp');
Route::post('otp_check','HomeController@otp_check');
Route::match(['get','post'],'contact-us','HomeController@contactus');
Route::get('/collection-single/{slug}', 'MyTestController@collection_single')->name('home');
Route::get('/collection_single_main_slider/{id}', 'HomeController@collection_single_main_slider')->name('home');
Route::get('collection-list/{slug}/{home_id}','HomeController@collection_list')->name('collection_list');
Route::get('crimson-bride/{slug}','HomeController@crimsonbride')->name('crimsonbride');
Route::get('landing-page/{slug}','MyTestController@landing_page')->name('landing_page');
Route::get('collection-list','HomeController@collection_list')->name('collection_list');
Route::get('collection-list/{slug}','HomeController@collection_list')->name('collection_list');
Route::post('user_signup','HomeController@user_signup');
Route::post('userlogin','HomeController@userlogin');
Route::post('load_more_products','HomeController@load_more_products');
Route::post('load_more_slider','HomeController@load_more_slider');
Route::get('logout','HomeController@logout');
Route::post('reset_password','HomeController@reset_password');
Route::get('verify_email/{id}','HomeController@verify_email');
Route::get('add_to_fevrate/{prod_id}/{user_id}','HomeController@add_to_fevrate');
Route::get('remove_to_fevrate/{prod_id}/{user_id}','HomeController@remove_to_fevrate');
Route::get('my-favourites', 'HomeController@my_favourites')->name('my_favourites');
Route::post('testimonial','HomeController@testimonial');
Route::post('left_filter','HomeController@left_filter');
Route::get('privacy-policy','HomeController@privacy_policy');
Route::get('terms-conditions','HomeController@terms_conditions');
Route::get('tara-sri-exclusive','HomeController@tara_sri_exclusive');
Route::get('collection-single','HomeController@collection_single');
Route::get('blog','MyTestController@blog');
// Route::get('blognew','HomeController@blogList1');
Route::get('blog-single/{slug}','MyTestController@blog_single_dev');
Route::get('blog/{tag}','HomeController@blog');
Route::get('blog/{tag}','MyTestController@blog');
Route::post('blog_search/','MyTestController@blog_search');
Route::post('left_filter_blog/','MyTestController@left_filter_blog');
Route::post('blog_comment','HomeController@blog_comment');
Route::post('product_enquiry','HomeController@product_enquiry');

Route::get('blog1',function () {
	return redirect()->to('http://blog.'.env('DOMAIN_NAME').'/blog');
});

Route::post('upload','AdminController@upload')->name('upload');


Route::get('/images', 'ImageController@getImages')->name('images');
Route::get('/upload-image', 'ImageController@postUploadView')->name('uploadfile');
Route::post('/upload-new', 'ImageController@postUpload')->name('uploadfile');

Route::domain('blog.'.env('DOMAIN_NAME'))->group(function () {
	Route::get('/','MyTestController@blog');
	Route::get('blog','MyTestController@blog');
	Route::get('blog-single/{slug}','MyTestController@blog_single_dev');
	Route::get('blog/{tag}','MyTestController@blog');
	Route::get('blog/{tag}','MyTestController@blog');
	Route::post('blog_search/','MyTestController@blog_search');
});

Route::get('/test/blog', 'MyTestController@blog');
Route::get('/test/blog/{tag}','MyTestController@blog');
Route::get('/test/blog-single/{slug}', 'MyTestController@blog_single_dev');
Route::post('/test/blog_search/','MyTestController@blog_search');
Route::post('/left_filter_blog_new','MyTestController@left_filter_blog');
Route::get('test/collection-single/{slug}', 'MyTestController@collection_single');
Route::get('/test/landing-page/{slug}','MyTestController@landing_page')->name('landing_page');