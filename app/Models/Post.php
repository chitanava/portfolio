<?php

namespace App\Models;

use App\Models\Tag;
use Spatie\Tags\HasTags;
use Spatie\MediaLibrary\HasMedia;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
use Spatie\MediaLibrary\InteractsWithMedia;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Post extends Model implements HasMedia
{
    use HasFactory;
    use InteractsWithMedia;
    use Sluggable;
    use HasTags;


    protected $fillable = [
        'title',
        'slug',
        'body',
        'active',
        'published_at',
    ];

    protected $casts = [
        'published_at' => 'datetime',
    ];

    protected static function booted(): void
    {
        static::deleting(function (Post $post) {
            $post->syncTags([]);
        });

        static::deleted(function (Post $post) {
            $tagsWithoutPosts = Tag::whereDoesntHave('posts')->pluck('id');
            Tag::destroy($tagsWithoutPosts);
        });
    }

    public function registerMediaConversions(Media $media = null): void
    {
        $this->addMediaConversion('md')
                ->width(600)
                ->height(600);

        $this->addMediaConversion('sm')
                ->width(200)
                ->height(200);
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
