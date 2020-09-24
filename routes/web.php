<?php

use App\Http\Controllers\BlogController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\RoleController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [BlogController::class, 'index']);

Route::group(['middleware' => 'auth'], function () {

    //Admin routes
    Route::group(['middleware' => 'role:admin'], function () {

        Route::delete('/blog/single/comment/delete/{id}', [CommentController::class, 'destroy'])->name('comment.destroy');
        Route::delete('/user/delete/{id}', [UserController::class, 'destroy'])->name('user.delete');

    });

    //Mod routes
    Route::group(['middleware' => 'role:moderator'], function () {

        Route::get('/post/viewposts', [PostController::class, 'index'])->name('post.index');
        Route::get('/post/viewpost/{id}', [PostController::class, 'show'])->name('post.show');
        Route::get('/post/editpost/{id}', [PostController::class, 'edit'])->name('post.edit');
        Route::post('/post/updatepost/{id}', [PostController::class, 'update'])->name('post.update');
        Route::delete('/post/delete/{id}', [PostController::class, 'destroy'])->name('post.delete');

        Route::get('/user/userlist', [UserController::class, 'index'])->name('user.index');
        Route::get('/user/edit/{id}', [UserController::class, 'edit'])->name('user.edit');
        Route::post('/user/update/{id}', [UserController::class, 'update'])->name('user.update');

        Route::post('/userlist/update/{id}', [RoleController::class, 'update'])->name('role.update');

    });

    //Creator routes
    Route::group(['middleware' => 'role:creator'], function () {
        Route::get('/post/createpost', [PostController::class, 'create'])->name('post.create');
        Route::post('/post/createpost', [PostController::class, 'store'])->name('post.store');
    });

    //User routes
    Route::group(['middleware' => 'role:user'], function () {

    });

});

//Public routes
Route::get('/blog', [BlogController::class, 'index'])->name('blog.index');
Route::get('/blog/single/{id}', [BlogController::class, 'show'])->name('blog.show');
Route::post('/blog/single/{id}', [CommentController::class, 'store'])->name('comment.store');
Route::post('/reply/store', [CommentController::class, 'replyStore'])->name('comment.replyStore');

//auth Routes
Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', [BlogController::class, 'index'])->name('dashboard');

