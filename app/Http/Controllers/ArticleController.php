<?php

namespace App\Http\Controllers;

use App\Article;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //indexという名前のviewを呼び出す
        $message='keep doing';
        //モデルでデータベースのデータをまとめて取り出す
        $articles=Article::all();
        return view('index',['message'=>$message,'articles'=>$articles]);
    }

    public function take_rest()
    {
        return view('take_rest');
    }

    public function done(Request $request,$id ,Article $article)
    {
        $article=Article::find($id);
        $article->count=$article->count+1;
        $article->save();
        return view('done',['article'=>$article]);
    }
    public function cancel(Request $request,$id ,Article $article)
    {
        $article=Article::find($id);
        $article->count=$article->count-1;
        $article->save();
        return view('done',['article'=>$article]);
    }

    public function reset(Request $request,$id ,Article $article)
    {
        $article=Article::find($id);
        $article->count=0;
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
        $article->user_name = $request->user_name;
        $article->save();
        return redirect()->route('article.show', ['id' => $article->id]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request,$id,Article $article)
    {
        $article=Article::find($id);
        $article->delete();
        return redirect('/articles');
    }
}
