<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Cviebrock\EloquentSluggable\Sluggable;
use Spatie\MediaLibrary\InteractsWithMedia;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Video extends Model implements HasMedia
{
    use HasFactory;
    use InteractsWithMedia;
    use Sluggable;

    protected $fillable = [
        'title',
        'url',
        'caption',
        'active',
    ];

    protected $appends = ['class', 'video_id'];

    public function registerMediaConversions(Media $media = null): void
    {
        $this->addMediaConversion('md')
                ->width(600)
                ->height(600);

        $this->addMediaConversion('sm')
                ->width(200)
                ->height(200);
    }

    protected function class(): Attribute
    {
        return new Attribute(
            get: fn () => Video::class,
        );
    }

    protected function videoId(): Attribute
    {
        return new Attribute(
            get: fn () => videoId($this->url),
        );
    }

    public function videoable(): MorphTo
    {
        return $this->morphTo();
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
