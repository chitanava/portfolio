<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Gallery extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'active',
    ];

    protected static function booted(): void
    {
        static::deleting(function (Gallery $gallery) {
            $gallery->albums()->each(function($album){
                $album->delete();
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
    
}
