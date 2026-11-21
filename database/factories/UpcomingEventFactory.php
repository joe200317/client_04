<?php

namespace Database\Factories;

use App\Models\UpcomingEvent;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<UpcomingEvent>
 */
class UpcomingEventFactory extends Factory
{
    protected $model = UpcomingEvent::class;

    /**
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => fake()->sentence(3),
            'subtitle' => fake()->optional()->words(3, true),
            'event_date' => fake()->dateTimeBetween('now', '+3 months')->format('Y-m-d'),
            'location' => fake()->optional()->city(),
            'description' => fake()->optional()->sentence(12),
            'image_path' => null,
            'is_published' => true,
            'sort_order' => fake()->numberBetween(0, 20),
        ];
    }

    public function hidden(): static
    {
        return $this->state(fn (): array => [
            'is_published' => false,
        ]);
    }

    public function withImage(string $path = 'events/demo.jpg'): static
    {
        return $this->state(fn (): array => [
            'image_path' => $path,
        ]);
    }
}
