<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\GalleryController;
use Illuminate\Contracts\Database\Eloquent\Builder;
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
    echo 'admin';
})->middleware('auth');

Route::prefix('admin')->name('admin.')->group(function(){
    Route::get('/login', [CustomAuthController::class, 'index'])->name('login');
    Route::post('/login', [CustomAuthController::class, 'authenticate'])->name('login.authenticate');

    Route::middleware('auth')->group(function(){
        Route::get('/gallery', [GalleryController::class, 'index'])->name('gallery');
    });
});
