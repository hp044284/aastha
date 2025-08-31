<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Web\FaqController;
use App\Http\Controllers\Web\BlogController;
use App\Http\Controllers\Web\HomeController;
use App\Http\Controllers\Web\PageController;
use App\Http\Controllers\Web\NewsController;
use App\Http\Controllers\Web\TeamController;
use App\Http\Controllers\Web\DoctorController;
use App\Http\Controllers\Web\EnquiryController;
use App\Http\Controllers\Web\ContactController;
use App\Http\Controllers\Web\ServicesController;
use App\Http\Controllers\Web\CaseStudyController;
use App\Http\Controllers\Web\TestimonialController;
use App\Http\Controllers\Web\AppointmentController;

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::prefix('blogs')->name('web.')->controller(BlogController::class)->group(function () 
{
    Route::get('/', 'index')->name('blogs.index');
    Route::get('/{slug}', 'details')->name('blogs.detail');
    Route::get('/tag/{slug}', 'tag')->name('blogs.tag');
});

Route::prefix('services')->controller(ServicesController::class)->group(function () 
{
    Route::get('/', 'index')->name('web.services.index');
    Route::get('/{slug}', 'details')->name('web.services.detail');
});

Route::prefix('enquiry')->controller(EnquiryController::class)->group(function ()
{
    Route::get('/second-opinion', 'secondOpinion')->name('web.enquiry.second_opinion');
});

Route::prefix('appointments')->controller(AppointmentController::class)->group(function ()
{
    Route::get('/', 'index')->name('web.appointments.index');
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

Route::prefix('testimonials')->controller(TestimonialController::class)->group(function ()
{
    Route::get('/', 'index')->name('web.testimonials.index');
});

Route::prefix('case-studies')->controller(CaseStudyController::class)->group(function ()
{
    Route::get('/', 'index')->name('web.case-studies.index');
    Route::get('/{slug}', 'show')->name('web.case-studies.show');
});

Route::prefix('doctors')->controller(DoctorController::class)->group(function () 
{
    Route::get('/', 'index')->name('web.doctors.index');
    Route::get('/our-teams', 'ourTeam')->name('web.doctors.our-teams');
    Route::get('/{slug}', function($slug, DoctorController $controller) 
    {
        if ($slug === 'our-teams') 
        {
            return $controller->ourTeam(request());
        }
        return $controller->show(request(), $slug);
    })->name('web.doctors.show');
});

Route::prefix('faqs')->controller(FaqController::class)->group(function ()
{
    Route::get('/', 'index')->name('web.faq.index');
});

Route::prefix('news')->controller(NewsController::class)->group(function ()
{
    Route::get('/', 'index')->name('web.news.index');
    Route::get('/load-more', 'loadMore')->name('web.news.load-more');
    Route::get('/{id}', 'show')->name('web.news.show');
});

Route::prefix('teams')->controller(TeamController::class)->group(function ()
{
    Route::get('/', 'index')->name('web.teams.index');
});

