<?php

namespace App\Http\Controllers\Admin;
require_once '/resources/org/code/Code.class.php';
use App\Http\Model\User;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Admin\CommonController;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;


class LoginController extends CommonController
{
   public function login(){
        //$pdo = DB::connection()->getPdo();
       //$data=DB::table('user')->get();

       //$data=DB::table('user')->where('user_id','>',1)->get();

        if($input=Input::all()){

           $code=new \Code;
           $_code=$code->get();

           if(strtoupper($input['code'])==strtoupper($_code)){
               $user=User::first();
                //dd($user);

                if($input['username']!=$user->username || md5($input['password'])!=$user->password ){
                    return back()->with('msg','用户名或密码错误');
                }else{
                    return redirect('admin/index');
                }
           }else{
               return back()->with('msg','验证码错误');
           }
       }else{
            //载入登录界面
            return view('admin.login');
        }



   }

    public function getCode()
    {
        $code=new \Code;
        echo $code->make();
   }

  /*  public function test()
    {
        $b=User::insertGetId(
            array('username' => 'yaksun', 'password' => md5('123456'))
        );
        if($b){
            echo 'ok';
        }else{
            echo 'fial';
        }
   }*/

   /* public function test()
    {
        $code=new \Code;
       echo  $code->get();
  }*/
}
