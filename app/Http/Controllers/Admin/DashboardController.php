<?php
namespace App\Http\Controllers\Admin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\{
    Blog,
    User,
    Service,
    Enquiry,
    Review,
};

class DashboardController extends Controller
{
    public function Index(Request $request)
    {
        try 
        {
            $Auth_User = auth()->user();
            $User_Id = $Auth_User->id;
            $Role_Id = $Auth_User->role_id;
            $Total_Users = User::where('Role_id',3)->count();
            $Total_Blogs = Blog::count();
            $Total_Services = Service::count();
            $Total_Enquiries = Enquiry::count();
            $Total_Blog_Reviews = Review::where('Review_Type','Blog')->count();
            $Total_Product_Reviews = Review::where('Review_Type','Product')->count();
            
            view()->share([
                'Blog_Can' => $Auth_User->HasPermission('Blogs', 'Is_Read'),
                'User_Can' => $Auth_User->HasPermission('Users', 'Is_Read'),
                'Review_Can' => $Auth_User->HasPermission('Reviews', 'Is_Read'),
                'Service_Can' => $Auth_User->HasPermission('Services', 'Is_Read'),
                'Enquiry_Can' => $Auth_User->HasPermission('Enquiries', 'Is_Read'),
            ]);

            return view('Admin.Dashboard.index',compact('Auth_User','Role_Id','User_Id','Total_Users','Total_Blogs','Total_Services','Total_Enquiries','Total_Blog_Reviews','Total_Product_Reviews'));
        } 
        catch (\Exception $e) 
        {
            die('Error: ' . $e->getMessage());
        }
        
        
    }
}

?>