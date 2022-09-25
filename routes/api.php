<?php

use App\Http\Controllers\API\CrudApiController;
use App\Http\Controllers\API\ProductController;
use App\Http\Controllers\API\TransactionController;
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
    Route::post('addProduct',[ProductController::class,'add']);
    Route::post('updateProduct',[ProductController::class,'update']);
    Route::delete('deleteProduct',[ProductController::class,'delete']);
    Route::get('product',[ProductController::class,'all']);

    Route::post('transaction',[TransactionController::class, 'transaction']);
    Route::get('transaction',[TransactionController::class, 'all']);
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
