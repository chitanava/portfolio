<?php

namespace App\Http\Traits;

use Illuminate\Database\Eloquent\Builder;

trait ItemsTrait
{
  public function galleryItems($gallery, $active = true)
  {
    $albums = $gallery->albums()
      ->with('media')
      ->when($active, function (Builder $query) {
        $query->where('active', '=', 1);
      })
      ->orderBy('ord', 'asc')
      ->get();

    $images = $gallery->images()
      ->with('media')
      ->when($active, function (Builder $query) {
        $query->where('active', '=', 1);
      })
      ->orderBy('ord', 'asc')
      ->get();

    $videos = $gallery->videos()
      ->with('media')
      ->when($active, function (Builder $query) {
        $query->where('active', '=', 1);
      })
      ->orderBy('ord', 'asc')
      ->get();

    return collect([$albums, $images, $videos])->flatten(1)->sortBy('ord')->values();
  }

  public function albumItems($album, $active = true)
  {
    $images = $album->images()
      ->with('media')
      ->when($active, function (Builder $query) {
        $query->where('active', '=', 1);
      })
      ->orderBy('ord', 'asc')
      ->get();

    $videos = $album->videos()
      ->with('media')
      ->when($active, function (Builder $query) {
        $query->where('active', '=', 1);
      })
      ->orderBy('ord', 'asc')
      ->get();

    return collect([$images, $videos])->flatten(1)->sortBy('ord')->values();
  }
}
