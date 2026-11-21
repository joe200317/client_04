<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\BlogPost;
use App\Support\Media;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class BlogPostController extends Controller
{
    public function index(): View
    {
        return view('admin.blog.index', [
            'posts' => BlogPost::query()->orderBy('sort_order')->latest()->paginate(12),
        ]);
    }

    public function create(): View
    {
        return view('admin.blog.form', ['post' => new BlogPost]);
    }

    public function store(Request $request): RedirectResponse
    {
        $data = $this->validated($request);
        $data['is_published'] = $request->boolean('is_published');
        $data['published_at'] = $data['is_published'] ? now() : null;

        if ($request->hasFile('image')) {
            $data['image_path'] = Media::store($request->file('image'), 'blog');
        }

        BlogPost::query()->create($data);

        return redirect()->route('admin.blog.index')->with('success', 'Blog post created.');
    }

    public function edit(BlogPost $blog): View
    {
        return view('admin.blog.form', ['post' => $blog]);
    }

    public function update(Request $request, BlogPost $blog): RedirectResponse
    {
        $data = $this->validated($request, $blog);
        $data['is_published'] = $request->boolean('is_published');
        if ($data['is_published'] && $blog->published_at === null) {
            $data['published_at'] = now();
        }

        if ($request->hasFile('image')) {
            Media::delete($blog->image_path);
            $data['image_path'] = Media::store($request->file('image'), 'blog');
        }

        $blog->update($data);

        return redirect()->route('admin.blog.index')->with('success', 'Blog post updated.');
    }

    public function destroy(BlogPost $blog): RedirectResponse
    {
        Media::delete($blog->image_path);
        $blog->delete();

        return redirect()->route('admin.blog.index')->with('success', 'Blog post deleted.');
    }

    /**
     * @return array<string, mixed>
     */
    private function validated(Request $request, ?BlogPost $post = null): array
    {
        $request->merge([
            'slug' => Str::slug((string) $request->input('title')),
        ]);

        return $request->validate([
            'title' => ['required', 'string', 'max:200'],
            'slug' => [
                'required',
                'string',
                'max:200',
                Rule::unique('blog_posts', 'slug')->ignore($post),
            ],
            'tag' => ['nullable', 'string', 'max:80'],
            'read_time' => ['nullable', 'string', 'max:40'],
            'excerpt' => ['nullable', 'string'],
            'body' => ['nullable', 'string'],
            'image' => ['nullable', 'image', 'max:5120'],
        ], [
            'slug.required' => 'The title must contain letters or numbers.',
            'slug.unique' => 'A blog post with this title already exists.',
        ]);
    }
}
