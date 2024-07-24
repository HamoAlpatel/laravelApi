<?php

use App\Http\Controllers\ProductController;
use App\Http\Controllers\ReviewController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::apiResource('/product', ProductController::class);

// rev
Route::group(['prefix'=>'products'],function(){
Route::apiResource('/{product}/revies',ReviewController::class);
});