<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\model\Home_jewellery;
use App\model\Products;
use App\model\Product_meta;

use App\model\Collection;
use App\model\Categorey;
use App\model\Occassion;
use App\model\Gemstone;
use App\model\User;
use App\model\Favourites;
use App\model\Testimonial;
use App\model\About_us;
use App\model\Contact_us;
use App\model\Tara_exclusive;
use App\model\Crimsonbride;
use App\model\CrimsonbrideImages;
use App\model\Landingpage;
use App\model\Landingpage_editor;
use App\model\Blog;
use App\model\Blog_image;
use App\model\BlogCategory;
use App\model\BlogComment;
use App\model\Enquiry;
use Validator; 
use Session;
use ImageResize;
use DB;
use Illuminate\Support\Facades\Mail;
use App\Mail\InquirySes;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

class HomeController extends Controller
{
	public function redirect_lending_page()
	{
		$data['pages'] = Landingpage::where('slug','tara-mask')->get()->first();
		$data['page_data']= Landingpage_editor::orderBy('id','ASC')->where('parent',$data['pages']['id'])->get()->toArray();
		return view('landing_page',$data);
	}
	public function getFevList($id) {
	 $fev = Favourites::where('user_id',$id)->get()->toArray();   
	 if(count($fev)>0) {
	     $arr =array('status'=>'true','message'=>'Success','data'=>$fev);
	 } else {
	      $arr =array('status'=>'false','message'=>'Product Not Found In Your Favourites');
	 }
	 echo json_encode($arr);
	}
    public function image_operation()
    {
		$file_url='public/data/media_attachments/86.jpg';
		$id=91;
       $image_explode = array_reverse(explode('/',$file_url));
			
		$img_arr = explode('public/',$file_url);
		if(isset($img_arr[1]))
			$im=$img_arr[1];
		else 
			$im=$img_arr[0];
		$image_new='public/'.$im;
		
		
		 $image=explode('app',__DIR__)[0].$image_new;
	   $destinationPath=public_path('data/media_attachments_thumb');
	   $img=ImageResize::make($image);
	   $img->resize(400, 400, function ($constraint) {
			$constraint->aspectRatio();
		})->save($destinationPath.'/'.$image_explode[0]);
		echo $file_path='public/data/media_attachments_thumb/'.$image_explode[0];
		/*$up_link = Product_meta::where('id',$id)->get()->first();
		$up_link->meta_thumb=$up_link;
		$up_link->update();*/
		
		//$i=0;
		/*foreach($images_arr as $arr)
		{
			$image_explode = array_reverse(explode('/',$arr['meta_link']));
			
			$img_arr = explode('public/',$arr['meta_link']);
			if(isset($img_arr[1]))
				$im=$img_arr[1];
			else 
				$im=$img_arr[0];
			$image_new='public/'.$im;
			
			
			 $image=explode('app',__DIR__)[0].$image_new;
		   $destinationPath=public_path('data/media_attachments_thumb');
		   $img=ImageResize::make($image);
		   $img->resize(172, 172, function ($constraint) {
				$constraint->aspectRatio();
			})->save($destinationPath.'/'.$image_explode[0]);
			$file_path='public/data/media_attachments_thumb/'.$image_explode[0];
			$up_link = Product_meta::where('id',$arr['id'])->get()->first();
			$up_link->meta_thumb=$up_link;
			$up_link->update();
			echo $arr['id'],'<br>';
			$i++;
		}*/
      /* $image=explode('app',__DIR__)[0].'public/data/media_attachments/1.jpg';
       $destinationPath=public_path('data/media_attachments_thumb');
       $img=ImageResize::make($image);
       $img->resize(100, 100, function ($constraint) {
            $constraint->aspectRatio();
        })->save($destinationPath.'/img1.jpg');*/

    }

