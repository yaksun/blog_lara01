@extends('layouts.admin')
@section('content')
    <!--面包屑导航 开始-->
    <div class="crumb_warp">
        <!--<i class="fa fa-bell"></i> 欢迎使用登陆网站后台，建站的首选工具。-->
        <i class="fa fa-home"></i> <a href="{{url('admin/info')}}">首页</a> &raquo; 配置管理
    </div>
    <!--面包屑导航 结束-->

    <!--结果集标题与导航组件 开始-->
    <div class="result_wrap">
        <div class="result_title">
            <h3>修改配置</h3>
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
        <div class="result_content">
            <div class="short_wrap">
                <a href="{{url('admin/conf/create')}}"><i class="fa fa-plus"></i>新增配置</a>
                <a href="{{url('admin/conf')}}"><i class="fa fa-recycle"></i>配置列表</a>
            </div>
        </div>
    </div>
    <!--结果集标题与导航组件 结束-->

    <div class="result_wrap">
        <form action="{{url('admin/conf').'/'.$field->conf_id}}" method="post">
            <input type="hidden" name="_method" value="put">
            {{csrf_field()}}
            <table class="add_tab">
                <tbody>

                <tr>
                    <th><i class="require">*</i>名称:</th>
                    <td>
                        <input type="text" name="conf_name" value="{{$field->conf_name}}"><span>配置名称必须填写</span>
                    </td>
                </tr>
                <tr>
                    <th><i class="require">*</i>标题:</th>
                    <td>
                        <input type="text" name="conf_title"  value="{{$field->conf_title}}"><span>配置标题必须填写</span>
                    </td>
                </tr>
              {{--  <tr>
                    <th>内容:</th>
                    <td>
                        <input type="text" name="conf_content" class="lg"  value="{{$field->conf_content}}">
                    </td>
                </tr>--}}
                <tr>
                    <th>字段类型:</th>
                    <td>
                        <input type="radio" name="field_type"  value="input" @if($field->field_type=='input') checked @endif onclick="showTr()" >input&nbsp;&nbsp;
                        <input type="radio" name="field_type" value="textarea" @if($field->field_type=='textarea') checked @endif onclick="showTr()" >textarea&nbsp;&nbsp;
                        <input type="radio" name="field_type" value="radio" @if($field->field_type=='radio') checked @endif onclick="showTr()" >radio
                    </td>
                </tr>
                <tr class="field_value">
                    <th>字段值:</th>
                    <td>
                        <input type="text" name="field_value" class="lg" value="{{$field->field_value}}" >
                        <p>格式只能是:0|开启,1|关闭</p>
                    </td>
                </tr>

                <tr>
                    <th>说明：</th>
                    <td>
                        <textarea name="conf_tips" id="" cols="30" rows="10"> {{$field->conf_tips}}</textarea>
                    </td> 
                </tr>
                <tr>
                    <th>排序：</th>
                    <td>
                        <input type="text" class="sm" name="conf_order"  value="{{$field->conf_order}}">
                    </td>
                </tr>

                <tr>
                    <th></th>
                    <td>
                        <input type="submit" value="提交">
                        <input type="button" class="back" onclick="history.go(-1)" value="返回">
                    </td>
                </tr>
                </tbody>
            </table>
        </form>
    </div>
    <script>
        showTr();
        function showTr(){
            var type=$('input[name=field_type]:checked').val();
             if(type=='radio'){
                 $('.field_value').show();
             }else{
                 $('.field_value').hide();
             }
        }
    </script>
@endsection

