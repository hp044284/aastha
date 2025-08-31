<?php
namespace App\Providers;
use App\Models\Page;
use App\Models\Setting;
use App\Models\Enquiry;
use App\Models\Service;
use App\Models\ServiceCategory;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Request;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        View::composer('*', function ($view) 
        {
            $service_categories = ServiceCategory::with('service:id,title,slug,category_id')->where('Parent_ID',0)->where('Status',1)->select('id','Slug','Title','Icon','Subtitle','Parent_Id')->get()->toArray();
            // echo '<pre>';
            // print_r($service_categories);
            // die;

            $headerPages = Page::where('Menu_Display','Header')->where('Status',1)->get();
            $footerPages = Page::where('Menu_Display','Footer')->where('Status',1)->get();
            // Get Settings
            $settings = Setting::where('Status',1)->pluck('Value','Name')->toArray();
            // echo '<pre>';
            // print_r($settings);
            // die;
            $Query = Enquiry::query();
            $Query->where('Status',0);
            $EnquiryCount = $Query->count();
            $EnquiryNoti = $Query->get();
            $url = Request::url();

            $services = Service::where('Status',1)->orderBy('id','Desc')->limit(5)->get();

            // Share the data with all views
            $view->with(compact('headerPages', 'footerPages','settings','service_categories','EnquiryCount','EnquiryNoti','url','services'));
        });
    }
}
