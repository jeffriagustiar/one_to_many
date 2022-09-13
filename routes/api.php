<?php

use App\Http\Controllers\API\CrudApiController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('dataUser' ,[CrudApiController::class, 'all']);//->middleware('apiAdmin');
Route::post('register' ,[CrudApiController::class, 'register']);
Route::post('login' ,[CrudApiController::class, 'login']);
