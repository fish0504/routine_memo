@extends('layout')

@section('content')
        <h1>{{$article->content}} now continueing...</h1>
        <div class='now-continue'>
        <p class='res'></p>
        <h1 class='done-result'>{{$article->count}}</h1>
        <h2 class='done-days'>日</h2>
        
        </div>
        <h1>in {{$article->revial_count}} th season</h1>
        <p>
        <a href={{ route('article.list') }} class='btn btn-outline-primary'>一覧に戻る</a>
        <a href={{ route('article.edit', ["id" =>  $article->id]) }} class='btn btn-outline-primary'>編集</a>
        <a href={{ route('article.done', ["id" =>  $article->id]) }} class='btn btn-outline-primary'>記録</a>
        <a href={{ route('article.reset', ["id" =>  $article->id]) }} class='btn btn-outline-primary'>リセット</a>
        </p>

        <div>
        
        </div>
@endsection