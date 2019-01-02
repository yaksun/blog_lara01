<?php

namespace App\Http\Controllers\Admin;

use App\Http\Model\Navs;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;

class NavsController extends CommonController
{

    //获取全部导航
    // GET| admin/navs
    public function index()
    {
        $data=Navs::OrderBy('nav_id','desc')->get();
        return view('admin.navs.index',compact('data'));
    }
    //新建链接
    //GET| admin/navs/create
    public function create()
    {

        return view('admin.navs.add');
    }

    //添加链接提交
    // | POST| admin/navs
    public function store()
    {
        $input=Input::except('_token');
        $rule=[
            'nav_name'=>'required',

        ];
        $msg=[
            'nav_title.required'=>'链接名称不能为空',

        ];

        $validator=Validator::make($input,$rule,$msg);
        if($validator->passes()){

            $res=Navs::create($input);
            if($res){
                return redirect('admin/navs')->with('errors','链接添加成功');
            }else{
                return back()->with('errors','链接添加失败');
            }
        }else{
            return back()->withErrors($validator);
        }
    }

    //展示单个链接
    //GET| admin/navs/{navs}
    public function show($nav_id)
    {

        $field=Navs::find($nav_id);
        return view('admin.navs.edit',compact('field'));
    }

    //更新单个链接
    //PUT| admin/navs/{navs}
    public function update($nav_id)
    {
        $input=Input::except('_token','_method');
        $res=Navs::where('nav_id',$nav_id)->update($input);
        if($res){
            return redirect('admin/navs');
        }else{
            return back()->with('errors','链接修改失败');
        }
    }

    //删除单篇链接
    // DELETE  admin/navs/{navs}
    public function destroy($nav_id)
    {
        $res=Navs::where('nav_id',$nav_id)->delete();
        if($res){
            $data=[
                'status'=>0,
                'msg'=>'链接删除成功'
            ];
        }else{
            $data=[
                'status'=>1,
                'msg'=>'链接删除失败'
            ];
        }

        return $data;
    }

    public function changeOrder()
    {
        $input=Input::all();
        $navs=Navs::find($input['nav_id']);
        $navs->Nav_order=$input['nav_order'];

        $res=$navs->update();

        if($res){
            $data=[
                'status'=>0,
                'msg'=>'导航排序修改成功'
            ];
        }else{
            $data=[
                'status'=>1,
                'msg'=>'导航排序修改失败'
            ];
        }

        return $data;
    }

}
