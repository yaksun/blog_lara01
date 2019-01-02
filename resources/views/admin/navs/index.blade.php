@extends('layouts.admin')
@section('content')
    <!--面包屑导航 开始-->
    <div class="crumb_warp">
        <!--<i class="fa fa-bell"></i> 欢迎使用登陆网站后台，建站的首选工具。-->
        <i class="fa fa-home"></i> <a href="{{url('admin/info')}}">首页</a> &raquo;  导航管理
    </div>
    <!--结果集标题与导航组件 开始-->
    <div class="result_wrap">
        <div class="result_title">
            <h3>导航列表</h3>
        </div>
    <!--面包屑导航 结束-->


    <!--搜索结果页面 列表 开始-->
    <form action="#" method="post">
        <div class="result_wrap">
            <!--快捷导航 开始-->
            <div class="result_content">
                <div class="short_wrap">
                    <a href="{{url('admin/navs/create')}}"><i class="fa fa-plus"></i>新增导航</a>
                    <a href="{{url('admin/navs')}}"><i class="fa fa-recycle"></i>导航列表</a>
                </div>
            </div>
            <!--快捷导航 结束-->
        </div>

        <div class="result_wrap">
            <div class="result_content">
                <table class="list_tab">
                    <tr>
                        <th class="tc" width="5%">排序</th>
                        <th class="tc" width="5%">ID</th>
                        <th>名称</th>
                        <th>别名</th>
                        <th>介绍</th>
                        <th>导航地址</th>
                        <th>操作</th>
                    </tr>
                    @foreach($data as $v)
                    <tr>
                        <td class="tc">
                            <input type="text" onchange="changeOrder(this,'{{$v->nav_id}}')" value="{{$v->nav_order}}">
                        </td>
                        <td class="tc">{{$v->nav_id}}</td>
                        <td>
                            <a href="#">{{$v->nav_name}}</a>
                        </td>
                        <td>
                            <a href="#">{{$v->nav_alias}}</a>
                        </td>
                        <td>{{$v->nav_tips}}</td>
                        <td>{{$v->nav_url}}</td>
                        <td>
                            <a href="{{url('admin/navs').'/'.$v->nav_id}}">修改</a>
                            <a href="javascript:;" onclick="delCate({{$v->nav_id}})">删除</a>
                        </td>
                    </tr>
                    @endforeach
                </table>


    <!--搜索结果页面 列表 结束-->
    <script>
        function changeOrder(obj,nav_id) {
           var nav_order= $(obj).val();
           $.post('{{url('admin/navs/changeorder')}}',{'_token':'{{csrf_token()}}',nav_id:nav_id,nav_order:nav_order},function (data) {
                if(data.status==0){
                    layer.alert(data.msg, {icon: 6});
                }
           });
        }

        function delCate(nav_id) {
            //询问框
            layer.confirm('你确定要删除该导航吗', {
                btn: ['确定','取消'] //按钮
            }, function(){
                    $.post("{{url('admin/navs')}}"+'/'+nav_id,{'_method':'delete','_token':'{{csrf_token()}}',nav_id:nav_id},function (data) {
                        if(data.status==0){
                            location.href=location.href;
                            layer.alert(data.msg, {icon: 6});
                        }else{
                            layer.alert(data.msg, {icon: 5});
                        }
                    });
            }, function(){

                /*layer.msg('也可以这样', {
                    time: 20000, //20s后自动关闭
                    btn: ['明白了', '知道了']
                });*/
            });
        }
    </script>
@endsection
