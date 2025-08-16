<?php
namespace App\Http\Controllers\Admin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
class AuthController extends Controller
{
    public function Show_Login_Form()
    {
        return view('Admin.Auth.Login');
    }
}

?>