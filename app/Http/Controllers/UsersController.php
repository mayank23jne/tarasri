<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use App\model\RoleMaster;
use App\model\user;
class UsersController extends Controller
{
    public function role_manage()
    {
        return view('admin.users.role_manage');
    }
    public function role_manage_operation(Request $request)
    {
        if($request->action=='insert')
        {
            $validator=Validator::make($request->all(),['role_name'=>'required']);
            if($validator->passes())
            {
                $permission_arr=set_permission($request);
                if($permission_arr)
                {
                    $role = new RoleMaster();   
                    $role->title=$request->role_name;
                    $role->permission=json_encode($permission_arr);  
                    $role->status=1;
                    $role->save();
                    $arr=array('status'=>'true','message'=>'Role Successfully Added','reload'=>'0');
                }
                else 
                {
                    $arr=array('status'=>'false','message'=>'Please Select Any Permission');
                }
            }
            else 
            {
                $arr=array('status'=>'false','message'=>$validator->errors()->all());
            }
            echo json_encode($arr);
        }
        else if($request->action=='status')
        {
            $role = RoleMaster::where('id',$request->id)->get()->first();
            $role->status=$request->status;
            echo $role->update();
        }
        else if($request->action=='get_update_info')
        {
            $role = RoleMaster::where('id',$request->id)->get()->first();
            return view('admin.users.render.role_update',['role'=>$role]);
        }
        else if($request->action=='update')
        {
            $validator=Validator::make($request->all(),['role_name'=>'required']);
            if($validator->passes())
            {
                $permission_arr=set_permission($request);
                if($permission_arr)
                {
                    $role = RoleMaster::where('id',$request->id)->get()->first();   
                    $role->title=$request->role_name;
                    $role->permission=json_encode($permission_arr);  
                    $role->update();
                    $arr=array('status'=>'true','message'=>'Role Successfully Updated','reload'=>'0');
                }
                else 
                {
                    $arr=array('status'=>'false','message'=>'Please Select Any Permission');
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
            print_r($request->all());
        }
    }
    public function get_role(Request $request)
    {
        $columns = array( 
            0 =>'id', 
            1 =>'title',
            2 =>'status',
        );  
        $totalData = RoleMaster::count();            
        $totalFiltered = $totalData;
        $limit = $request->input('length');
        $start = $request->input('start');
        $order = $columns[$request->input('order.0.column')];
        $dir = $request->input('order.0.dir');
            
        if(empty($request->input('search.value')))
        {            
            $institutes = RoleMaster::offset($start)
                         ->limit($limit)
                         ->orderBy($order,$dir)
                         ->get();
        }else {
            $search = $request->input('search.value'); 

            $institutes =  RoleMaster::where('id','LIKE',"%{$search}%")
                            ->orWhere('title', 'LIKE',"%{$search}%")
                            ->offset($start)
                            ->limit($limit)
                            ->orderBy($order,$dir)
                            ->get();

            $totalFiltered = RoleMaster::where('id','LIKE',"%{$search}%")
                             ->orWhere('title', 'LIKE',"%{$search}%")
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
                $nestedData['title'] = $institute->title;
                $nestedData['status'] = '<label class="switch"><input value="1" class="manage_status" name="status_'.$institute->id.'" data-id="'.$institute->id.'" data-url="'.url('admin/users/role_manage_operation/').'" type="checkbox" '.$chk.'><span class="slider round"></span></label>';
                $nestedData['action'] = '<a data-url="'.url('admin/users/role_manage_operation/').'" href="javascript:;" class="btn btn-info update_role" data-id="'.$institute->id.'"><i class="fa fa-edit"></i></a>&nbsp;&nbsp;';
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
    public function user_manage()
    {
        $data['roles']=RoleMaster::where('status','1')->get()->toArray();
        return view('admin.users.user_manage',$data);
    }
    public function manage_user_operation(Request $request)
    {
        if($request->action=='insert')
        {
            $validator = Validator::make($request->all(),['name'=>'required','email'=>'required|email','mobile_no'=>'required|numeric','role'=>'required','password'=>'required','confirm_password'=>'required_with:password|same:password']);
            if($validator->passes())
            {
                $isExists=user::select(['email'])->where('email',$request->email)->get()->first();
                if($isExists)
                {
                    $arr=array('status'=>'false','message'=>'E-Mail Already Exists');
                }
                else 
                {
                    $user = new user();
                    $user->name=$request->name;
                    $user->email=$request->email;
                    $user->mobile=$request->mobile_no;
                    $user->role=$request->role;
                    $user->user_avatar=' ';
                    $user->address=' ';
                    $user->hash=' ';
                    $user->status=1;
                    $user->password=md5($request->password);
                    $user->save();
                    $arr=array('status'=>'true','message'=>'User Successfully Added','reload'=>'0');
					
					$zohoData = array(
						"SingleLine"=>$request->mobile_no,
						"SingleLine1"=>$request->name,
						"SingleLine2"=>$user->user_id,
						"SingleLine3"=>$request->email
					);
					$this->saveUser($zohoData);
                }
            }
            else 
            {
                $arr=array('status'=>'false','message'=>$validator->errors());
            }
            echo json_encode($arr);
        }
        else if($request->action=='status')
        {
           $usr1 = user::where('user_id',$request->id)->first();
           $usr1->status=$request->status;
           echo $usr1->update();
        }
        else if($request->action=='update')
        {
            $validator = Validator::make($request->all(),['name'=>'required','email'=>'required|email','mobile_no'=>'required|numeric','role'=>'required','confirm_password'=>'required_with:password|same:password']);
            if($validator->passes())
            {
                    $user = user::where('user_id',$request->id)->get()->first();
                    $user->name=$request->name;
                    $user->email=$request->email;
                    $user->mobile=$request->mobile_no;
                    $user->role=$request->role;
                    $user->status=1;
                    if($request->password)
                        $user->password=md5($request->password);
                    $user->save();
                    $arr=array('status'=>'true','message'=>'User Successfully Updated','reload'=>'0');
            }
            else 
            {
                $arr=array('status'=>'false','message'=>$validator->errors());
            }
            echo json_encode($arr);
        }
        
    }
	public function saveUser($data){
        $result = get_curl('https://forms.zohopublic.com/anandgupta1/form/Users/formperma/2mxWtrT_G05H6jykIXeP1yi6ebYh1opUFPujwh9CfBc/htmlRecords/submit','POST',$data);
        return $result;
    }
    public function get_user(Request $request)
    {;
        $columns = array( 
            0 =>'user_id', 
            1 =>'name',
            2 =>'email',
            3 =>'mobile',
            4 =>'created_at',
            5 =>'role',
            6 =>'status',
        );  
        $totalData = user::count();            
        $totalFiltered = $totalData;
        $limit = $request->input('length');
        $start = $request->input('start');
        $order = $columns[$request->input('order.0.column')];
        $dir = $request->input('order.0.dir');
            
        if(empty($request->input('search.value')))
        {    
            if($request->role)
            {
                $institutes = user::offset($start)
                         ->limit($limit)
                         ->where('role',$request->role)
                         ->orderBy($order,$dir)
                         ->get();
            }        
            else 
            {
                $institutes = user::offset($start)
                         ->limit($limit)
                         ->orderBy($order,$dir)
                         ->get();
            }
            
        }else {
            $search = $request->input('search.value'); 
            if($request->role)
            {
                             $institutes =  user::where('user_id','LIKE',"%{$search}%")
                            ->where('role',$request->role)
                            ->orWhere('name', 'LIKE',"%{$search}%")
                            ->orWhere('email', 'LIKE',"%{$search}%")
                            ->orWhere('mobile', 'LIKE',"%{$search}%")
                            ->offset($start)
                            ->limit($limit)
                            ->orderBy($order,$dir)
                            ->get();
            }
            else 
            {
                            $institutes =  user::where('user_id','LIKE',"%{$search}%")
                            ->orWhere('name', 'LIKE',"%{$search}%")
                            ->orWhere('email', 'LIKE',"%{$search}%")
                            ->orWhere('mobile', 'LIKE',"%{$search}%")
                            ->offset($start)
                            ->limit($limit)
                            ->orderBy($order,$dir)
                            ->get();
            }
            if($request->role)
            {
                            $totalFiltered = user::where('user_id','LIKE',"%{$search}%")
                            ->where('role',$request->role)
                             ->orWhere('name', 'LIKE',"%{$search}%")
                            ->orWhere('email', 'LIKE',"%{$search}%")
                            ->orWhere('mobile', 'LIKE',"%{$search}%")
                             ->count();
            }
            else 
            {
                            $totalFiltered = user::where('user_id','LIKE',"%{$search}%")
                            ->orWhere('name', 'LIKE',"%{$search}%")
                            ->orWhere('email', 'LIKE',"%{$search}%")
                            ->orWhere('mobile', 'LIKE',"%{$search}%")
                            ->count();
            }
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
                $nestedData['name'] = $institute->name;
                $nestedData['email'] = $institute->email;
                $nestedData['mobile_no'] = $institute->mobile;
                $nestedData['role'] = getSinglerow('role_masters','title',array('id'=>$institute->role));
                $nestedData['created_date'] =date('d M,Y',strtotime($institute->created_at));
                $nestedData['status'] = '<label class="switch"><input value="1" class="manage_status" name="status_'.$institute->user_id.'" data-id="'.$institute->user_id.'" data-url="'.url('admin/users/manage_user_operation/').'" type="checkbox" '.$chk.'><span class="slider round"></span></label>';
                $nestedData['action'] = '<a data-name="'.$institute->name.'"  data-email="'.$institute->email.'" data-mobile="'.$institute->mobile.'" data-role="'.$institute->role.'" data-url="'.url('admin/users/manage_user_operation/').'" href="javascript:;" class="btn btn-info update_user" data-id="'.$institute->user_id.'"><i class="fa fa-edit"></i></a>&nbsp;&nbsp;';
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
}
