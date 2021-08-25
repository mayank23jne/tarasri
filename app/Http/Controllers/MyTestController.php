<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Session;
use Validator;
use App\model\Blog;
use App\model\Blog_image;
use App\model\BlogCategory;
use App\model\Categorey;
use App\model\Gemstone;
use App\model\Occassion;
use App\model\Collection;
use App\model\Products;
use App\model\Product_meta;
use App\model\Landingpage;
use App\model\Landingpage_editor;

class MyTestController extends Controller
{
	public function blog($tag='')
	{
		$data = array();
		if($tag)
		{
			$tag=str_replace('-',' ',$tag);
			$data['blog_list']=Blog::select(['blogs.*','blog_categories.name as cat_name'])
			->join('blog_categories','blogs.parent_category','=','blog_categories.id')
			->orderBy('id','desc')
			->where('blogs.status','1')
			->limit(10)
			->whereRaw("find_in_set('".$tag."',tags)")->get()->toArray();
		}
		else 
		{
			$data['blog_list']=Blog::select(['blogs.*','blog_categories.name as cat_name'])
			->join('blog_categories','blogs.parent_category','=','blog_categories.id')
			->orderBy('id','desc')
			->where('blogs.status','1')
			->limit(10)
			->get()->toArray();
		}
		$data['blog_list_count'] = count(Blog::where('status',1)->get()->toArray());
		$data['load_home_utility']='yes';
		$data['latest_list']=Blog::select(['blogs.*','blog_categories.name as cat_name'])
		->join('blog_categories','blogs.parent_category','=','blog_categories.id')
		->orderBy('id','desc')
		->where('blogs.status','1')
		->limit(10)
		->get()->toArray();
		$data['category']=BlogCategory::where('status','1')->get()->toArray();
		$data['product_category']=Categorey::where('status','1')->get()->toArray();
		$data['gemstone']=Gemstone::where('status','1')->get()->toArray();
		$data['occassion']=Occassion::where('status','1')->get()->toArray();
		$data['collection']=Collection::where('status','1')->get()->toArray();
		// echo "<pre>"; print_r($data['latest_list']); die;
	    return view('blog_list_new',$data);
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
		
		
		
		$products=Blog::select(['blogs.*','blog_categories.name as cat_name'])
		->join('blog_categories','blogs.parent_category','=','blog_categories.id')
		->where('blogs.status','1')
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
		});
		
		
		if($request->limit!=11){
			$data['products'] = $products->orderBy('id','desc')->offset($request->limit)->limit(10)->get()->unique('id');
		} else {
			$data['products'] = $products->orderBy('id','desc')->offset(0)->limit(10)->get()->unique('id');
		}
		$data['load_more_button_count'] = $request->load_more_button_count;
		$data['blog_list']=json_decode(json_encode($data['products']),true);
		return view('render.left_filter_blog_new',$data);
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
			$data['latest_list']=Blog::select(['blogs.*','blog_categories.name as cat_name'])
			->join('blog_categories','blogs.parent_category','=','blog_categories.id')
			->orderBy('id','desc')
			->where('blogs.status','1')
			// ->where('slug','!=',$data['blog_list']->slug)
			// ->limit(10)
			->get()
			->toArray();
			$data['blog_images']=Blog_image::where('reffrence',$data['blog_list']->reffrence)->get()->toArray();
			return view('blog_single_new',$data);
		}
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
			return view('render.left_filter_blog_new',$data);
	}
	public function collection_single($slug="")
	{
		if($slug!='')
		{
			$data['product_info']=Products::select(['products.*','metals.name as metal_name'])->join('metals','products.metal_type','=','metals.id')->where('slug',$slug)->get()->first();
			// echo "<pre>"; print_r($data['product_info']); die;
			$data['product_image']=Product_meta::where('product_id',$data['product_info']->id)->where('meta_type',1)->get()->toArray();
			$data['product_video']=Product_meta::where('product_id',$data['product_info']->id)->where('meta_type',2)->get()->first();
			
			$data['collection_product']=Products::select(['products.*','metals.name as metal_name','product_meta.meta_link','product_meta.meta_thumb'])->join('metals','products.metal_type','=','metals.id')->join('product_meta','products.id','=','product_meta.product_id')->where('collection_id',$data['product_info']->collection_id)->where('product_meta.meta_type',1)->skip(0)->take(5)->get()->toArray();
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
			/* echo "<pre>"; print_r($data['collection_product']); die(); */
			$data['cat_name']=$category_name_str;
			return view('collection_single_new',$data);
		}
		else 
		{
			return view('collection_single');
		}
	}
	public function landing_page($slug)
	{
		$data['pages'] = Landingpage::where('slug',$slug)->get()->first();
		$data['page_data']= Landingpage_editor::orderBy('id','ASC')->where('parent',$data['pages']['id'])->get()->toArray();
		return view('tara_mask',$data);
	}
}