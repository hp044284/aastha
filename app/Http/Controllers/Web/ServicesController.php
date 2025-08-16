<?php
namespace App\Http\Controllers\Web;
use PDOException;
use Exception;
use App\Models\Service;
use App\Models\Setting;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\ServiceCategory;
use App\Http\Controllers\Controller;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Symfony\Component\Routing\Exception\RouteNotFoundException;

class ServicesController extends Controller
{
    public function index(Request $request, $slug = null)
    {
        $query = Service::query();
        $query->where('Status', 1);
        $service_category = (object)[];
        if (!empty($slug)) {
            $service_category = ServiceCategory::where('Parent_Id', 0)->where('Slug', $slug)->first();
            $service_category_id = $service_category->id;
            $query->where('Category_Id', $service_category_id);
        }
        $entities = $query->latest()->orderBy('id', 'DESC')->paginate(8);

        return view('web.services.index', compact('entities', 'service_category'));
    }

    public function Details(Request $request, $slug)
    {
        try
        {
            $service_category = ServiceCategory::where('Slug', $slug)->first();
            if($service_category)
            {
                $query = Service::query();
                $query->where('Status', 1);

                $service_category_id = $service_category->id;
                $query->where('Sub_Category_Id', $service_category_id);
                $entities = $query->latest()->orderBy('id', 'DESC')->paginate(8);
                return view('web.services.index', compact('entities', 'service_category'));
            }

            $entity = Service::where('Status',1)->where('Slug',$slug)->first();
            $services = Service::where('Status',1)->where('Category_Id',$entity->Category_Id)->get();
            $settings = Setting::pluck('Value','Name')->toArray();

            return view('web.services.detail',compact('entity','services','settings'));
        }
        catch (PDOException $e)
        {
            return to_route('services.index')->with('error', $e->getMessage());
        }
        catch (Exception $e)
        {
            return to_route('services.index')->with('error', $e->getMessage());
        }
        catch (ModelNotFoundException $e)
        {
            return to_route('home')->with('error', $e->getMessage());
        }
        catch (RouteNotFoundException $e)
        {
            return to_route('services.index')->with('error', $e->getMessage());
        }
    }
}
?>