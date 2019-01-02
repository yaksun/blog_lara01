<!doctype html>
<html>
<head>
    <meta charset="utf-8">
{{--@yield('info')--}}
@section('info')
    {{--yaksun--}}
@show
    <link href="{{asset('resources/views/home/css/base.css')}}" rel="stylesheet">
    <link href="{{asset('resources/views/home/css/index.css')}}" rel="stylesheet">
    <link href="{{asset('resources/views/home/css/style.css')}}" rel="stylesheet">
    <link href="{{asset('resources/views/home/css/new.css')}}" rel="stylesheet">

    <!--[if lt IE 9]>
    <script src="{{asset('resources/views/home/js/modernizr.js')}}"></script>
    <![endif]-->
</head>
<body>
<header>
    <div id="logo"><a href="/"></a></div>
    <nav class="topnav" id="topnav">
        @foreach($navs as $v)
        <a href="{{url($v->nav_url)}}"><span>{{$v->nav_name}}</span><span class="en">{{$v->nav_alias}}</span></a>
        @endforeach
    </nav>

</header>
@section('content')
    <!-- Baidu Button BEGIN -->
    <div id="bdshare" class="bdshare_t bds_tools_32 get-codes-bdshare"><a class="bds_tsina"></a><a class="bds_qzone"></a><a class="bds_tqq"></a><a class="bds_renren"></a><span class="bds_more"></span><a class="shareCount"></a></div>
    <script type="text/javascript" id="bdshare_js" data="type=tools&amp;uid=6574585" ></script>
    <script type="text/javascript" id="bdshell_js"></script>
    <script type="text/javascript">
        document.getElementById("bdshell_js").src = "http://bdimg.share.baidu.com/static/js/shell_v2.js?cdnversion=" + Math.ceil(new Date()/3600000)
    </script>
    <!-- Baidu Button END -->
    <div class="news" style="float: left">
        <h3>
            <p>最新<span>文章</span></p>
        </h3>
        <ul class="rank">
            @foreach($art as $a)
                <li><a href="{{url('a').'/'.$a->art_id}}" title="{{$a->art_title}}" target="_blank">{{$a->art_title}}</a></li>
            @endforeach
        </ul>
        <h3 class="ph">
            <p>点击<span>排行</span></p>
        </h3>
        <ul class="paih">
            @foreach($min as $m)
                <li><a href="{{url('a').'/'.$m->art_id}}" title="{{$m->art_title}}" target="_blank">{{$m->art_title}}</a></li>
            @endforeach
        </ul>
        <h3 class="links">
            <p>友情<span>链接</span></p>
        </h3>
        <ul class="website">
            @foreach($link as $l)
                <li><a href="{{$l->link_url}}">{{$l->link_name}}</a></li>
            @endforeach
        </ul>
    </div>
  @show
<footer>
    <p>{!! config('web.coprright') !!} <a href="/">{!! config('web.web_count') !!}</a></p>
</footer>
<script src="{{asset('resources/views/home/js/modernizr.js')}}"></script>
</body>
</html>
