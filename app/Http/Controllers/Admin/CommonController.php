<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;

class CommonController extends Controller
{
    public function upload()
    {
        $file=Input::file('Filedata');
        if($file->isValid()){
          //获取文件后缀
            $suffix=$file->getClientOriginalExtension();
            //拼装新的文件名
            $fileName=time().rand(100,999).'.'.$suffix;
            //将文件移动的指定路径
            $file->move(base_path().'/uploads',$fileName);
            return $newPath='uploads/'.$fileName;
        }
    }


}
