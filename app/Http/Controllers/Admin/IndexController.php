<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Admin\CommonController;
use Illuminate\Support\Facades\DB;


class IndexController extends CommonController
{
   public function login(){
        //$pdo = DB::connection()->getPdo();
       //$data=DB::table('user')->get();

       $data=DB::table('user')->where('user_id','>',1)->get();
       dd($data);

   }
}
