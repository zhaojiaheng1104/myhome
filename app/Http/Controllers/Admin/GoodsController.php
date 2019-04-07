<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class GoodsController extends Controller
{
    //商品列表
    public function index(Request $request)
    {
    	return view('admin.goods.index');
    }
    //商品添加 加载用户添加模板
    public function add()
    {
		return view('admin.goods.add');
    }

    //商品实际添加
    public function doadd(Request $request)
    {
		
    }
    //修改 加载修改模板
    public function edit()
    {
		return view('admin.goods.edit');
    }
    //实际修改
     public function doedit(Request $request)
    {
    	
    }
}
