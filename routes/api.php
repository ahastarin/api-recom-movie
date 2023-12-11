<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\MovieController;
use App\Http\Controllers\AuthenticationController;

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

Route::post('/login', [AuthenticationController::class, 'login']);
Route::get('/logout', [AuthenticationController::class, 'logout'])->middleware('auth:sanctum');

Route::get('/movie', [MovieController::class, 'index'])->middleware("auth:sanctum");
Route::get('/movie/{search}', [MovieController::class, 'search'])->middleware("auth:sanctum");
Route::get('/movie/detail/{id}', [MovieController::class, 'detail'])->middleware("auth:sanctum");
Route::get('/movie/image/{id}', [MovieController::class, 'image'])->middleware("auth:sanctum");
Route::get('/genre', [MovieController::class, 'genre'])->middleware("auth:sanctum");