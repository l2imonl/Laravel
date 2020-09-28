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


Route::group(['middleware' => 'myTokenCheck'], function () {

    //Admin routes
    Route::group(['middleware' => 'apiRole:admin'], function () {
        Route::delete('/comment/delete', [CommentAPIController::class, 'destroy'])->name('api.comment.destroy');
        Route::delete('/user/delete', [UserAPIController::class, 'destroy'])->name('api.user.delete');
    });

    //Mod routes
    Route::group(['middleware' => 'apiRole:moderator'], function () {

        Route::get('/posts', [PostAPIController::class, 'index'])->name('api.post.index');
        Route::get('/post/{id}', [PostAPIController::class, 'show'])->name('api.post.show');
        Route::post('/post/updatepost/{id}', [PostAPIController::class, 'update'])->name('api.post.update');
        Route::delete('/post/delete', [PostAPIController::class, 'destroy'])->name('api.post.delete');

        Route::get('/comments', [CommentAPIController::class, 'index'])->name('api.comment.index');

        Route::get('/users', [UserAPIController::class, 'index'])->name('api.user.index');
        Route::get('/user/{id}', [UserAPIController::class, 'show'])->name('api.user.show');
        Route::post('/user/update/{id}', [UserAPIController::class, 'update'])->name('api.user.update');
        Route::post('/user/updaterole/{id}', [UserAPIController::class, 'updateRole'])->name('api.user.updaterole');

    });

    Route::group(['middleware' => 'apiRole:creator'], function () {

        Route::post('/post/store', [PostAPIController::class, 'store'])->name('api.post.store');

    });

});

//public routes
Route::post('/login', [UserAPIController::class, 'login'])->name('api.user.login');
Route::get('/blog', [BlogAPIController::class, 'index'])->name('api.blog.index');
Route::get('/blog/single/{id}', [BlogAPIController::class, 'show'])->name('api.blog.show');
