<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\EventEnquiry;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class EventEnquiryController extends Controller
{
    public function index(): View
    {
        return view('admin.event-enquiries.index', [
            'enquiries' => EventEnquiry::query()
                ->with('event')
                ->latest()
                ->paginate(15),
        ]);
    }

    public function show(EventEnquiry $enquiry): View
    {
        $enquiry->load('event');

        if (! $enquiry->is_read) {
            $enquiry->update(['is_read' => true]);
        }

        return view('admin.event-enquiries.show', ['enquiry' => $enquiry]);
    }

    public function destroy(EventEnquiry $enquiry): RedirectResponse
    {
        $enquiry->delete();

        return redirect()
            ->route('admin.event-enquiries.index')
            ->with('success', 'Event enquiry deleted.');
    }
}
