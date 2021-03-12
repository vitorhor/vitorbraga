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

Auth::routes();

Route::middleware(["auth"])->group(function () {
    Route::get('/files', [App\Http\Controllers\FileController::class, 'index'])->name('files');
    Route::get('/files/add', [App\Http\Controllers\FileController::class, 'create'])->name('files.add');
    Route::post('/files/add', [App\Http\Controllers\FileController::class, 'store'])->name('files.store');
    Route::post("/files/delete", [App\Http\Controllers\FileController::class, 'delete'])->name('files.delete');
});

Route::get('/files/{code}', [App\Http\Controllers\FileController::class, 'show'])->name('files.detail');
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::post('/files/{code}', [App\Http\Controllers\FileController::class, 'download'])->name('files.download');

