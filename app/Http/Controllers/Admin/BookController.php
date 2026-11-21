<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Book;
use App\Support\Media;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class BookController extends Controller
{
    public function index(): View
    {
        return view('admin.books.index', [
            'books' => Book::query()->orderBy('sort_order')->latest()->paginate(12),
        ]);
    }

    public function create(): View
    {
        return view('admin.books.form', ['book' => new Book]);
    }

    public function store(Request $request): RedirectResponse
    {
        $data = $this->validated($request);
        $data['is_published'] = $request->boolean('is_published');

        if ($request->hasFile('cover')) {
            $data['cover_path'] = Media::store($request->file('cover'), 'books');
        }

        Book::query()->create($data);

        return redirect()->route('admin.books.index')->with('success', 'Book created.');
    }

    public function edit(Book $book): View
    {
        return view('admin.books.form', ['book' => $book]);
    }

    public function update(Request $request, Book $book): RedirectResponse
    {
        $data = $this->validated($request, $book);
        $data['is_published'] = $request->boolean('is_published');

        if ($request->hasFile('cover')) {
            Media::delete($book->cover_path);
            $data['cover_path'] = Media::store($request->file('cover'), 'books');
        }

        $book->update($data);

        return redirect()->route('admin.books.index')->with('success', 'Book updated.');
    }

    public function destroy(Book $book): RedirectResponse
    {
        Media::delete($book->cover_path);
        $book->delete();

        return redirect()->route('admin.books.index')->with('success', 'Book deleted.');
    }

    /**
     * @return array<string, mixed>
     */
    private function validated(Request $request, ?Book $book = null): array
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
                Rule::unique('books', 'slug')->ignore($book),
            ],
            'description' => ['nullable', 'string'],
            'cover_tone' => ['nullable', 'string', 'max:40'],
            'price' => ['nullable', 'numeric', 'min:0'],
            'cover' => ['nullable', 'image', 'max:4096'],
        ], [
            'slug.required' => 'The title must contain letters or numbers.',
            'slug.unique' => 'A book with this title already exists.',
        ]);
    }
}
