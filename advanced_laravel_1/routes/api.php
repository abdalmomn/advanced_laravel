<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\RegisterController;
use App\Http\Controllers\Api\ProductController;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::controller(RegisterController::class)->group(function (){
   Route::post('/register' , 'register');
   Route::post('/login' , 'login');
});


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::resource('/products',ProductController::class)->middleware('auth:sanctum');

//Route::controller(ProductController::class)->middleware('auth:sanctum')->group(function(){
//    Route::get('/products/index' , 'index');
//    Route::post('/products/create' , 'store');
//    Route::get('/products/single_product/{id}' , 'show');
//    Route::put('/products/update/{id}' , 'update');
//    Route::delete('/products/delete/{id}' , 'destroy');
//
//});
