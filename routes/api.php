<?php

use App\Http\Controllers\API\BlogAPIController;
use App\Http\Controllers\API\UserAPIController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Resources\User as UserResource;
use App\Http\Resources\UserCollection;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/userlist', [UserAPIController::class, 'index'])->name('api.user.index');
Route::get('/user/show/{id}', [UserAPIController::class, 'show'])->name('api.user.show');

Route::get('/blog', [BlogAPIController::class, 'index'])->name('api.blog.index');
Route::get('/blog/single/{id}', [BlogAPIController::class, 'show'])->name('api.blog.show');
