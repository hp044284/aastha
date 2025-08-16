<?php
namespace App\Http\Controllers\Web;
use App\Models\Faq;
use App\Models\Blog;
use App\Models\Slider;
use App\Models\Client;
use App\Models\Service;
use App\Models\Testimonial;
use Illuminate\Http\Request;
use App\Models\FeaturedService;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\View;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        $faqs = Faq::where('Status',1)->orderBy('id','DESC')->get();
        $blogs = Blog::where('Status',1)->orderBy('id','DESC')->get();
        $clients = Client::where('Status',1)->orderBy('id','DESC')->get();
        $sliders = Slider::where('Status',1)->orderBy('id','DESC')->get();
        $services = Service::where('Status',1)->orderBy('id','DESC')->get();
        $testimonials = Testimonial::where('Status',1)->orderBy('id','DESC')->get();
        $feature_services = FeaturedService::where('Status',1)->orderBy('id','DESC')->get();
        return view('web.home.index',compact('blogs','clients','sliders','services','testimonials','faqs','feature_services'));
    }

    public function Axios_Review(Request $request)
    {
        try
        {
            $validated_data = $request->validate([
                'Name' => 'required|string|max:255',
                'Email' => 'required|email|max:255',
                'Website' => 'nullable|url|max:255',
                'Blog_Id' => 'required',
                'Message' => 'required|string',
            ]);
            $validated_data['Is_Save'] = (!empty($request->Is_Save)) ? 1 : 0;
            \App\Models\Review::create($validated_data);
            return response()->json([
                'status' => 'success',
                'message' => 'Your review request has been sent. Your review will be displayed once approved by the admin.',
            ], 200);
        }
        catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e)
        {
            return response()->json([
                'status' => 'error',
                'message' => 'An error occurred while updating the profile : ' . $e->getMessage(),
            ], 404);
        }
        catch (\Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException  $e)
        {
            return response()->json([
                'status' => 'error',
                'message' => 'An error occurred while updating the profile : ' . $e->getMessage(),
            ], 404);
        }
        catch (Exception $e)
        {
            return response()->json([
                'status' => 'error',
                'message' => 'An error occurred while updating the profile : ' . $e->getMessage(),
            ], 404);
        }
    }

    public function Axios_Contact(Request $request)
    {
        try
        {
            $validated_data = $request->validate([
                'Name' => 'required|string|max:255',
                'Email' => 'required|email|max:255',
                'Mobile' => 'required|numeric',
                'Message' => 'required|string',
            ]);
            $validated_data['Status'] = 0;
            \App\Models\Enquiry::create($validated_data);
            return response()->json([
                'status' => 'success',
                'message' => 'Thank you for your enquiry. Your request has been successfully submitted and will be reviewed shortly.',
            ], 200);
        }
        catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e)
        {
            return response()->json([
                'status' => 'error',
                'message' => 'An error occurred while updating the profile : ' . $e->getMessage(),
            ], 404);
        }
        catch (\Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException  $e)
        {
            return response()->json([
                'status' => 'error',
                'message' => 'An error occurred while updating the profile : ' . $e->getMessage(),
            ], 404);
        }
        catch (Exception $e)
        {
            return response()->json([
                'status' => 'error',
                'message' => 'An error occurred while updating the profile : ' . $e->getMessage(),
            ], 404);
        }
    }
}
?>