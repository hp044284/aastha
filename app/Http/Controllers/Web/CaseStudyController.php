<?php
namespace App\Http\Controllers\Web;
use Exception;
use PDOException;
use App\Models\CaseStudy;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class CaseStudyController extends Controller
{
    public function index(Request $request, $slug = null)
    {
        try
        {
            $entities = CaseStudy::where('status', 1)->latest()->orderBy('id', 'DESC')->paginate(10);
            if ($request->ajax()) 
            {
                return view('web.case-studies.partials._list', compact('entities'))->render();
            }
            return view('web.case-studies.index', compact('entities'));
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

    public function show(Request $request, $slug)
    {
        try
        {
            $caseStudy = CaseStudy::where('status', 1)->where('slug', $slug)->firstOrFail();
            return view('web.case-studies.show', compact('caseStudy'));
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