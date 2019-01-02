<?php

namespace App\Http\Controllers\Home;

use App\Http\Model\Article;
use App\Http\Model\Links;
use App\Http\Model\Navs;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\View;

class CommonController extends Controller
{
    public function __construct()
    {
        $navs=Navs::orderBy('nav_id','asc')->get();


        //最新发布的8篇文章
        $art=Article::orderBy('art_time','desc')->take(8)->get();

        //点击量最高的5篇文章
        $min=Article::orderBy('art_view','desc')->take(5)->get();

        //友情链接
        $link=Links::orderBy('link_id','desc')->get();

        View::share('navs',$navs);
        View::share('art',$art);
        View::share('min',$min);
        View::share('link',$link);
    }
}
