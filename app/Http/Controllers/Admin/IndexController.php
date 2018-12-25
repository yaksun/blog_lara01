<?php

namespace App\Http\Controllers\Admin;

use App\Http\Model\User;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;

class IndexController extends CommonController
{
    public function index()
    {
        //dd(session('user'));
        return view('admin.index');
    }

    public function info()
    {
       /* echo '<pre>';
        print_r($_SERVER);
        echo '</pre>';*/
        return view('admin.info');
    }
    //退出方法
    public function quit()
    {
        session(['user'=>null]);
        //dd(session('user'));
        return redirect('admin/login');

    }
    //修改后台密码方法
    public function pass()
    {
             if($input=Input::all()){
                 //dd($input);
                 $rule=[
                     'password'=>'required|between:6,20|confirmed',
                 ];

                 $msg=[
                     'password.required'=>'新密码不能为空',
                     'password.between'=>'新密码必须在6到20位',
                     'password.confirmed'=>'确认密码必须和新密码一致',
                 ];

                 $validator= Validator::make($input,$rule,$msg);

                 //如果验证通过
                 if($validator->passes()){
                     $user=User::first();
                     if(md5($input['password_o'])==$user->password){
                         $user->password=md5($input['password']);
                         $user->update();
                         return back()->with('errors','密码修改成功');

                     }else{
                         return back()->with('errors','原密码不正确');
                     }

                 }else{
                     //dd($validator->errors());
                     return back()->withErrors($validator);
                 }



             }

            return view('admin/pass');
    }
}
