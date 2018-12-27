<?php

namespace App\Http\Controllers\Admin;

use App\Http\Model\Article;
use App\Http\Model\Category;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;

class ArticleController extends Controller
{

    //获取全部分类
    // GET| admin/article
    public function index()
    {
        $data=Article::OrderBy('art_id','desc')->paginate(4);
        return view('admin.article.index',compact('data'));
    }
    //新建文章
    //GET| admin/article/create
    public function create()
    {

        $data=Category::tree();
        return view('admin.article.add',compact('data'));
    }

    //添加文章提交
    // | POST| admin/article
    public function store()
    {
        $input=Input::except('_token');
        $rule=[
            'art_title'=>'required',
            'art_content'=>'required',
        ];
        $msg=[
            'art_title.required'=>'文章标题不能为空',
            'art_content.required'=>'文章内容不能为空',
        ];

        $validator=Validator::make($input,$rule,$msg);
        if($validator->passes()){
            $input['art_time']=time();
            $res=Article::create($input);
            if($res){
                return redirect('admin/article')->with('errors','文章添加成功');
            }else{
                return back()->with('errors','文章添加失败');
            }
        }else{
            return back()->withErrors($validator);
        }
    }

    //展示单个文章
    //GET| admin/article/{article}
    public function show($art_id)
    {
        $data=Category::tree();
        $field=Article::find($art_id);
        return view('admin.article.edit',compact('data','field'));
    }

    //更新单个文章
    //PUT| admin/article/{article}
    public function update($art_id)
    {
        $input=Input::except('_token','_method');
        $res=Article::where('art_id',$art_id)->update($input);
        if($res){
            return redirect('admin/article');
        }else{
            return back()->with('errors','文章修改失败');
        }
    }

    //删除单篇文章
    // DELETE  admin/article/{article}
    public function destroy($art_id)
    {
        $res=Article::where('art_id',$art_id)->delete();
        if($res){
            $data=[
                'status'=>0,
                'msg'=>'文章删除成功'
            ];
        }else{
            $data=[
                'status'=>1,
                'msg'=>'文章删除失败'
            ];
        }

        return $data;
    }
}
