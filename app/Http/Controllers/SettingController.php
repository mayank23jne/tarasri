<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\model\Setting;
use App\model\Seo_meta;
use App\model\Seo_file;
use App\model\About_us;
use App\model\Home_jewellery;
use App\model\Collection;
use App\model\Categorey;
use App\model\Products;
use App\model\Our_partner;
use Validator;
use Illuminate\Http\File;
use Illuminate\Support\Facades\Storage;

class SettingController extends Controller
{
    public function general_settings()
    {
        $data['files']=Seo_file::orderBy('id','desc')->get()->toArray();
        return view('admin.setting.general_settings',$data);
    }
    public function save_setting(Request $request)
    {
        $data=$request->all();
        unset($data['_token']);
        foreach($data as $key => $value)
        {
            if($key=='term_and_condition_description')
            {
				/*$setting1 = Setting::where('key_text','tarasri_exclusive_status')->get()->first();
				$setting1->key_value=$request->status;
				$setting1->update();*/
				
                $setting = Setting::where('key_text','term_and_condition_date')->get()->first();
                if($setting)
                {
                    $setting->key_value=date('Y-m-d h:i:s');
                    $setting->update();
                }
            }
            if($key=='privacypolicy_description')
            {
				/*$setting1 = Setting::where('key_text','privacy_policy_status')->get()->first();
				$setting1->key_value=$request->status;
				$setting1->update();*/
				
                $setting = Setting::where('key_text','privacypolicy_date')->get()->first();
                if($setting)
                {
                    $setting->key_value=date('Y-m-d h:i:s');
                    $setting->update();
                }
				
            }

            $setting = Setting::where('key_text',$key)->get()->first();
            if($setting)
            {
                $setting->key_value=$value;
                $setting->update();
            }
        }
        echo json_encode(array('status'=>'true','Message'=>'Setting Successfully Saved','reload'=>'5'));
    }
    public function get_meta_seo(Request $request)
    {
        $columns = array( 
            0 =>'id', 
            1 =>'page_name',
            2 =>'title',
            3 =>'description',
            4 =>'keywords',    
            5 =>'status',
        );  
        $totalData = Seo_meta::count();            
        $totalFiltered = $totalData;
        $limit = $request->input('length');
        $start = $request->input('start');
        $order = $columns[$request->input('order.0.column')];
        $dir = $request->input('order.0.dir');
            
        if(empty($request->input('search.value')))
        {            
            $institutes = Seo_meta::offset($start)
                         ->limit($limit)
                         ->orderBy($order,$dir)
                         ->get();
        }else {
            $search = $request->input('search.value'); 

            $institutes =  Seo_meta::where('id','LIKE',"%{$search}%")
                            ->orWhere('title', 'LIKE',"%{$search}%")
                            ->orWhere('page_name', 'LIKE',"%{$search}%")
                            ->orWhere('description', 'LIKE',"%{$search}%")
                            ->orWhere('keywords', 'LIKE',"%{$search}%")
                            ->offset($start)
                            ->limit($limit)
                            ->orderBy($order,$dir)
                            ->get();

            $totalFiltered = Seo_meta::where('id','LIKE',"%{$search}%")
                            ->orWhere('title', 'LIKE',"%{$search}%")
                            ->orWhere('page_name', 'LIKE',"%{$search}%")
                            ->orWhere('description', 'LIKE',"%{$search}%")
                            ->orWhere('keywords', 'LIKE',"%{$search}%")
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
                $nestedData['page_name'] = $institute->page_name;
                $nestedData['title'] = $institute->title;
                $nestedData['description'] = $institute->description;
                $nestedData['keyword'] = $institute->keywords;
                $nestedData['action'] = '<a data-url="'.url('admin/setting/meta_seo_manage_operation/').'" href="javascript:;" class="btn btn-info update_meta_seo" data-id="'.$institute->id.'" data-page="'.$institute->page_name.'" data-title="'.$institute->title.'" data-keywords="'.$institute->keywords.'" data-description="'.$institute->description.'"><i class="fa fa-edit"></i></a>&nbsp;&nbsp;<a data-url="'.url('admin/users/meta_seo_manage_operation/').'" href="javascript:;" class="btn btn-danger delete_meta_seo" data-id="'.$institute->id.'"><i class="fa fa-trash"></i></a>';
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
    public function meta_seo_manage_operation(Request $request)
    {
        if($request->action=='insert')
        {
            $validator = Validator::make($request->all(),['page_name'=>'required','title'=>'required']);
            if($validator->passes())
            {
                $seo = new Seo_meta();
                $seo->page_name=$request->page_name;
                $seo->title=$request->title;
                $seo->description=$request->description;
                $seo->keywords=$request->keywords;
                $seo->save();
                $arr=array('status'=>'true','message'=>'Page Meta Successfully Added','reload'=>url('admin/setting/general_settings'));
            }
            else 
            {
                $arr=array('status'=>'false','message'=>$validator->errors()->all());
            }
            echo json_encode($arr);
        }
        else if($request->action=='delete')
        {
            $seo =Seo_meta::where('id',$request->id)->get()->first();
            if($seo)
            {
                $seo->delete();
            }
        }
        if($request->action=='update')
        {
            $validator = Validator::make($request->all(),['page_name'=>'required','title'=>'required']);
            if($validator->passes())
            {
                $seo = Seo_meta::where('id',$request->id)->get()->first();
                $seo->page_name=$request->page_name;
                $seo->title=$request->title;
                $seo->description=$request->description;
                $seo->keywords=$request->keywords;
                $seo->update();
                $arr=array('status'=>'true','message'=>'Page Meta Updated Added','reload'=>url('admin/setting/general_settings'));
            }
            else 
            {
                $arr=array('status'=>'false','message'=>$validator->errors()->all());
            }
            echo json_encode($arr);
        }

    }
    public function save_image(Request $request)
    {
         $path = explode('app',__DIR__);
         $file = $request->file($request->action);
         $file->getClientOriginalName();
         $ext=$file->getClientOriginalExtension();
         $file->getRealPath();
         $file->getMimeType();
         $file_size=$file->getSize();
         if($file_size<100000000)
         {
            $destinationPath = 'public/setting/';
            $file->getClientOriginalName();
            if($ext=='jpg' || $ext=='png' || $ext=='jpeg' || $ext=='JPG' || $ext=='PNG' || $ext=='JPEG' || $ext=='svg' || $ext=='ico')
            {
                    $old_file=$path[0].get_setting($request->action);
                    if(file_exists($old_file))
                    {
                        unlink($old_file);
                    }
                    $file_name=$file->move($destinationPath,$file->getClientOriginalName());
                    $setting=Setting::where('key_text',$request->action)->get()->first();
                    $setting->key_value=$file_name;
                    $setting->update();
                    $arr=array('status'=>'true','message'=>'Image Successfully Saved','reload'=>url('admin/setting/general_settings'),'image'=>url($file_name));    
            }
            else 
            {
                $arr=array('status'=>'false','message'=>'Only JPN,PNG,JPEG And SVG Files Are Allowed');
            }
            echo json_encode($arr);
         }
    }
    public function seoFileOperation(Request $request)
    {
        if($request->action=='insert') {
        $path = explode('app',__DIR__);
        $file = $request->file('file');
        $file->getClientOriginalName();
        $ext=$file->getClientOriginalExtension();
        $file->getRealPath();
        $file->getMimeType();
        $file_size=$file->getSize();
        if($file_size<100000000)
        {
            $destinationPath = $path[0];
            $file->getClientOriginalName();
            $file_name=$file->move($destinationPath,$file->getClientOriginalName());
            $setting=new Seo_file();
            $setting->title=$request->title;
            $setting->file=$file_name;
            $setting->save();
            $arr=array('status'=>'true','message'=>'File Successfully Saved','reload'=>url('admin/setting/general_settings'));    
            echo json_encode($arr);
        }
      }
      else if($request->action=='update')
      {
        $path = explode('app',__DIR__);
        $file = $request->file('file');
        $file->getClientOriginalName();
        $ext=$file->getClientOriginalExtension();
        $file->getRealPath();
        $file_size=$file->getSize();
        if($file_size<100000000)
        {
            $info = Seo_file::where('id',$request->id)->get()->first();
            unlink($info->file);
            $destinationPath = $path[0];
            $file->getClientOriginalName();
            $file_name=$file->move($destinationPath,$file->getClientOriginalName());
            $setting=Seo_file::where('id',$request->id)->get()->first();
            $setting->title=$request->title;
            $setting->file=$file_name;
            $setting->update();
            $arr=array('status'=>'true','message'=>'File Successfully Updated','reload'=>url('admin/setting/general_settings'));    
            echo json_encode($arr);
      }
      }
    }
    public function aboutUs(Request $request)
    {
        if(request()->ajax())
        {
			$setting = Setting::where('key_text','about_page_status')->get()->first();
			$setting->key_value=$request->status;
			$setting->update();
			
			$setting1 = Setting::where('key_text','about_page_location')->get()->first();
			$setting1->key_value=$request->about_page_location;
			$setting1->update();
			
            $about = About_us::where('id',1)->get()->first();
            $about->title=$request->title;
            $about->banner_url=$request->image_name;
            $about->alt_text=$request->alt_text;
            $about->description=$request->description;
            $about->update();
            echo json_encode(array('status'=>'true','message'=>'About Us Information Successfully Updated','reload'=>url('admin/setting/aboutUs')));
        }
        else 
        {
            $data['about_info']=About_us::where('id',1)->get()->first();
            return view('admin.setting.aboutUs',$data);
        }
    }
    public function aboutUs_new(Request $request)
    {
        if(request()->ajax())
        {
            $data = $request->all();
            $info =array();
            if(count($data['name'])>0) {
            for($i=0;$i<count($data['name']);$i++)
            {
                $info[$i]['name'] = $data['name'][$i];
                $info[$i]['designation'] = $data['designation'][$i];
                $info[$i]['about'] = $data['about'][$i];
                $info[$i]['image'] = '';

                /*img*/
                if(isset($data['image'][$i])) {
                  $file = $data['image'][$i];
                  if($file->getClientOriginalExtension()=='jpg' || $file->getClientOriginalExtension()=='png' || $file->getClientOriginalExtension()=='jpeg' || $file->getClientOriginalExtension()=='PNG' || $file->getClientOriginalExtension()=='JPEG') {
                          //Move Uploaded File
                          $destinationPath = explode('app',__DIR__)[0].'public/setting/';
                         
                        $originalImage= $destinationPath.$file->getClientOriginalName();
                        $ext = explode(".",$file->getClientOriginalName())[1];
                        $file_name = 'IMG_'.time().'.'.$ext;
                        $destinationPath = 'public/s3/images/about_image/';
						$file->move($destinationPath,$file_name);
						$info[$i]['image']='/images/about_image/'.$file_name;
                    }
                    else 
                    {
                        echo json_encode(array('status'=>'false','message'=>'Please Select Valid Image'));
                        die();
                    }
                }
                else 
                {
                    $info[$i]['image'] = $data['img'][$i];;
                }
            }
            }
            $setting = Setting::where('key_text','about_page_status')->get()->first();
            $setting->key_value=$request->status;
            $setting->update();
            
            $setting1 = Setting::where('key_text','about_page_location')->get()->first();
            $setting1->key_value=$request->about_page_location;
            $setting1->update();
            
            $about = About_us::where('id',1)->get()->first();
            $about->title=$request->title;
            $about->description=$request->description1;
            $about->description2=$request->description2;
            $about->description3=$request->description3;
            $about->description4=$request->description4;
            $about->member_info = json_encode($info);
            $about->update();
            echo json_encode(array('status'=>'true','message'=>'About Us Information Successfully Updated','reload'=>url('admin/setting/aboutUs')));
        }
        else 
        {
            $data['about_info']=About_us::where('id',1)->get()->first();
            return view('admin.setting.aboutUs_new',$data);
        }
    }
    public function save_about_us_image(Request $request)
    {
            $path = explode('app',__DIR__);
            $file_name='';
            $err=array();
            $file = $request->file('image');
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
            echo  json_encode($arr);
    }
    public function delete_seo_file(Request $request)
    {
        $file = Seo_file::where('id',$request->id)->get()->first();
		if(file_exists($file->file)){
			unlink($file->file);
		}
        echo $file->delete();
    }
    public function home_page()
    {
        $data['home_jewellery']=Home_jewellery::where('status','1')->get()->toArray();
        $data['collection']=Collection::where('status','1')->get()->toArray();
        $data['category']=Categorey::where('status','1')->get()->toArray();
        return view('admin.setting.home_page',$data);
    }
    public function save_home_page_data(Request $request)
    {
        $data=$request->all();
        $update_arr=array();
        $insert_arr=array();
        $up=0;
        for($i=0;$i<count($request->mode);$i++)
        {
            if($data['mode'][$i]=='update')
            {
                $update_arr[$up]['id']=$data['id'][$i];
                $update_arr[$up]['banner_title']=$data['banner_title'][$i];
                $update_arr[$up]['banner_alt_text']=$data['banner_alt_text'][$i];
                $update_arr[$up]['collection_id']=$data['collection'][$i];
                $update_arr[$up]['banner_url']=$data['image_name'][$i];
				$update_arr[$up]['banner_url_safari']=$data['image_name1'][$i];
				$update_arr[$up]['banner_index']=$data['banner_index'][$i];
                $grid_meta=array();
                if(isset($data['image_inner_name'][0]))
                {
                    for($gm=0;$gm<count($data['image_inner_name']);$gm++)
                    {
                        if($data['category'][$gm][$i]!='')
                        {
                            $grid_meta[$gm]['grid_type']=$gm+1;
                            $grid_meta[$gm]['category-id']=$data['category'][$gm][$i];
                            $grid_meta[$gm]['category-name']=getSinglerow('categorey','categorey_name',array('id'=>$data['category'][$gm][$i]));
                            $grid_meta[$gm]['grid-image']=$data['image_inner_name'][$gm][$i];
							$grid_meta[$gm]['grid-image-safari']=$data['image_inner_name1'][$gm][$i];
                            $grid_meta[$gm]['product-id']=$data['product'][$gm][$i];
							$grid_meta[$gm]['image_alt_text']=$data['image_alt_text'][$gm][$i];
                            $grid_meta[$gm]['product-image-id']='';
                            $grid_meta[$gm]['product-name']=getSinglerow('products','product_name',array('id'=>$data['product'][$gm][$i]));
                            $grid_meta[$gm]['product-modal']=getSinglerow('products','design_model_no',array('id'=>$data['product'][$gm][$i]));
                            if(isset($data['mobile'.$i.$gm]))
                                $grid_meta[$gm]['visible-on-mobile']=1;
                            else 
                                $grid_meta[$gm]['visible-on-mobile']=0;

                            if(isset($data['hover'.$i.$gm]))
                                $grid_meta[$gm]['visible-on-hover']=1;
                            else 
                                $grid_meta[$gm]['visible-on-hover']=0;
                            
                        }
                        
                    }
                }
                $update_arr[$up]['grid_meta']=json_encode($grid_meta);
                $up++;
            }

            $in=0;
            if($data['mode'][$i]=='insert')
            {
                $insert_arr[$in]['banner_title']=$data['banner_title'][$i];
                $insert_arr[$in]['banner_alt_text']=$data['banner_alt_text'][$i];
				$insert_arr[$in]['banner_index']=$data['banner_index'][$i];
                $insert_arr[$in]['collection_id']=$data['collection'][$i];
                $insert_arr[$in]['banner_url']=$data['image_name'][$i]; 
                $grid_meta_in=array();
                if(isset($data['image_inner_name']))
                {
                    for($gm_in=0;$gm_in<count($data['image_inner_name'][0]);$gm_in++)
                    {
                        if($data['category'][$gm_in][$i]!='')
                        {
                            $grid_meta_in[$gm_in]['grid_type']=$gm_in+1;
                            $grid_meta_in[$gm_in]['category-id']=$data['category'][$gm_in][$i];
                            $grid_meta_in[$gm_in]['category-name']=getSinglerow('categorey','categorey_name',array('id'=>$data['category'][$gm_in][$i]));
                            $grid_meta_in[$gm_in]['grid-image']=$data['image_inner_name'][$gm_in][$i];
                            $grid_meta_in[$gm_in]['product-id']=$data['product'][$gm_in][$i];
                            $grid_meta_in[$gm_in]['image_alt_text']=$data['image_alt_text'][$gm_in][$i];
							$grid_meta_in[$gm_in]['product-image-id']='';
                            $grid_meta_in[$gm_in]['product-name']=getSinglerow('products','product_name',array('id'=>$data['product'][$gm_in][$i]));
                            $grid_meta_in[$gm_in]['product-modal']=getSinglerow('products','design_model_no',array('id'=>$data['product'][$gm_in][$i]));
                            if(isset($data['mobile'.$i.$gm_in]))
                                $grid_meta_in[$gm_in]['visible-on-mobile']=1;
                            else 
                                $grid_meta_in[$gm_in]['visible-on-mobile']=0;

                            if(isset($data['hover'.$i.$gm_in]))
                                $grid_meta_in[$gm_in]['visible-on-hover']=1;
                            else 
                                $grid_meta_in[$gm_in]['visible-on-hover']=0; 
                        }                       
                    }
                }
                $insert_arr[$in]['grid_meta']=json_encode($grid_meta_in);
                $in++;
            }
        }
		
		
        foreach($update_arr as $uarr)
        {
            $prod = Home_jewellery::where('id',$uarr['id'])->get()->first();
            $prod->banner_title=$uarr['banner_title'];
            $prod->banner_alt=$uarr['banner_alt_text'];
            $prod->collection_id=$uarr['collection_id'];
            $prod->banner_url=$uarr['banner_url'];
			$prod->banner_url_safari=$uarr['banner_url_safari'];
            $prod->grid_meta=$uarr['grid_meta'];
			$prod->index_count=$uarr['banner_index'];
            $prod->update();
        }
        foreach($insert_arr as $ins)
        {
            $prod = new Home_jewellery();
            $prod->banner_title=$ins['banner_title'];
            $prod->banner_alt=$ins['banner_alt_text'];
            $prod->collection_id=$ins['collection_id'];
            $prod->banner_url=$ins['banner_url'];
            $prod->grid_meta=$ins['grid_meta'];
			$prod->index_count=$ins['banner_index'];
            $prod->status=1;
            $prod->save();
        }
        echo json_encode(array('status'=>'true','message'=>'Setting Successfully Saved','reload'=>url('admin/setting/home_page')));
    }
    public function get_product_list($id)
    {
        $product = Products::whereRaw("find_in_set('".$id."',categorey_id)")->get()->toArray();
        echo "<option value=''>Select Product</option>";
        foreach($product as $prod)
        {
            echo "<option value='".$prod['id']."'>".$prod['product_name']."</option>"; 
        }
    }
    public function upload_home_page_banner(Request $request,$name)
    {
		$file = $request->file($name);
		$ext=$file->getClientOriginalExtension();
		if($ext=='jpg' || $ext=='png' || $ext=='jpeg' || $ext=='JPG' || $ext=='PNG' || $ext=='JPEG' || $ext=='webp')
        {
			$file_name = time().'.'.$file->extension();
			$s_file_name = $file_name;
			if($ext=='webp'){
				
				$ext = explode(".",$image->getClientOriginalName())[1];
				$destinationPath = 'public/s3/images/home_page/media_attachments';
				$name=$image->getClientOriginalName();
				$file_name=$image->move($destinationPath,$file_name);
				$path = $file_name->getPathname();
				
			} else{
				
				$var = explode('app',__DIR__);
				$file_name = 'img_'.time().'.'.$file->extension();
				$destinationPath = 'public/s3/images/home_page/safari_media_attachments';			
                $sourcePath=$file->move($destinationPath,$file_name);
				$spath = '/'.$destinationPath.'/'.$file_name;
				
				$file_name1=time().'.webp';
				$destinationPath = 'public/s3/images/home_page/media_attachments'.$file_name1; 
				$path = '/'.$destinationPath;
				if ($ext == 'jpeg' || $ext == 'jpg') 
					$image = imagecreatefromjpeg($sourcePath);
				elseif ($ext == 'gif') 
					$image = imagecreatefromgif($sourcePath);
				elseif ($ext == 'png') 
					$image = imagecreatefrompng($sourcePath);
				imagewebp($image, $destinationPath, 80);
				 
				
				
			} 
			$arr=array('status'=>'true','message'=>'Success','safari_image'=>$spath,'image' =>$path);
			
		} else {
			
            $arr=array('status'=>'false','message'=>'Please Select Valid Image | Only JPG (JPEG) And PNG Files Are Allowed');
        }
        echo json_encode($arr);
		die;
		/* --------------------------------------------- */
        // $path = explode('app',__DIR__);
        // $file = $request->file($name);
        // $file->getClientOriginalName();
        // $ext=$file->getClientOriginalExtension();
        // $file->getRealPath();
        // $file_size=$file->getSize();
        // if($ext=='jpg' || $ext=='png' || $ext=='jpeg' || $ext=='JPG' || $ext=='PNG' || $ext=='JPEG')
        // {
            // $destinationPath = 'public/data/safari_media_attachments/'; 
            // $file->getClientOriginalName();
            // $file_name1=$file->move($destinationPath,$file->getClientOriginalName());
			
			/* convert into webp image start */
			// $file_name = $file->getClientOriginalName();
            // $sourcePath = 'public/data/safari_media_attachments/'.$file_name;
			// $file_name = str_replace($ext,"webp",$file->getClientOriginalName());
            // $destinationPath = 'public/data/media_attachments/'.$file_name; 
			// if ($ext == 'jpeg' || $ext == 'jpg') 
				// $image = imagecreatefromjpeg($sourcePath);
			// elseif ($ext == 'gif') 
				// $image = imagecreatefromgif($sourcePath);
			// elseif ($ext == 'png') 
				// $image = imagecreatefrompng($sourcePath);
			// imagewebp($image, $destinationPath, 80);
			// /* convert into webp image end */
			
            // $arr=array('status'=>'true','message'=>'Success','safari_image'=>url($file_name1),'image' =>url($destinationPath));
			
        // } else {
			
            // $arr=array('status'=>'false','message'=>'Please Select Valid Image | Only JPG (JPEG) And PNG Files Are Allowed');
        // }
        // echo json_encode($arr);
    }
    public function delete_home_page_item($id)
    {
        $home = Home_jewellery::where('id',$id)->get()->first();
        $home->status=2;
        $home->update();
    }
    public function get_collection()
    {
        $collection=Collection::where('status','1')->get()->toArray(); 
        echo "<option value=''>Select</option>";
        foreach($collection as $col)
        {
            echo "<option value='".$col['id']."'>".$col['collection_name']."</option>";
        }  
    }
    public function get_category()
    {
        $category=Categorey::where('status','1')->get()->toArray();
        echo "<option value=''>Select</option>";
        foreach($category as $cat)
        {
            echo "<option value='".$cat['id']."'>".$cat['categorey_name']."</option>";
        }  
    }
    public function privacypolicy()
    {
        return view('admin.setting.privacypolicy');
    }
    public function term_and_condition()
    {
        return view('admin.setting.term_and_condition'); 
    }
	public function our_partners()
	{
		$data['our_partner']=Our_partner::get()->toArray();
		return view('admin.setting.our_partners',$data);
	}
	public function our_partners_manage_operation(Request $request)
	{
		if($request->action=='status')
        {
            $cat = Our_partner::where('id',$request->id)->first();
            $cat->status=$request->status;
            echo $cat->update();
        }
        else if($request->action=='insert')
        {
            $validator=Validator::make($request->all(),['title'=>'required','alt_text'=>'required']);
            if($validator->passes())
            {
                $path = explode('app',__DIR__);
                $file = $request->file('logo');
                $file->getClientOriginalName();
                $ext=$file->getClientOriginalExtension();
                $file->getRealPath();
                $file->getMimeType();
                $file_size=$file->getSize();
                if($file_size<100000000)
                {
                   $destinationPath = 'public/partner_image/';
                   $file->getClientOriginalName();
                   if($ext=='jpg' || $ext=='png' || $ext=='jpeg' || $ext=='JPG' || $ext=='PNG' || $ext=='JPEG' || $ext=='svg')
                   {
                            $file_name=$file->move($destinationPath,$file->getClientOriginalName());
                            $cat = new Our_partner();
                            $cat->title=$request->title;
                            $cat->alt_text=$request->alt_text;
                            $cat->logo=$file_name;
                            $cat->status=1;
                            $cat->save();
                            $arr=array('status'=>'true','message'=>'Partners successfully Added','reload'=>url('admin/setting/our_partners'));  
                   }
                   else 
                   {
                       $arr=array('status'=>'false','message'=>'Only JPN,PNG,JPEG And SVG Files Are Allowed');
                   }
                }
            }
            else 
            {
                $arr=array('status'=>'false','message'=>$validator->errors()->all());
            }
            echo json_encode($arr);
        }
        else if($request->action=='update')
        {
            $validator=Validator::make($request->all(),['title'=>'required','alt_text'=>'required']);
            if($validator->passes())
            {
                $slug= str_replace(' ','-',strtolower($request->slug));
                $file_name='';
                $err=array();
                $path = explode('app',__DIR__);
                $file = $request->file('logo');
                if($file) {
                    $file->getClientOriginalName();
                    $ext=$file->getClientOriginalExtension();
                    $file->getRealPath();
                    $file->getMimeType();
                    $file_size=$file->getSize();
                    if($file_size<100000000)
                    {
                    $destinationPath = 'public/partner_image/';
                    $file->getClientOriginalName();
                    if($ext=='jpg' || $ext=='png' || $ext=='jpeg' || $ext=='JPG' || $ext=='PNG' || $ext=='JPEG' || $ext=='svg')
                    {
                            $file_name=$file->move($destinationPath,$file->getClientOriginalName());         
                    }
                    else 
                    {
                        $err=array('status'=>'false','message'=>'Only JPN,PNG,JPEG And SVG Files Are Allowed');
                    }
                    }
                    else 
                    {
                        $err=array('status'=>'false','message'=>'Please Select valid Image');
                    }
                }
                if($err)
                {
                    echo json_encode($err);
                    die();
                }
                $cat =Our_partner::where('id',$request->id)->get()->first();;
				$cat->title=$request->title;
				$cat->alt_text=$request->alt_text;
				if($file_name)
					$cat->logo=$file_name;
                $cat->update();
                $arr=array('status'=>'true','message'=>'Partners successfully Updated','reload'=>url('admin/setting/our_partners'));
            }
            else 
            {
                $arr=array('status'=>'false','message'=>$validator->errors()->all());
            }
            echo json_encode($arr);
        }
		else if($request->action=='delete')
        {
			$cat = Our_partner::where('id',$request->id)->get()->first();
			unlink(explode('app',__DIR__)[0].$cat->logo);
			$cat->delete();
		}
	}
}

