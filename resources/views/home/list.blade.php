@extends('layouts.home')
@section('info')
    <title>{{$field->cate_name}}-{{config('web.web_title')}}</title>
    <meta name="keywords" content="{{$field->cate_keywords}}" />
    <meta name="description" content="{{$field->cate_description}}" />
@endsection
@section('content')
    <article class="blogs">
        <h1 class="t_nav"><span>{{$field->cate_title}}</span><a href="{{url('/')}}" class="n1">网站首页</a><a href="{{url('cate').'/'.$field->cate_id}}" class="n2">{{$field->cate_name}}</a></h1>
        <div class="newblog left">
            @foreach($data as $d)
            <h2>{{$d->art_title}}</h2>
            <p class="dateview"><span>发布时间：{{date('Y-m-n',$d->art_time)}}</span><span>作者：{{$d->art_author}}</span><span>分类：[<a href="{{url('cate').'/'.$field->cate_id}}">{{$field->cate_name}}</a>]</span></p>
            <figure><img src="{{url($d->art_thumb)}}"></figure>
            <ul class="nlist">
                <p>{{$d->art_intro}}</p>
                <a title="/" href="{{url('a'.'/'.$d->art_id)}}" target="_blank" class="readmore">阅读全文>></a>
            </ul>
            @endforeach


            <div class="page">
                    {{$data->links()}}

            </div>
        </div>
        <aside class="right">
            @if($cate->all())
            <div class="rnav">
                <ul>
                    @foreach($cate as $c)
                    <li class="rnav{{$c->cate_id-40}}"><a href="{{url('cate'.'/'.$c->cate_id)}}" target="_blank">{{$c->cate_name}}</a></li>
                    @endforeach
                </ul>
            </div>
            @endif
           @parent
        </aside>
    </article>
@endsection
