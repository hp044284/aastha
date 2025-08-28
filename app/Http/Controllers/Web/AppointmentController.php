<?php
namespace App\Http\Controllers\Web;
use Exception;
use PDOException;
use App\Models\Enquiry;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Symfony\Component\Routing\Exception\RouteNotFoundException;

class AppointmentController extends Controller
{
    public function index(Request $request)
    {
        return view('web.appointments.index');
    }
}
?>