    public function index(Request $request)
    {
		$data['home_jewellery']=Home_jewellery::where('status',1)->orderBy('index_count','ASC')->get()->toArray();
		$data['request']=$request;
		$data['load_home_utility']='yes';
        return view('home',$data);
    }
    public function index1(Request $request)
    {
		$data['home_jewellery']=Home_jewellery::where('status',1)->orderBy('index_count','ASC')->get()->toArray();
		$data['request']=$request;
        return view('home1',$data);
    }
    public function load_more_slider(Request $request)
    {
		$data['home_jewellery']=Home_jewellery::where('status',1)->orderBy('index_count','ASC')->get()->toArray();
		unset($data['home_jewellery'][0]);
        return view('load-more-slider',$data);
    }
	public function collection_single($slug='')
	{
		if($slug!='')
		{
			$data['product_info']=Products::select(['products.*','metals.name as metal_name'])->join('metals','products.metal_type','=','metals.id')->where('slug',$slug)->get()->first();
			$data['product_image']=Product_meta::where('product_id',$data['product_info']->id)->where('meta_type',1)->get()->toArray();
			$data['product_video']=Product_meta::where('product_id',$data['product_info']->id)->where('meta_type',2)->get()->first();
			
			$data['collection_product']=Products::select(['products.*','metals.name as metal_name','product_meta.meta_link','product_meta.meta_thumb'])->join('metals','products.metal_type','=','metals.id')->join('product_meta','products.id','=','product_meta.product_id')->where('collection_id',$data['product_info']->collection_id)->where('product_meta.meta_type',1)->skip(0)->take(6)->get()->toArray();
			$category_id=explode(',',$data['product_info']->categorey_id);	
			$categoery_products=array();
			$category_name_str='';
			foreach($category_id as $key => $cat)
			{
				if($key==0)
					$category_name_str=getSinglerow('categorey','categorey_name',array('id'=>$cat));
				else 
					$category_name_str=','.getSinglerow('categorey','categorey_name',array('id'=>$cat));
				$cat_prod=Products::select(['products.*','metals.name as metal_name','product_meta.meta_link','product_meta.meta_thumb'])->join('metals','products.metal_type','=','metals.id')->join('product_meta','products.id','=','product_meta.product_id')->where('categorey_id',$cat)->where('product_meta.meta_type',1)->get()->toArray();
				foreach($cat_prod as $cp)
				{
					$categoery_products[]=$cp;
				}
				
			}
			
			$data['categoery_products']=$categoery_products;
			
		/*	echo "<pre>";
			print_r($data['collection_product']);
		
			die();*/
			$data['cat_name']=$category_name_str;
			return view('collection_single_dev',$data);
		}
		else 
		{
			return view('collection_single');
		}
	}
	public function collection_single_main_slider($id)
	{
		$data['product_info']=Products::select(['products.*','metals.name as metal_name'])->join('metals','products.metal_type','=','metals.id')->where('products.id',$id)->get()->first();
		$data['product_image']=Product_meta::where('product_id',$id)->where('meta_type',1)->get()->toArray();
		return view('render/collection_single_main_slider',$data);
	}
	public function collection_list($slug='',$home_id='')
	{
		
		if($home_id!='')
		{
			$data['banner']=getSinglerow('home_jewellery','banner_url',array('id'=>$home_id));
			$data['banner_alt']=getSinglerow('home_jewellery','banner_alt',array('id'=>$home_id));
		}
		else if($slug!='')
		{
			$data['banner']=getSinglerow('collection','banner',array('slug'=>$slug));
			$data['banner_alt']=getSinglerow('collection','alt_text',array('slug'=>$slug));
		}
		else 
		{
			$data['banner']='';
			$data['banner_alt']='';
		}
		$data['collections']=Collection::where('status',1)->get()->toArray();
		$data['categories']=Categorey::where('status',1)->get()->toArray();
		$data['occassion']=Occassion::where('status',1)->get()->toArray();
		$data['all_stones']=Gemstone::where('status',1)->get()->toArray();
		if(isset($_GET['search']))
		{	
			/*$data['products'] = \DB::table("products")
			->select("products.*",\DB::raw("categorey.categorey_name as cat_name"),\DB::raw("occassion.occassion_name as oc_name"),\DB::raw("gemstones.name as  stone_name"),\DB::raw("collection.collection_name as col_name"),\DB::raw("product_meta.meta_thumb as meta_thumb"),\DB::raw("product_meta.meta_link as meta_link"))
			->leftjoin("categorey",\DB::raw("FIND_IN_SET(categorey.id,products.categorey_id) "),">",\DB::raw("'0'"))
			->leftjoin("occassion",\DB::raw("FIND_IN_SET(occassion.id,products.occasion_type) "),">",\DB::raw("'0'"))
			->leftjoin("gemstones",\DB::raw("FIND_IN_SET(gemstones.id,products.stone_type) "),">",\DB::raw("'0'"))
			->leftjoin("collection",\DB::raw("FIND_IN_SET(collection.id,products.collection_id) "),">",\DB::raw("'0'"))
			->leftjoin("product_meta",\DB::raw("FIND_IN_SET(product_meta.product_id,products.id) "),">",\DB::raw("'0'"))
			->where('products.status','1')
			->where(function($q1){
				 $q1->where('product_name', 'LIKE', "%{$_GET['search']}%")
				 ->Orwhere('categorey_name', 'LIKE', "%{$_GET['search']}%")
				 ->Orwhere('design_style', 'LIKE', "%{$_GET['search']}%")
				 ->Orwhere('occassion_name', 'LIKE', "%{$_GET['search']}%")
				 ->Orwhere('diamond_type', 'LIKE', "%{$_GET['search']}%")
				 ->Orwhere('collection_name', 'LIKE', "%{$_GET['search']}%")
				 ->Orwhere('description', 'LIKE', "%{$_GET['search']}%");
			 })
			->skip(0)->take(3)->get()->unique('id');
			$data['collection_id']='';
			$data['products']=json_decode(json_encode($data['products']),true);*/
			$data['collection_id']='';
			$prod = DB::select("select `products`.*,
categorey.categorey_name as cat_name,
occassion.occassion_name as oc_name,
gemstones.name as stone_name,
collection.collection_name as col_name,
product_meta.meta_thumb as meta_thumb, product_meta.meta_link as meta_link
from `products`
INNER join `categorey` on FIND_IN_SET(categorey.id,products.categorey_id) > '0'
INNER join `occassion` on FIND_IN_SET(occassion.id,products.occasion_type) > '0'
INNER join `gemstones` on FIND_IN_SET(gemstones.id,products.stone_type) > '0'
INNER join `collection` on FIND_IN_SET(collection.id,products.collection_id) > '0'
INNER join `product_meta` on FIND_IN_SET(product_meta.product_id,products.id) > '0'
where
`products`.`status` = 1
AND
`product_meta`.`meta_link` !=''
and
(
`product_name` LIKE '%".$_GET['search']."%'
or
`categorey`.`categorey_name` LIKE '%".$_GET['search']."%'
or
`products`.`design_style` LIKE '%".$_GET['search']."%'
or
`occassion`.`occassion_name` LIKE '%".$_GET['search']."%'
or
`products`.`diamond_type` LIKE '%".$_GET['search']."%'
or
`collection`.`collection_name` LIKE '%".$_GET['search']."%'
or
`products`.`description` LIKE '%".$_GET['search']."%'
)");
$prod=json_decode(json_encode($prod),true);
$final_arr=array();
foreach($prod as $p)
{
	
		$final_arr[$p['id']]=$p;
	
	
}
$data['products']=$final_arr;
		}
		else 
		{
				$collection_id=getSinglerow('collection','id',array('slug'=>$slug));
				$data['collection_id']=$collection_id;
				$data['products']=Products::select('products.*','product_meta.meta_link','product_meta.meta_thumb')->join('product_meta','products.id','=','product_meta.product_id')->where('products.collection_id',$collection_id)->where('products.status','1')->where('product_meta.meta_link','!=','')->where('product_meta.meta_type',1)->skip(0)->take(8)->get()->toArray();
		}
		return view('collection_list',$data);
	}
   public function user_signup(Request $request)
	{
		$validator = Validator::make($request->all(),['name'=>'required','email'=>'required|email','mobile_no'=>'required|numeric','password'=>'required']);
		if($validator->passes())
		{
			$is_exists = User::where('email',$request->email)->get()->first();
			if($is_exists)
			{
				$arr=array('status'=>'false','message'=>'E-Mail Already Exists');
			}
			else 
			{
				$otp=rand(50000,90000);
				$user = new User();
				$user->name=$request->name;
				$user->email=$request->email;
				$user->code=$request->code;
				$user->mobile=$request->mobile_no;
				$user->password=md5($request->password);
				$user->user_avatar=' ';
				$user->address=' ';
				$user->hash=' ';
				$user->role=2;
				$user->status=0;
				$user->otp=$otp;
				$user->save();
				$arr=array('status'=>'true','message'=>'Success','otp'=>$user->user_id);
				$link=url('verify_email/'.$user->user_id);
				$message='You have register with '.get_setting('site_title').' ,Use this OTP '.$otp.' to verify your account';
				$message='You have register with Tarasri ,Use this OTP '.$otp.' to verify your account';
				$this->msg91api($request->code.$request->mobile_no,$otp);
				$zohoData = array(
					"SingleLine"=>$request->mobile_no,
					"SingleLine1"=>$request->name,
					"SingleLine2"=>$user->user_id,
					"SingleLine3"=>$request->email
				);
				$this->saveUser($zohoData);
				send_email($request->email,get_setting('site_title').' Customers Account OTP ','info@tarasri.in',$message);
				//send_email($request->email,get_setting('site_title').' Email Validation','info@ewayits.com',$message);
			}
		}
		else 
		{
			$arr=array('status'=>'false','message'=>$validator->errors()->all());
		}
		echo json_encode($arr);
	}
	public function msg91api($mobile,$message)
	{
		$authKey = "252284Am01lETO5c17c6a0";
		$url = "https://api.msg91.com/api/v5/otp?authkey=$authKey&mobile=$mobile&otp=".$message;
		$curl = curl_init();
		curl_setopt_array($curl, array(
		  CURLOPT_URL => $url,
		  CURLOPT_RETURNTRANSFER => true,
		  CURLOPT_ENCODING => "",
		  CURLOPT_MAXREDIRS => 10,
		  CURLOPT_TIMEOUT => 30,
		  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		  CURLOPT_CUSTOMREQUEST => "GET",
		  CURLOPT_SSL_VERIFYHOST => 0,
		  CURLOPT_SSL_VERIFYPEER => 0,
		  CURLOPT_HTTPHEADER => array(
			"content-type: application/json"
		  ),
		));

		$response = curl_exec($curl);
		$err = curl_error($curl);

		curl_close($curl);

		if ($err) {
		  echo "cURL Error #:" . $err;
		} else {
		  // echo $response;
		}
		/*//Your authentication key
		//Multiple mobiles numbers separated by comma
		$mobileNumber = $mobile;
		//Sender ID,While using route4 sender id should be 6 characters long.
		$senderId = "TARASI";
		//Your message to send, Add URL encoding here.
		$message = urlencode($message);
		//Define route 
		$route = "default";
		//Prepare you post parameters
		$postData = array(
			'authkey' => $authKey,
			'mobiles' => $mobileNumber,
			'message' => $message,
			'sender' => $senderId,
			'route' => $route
		);
		//API URL
		$url="http://api.msg91.com/api/sendhttp.php";
		// init the resource
		$ch = curl_init();
		curl_setopt_array($ch, array(
			CURLOPT_URL => $url,
			CURLOPT_RETURNTRANSFER => true,
			CURLOPT_POST => true,
			CURLOPT_POSTFIELDS => $postData
			//,CURLOPT_FOLLOWLOCATION => true
		));
		//Ignore SSL certificate verification
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
		//get response
		$output = curl_exec($ch);
		//Print error if any
		if(curl_errno($ch))
		{
			curl_error($ch);
		}
		curl_close($ch);*/
	}
	public function saveUser($data){
        $result = get_curl('https://forms.zohopublic.com/anandgupta1/form/Users/formperma/2mxWtrT_G05H6jykIXeP1yi6ebYh1opUFPujwh9CfBc/htmlRecords/submit','POST',$data);
        return $result;
    }
	public function resend_otp($user_id)
	{
		$user_info=User::select('*')->where('user_id',$user_id)->get()->first();
		$message='You have register with Tarasri ,Use this OTP '.$user_info->otp.' to verify your account';
		$this->msg91api($user_info->code.$user_info->mobile,$user_info->otp);
		
	}
	public function userlogin(Request $request)
	{
		$is_existsemail = User::where('email',$request->username)->where('role',2)->where('password',md5($request->password))->get()->first();
		if(!$is_existsemail)
			$is_existsemail = User::where('mobile',$request->username)->where('role',2)->where('password',md5($request->password))->get()->first();
		if($is_existsemail)
		{
			if($is_existsemail->otp)
			{
				$arr=array('status'=>'false','message'=>'otp','user_id'=>$is_existsemail->user_id);
			}
			else if($is_existsemail->status==0)
			{
				$arr=array('status'=>'false','message'=>'Your Account inactive');
			}
			else 
			{
				if($is_existsemail)
					$request->session()->put('usersession',$is_existsemail);
				else 
					$request->session()->put('usersession',$is_existsmobile);
				$arr=array('status'=>'true','message'=>'Success','reload'=>url(''));
			}
		}
		else 
		{
			$arr=array('status'=>'false','message'=>'E-Mail / Mobile Not Match Any Account');
		}
		echo json_encode($arr);
	}
	public function otp_check(Request $request)
	{
		$user = User::where('user_id',$request->user_id)->get()->first();
		if($user->otp==$request->otp)
		{
			$user->otp='';
			$user->status=1;
			$user->update();
			$arr=array('status'=>'true','message'=>'Your Account Successfully Verify . Please Login Your Account to Continue','reload'=>'0');
		}
		else 
		{
			$arr=array('status'=>'false','message'=>'OTP Not Metch');
		}
		echo json_encode($arr);
	}
	public function logout(Request $request)
	{
		$request->session()->forget('usersession');
		return redirect(url(''));
	}
	public function reset_password(Request $request)
	{
		$is_exists=User::where('email',$request->email)->get()->first();
		if($is_exists)
		{
			$new_password=rand(10000,15000);
			$is_exists->password=md5($new_password);
			$is_exists->update();
			$message='Hello '.$is_exists->name.' Your '.get_setting('site_title').' Account New Password Is '.$new_password;
			$resp =send_email($request->email,get_setting('site_title').' Account Password Reset','info@tarasri.in',$message);
			$arr=array('status'=>'true','message'=>'New Password send On your email','reload'=>'0');
		}
		else 
		{
			$arr=array('status'=>'false','message'=>'E-Mail Not Match Any Account');
		}
		echo json_encode($arr);
	}
	public function verify_email(Request $request,$id)
	{
		$user = User::where('user_id',$id)->get()->first();
		$user->status=1;
		$user->otp=' ';
		$user->update();
		$request->session()->put('ev','1');
		return redirect(url(''));
	}
	public function add_to_fevrate($prod_id,$user_id)
	{
		/*$is_exists=Favourites::where('user_id',$user_id)->where('product_id',$prod_id)->get()->first();
		if($is_exists)
		{
			$arr=array('status'=>'false','message'=>'This Product Already Added in Favourites');
			
		}
		else 
		{*/
			ini_set('display_errors', 1);
			ini_set('display_startup_errors', 1);
			error_reporting(E_ALL);

			$product_info  = Products::where('id',$prod_id)->get()->first();
			$user_info  = User::where('user_id',$user_id)->get()->first();
			
			$fev= new Favourites();
			$fev->product_id=$prod_id;
			$fev->user_id=$user_id;
			$fev->status=1;
			$fev->save();
			$arr=array('status'=>'true','message'=>'Product Successfully Added in Favourites');
			 $zohoData = array(
					"SingleLine"=>$user_id,
					"SingleLine1"=>$user_info->name,
					"SingleLine2"=>$user_info->email,
					"SingleLine3"=>$prod_id,
					"SingleLine4"=>$product_info->product_name
				);
			$this->saveFavourite($zohoData);
		/*}*/
		echo json_encode($arr);
	}
	public function saveFavourite($data){
        $result = get_curl('https://forms.zohopublic.com/anandgupta1/form/Favourites/formperma/dMSQJU4kUTZBrYhpWpDlqUMWbRXNGX-nUL9m66Ou06o/htmlRecords/submit','POST',$data);
        return $result;

    }
	public function remove_to_fevrate($prod_id,$user_id)
	{
		$is_exists=Favourites::where('user_id',$user_id)->where('product_id',$prod_id)->get()->first();
		if($is_exists)
		{
			$is_exists->delete();
		}
		echo json_encode(array('status'=>'true','message'=>'Product Successfully Remove in Favourites'));
	}
	public function my_favourites()
	{
		if(Session::get('usersession'))
		{
			$data['favourites']=Favourites::select(['favourites.*','product_meta.meta_link','product_meta.meta_thumb'])->where('favourites.user_id',Session::get('usersession')->user_id)->where('product_meta.meta_type',1)->join('product_meta','favourites.product_id','=','product_meta.product_id')->get()->unique('product_id');
			$data['favourites']=json_decode(json_encode($data['favourites']),true);
			return view('my_favourites',$data);
		}
		else 
		{
			return redirect(url(''));
		}
	}
	public function testimonial(Request $request)
	{
		$validator=Validator::make($request->all(),['message'=>'required']);
		if($validator->passes())
		{
			$test = new Testimonial();
			$test->comment=$request->message;
			$test->user_id=Session::get('usersession')->user_id;
			$test->status=0;
			$test->save();
			$arr=array('status'=>'true','message'=>'Testimonial Successfully Send','reload'=>'0');
		}
		else 
		{
			$arr=array('status'=>'false','message'=>$validator->errors()->all());
		}
		echo json_encode($arr);
	}
	public function about()
	{
		$data['about_us']=About_us::where('id',1)->get()->first();
		$data['testimonials']=Testimonial::select(['testimonials.*','user.name'])->join('user','testimonials.user_id','=','user.user_id')->where('testimonials.status',1)->get()->toArray();
		$data['load_home_utility']='yes';
		return  view('about',$data);
	}
	public function contactus(Request $request)
	{
		if(request()->ajax())
		{
			$validator=Validator::make($request->all(),['name'=>'required','email'=>'required|email','mobile_no'=>'required|numeric','message'=>'required']);
			$requests_array = request()->all();
			
			if($validator->passes())
			{
				if(!$requests_array["g-recaptcha-response"]){
					$arr=array('status'=>'false','message'=>"Please check captcha");
				} else {
					$contact = new Contact_us();
					$contact->name=$request->name;
					$contact->email=$request->email;
					$contact->mobile=$request->mobile_no;
					$contact->code=$request->code;
					$contact->message=$request->message;
					$contact->status=0;
					$contact->save();
					$message="Name : ".$request->name." email : ".$request->email." Mobile No : ".$request->mobile_no." Message : ".$request->message;
					send_email(get_setting('contactus_email'),'New Contact Query','info@tarasri.in',$message);
					$arr=array('status'=>'true','message'=>'Message Successfully Send','reload'=>'0');
				}
			} else {
				$arr=array('status'=>'false','message'=>$validator->errors()->all());
			}
			echo json_encode($arr);
		}
		else 
		{
			return view('contactus');
		}
	}
	public function left_filter(Request $request)
	{
		$categories=array();
		$gender=array();
		$stone=array();
		$occassions=array();
		$collection=array();
		$data=$request->all();
		
		if(isset($data['categories']))
			$categories=$data['categories'];
		if(isset($data['gender']))
			$gender=$data['gender'];
		if(isset($data['stone']))
			$stone=$data['stone'];
		if(isset($data['occassions']))
			$occassions=$data['occassions'];
		if(isset($data['collection']))
			$collection=$data['collection'];
		
		$data['products']=Products::select('products.*','product_meta.meta_link','product_meta.meta_thumb')->join('product_meta','products.id','=','product_meta.product_id')->where('products.status','1')
		->where(function($query) use($categories,$gender,$collection,$stone,$occassions) {
			if($categories)
				$query->whereIn('categorey_id',$categories);
			if($gender)
			   $query->WhereIn('gender',$gender);
			if($collection)
			   $query->whereIn('collection_id',$collection);
			if($stone)
			   $query->whereIn('stone_type',$stone);
			if($occassions)
			   $query->whereIn('occasion_type',$occassions);
		})->get();
			$data['collection_id']='';
			$products_rows =json_decode(json_encode($data['products']),true);
			// print_r($products_rows);
			$products_rows_array = array();
			foreach($products_rows as $values)
			{
			    $products_rows_array[$values["id"]] = $values;
			}
			$data['products'] = $products_rows_array;
		return view('render.left_filter',$data);
	}
	public function privacy_policy()
	{
		return view('privacy_policy');
	}
	public function terms_conditions()
	{
		return view('terms_conditions');
	}
	public function tara_sri_exclusive()
	{
		$data['exc']=Tara_exclusive::where('id','1')->get()->first();
		return view('tara_sri_exclusive',$data);
	}
	public function crimsonbride($slug)
	{
		$data['crimsonbride']=Crimsonbride::where('slug',$slug)->get()->first();
		$data['CrimsonbrideImages']=CrimsonbrideImages::where('reffrence',$data['crimsonbride']->reffrence)->get()->toArray();
		return view('crimsonbride',$data);
		
	}
	public function blogList($tag='')
	{
		if($tag)
		{
			$tag=str_replace('-',' ',$tag);
			$data['blog_list']=Blog::select(['blogs.*','blog_categories.name as cat_name'])->join('blog_categories','blogs.parent_category','=','blog_categories.id')->orderBy('id','desc')->where('blogs.status','1')->whereRaw("find_in_set('".$tag."',tags)")->get()->toArray();
		}
		else 
		{
			$data['blog_list']=Blog::select(['blogs.*','blog_categories.name as cat_name'])->join('blog_categories','blogs.parent_category','=','blog_categories.id')->orderBy('id','desc')->where('blogs.status','1')->get()->toArray();
		}
		
		$data['latest_list']=Blog::select(['blogs.*','blog_categories.name as cat_name'])->join('blog_categories','blogs.parent_category','=','blog_categories.id')->orderBy('id','desc')->where('blogs.status','1')->limit(5)->get()->toArray();
		$data['category']=BlogCategory::where('status','1')->get()->toArray();
		$data['product_category']=Categorey::where('status','1')->get()->toArray();
		$data['gemstone']=Gemstone::where('status','1')->get()->toArray();
		$data['occassion']=Occassion::where('status','1')->get()->toArray();
		$data['collection']=Collection::where('status','1')->get()->toArray();	
	    return view('blog_list',$data);
	}

	public function blogList1($tag='')
	{
		if($tag)
		{
			$tag=str_replace('-',' ',$tag);
			$data['blog_list']=Blog::select(['blogs.*','blog_categories.name as cat_name'])->join('blog_categories','blogs.parent_category','=','blog_categories.id')->orderBy('id','desc')->where('blogs.status','1')->whereRaw("find_in_set('".$tag."',tags)")->get()->toArray();
		}
		else 
		{
			$data['blog_list']=Blog::select(['blogs.*','blog_categories.name as cat_name'])->join('blog_categories','blogs.parent_category','=','blog_categories.id')->orderBy('id','desc')->where('blogs.status','1')->get()->toArray();
		}
		
		$data['latest_list']=Blog::select(['blogs.*','blog_categories.name as cat_name'])->join('blog_categories','blogs.parent_category','=','blog_categories.id')->orderBy('id','desc')->where('blogs.status','1')->limit(5)->get()->toArray();
		$data['category']=BlogCategory::where('status','1')->get()->toArray();
		$data['product_category']=Categorey::where('status','1')->get()->toArray();
		$data['gemstone']=Gemstone::where('status','1')->get()->toArray();
		$data['occassion']=Occassion::where('status','1')->get()->toArray();
		$data['collection']=Collection::where('status','1')->get()->toArray();	
	    return view('blogListNew',$data);
	}
	public function left_filter_blog(Request $request)
	{
		$categories=array();
		$pcategories=array(); 
		$stone=array();
		$occassions=array();
		$collection=array();
		$data=$request->all();
		
		if(isset($data['categories']))
			$categories=$data['categories'];
		if(isset($data['pcategories']))
			$pcategories=$data['pcategories'];
		if(isset($data['stone']))
			$stone=$data['stone'];
		if(isset($data['occassions']))
			$occassions=$data['occassions'];
		if(isset($data['collection']))
			$collection=$data['collection'];
		
		
		
		$data['products']=Blog::select(['blogs.*','blog_categories.name as cat_name'])->join('blog_categories','blogs.parent_category','=','blog_categories.id')->where('blogs.status','1')
		->where(function($query) use($categories,$collection,$stone,$occassions,$pcategories ) {
			if($categories)
			{
				foreach($categories as $key => $cat)
				{
					if($key==0)
						$query->whereRaw("find_in_set('".$cat."',parent_category)");
					else 
						$query->orWhereRaw("find_in_set('".$cat."',parent_category)");
				}
			}
			if($collection)
			{
				foreach($collection as $ckey => $col)
				{
					if($ckey==0)
						$query->whereRaw("find_in_set('".$col."',collection)");
					else 
						$query->orWhereRaw("find_in_set('".$col."',collection)");
				}
			}
			if($stone)
			{
				foreach($stone as $skey => $s)
				{
					if($skey==0)
						$query->whereRaw("find_in_set('".$s."',stone)");
					else 
						$query->orWhereRaw("find_in_set('".$s."',stone)");
				}
			}
			if($occassions)
			{
				foreach($occassions as $okey => $occ)
				{
					if($okey==0)
						$query->whereRaw("find_in_set('".$occ."',occasion)");
					else 
						$query->orWhereRaw("find_in_set('".$occ."',occasion)");
				}
			}
			if($pcategories)
			{
				foreach($pcategories as $pckey => $pcat)
				{
					if($pckey==0)
						$query->whereRaw("find_in_set('".$pcat."',category)");
					else 
						$query->orWhereRaw("find_in_set('".$pcat."',category)");
				}
			}
		})->get()->unique('id');
		$data['blog_list']=json_decode(json_encode($data['products']),true);
		return view('render.left_filter_blog',$data);
	}
	public function blog_search(Request $request)
	{
		$data['products'] = \DB::table("blogs")
			->select("blogs.*",\DB::raw("blog_categories.name as cat_name"))
			->leftjoin("blog_categories",\DB::raw("FIND_IN_SET(blog_categories.id,blogs.parent_category) "),">",\DB::raw("'0'"))
			->leftjoin("occassion",\DB::raw("FIND_IN_SET(occassion.id,blogs.occasion) "),">",\DB::raw("'0'"))
			->leftjoin("gemstones",\DB::raw("FIND_IN_SET(gemstones.id,blogs.stone) "),">",\DB::raw("'0'"))
			->leftjoin("collection",\DB::raw("FIND_IN_SET(collection.id,blogs.collection) "),">",\DB::raw("'0'"))
			->leftjoin("categorey",\DB::raw("FIND_IN_SET(categorey.id,blogs.category) "),">",\DB::raw("'0'"))
			->where('blogs.status','1')
			->where(function($q1){
				 $q1->where('blog_categories.name', 'LIKE', "%{$_POST['data']}%")
				 ->Orwhere('blogs.title', 'LIKE', "%{$_POST['data']}%")
				 ->Orwhere('occassion.occassion_name', 'LIKE', "%{$_POST['data']}%")
				 ->Orwhere('gemstones.name', 'LIKE', "%{$_POST['data']}%")
				 ->Orwhere('collection.collection_name', 'LIKE', "%{$_POST['data']}%")
				 ->Orwhere('categorey.categorey_name', 'LIKE', "%{$_POST['data']}%")
				 ->Orwhere('description', 'LIKE', "%{$_POST['data']}%");
			 })
			->get()->unique('id');
			$data['collection_id']='';
			$data['blog_list']=json_decode(json_encode($data['products']),true);
			return view('render.left_filter_blog',$data);
	}
	public function blog_single()
	{
		return view('blog_single');
	}
	public function blog_single_dev($slug)
	{
		$data['blog_list']=Blog::select(['blogs.*','blog_categories.name as cat_name'])->join('blog_categories','blogs.parent_category','=','blog_categories.id')->orderBy('id','desc')->where('blogs.slug',$slug)->get()->first();
		if($data['blog_list'])
		{
			$cat=$data['blog_list']->parent_category;
			if($cat)
			{
				$cat=explode(',',$cat);
				$rand_no=rand(0,count($cat)-1);
				$cat=$cat[$rand_no];
				$data['related_list']=Blog::select(['blogs.*','blog_categories.name as cat_name'])->join('blog_categories','blogs.parent_category','=','blog_categories.id')->orderBy('id','desc')->where('blogs.status','1')->where('slug','!=',$data['blog_list']->slug)->whereRaw("find_in_set('".$cat."',parent_category)")->limit(5)->get()->toArray();
			}
			else 
			{
				
				$data['related_list']=Blog::select(['blogs.*','blog_categories.name as cat_name'])->join('blog_categories','blogs.parent_category','=','blog_categories.id')->inRandomOrder()->where('blogs.status','1')->where('slug','!=',$data['blog_list']->slug)->limit(5)->get()->toArray();
			}
			$data['latest_list']=Blog::select(['blogs.*','blog_categories.name as cat_name'])->join('blog_categories','blogs.parent_category','=','blog_categories.id')->orderBy('id','desc')->where('blogs.status','1')->where('slug','!=',$data['blog_list']->slug)->limit(2)->get()->toArray();
			$data['blog_images']=Blog_image::where('reffrence',$data['blog_list']->reffrence)->get()->toArray();
			return view('blog_single_dev',$data);
		}
	}
	public function blog_comment(Request $request)
	{
		$blog = new BlogComment();
		$blog->user_id=$request->user_id;
		$blog->blog_id=$request->blog_id;
		$blog->comment=$request->comment;
		$blog->save();
		echo json_encode(array('status'=>'true','message'=>'Comment Successfully Send','reload'=>'0'));
	}
	public function landing_page($slug)
	{
		$data['pages'] = Landingpage::where('slug',$slug)->get()->first();
		$data['page_data']= Landingpage_editor::orderBy('id','ASC')->where('parent',$data['pages']['id'])->get()->toArray();
		return view('landing_page',$data);
	}
	public function product_enquiry(Request $request)
	{
		$validator = Validator::make($request->all(),['message'=>'required']);
		if($validator->passes())
		{
			$user_info=User::where('user_id',$request->user_id)->get()->first();
			$en = new Enquiry();
			$en->name=$user_info->name;
			$en->email=$user_info->email;
			$en->mobile=$user_info->mobile;
			$en->message=$request->message;
			$en->product_id=$request->product_id;
			$en->save();
			$last_id = $en->id;
			
			$inq = Enquiry::where("id",$last_id)->get()->first();
			$time = date("d, M Y h:i a", strtotime($inq->created_at));
			$img = Product_meta::where("product_id",$request->product_id)->where("meta_type",1)->get()->first();
			$product_image = '';
			if($img){
				$s3_bucket_url = \Config::get('app.s3_bucket_url');
				$product_image = $s3_bucket_url.$img->meta_link;
			}
			
			$product_id = $request->product_id;
			$name = $user_info->name;
			$email = $user_info->email;
			$mobile = $user_info->mobile;
			$message1 = $request->message;
			
			$pd_name = getSinglerow('products','product_name',array('id'=>$product_id));
			$pd_design = getSinglerow('products','design_model_no',array('id'=>$product_id));
			 $message  = '<table style="border:solid 1px #ccc;border-radius:10px;padding:20px;">
								<tr><th style="text-align:center;"><h3>New Product Inquiry</h3></th></tr>
								<tr><td style="text-align:center;"><h4><u>Product Detail:</u></h4></td></tr>
								<tr>
									<td><img height="300" src="'.$product_image.'"></td>
								</tr>
								<tr>
									<td style="padding:10px 2px;">
									Product Name : '.$pd_name.'
									</td>
								</tr>
								<tr>
									<td style="padding:10px 2px;">
									Product Design Number : '.$pd_design.'
									</td>
								</tr>
								<tr><td style="text-align:center;" ><h4><u>User Detail:</u></h4></td></tr>
								<tr><td style="padding:10px 2px;" >Name : '.$name.'</td></tr>
								<tr><td style="padding:10px 2px;" >Email : '.$email.'</td></tr>
								<tr><td style="padding:10px 2px;" >Mobile No : '.$mobile.'</td></tr>
								<tr><td style="padding:10px 2px;" >Message :'.$message1.'</td></tr> 
								<tr><td style="padding:10px 2px;" >Inquiry Time : <b>'.$time.'</b></td></tr>
							</table> ';
	
			$to = get_setting('enquiry_email');
	//	$to = 'deependra.eway@gmail.com';
            $subject = 'New Product Inquiry';
            $from = 'info@tarasri.in';
             
            // To send HTML mail, the Content-type header must be set
            $headers  = 'MIME-Version: 1.0' . "\r\n";
            $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
             
            // Create email headers
            $headers .= 'From: '.$from."\r\n".
                'Reply-To: '.$from."\r\n" .
                'X-Mailer: PHP/' . phpversion();
             
            // Sending email
            mail($to, $subject, $message, $headers);
			$arr=array('status'=>'true','message'=>'Request Successfully Send','reload'=>'0');
			/* send email end */
		} 
		else 
		{
			$arr=array('status'=>'flase','message'=>$validator->errors()->all());
		}
		echo json_encode($arr);
	}
	public function load_more_products(Request $request)
	{
	    $slug = $request->slug;
	    $limit = $request->limit;
	    $collection_id=getSinglerow('collection','id',array('slug'=>$slug));
		$data['collection_id']="";
		$data['products']=Products::select('products.*','product_meta.meta_link','product_meta.meta_thumb')->join('product_meta','products.id','=','product_meta.product_id')->where('products.collection_id',$collection_id)->where('products.status','1')->where('product_meta.meta_type',1)->skip($limit)->take(8)->get()->toArray();
		$data["load_more"] = "load_more";
		return view('render.load_more_products',$data);
	}
}
