@extends('layouts.admin')
@section('content')
    <!--面包屑导航 开始-->
    <div class="crumb_warp">
        <!--<i class="fa fa-bell"></i> 欢迎使用登陆网站后台，建站的首选工具。-->
        <i class="fa fa-home"></i> <a href="{{url('admin/info')}}">首页</a> &raquo;  链接管理
    </div>
    <!--结果集标题与导航组件 开始-->
    <div class="result_wrap">
        <div class="result_title">
            <h3>链接列表</h3>
        </div>
    <!--面包屑导航 结束-->


    <!--搜索结果页面 列表 开始-->
    <form action="#" method="post">
        <div class="result_wrap">
            <!--快捷导航 开始-->
            <div class="result_content">
                <div class="short_wrap">
                    <a href="{{url('admin/links/create')}}"><i class="fa fa-plus"></i>新增链接</a>
                    <a href="{{url('admin/links')}}"><i class="fa fa-recycle"></i>链接列表</a>
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
                        <th>介绍</th>
                        <th>链接地址</th>
                        <th>操作</th>
                    </tr>
                    @foreach($data as $v)
                    <tr>
                        <td class="tc">
                            <input type="text" onchange="changeOrder(this,'{{$v->link_id}}')" value="{{$v->link_order}}">
                        </td>
                        <td class="tc">{{$v->link_id}}</td>
                        <td>
                            <a href="#">{{$v->_link_name}}</a>
                        </td>
                        <td>{{$v->link_intro}}</td>
                        <td>{{$v->link_url}}</td>
                        <td>
                            <a href="{{url('admin/links').'/'.$v->link_id}}">修改</a>
                            <a href="javascript:;" onclick="delCate({{$v->link_id}})">删除</a>
                        </td>
                    </tr>
                    @endforeach
                </table>


    <!--搜索结果页面 列表 结束-->
    <script>
        function changeOrder(obj,link_id) {
           var link_order= $(obj).val();
           $.post('{{url('admin/links/changeorder')}}',{'_token':'{{csrf_token()}}',link_id:link_id,link_order:link_order},function (data) {
                if(data.status==0){
                    layer.alert(data.msg, {icon: 6});
                }
           });
        }

        function delCate(link_id) {
            //询问框
            layer.confirm('你确定要删除该链接吗', {
                btn: ['确定','取消'] //按钮
            }, function(){
                    $.post("{{url('admin/links')}}"+'/'+link_id,{'_method':'delete','_token':'{{csrf_token()}}',link_id:link_id},function (data) {
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
