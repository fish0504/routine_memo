@extends('layout')

@section('content')
    <h1>習慣メモ</h1>
    <p>{{ $message }}</p>
    <table class='table table-striped table-hover'>
    @foreach ($articles as $article)
        <tr>
            <td>
            <a href='{{ route("article.show", ["id" =>  $article->id]) }}'>
                {{ $article->content }}
            </a>
            </td>
            <td>{{$article->count}}</td>
            <td>{{$article->revial_count}} th</td>
            <td>{{$article->user_name}}</td>
        </tr>
    @endforeach
    </table>
    <div>
        <a href={{ route('article.new') }} class='btn btn-outline-primary'>新規投稿</a>
    </div>
    <div class="other_comments">
    <div class="row">
        <div class="col-sm-2 text-center">
        
        <img src="{{asset('/storage/asian.gif')}}" class="img-circle" height="95" width="65" alt="Avatar">
        </div>
        
        <div class="col-sm-10">
        <h4>作成者<small>Sep 29, 2015, 9:12 PM</small></h4>
        <p>ここにコメントを入力
        Keep up the GREAT work! I am cheering for you!! Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
        <br>
        </div>
    </div>
@endsection