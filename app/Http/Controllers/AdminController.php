<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\model\Categorey;
use App\model\Collection;
use App\model\Occassion;
use App\model\Blog;
use App\model\Enquiry;
use App\model\Contact_us;
use App\model\Tara_exclusive;
use App\model\Products;
use App\model\User;
use App\model\Testimonial;
use App\model\Gemstone;
use App\model\Blog_image;
use App\model\Crimsonbride;
use App\model\CrimsonbrideImages;
use App\model\Landingpage;
use App\model\Landingpage_editor;
use App\model\BlogCategory;
use App\model\BlogComment;
use App\model\Setting;
use Session;
use Validator;
class AdminController extends Controller
{
    public function index(Request $request)
    {
		if($request->segment(3))
		{
			$year=$request->segment(3);
			if(date('Y')==$year)
			{
				$month = date('m');
			}
			else 
			{
				$month=12;
			}	
		}
		else 
		{
			$year=date('Y');
			$month = date('m');
		}
		$data['char_arr']=array(array('Month','Customers','Enquiry'));
		
		if($request->segment(3) && date('Y')!=$request->segment(3))
		{
			for($mon=$month;$mon>=1;$mon--)
			{
				$data['char_arr'][]=array(
					date('M',strtotime('2020-'.$mon.'-01')),
					get_usercount_for_chart($year.'-'.date('M',strtotime('2020-'.$mon.'-01')).'-01',$year.'-'.date('M',strtotime('2020-'.$mon.'-01')).'-30'),
					get_enqcount_for_chart($year.'-'.date('M',strtotime('2020-'.$mon.'-01')).'-01',$year.'-'.date('M',strtotime('2020-'.$mon.'-01')).'-30'),
					);
			}
		}
		else 
		{
			$data['char_arr'][]=array(
								date('M'),
								get_usercount_for_chart($year.'-'.date('m').'-01',$year.'-'.date('m').'-30'),
								get_enqcount_for_chart($year.'-'.date('m-').'01',$year.'-'.date('m-').'30')
							 );
			for($i=1;$i<$month;$i++)
			{
				$data['char_arr'][]=array(
					date("M",strtotime("-".$i." month")),
					get_usercount_for_chart($year.'-'.date("m",strtotime("-".$i." month")).'-01',$year.'-'.date("m",strtotime("-".$i." month")).'-30'),
					get_enqcount_for_chart($year.'-'.date("m",strtotime("-".$i." month")).'-01',$year.'-'.date("m",strtotime("-".$i." month")).'-30'),
					);
			}
		}
		
		$data['users_count']=User::select("user_id")->where('role',2)->get()->count();
		$data['product_count']=Products::select("id")->where('status',1)->get()->count();
		$data['contact_count']=Contact_us::select("id")->get()->count();
		$data['enquiry_count']=Enquiry::select("id")->get()->count();
        return view('admin.dashboard',$data);
    }
    public function logout(Request $request)
    {
        $request->session()->forget('admin_session');
        return redirect('admin');
    }
    public function blog()
    {
        $data['blogs']=Blog::select(['blogs.*'])->orderBy('id','desc')->get()->toArray();
        return view('admin.blog',$data);
    }
    public function add_new_blog(Request $request) 
    {
        if(request()->ajax())
        {
            $validator=Validator::make($request->all(),['title'=>'required','slug'=>'required','description'=>'required','meta_description'=>'required','meta_keyword'=>'required','image'=>'required']);
            if($validator->passes())
            {
                $slug =strtolower($request->slug);
                $slug = str_replace(' ','-',$slug);
                $is_exists  = Blog::where('slug',$slug)->get()->first();
                if($is_exists)
                {
                    $arr=array('status'=>'false','message'=>'Slug Already Exists');
                }
                else 
                {
                   
				   if(!$request->image)
				   {
					   echo json_encode(array('status'=>'false','message'=>'Please Select Blog image'));
					   die();
				   }
				    if(is_array($request->blogcategory))
            		      $blogcategory = implode(',',$request->blogcategory);
            		   else 
            		        $blogcategory ='';
				   if(is_array($request->category))
				       $category = implode(',',$request->category);
				   else 
				        $category ='';
				        
				    if(is_array($request->collection))
				      $col=implode(',',$request->collection);
				    else 
				      $col='';
				      
				    if(is_array($request->occasion))
				      $occasion=implode(',',$request->occasion);
				    else 
				      $occasion='';
				      
				    if(is_array($request->stone))
				      $stone=implode(',',$request->stone);
				    else 
				      $stone='';
				      
                    $blog = new Blog();
                    $blog->title=$request->title;
                    $blog->slug=$slug;
                    $blog->reffrence=$request->reffrence;
                    $blog->category=$category;
                    $blog->description=$request->description;
                    $blog->meta_description=$request->meta_description;
                    $blog->meta_keyword=$request->meta_keyword;
                    $blog->collection=$col;
                    $blog->occasion=$occasion;
					$blog->stone=$stone;
					$blog->tags=$request->tags;
					$blog->parent_category=$blogcategory;
                    $blog->status=1;
					$blog->created_by=Session::get('admin_session')->user_id;
                    $blog->save();
                    $arr=array('status'=>'true','message'=>'Blog Successfully Added','reload'=>url('admin/blog'));  
                }
            }
            else 
            {
                $arr=array('status'=>'false','message'=>$validator->errors()->all());
            }
            echo json_encode($arr);
        }
        else 
        {
            $data['category']=Categorey::where('status','1')->get()->toArray();
            $data['collection']=Collection::where('status','1')->get()->toArray();
            $data['occassion']=Occassion::where('status','1')->get()->toArray();
			$data['stone']=Gemstone::where('status','1')->get()->toArray();
			$data['parent_category']=BlogCategory::where('status','1')->get()->toArray();
            return view('admin.add_new_blog',$data);
        }
    }
    public function upload_blog_image(Request $request,$reff)
    {
        $path = explode('app',__DIR__);
        $file = $request->file('file');
        $file->getClientOriginalName();
        $ext=$file->getClientOriginalExtension();
        $file->getRealPath();
        $file->getMimeType();
        $file_size=$file->getSize();
        if($ext=='jpg' || $ext=='png' || $ext=='jpeg' || $ext=='JPG' || $ext=='PNG' || $ext=='JPEG' || $ext=='svg')
        {
            $destinationPath = 'public/blog_images/';
            $file->getClientOriginalName();
            $file_name=$file->move($destinationPath,$file->getClientOriginalName());
			$blog_img = new Blog_image(); 
			$blog_img->reffrence=$reff;
			$blog_img->image=$file_name;
			$blog_img->save();
			
            $arr=array('status'=>'true','message'=>'success','data'=>$file_name,'image'=>url($file_name),'reff_id'=>$blog_img->id); 
        }
        else 
        {
            $arr=array('status'=>'false','message'=>'Only JPF,PNG And SVG File Are Allowed');
        }
        echo json_encode($arr);
    }
	public function blog_image_alt_text(Request $request)
	{
		$blog_img = Blog_image::where('id',$request->id)->get()->first();
		$blog_img->alt_text=$request->alt_text;
		$blog_img->update();
		echo json_encode(array('status'=>'true','message'=>'Blog Alt text Successfully Added','reload'=>'0'));
	}
    public function blog_operation(Request $request)
    {
        if($request->action=='status')
        {
            $blog = Blog::where('id',$request->id)->first();
            $blog->status=$request->status;
            echo $blog->update();
        }
        else if($request->action=='delete')
        {
            $blog = Blog::where('id',$request->id)->first();
            echo $blog->delete();
        }
    }
    public function edit_blog(Request $request,$id)
    {
        if(request()->ajax())
        {
            if(is_array($request->category))
		       $category = implode(',',$request->category);
		   else 
		        $category ='';
		        
		   if(is_array($request->blogcategory))
		      $blogcategory = implode(',',$request->blogcategory);
		   else 
		        $blogcategory ='';
		        
		    if(is_array($request->collection))
		      $col=implode(',',$request->collection);
		    else 
		      $col='';
		      
		    if(is_array($request->occasion))
		      $occasion=implode(',',$request->occasion);
		    else 
		      $occasion='';
		      
		    if(is_array($request->stone))
		      $stone=implode(',',$request->stone);
		    else 
		      $stone='';
		      
            $slug =strtolower($request->slug);
            $slug = str_replace(' ','-',$slug);
            $file_name='';
            $err=0;
            $blog_info = Blog::where('id',$request->id)->first();
            $blog = Blog::where('id',$id)->get()->first();
            $blog->title=$request->title;
            $blog->slug=$slug;
            $blog->category=$category;
            $blog->description=$request->description;
            $blog->meta_description=$request->meta_description;
            $blog->meta_keyword=$request->meta_keyword;
            $blog->collection=$col;
            $blog->occasion=$occasion;
			$blog->tags=$request->tags;
			$blog->stone=$stone;
			$blog->parent_category=$blogcategory;
            $blog->update();
            $arr=array('status'=>'true','message'=>'Blog Successfully Updated','reload'=>url('admin/blog'));   
            echo json_encode($arr);
        }
        else 
        {
            $data['blog'] = Blog::where('id',$request->id)->first();
            $data['category']=Categorey::where('status','1')->get()->toArray();
            $data['collection']=Collection::where('status','1')->get()->toArray();
            $data['occassion']=Occassion::where('status','1')->get()->toArray();
			$data['stone']=Gemstone::where('status','1')->get()->toArray();
			$data['blog_image']=Blog_image::where('reffrence',$data['blog']->reffrence)->get()->toArray();
			$data['parent_category']=BlogCategory::where('status','1')->get()->toArray();
            return view('admin.edit_blog',$data);
        }
    }
    public function enquiry()
    {
        $data['all_enquiry']=Enquiry::orderBy('id','desc')->get();
        return view('admin.enquiry',$data);
    }
    public function contactus()
    {
        $data['all_contact']=Contact_us::orderBy('id','desc')->get();
        return view('admin.contactus',$data);
    }
    public function tarasri_exclusive(Request $request)
    {
        if(request()->ajax())
        {
				$setting = Setting::where('key_text','tarasri_exclusive_status')->get()->first();
				$setting->key_value=$request->status;
				$setting->update();
				
                $about = Tara_exclusive::where('id',1)->get()->first();
                $about->title=$request->title;
                $about->banner_url=$request->image;
                $about->alt_text=$request->alt_text;
                $about->description=$request->description;
                $about->update();
                echo json_encode(array('status'=>'true','message'=>'Tarasri Exclusive Information Successfully Updated','reload'=>url('admin/tarasri_exclusive')));
        }
        else 
        {
            $data['tarasri_ex']=Tara_exclusive::where('id',1)->get()->first();
            return view('admin.tarasri_exclusive',$data);
        }
    }
    public function upload_tarasri_exclusive_image(Request $request)
    {
            $path = explode('app',__DIR__);
            $file = $request->file('banner');
            $file->getClientOriginalName();
            $ext=$file->getClientOriginalExtension();
            $file->getRealPath();
            $file_size=$file->getSize();
            if($ext=='jpg' || $ext=='png' || $ext=='jpeg' || $ext=='JPG' || $ext=='PNG' || $ext=='JPEG' || $ext=='svg')
            {
                $destinationPath = 'public/setting/';
                $file->getClientOriginalName();
                $file_name=$file->move($destinationPath,$file->getClientOriginalName());
                $arr=array('status'=>'true','message'=>'Success','image'=>url($file_name));
            }
            else 
            {
                $arr=array('status'=>'false','message'=>'Please Select Valid Image');
            }
            echo json_encode($arr);
    }
    public function profile(Request $request)
    {
        if(request()->ajax())
        {
            $validator = Validator::make($request->all(),['name'=>'required','email'=>'required|email','mobile_no'=>'required|numeric','confirm_password'=>'required_with:password|same:password']);
            if($validator->passes())
            {
                $usr = User::where('user_id',Session::get('admin_session')->user_id)->get()->first();
                $usr->name=$request->name;
                $usr->email=$request->email;
                $usr->mobile=$request->mobile_no;
                if($request->password)
                $usr->password=md5($request->password);
                $usr->update();
                $arr=array('status'=>'true','message'=>'Success','reload'=>'5');
            }
            else 
            {
                $arr=array('status'=>'false','message'=>$validator->errors()->all());
            }
            echo json_encode($arr);
        }
        else 
        {
            $user_info = User::where('user_id',Session::get('admin_session')->user_id)->get()->first();
            return view('admin.profile',['user_info'=>$user_info]);
        }
        
    }
    public function delete_image(Request $request)
    {
        $image =$request->image;
        unlink(explode('app',__DIR__)[0].$image);
    }
	public function testimonial()
	{
		$data['user']=User::where('role',2)->where('status',1)->get()->toArray();
		return view('admin.testimonial',$data);
	}
	public function get_testimonial(Request $request)
	{
		$columns = array( 
            0 =>'id', 
            1 =>'user_id',
			2 =>'comment', 
            3 =>'status',
        );  
        $totalData = Testimonial::count();            
        $totalFiltered = $totalData;
        $limit = $request->input('length');
        $start = $request->input('start');
        $order = $columns[$request->input('order.0.column')];
        $dir = $request->input('order.0.dir');
            
        if(empty($request->input('search.value')))
        {            
            $institutes = Testimonial::offset($start)
                         ->limit($limit)
                        ->orderBy($order,$dir)
                         ->get();
        }else {
            $search = $request->input('search.value'); 

            $institutes =  Testimonial::where('id','LIKE',"%{$search}%")
                            ->orWhere('comment', 'LIKE',"%{$search}%")
                            ->offset($start)
                            ->limit($limit)
                            ->orderBy($order,$dir)
                            ->get();

            $totalFiltered = Testimonial::where('id','LIKE',"%{$search}%")
                             ->orWhere('comment', 'LIKE',"%{$search}%")
                             ->count();
        }
        $data = array();
        if(!empty($institutes))
        {
            foreach ($institutes as $key=>$institute)
            {
                if($institute->status==1)
                    $chk="checked";
                else 
                    $chk='';
                $nestedData['id'] = $key+1;
                $nestedData['name'] = getSinglerow('user','name',array('user_id'=>$institute->user_id));
				$nestedData['email'] = getSinglerow('user','email',array('user_id'=>$institute->user_id));
				$nestedData['mobile'] = getSinglerow('user','mobile',array('user_id'=>$institute->user_id));
				$nestedData['description'] = $institute->comment;
                $nestedData['status'] = '<label class="switch"><input value="1" class="manage_status" name="status_'.$institute->id.'" data-id="'.$institute->id.'" data-url="'.url('admin/testimonial_manage_operation/').'" type="checkbox" '.$chk.'><span class="slider round"></span></label>';
                $nestedData['action'] = '<a data-url="'.url('admin/testimonial_manage_operation/').'" href="javascript:;" class="btn btn-info update_testimonial" data-id="'.$institute->id.'"  data-user="'.$institute->user_id.'" data-comment="'.$institute->comment.'" data-user="'.$institute->comment.'"><i class="fa fa-edit"></i></a>&nbsp;&nbsp;';
                $data[] = $nestedData;
            }

        }
        $json_data = array(
        "draw"            => intval($request->input('draw')),  
        "recordsTotal"    => intval($totalData),  
        "recordsFiltered" => intval($totalFiltered), 
        "data"            => $data   
        );            
        echo json_encode($json_data);
	}
	public function testimonial_manage_operation(Request $request)
	{
		if($request->action=='status')
        {
            $cat = Testimonial::where('id',$request->id)->first();
            $cat->status=$request->status;
            echo $cat->update();
        }
        else if($request->action=='insert')
        {
            $validator=Validator::make($request->all(),['user_id'=>'required','message'=>'required']);
            if($validator->passes())
            {
                $cat = new Testimonial();
                $cat->user_id=$request->user_id;
				$cat->comment=$request->message;
                $cat->status=1;
                $cat->save();
                $arr=array('status'=>'true','message'=>'Testimonial successfully Added','reload'=>'0');
            }
            else 
            {
                $arr=array('status'=>'false','message'=>$validator->errors()->all());
            }
            echo json_encode($arr);
        }
        else if($request->action=='update')
        {
            $validator=Validator::make($request->all(),['user_id'=>'required','message'=>'required']);
            if($validator->passes())
            {
                $cat =Testimonial::where('id',$request->id)->get()->first();
				$cat->user_id=$request->user_id;
				$cat->comment=$request->message;
                $cat->update();
                $arr=array('status'=>'true','message'=>'Testimonial successfully Updated','reload'=>'0');
            }
            else 
            {
                $arr=array('status'=>'false','message'=>$validator->errors()->all());
            }
            echo json_encode($arr);
        }
	}
	public function crimsonbride()
	{
		$data['crimsonbrides']=Crimsonbride::get()->toArray();
		return view('admin.crimsonbride',$data);
	}
	public function add_new_crimsonbride(Request $request)
	{
		if(request()->ajax())
		{
			$slug =strtolower($request->slug);
			$slug = str_replace(' ','-',$slug);
			$is_exists  = Crimsonbride::where('slug',$slug)->get()->first();
			if($is_exists)
			{
				$arr=array('status'=>'false','message'=>'Slug Already Exists');
			}
			else 
			{
				$cb = new Crimsonbride();
				$cb->title=$request->title;
				$cb->reffrence=$request->reffrence;
				$cb->slug=$slug;
				$cb->save();
				$arr=array('status'=>'true','message'=>'Crimson Bride Successfully Added','reload'=>url('admin/crimsonbride'));
			}
			echo json_encode($arr);
		}
		else 
		{
			return view('admin.add_new_crimsonbride');
		}
	}
	public function crimsonbride_operation(Request $request)
	{
		if($request->action=='status')
		{
			$cat = Crimsonbride::where('id',$request->id)->first();
            $cat->status=$request->status;
            echo $cat->update();
		}
		else if($request->action=='delete')
		{
			$cat = Crimsonbride::where('id',$request->id)->first();
			$reff=$cat->reffrence;
            $cat->delete();
			$image = CrimsonbrideImages::where('reffrence',$reff)->get()->toArray();
			foreach($image as $im)
			{
				$path = explode('app',__DIR__);
				unlink($path.$im['image']);
				$img = CrimsonbrideImages::where('id',$im['id'])->get()->first();
				$img->delete();
			}
		}
	}
	public function upload_crimsonbride_image(Request $request,$reff){
		$path = explode('app',__DIR__);
        $file = $request->file('file');
        $file->getClientOriginalName();
        $ext=$file->getClientOriginalExtension();
        $file->getRealPath();
        $file->getMimeType();
        $file_size=$file->getSize();
        if($ext=='jpg' || $ext=='png' || $ext=='jpeg' || $ext=='JPG' || $ext=='PNG' || $ext=='JPEG' || $ext=='svg')
        {
            $destinationPath = 'public/crimsonbride_images/';
            $file->getClientOriginalName();
            $file_name=$file->move($destinationPath,$file->getClientOriginalName());
			$blog_img = new CrimsonbrideImages(); 
			$blog_img->reffrence=$reff;
			$blog_img->image=$file_name;
			$blog_img->save();
            $arr=array('status'=>'true','message'=>'success','data'=>$file_name,'image'=>url($file_name),'reff_id'=>$blog_img->id); 
        }
        else 
        {
            $arr=array('status'=>'false','message'=>'Only JPF,PNG And SVG File Are Allowed');
        }
        echo json_encode($arr);
	}
	public function crimsonbride_image_alt_text(Request $request)
	{
		$blog_img = CrimsonbrideImages::where('id',$request->id)->get()->first();
		$blog_img->alt_text=$request->alt_text;
		$blog_img->update();
		echo json_encode(array('status'=>'true','message'=>'Crimson Bride Alt text Successfully Added','reload'=>'0'));
	}
	public function landing_page()
	{
		$data['landingpage']=Landingpage::get()->toArray();
		return view('admin.landing_page',$data);
	}
	public function add_landing_page(Request $request)
	{
		if(request()->ajax())
		{
				$slug =strtolower($request->slug);
                $slug = str_replace(' ','-',$slug);
                $is_exists  = Landingpage::where('slug',$slug)->get()->first();
                if($is_exists)
                {
                    $arr=array('status'=>'false','message'=>'Slug Already Exists');
                }
				else 
				{
					$page = new Landingpage();
					$page->title=$request->title;
					$page->show_position=$request->show_on;
					$page->slug=$slug;
					$page->status=0;
					$page->seo_title=$request->seo_title;
					$page->seo_keyowrd=$request->seo_keyowrd;
					$page->seo_description=$request->seo_description;
					$page->save();
					for($i=0;$i<count($_POST['description']);$i++)
					{
						$editor = new Landingpage_editor();
						$editor->description=$_POST['description'][$i];
						$editor->parent=$page->id;
						$editor->save();
					}
					$arr=array('status'=>'true','message'=>'Landing Page Successfully Added','reload'=>url('admin/landing-page'));
				}
				echo json_encode($arr);
		}
		else 
		{
			return view('admin.add_landing_page');
		}
	}
	public function edit_crimsonbride($id)
	{
		$data['crimsonbride'] = Crimsonbride::where('id',$id)->get()->first();
		$data['crimsonbride_image'] = CrimsonbrideImages::where('reffrence',$data['crimsonbride']->reffrence)->get();
		return view('admin.edit_crimsonbride',$data);
	}
	public function edit_landing_page(Request $request,$id)
	{
		if(request()->ajax())
		{
				$slug =strtolower($request->slug);
                $slug = str_replace(' ','-',$slug);
               
               
					$page = Landingpage::where('id',$id)->get()->first();
					$page->title=$request->title;
					$page->show_position=$request->show_on;
					$page->slug=$slug;
					$page->seo_title=$request->seo_title;
					$page->seo_keyowrd=$request->seo_keyowrd;
					$page->seo_description=$request->seo_description;
					$page->update();
					
					$editor = Landingpage_editor::where('parent',$id)->get()->first();
					$editor->description=$_POST['description'][0];
					$editor->update();
					$arr=array('status'=>'true','message'=>'Landing Page Successfully Updated','reload'=>url('admin/landing-page'));
				
				echo json_encode($arr);
		}
		else 
		{
			$data['landingpage']=Landingpage::where('id',$id)->get()->first();
			$data['landingpage_editor']=Landingpage_editor::orderBy('id','ASC')->where('parent',$id)->get()->toArray();
			return view('admin.edit_landing_page',$data);
		}
	}
	public function landing_page_operation(Request $request)
	{
		if($request->action=='status')
		{
			$cat = Landingpage::where('id',$request->id)->first();
            $cat->status=$request->status;
            echo $cat->update();
		}
		else if($request->action=='delete')
		{
			$ed = Landingpage_editor::where('parent',$request->id)->get()->toArray();
			foreach($ed as $e)
			{
				$cat1 = Landingpage_editor::where('id',$e['id'])->first();
				$cat1->delete();
			}
			$cat = Landingpage::where('id',$request->id)->first();
            echo $cat->delete();
			
			
		}
	}
	public function manageblogcategory()
	{
	    return view('admin.manageblogcategory');
	}
	public function get_blogcategory(Request $request)
    {
        $columns = array( 
            0 =>'id', 
            1 =>'name',
            2 =>'status',
        );  
        $totalData = BlogCategory::count();            
        $totalFiltered = $totalData;
        $limit = $request->input('length');
        $start = $request->input('start');
        $order = $columns[$request->input('order.0.column')];
        $dir = $request->input('order.0.dir');
            
        if(empty($request->input('search.value')))
        {            
            $institutes = BlogCategory::offset($start)
                         ->limit($limit)
                        ->orderBy($order,$dir)
                         ->get();
        }else {
            $search = $request->input('search.value'); 

            $institutes =  BlogCategory::where('id','LIKE',"%{$search}%")
                            ->orWhere('name', 'LIKE',"%{$search}%")
                            ->offset($start)
                            ->limit($limit)
                            ->orderBy($order,$dir)
                            ->get();

            $totalFiltered = BlogCategory::where('id','LIKE',"%{$search}%")
                             ->orWhere('name', 'LIKE',"%{$search}%")
                             ->count();
        }
        $data = array();
        if(!empty($institutes))
        {
            foreach ($institutes as $key=>$institute)
            {
                if($institute->status==1)
                    $chk="checked";
                else 
                    $chk='';
                $nestedData['id'] = $key+1;
                $nestedData['categorey_name'] = $institute->name;
                $nestedData['status'] = '<label class="switch"><input value="1" class="manage_status" name="status_'.$institute->id.'" data-id="'.$institute->id.'" data-url="'.url('admin/blogcategory_manage_operation/').'" type="checkbox" '.$chk.'><span class="slider round"></span></label>';
                $nestedData['action'] = '<a data-url="'.url('admin/blogcategory_manage_operation/').'" href="javascript:;" class="btn btn-info update_category" data-id="'.$institute->id.'"  data-cat="'.$institute->name.'"><i class="fa fa-edit"></i></a>&nbsp;&nbsp;';
                $data[] = $nestedData;
            }

        }
        $json_data = array(
        "draw"            => intval($request->input('draw')),  
        "recordsTotal"    => intval($totalData),  
        "recordsFiltered" => intval($totalFiltered), 
        "data"            => $data   
        );            
        echo json_encode($json_data);
    }
    public function blogcategory_manage_operation(Request $request)
    {
        if($request->action=='insert')
        {
            $validator = Validator::make($request->all(),['category_name'=>'required']);
            if($validator->passes())
            {
                $cat = new BlogCategory();
                $cat->name=$request->category_name;
                $cat->status=1;
                $cat->save();
                $arr=array('status'=>'true','message'=>'Category Successfully Added','reload'=>'0');
            }
            else 
            {
                $arr=array('status'=>'false','message'=>$validator->errors()->all());
            }
            echo json_encode($arr);
        }
        else if($request->action=='status')
        {
            $cat = BlogCategory::where('id',$request->id)->first();
            $cat->status=$request->status;
            echo $cat->update();
        }
        else if($request->action=='update')
        {
            $validator = Validator::make($request->all(),['category_name'=>'required']);
            if($validator->passes())
            {
                $cat = BlogCategory::where('id',$request->id)->get()->first();
                $cat->name=$request->category_name;
                $cat->update();
                $arr=array('status'=>'true','message'=>'Category Successfully Updated','reload'=>'0');
            }
            else 
            {
                $arr=array('status'=>'false','message'=>$validator->errors()->all());
            }
            echo json_encode($arr);
        }
    }
	public function blog_comment(){
		$data['blog_comments']=BlogComment::select(['blog_comments.*','user.name','blogs.title'])->join('user','blog_comments.user_id','=','user.user_id')->join('blogs','blog_comments.blog_id','=','blogs.id')->get()->toArray();
		return view('admin.blog_comment',$data);
	}
	public function upload(Request $request){
		if($request->hasFile('upload')) {
            $originName = $request->file('upload')->getClientOriginalName();
            $fileName = pathinfo($originName, PATHINFO_FILENAME);
            $extension = $request->file('upload')->getClientOriginalExtension();
            $fileName = $fileName.'_'.time().'.'.$extension;
        
            $request->file('upload')->move(public_path('ck_image'), $fileName);
   
            $CKEditorFuncNum = $request->input('CKEditorFuncNum');
            $url = asset('public/ck_image/'.$fileName); 
            $msg = 'Image uploaded successfully'; 
            $response = "<script>window.parent.CKEDITOR.tools.callFunction($CKEditorFuncNum, '$url', '$msg')</script>";
               
            @header('Content-type: text/html; charset=utf-8'); 
            echo $response;
        }
	}
	public function change_blog_manage_status1($status)
	{	
		 $setting = Setting::where('key_text','blog_manage_status')->first();
		 $setting->key_value=$status;
		 $resp = $setting->update();
		 if($resp)
			 echo 1;
		 else 
			 echo 0;
		 
	}
    function get_json($type)
    {
        if($type=='user_role')
        {
            $arr=array(
                array("data"=>"id"),
                array("data"=>"title"),
                array("data"=>"status"),
                array("data"=>"action"),
            );
        }
        else if($type=='user')
        {
            $arr=array(
                array("data"=>"id"),
                array("data"=>"name"),
                array("data"=>"email"),
                array("data"=>"mobile_no"),
                array("data"=>"role"),
                array("data"=>"created_date"),
                array("data"=>"status"),
                array("data"=>"action"),
            );
        }
        else if($type=="meta_seo_setting")
        {
            $arr=array(
                array("data"=>"id"),
                array("data"=>"page_name"),
                array("data"=>"title"),
                array("data"=>"description"),
                array("data"=>"keyword"),
                array("data"=>"action"),
            );
        }
        else if($type=="category")
        {
            $arr=array(
                array("data"=>"id"),
                array("data"=>"categorey_name"),
                array("data"=>"status"),
                array("data"=>"action"),
            );
        }
        else if($type=='collections')
        {
            $arr=array(
                array("data"=>"id"),
                array("data"=>"banner"),
                array("data"=>"collection_name"),
                array("data"=>"alt_text"),
                array("data"=>"status"),
                array("data"=>"action"),
            );
        }
        else if($type=='occasion')
        {
            $arr=array(
                array("data"=>"id"),
                array("data"=>"occassion_name"),
                array("data"=>"status"),
                array("data"=>"action"),
            );
        }
        else if($type=='products')
        {
            $arr=array(
                array("data"=>"id"),
                array("data"=>"product_title"),
                array("data"=>"design"),
                array("data"=>"category"),
                array("data"=>"description"),
                array("data"=>"status"),
                array("data"=>"action"),
            );
        }
		else if($type=='testimonial')
        {
            $arr=array(
                array("data"=>"id"),
                array("data"=>"name"),
                array("data"=>"email"),
                array("data"=>"mobile"),
                array("data"=>"description"),
                array("data"=>"status"),
                array("data"=>"action"),
            );
        }
        echo json_encode($arr);
    }
	
}
