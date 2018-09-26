@extends('layouts.default')


@section('title', "主页")
@section('content')

    @if (Auth::check())
        <div class="row">
            <div class="col-md-7">
                <section class="status_form">
                    @include('shared._status_form')
                </section>
                <h3>微博列表</h3>
                @include('shared._feed')
            </div>
            <aside class="col-md-4">
                <section class="user_info">
                    @include('shared._user_info', ['user' => Auth::user()])
                </section>
                <section class="stats">
                    @include('shared._stats', ['user' => Auth::user()])
                </section>
            </aside>
        </div>
    @else
        <div class="jumbotron">
            <h1>Hello, world!</h1>
            <p class="lead">刻意练习，每日精进。真理惟一可靠的标准就是永远自相符合。 —— 欧文 <a href="#">了解一下</a></p>
            <p>
              从这里开始
            </p>
            <p><a class="btn btn-success btn-lg" href="{{ route('signup') }}" role="button">现在注册</a></p>
        </div>
    @endif
@stop