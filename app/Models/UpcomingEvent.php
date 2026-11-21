<?php

namespace App\Models;

use Database\Factories\UpcomingEventFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

#[Fillable([
    'title',
    'subtitle',
    'event_date',
    'location',
    'description',
    'image_path',
    'is_published',
    'sort_order',
])]
class UpcomingEvent extends Model
{
    /** @use HasFactory<UpcomingEventFactory> */
    use HasFactory;

    /**
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'event_date' => 'date',
            'is_published' => 'boolean',
        ];
    }

    /**
     * @return HasMany<EventEnquiry, $this>
     */
    public function enquiries(): HasMany
    {
        return $this->hasMany(EventEnquiry::class);
    }

    /**
     * @param  Builder<UpcomingEvent>  $query
     * @return Builder<UpcomingEvent>
     */
    public function scopePublished(Builder $query): Builder
    {
        return $query
            ->where('is_published', true)
            ->orderBy('sort_order')
            ->orderBy('event_date');
    }

    /**
     * @param  Builder<UpcomingEvent>  $query
     * @return Builder<UpcomingEvent>
     */
    public function scopeForHeroSlider(Builder $query): Builder
    {
        return $query
            ->published()
            ->whereNotNull('image_path')
            ->where('image_path', '!=', '');
    }
}
