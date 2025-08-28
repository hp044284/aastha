<?php
namespace App\Http\Controllers\Web;
use Exception;
use PDOException;
use App\Models\Faq;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class FaqController extends Controller
{
    public function index(Request $request)
    {
        try
        {
            // Group FAQs by category, where each key is the category and its value is an array of FAQs in that category
            $faqs = Faq::where('status', 1)
                ->orderBy('id', 'DESC')
                ->get()
                ->groupBy('category_id')->toArray();
            // echo '<pre>';
            // print_r($faqs->toArray());
            // die;
            return view('web.faqs.index', compact('faqs'));
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

    public function show(Request $request, $id)
    {
        try
        {
            $faq = Faq::where('status', 1)->findOrFail($id);
            return view('web.faq.show', compact('faq'));
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