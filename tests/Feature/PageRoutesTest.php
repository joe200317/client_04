<?php

namespace Tests\Feature;

use App\Models\Book;
use Illuminate\Foundation\Testing\RefreshDatabase;
use PHPUnit\Framework\Attributes\DataProvider;
use Tests\TestCase;

class PageRoutesTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @return array<int, array{0: string, 1: string}>
     */
    public static function pageProvider(): array
    {
        return [
            ['/', 'Mind Trainer'],
            ['/about', 'Stronger, Sharper Mind'],
            ['/services', 'Structured Training Programs'],
            ['/books', 'Reading for a Sharper Mind'],
            ['/gallery', 'Moments of Growth'],
            ['/mission-vision', 'Why We Train Minds'],
            ['/blog', 'Insights for Mental Fitness'],
            ['/contact', 'Let’s Work Together'],
        ];
    }

    #[DataProvider('pageProvider')]
    public function test_pages_load_successfully(string $uri, string $expectedText): void
    {
        $response = $this->get($uri);

        $response->assertOk();
        $response->assertSee($expectedText, false);
    }

    public function test_contact_form_stores_message(): void
    {
        $response = $this->from(route('contact'))->post(route('contact.store'), [
            'name' => 'Asha Verma',
            'email' => 'asha@example.com',
            'topic' => 'Mind and Memory Training',
            'message' => 'I would like to book a focus coaching session.',
        ]);

        $response->assertRedirect(route('contact'));
        $response->assertSessionHas('success');
        $this->assertDatabaseHas('contact_messages', [
            'email' => 'asha@example.com',
            'topic' => 'Mind and Memory Training',
        ]);
    }

    public function test_home_and_contact_show_help_topic_field(): void
    {
        $this->get(route('home'))
            ->assertOk()
            ->assertSee('What can we help with?', false)
            ->assertSee('Book 1-on-1 Session', false)
            ->assertSee('Book Order', false);
        $this->get(route('contact'))
            ->assertOk()
            ->assertSee('What can we help with?', false)
            ->assertSee('Book 1-on-1 Session', false)
            ->assertSee('Book Order', false);
    }

    public function test_book_order_topic_stores_in_book_orders(): void
    {
        $book = Book::query()->create([
            'title' => 'The Focus Code',
            'slug' => 'the-focus-code',
            'description' => 'A practical focus guide.',
            'cover_tone' => 'gold',
            'is_published' => true,
            'sort_order' => 1,
        ]);

        $response = $this->from(route('contact'))->post(route('contact.store'), [
            'name' => 'Rohit Mehta',
            'email' => 'rohit@example.com',
            'topic' => 'Book Order',
            'book_id' => $book->id,
            'phone' => '+91 98765 43210',
            'message' => 'I want to order The Focus Code.',
        ]);

        $response->assertRedirect(route('contact'));
        $response->assertSessionHas('success');
        $this->assertDatabaseHas('book_orders', [
            'customer_email' => 'rohit@example.com',
            'customer_name' => 'Rohit Mehta',
            'customer_phone' => '+91 98765 43210',
            'book_id' => $book->id,
            'status' => 'new',
        ]);
        $this->assertDatabaseMissing('contact_messages', [
            'email' => 'rohit@example.com',
        ]);
    }

    public function test_pages_do_not_show_breadcrumbs(): void
    {
        $this->get(route('about'))
            ->assertOk()
            ->assertDontSee('class="breadcrumbs"', false);
    }

    public function test_home_shows_benefit_labels(): void
    {
        $this->get(route('home'))
            ->assertOk()
            ->assertSee('Boost', false)
            ->assertSee('Memory', false)
            ->assertSee('Improve', false)
            ->assertSee('Focus', false)
            ->assertSee('Enhance', false)
            ->assertSee('Logic', false);
    }
}
