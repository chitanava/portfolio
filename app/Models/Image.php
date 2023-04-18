<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Image extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'body',
    ];

    protected $appends = ['model'];

    protected function model(): Attribute
    {
        return new Attribute(
            get: fn () => Image::class,
        );
    }

    public function imageable(): MorphTo
    {
        return $this->morphTo();
    }
}
