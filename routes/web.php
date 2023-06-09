<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Artisan;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\AlbumController;
use App\Http\Controllers\Admin\ImageController;
use App\Http\Controllers\Admin\GalleryController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Admin\BiographyController;
use Illuminate\Contracts\Database\Eloquent\Builder;
use App\Http\Controllers\Admin\AlbumImageController;
use App\Http\Controllers\Admin\AlbumVideoController;
use App\Http\Controllers\Admin\GalleryImageController;
use App\Http\Controllers\Admin\GalleryVideoController;

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

Route::get('/symlink', function () {
    Artisan::call('storage:link');
});

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/biography', [\App\Http\Controllers\BiographyController::class, 'index'])->name('biography');
Route::get('/galleries/{gallery:slug}', [\App\Http\Controllers\GalleryController::class, 'index'])->name('gallery');
Route::get('/galleries/{gallery:slug}/albums/{album:slug}', [\App\Http\Controllers\AlbumController::class, 'index'])->name('gallery.album');

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

        Route::get('/biography', [BiographyController::class, 'edit'])->name('biography.edit');
        Route::put('/biography', [BiographyController::class, 'update'])->name('biography.update');
        Route::post('/biography/attachment-add', [BiographyController::class, 'attachmentAdd'])->name('biography.attachment.add');
        Route::post('/biography/attachment-remove', [BiographyController::class, 'attachmentRemove'])->name('biography.attachment.remove');
        
        Route::get('/settings', [SettingController::class, 'edit'])->name('settings.edit');
        Route::put('/settings', [SettingController::class, 'update'])->name('settings.update');

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

        Route::get('/galleries/{gallery}/images/create', [GalleryImageController::class, 'create'])->name('galleries.images.create');
        Route::post('/galleries/{gallery}/images', [GalleryImageController::class, 'store'])->name('galleries.images.store');
        Route::get('/galleries/{gallery}/images/{video}/edit', [GalleryImageController::class, 'edit'])->name('galleries.images.edit');
        Route::put('/galleries/{gallery}/images/{image}', [GalleryImageController::class, 'update'])->name('galleries.images.update');
        Route::delete('/galleries/{gallery}/images/{image}', [GalleryImageController::class, 'destroy'])->name('galleries.images.destroy');
        
        Route::get('/galleries/{gallery}/videos/create', [GalleryVideoController::class, 'create'])->name('galleries.videos.create');
        Route::post('/galleries/{gallery}/videos', [GalleryVideoController::class, 'store'])->name('galleries.videos.store');
        Route::get('/galleries/{gallery}/videos/{video}/edit', [GalleryVideoController::class, 'edit'])->name('galleries.videos.edit');
        Route::put('/galleries/{gallery}/videos/{video}', [GalleryVideoController::class, 'update'])->name('galleries.videos.update');
        Route::delete('/galleries/{gallery}/videos/{video}', [GalleryVideoController::class, 'destroy'])->name('galleries.videos.destroy');
        
        Route::get('/galleries/{gallery}/albums/{album}/images/create', [AlbumImageController::class, 'create'])->name('galleries.albums.images.create');
        Route::post('/galleries/{gallery}/albums/{album}/images', [AlbumImageController::class, 'store'])->name('galleries.albums.images.store');
        Route::get('/galleries/{gallery}/albums/{album}/images/{image}/edit', [AlbumImageController::class, 'edit'])->name('galleries.albums.images.edit');
        Route::put('/galleries/{gallery}/albums/{album}/images/{image}', [AlbumImageController::class, 'update'])->name('galleries.albums.images.update');
        Route::delete('/galleries/{gallery}/albums/{album}/images/{image}', [AlbumImageController::class, 'destroy'])->name('galleries.albums.images.destroy');
        
        Route::get('/galleries/{gallery}/albums/{album}/videos/create', [AlbumVideoController::class, 'create'])->name('galleries.albums.videos.create');
        Route::post('/galleries/{gallery}/albums/{album}/videos', [AlbumVideoController::class, 'store'])->name('galleries.albums.videos.store');
        Route::get('/galleries/{gallery}/albums/{album}/videos/{video}/edit', [AlbumVideoController::class, 'edit'])->name('galleries.albums.videos.edit');
        Route::put('/galleries/{gallery}/albums/{album}/videos/{video}', [AlbumVideoController::class, 'update'])->name('galleries.albums.videos.update');
        Route::delete('/galleries/{gallery}/albums/{album}/videos/{video}', [AlbumVideoController::class, 'destroy'])->name('galleries.albums.videos.destroy');
        
        Route::fallback(function () {
            return abort(404);
        });
    });
});
