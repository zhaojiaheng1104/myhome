<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Admin\User;
use App\Models\Admin\Usersinfo;
use DB;
class UserController extends Controller
{
	//用户列表
    public function index(Request $request)
    {
        $count = $request->input('count',3);
        $search = $request->input('search','');
        $user_data = User::where('name','like','%'. $search.'%')->paginate($count);
       if ($user_data) {
          foreach ($user_data as $key => $value) {
             $user_id = $value->id;
          }
       }
        $userinfo_data = DB::table('user_info')->where('user_id',$user_id)->first();
        $counts = DB::table('users')->count();
    	return view('/admin/user/index',['user_data'=>$user_data,'request'=>$request->all(),'counts'=>$counts,'userinfo_data'=>$userinfo_data]);
    }
    //用户添加 加载用户添加模板
    public function add()
    {
		return view('/admin/user/add');
    }

    //用户实际添加
    public function doadd(Request $request)
    {

        if($request->hasFile('user_img'))
        {
            $file = $request->file('user_img');
            $ext = $file->extension();
            // 拼接名称
            $file_name = time()+rand(1000,9999).'.'.$ext;
            $img = $file->storeAs('',$file_name);    
        }
        $user_data = $request->except('_token'); 
        $user_data['user_img'] = $img;
		$user = new User;
        $user->name = $user_data['name'];
        $res1 = $user->save();
        $usersinfo = new Usersinfo;
        $usersinfo->user_id = $user->id;
        $usersinfo->sex = $user_data['sex'];
        $usersinfo->phone = $user_data['phone'];
        $usersinfo->email = $user_data['email'];
        $usersinfo->user_img = $user_data['user_img'];
        $usersinfo->descr = $user_data['descr'];
        $res2 = $usersinfo->save(); 
        if ($res1 && $res2) {
           return redirect('/admin/user/index')->with('success', '添加成功');
        }else{
            return back()->with('error', '添加失败');
        }
    }
    //修改 加载修改模板
    public function edit($id)
    {
        $user_data = User::find($id);
        
        if ($user_data){
            $user_id = $user_data['id'];
        } 
        $userinfo_data = Usersinfo::where('user_id',$user_id)->first();
          
		return view('/admin/user/edit',['user_data'=>$user_data,'userinfo_data'=>$userinfo_data]);
    }
    //实际修改
     public function doedit(Request $request,$id)
    {
      
    	$user_data = User::find($id);
        $user_data->name = $request->input('name','');
        $res1 = $user_data->save();
        $userinfo_data = Usersinfo::where('user_id',$id)->first();
        $userinfo_data->user_id = $request->input('user_id','');
        $userinfo_data->sex = $request->input('sex','');
        $userinfo_data->email = $request->input('email','');
        $userinfo_data->descr = $request->input('descr','');
          if ($request->hasFile('user_img')) {
            $file = $request->file('user_img');
            $ext = $file->extension();
            // 拼接名称
            $file_name = time()+rand(1000,9999).'.'.$ext;
            $img = $file->storeAs('',$file_name); 
        }
        $user_img = $request->input('user_img');
        $user_img = $img;
        $usersinfo_data->user_img = $user_img;
        $res2 = $usersinfo_data->save();
        if ($res1 && $res2) {
           return redirect('/admin/user/index')->with('success', '修改成功');
        }else{
            return back()->with('error', '修改失败');
       }
    }
    public function destroy($id){
     $user_data = User::destroy($id);
       $user_id = $user_data->id;
       $userinfo_data = Usersinfo::destroy($user_id);
       if ($user_data && $usersinfo_data) {
            return redirect('/admin/user/index')->with('success', '删除成功');
       }else{
             return back()->with('error', '删除失败');
       }

    }
}
