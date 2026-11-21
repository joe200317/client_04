<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

#[Fillable([
    'title',
    'slug',
    'tag',
    'read_time',
    'excerpt',
    'body',
    'image_path',
    'is_published',
    'published_at',
    'sort_order',
])]
class BlogPost extends Model
{
    protected static function booted(): void
    {
        static::saving(function (BlogPost $post): void {
            if ($post->slug === null || $post->slug === '') {
                $post->slug = Str::slug($post->title);
            }
        });
    }

    /**
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'is_published' => 'boolean',
            'published_at' => 'datetime',
        ];
    }

    /**
     * @param  Builder<BlogPost>  $query
     * @return Builder<BlogPost>
     */
    public function scopePublished(Builder $query): Builder
    {
        return $query->where('is_published', true)->orderBy('sort_order')->latest('published_at');
    }
}
