<?php
namespace App\Http\Controllers\Admin;
use Illuminate\Http\Request;
use App\Models\Role_Permission;
use App\Http\Controllers\Controller;

class RolePermissionsController extends Controller
{
    public function Index(Request $request, $role_id)
    {
        $Query = RolePermission::with('Permission')->where('Role_Id',$role_id);
        $Role_Permission_Count = $Query->count();
        $Role_Permissions = $Query->get();
        return view('Admin.Role_Permissions.Index',compact('Role_Permissions','Role_Permission_Count','role_id'));
    }

    public function Update_All_Permissions(Request $request)
    {
        $Status = $request->Status;
        $Role_Id = $request->Role_Id;

        $exists = RolePermission::where($Status, true)->where('Role_Id', $Role_Id)->exists();
        $new_status = $exists ? false : true;
        $update = RolePermission::where('Role_Id', $Role_Id)->update([$Status => $new_status]);
        if($update)
        {
            return back()->with('success','Status update successfully!');
        }
        return back()->with('error','Error Occured');
    }

    public function Update_Status(Request $request)
    {
        try
        {
            $update_arr = [
                2 => 'Is_Add',
                3 => 'Is_Edit',
                1 => 'Is_Read',
                4 => 'Is_Delete',
            ];

            $request_status = $request->Status;
            $status = $update_arr[$request_status];
            $role_id = $request->Role_Id;
            $permission_id = $request->Permission_Id;
            $current_status = $request->Current_Status;

            $permission = RolePermission::where('id', $permission_id)->where($status, $current_status)->first();

            $new_status = true;
            if($permission[$status])
            {
                $new_status = false;
            }
            $site_status = $status;

            $update = RolePermission::where('id', $permission_id)->update([$status => $new_status]);

            if($update)
            {
                $Is_Html = '';
                if($current_status == 1)
                {
                    $current_status = 0;
                }

                if($current_status == false)
                {
                    $current_status = 1;
                }

                $permission_data = RolePermission::where('id', $permission_id)->where($status, $new_status)->first();

                $btn_value = $permission_data[$status] ? 'Yes' : 'No';
                $btn_class = $permission_data[$status] == 1 ? 'success' : 'danger';
                $btn_status = $permission_data[$status] == 1 ? '1' : '0';

                $Is_Html .= "<a href='javascript:void(0)' onclick='Update_Permissions(".$role_id.", ".$permission_id.", ".$request_status.", ".$btn_status.")'><span class='btn btn-sm btn-".$btn_class."'>".$btn_value."</span></a>";

                $response = [
                    'Is_Html' => $Is_Html,
                    'message' => 'Status update successfully!',
                ];
                return response()->json($response,200);
            }
            else
            {
                return response()->json([
                    'status' => 'error',
                    'message' => 'An error occurred while updating the status',
                ], 404);

            }
        }
        catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e)
        {
            return response()->json([
                'status' => 'error',
                'message' => 'An error occurred while updating the status : ' . $e->getMessage(),
            ], 404);
        }
        catch (\Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException  $e)
        {
            return response()->json([
                'status' => 'error',
                'message' => 'An error occurred while updating the status : ' . $e->getMessage(),
            ], 404);
        }
        catch (\PDOException  $e)
        {
            return response()->json([
                'status' => 'error',
                'message' => 'An error occurred while updating the status : ' . $e->getMessage(),
            ], 404);
        }
        catch (Exception $e)
        {
            return response()->json([
                'status' => 'error',
                'message' => 'An error occurred while updating the status : ' . $e->getMessage(),
            ], 404);
        }
    }
}
?>