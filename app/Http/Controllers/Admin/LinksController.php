<?php

namespace App\Http\Controllers\Admin;

use App\Http\Model\Links;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;

class LinksController extends CommonController
{

    //获取全部链接
    // GET| admin/links
    public function index()
    {
        $data=Links::OrderBy('link_id','desc')->get();
        return view('admin.links.index',compact('data'));
    }
    //新建链接
    //GET| admin/links/create
    public function create()
    {
        return view('admin.links.add');
    }

    //添加链接提交
    // | POST| admin/links
    public function store()
    {
        $input=Input::except('_token');
        $rule=[
            'link_name'=>'required',

        ];
        $msg=[
            'link_title.required'=>'链接名称不能为空',

        ];

        $validator=Validator::make($input,$rule,$msg);
        if($validator->passes()){

            $res=links::create($input);
            if($res){
                return redirect('admin/links')->with('errors','链接添加成功');
            }else{
                return back()->with('errors','链接添加失败');
            }
        }else{
            return back()->withErrors($validator);
        }
    }

    //展示单个链接
    //GET| admin/links/{links}
    public function show($link_id)
    {

        $field=Links::find($link_id);
        return view('admin.links.edit',compact('field'));
    }

    //更新单个链接
    //PUT| admin/links/{links}
    public function update($link_id)
    {
        $input=Input::except('_token','_method');
        $res=Links::where('link_id',$link_id)->update($input);
        if($res){
            return redirect('admin/links');
        }else{
            return back()->with('errors','链接修改失败');
        }
    }

    //删除单篇链接
    // DELETE  admin/links/{links}
    public function destroy($link_id)
    {
        $res=Links::where('link_id',$link_id)->delete();
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
        $links=Links::find($input['link_id']);
        $links->link_order=$input['link_order'];

        $res=$links->update();

        if($res){
            $data=[
                'status'=>0,
                'msg'=>'链接排序修改成功'
            ];
        }else{
            $data=[
                'status'=>1,
                'msg'=>'链接排序修改失败'
            ];
        }

        return $data;
    }

}
