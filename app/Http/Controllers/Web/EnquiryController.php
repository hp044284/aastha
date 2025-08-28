<?php
namespace App\Http\Controllers\Web;
use Exception;
use PDOException;
use App\Models\Enquiry;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Symfony\Component\Routing\Exception\RouteNotFoundException;

class EnquiryController extends Controller
{
    public function secondOpinion(Request $request)
    {
        return view('web.enquiry.second-opinion');
    }
}
?>