
<!DOCTYPE HTML>
<html>
<head>
<meta charset="utf-8">
<meta name="renderer" content="webkit|ie-comp|ie-stand">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no" />
<meta http-equiv="Cache-Control" content="no-siteapp" />
<!--[if lt IE 9]>
<script type="text/javascript" src="lib/html5shiv.js"></script>
<script type="text/javascript" src="lib/respond.min.js"></script>
<![endif]-->
<link rel="stylesheet" type="text/css" href="/admin/static/h-ui/css/H-ui.min.css" />
<link rel="stylesheet" type="text/css" href="/admin/static/h-ui.admin/css/H-ui.admin.css" />
<link rel="stylesheet" type="text/css" href="/admin/lib/Hui-iconfont/1.0.8/iconfont.css" />
<link rel="stylesheet" type="text/css" href="/admin/static/h-ui.admin/skin/default/skin.css" id="skin" />
<link rel="stylesheet" type="text/css" href="/admin/static/h-ui.admin/css/style.css" />
<!--[if IE 6]>
<script type="text/javascript" src="lib/DD_belatedPNG_0.0.8a-min.js" ></script>
<script>DD_belatedPNG.fix('*');</script>
<![endif]-->
<title>轮播图管理</title>
</head>
<body>
<nav class="breadcrumb"><i class="Hui-iconfont">&#xe67f;</i> 首页 <span class="c-gray en">&gt;</span> 轮播图中心 <span class="c-gray en">&gt;</span> 轮播图管理 <a class="btn btn-success radius r" style="line-height:1.6em;margin-top:3px" href="javascript:location.replace(location.href);" title="刷新" ><i class="Hui-iconfont">&#xe68f;</i></a></nav>
<div class="page-container">
  <form action="/admin/picture/index" method="get">
  <div class="text-c">
    <label>显示
            <select size="1" name="count" aria-controls="DataTables_Table_1">
              <option value="5"  @if(isset($request['count']) && $request['count'] == 5) selected @endif>5</option>
              <option value="10" @if(isset($request['count']) && $request['count'] == 10) selected @endif>10</option>
              <option value="15" @if(isset($request['count']) && $request['count'] == 15) selected @endif>15</option>
              <option value="50" @if(isset($request['count']) && $request['count'] == 50) selected @endif>50</option>
          </select>条</label>

    <input type="text" class="input-text" style="width:250px" placeholder="输入会员名称、电话、邮箱" name="search" value="{{ $request['search'] or '' }}">
    <input type="submit" class="btn btn-success radius" id="" name="" value="搜标题"><!-- <i class="Hui-iconfont">&#xe665;</i> 搜用户</button> -->

    </form>
  </div>
  <div class="cl pd-5 bg-1 bk-gray mt-20"> <span class="l"><a href="javascript:;" onclick="" class="btn btn-danger radius"><i class="Hui-iconfont">&#xe6e2;</i> 批量删除</a> <a href="javascript:;" onclick="member_add('添加用户','/admin/picture/add','','510')" class="btn btn-primary radius"><i class="Hui-iconfont">&#xe600;</i> 添加轮播图</a></span> <span class="r">共有数据：<strong>{{ $counts }}</strong> 条</span> </div>
  <div class="mt-20">
  <table class="table table-border table-bordered table-hover table-bg table-sort">
    <thead>
      <tr class="text-c">
        <th width="50">ID</th>
        <th width="100">轮播标题</th>
        <th width="180">轮播图片</th>
        <th width="80">是否显示</th>
        <th width="150">操作</th>
      </tr>
    </thead>
    <tbody>
      @foreach($picture_data as $k=>$v)
      <tr class="text-c">
        <td>{{ $v->id }}</td>
        <td><u style="cursor:pointer" class="text-primary" onclick="member_show('{{ $v->title }}','member-show.html','10001','360','400')"> {{ $v->title }}</u></td>
        <td>
          <img src="/images/{{ $v->src }}" style="width: 150px; height: auto; ">  
      </td>
       <td class="td-status" onclick="member_stop('this',{{ $v->id }})"><!-- <span class="label label-success radius"> -->
            {!! $v->display == 0 ? '<span class="label label-success radius display1" >已发布</span>' : '<span class="label label-defaunt radius display1">已下架</span>' !!}
           </td>
        <td class="td-manage">
          <a style="text-decoration:none" class="ml-5" onClick="picture_edit('图库编辑','picture-add.html','10001')" href="/admin/picture/edit/{{ $v->id }}" title="编辑"><i class="Hui-iconfont">&#xe6df;</i></a> 
            <form action="/admin/picture/destroy/{{ $v->id }}" method="post" style="display: inline-block;">
                    {{ csrf_field() }}
                    {{ method_field('DELETE') }}
                   
                    <a style="text-decoration:none" class="ml-5" onClick="picture_del(this,'10001')" href="/admin/picture/destroy/{{ $v->id }}" title="删除"><i class="Hui-iconfont">&#xe6e2;</i></a>
                   
                    </form>
          </td> 
      </tr>
      @endforeach
    </tbody>
  </table>
  <div id="fenye" class="bs-example">
      <nav aria-label="Page navigation">
      {{ $picture_data->appends($request)->links() }}
      </nav>
    </div>
  </div>
