<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Str;

#[Fillable([
    'title',
    'slug',
    'description',
    'cover_path',
    'cover_tone',
    'price',
    'is_published',
    'sort_order',
])]
class Book extends Model
{
    protected static function booted(): void
    {
        static::saving(function (Book $book): void {
            if ($book->slug === null || $book->slug === '') {
                $book->slug = Str::slug($book->title);
            }
        });
    }

    /**
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'price' => 'decimal:2',
            'is_published' => 'boolean',
        ];
    }

    /**
     * @param  Builder<Book>  $query
     * @return Builder<Book>
     */
    public function scopePublished(Builder $query): Builder
    {
        return $query->where('is_published', true)->orderBy('sort_order')->orderBy('title');
    }

    /**
     * @return HasMany<BookOrder, $this>
     */
    public function orders(): HasMany
    {
        return $this->hasMany(BookOrder::class);
    }
}
