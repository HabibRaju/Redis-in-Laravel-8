<?php

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

Route::get('/', function () {
    return view('welcome');
});

// Auth::routes();

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/all-user', [App\Http\Controllers\TestRedisController::class, 'index'])->name('index');
Route::get('/show', [App\Http\Controllers\TestRedisController::class, 'show'])->name('show');
Route::get('/save-user', [App\Http\Controllers\TestRedisController::class, 'saveUser'])->name('Save User');
Route::get('/create-user', [App\Http\Controllers\TestRedisController::class, 'create'])->name('Create');
Route::post('/store', [App\Http\Controllers\TestRedisController::class, 'store'])->name('store');

Route::get('/blogs', [App\Http\Controllers\BlogController::class, 'index'])->name('index');
Route::get('/create', [App\Http\Controllers\BlogController::class, 'create'])->name('create');
Route::post('/store', [App\Http\Controllers\BlogController::class, 'store'])->name('store');
Route::get('/blogs/{id}', [App\Http\Controllers\BlogController::class, 'show'])->name('show');
Route::get('/edit/{id}', [App\Http\Controllers\BlogController::class, 'edit'])->name('edit');
Route::post('/update/{id}', [App\Http\Controllers\BlogController::class, 'update'])->name('update');
Route::get('/delete/{id}', [App\Http\Controllers\BlogController::class, 'delete'])->name('delete');


