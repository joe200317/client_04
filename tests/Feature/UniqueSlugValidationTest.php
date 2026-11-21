<?php

namespace Tests\Feature;

use App\Models\BlogPost;
use App\Models\Book;
use App\Models\Service;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UniqueSlugValidationTest extends TestCase
{
    use RefreshDatabase;

    public function test_duplicate_book_title_is_rejected(): void
    {
        $admin = User::factory()->create(['is_admin' => true]);
        Book::query()->create([
            'title' => 'The Focus Code',
            'slug' => 'the-focus-code',
            'is_published' => true,
            'sort_order' => 1,
        ]);

        $response = $this->actingAs($admin)->from(route('admin.books.create'))->post(route('admin.books.store'), [
            'title' => 'The Focus Code',
            'is_published' => '1',
        ]);

        $response->assertRedirect(route('admin.books.create'));
        $response->assertSessionHasErrors('slug');
        $this->assertDatabaseCount('books', 1);
    }

    public function test_duplicate_blog_title_is_rejected(): void
    {
        $admin = User::factory()->create(['is_admin' => true]);
        BlogPost::query()->create([
            'title' => 'Sharper Minds',
            'slug' => 'sharper-minds',
            'is_published' => true,
            'sort_order' => 1,
        ]);

        $response = $this->actingAs($admin)->from(route('admin.blog.create'))->post(route('admin.blog.store'), [
            'title' => 'Sharper Minds',
            'is_published' => '1',
        ]);

        $response->assertRedirect(route('admin.blog.create'));
        $response->assertSessionHasErrors('slug');
        $this->assertDatabaseCount('blog_posts', 1);
    }

    public function test_duplicate_service_title_is_rejected(): void
    {
        $admin = User::factory()->create(['is_admin' => true]);
        Service::query()->create([
            'title' => 'Memory Mastery',
            'slug' => 'memory-mastery',
            'is_published' => true,
            'sort_order' => 1,
        ]);

        $response = $this->actingAs($admin)->from(route('admin.services.create'))->post(route('admin.services.store'), [
            'title' => 'Memory Mastery',
            'is_published' => '1',
        ]);

        $response->assertRedirect(route('admin.services.create'));
        $response->assertSessionHasErrors('slug');
        $this->assertDatabaseCount('services', 1);
    }

    public function test_book_can_keep_same_title_on_update(): void
    {
        $admin = User::factory()->create(['is_admin' => true]);
        $book = Book::query()->create([
            'title' => 'The Focus Code',
            'slug' => 'the-focus-code',
            'description' => 'Old copy',
            'is_published' => true,
            'sort_order' => 1,
        ]);

        $response = $this->actingAs($admin)->put(route('admin.books.update', $book), [
            'title' => 'The Focus Code',
            'description' => 'Updated copy',
            'is_published' => '1',
        ]);

        $response->assertRedirect(route('admin.books.index'));
        $response->assertSessionHasNoErrors();
        $this->assertDatabaseHas('books', [
            'id' => $book->id,
            'slug' => 'the-focus-code',
            'description' => 'Updated copy',
        ]);
    }
}
