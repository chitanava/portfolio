<?php

use App\Http\Controllers\Admin\CustomAuthController;
use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
});

Route::prefix('admin')->name('admin.')->group(function(){
    Route::get('/login', [CustomAuthController::class, 'index'])->name('login');
    Route::post('/login', [CustomAuthController::class, 'authenticate'])->name('login.authenticate');

    Route::get('/dashboard', function(){
        echo 'dashboard';
    })->name('dashboard')->middleware('auth');
});
