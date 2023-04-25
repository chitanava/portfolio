<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\AlbumController;
use App\Http\Controllers\Admin\ImageController;
use App\Http\Controllers\Admin\GalleryController;
use Illuminate\Contracts\Database\Eloquent\Builder;

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
        Route::get('/galleries/create', [GalleryController::class, 'create'])->name('galleries.create');
        Route::post('/galleries', [GalleryController::class, 'store'])->name('galleries.store');
        Route::get('/galleries/{gallery}', [GalleryController::class, 'show'])->name('galleries.show');
        Route::get('/galleries/{gallery}/edit', [GalleryController::class, 'edit'])->name('galleries.edit');
        Route::put('/galleries/{gallery}', [GalleryController::class, 'update'])->name('galleries.update');
        Route::delete('/galleries/{gallery}', [GalleryController::class, 'destroy'])->name('galleries.destroy');

        Route::get('/galleries/{gallery}/albums/create', [AlbumController::class, 'create'])->name('galleries.albums.create');
        Route::post('/galleries/{gallery}/albums', [AlbumController::class, 'store'])->name('galleries.albums.store');
        Route::get('/galleries/{gallery}/albums/{album}', [AlbumController::class, 'show'])->name('galleries.albums.show');
        Route::get('/galleries/{gallery}/albums/{album}/edit', [AlbumController::class, 'edit'])->name('galleries.albums.edit');
        Route::put('/galleries/{gallery}/albums/{album}', [AlbumController::class, 'update'])->name('galleries.albums.update');
        Route::delete('/galleries/{gallery}/albums/{album}', [AlbumController::class, 'destroy'])->name('galleries.albums.destroy');

        Route::get('/galleries/{gallery}/images/create', [ImageController::class, 'create'])->name('galleries.images.create');
        Route::post('/galleries/{gallery}/images', [ImageController::class, 'store'])->name('galleries.images.store');
        Route::get('/galleries/{gallery}/images/{image}/edit', [ImageController::class, 'edit'])->name('galleries.images.edit');
        Route::put('/galleries/{gallery}/images/{image}', [ImageController::class, 'update'])->name('galleries.images.update');
        Route::delete('/galleries/{gallery}/images/{image}', [ImageController::class, 'destroy'])->name('galleries.images.destroy');
    });
});
