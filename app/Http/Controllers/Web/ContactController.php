<?php
namespace App\Http\Controllers\Web;
use Exception;
use PDOException;
use App\Models\Setting;
use App\Models\Contact;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ContactController extends Controller
{
    public function index(Request $request)
    {
        return view('web.contact.index');
    }

    public function store(Request $request)
    {
        try
        {
            echo '<pre>';
            print_r($request->all());
            echo '</pre>';
            die;
            $validated_data = $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|email|max:255',
                'mobile' => 'required|numeric|digits:10',
                'message' => 'required|string',
                'subject' => 'required|string|max:255',
            ]);

            $validated_data['ip_address'] = $request->ip();
            $entity = Contact::create($validated_data);
            return view('web.contact.thank-you')->with('success', 'Your contact details has been submitted successfully. We will contact you shortly.');
        }
        catch (PDOException $e)
        {
            return to_route('web.contact.index')->with('error', $e->getMessage());
        }
        catch (Exception $e)
        {
            return to_route('web.contact.index')->with('error', $e->getMessage());
        }
    }
    
}
?>