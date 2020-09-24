<?php

use App\Http\Controllers\API\BlogAPIController;
use App\Http\Controllers\API\CommentAPIController;
use App\Http\Controllers\API\PostAPIController;
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


Route::get('/blog', [BlogAPIController::class, 'index'])->name('api.blog.index');
Route::get('/blog/single/{id}', [BlogAPIController::class, 'show'])->name('api.blog.show');

Route::get('/comments', [CommentAPIController::class, 'index'])->name('api.comment.index');

Route::post('/post/store', [PostAPIController::class, 'store'])->name('api.post.store');

Route::group(['middleware' => 'auth:sanctum'], function () {

    Route::group(['middleware' => 'role:admin'], function () {
        Route::get('/userlist', [UserAPIController::class, 'index'])->name('api.user.index');
        Route::get('/user/show/{id}', [UserAPIController::class, 'show'])->name('api.user.show');
    });

});

Route::post('/login', [UserAPIController::class, 'login'])->name('api.user.login');
