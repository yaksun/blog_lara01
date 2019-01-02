<?php

namespace App\Http\Controllers\Home;

use App\Http\Model\Article;
use App\Http\Model\Category;
use App\Http\Model\Links;
use App\Http\Model\Navs;
use Illuminate\Http\Request;

use App\Http\Requests;


class IndexController extends CommonController
{
    public function index()
    {
        //点击量最高的6篇文章
        $hot=Article::orderBy('art_view','desc')->take(6)->get();


        //最新发布的5篇文章
        $new=Article::orderBy('art_time','desc')->paginate(5);


        return view('home.index',compact('hot','new'));
    }

    public function cate($cate_id)
    {
        $data=Article::where('cate_id',$cate_id)->paginate(4);
        $field=Category::find($cate_id);

        $cate=Category::where('cate_pid',$cate_id)->get();

        return view('home.list',compact('data','field','cate'));
    }

    public function article($art_id)
    {
       /* $article=Article::find($art_id);
        $category=Category::find($article->cate_id);*/
       $field=Article::join('category','article.cate_id','=','category.cate_id')->where('art_id',$art_id)->first();


        //静默处理自增访问次数
        Article::where('art_id',$art_id)->increment('art_view');

        $data=Article::where('cate_id',$field->cate_id)->get();


        $article['pre']=Article::where('art_id','<',$art_id)->orderBy('art_id','desc')->first();
        $article['next']=Article::where('art_id','>',$art_id)->orderBy('art_id','asc')->first();


        return view('home.new',compact('field','article','data'));
    }
}
