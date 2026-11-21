<?php

namespace App\Models;

use Database\Factories\EventEnquiryFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

#[Fillable([
    'upcoming_event_id',
    'name',
    'email',
    'phone',
    'message',
    'is_read',
])]
class EventEnquiry extends Model
{
    /** @use HasFactory<EventEnquiryFactory> */
    use HasFactory;

    /**
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'is_read' => 'boolean',
        ];
    }

    /**
     * @return BelongsTo<UpcomingEvent, $this>
     */
    public function event(): BelongsTo
    {
        return $this->belongsTo(UpcomingEvent::class, 'upcoming_event_id');
    }
}
