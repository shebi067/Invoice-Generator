<?php

use App\Http\Controllers\PageController;
use Illuminate\Support\Facades\Route;

// Homepage with live interactive invoice generator
Route::get('/', [PageController::class, 'home'])->name('home');

// Free Templates Gallery
Route::get('/templates', [PageController::class, 'templates'])->name('templates');

// Dedicated Template Customizer
Route::get('/templates/{template}', [PageController::class, 'customizeTemplate'])->name('templates.customize');

// Blank Canvas Custom Invoice Builder
Route::get('/builder', [PageController::class, 'builder'])->name('invoice.builder');

// Important Pages
Route::get('/how-it-works', [PageController::class, 'howItWorks'])->name('how-it-works');
Route::get('/about', [PageController::class, 'about'])->name('about');
Route::get('/contact', [PageController::class, 'contact'])->name('contact');
Route::post('/contact', [PageController::class, 'submitContact'])->name('contact.submit');
Route::get('/privacy-policy', [PageController::class, 'privacy'])->name('privacy');
Route::get('/faqs', [PageController::class, 'faqs'])->name('faqs');
Route::get('/faq', fn() => redirect()->route('faqs'));
Route::get('/blog', [PageController::class, 'blog'])->name('blog');
Route::get('/blog/how-to-create-an-invoice-online-for-free', [PageController::class, 'blogPost'])->name('blog.post');
Route::get('/blog/what-is-an-invoice', [PageController::class, 'blogWhatIsAnInvoice'])->name('blog.what-is-an-invoice');
Route::get('/blog/invoice-vs-receipt', [PageController::class, 'blogInvoiceVsReceipt'])->name('blog.invoice-vs-receipt');
Route::get('/blogs', fn() => redirect()->route('blog'));
