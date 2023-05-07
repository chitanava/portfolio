<?php

namespace App\Models;

use Spatie\MediaLibrary\HasMedia;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
use Spatie\MediaLibrary\InteractsWithMedia;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\MediaLibrary\MediaCollections\Models\Media;


class Album extends Model implements HasMedia
{
    use HasFactory;
    use InteractsWithMedia;
    use Sluggable;

    protected $fillable = [
        'title',
        'description',
        'active',
    ];

    protected $appends = ['class'];

    public function registerMediaConversions(Media $media = null): void
    {
        $this->addMediaConversion('thumb')
                ->width(600)
                ->height(600);
    }

    protected function class(): Attribute
    {
        return new Attribute(
            get: fn () => Album::class,
        );
    }

    protected static function booted(): void
    {
        static::deleting(function (Album $album) {
            $album->images()->each(function($image){
                $image->delete();
            });
        });
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
