@extends('layout')
<?php
// タイムゾーンを設定
date_default_timezone_set('Asia/Tokyo');

// 前月・次月リンクが押された場合は、GETパラメーターから年月を取得
if (isset($_GET['ymd'])) {
    $ym = $_GET['ymd'];
} else {
    // 今月の年月を表示
    $ym = date('Y-m-d');
}

// タイムスタンプを作成し、フォーマットをチェックする
$timestamp = strtotime($ym . '-01');
if ($timestamp === false) {
    $ym = date('Y-m');
    $timestamp = strtotime($ym . '-01');
}

// 今日の日付 フォーマット　例）2018-07-3
$today = date('Y-m-j');

// カレンダーのタイトルを作成　例）2017年7月
$html_title = date('Y年n月', $timestamp);

// 前月・次月の年月を取得
// 方法１：mktimeを使う mktime(hour,minute,second,month,day,year)
$prev = date('Y-m', mktime(0, 0, 0, date('m', $timestamp)-1, 1, date('Y', $timestamp)));
$next = date('Y-m', mktime(0, 0, 0, date('m', $timestamp)+1, 1, date('Y', $timestamp)));

// 方法２：strtotimeを使う
// $prev = date('Y-m', strtotime('-1 month', $timestamp));
// $next = date('Y-m', strtotime('+1 month', $timestamp));

// 該当月の日数を取得
$day_count = date('t', $timestamp);

// １日が何曜日か　0:日 1:月 2:火 ... 6:土
// 方法１：mktimeを使う
$youbi = date('w', mktime(0, 0, 0, date('m', $timestamp), 1, date('Y', $timestamp)));
// 方法２
// $youbi = date('w', $timestamp);
$reaction='not';
if($increased){
        $reaction='やったね!';
}
else{
        $reaction='今日はすでに記録済みです';
}


?>
@section('content')
<h1>{{$article->content}} now continueing...</h1>
        
        <div class='now-continue'>
        <p class='res'></p>
        <h1 class='done-result'>{{$article->count}}</h1>
        <h2 class='done-days'>日</h2>
        </div>
        <h1>in {{$article->revial_count}} th season</h1>
        <h2>{{$article->updated_at}} lasted edited</h2>
        
        <h3>{{$reaction}}</h3>
        
        <p class="move">
        <a href={{ route('article.list') }} class='btn btn-outline-primary'>一覧に戻る</a>
        <a href={{ route('article.edit', ["id" =>  $article->id]) }} class='btn btn-outline-primary'>編集</a>
        <a href={{ route('article.cancel', ["id" =>  $article->id]) }} class='btn btn-outline-primary'>取り消し</a>
        <a href={{ route('article.done', ["id" =>  $article->id]) }} class='btn btn-outline-primary'>記録</a>
        </p>

@endsection