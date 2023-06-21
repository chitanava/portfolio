<?php

namespace App\Models;

use Spatie\Url\Url;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class SocialLink extends Model
{
    use HasFactory;

    protected $fillable = ['url', 'icon_slug'];

    protected $appends = ['host'];

    protected function host(): Attribute
    {
        return Attribute::make(
            get: fn () => Url::fromString($this->url)->getHost(),
        );
    }
}
