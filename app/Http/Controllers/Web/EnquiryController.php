<?php
namespace App\Http\Controllers\Web;
use Exception;
use PDOException;
use App\Models\Enquiry;
use App\Models\Setting;
use App\Models\Service;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Models\EnquirySubject;
use App\Http\Controllers\Controller;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Symfony\Component\Routing\Exception\RouteNotFoundException;

class EnquiryController extends Controller
{
    public function index(Request $request, $type = null)
    {
        $settings = Setting::pluck('Value','Name')->toArray();
        if($type == 'service')
        {
            $enquirable = Service::where('Slug',$request->slug)->first();
        }
        else if($type == 'product')
        {
            $enquirable = Product::where('Slug',$request->slug)->first();
        }
        else
        {
            $enquirable = EnquirySubject::all();
        }
        return view('web.enquiry.index',compact('settings','enquirable','type'));
    }

    public function store(Request $request)
    {
        try
        {
            // echo "<pre>";
            // print_r($request->all());
            // exit;
            $request->validate([
                'Name' => 'required',
                'Email' => 'required|email',
                'Mobile' => 'required',
                'Message' => 'required',
            ]);
            
            if(!empty($request->type))
            {
                $modelClass = $request->type === 'product' ? Product::class : Service::class;
                $enquirable = $modelClass::findOrFail($request->id);

                $enquirable->enquiries()->create([
                    'Name' => $request->Name,
                    'Email' => $request->Email,
                    'Mobile' => $request->Mobile,
                    'Message' => $request->Message,
                ]);
            }
            else
            {
                $enquiry = Enquiry::create([
                    'Name' => $request->Name,
                    'Email' => $request->Email,
                    'Mobile' => $request->Mobile,
                    'Message' => $request->Message,
                    'subject' => $request->subject,
                ]);
            }
            return view('web.enquiry.thank-you')->with('success', 'Your enquiry has been submitted successfully. We will contact you shortly.');
        }
        catch (PDOException $e)
        {
            return to_route('web.enquiry.index')->with('error', 'Something went wrong');
        }
        catch (Exception $e)
        {
            return to_route('web.enquiry.index')->with('error', 'Something went wrong');
        }

    }

    public function thankYou()
    {
        return view('web.enquiry.thank-you');
    }
}
?>