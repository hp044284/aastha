<?php
namespace App\Http\Controllers\Web;
use Exception;
use PDOException;
use App\Models\Team;
use App\Models\Department;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class TeamController extends Controller
{
    public function index(Request $request)
    {
        try
        {
            // Fetch all doctors with their positions, grouped by position_id
            $teams = Team::with(['position','department'])
                ->where('status', 1)
                ->orderBy('id', 'DESC')
                ->get()
                ->groupBy('department_id');
            $departments = Department::where('status', 1)->select('id','name')->orderBy('id', 'DESC')->get();
            // echo '<pre>';print_r($teams);exit;
            return view('web.teams.index', compact('teams','departments'));
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