<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Service;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class ServiceController extends Controller
{
    public function index(): View
    {
        return view('admin.services.index', [
            'services' => Service::query()->orderBy('sort_order')->latest()->paginate(12),
        ]);
    }

    public function create(): View
    {
        return view('admin.services.form', ['service' => new Service]);
    }

    public function store(Request $request): RedirectResponse
    {
        $data = $this->validated($request);
        $data['is_published'] = $request->boolean('is_published');
        Service::query()->create($data);

        return redirect()->route('admin.services.index')->with('success', 'Service created.');
    }

    public function edit(Service $service): View
    {
        return view('admin.services.form', ['service' => $service]);
    }

    public function update(Request $request, Service $service): RedirectResponse
    {
        $data = $this->validated($request, $service);
        $data['is_published'] = $request->boolean('is_published');
        $service->update($data);

        return redirect()->route('admin.services.index')->with('success', 'Service updated.');
    }

    public function destroy(Service $service): RedirectResponse
    {
        $service->delete();

        return redirect()->route('admin.services.index')->with('success', 'Service deleted.');
    }

    /**
     * @return array<string, mixed>
     */
    private function validated(Request $request, ?Service $service = null): array
    {
        $request->merge([
            'slug' => Str::slug((string) $request->input('title')),
        ]);

        return $request->validate([
            'title' => ['required', 'string', 'max:180'],
            'slug' => [
                'required',
                'string',
                'max:180',
                Rule::unique('services', 'slug')->ignore($service),
            ],
            'group_name' => ['nullable', 'string', 'max:120'],
            'duration_label' => ['nullable', 'string', 'max:80'],
            'description' => ['nullable', 'string'],
        ], [
            'slug.required' => 'The title must contain letters or numbers.',
            'slug.unique' => 'A service with this title already exists.',
        ]);
    }
}
