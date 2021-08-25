<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\model\Categorey;
use App\model\Collection;
use App\model\Occassion;
use App\model\Products;
use App\model\Product_meta;
use App\model\DesignStyle;
use App\model\Metal;
use App\model\Gemstone;
use App\model\Purity;
use App\model\DiamondType;
use Validator;
use Session;
use ImageResize;
use Image;
use Illuminate\Http\File;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    public function category()
    {
        return view('admin.products.category');
    }
    public function get_category(Request $request)
    {
        $columns = array( 
            0 =>'id', 
            1 =>'categorey_name',
            2 =>'status',
        );  
        $totalData = Categorey::count();            
        $totalFiltered = $totalData;
        $limit = $request->input('length');
        $start = $request->input('start');
        $order = $columns[$request->input('order.0.column')];
        $dir = $request->input('order.0.dir');
            
        if(empty($request->input('search.value')))
        {            
            $institutes = Categorey::offset($start)
                         ->limit($limit)
                        ->orderBy($order,$dir)
                         ->get();
        }else {
            $search = $request->input('search.value'); 

            $institutes =  Categorey::where('id','LIKE',"%{$search}%")
                            ->orWhere('categorey_name', 'LIKE',"%{$search}%")
                            ->offset($start)
                            ->limit($limit)
                            ->orderBy($order,$dir)
                            ->get();

            $totalFiltered = Categorey::where('id','LIKE',"%{$search}%")
                             ->orWhere('categorey_name', 'LIKE',"%{$search}%")
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
                $nestedData['categorey_name'] = $institute->categorey_name;
                $nestedData['status'] = '<label class="switch"><input value="1" class="manage_status" name="status_'.$institute->id.'" data-id="'.$institute->id.'" data-url="'.url('admin/products/category_manage_operation/').'" type="checkbox" '.$chk.'><span class="slider round"></span></label>';
                $nestedData['action'] = '<a data-url="'.url('admin/products/category_manage_operation/').'" href="javascript:;" class="btn btn-info update_category" data-id="'.$institute->id.'"  data-cat="'.$institute->categorey_name.'"><i class="fa fa-edit"></i></a>&nbsp;&nbsp;';
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
    public function category_manage_operation(Request $request)
    {
        if($request->action=='status')
        {
            $cat = Categorey::where('id',$request->id)->first();
            $cat->status=$request->status;
            echo $cat->update();
        }
        else if($request->action=='insert')
        {
            $validator=Validator::make($request->all(),['category_name'=>'required']);
            if($validator->passes())
            {
                $cat = new Categorey();
                $cat->categorey_name=$request->category_name;
                $cat->status=1;
                $cat->save();
                $arr=array('status'=>'true','message'=>'Category successfully Added','reload'=>'0');
            }
            else 
            {
                $arr=array('status'=>'false','message'=>$validator->errors()->all());
            }
            echo json_encode($arr);
        }
        else if($request->action=='update')
        {
            $validator=Validator::make($request->all(),['category_name'=>'required']);
            if($validator->passes())
            {
                $cat =Categorey::where('id',$request->id)->get()->first();
                $cat->categorey_name=$request->category_name;
                $cat->update();
                $arr=array('status'=>'true','message'=>'Category successfully Updated','reload'=>'0');
            }
            else 
            {
                $arr=array('status'=>'false','message'=>$validator->errors()->all());
            }
            echo json_encode($arr);
        }
    }
    public function collections()
    {
        return view('admin.products.collections');
    }
    public function get_collections(Request $request)
    {
        $columns = array( 
            0 =>'id', 
            1 =>'banner',
            2 =>'collection_name',
            3 =>'alt_text',
            4 =>'slug',
            5 =>'status',
        );  
        $totalData = Collection::count();            
        $totalFiltered = $totalData;
        $limit = $request->input('length');
        $start = $request->input('start');
        $order = $columns[$request->input('order.0.column')];
        $dir = $request->input('order.0.dir');
            
        if(empty($request->input('search.value')))
        {            
            $institutes = Collection::offset($start)
                         ->limit($limit)
                         ->orderBy($order,$dir)
                         ->get();
        }else {
            $search = $request->input('search.value'); 

            $institutes =  Collection::where('id','LIKE',"%{$search}%")
                            ->orWhere('collection_name', 'LIKE',"%{$search}%")
                            ->orWhere('alt_text', 'LIKE',"%{$search}%")
                            ->offset($start)
                            ->limit($limit)
                            ->orderBy($order,$dir)
                            ->get();

            $totalFiltered = Collection::where('id','LIKE',"%{$search}%")
                             ->orWhere('collection_name', 'LIKE',"%{$search}%")
                             ->orWhere('alt_text', 'LIKE',"%{$search}%")
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
                if($institute->banner)
                    $nestedData['banner'] = '<img src="'.url($institute->banner).'" width="100px">';
                else 
                    $nestedData['banner'] = 'N/A';
                $nestedData['collection_name'] = $institute->collection_name;
                $nestedData['alt_text'] = $institute->alt_text;
                $nestedData['status'] = '<label class="switch"><input value="1" class="manage_status" name="status_'.$institute->id.'" data-id="'.$institute->id.'" data-url="'.url('admin/products/collections_manage_operation/').'" type="checkbox" '.$chk.'><span class="slider round"></span></label>';
                $nestedData['action'] = '<a data-url="'.url('admin/products/collections_manage_operation/').'" href="javascript:;" class="btn btn-info update_collection" data-id="'.$institute->id.'"  data-col="'.$institute->collection_name.'" data-slug="'.$institute->slug.'" data-alt="'.$institute->alt_text.'"><i class="fa fa-edit"></i></a>&nbsp;&nbsp;';
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
    public function collections_manage_operation(Request $request)
    {
        if($request->action=='status')
        {
            $cat = Collection::where('id',$request->id)->first();
            $cat->status=$request->status;
            echo $cat->update();
        }
        else if($request->action=='insert')
        {
            $validator=Validator::make($request->all(),['collection_name'=>'required']);
            if($validator->passes())
            {
                $slug= str_replace(' ','-',strtolower($request->slug));
                $is_exixts=Collection::where('slug',$slug)->get()->first();
                if($is_exixts)
                {
                    echo json_encode(array('status'=>'false','message'=>'Slug Aready Exists'));
                    die();
                }
                $path = explode('app',__DIR__);
                $file = $request->file('banner');
                $file->getClientOriginalName();
                $ext=$file->getClientOriginalExtension();
                $file->getRealPath();
                $file->getMimeType();
                $file_size=$file->getSize();
                if($file_size<100000000)
                {
                   $destinationPath = 'public/collection/';
                   $file->getClientOriginalName();
                   if($ext=='jpg' || $ext=='png' || $ext=='jpeg' || $ext=='JPG' || $ext=='PNG' || $ext=='JPEG' || $ext=='svg')
                   {
                            $file_name=$file->move($destinationPath,$file->getClientOriginalName());
                            $cat = new Collection();
                            $cat->collection_name=$request->collection_name;
                            $cat->alt_text=$request->alt_text;
                            $cat->slug=$request->slug;
                            $cat->banner=$file_name;
                            $cat->status=1;
                            $cat->save();
                            $arr=array('status'=>'true','message'=>'Collection successfully Added','reload'=>'0');  
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
            $validator=Validator::make($request->all(),['collection_name'=>'required']);
            if($validator->passes())
            {
                $slug= str_replace(' ','-',strtolower($request->slug));
                $file_name='';
                $err=array();
                $path = explode('app',__DIR__);
                $file = $request->file('banner');
                if($file) {
                    $file->getClientOriginalName();
                    $ext=$file->getClientOriginalExtension();
                    $file->getRealPath();
                    $file->getMimeType();
                    $file_size=$file->getSize();
                    if($file_size<100000000)
                    {
                    $destinationPath = 'public/collection/';
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
                $cat = Collection::where('id',$request->id)->get()->first();
                $cat->collection_name=$request->collection_name;
                $cat->alt_text=$request->alt_text;
                $cat->slug=$slug;
                if($file_name)
                {
                    $cat->banner=$file_name;
                }
                $cat->update();
                $arr=array('status'=>'true','message'=>'Collection successfully Updated','reload'=>'0');
            }
            else 
            {
                $arr=array('status'=>'false','message'=>$validator->errors()->all());
            }
            echo json_encode($arr);
        }
    }
    public function occasion()
    {
        return view('admin.products.occasion');
    }
    public function get_occasion(Request $request)
    {
        $columns = array( 
            0 =>'id', 
            1 =>'occassion_name',
            2 =>'status',
        );  
        $totalData = Occassion::count();            
        $totalFiltered = $totalData;
        $limit = $request->input('length');
        $start = $request->input('start');
        $order = $columns[$request->input('order.0.column')];
        $dir = $request->input('order.0.dir');
            
        if(empty($request->input('search.value')))
        {            
            $institutes = Occassion::offset($start)
                         ->limit($limit)
                         ->orderBy($order,$dir)
                         ->get();
        }else {
            $search = $request->input('search.value'); 

            $institutes =  Occassion::where('id','LIKE',"%{$search}%")
                            ->orWhere('occassion_name', 'LIKE',"%{$search}%")
                            ->offset($start)
                            ->limit($limit)
                            ->orderBy($order,$dir)
                            ->get();

            $totalFiltered = Occassion::where('id','LIKE',"%{$search}%")
                             ->orWhere('occassion_name', 'LIKE',"%{$search}%")
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
                $nestedData['occassion_name'] = $institute->occassion_name;
                $nestedData['status'] = '<label class="switch"><input value="1" class="manage_status" name="status_'.$institute->id.'" data-id="'.$institute->id.'" data-url="'.url('admin/products/occasion_manage_operation/').'" type="checkbox" '.$chk.'><span class="slider round"></span></label>';
                $nestedData['action'] = '<a data-url="'.url('admin/products/occasion_manage_operation/').'" href="javascript:;" class="btn btn-info update_occasion" data-id="'.$institute->id.'"  data-oc="'.$institute->occassion_name.'"><i class="fa fa-edit"></i></a>&nbsp;&nbsp;';
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
    public function occasion_manage_operation(Request $request)
    {
        if($request->action=='status')
        {
            $cat = Occassion::where('id',$request->id)->first();
            $cat->status=$request->status;
            echo $cat->update();
        }
        else if($request->action=='insert')
        {
            $validator=Validator::make($request->all(),['occassion_name'=>'required']);
            if($validator->passes())
            {
                $cat = new Occassion();
                $cat->occassion_name=$request->occassion_name;
                $cat->status=1;
                $cat->save();
                $arr=array('status'=>'true','message'=>'Occassion successfully Added','reload'=>'0');
            }
            else 
            {
                $arr=array('status'=>'false','message'=>$validator->errors()->all());
            }
            echo json_encode($arr);
        }
        else if($request->action=='update')
        {
            $validator=Validator::make($request->all(),['occassion_name'=>'required']);
            if($validator->passes())
            {
                $cat = Occassion::where('id',$request->id)->get()->first();
                $cat->occassion_name=$request->occassion_name;
                $cat->update();
                $arr=array('status'=>'true','message'=>'Occassion successfully Updated','reload'=>'0');
            }
            else 
            {
                $arr=array('status'=>'false','message'=>$validator->errors()->all());
            }
            echo json_encode($arr);
        }
    }
    public function manage_product()
    {
        return view('admin.products.manage_product');
    }
    public function get_products(Request $request)
    {
        $columns = array( 
            0 =>'id', 
            1 =>'product_name',
            2 =>'design_model_no',
            3 =>'categorey_id',
            4 =>'description',
            5 =>'status',
        );  
        $totalData = Products::count();            
        $totalFiltered = $totalData;
        $limit = $request->input('length');
        $start = $request->input('start');
        $order = $columns[$request->input('order.0.column')];
        $dir = $request->input('order.0.dir');
            
        if(empty($request->input('search.value')))
        {            
            $institutes = Products::offset($start)
                         ->limit($limit)
                         ->orderBy($order,$dir)
                         ->get();
        }else {
            $search = $request->input('search.value'); 

            $institutes =  Products::where('id','LIKE',"%{$search}%")
                            ->orWhere('product_name', 'LIKE',"%{$search}%")
                            ->orWhere('design_model_no', 'LIKE',"%{$search}%")
                            ->orWhere('description', 'LIKE',"%{$search}%")
                            ->offset($start)
                            ->limit($limit)
                            ->orderBy($order,$dir)
                            ->get();

            $totalFiltered = Products::where('id','LIKE',"%{$search}%")
                                ->orWhere('product_name', 'LIKE',"%{$search}%")
                                ->orWhere('design_model_no', 'LIKE',"%{$search}%")
                                ->orWhere('description', 'LIKE',"%{$search}%")
                             ->count();
        }
        $data = array();
        if(!empty($institutes))
        {
            foreach ($institutes as $key1=>$institute)
            {
                $cat_str='';
                $count=0;
                $cat_arr=explode(',',$institute->categorey_id);
                foreach($cat_arr as $key => $cat)
                {
                    if($cat)
                    {
                        if($count==0)
                            $cat_str.=getSinglerow('categorey','categorey_name',array('id'=>$cat));
                        else 
                            $cat_str.=','.getSinglerow('categorey','categorey_name',array('id'=>$cat));
                        $count++;
                    }
                }
                if($institute->status==1)
                    $chk="checked";
                else 
                    $chk='';
                $nestedData['id'] = $key1+1;
                $nestedData['product_title'] = $institute->product_name;
                $nestedData['design'] = $institute->design_model_no;
                $nestedData['category'] = $cat_str;
                $nestedData['description'] = $institute->description;
                $nestedData['status'] = '<label class="switch"><input value="1" class="manage_status" name="status_'.$institute->id.'" data-id="'.$institute->id.'" data-url="'.url('admin/products/product_manage_operation/').'" type="checkbox" '.$chk.'><span class="slider round"></span></label>';
                $nestedData['action'] = '<a href="'.url('admin/products/edit_product/'.$institute->id).'" href="javascript:;" class="btn btn-info" ><i class="fa fa-edit"></i></a>&nbsp;&nbsp;';
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
    public function product_manage_operation(Request $request)
    {
        if($request->action=='status')
        {
            $product = Products::where('id',$request->id)->first();
            $product->status=$request->status;
            echo $product->update();
        }
    }
    public function add_new_product(Request $request)
    {

        if(request()->ajax())
        {
            $validator=validator::make($request->all(),['product_name'=>'required','product_description'=>'required']);
            if($validator->passes())
            {
                $slug=str_replace(' ','-',strtolower($request->slug));
                $is_exists = Products::where('slug',$slug)->get()->first();
                if($is_exists)
                {
                    echo json_encode(array('status'=>'false','message'=>'Slug Already Exists'));
                    die();
                }
                
                if(is_array($request->category))
                    $categorey_id=implode(',',$request->category);
                else 
                    $categorey_id='';
                
                if(is_array($request->occassion))
                    $occassion=implode(',',$request->occassion);
                else 
                    $occassion='';
                
                if(is_array($request->gemstone))
                    $gemstone=implode(',',$request->gemstone);
                else 
                    $gemstone='';
                
                if(is_array($request->design_style))
                    $design_style=implode(',',$request->design_style);
                else 
                    $design_style='';
                
                if(is_array($request->diamond_type))
                    $diamond_type=implode(',',$request->diamond_type);
                else 
                    $diamond_type='';
                
                $product = new Products();
                $product->product_name=$request->product_name;
                $product->custom_name=str_replace(' ','-',strtolower($request->product_name));
                $product->product_cost=0;
                $product->categorey_id=$categorey_id;
                $product->metal_type=$request->metal;
                $product->purity=$request->purity;
                $product->occasion_type=$occassion;
                $product->stone_type=$gemstone;
                $product->enquiy_value=$request->enquiry_value;
                $product->collection_id=$request->collection;
                $product->gender=$request->gender;
                $product->design_style=$design_style;
                $product->design_model_no=$request->design_number;
                $product->diamond_type=$diamond_type;
                $product->diamond_carat=$request->diamond_carat;
                $product->description=$request->product_description;
                $product->seo_title=$request->seo_title;
                $product->seo_description=$request->seo_description;
                $product->seo_keywords=$request->seo_keywords;
                $product->alt_text=$request->alt_text;
                $product->youtube_link=$request->youtube_link;
                $product->slug=$slug;
                $product->status=1;
                $product->save();
        
                $img_arr=explode(',',$request->image_name);
                foreach($img_arr as $img)
                {
                    if($img)
                    {
                        $image_explode = array_reverse(explode('/',$img));
                        $originalImage= explode('app',__DIR__)[0].$img;
            
						$ext = explode(".",$img)[1];
						$file_name = 'IMG_'.time().'.'.$ext;
						
						$image_resize = Image::make($originalImage);              
						$image_resize->resize(400, 400);
						$image_resize->save(public_path('s3/images/product/thumb/' .$file_name));
						
						
						if(file_exists($originalImage)){
							unlink($originalImage);
						}
						
                        $product_meta1 = new Product_meta();
                        $product_meta1->product_id=$product->id;
                        $product_meta1->meta_link=explode('s3/',$img)[1];
                        $product_meta1->meta_thumb='images/product/thumb/' .$file_name;
                        $product_meta1->meta_type=1;
                        $product_meta1->status=1;
                        $product_meta1->user_id=Session::get('admin_session')->user_id;
                        $product_meta1->save();
                    }
                }

                $product_meta2 = new Product_meta();
                $product_meta2->product_id=$product->id;
                $product_meta2->meta_link=$request->video_name;
                $product_meta2->meta_type=2;
                $product_meta2->status=1;
                $product_meta2->user_id=Session::get('admin_session')->user_id;
                $product_meta2->save();
                
                $arr=array('status'=>'true','message'=>'Product Successfully Added','reload'=>url('admin/products/manage_product'));
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
            $data['designStyle']=DesignStyle::where('status','1')->get()->toArray();
            $data['metal']=Metal::where('status','1')->get()->toArray();
            $data['gemstone']=Gemstone::where('status','1')->get()->toArray();
            $data['purity']=Purity::where('status','1')->get()->toArray();
            $data['diamondtype']=DiamondType::where('status','1')->get()->toArray();
            return view('admin.products.add_new_product',$data);
        }
    }
    public function edit_product(Request $request,$id)
    {
        if(request()->ajax())
        {
            $validator=validator::make($request->all(),['product_name'=>'required','product_description'=>'required']);
            if($validator->passes())
            {
                if(is_array($request->category))
                    $categorey_id=implode(',',$request->category);
                else 
                    $categorey_id='';
                
                if(is_array($request->occassion))
                    $occassion=implode(',',$request->occassion);
                else 
                    $occassion='';
                
                if(is_array($request->gemstone))
                    $gemstone=implode(',',$request->gemstone);
                else 
                    $gemstone='';
                
                if(is_array($request->design_style))
                    $design_style=implode(',',$request->design_style);
                else 
                    $design_style='';
                
                if(is_array($request->diamond_type))
                    $diamond_type=implode(',',$request->diamond_type);
                else 
                    $diamond_type='';
                
                $slug=str_replace(' ','-',strtolower($request->slug));
                $product = Products::where('id',$id)->get()->first();
                $product->product_name=$request->product_name;
                $product->custom_name=str_replace(' ','-',strtolower($request->product_name));
                $product->product_cost=0;
                $product->categorey_id=$categorey_id;
                $product->metal_type=$request->metal;
                $product->purity=$request->purity;
                $product->occasion_type=$occassion;
                $product->stone_type=$gemstone;
                $product->enquiy_value=$request->enquiry_value;
                $product->collection_id=$request->collection;
                $product->gender=$request->gender;
                $product->design_style=$design_style;
                $product->design_model_no=$request->design_number;
                $product->diamond_type=$diamond_type;
                $product->diamond_carat=$request->diamond_carat;
                $product->description=$request->product_description;
                $product->seo_title=$request->seo_title;
                $product->seo_description=$request->seo_description;
                $product->seo_keywords=$request->seo_keywords;
                $product->alt_text=$request->alt_text;
                $product->youtube_link=$request->youtube_link;
                $product->slug=$slug;
                $product->update();
                
                $img_arr=explode(',',$request->image_name);
                foreach($img_arr as $key => $img)
                {
                    if($key<=$request->up_img_count && $request->up_img_count!='')
                    {
                        if($img)
                        {
                            $product_meta1 =  Product_meta::where('product_id',$id)->where('meta_type',1)->get()->first();
                            if($product_meta1) {
                                $product_meta1->product_id=$product->id;
                                $product_meta1->meta_link=$img;
                                $product_meta1->update();
                            }
                        }
                    }
                    else 
                    {
                        if($img)
                        {
							
                        $image_explode = array_reverse(explode('/',$img));
                        $originalImage= explode('app',__DIR__)[0].$img;
                       
						$ex1 = explode(".",$img);
						$ext = $ex1[1];
						$file_name = 'IMG_'.time().'.'.$ext;
					
						
						
						$image_resize = Image::make($originalImage);              
						$image_resize->resize(400, 400);
						$image_resize->save(public_path('s3/images/product/thumb/' .$file_name));
						
						
					
						
                            $product_meta1 = new Product_meta();
                            $product_meta1->product_id=$product->id;
                            $product_meta1->meta_link=explode('s3/',$img)[1];
                            $product_meta1->meta_thumb='images/product/thumb/' .$file_name;
                            $product_meta1->meta_type=1;
                            $product_meta1->status=1;
                            $product_meta1->user_id=Session::get('admin_session')->user_id;
                            $product_meta1->save();
                        }

                    }
                }

                $product_meta2 = Product_meta::where('product_id',$id)->where('meta_type',2)->get()->first();
                $product_meta2->product_id=$product->id;
                $product_meta2->meta_link=$request->video_name;
                $product_meta2->update();

                $arr=array('status'=>'true','message'=>'Product Successfully Updated','reload'=>url('admin/products/manage_product'));
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
            $data['product'] = Products::where('id',$id)->get()->first();
            $data['product_meta'] = Product_meta::where('product_id',$id)->where('meta_type','1')->get()->toArray();
            $data['product_meta2'] = Product_meta::where('product_id',$id)->where('meta_type','2')->get()->toArray();
            $data['designStyle']=DesignStyle::where('status','1')->get()->toArray();
            $data['metal']=Metal::where('status','1')->get()->toArray();
            $data['gemstone']=Gemstone::where('status','1')->get()->toArray();
            $data['purity']=Purity::where('status','1')->get()->toArray();
            $data['diamondtype']=DiamondType::where('status','1')->get()->toArray();
            return view('admin.products.edit_product',$data);
        }
        
    }
    public function upload_product_image(Request $request)
    {
        foreach($request->file('image') as $image)
        {
			$ext = explode(".",$image->getClientOriginalName())[1];
			$file_name = 'IMG_'.time().'.'.$ext;
			$file_name1 = 'IMG_'.time().'.'.$ext;
            $destinationPath = 'public/s3/images/product/';
            $name=$image->getClientOriginalName();
            $file_name=$image->move($destinationPath,$file_name);
			/*$originalImage= explode('app',__DIR__)[0].$destinationPath.'/'.$file_name;
			$image_resize = Image::make(explode('app',__DIR__)[0].$file_name);              
			$image_resize->resize(400, 400);
			$image_resize->save(public_path('s3/images/product/thumb/' .$file_name1));*/
            $data[] = $file_name->getPathname();
        }
        $arr=array('status'=>'true','message'=>'Success','image'=>$data,'str'=>implode(',',$data));
        echo json_encode($arr);
    }
    public function upload_product_video(Request $request)
    {
        $path = explode('app',__DIR__);
        $file = $request->file('video');
        $file->getClientOriginalName();
        $ext=$file->getClientOriginalExtension();
        $file->getRealPath();
        $file_size=$file->getSize();
        if($ext=='mp4' || $ext=='avi' || $ext=='wmv' || $ext=='mov' || $ext=='ogv' || $ext=='ogg' || $ext=='gif')
        {
            $destinationPath = 'public/data/media_attachments/';
            $file->getClientOriginalName();
            $file_name=$file->move($destinationPath,$file->getClientOriginalName());
            $arr=array('status'=>'true','message'=>'Success','image'=>url($file_name));
        }
        else 
        {
            $arr=array('status'=>'false','message'=>'Please Select Valid Video');
        }
        echo json_encode($arr);
    }
    public function delete_prod_image_final($id)
    {
        $meta_info=Product_meta::where('id',$id)->get()->first();
        if($meta_info)
        {
            if(file_exists(explode('app',__DIR__)[0].$meta_info->meta_link)) {
                unlink(explode('app',__DIR__)[0].$meta_info->meta_link); 
            }
            $meta_info->delete();
        }
    }
    public function design_style()
    {
        return view('admin.products.design_style');   
    }
    public function get_design_style(Request $request)
    {
        $columns = array( 
            0 =>'id', 
            1 =>'name',
            2 =>'status',
        );  
        $totalData = DesignStyle::count();            
        $totalFiltered = $totalData;
        $limit = $request->input('length');
        $start = $request->input('start');
        $order = $columns[$request->input('order.0.column')];
        $dir = $request->input('order.0.dir');
            
        if(empty($request->input('search.value')))
        {            
            $institutes = DesignStyle::offset($start)
                         ->limit($limit)
                         ->orderBy($order,$dir)
                         ->get();
        }else {
            $search = $request->input('search.value'); 

            $institutes =  DesignStyle::where('id','LIKE',"%{$search}%")
                            ->orWhere('name', 'LIKE',"%{$search}%")
                            ->offset($start)
                            ->limit($limit)
                            ->orderBy($order,$dir)
                            ->get();

            $totalFiltered = DesignStyle::where('id','LIKE',"%{$search}%")
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
                $nestedData['status'] = '<label class="switch"><input value="1" class="manage_status" name="status_'.$institute->id.'" data-id="'.$institute->id.'" data-url="'.url('admin/products/design_style_manage_operation/').'" type="checkbox" '.$chk.'><span class="slider round"></span></label>';
                $nestedData['action'] = '<a data-url="'.url('admin/products/design_style_manage_operation/').'" href="javascript:;" class="btn btn-info update_design_style" data-id="'.$institute->id.'"  data-cat="'.$institute->name.'"><i class="fa fa-edit"></i></a>&nbsp;&nbsp;';
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
    public function design_style_manage_operation(Request $request)
    {
        if($request->action=='status')
        {
            $cat = DesignStyle::where('id',$request->id)->first();
            $cat->status=$request->status;
            echo $cat->update();
        }
        else if($request->action=='insert')
        {
            $validator=Validator::make($request->all(),['name'=>'required']);
            if($validator->passes())
            {
                $cat = new DesignStyle();
                $cat->name=$request->name;
                $cat->status=1;
                $cat->save();
                $arr=array('status'=>'true','message'=>'Design Style successfully Added','reload'=>'0');
            }
            else 
            {
                $arr=array('status'=>'false','message'=>$validator->errors()->all());
            }
            echo json_encode($arr);
        }
        else if($request->action=='update')
        {
            $validator=Validator::make($request->all(),['name'=>'required']);
            if($validator->passes())
            {
                $cat =DesignStyle::where('id',$request->id)->get()->first();
                $cat->name=$request->name;
                $cat->update();
                $arr=array('status'=>'true','message'=>'Design Style successfully Updated','reload'=>'0');
            }
            else 
            {
                $arr=array('status'=>'false','message'=>$validator->errors()->all());
            }
            echo json_encode($arr);
        }
    }
    public function metal()
    {
        return view('admin.products.metal');   
    }
    public function get_metal(Request $request)
    {
        $columns = array( 
            0 =>'id', 
            1 =>'name',
            2 =>'status',
        );  
        $totalData = Metal::count();            
        $totalFiltered = $totalData;
        $limit = $request->input('length');
        $start = $request->input('start');
        $order = $columns[$request->input('order.0.column')];
        $dir = $request->input('order.0.dir');
            
        if(empty($request->input('search.value')))
        {            
            $institutes = Metal::offset($start)
                         ->limit($limit)
                        ->orderBy($order,$dir)
                         ->get();
        }else {
            $search = $request->input('search.value'); 

            $institutes =  Metal::where('id','LIKE',"%{$search}%")
                            ->orWhere('name', 'LIKE',"%{$search}%")
                            ->offset($start)
                            ->limit($limit)
                            ->orderBy($order,$dir)
                            ->get();

            $totalFiltered = Metal::where('id','LIKE',"%{$search}%")
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
                $nestedData['status'] = '<label class="switch"><input value="1" class="manage_status" name="status_'.$institute->id.'" data-id="'.$institute->id.'" data-url="'.url('admin/products/metal_manage_operation/').'" type="checkbox" '.$chk.'><span class="slider round"></span></label>';
                $nestedData['action'] = '<a data-url="'.url('admin/products/metal_manage_operation/').'" href="javascript:;" class="btn btn-info update_metal" data-id="'.$institute->id.'"  data-cat="'.$institute->name.'"><i class="fa fa-edit"></i></a>&nbsp;&nbsp;';
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
    public function metal_manage_operation(Request $request)
    {
        if($request->action=='status')
        {
            $cat = Metal::where('id',$request->id)->first();
            $cat->status=$request->status;
            echo $cat->update();
        }
        else if($request->action=='insert')
        {
            $validator=Validator::make($request->all(),['name'=>'required']);
            if($validator->passes())
            {
                $cat = new Metal();
                $cat->name=$request->name;
                $cat->status=1;
                $cat->save();
                $arr=array('status'=>'true','message'=>'Metal successfully Added','reload'=>'0');
            }
            else 
            {
                $arr=array('status'=>'false','message'=>$validator->errors()->all());
            }
            echo json_encode($arr);
        }
        else if($request->action=='update')
        {
            $validator=Validator::make($request->all(),['name'=>'required']);
            if($validator->passes())
            {
                $cat =Metal::where('id',$request->id)->get()->first();
                $cat->name=$request->name;
                $cat->update();
                $arr=array('status'=>'true','message'=>'Metal successfully Updated','reload'=>'0');
            }
            else 
            {
                $arr=array('status'=>'false','message'=>$validator->errors()->all());
            }
            echo json_encode($arr);
        }
    }
    public function gemstone()
    {
        return view('admin.products.gemstone');   
    }
    public function get_gemstone(Request $request)
    {
        $columns = array( 
            0 =>'id', 
            1 =>'name',
            2 =>'status',
        );  
        $totalData = Gemstone::count();            
        $totalFiltered = $totalData;
        $limit = $request->input('length');
        $start = $request->input('start');
        $order = $columns[$request->input('order.0.column')];
        $dir = $request->input('order.0.dir');
            
        if(empty($request->input('search.value')))
        {            
            $institutes = Gemstone::offset($start)
                         ->limit($limit)
                         ->orderBy($order,$dir)
                         ->get();
        }else {
            $search = $request->input('search.value'); 

            $institutes =  Gemstone::where('id','LIKE',"%{$search}%")
                            ->orWhere('name', 'LIKE',"%{$search}%")
                            ->offset($start)
                            ->limit($limit)
                            ->orderBy($order,$dir)
                            ->get();

            $totalFiltered = Gemstone::where('id','LIKE',"%{$search}%")
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
                $nestedData['status'] = '<label class="switch"><input value="1" class="manage_status" name="status_'.$institute->id.'" data-id="'.$institute->id.'" data-url="'.url('admin/products/gemstone_manage_operation/').'" type="checkbox" '.$chk.'><span class="slider round"></span></label>';
                $nestedData['action'] = '<a data-url="'.url('admin/products/gemstone_manage_operation/').'" href="javascript:;" class="btn btn-info update_gemstone" data-id="'.$institute->id.'"  data-cat="'.$institute->name.'"><i class="fa fa-edit"></i></a>&nbsp;&nbsp;';
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
    public function gemstone_manage_operation(Request $request)
    {
        if($request->action=='status')
        {
            $cat = Gemstone::where('id',$request->id)->first();
            $cat->status=$request->status;
            echo $cat->update();
        }
        else if($request->action=='insert')
        {
            $validator=Validator::make($request->all(),['name'=>'required']);
            if($validator->passes())
            {
                $cat = new Gemstone();
                $cat->name=$request->name;
                $cat->status=1;
                $cat->save();
                $arr=array('status'=>'true','message'=>'Gemstone successfully Added','reload'=>'0');
            }
            else 
            {
                $arr=array('status'=>'false','message'=>$validator->errors()->all());
            }
            echo json_encode($arr);
        }
        else if($request->action=='update')
        {
            $validator=Validator::make($request->all(),['name'=>'required']);
            if($validator->passes())
            {
                $cat =Gemstone::where('id',$request->id)->get()->first();
                $cat->name=$request->name;
                $cat->update();
                $arr=array('status'=>'true','message'=>'Gemstone successfully Updated','reload'=>'0');
            }
            else 
            {
                $arr=array('status'=>'false','message'=>$validator->errors()->all());
            }
            echo json_encode($arr);
        }
    }
    public function purity()
    {
        return view('admin.products.purity');      
    }
    public function get_purity(Request $request)
    {
        $columns = array( 
            0 =>'id', 
            1 =>'name',
            2 =>'status',
        );  
        $totalData = Purity::count();            
        $totalFiltered = $totalData;
        $limit = $request->input('length');
        $start = $request->input('start');
        $order = $columns[$request->input('order.0.column')];
        $dir = $request->input('order.0.dir');
            
        if(empty($request->input('search.value')))
        {            
            $institutes = Purity::offset($start)
                         ->limit($limit)
                         ->orderBy($order,$dir)
                         ->get();
        }else {
            $search = $request->input('search.value'); 

            $institutes =  Purity::where('id','LIKE',"%{$search}%")
                            ->orWhere('name', 'LIKE',"%{$search}%")
                            ->offset($start)
                            ->limit($limit)
                            ->orderBy($order,$dir)
                            ->get();

            $totalFiltered = Purity::where('id','LIKE',"%{$search}%")
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
                $nestedData['status'] = '<label class="switch"><input value="1" class="manage_status" name="status_'.$institute->id.'" data-id="'.$institute->id.'" data-url="'.url('admin/products/purity_manage_operation/').'" type="checkbox" '.$chk.'><span class="slider round"></span></label>';
                $nestedData['action'] = '<a data-url="'.url('admin/products/purity_manage_operation/').'" href="javascript:;" class="btn btn-info update_purity" data-id="'.$institute->id.'"  data-cat="'.$institute->name.'"><i class="fa fa-edit"></i></a>&nbsp;&nbsp;';
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
    public function purity_manage_operation(Request $request)
    {
        if($request->action=='status')
        {
            $cat = Purity::where('id',$request->id)->first();
            $cat->status=$request->status;
            echo $cat->update();
        }
        else if($request->action=='insert')
        {
            $validator=Validator::make($request->all(),['name'=>'required']);
            if($validator->passes())
            {
                $cat = new Purity();
                $cat->name=$request->name;
                $cat->status=1;
                $cat->save();
                $arr=array('status'=>'true','message'=>'Purity successfully Added','reload'=>'0');
            }
            else 
            {
                $arr=array('status'=>'false','message'=>$validator->errors()->all());
            }
            echo json_encode($arr);
        }
        else if($request->action=='update')
        {
            $validator=Validator::make($request->all(),['name'=>'required']);
            if($validator->passes())
            {
                $cat =Purity::where('id',$request->id)->get()->first();
                $cat->name=$request->name;
                $cat->update();
                $arr=array('status'=>'true','message'=>'Purity successfully Updated','reload'=>'0');
            }
            else 
            {
                $arr=array('status'=>'false','message'=>$validator->errors()->all());
            }
            echo json_encode($arr);
        }
    }
    public function diamond_type()
    {
        return view('admin.products.diamond_type');
    }
    public function get_diamond_type(Request $request)
    {
        $columns = array( 
            0 =>'id', 
            1 =>'name',
            2 =>'status',
        );  
        $totalData = DiamondType::count();            
        $totalFiltered = $totalData;
        $limit = $request->input('length');
        $start = $request->input('start');
        $order = $columns[$request->input('order.0.column')];
        $dir = $request->input('order.0.dir');
            
        if(empty($request->input('search.value')))
        {            
            $institutes = DiamondType::offset($start)
                         ->limit($limit)
                         ->orderBy($order,$dir)
                         ->get();
        }else {
            $search = $request->input('search.value'); 

            $institutes =  DiamondType::where('id','LIKE',"%{$search}%")
                            ->orWhere('name', 'LIKE',"%{$search}%")
                            ->offset($start)
                            ->limit($limit)
                            ->orderBy($order,$dir)
                            ->get();

            $totalFiltered = DiamondType::where('id','LIKE',"%{$search}%")
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
                $nestedData['status'] = '<label class="switch"><input value="1" class="manage_status" name="status_'.$institute->id.'" data-id="'.$institute->id.'" data-url="'.url('admin/products/diamond_type_manage_operation/').'" type="checkbox" '.$chk.'><span class="slider round"></span></label>';
                $nestedData['action'] = '<a data-url="'.url('admin/products/diamond_type_manage_operation/').'" href="javascript:;" class="btn btn-info update_diamond_type" data-id="'.$institute->id.'"  data-cat="'.$institute->name.'"><i class="fa fa-edit"></i></a>&nbsp;&nbsp;';
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
    public function diamond_type_manage_operation(Request $request)
    {
        if($request->action=='status')
        {
            $cat = DiamondType::where('id',$request->id)->first();
            $cat->status=$request->status;
            echo $cat->update();
        }
        else if($request->action=='insert')
        {
            $validator=Validator::make($request->all(),['name'=>'required']);
            if($validator->passes())
            {
                $cat = new DiamondType();
                $cat->name=$request->name;
                $cat->status=1;
                $cat->save();
                $arr=array('status'=>'true','message'=>'Diamond Type successfully Added','reload'=>'0');
            }
            else 
            {
                $arr=array('status'=>'false','message'=>$validator->errors()->all());
            }
            echo json_encode($arr);
        }
        else if($request->action=='update')
        {
            $validator=Validator::make($request->all(),['name'=>'required']);
            if($validator->passes())
            {
                $cat =DiamondType::where('id',$request->id)->get()->first();
                $cat->name=$request->name;
                $cat->update();
                $arr=array('status'=>'true','message'=>'Diamond Type successfully Updated','reload'=>'0');
            }
            else 
            {
                $arr=array('status'=>'false','message'=>$validator->errors()->all());
            }
            echo json_encode($arr);
        }
    }
}
