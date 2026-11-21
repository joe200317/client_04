<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\UpcomingEvent;
use App\Support\Media;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class UpcomingEventController extends Controller
{
    public function index(): View
    {
        return view('admin.events.index', [
            'events' => UpcomingEvent::query()->orderBy('sort_order')->orderBy('event_date')->paginate(12),
        ]);
    }

    public function create(): View
    {
        return view('admin.events.form', ['event' => new UpcomingEvent]);
    }

    public function store(Request $request): RedirectResponse
    {
        $data = $this->validated($request);
        $data['is_published'] = $request->boolean('is_published');
        $data['image_path'] = Media::store($request->file('image'), 'events');
        UpcomingEvent::query()->create($data);

        return redirect()->route('admin.events.index')->with('success', 'Upcoming event created.');
    }

    public function edit(UpcomingEvent $event): View
    {
        return view('admin.events.form', ['event' => $event]);
    }

    public function update(Request $request, UpcomingEvent $event): RedirectResponse
    {
        $data = $this->validated($request, false);
        $data['is_published'] = $request->boolean('is_published');

        if ($request->hasFile('image')) {
            Media::delete($event->image_path);
            $data['image_path'] = Media::store($request->file('image'), 'events');
        }

        $event->update($data);

        return redirect()->route('admin.events.index')->with('success', 'Upcoming event updated.');
    }

    public function destroy(UpcomingEvent $event): RedirectResponse
    {
        Media::delete($event->image_path);
        $event->delete();

        return redirect()->route('admin.events.index')->with('success', 'Upcoming event deleted.');
    }

    /**
     * @return array<string, mixed>
     */
    private function validated(Request $request, bool $imageRequired = true): array
    {
        return $request->validate([
            'title' => ['required', 'string', 'max:180'],
            'subtitle' => ['nullable', 'string', 'max:180'],
            'event_date' => ['nullable', 'date'],
            'location' => ['nullable', 'string', 'max:180'],
            'description' => ['nullable', 'string'],
            'image' => [$imageRequired ? 'required' : 'nullable', 'image', 'max:5120'],
        ]);
    }
}
