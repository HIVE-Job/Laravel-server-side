<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\APICategoryController;
use App\Http\Controllers\API\APIBrandController;
use App\Http\Controllers\API\APIProductController;

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


Route::apiResource('category_api', APICategoryController::class);
Route::apiResource('brand_api', APIBrandController::class);
Route::apiResource('product_api', APIProductController::class);
