<?php

namespace Database\Factories;

use App\Models\EventEnquiry;
use App\Models\UpcomingEvent;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<EventEnquiry>
 */
class EventEnquiryFactory extends Factory
{
    protected $model = EventEnquiry::class;

    /**
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'upcoming_event_id' => UpcomingEvent::factory(),
            'name' => fake()->name(),
            'email' => fake()->safeEmail(),
            'phone' => fake()->optional()->numerify('+91 98### #####'),
            'message' => fake()->sentence(12),
            'is_read' => false,
        ];
    }

    public function read(): static
    {
        return $this->state(fn (): array => [
            'is_read' => true,
        ]);
    }
}
