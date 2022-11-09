<?php

use App\Http\Controllers\Api\LoginController;
use App\Http\Controllers\Api\V1\PostController;
use App\Http\Controllers\Api\V2\PostController as V2PostController;
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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

// V1
Route::apiResource('v1/posts', PostController::class)
    ->only(['show', 'index', 'destroy']);


// V2
Route::apiResource('v2/posts', V2PostController::class)
    ->only(['show', 'index', 'destroy'])
    ->middleware('auth:sanctum');

// Route::middleware('auth:sanctum')->group(function () {
//     Route::apiResource('v1/posts', PostV1::class);
//     Route::apiResource('v2/posts', PostV2::class);
// });

Route::post('login', [LoginController::class, 'login']);
Route::post('register', [LoginController::class, 'register']);
Route::get('aws', [LoginController::class, 'aws']);

Route::delete('logout', [LoginController::class, 'logout'])
    ->middleware('auth:sanctum');