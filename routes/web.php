<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\GalleryController;
use Illuminate\Contracts\Database\Eloquent\Builder;
use App\Http\Controllers\Admin\UserController;

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

Route::get('/demo', function(){
    $gallery = App\Models\Gallery::find(1);
    $albums = $gallery->albums()->with(['images' => function(Builder $query){
        $query->orderBy('ord', 'asc');
    }])->orderBy('ord', 'asc')->get();
    $images = $gallery->images()->orderBy('ord', 'asc')->get();

    $merged = $albums->concat($images);

    dd($merged->sortBy('ord')->toArray());
});

Route::get('/demo/sort', function(){
    return view('sort');
});

Route::get('/admin', function(){
    return redirect()->route('admin.galleries');
})->middleware('auth');

Route::prefix('admin')->name('admin.')->group(function(){
    Route::get('/login', [UserController::class, 'login'])->name('login');
    Route::post('/login', [UserController::class, 'authenticate'])->name('authenticate');
    Route::get('/logout', [UserController::class, 'logout'])->name('logout');

    Route::middleware('auth')->group(function(){
        Route::get('/profile', [UserController::class, 'profile'])->name('profile');
        Route::put('/profile', [UserController::class, 'update'])->name('profile.update');
        
        Route::get('/galleries', [GalleryController::class, 'index'])->name('galleries');
    });
});
