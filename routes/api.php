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

Route::middleware(['auth:sanctum'])->group(function(){
    Route::get('dataUser' ,[CrudApiController::class, 'all']);
    Route::post('logout' ,[CrudApiController::class, 'logout']);
});

// Route::group(['middleware',['auth:sanctum']],function(){
//     Route::get('dataUser' ,[CrudApiController::class, 'all']);
// });

Route::post('register' ,[CrudApiController::class, 'register']);
Route::get('a' ,function(){
    return response()->json(['status' => 200,'msg'=>'ada']);
});
Route::get('dataUser2' ,[CrudApiController::class, 'all']);
Route::post('login' ,[CrudApiController::class, 'login']);
