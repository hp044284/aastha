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
        return view('web.page.index',compact('page'));
    }
    
}
?>