</div>
<!--_footer 作为公共模版分离出去-->
<script type="text/javascript" src="/admin/lib/jquery/1.9.1/jquery.min.js"></script> 
<script type="text/javascript" src="/admin/lib/layer/2.4/layer.js"></script>
<script type="text/javascript" src="/admin/static/h-ui/js/H-ui.min.js"></script> 
<script type="text/javascript" src="/admin/static/h-ui.admin/js/H-ui.admin.js"></script> <!--/_footer 作为公共模版分离出去-->

<!--请在下方写此页面业务相关的脚本-->
<script type="text/javascript" src="/admin/lib/My97DatePicker/4.8/WdatePicker.js"></script> 
<script type="text/javascript" src="/admin/lib/datatables/1.10.0/jquery.dataTables.min.js"></script> 
<script type="text/javascript" src="/admin/lib/laypage/1.2/laypage.js"></script>
<script type="text/javascript">
// $(function(){
//   $('.table-sort').dataTable({
//     "aaSorting": [[ 1, "desc" ]],//默认第几个排序
//     "bStateSave": true,//状态保存
//     "aoColumnDefs": [
//       //{"bVisible": false, "aTargets": [ 3 ]} //控制列的隐藏显示
//       {"orderable":false,"aTargets":[0,8,9]}// 制定列不参与排序
//     ]
//   });
  
// });
/*用户-添加*/
function member_add(title,url,w,h){
  layer_show(title,url,w,h);
}
/*用户-查看*/
function member_show(title,url,id,w,h){
  layer_show(title,url,w,h);
}
/*用户-停用*/
function member_stop(obj,id){
  layer.confirm('确认要停用吗？',function(index){
    $.ajax({
      type: 'POST',
       url: '/admin/picture/display/{id}',
      dataType: 'json',  
      success: function(data){
        $(obj).parents("tr").find(".td-manage").prepend('<a style="text-decoration:none" onClick="member_start(this,id)" href="javascript:;" title="启用"><i class="Hui-iconfont">&#xe6e1;</i></a>');
         $(obj).parents("tr").find(".td-status").html('<span class="label label-defaunt radius">已停用</span>');
        $(obj).remove();
        layer.msg('已停用!',{icon: 5,time:1000});
      },
      error:function(data) {
         console.log(data.msg);
      },
     });   
  });
 }

// 用户-启用
 function member_start(obj,id){
   layer.confirm('确认要启用吗？',function(index){
     $.ajax({
      type: 'POST',
       url: '',
       dataType: 'json',
       success: function(data){
         $(obj).parents("tr").find(".td-manage").prepend('<a style="text-decoration:none" onClick="member_stop(this,id)" href="javascript:;" title="停用"><i class="Hui-iconfont">&#xe631;</i></a>');
         $(obj).parents("tr").find(".td-status").html('<span class="label label-success radius">已启用</span>');
         $(obj).remove();
         layer.msg('已启用!',{icon: 6,time:1000});
       },
       error:function(data) {
         console.log(data.msg);
       },
     });
   });
 }
/*用户-编辑*/
function member_edit(title,url,id,w,h){
  layer_show(title,url,w,h);
}
/*密码-修改*/
function change_password(title,url,id,w,h){
  layer_show(title,url,w,h);  
}
/*用户-删除*/
function member_del(obj,id){
  layer.confirm('确认要删除吗？',function(index){
    $.ajax({
      type: 'POST',
      url: '',
      dataType: 'json',
      success: function(data){
        $(obj).parents("tr").remove();
        layer.msg('已删除!',{icon:1,time:1000});
      },
      error:function(data) {
        console.log(data.msg);
      },
    });   
  });
}

</script> 
</body>
</html>