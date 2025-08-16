<?php
namespace App\Http\Controllers\Admin;
use App\Models\Role;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class RolesController extends Controller
{
    public function Index(Request $request)
    {
        return view('Admin.Roles.Index');
    }

    public function Create(Request $request)
    {
        return view('Admin.Roles.Create');
    }

    public function Edit(Request $request, $random_id)
    {
        try
        {
            $entity = Role::where('random_id',$random_id)->firstOrFail();
            return view('Admin.Roles.Edit',compact('entity'));
        }
        catch (\PDOException $e)
        {
            return to_route('role.index')->with('error', $e->getMessage());
        }
        catch (Exception $e)
        {
            return to_route('role.index')->with('error', $e->getMessage());
        }
        catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e)
        {
            return to_route('role.index')->with('error', $e->getMessage());
        }
    }

    public function Axios_Record(Request $request)
    {
        ## Read value
        $draw = $request->get('draw');
        $start = $request->get("start");
        $rowperpage = $request->get("length");

        $order_arr = $request->get('order');
        $search_arr = $request->get('search');
        $searchValue = $search_arr['value'];
        $columnName_arr = $request->get('columns');
        $columnIndex_arr = $request->get('order');

        $columnIndex = $columnIndex_arr[0]['column'];
        $columnName = $columnName_arr[$columnIndex]['data'];
        $columnSortOrder = $order_arr[0]['dir'];

        $Auth_User = auth()->user();
        $Is_Edit = $Auth_User->HasPermission('Roles', 'Is_Edit');

        // Total records
        $queryRecords = Role::query();
        $totalRecords = $queryRecords->count();

        $Query = Role::orderby($columnName, $columnSortOrder);
        if (!empty($searchValue))
        {
            $Query->where(function($query) use($searchValue)
            {
                $query->where('name', 'like', '%' .$searchValue . '%')
                ;
            });
        }

        $totalRecordswithFilter = $Query->count();
        $records = $Query->skip($start)->take($rowperpage)->get();

        $data_arr = array();
        $incKey = 0;
        foreach($records as $record)
        {
            $id = $record->id;
            $random_id = $record->Random_Id;
            $data_arr[$incKey]['id'] = $record->id;
            $data_arr[$incKey]['Name'] = !empty($record->Name) ? $record->Name : '';
            $data_arr[$incKey]['Status'] = !empty($record->Status) ? '<button type="button" data-status="active" class="btn btn-success status-button" data-id="'.$id.'">Active</button>' : '<button type="button" class="btn btn-danger status-button" data-id="'.$id.'" data-status="inactive">Deactive</button>';

            $actions = '<div class="col">';
                $actions .= '<div class="btn-group" role="group" aria-label="Basic example">';
                    if($Is_Edit)
                    {
                        $actions .= '<a href="'.route('role.edit',$random_id).'" class="btn btn-outline-secondary"><i class="bx bx-edit"></i>Edit</a>';
                        $actions .= '<a href="'.route('role_permission.index',$id).'" class="btn btn-outline-secondary"><i class="bx bx-edit"></i>Role Permissions</a>';
                        $actions .= '<a href="javascript:void(0);" onclick="Create_Update_Role_Permissions('.$id.')" class="btn btn-outline-secondary"><i class="bx bx-edit"></i>Role Permission Update</a>';
                    }
                $actions .= '</div>';
            $actions .= '</div>';

            $data_arr[$incKey]['action'] = $actions;
            $incKey++;
        }

        $response = array(
            "draw" => intval($draw),
            "aaData" => $data_arr,
            "iTotalRecords" => $totalRecords,
            "iTotalDisplayRecords" => $totalRecordswithFilter,
        );
        echo json_encode($response);
        exit;
    }

    public function Store(Request $request)
    {
        try
        {
            $validated_data = $request->validate([
                'Name' => 'required|string|unique:roles,Name|max:255',
            ]);

            $validated_data['Status'] = (!empty($request->Status)) ? 1 : 0;
            Role::create($validated_data);
            return response()->json([
                'status' => 'success',
                'message' => 'Role created successfully!',
                'redirect' => redirect()->intended(route('role.index'))->getTargetUrl(),
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

    public function Update(Request $request)
    {
        try
        {
            $id = $role_id = $request->id;
            $validated_data = $request->validate([
                'Name' => 'required|string|unique:roles,Name,' . $id . '|max:255',
            ]);

            $role = Role::findOrFail($id);
            $validated_data['Status'] = (!empty($request->Status)) ? 1 : 0;
            $role->update($validated_data);
            return response()->json([
                'status' => 'success',
                'message' => 'Role updated successfully!',
                'redirect' => redirect()->intended(route('role.index'))->getTargetUrl(),
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

    public function Status(Request $request)
    {
        try
        {
            $id = $request->id;
            $validated_data = $request->validate([
                'Status' => 'required|in:1,0',
            ]);

            $entity = Role::findOrFail($id);
            $entity->update($validated_data);

            return response()->json([
                'status' => 'success',
                'message' => 'Status updated successfully!',
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

    public function Create_Update_Role_Permissions(Request $request)
    {
        try
        {
            $validated_data = $request->validate([
                'id' => 'required',
            ]);
            $id = $role_id = $request->id;

            $permissions = \App\Models\Permission::all();
            $role_permissions = \App\Models\Role_Permission::where('Role_Id',$id)->get()->toArray();
            if (!empty($role_permissions))
            {
                $role_per_arr = array();
                foreach ($role_permissions as $role_permission_key => $role_permission)
                {
                    $role_per_arr[$role_permission['Permission_Id']] = $role_permission;
                }
            }

            if (!empty($permissions))
            {
                $incKey = 0;
                foreach ($permissions as $permission_key => $permission)
                {
                    $rolePermissions = (!empty($role_per_arr[$permission->id])) ? $role_per_arr[$permission->id] : array();
                    if (count($rolePermissions) == 0)
                    {
                        $role_permission_arr[$incKey] = array(
                            "Status" => 1,
                            "Is_Add" => 0,
                            "Is_Edit" => 0,
                            "Is_Read" => 0,
                            "Role_Id" => $role_id,
                            "Is_Delete" => 0,
                            "Sort_Order" => $permission->Sort_Order ?? 0,
                            "created_at" => date('Y-m-d H:i:s'),
                            "updated_at" => date('Y-m-d H:i:s'),
                            "Permission_Id" => $permission->id,
                        );
                        $incKey++;
                    }
                }
                if (!empty($role_permission_arr))
                {
                    \App\Models\Role_Permission::insert($role_permission_arr);
                }
            }
            return response()->json([
                'status' => 'success',
                'message' => 'Status updated successfully!',
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