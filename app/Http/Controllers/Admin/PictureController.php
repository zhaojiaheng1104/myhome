<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Admin\Picture;
use DB;
class PictureController extends Controller
{
    //轮播图列表
    public function index(Request $request)
    {
        $count = $request->input('count',3);
        $search = $request->input('search','');
        $picture_data = Picture::where('title','like','%'. $search.'%')->paginate($count);
        $counts = DB::table('picture')->count();
    	return view('/admin/picture/index',['picture_data'=>$picture_data,'request'=>$request->all(),'counts'=>$counts]);
    }
    //轮播图添加 加载轮播图添加模板
    public function add()
    {

		return view('/admin/picture/add');
    }

    //轮播图实际添加
    public function doadd(Request $request)
    {
         if($request->hasFile('src'))
        {
            $file = $request->file('src');
            $ext = $file->extension();
            // 拼接名称
            $file_name = time()+rand(1000,9999).'.'.$ext;
            $img = $file->storeAs('',$file_name);    
        }
		 $picture_data = $request->except('_token');

         $picture_data['src'] = $img;
         $picture = new Picture;
         $picture->display = $picture_data['display'];
         $picture->title = $picture_data['title'];
         $picture->src = $picture_data['src'];
         $res = $picture->save();
         if ($res) {
            return redirect('/admin/picture/index')->with('success','添加成功');
         }else{
             return redirect('/admin/picture/index')->with('error','添加失败');
         }
    }
    //修改 加载修改模板
    public function edit($id)
    {
        $picture_data = Picture::find($id);
		return view('/admin/picture/edit',['picture_data'=>$picture_data]);
    }
    //实际修改
    public function doedit($id)
    {   
        $picture_info = Picture::find($id);
    	$picture_data = Request::except('_token');
        $picture_info->title = $picture_data['title'];
        $picture_info->display = $picture_data['display'];
         if($request->hasFile('src'))
        {
            $file = Request::file('src');
            $ext = $file->extension();
            // 拼接名称
            $file_name = time()+rand(1000,9999).'.'.$ext;
            $img = $file->storeAs('',$file_name);    
        }
    
        $picture_data['src'] = $img;
        $picture_info['src'] = $picture_data['src'];
        $res = $picture_info->save();
        if ($res) {
           return redirect('/admin/picture/index')->with('success','修改成功');
        }else{
            return redirect('/admin/picture/index')->with('error','修改失败');
        }
    
    }
    public function display(Request $request,$id){
        
        if ($res) {
           return redirect('/admin/picture/index')->with('success','success');
        }else{
           return redirect('/admin/picture/index')->with('error','success');
        }
    }
}
