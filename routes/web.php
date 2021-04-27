<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostsController;

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

Route::get('/', function () {
    return view('welcome');
});
Route::get("/posts",[PostsController::class,"index"])->name('posts');
Route::get("/posts/create",[PostsController::class,"create"]);
Route::post("/posts/store",[PostsController::class,"store"])->name('posts.store');
Route::post("/posts/{post}/delete",[PostsController::class,"destroy"])->name('posts.delete');
Route::get("/posts/{post}/edit",[PostsController::class,"edit"])->name('posts.edit');

Route::post("/posts/{post}/update",[PostsController::class,"update"])->name('posts.update');