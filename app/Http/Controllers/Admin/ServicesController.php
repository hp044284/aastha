<?php
namespace App\Http\Controllers\Admin;
use App\Models\Service;
use Illuminate\Http\Request;
use App\Models\ServiceCategory;
use App\Traits\FileUploadTrait;
use Illuminate\Support\Facades\File;
use App\Http\Controllers\Controller;

class ServicesController extends Controller
{
    use FileUploadTrait;
    public function Index(Request $request)
    {
        return view('Admin.Services.Index');
    }

    public function Create(Request $request)
    {
        $sub_categories = ServiceCategory::where('Parent_Id',0)->pluck('Title','id')->toArray();
        
        return view('Admin.Services.Create',compact('sub_categories'));
    }

    public function Edit(Request $request, $Random_Id)
    {
        try
        {
            $entity = Service::where('Random_Id',$Random_Id)->firstOrFail();
            $sub_categories = ServiceCategory::where('Parent_Id',0)->pluck('Title','id')->toArray();

            return view('Admin.Services.Edit',compact('entity','sub_categories'));
        }
        catch (\PDOException $e)
        {
            return to_route('service.index')->with('error', $e->getMessage());
        }
        catch (Exception $e)
        {
            return to_route('service.index')->with('error', $e->getMessage());
        }
        catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e)
        {
            return to_route('service.index')->with('error', $e->getMessage());
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
        $Is_Edit = $Auth_User->HasPermission('Services', 'Is_Edit');
        $Is_Delete = $Auth_User->HasPermission('Services', 'Is_Delete');

        // Total records
        $queryRecords = Service::query();
        $totalRecords = $queryRecords->count();

        $Query = Service::with('ServiceCategory')->orderby($columnName, $columnSortOrder);
        if (!empty($searchValue))
        {
            $Query->where(function($query) use($searchValue)
            {
                $query->where('Title', 'like', '%' .$searchValue . '%')
                ;
            });
        }

        $totalRecordswithFilter = $Query->count();
        $records = $Query->skip($start)->take($rowperpage)->get();
        // echo '<pre>';
        // print_r($records);
        // die;
        $data_arr = array();
        $incKey = 0;
        foreach($records as $record)
        {
            $id = $record->id;
            $Random_Id = $record->Random_Id;
            $data_arr[$incKey]['id'] = $record->id;
            $data_arr[$incKey]['Title'] = !empty($record->Title) ? $record->Title : '';
            $data_arr[$incKey]['Status'] = !empty($record->Status) ? '<button type="button" data-status="active" class="btn btn-success status-button" data-id="'.$id.'">Active</button>' : '<button type="button" class="btn btn-danger status-button" data-id="'.$id.'" data-status="inactive">Inactive</button>';
            $data_arr[$incKey]['Category_Id'] = !empty($record->ServiceCategory->Title) ? $record->ServiceCategory->Title : '';

            $actions = '<div class="col">';
                $actions .= '<div class="btn-group" role="group" aria-label="Basic example">';
                    if($Is_Edit)
                    {
                        $actions .= '<a href="'.route('service.edit',$Random_Id).'" class="btn btn-outline-secondary"><i class="bx bx-edit"></i>Edit</a>';
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
                'Tags' => 'nullable|string',
                'Title' => 'required|string|max:255',
                'File_Name' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
                'Meta_Title' => 'nullable|string|max:255',
                'Description' => 'nullable|string',
                'Category_Id' => 'required|integer|exists:service_categories,id',
                'Meta_Description' => 'nullable|string',
                'Short_Description' => 'nullable|string',
                'Aditional_Description' => 'nullable|string',
                'Sub_Category_Id' => 'nullable|integer|exists:service_categories,id',
            ]);

            $filtered = $request->only(['Tags','Meta_Title','Description','Title','Meta_Description','Short_Description','Category_Id','Aditional_Description','Sub_Category_Id']);
            $filtered['Status'] = (!empty($request->Status)) ? 1 : 0;
            $filtered['File_Name'] = $this->handleFileUpload($request, 'File_Name', '/Uploads/Services/');
            $create = Service::create($filtered);
            return response()->json([
                'status' => 'success',
                'message' => 'Service created successfully!',
                'redirect' => redirect()->intended(route('service.index'))->getTargetUrl(),
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
            $id = $Product_Id = $request->id;
            $validated_data = $request->validate([
                'Tags' => 'nullable|string',
                'Title' => 'required|string|max:255',
                'File_Name' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
                'Meta_Title' => 'nullable|string|max:255',
                'Category_Id' => 'required|integer|exists:service_categories,id',
                'Description' => 'nullable|string',
                'Sub_Category_Id' => 'nullable|integer|exists:service_categories,id',
                'Meta_Description' => 'nullable|string',
                'Short_Description' => 'nullable|string',
                'Aditional_Description' => 'nullable|string',
            ]);

            $entity = Service::findOrFail($id);
            $filtered = $request->only(['Tags','Meta_Title','Description','Title','Meta_Description','Short_Description','Category_Id','Aditional_Description','Sub_Category_Id']);
            $filtered['Status'] = (!empty($request->Status)) ? 1 : 0;
            if ($request->hasFile('File_Name'))
            {
                $filtered['File_Name'] = $this->handleFileUpload($request, 'File_Name', '/Uploads/Services/',$entity->File_Name ?? '');
            }

            $update = $entity->update($filtered);

            return response()->json([
                'status' => 'success',
                'message' => 'Service updated successfully!',
                'redirect' => redirect()->intended(route('service.index'))->getTargetUrl(),
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

            $entity = Service::findOrFail($id);
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

    public function Delete(Request $request)
    {
        try
        {
            $id = $request->id;
            $validated_data = $request->validate([
                'id' => 'required',
            ]);

            $entity = Service::findOrFail($id);
            $this->deleteFile('/Uploads/Services/', $entity->File_Name ?? '');
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