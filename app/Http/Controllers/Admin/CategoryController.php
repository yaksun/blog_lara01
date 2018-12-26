<?php

namespace App\Http\Controllers\Admin;

use App\Http\Model\Category;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;

class CategoryController extends CommonController
{
    //获取全部分类
    // GET| admin/category
    public function index()
    {
        /*  $category=Category::all();
          $data=$this->getTree($category,'cate_id','cate_pid','cate_name');
          return view('admin.category.index')->with('data',$data);*/

        $data=Category::tree();
        return view('admin.category.index')->with('data',$data);

    }

    public function changeOrder()
    {
      $input=Input::all();
      $category=Category::find($input['cate_id']);
      $category->cate_order=$input['cate_order'];

      $res=$category->update();

      if($res){
          $data=[
              'status'=>0,
              'msg'=>'分类排序修改成功'
          ];
      }else{
          $data=[
              'status'=>1,
              'msg'=>'分类排序修改失败'
          ];
      }

      return $data;
    }


    public function index3()
    {
      /*  $category=Category::all();
        $data=$this->getTree($category,'cate_id','cate_pid','cate_name');
        return view('admin.category.index')->with('data',$data);*/

        $data=(new Category())->tree();
        return view('admin.category.index')->with('data',$data);

    }

    public function getTree2($data,$field_id='id',$field_pid='pid',$field_name,$pid=0)
    {
        $arr=[];
        //先找出所有cate_pid为0的数据
        foreach ($data as $k=>$v)
            if($v->$field_pid==$pid){
                $data[$k]['_'.$field_name]=$data[$k][$field_name];
                $arr[]=$data[$k];
                foreach ($data as $m=>$n){
                    //如果子级的pid和父级的id相等
                    if($n->$field_pid==$v->$field_id){
                        $data[$m]['_'.$field_name]='-->'.$data[$m][$field_name];
                        $arr[]=$data[$m];

                    }

                }

            }

        return $arr;
    }



    public function getTree1($data)
    {

        $arr=[];
        //先找出所有cate_pid为0的数据
        foreach ($data as $k=>$v)
        if($v->cate_pid==0){
            $data[$k]['_cate_name']=$data[$k]['cate_name'];
            $arr[]=$data[$k];
            foreach ($data as $m=>$n){
                //如果子级的pid和父级的id相等
                if($n->cate_pid==$v->cate_id){
                    $data[$m]['_cate_name']='-->'.$data[$m]['cate_name'];
                    $arr[]=$data[$m];

                }

            }

        }

        return $arr;
    }



    //增加分类
    // | POST| admin/category
    public function store()
    {
        //把_token字段去除掉
        $input=Input::except('_token');
        $rule=[
            'cate_name'=>'required',
        ];
        $msg=[
            'cate_name.required'=>'分类名称必须填写',
        ];

        $validator=Validator::make($input,$rule,$msg);

        if($validator->passes()){
            //新增数据
            $res= Category::create($input);
            if($res){
                return redirect('admin/category');
            }else{
                return back()->with('errors','分类添加失败');
            }
        }else{
            return back()->withErrors($validator);
        }


    }


    //新建分类
    //GET| admin/category/create
    public function create()
    {
       $data=Category::where('cate_pid',0)->get();
       return view('admin.category.add',compact('data'));
    }

    //展示单个分类
    //GET| admin/category/{category}
    public function show($cate_id)
    {

        $data=Category::where('cate_pid',0)->get();
        $field=Category::find($cate_id);
        return view('admin.category.edit',compact('data','field'));
    }

    //更新单个分类
    //PUT| admin/category/{category}
    public function update($cate_id)
    {
        $input=Input::except('_method','_token');
        $res=Category::where('cate_id',$cate_id)->update($input);
        if($res){
            return redirect('admin/category');
        }else{
            return back()->with('errors','分类更新失败');
        }
    }

    //删除单个分类
    // DELETE  admin/category/{category}
    public function destroy($cate_id)
    {
        $res=Category::where('cate_id',$cate_id)->delete();
        //把所有cate_pid等于这个cate_id的cate_pid更新位0
        Category::where('cate_pid',$cate_id)->update(['cate_pid'=>0]);
        if($res){
           $data=[
               'status'=>0,
                'msg'=>'分类删除成功'
           ];
       }else{
           $data=[
               'status'=>1,
                'msg'=>'分类删除失败'
           ];
       }

       return $data;

    }



    //编辑单个分类
    //GET| admin/category/{category}/edit
    public function edit()
    {

    }
}
