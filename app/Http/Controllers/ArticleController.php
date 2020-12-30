<?php

namespace App\Http\Controllers;

use App\Article;
use DateTime;
use Facade\FlareClient\Http\Response;
use Illuminate\Http\Request;


class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getD(){
        if (isset($_GET['ym'])) {
            $ym = $_GET['ym'];
            } else {
            // 今月の年月を表示
            $ym = date('Y-m');
            }
            $timestamp = strtotime($ym . '-01');
            if ($timestamp === false) {
                $ym = date('Y-m');
                $timestamp = strtotime($ym . '-01');
            }
            
        return $ym;
    }
    public function index(Request $request)
    {
        //indexという名前のviewを呼び出す
        $message='keep doing';
        //モデルでデータベースのデータをまとめて取り出す
        $articles=Article::all();
        $url=$request->url();
        return view('index',['url'=>$url,'message'=>$message,'articles'=>$articles]);
    }

    public function take_rest()
    {
        return view('take_rest');
    }

    public function done(Request $request,$id ,Article $article)
    {
        date_default_timezone_set('Asia/Tokyo');
        if (isset($_GET['ymd'])) {
        $ym = $_GET['ymd'];
        } else {
        // 今月の年月を表示
        $ym = date('Y-m-d');
        }
        $timestamp = strtotime($ym . '-01');
        if ($timestamp === false) {
            $ym = date('Y-m');
            $timestamp = strtotime($ym . '-01');
        }
        
        $article=Article::find($id);
        
        
        //前回に記録した時との日数の差を求める
        $dateDifference = abs($timestamp- strtotime($article->updated_at));

        $years  = floor($dateDifference / (365 * 60 * 60 * 24));
        $months = floor(($dateDifference - $years * 365 * 60 * 60 * 24) / (30 * 60 * 60 * 24));
        $days   = floor(($dateDifference - $years * 365 * 60 * 60 * 24 - $months * 30 * 60 * 60 *24) / (60 * 60 * 24));
        
        $increased=true;
        //1日に一度だけ記録できるようにする
        if($years==0 && $months==0 && $days==0){
            $increased=false;
        }
        else{
            $article->count=$article->count+1;
        }
        //echo $dateDifference;
        $article->save();
    
        return view('done',['article'=>$article,'increased'=>$increased]);
    }
    public function cancel(Request $request,$id ,Article $article)
    {
        $article=Article::find($id);
        $article->count=$article->count-1;
        $article->save();
        return view('show',['article'=>$article]);
    }

    public function reset(Request $request,$id ,Article $article)
    {
        $article=Article::find($id);
        $article->count=0;
        $article->revial_count=$article->revial_count+1;
        $article->save();
        return view('done',['article'=>$article]);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        //新規メモを作成
        $message='New article';
    
        //記事一覧に戻る
        return view('new',['message'=>$message]);
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $article = new Article;

        $article->content = $request->content;
        $article->user_name = $request->user_name;
        $article->save();
        return redirect()->route('article.show',['id'=>$article->id]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request,$id ,Article $article)
    {
        $message='This is your article'. $id;
        $article=Article::find($id);
        return view('show',['message'=>$message,'article'=>$article]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request,$id,Article $article)
    {
        $message = 'Edit your article ' . $id;
        $article = Article::find($id);
        return view('edit', ['message' => $message, 'article' => $article]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id, Article $article)
    {
        $article = Article::find($id);
        $article->content = $request->content;
        $article->save();
        return redirect()->route('article.show', ['id' => $article->id]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function delete(Request $request,$id,Article $article)
    {
        $article=Article::find($id);
        $article->delete();
        $article->save();
        return redirect('/articles');
        //return redirect()->route('article.show',['id'=>$article->id]);
    }
    public function calender()//Request $request,$id,Article $article)
    {
        //$article=Article::find($id);
        return view('calender');
        //return redirect()->route('article.show',['id'=>$article->id]);
    }
}
