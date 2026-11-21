<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\GalleryItem;
use App\Support\Media;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class GalleryItemController extends Controller
{
    public function index(): View
    {
        return view('admin.gallery.index', [
            'items' => GalleryItem::query()->orderBy('sort_order')->latest()->paginate(12),
        ]);
    }

    public function create(): View
    {
        return view('admin.gallery.form', ['item' => new GalleryItem]);
    }

    public function store(Request $request): RedirectResponse
    {
        $data = $this->validated($request);
        $data['is_published'] = $request->boolean('is_published');
        $data['image_path'] = Media::store($request->file('image'), 'gallery');
        GalleryItem::query()->create($data);

        return redirect()->route('admin.gallery.index')->with('success', 'Gallery item created.');
    }

    public function edit(GalleryItem $gallery): View
    {
        return view('admin.gallery.form', ['item' => $gallery]);
    }

    public function update(Request $request, GalleryItem $gallery): RedirectResponse
    {
        $data = $this->validated($request, false);
        $data['is_published'] = $request->boolean('is_published');

        if ($request->hasFile('image')) {
            Media::delete($gallery->image_path);
            $data['image_path'] = Media::store($request->file('image'), 'gallery');
        }

        $gallery->update($data);

        return redirect()->route('admin.gallery.index')->with('success', 'Gallery item updated.');
    }

    public function destroy(GalleryItem $gallery): RedirectResponse
    {
        Media::delete($gallery->image_path);
        $gallery->delete();

        return redirect()->route('admin.gallery.index')->with('success', 'Gallery item deleted.');
    }

    /**
     * @return array<string, mixed>
     */
    private function validated(Request $request, bool $imageRequired = true): array
    {
        return $request->validate([
            'title' => ['required', 'string', 'max:180'],
            'caption' => ['nullable', 'string'],
            'image' => [$imageRequired ? 'required' : 'nullable', 'image', 'max:5120'],
        ]);
    }
}
