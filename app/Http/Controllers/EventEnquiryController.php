<?php

namespace App\Http\Controllers;

use App\Http\Requests\EventEnquiryRequest;
use App\Models\EventEnquiry;
use Illuminate\Http\RedirectResponse;

class EventEnquiryController extends Controller
{
    public function store(EventEnquiryRequest $request): RedirectResponse
    {
        $data = $request->validated();

        EventEnquiry::query()->create([
            'upcoming_event_id' => $data['upcoming_event_id'],
            'name' => $data['name'],
            'email' => $data['email'],
            'phone' => $data['phone'] ?? null,
            'message' => $data['message'],
            'is_read' => false,
        ]);

        return redirect()
            ->route('home')
            ->with('success', 'Thank you! Your event enquiry has been sent. We will get back to you soon.');
    }
}
