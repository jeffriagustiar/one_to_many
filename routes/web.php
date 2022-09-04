<?php

use App\Http\Controllers\UserController;
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
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::group(['middleware' => ['admin']], function () {
    Route::get('/test', function (){ return "a";} );
    Route::get('/crud',function () {
        return view('pages.data');
    })->name('crud');
    Route::get('/getdata','UserController@index');
    Route::DELETE('/deletedata/{id}','UserController@destroy');
    Route::POST('/adddata','UserController@store');
});
