<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

#[Fillable([
    'title',
    'slug',
    'group_name',
    'duration_label',
    'description',
    'is_published',
    'sort_order',
])]
class Service extends Model
{
    protected static function booted(): void
    {
        static::saving(function (Service $service): void {
            if ($service->slug === null || $service->slug === '') {
                $service->slug = Str::slug($service->title);
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
        ];
    }

    /**
     * @param  Builder<Service>  $query
     * @return Builder<Service>
     */
    public function scopePublished(Builder $query): Builder
    {
        return $query->where('is_published', true)->orderBy('sort_order')->orderBy('title');
    }
}
