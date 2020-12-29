<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    //return view('welcome');
    return redirect('/articles');
});
Route::get('/take_rest', 'ArticleController@take_rest')->name('article.list');


//上から順番に評価される
Route::get('/articles', 'ArticleController@index')->name('article.list');
Route::get('/article/new', 'ArticleController@create')->name('article.new');
Route::post('/article', 'ArticleController@store')->name('article.store');
//　追加　習慣の記録するdoneメソッド
Route::get('/article/done/{id}', 'ArticleController@done')->name('article.done');
//　追加　習慣の記録を取り消すdoneメソッド
Route::get('/article/cancel/{id}', 'ArticleController@cancel')->name('article.cancel');
// 追加　習慣の継続日数をリセットするresetメソッド
Route::get('/article/reset/{id}', 'ArticleController@reset')->name('article.reset');

Route::get('/article/calender', 'ArticleController@calender')->name('article.calender');
Route::get('/article/edit/{id}', 'ArticleController@edit')->name('article.edit');
Route::post('/article/update/{id}', 'ArticleController@update')->name('article.update');

Route::get('/article/{id}', 'ArticleController@show')->name('article.show');
Route::delete('/article/{id}', 'ArticleController@destroy')->name('article.delete');