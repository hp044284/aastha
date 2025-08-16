<?php
namespace App\Http\Controllers\Admin;
use App\Models\Setting;
use Illuminate\Http\Request;
use App\Traits\FileUploadTrait;
use App\Http\Controllers\Controller;

class SettingsController extends Controller
{
    use FileUploadTrait;
    public function Index(Request $request)
    {
        try
        {
            $entities = Setting::where('Status',1)->orderBy('Sort_Order','ASC')->get();
            return view('Admin.Settings.Create',compact('entities'));
        }
        catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e)
        {
            return redirect()->intended(route('dashboard'))->with('error',$e->getMessage());
        }
        catch (\Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException  $e)
        {
            return redirect()->intended(route('dashboard'))->with('error',$e->getMessage());
        }
        catch (Exception $e)
        {
            return redirect()->intended(route('dashboard'))->with('error',$e->getMessage());
        }
    }

    public function Update(Request $request)
    {
        try
        {
            
            foreach ($request->all() as $request_key => $request_value)
            {
                if ($request_key != '_token')
                {
                    if ($request->hasFile($request_key))
                    {
                        $Request_File = $request->file($request_key);
                        if ($Request_File->isValid())
                        {
                            // echo '<pre>';
                            // print_r($request_key);
                            // die;
                            $setting_data = Setting::where('Name',$request_key)->first();
                            $fileName = $this->handleFileUpload($request, $request_key, '/Uploads/Settings/', $setting_data->Value ?? '');
                            Setting::updateOrCreate(
                                ['Name' => $request_key],
                                ['Value' => $fileName]
                            );
                        }
                    }
                    else
                    {
                        Setting::updateOrCreate(
                            ['Name' => $request_key],
                            ['Value' => $request_value ?? NULL]
                        );
                    }
                }
            }
            return response()->json([
                'status' => 'success',
                'message' => 'Settings updated successfully!',
                'redirect' => redirect()->intended(route('setting.index'))->getTargetUrl(),
            ], 200);
        }
        catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e)
        {
            return response()->json([
                'status' => 'error',
                'message' => 'An error occurred while updating the profile : ' . $e->getMessage(),
            ], 404);
        }
        catch (\Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException  $e)
        {
            return response()->json([
                'status' => 'error',
                'message' => 'An error occurred while updating the profile : ' . $e->getMessage(),
            ], 404);
        }
        catch (Exception $e)
        {
            return response()->json([
                'status' => 'error',
                'message' => 'An error occurred while updating the profile : ' . $e->getMessage(),
            ], 404);
        }
    }
}
?>