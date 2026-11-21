<?php

use App\Http\Controllers\Admin\AdminUserController;
use App\Http\Controllers\Admin\AuthController as AdminAuthController;
use App\Http\Controllers\Admin\BlogPostController as AdminBlogPostController;
use App\Http\Controllers\Admin\BookController as AdminBookController;
use App\Http\Controllers\Admin\BookOrderController as AdminBookOrderController;
use App\Http\Controllers\Admin\ContactMessageController as AdminContactMessageController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\EventEnquiryController as AdminEventEnquiryController;
use App\Http\Controllers\Admin\GalleryItemController as AdminGalleryItemController;
use App\Http\Controllers\Admin\ProfileController as AdminProfileController;
use App\Http\Controllers\Admin\ServiceController as AdminServiceController;
use App\Http\Controllers\Admin\TestimonialController as AdminTestimonialController;
use App\Http\Controllers\Admin\UpcomingEventController as AdminUpcomingEventController;
use App\Http\Controllers\EventEnquiryController;
use App\Http\Controllers\PageController;
use Illuminate\Support\Facades\Route;

Route::controller(PageController::class)->group(function (): void {
    Route::get('/', 'home')->name('home');
    Route::get('/about', 'about')->name('about');
    Route::get('/services', 'services')->name('services');
    Route::get('/books', 'books')->name('books');
    Route::get('/gallery', 'gallery')->name('gallery');
    Route::get('/mission-vision', 'missionVision')->name('mission-vision');
    Route::get('/blog', 'blog')->name('blog');
    Route::get('/contact', 'contact')->name('contact');
    Route::post('/contact', 'contactStore')->name('contact.store');
});

Route::post('/event-enquiries', [EventEnquiryController::class, 'store'])->name('event-enquiries.store');

Route::prefix('admin')->name('admin.')->group(function (): void {
    Route::get('login', [AdminAuthController::class, 'showLogin'])->name('login');
    Route::post('login', [AdminAuthController::class, 'login'])->name('login.attempt');

    Route::middleware(['auth', 'admin'])->group(function (): void {
        Route::post('logout', [AdminAuthController::class, 'logout'])->name('logout');
        Route::get('/', DashboardController::class)->name('dashboard');

        Route::resource('books', AdminBookController::class)->except(['show']);
        Route::resource('services', AdminServiceController::class)->except(['show']);
        Route::resource('events', AdminUpcomingEventController::class)
            ->parameters(['events' => 'event'])
            ->except(['show']);
        Route::resource('gallery', AdminGalleryItemController::class)
            ->parameters(['gallery' => 'gallery'])
            ->except(['show']);
        Route::resource('testimonials', AdminTestimonialController::class)->except(['show']);
        Route::resource('blog', AdminBlogPostController::class)
            ->parameters(['blog' => 'blog'])
            ->except(['show']);

        Route::get('orders', [AdminBookOrderController::class, 'index'])->name('orders.index');
        Route::get('orders/{order}', [AdminBookOrderController::class, 'show'])->name('orders.show');
        Route::patch('orders/{order}', [AdminBookOrderController::class, 'update'])->name('orders.update');
        Route::delete('orders/{order}', [AdminBookOrderController::class, 'destroy'])->name('orders.destroy');

        Route::get('messages', [AdminContactMessageController::class, 'index'])->name('messages.index');
        Route::get('messages/{message}', [AdminContactMessageController::class, 'show'])->name('messages.show');
        Route::delete('messages/{message}', [AdminContactMessageController::class, 'destroy'])->name('messages.destroy');

        Route::get('event-enquiries', [AdminEventEnquiryController::class, 'index'])->name('event-enquiries.index');
        Route::get('event-enquiries/{enquiry}', [AdminEventEnquiryController::class, 'show'])->name('event-enquiries.show');
        Route::delete('event-enquiries/{enquiry}', [AdminEventEnquiryController::class, 'destroy'])->name('event-enquiries.destroy');

        Route::get('admins/create', [AdminUserController::class, 'create'])->name('admins.create');
        Route::post('admins', [AdminUserController::class, 'store'])->name('admins.store');

        Route::get('profile', [AdminProfileController::class, 'edit'])->name('profile.edit');
        Route::put('profile', [AdminProfileController::class, 'update'])->name('profile.update');
    });
});
