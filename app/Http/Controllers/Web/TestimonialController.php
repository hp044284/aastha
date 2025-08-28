<?php
namespace App\Http\Controllers\Web;
use Exception;
use PDOException;
use App\Models\Testimonial;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Database\Eloquent\ModelNotFoundException;
class TestimonialController extends Controller
{
    public function index(Request $request, $slug=null)
    {
        try
        {

            $entities = Testimonial::where('status',1)->latest()->orderBy('id','DESC')->paginate(10);
            if ($request->ajax()) 
            {
                return view('web.testimonials.partials._list',compact('entities'))->render();
            }
            return view('web.testimonials.index',compact('entities'));
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
            return to_route('home')->with('error', $e->getMessage());
        }
    }
}
?>