<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class IndexController extends Controller
{
    // 首页
    public function index()
    {
        return view('admin.admin.index');
    }

    // 我的桌面
    public function welcome()
    {
        return view('admin.admin.welcome');
    }
}
