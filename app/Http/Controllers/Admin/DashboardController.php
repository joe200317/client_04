<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\BlogPost;
use App\Models\Book;
use App\Models\BookOrder;
use App\Models\ContactMessage;
use App\Models\EventEnquiry;
use App\Models\GalleryItem;
use App\Models\Service;
use App\Models\Testimonial;
use App\Models\UpcomingEvent;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function __invoke(): View
    {
        return view('admin.dashboard', [
            'stats' => [
                'books' => Book::query()->count(),
                'services' => Service::query()->count(),
                'events' => UpcomingEvent::query()->count(),
                'gallery' => GalleryItem::query()->count(),
                'testimonials' => Testimonial::query()->count(),
                'blog' => BlogPost::query()->count(),
                'orders' => BookOrder::query()->count(),
                'event_enquiries' => EventEnquiry::query()->where('is_read', false)->count(),
                'messages' => ContactMessage::query()->where('is_read', false)->count(),
            ],
        ]);
    }
}
