<?php
namespace App\Http\Controllers\Web;
use Exception;
use PDOException;
use App\Models\Page;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PageController extends Controller
{
    public function index(Request $request)
    {
        $page = Page::where('Slug',$request->slug)->first();
        if(!empty($request->slug))
        {
            switch ($request->slug) {
                case 'vision':
                    return view('web.page.mission-and-vision',compact('page'));
                case 'about-us':
                    return view('web.page.index',compact('page'));
            }
        }
        return view('web.page.index',compact('page'));
    }
    
}
?>