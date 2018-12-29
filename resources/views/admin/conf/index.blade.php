@extends('layouts.admin')
@section('content')
    <!--面包屑导航 开始-->
    <div class="crumb_warp">
        <!--<i class="fa fa-bell"></i> 欢迎使用登陆网站后台，建站的首选工具。-->
        <i class="fa fa-home"></i> <a href="#">首页</a> &raquo; 配置管理
    </div>
    <!--面包屑导航 结束-->
    <!--结果集标题与导航组件 开始-->
    <div class="result_wrap">
        <div class="result_title">
            <h3>配置列表</h3>
            @if(count($errors)>0)
                <div class="mark">
                    @if(is_object($errors))
                        @foreach($errors->all() as $error)
                            <p>{{$error}}</p>
                        @endforeach
                    @else
                        <p>{{$errors}}</p>
                    @endif
                </div>
            @endif
        </div>

    <!--结果页快捷搜索框 结束-->

    <!--搜索结果页面 列表 开始-->

        <div class="result_wrap">
            <!--快捷导航 开始-->
            <div class="result_content">
                <div class="short_wrap">
                    <a href="{{url('admin/conf/create')}}"><i class="fa fa-plus"></i>新增配置</a>
                    <a href="{{url('admin/conf')}}"><i class="fa fa-recycle"></i>配置列表</a>
                </div>
            </div>
            <!--快捷导航 结束-->
        </div>

        <div class="result_wrap">
            <div class="result_content">
                <form action="{{url('admin/conf/changecontent')}}" method="post">
                    {{csrf_field()}}
                    <table class="list_tab">

                        <tr>
                            <th class="tc" width="5%">排序</th>
                            <th class="tc">ID</th>
                            <th>名称</th>
                            <th>标题</th>
                            <th>内容</th>
                            <th>操作</th>
                        </tr>
                        @foreach($data as $v)
                            <tr>
                                <td class="tc">
                                    <input type="text" onchange="changeOrder(this,'{{$v->conf_id}}')" value="{{$v->conf_order}}">
                                </td>
                                <td class="tc" >{{$v->conf_id}}</td>
                                <td>
                                    <a href="#">{{$v->conf_name}}</a>
                                </td>
                                <td>{{$v->conf_title}}</td>
                                <td>
                                    <input type="hidden" name="conf_id[]" value="{{$v->conf_id}}" >
                                    {!! $v->_html !!}
                                </td>

                                <td>
                                    <a href="{{url('admin/conf').'/'.$v->conf_id}}">修改</a>
                                    <a href="javascript:;" onclick="delArt({{$v->conf_id}})">删除</a>
                                </td>
                            </tr>
                        @endforeach
                    </table>
                    <div class="btn_group">
                        <input type="submit" value="提交">
                        <input type="button" class="back" onclick="history.go(-1)" value="返回" >
                    </div>

                </form>


            </div>
        </div>

    <!--搜索结果页面 列表 结束-->

    <style>
        .result_content ul li span {
            font-size: 15px;
            padding: 6px 12px;
            text-decoration: none;
        }
    </style>
    <script>
        function changeOrder(obj,conf_id) {
            var conf_order= $(obj).val();
            $.post('{{url('admin/conf/changeorder')}}',{'_token':'{{csrf_token()}}',conf_id:conf_id,conf_order:conf_order},function (data) {
                if(data.status==0){
                    layer.alert(data.msg, {icon: 6});
                }
            });
        }
        function delArt(conf_id) {
            //询问框
            layer.confirm('你确定要删除这个配置吗', {
                btn: ['确定','取消'] //按钮
            }, function(){
                $.post("{{url('admin/conf')}}"+'/'+conf_id,{'_method':'delete','_token':'{{csrf_token()}}',conf_id:conf_id},function (data) {
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
