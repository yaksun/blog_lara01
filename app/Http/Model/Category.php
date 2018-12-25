<?php

namespace App\Http\Model;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table='category';
    protected $primaryKey='cate_id';
    public $timestamps=false;


    public static function tree()
    {
        $category=(new Category())->orderBy('cate_order')->get();
        $data=(new Category())->getTree($category,'cate_id','cate_pid','cate_name');
        return $data;
    }


    public function tree3()
    {
        $category=$this->all();
        $data=(new Category())->getTree($category,'cate_id','cate_pid','cate_name');
        return $data;
    }



    public function getTree($data,$field_id='id',$field_pid='pid',$field_name,$pid=0)
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
}
