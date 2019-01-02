@extends('layouts.home')
@section('info')
  {{--@parent--}}
  <title>{{config('web.web_title')}}</title>
  <meta name="keywords" content="{{config('web.web_keywords')}}" />
  <meta name="description" content="{{config('web.web_description')}}" />
@endsection
@section('content')
  <div class="banner">
    <section class="box">
      <ul class="texts">
        <p>打了死结的青春，捆死一颗苍白绝望的灵魂。</p>
        <p>为自己掘一个坟墓来葬心，红尘一梦，不再追寻。</p>
        <p>加了锁的青春，不会再因谁而推开心门。</p>
      </ul>
      <div class="avatar"><a href="#"><span>后盾</span></a> </div>
    </section>
  </div>
  <div class="template">
    <div class="box">
      <h3>
        <p><span>个人博客</span>模板 Templates</p>
      </h3>
      <ul>
        @foreach($hot as $h)
        <li><a href="{{url('a').'/'.$h->art_id}}"  target="_blank"><img src="{{url($h->art_thumb)}}"></a><span>{{$h->art_title}}</span></li>
       @endforeach
      </ul>
    </div>
  </div>
  <article>
    <h2 class="title_tj">
      <p>文章<span>推荐</span></p>
    </h2>
    <div class="bloglist left">
      @foreach($new as $n)
      <h3>{{$n->art_title}}</h3>
      <figure><img src="{{url($n->art_thumb)}}"></figure>
      <ul>
        <p>{{$n->art_intro}}</p>
        <a title="/" href="{{url('a').'/'.$n->art_id}}" target="_blank" class="readmore">阅读全文>></a>
      </ul>
      <p class="dateview"><span>{{date('Y-m-n',$n->art_time)}}</span><span>作者：{{$n->art_author}}</span></p>
     @endforeach
        <div class="page">
          {{$new->links()}}

        </div>
    </div>
    <aside class="right">
     @parent

    </aside>
  </article>
@endsection

