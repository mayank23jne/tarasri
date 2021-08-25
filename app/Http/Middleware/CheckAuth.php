<?php

namespace App\Http\Middleware;
use Closure;
use Session;
use App\model\RoleMaster;
class CheckAuth
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {   
            if(!Session::get('admin_session'))
            {
                return redirect('/admin');
            }
			else 
			{
				$role=RoleMaster::where('id',Session::get('admin_session')->role)->get()->first();
				$user_access=json_decode(json_encode(json_decode($role->permission)),true);
				
				$segment = $request->segment(2); 
				if($segment=='users') 
				{
					if(!array_key_exists('manage_user',$user_access))
					{
						return redirect(url('admin'));
					}
				}
				if($segment=='blog' || $segment=='add_new_blog' || $segment=='edit_blog') 
				{
					if(!array_key_exists('news',$user_access))
					{
						return redirect(url('admin'));
					}
				}
				if($segment=='crimsonbride' || $segment=='add_new_crimsonbride' || $segment=='edit_crimsonbride') 
				{
					if(!array_key_exists('crimsonbride',$user_access))
					{
						return redirect(url('admin'));
					}
				}
				if($segment=='landing-page' || $segment=='add-landing-page' || $segment=='edit-landing-page') 
				{
					if(!array_key_exists('landingpage',$user_access))
					{
						return redirect(url('admin'));
					}
				}
				if($segment=='tarasri_exclusive') 
				{
					
					if(!array_key_exists('tarasri_exclusive',$user_access))
					{
						return redirect(url('admin'));
					}
				}
				if($segment=='products') 
				{
					if(!array_key_exists('products',$user_access))
					{
						return redirect(url('admin'));
					}
				}
				if($segment=='enquiry') 
				{
					if(!array_key_exists('enquiry',$user_access))
					{
						return redirect(url('admin'));
					}
				}
				if($segment=='contactus') 
				{
					if(!array_key_exists('contact_us',$user_access))
					{
						return redirect(url('admin'));
					}
				}
				if($segment=='setting') 
				{
					if(!array_key_exists('setting',$user_access))
					{
						return redirect(url('admin'));
					}
				}
				if($segment=='testimonial') 
				{
					if(!array_key_exists('testimonial',$user_access))
					{
						return redirect(url('admin'));
					}
				}
				
				
			}
        return $next($request);
    }
}
