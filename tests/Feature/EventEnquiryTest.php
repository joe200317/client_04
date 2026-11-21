<?php

namespace Tests\Feature;

use App\Models\EventEnquiry;
use App\Models\UpcomingEvent;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class EventEnquiryTest extends TestCase
{
    use RefreshDatabase;

    public function test_visitor_can_submit_event_enquiry_from_home(): void
    {
        $event = UpcomingEvent::factory()->withImage('events/focus.jpg')->create([
            'title' => 'Focus Intensive Workshop',
            'is_published' => true,
        ]);

        $response = $this->from(route('home'))->post(route('event-enquiries.store'), [
            'upcoming_event_id' => $event->id,
            'name' => 'Neha Sharma',
            'email' => 'neha@example.com',
            'phone' => '+91 98765 43210',
            'message' => 'I would like to join this workshop for my team.',
        ]);

        $response->assertRedirect(route('home'));
        $response->assertSessionHas('success');
        $this->assertDatabaseHas('event_enquiries', [
            'upcoming_event_id' => $event->id,
            'name' => 'Neha Sharma',
            'email' => 'neha@example.com',
            'phone' => '+91 98765 43210',
            'is_read' => 0,
        ]);
    }

    public function test_event_enquiry_requires_published_event_and_message(): void
    {
        $hidden = UpcomingEvent::factory()->hidden()->create();

        $response = $this->from(route('home'))->post(route('event-enquiries.store'), [
            'upcoming_event_id' => $hidden->id,
            'name' => 'Neha Sharma',
            'email' => 'neha@example.com',
            'message' => '',
        ]);

        $response->assertRedirect(route('home'));
        $response->assertSessionHasErrors(['upcoming_event_id', 'message']);
        $this->assertDatabaseCount('event_enquiries', 0);
    }

    public function test_admin_can_view_and_mark_event_enquiry_as_read(): void
    {
        $admin = User::factory()->create(['is_admin' => true]);
        $enquiry = EventEnquiry::factory()->create([
            'name' => 'Neha Sharma',
            'is_read' => false,
        ]);

        $response = $this->actingAs($admin)->get(route('admin.event-enquiries.show', $enquiry));

        $response->assertOk();
        $response->assertSee('Neha Sharma', false);
        $this->assertDatabaseHas('event_enquiries', [
            'id' => $enquiry->id,
            'is_read' => 1,
        ]);
    }

    public function test_home_event_slide_exposes_enquiry_trigger(): void
    {
        UpcomingEvent::factory()->withImage('events/memory.jpg')->create([
            'title' => 'Memory Mastery Live',
            'is_published' => true,
        ]);

        $response = $this->get(route('home'));

        $response->assertOk();
        $response->assertSee('data-event-open', false);
        $response->assertSee('Enquire Now', false);
        $response->assertSee('action="'.route('event-enquiries.store').'"', false);
    }
}
