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

Route::get('/home', [App\Http\Controllers\LibraryController::class, 'index'])->name('home');
Route::get('/media/{library}/', [App\Http\Controllers\CollectionController::class, 'index'])->name('libraries');
Route::get('/media/{library}/{collection}/', [App\Http\Controllers\VolumeController::class, 'index'])->name('volumes');
Route::get('/media/{library}/{collection}/{volume}', [App\Http\Controllers\VolumeController::class, 'readVolume'])->name('volume');
Route::get('/media/{library}/{collection}/{volume}/uncompress', [App\Http\Controllers\VolumeController::class, 'uncompressVolume'])->name('uncompress-volume');
Route::get('/media/{library}/{collection}/{volume}/{page}', [App\Http\Controllers\VolumeController::class, 'readPage'])->name('read-page');




