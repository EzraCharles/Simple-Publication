<?php

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
use Illuminate\Database\Eloquent\Builder;

Route::get('/desafio3', function () {

    /* $publications = \App\Publication::with(['comments'=> function ($query) {
        $query->where([
            ['content', 'like', '%Hola%'],
            ['status', '=', 'APROBADO'],
        ]);
    }])->get(); */

    /* $publications = App\Publication::whereHas('comments', function (Builder $query) {
        $query->where([
            ['content', 'like', '%Hola%'],
            ['status', '=', 'APROBADO'],
        ]);
    })->get(); */

    $publications = App\Publication::with(['comments'=> function ($query) {
        $query->where([
            ['content', 'like', '%Hola%'],
            ['status', '=', 'APROBADO'],
        ]);
    }])->whereHas('comments', function (Builder $query) {
        $query->where([
            ['content', 'like', '%Hola%'],
            ['status', '=', 'APROBADO'],
        ]);
    })->get();

    dd($publications->toArray());
})->middleware('auth');


Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/users/{id}', 'HomeController@userPublications');

Route::resource('publications', 'PublicationController');
Route::resource('comments', 'CommentController');

Route::get('/', function () {
    return view('welcome');
});

