<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\GalleryController;
use App\Http\Controllers\Admin\CustomAuthController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/admin', function(){
    echo 'admin';
})->middleware('auth');

Route::prefix('admin')->name('admin.')->group(function(){
    Route::get('/login', [CustomAuthController::class, 'index'])->name('login');
    Route::post('/login', [CustomAuthController::class, 'authenticate'])->name('login.authenticate');

    Route::middleware('auth')->group(function(){
        Route::get('/gallery', [GalleryController::class, 'index'])->name('gallery');
    });
});
