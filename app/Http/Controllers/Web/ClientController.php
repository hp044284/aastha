<?php
namespace App\Http\Controllers\Web;
use Exception;
use PDOException;
use App\Models\Client;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\View;
use Illuminate\Database\Eloquent\ModelNotFoundException;
class ClientController extends Controller
{
    public function index(Request $request, $slug=null)
    {
        try
        {

            $limit = $request->input('limit', 10);
            $entities = Client::where('Status',1)->latest()->orderBy('id','DESC')->get();
            View::share([
                "Image" => '',
                "ImageAlt" => '',
                "Description" => '',
            ]);
            return view('web.clients.index',compact('entities'));
        }
        catch (PDOException $e)
        {
            return to_route('home')->with('error', $e->getMessage());
        }
        catch (Exception $e)
        {
            return to_route('home')->with('error', $e->getMessage());
        }
        catch (ModelNotFoundException $e)
        {
            return to_route('home.Index')->with('error', $e->getMessage());
        }
    }

    public function details(Request $request , $Slug)
    {
        $blog = Blog::where('Status',1)->where('Slug',$Slug)->firstOrFail();
        $recent_blogs = Blog::where('Status',1)->latest()->orderBy('id','DESC')->limit(3)->get();
        $blog_categories = BlogCategory::where('Parent_Id',0)->where('Status',1)->get();
        $review_query = Review::with('Children')->where('Blog_Id',$blog->id)->where('Parent_Id',0)->where('Status',1)->where('Review_Status','Approved');
        $review_count = $review_query->count();
        $review_entities = $review_query->get();
        View::share([
            "Image" => (!empty($blog) && !empty($blog->File_Name)) ? public_path('Uploads/Blogs/'.$blog->File_Name) : '',
            "ImageAlt" => '',
            "Description" => (!empty($blog) && !empty($blog->Meta_Description)) ? $blog->Meta_Description : '',
        ]);
        // return $review_entities;
        return view('web.blog.detail',compact('blog','recent_blogs','blog_categories','review_entities','review_count'));
    }
}
?>