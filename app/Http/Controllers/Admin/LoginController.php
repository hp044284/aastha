<?php
namespace App\Http\Controllers\Admin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
class LoginController extends Controller
{
    public function Login(Request $request)
    {
        $validator = validator($request->all(), [
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if ($validator->fails())
        {
            return response()->json(['status'=>'error','message' => $validator->errors()->first()], 401);
        }

        if (Auth::attempt(['email' => $request->email, 'password' => $request->password]))
        {
            $request->session()->regenerate();
            return response()->json([
                'status' => 'success',
                'message' => 'Login successfully',
                'redirect' => redirect()->intended(route('dashboard'))->getTargetUrl(),
            ]);
        }
        else
        {
            return response()->json([
                'status' => 'error',
                'message' => 'These credentials do not match our records.',
            ],401);
        }
    }

    public function Logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('admin_login');;
    }
}

?>