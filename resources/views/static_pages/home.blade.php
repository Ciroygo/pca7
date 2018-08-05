@extends('layouts.default')


@section('title', "主页")
@section('content')
    <div class="jumbotron">
        <h1>Hello, world!</h1>
        <p class="lead">刻意练习，每日精进。真理惟一可靠的标准就是永远自相符合。 —— 欧文 <a href="#">了解一下</a></p>
        <p>
          从这里开始
        </p>
        <p><a class="btn btn-success btn-lg" href="{{ route('signup') }}" role="button">现在注册</a></p>
    </div>
@stop