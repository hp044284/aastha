<?php
namespace App\Http\Middleware;
use Closure;
use Session;
use Illuminate\Support\Facades\{Auth};
class Check_Permission
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next ,$permissions, $permission_type)
    {
        if (Auth::check() && !$request->user()->HasPermission($permissions, $permission_type))
        {
            if ($request->ajax())
            {
                return response()->json(['status' => 'WARNING','message' => 'You do not have permission to access this page.']);
            }
            return redirect()->route('dashboard')->with('warning','You do not have permission to access this page.');
        }
        return $next($request);
    }
}
