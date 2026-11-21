<?php

namespace Tests\Feature;

use App\Models\UpcomingEvent;
use App\Models\User;
use App\Support\Media;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class UpcomingEventAdminTest extends TestCase
{
    use RefreshDatabase;

    public function test_admin_can_create_upcoming_event_with_image(): void
    {
        Storage::fake(Media::disk());
        $admin = User::factory()->create(['is_admin' => true]);
        $image = UploadedFile::fake()->create('focus-bootcamp.jpg', 240, 'image/jpeg');

        $response = $this->actingAs($admin)->post(route('admin.events.store'), [
            'title' => 'Focus Bootcamp',
            'subtitle' => 'Corporate Program',
            'event_date' => now()->addWeeks(2)->toDateString(),
            'location' => 'Pune',
            'description' => 'A practical focus training for teams.',
            'is_published' => '1',
            'image' => $image,
        ]);

        $response->assertRedirect(route('admin.events.index'));
        $this->assertDatabaseHas('upcoming_events', [
            'title' => 'Focus Bootcamp',
            'location' => 'Pune',
            'is_published' => 1,
        ]);

        $event = UpcomingEvent::query()->where('title', 'Focus Bootcamp')->first();
        $this->assertNotNull($event?->image_path);
        Storage::disk(Media::disk())->assertExists($event->image_path);
    }

    public function test_published_events_with_images_appear_in_hero_slider(): void
    {
        UpcomingEvent::factory()->withImage('events/memory.jpg')->create([
            'title' => 'Memory Mastery Live',
            'is_published' => true,
        ]);

        UpcomingEvent::factory()->create([
            'title' => 'No Image Event',
            'is_published' => true,
            'image_path' => null,
        ]);

        UpcomingEvent::factory()->hidden()->withImage('events/hidden.jpg')->create([
            'title' => 'Hidden Draft Event',
        ]);

        $response = $this->get(route('home'));

        $response->assertOk();
        $response->assertSee('data-hero-slider', false);
        $response->assertSee('data-duration="5000"', false);
        $response->assertSee('data-duration="3000"', false);
        $response->assertSee('Memory Mastery Live', false);
        $response->assertSee('storage/events/memory.jpg', false);
        $response->assertDontSee('No Image Event', false);
        $response->assertDontSee('Hidden Draft Event', false);
        $response->assertDontSee('upcoming-programs', false);
    }
}
