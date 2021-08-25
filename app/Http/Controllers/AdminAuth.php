<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use App\model\User;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Http\Response;
use Session;
class AdminAuth extends Controller
{
    public function index(Request $request)
    {
        if(Session::get('admin_session'))
        {
            return redirect('/admin/dashboard');
        }
        if(request()->ajax())
        {
            $validator = Validator::make($request->all(),['email'=>'required','password'=>'required']);
            if($validator->passes())
            {
                $user = User::select(['name','user_id','email','mobile','role','status'])->where('email',$request->email)->where('password',md5($request->password))->get()->first();
                if($user) {
                    if($user->status==1) {
						if($user->role==2)
						{
							echo json_encode(array('status'=>'false','message'=>'Invalid User'));
							die();
						}
                        
                        if($request->remember==1)
                        {
                          /*  $minutes = 525600;
                            $response = new Response('login');
                            $response->withCookie(cookie('admin_email', $request->email, $minutes));
                            $response->withCookie(cookie('admin_password', $request->password, $minutes));*/
                            setcookie("admin_email", $request->email, time() + 7600000, '/');
                            setcookie("admin_password", $request->password, time() + 7600000, '/');
                        }
                        $request->session()->put('admin_session',$user);
                        $arr=array('status'=>'true','message'=>'Successfully Login','reload'=>url('admin/dashboard'));
                    } else{
                        $arr=array('status'=>'false','message'=>'Your Account is Inactive');
                    }
                } else {
                    $arr=array('status'=>'false','message'=>'E-mail And Password Not Match');
                }
            } else{
                $arr=array('status'=>'false','message'=>$validator->errors()->all());
            }
           echo json_encode($arr);
        }
        else 
        {
            if(isset($_COOKIE['admin_email']) && isset($_COOKIE['admin_password'])){
                $data['email']=$_COOKIE['admin_email'];
                $data['password']=$_COOKIE['admin_password'];
            }
            else 
            {
                $data['email']='';
                $data['password']='';
            }
            return view('admin.auth.login',$data);
        }
        
    }
	public function forgot_password(Request $request)
	{
		if(request()->ajax())
		{
			$user = User::where('email',$request->email)->get()->first();
			if($user)
			{
				$password = date('si').rand(10,100);
				$user->password=md5($password);
				$user->update();
				$message='Hello '.$user->name.' Your '.get_setting('site_title').' Account New Password Is '.$password;
				$resp =send_email($request->email,get_setting('site_title').' Account Password Reset','info@ewayits.com',$message);
				$arr=array('status'=>'true','message'=>'New Password Send on your email','reload'=>url('admin'));
			}
			else
			{
				$arr=array('status'=>'false','message'=>'E-Mail Not exists');
			}
			echo json_encode($arr);
		}
		else 
		{
			return view('admin.auth.forgot_password');
		}
	}
}
