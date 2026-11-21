<?php

namespace App\Http\Controllers;

use App\Http\Requests\ContactRequest;
use App\Models\BlogPost;
use App\Models\Book;
use App\Models\BookOrder;
use App\Models\ContactMessage;
use App\Models\GalleryItem;
use App\Models\Service;
use App\Models\Testimonial;
use App\Models\UpcomingEvent;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class PageController extends Controller
{
    public function home(): View
    {
        return view('pages.home', [
            'upcomingPrograms' => UpcomingEvent::query()->forHeroSlider()->take(8)->get(),
            'services' => Service::query()->published()->take(6)->get(),
            'books' => Book::query()->published()->take(3)->get(),
            'orderBooks' => Book::query()->published()->get(),
            'testimonials' => Testimonial::query()->published()->take(4)->get(),
        ]);
    }

    public function about(): View
    {
        return view('pages.about');
    }

    public function services(): View
    {
        return view('pages.services', [
            'services' => Service::query()->published()->get(),
        ]);
    }

    public function books(): View
    {
        return view('pages.books', [
            'books' => Book::query()->published()->get(),
        ]);
    }

    public function gallery(): View
    {
        return view('pages.gallery', [
            'items' => GalleryItem::query()->published()->get(),
        ]);
    }

    public function missionVision(): View
    {
        return view('pages.mission-vision');
    }

    public function blog(): View
    {
        return view('pages.blog', [
            'posts' => BlogPost::query()->published()->get(),
        ]);
    }

    public function contact(): View
    {
        return view('pages.contact', [
            'orderBooks' => Book::query()->published()->get(),
        ]);
    }

    public function contactStore(ContactRequest $request): RedirectResponse
    {
        $data = $request->validated();

        if ($data['topic'] === 'Book Order') {
            BookOrder::query()->create([
                'book_id' => $data['book_id'],
                'customer_name' => $data['name'],
                'customer_email' => $data['email'],
                'customer_phone' => $data['phone'],
                'quantity' => 1,
                'message' => $data['message'],
                'status' => 'new',
            ]);
        } else {
            ContactMessage::query()->create([
                'name' => $data['name'],
                'email' => $data['email'],
                'topic' => $data['topic'],
                'message' => $data['message'],
            ]);
        }

        return redirect()
            ->route('contact')
            ->with('success', 'Thank you! Your message has been sent. We will get back to you soon.');
    }
}
