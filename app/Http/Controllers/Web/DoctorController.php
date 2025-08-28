<?php
namespace App\Http\Controllers\Web;
use Exception;
use PDOException;
use App\Models\Doctor;
use App\Models\Position;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class DoctorController extends Controller
{
    public function index(Request $request)
    {
        try
        {
            $positions = Position::where('status',1)->pluck('title','id')->toArray();
            $query = Doctor::query();
            $query->with('position','education');
            $query->where('status',1);
            if ($request->has('search'))
            {
                $query->where('name', 'like', '%' . $request->input('search') . '%');
            }

            if ($request->has('positions') && !empty($request->input('positions'))) 
            {
                $positionsFilter = $request->input('positions');
                if (is_string($positionsFilter)) 
                {
                    $positionsFilter = explode(',', $positionsFilter);
                }
                $query->whereHas('position', function($q) use ($positionsFilter) 
                {
                    $q->whereIn('id', $positionsFilter);
                });
            }
            $doctors = $query->latest()->orderBy('id', 'DESC')->paginate(1);

            if ($request->ajax()) 
            {
                if($doctors->isEmpty())
                {
                    return '<div class="alert alert-warning text-center position-relative" id="noDoctorsAlert">'
                        . '<button type="button" class="btn-close position-absolute top-0 end-0 m-2" aria-label="Close" onclick="document.getElementById(\'noDoctorsAlert\').remove();"></button>'
                        . 'No doctors found.'
                        . '</div>';
                }
                return view('web.doctors.partials._list', compact('doctors','positions'))->render();
            }
            return view('web.doctors.index', compact('doctors','positions'));
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
            $doctor = Doctor::with('specializations','education','positions','position','affiliations')->where('status', 1)->where('slug', $slug)->firstOrFail();
            return view('web.doctors.show', compact('doctor'));
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

    public function ourTeam(Request $request)
    {
        try
        {
            $doctors = Doctor::with(['position'])->where('status', 1)
                ->orderBy('id', 'DESC')
                ->get()
                ->groupBy('position_id');

            // Optionally, fetch all unique positions for filtering or display
            $positions = Position::where('status', 1)->orderBy('id', 'DESC')->get();
            return view('web.doctors.team', compact('doctors','positions'));
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