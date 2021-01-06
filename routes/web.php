<?php

use App\Http\Controllers\CommentController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MovieController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\SourceController;
use App\Http\Controllers\UserController;
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
Route::view('/', 'home');

Route::inertia('/not-available', 'Error/NotAvailable')->name('503');

Route::group(['middleware' => ['auth']], function () {
    Route::get('/dashboard', [HomeController::class, 'homePage'])->name('dashboard');

    Route::get('/read/{post:slug}', [HomeController::class, 'readPost'])->name('post.read');

    Route::group(['prefix' => 'comment'], function () {
        Route::post('/store', [CommentController::class, 'store'])->name('comment.store');
    });

    Route::group(['prefix' => 'movie'], function () {
        Route::get('/', [HomeController::class, 'moviePage'])->name('movie.index');
        Route::get('/watch/{movie:slug}', [HomeController::class, 'watchMovie'])->name('movie.watch');
    });
});

Route::group(['prefix' => 'admin', 'middleware' => ['auth','can:access admin dashboard'], 'as' => 'admin.'], function () {
    Route::get('/', [AdminController::class, 'dashboard'])->name('dashboard');
    Route::group(['prefix' => 'user', 'as' => 'user.', 'middleware' => 'can:access admin users'], function () {
        Route::get('/', [UserController::class, 'index'])->name('index');
        Route::get('/create', [UserController::class, 'create'])->name('create')->middleware('can:create users');
        Route::post('/create', [UserController::class, 'store'])->name('store')->middleware('can:create users');
        Route::delete('/{user}', [UserController::class, 'destroy'])->name('delete')->middleware('can:delete users');
        Route::get('/{user}/edit', [UserController::class, 'edit'])->name('edit')->middleware('can:update users');
        Route::post('/{user}/edit', [UserController::class, 'update'])->name('update')->middleware('can:update users');
    });
    Route::group(['prefix' => 'post', 'as' => 'post.', 'middleware' => 'can:access admin post'], function () {
        Route::get('/', [PostController::class, 'index'])->name('index');
        Route::get('/create', [PostController::class, 'create'])->name('create')->middleware('can:create post');
        Route::post('/create', [PostController::class, 'store'])->name('store')->middleware('can:create post');
        Route::delete('/{post}', [PostController::class, 'destroy'])->name('delete')->middleware('can:delete post');
        Route::get('/{post}/edit', [PostController::class, 'edit'])->name('edit')->middleware('can:update post');
        Route::post('/{post}/edit', [PostController::class, 'update'])->name('update')->middleware('can:update post');
    });
    Route::group(['prefix' => 'category', 'as' => 'category.', 'middleware' => 'can:access admin category'], function () {
        Route::get('/', [CategoryController::class, 'index'])->name('index');
        Route::get('/create', [CategoryController::class, 'create'])->name('create')->middleware('can:create category');
        Route::post('/create', [CategoryController::class, 'store'])->name('store')->middleware('can:create category');
        Route::delete('/{category}', [CategoryController::class, 'destroy'])->name('delete')->middleware('can:delete category');
        Route::get('/{category}/edit', [CategoryController::class, 'edit'])->name('edit')->middleware('can:update category');
        Route::post('/{category}/edit', [CategoryController::class, 'update'])->name('update')->middleware('can:update category');
    });
    Route::group(['prefix' => 'role', 'as' => 'role.', 'middleware' => 'can:access admin role'], function () {
        Route::get('/', [RoleController::class, 'index'])->name('index');
        Route::get('/create', [RoleController::class, 'create'])->name('create')->middleware('can:create role');
        Route::post('/create', [RoleController::class, 'store'])->name('store')->middleware('can:create role');
        Route::delete('/{role}', [RoleController::class, 'destroy'])->name('delete')->middleware('can:delete role');
        Route::get('/{role}/edit', [RoleController::class, 'edit'])->name('edit')->middleware('can:update role');
        Route::post('/{role}/edit', [RoleController::class, 'update'])->name('update')->middleware('can:update role');
    });
    Route::group(['prefix' => 'movie', 'as' => 'movie.', 'middleware' => 'can:access admin movie'], function () {
        Route::get('/', [MovieController::class, 'index'])->name('index');
        Route::get('/import', [MovieController::class, 'import'])->name('import')->middleware('can:import movie');
        Route::get('/import/{tmdb}', [MovieController::class, 'importDetails'])->name('import.details')->middleware('can:import movie');
        Route::post('/import/{tmdb}', [MovieController::class, 'storeImportedDetails'])->name('import.store')->middleware('can:import movie');
        Route::get('/create', [MovieController::class, 'create'])->name('create')->middleware('can:create movie');
        Route::post('/create', [MovieController::class, 'store'])->name('store')->middleware('can:create movie');
        Route::get('/{movie}', [MovieController::class, 'show'])->name('show')->middleware('can:show movie');
        Route::delete('/{movie}', [MovieController::class, 'destroy'])->name('delete')->middleware('can:delete movie');
        Route::get('/{movie}/edit', [MovieController::class, 'edit'])->name('edit')->middleware('can:update movie');
        Route::post('/{movie}/edit', [MovieController::class, 'update'])->name('update')->middleware('can:update movie');
        Route::post('/{movie}/source/store', [SourceController::class, 'store'])->name('source.store')->middleware('can:update movie');
    });
});

