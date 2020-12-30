@extends('layout')

@section('content')
        <h1>{{$article->content}} now continuing...</h1>
        <div class='now-continue'>
        <p class='res'></p>
        <h1 class='done-result'>{{$article->count}}</h1>
        <h2 class='done-days'>日</h2>
        
        </div>
        <h1 class='season'>in {{$article->revial_count}} th season</h1>
        <p>
                
        </p>
        
        <div>
        
        </div>
@endsection
