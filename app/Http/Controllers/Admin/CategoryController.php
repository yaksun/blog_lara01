<?php

namespace App\Http\Controllers\Admin;

use App\Http\Model\Category;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;

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



    //
    // | POST| admin/category
    public function store()
    {

    }


    //新建分类
    //GET| admin/category/create
    public function create()
    {

    }

    //更新单个分类
    //PUT| admin/category/{category}
    public function update()
    {

    }

    //删除单个分类
    // DELETE  admin/category/{category}
    public function destroy()
    {
        
    }

    //展示单个分类
    //GET| admin/category/{category}
    public function show()
    {

    }

    //编辑单个分类
    //GET| admin/category/{category}/edit
    public function edit()
    {

    }
}
