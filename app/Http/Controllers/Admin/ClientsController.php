<?php
namespace App\Http\Controllers\Admin;
use App\Models\Client;
use Illuminate\Http\Request;
use App\Traits\FileUploadTrait;
use App\Http\Controllers\Controller;

class ClientsController extends Controller
{
    use FileUploadTrait;
    public function Index(Request $request)
    {
        try
        {
            return view('Admin.Clients.Index');
        }
        catch (\PDOException $e)
        {
            return to_route('client.index')->with('error', $e->getMessage());
        }
        catch (Exception $e)
        {
            return to_route('client.index')->with('error', $e->getMessage());
        }
        catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e)
        {
            return to_route('client.index')->with('error', $e->getMessage());
        }
    }

    public function Create(Request $request)
    {
        try
        {
            return view('Admin.Clients.Create');
        }
        catch (\PDOException $e)
        {
            return to_route('client.index')->with('error', $e->getMessage());
        }
        catch (Exception $e)
        {
            return to_route('client.index')->with('error', $e->getMessage());
        }
        catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e)
        {
            return to_route('client.index')->with('error', $e->getMessage());
        }
    }

    public function Edit(Request $request, $Random_Id)
    {
        try
        {
            $entity = Client::where('Random_Id',$Random_Id)->firstOrFail();
            return view('Admin.Clients.Edit',compact('entity'));
        }
        catch (\PDOException $e)
        {
            return to_route('client.index')->with('error', $e->getMessage());
        }
        catch (Exception $e)
        {
            return to_route('client.index')->with('error', $e->getMessage());
        }
        catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e)
        {
            return to_route('client.index')->with('error', $e->getMessage());
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
        $Is_Edit = $Auth_User->HasPermission('Clients', 'Is_Edit');
        $Is_Delete = $Auth_User->HasPermission('Clients', 'Is_Delete');

        // Total records
        $queryRecords = Client::query();
        $totalRecords = $queryRecords->count();

        $Query = Client::orderby($columnName, $columnSortOrder);
        if (!empty($searchValue))
        {
            $Query->where(function($query) use($searchValue)
            {
                $query->where('Title', 'like', '%' .$searchValue . '%');
            });
        }

        $totalRecordswithFilter = $Query->count();
        $records = $Query->skip($start)->take($rowperpage)->get();

        $data_arr = array();
        $incKey = 0;
        foreach($records as $record)
        {
            $id = $record->id;
            $Random_Id = $record->Random_Id;
            $data_arr[$incKey]['id'] = $record->id;
            $data_arr[$incKey]['Title'] = !empty($record->Title) ? $record->Title : '';
            $data_arr[$incKey]['Status'] = !empty($record->Status) ? '<button type="button" data-status="active" class="btn btn-success status-button" data-id="'.$id.'">Active</button>' : '<button type="button" class="btn btn-danger status-button" data-id="'.$id.'" data-status="inactive">Inactive</button>';

            $actions = '<div class="col">';
                $actions .= '<div class="btn-group" role="group" aria-label="Basic example">';
                    if($Is_Edit)
                    {
                        $actions .= '<a href="'.route('client.edit',$Random_Id).'" class="btn btn-outline-secondary"><i class="bx bx-edit"></i>Edit</a>';
                    }

                    if($Is_Delete)
                    {
                        $actions .= '<a href="javascript:void(0);" onclick="Delete_Entity('.$id.')" class="btn btn-outline-secondary"><i class="bx bx-edit"></i>Delete</a>';
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
                'Title' => 'required|string|max:255',
                'File_Name' => 'required|file|mimes:jpeg,png,gif,bmp,webp|max:2048'
            ]);

            $validated_data['Status'] = (!empty($request->Status)) ? 1 : 0;
            $validated_data['File_Name'] = $this->handleFileUpload($request, 'File_Name', '/Uploads/Clients/');
            $create = Client::create($validated_data);
            return response()->json([
                'status' => 'success',
                'message' => 'Client created successfully!',
                'redirect' => redirect()->intended(route('client.index'))->getTargetUrl(),
            ], 200);
        }
        catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e)
        {
            return response()->json([
                'status' => 'error',
                'message' => 'An error occurred while store : ' . $e->getMessage(),
            ], 404);
        }
        catch (\Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException  $e)
        {
            return response()->json([
                'status' => 'error',
                'message' => 'An error occurred while store : ' . $e->getMessage(),
            ], 404);
        }
        catch (Exception $e)
        {
            return response()->json([
                'status' => 'error',
                'message' => 'An error occurred while store : ' . $e->getMessage(),
            ], 404);
        }
    }

    public function Update(Request $request)
    {
        try
        {
            $id = $Room_Id = $request->id;
            $validated_data = $request->validate([
                'Title' => 'required|string|max:255',
                'File_Name' => 'nullable|file|mimes:jpeg,png,gif,bmp,webp|max:2048',
            ]);

            $validated_data['Status'] = (!empty($request->Status)) ? 1 : 0;
            $entity = Client::findOrFail($id);
            $validated_data['File_Name'] = $this->handleFileUpload($request, 'File_Name', '/Uploads/Clients/', $entity->File_Name ?? '');
            $update = $entity->update($validated_data);

            return response()->json([
                'status' => 'success',
                'message' => 'Client updated successfully!',
                'redirect' => redirect()->intended(route('client.index'))->getTargetUrl(),
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

            $entity = Client::findOrFail($id);
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

    public function Destroy(Request $request)
    {
        try
        {
            $id = $request->id;
            $validated_data = $request->validate([
                'id' => 'required',
            ]);

            $entity = Client::findOrFail($id);
            $this->deleteFile('/Uploads/Blog_Categories/', $entity->File_Name ?? '');
            $validated_data['Is_Deleted'] = 1;
            $entity->update($validated_data);
            return response()->json([
                'status' => 'success',
                'message' => 'Deleted successfully!',
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