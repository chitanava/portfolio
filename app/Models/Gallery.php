<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class Gallery extends Model
{
    use HasFactory;
    use Sluggable;

    protected $fillable = [
        'title',
        'active',
    ];

    protected static function booted(): void
    {
        static::deleting(function (Gallery $gallery) {
            $gallery->albums()->each(function($album){
                $album->delete();

                $album->images()->each(function($image){
                    $image->delete();
                });
            });

            $gallery->images()->each(function($image){
                $image->delete();
            });
        });
    }

    public function albums(): HasMany
    {
        return $this->hasMany(Album::class);
    }

    public function images(): MorphMany
    {
        return $this->morphMany(Image::class, 'imageable');
    }

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'title'
            ]
        ];
    }
    
}
