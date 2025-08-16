<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Web\BlogController;
use App\Http\Controllers\Web\HomeController;
use App\Http\Controllers\Web\PageController;
use App\Http\Controllers\Web\ClientController;
use App\Http\Controllers\Web\EnquiryController;
use App\Http\Controllers\Web\ProductController;
use App\Http\Controllers\Web\ContactController;
use App\Http\Controllers\Web\ServicesController;

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::prefix('blogs')->name('web.')->controller(BlogController::class)->group(function () 
{
    Route::get('/', 'index')->name('blogs.index');
    Route::get('/{slug}', 'details')->name('blogs.detail');
    Route::get('/tag/{slug}', 'tag')->name('blogs.tag');
});

Route::prefix('services')->controller(ServicesController::class)->group(function () 
{
    Route::get('/', 'index')->name('services.index');
    Route::get('/{slug}', 'details')->name('services.detail');
});

Route::prefix('products')->controller(ProductController::class)->group(function () 
{
    Route::get('/', 'index')->name('web.product.index');
    Route::get('/{slug}', 'details')->name('web.product.detail');
});

Route::prefix('clients')->controller(ClientController::class)->group(function ()
{
    Route::get('/', 'index')->name('clients.index');
});

Route::prefix('enquiry')->controller(EnquiryController::class)->group(function ()
{
    Route::get('/{type?}', 'index')->name('web.enquiry.index');
    Route::post('/', 'store')->name('web.enquiry.store');
    Route::get('/thank-you', 'thankYou')->name('web.enquiry.thank-you');
    Route::get('/close', 'close')->name('web.enquiry.close');
});

Route::prefix('contact')->controller(ContactController::class)->group(function ()
{
    Route::get('/', 'index')->name('web.contact.index');
    Route::post('/', 'store')->name('web.contact.store');
});

Route::prefix('pages')->controller(PageController::class)->group(function ()
{
    Route::get('/{slug}', 'index')->name('web.page.index');
});


