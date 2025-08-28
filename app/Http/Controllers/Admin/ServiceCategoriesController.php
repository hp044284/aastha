<?php
namespace App\Http\Controllers\Admin;
use Illuminate\Http\Request;
use App\Traits\FileUploadTrait;
use App\Models\ServiceCategory;
use App\Http\Controllers\Controller;

class ServiceCategoriesController extends Controller
{
    use FileUploadTrait;
    public function index(Request $request)
    {

        return view('Admin.service-categories.index');
    }

    public function create(Request $request)
    {
        return view('Admin.service-categories.create');
    }

    public function edit(Request $request, $Random_Id)
    {
        try
        {
            $entity = ServiceCategory::where('Random_Id',$Random_Id)->firstOrFail();
            return view('Admin.service-categories.edit',compact('entity'));
        }
        catch (\PDOException $e)
        {
            return to_route('service_category.index')->with('error', $e->getMessage());
        }
        catch (Exception $e)
        {
            return to_route('service_category.index')->with('error', $e->getMessage());
        }
        catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e)
        {
            return to_route('service_category.index')->with('error', $e->getMessage());
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
        $Is_Read = $Auth_User->HasPermission('Service_Sub_Categories', 'Is_Read');
        $Is_Edit = $Auth_User->HasPermission('Service_Categories', 'Is_Edit');
        $Is_Delete = $Auth_User->HasPermission('Service_Categories', 'Is_Delete');

        // Total records
        $queryRecords = ServiceCategory::query();
        $queryRecords->where('Parent_Id',0);
        $totalRecords = $queryRecords->count();

        $Query = ServiceCategory::orderby($columnName, $columnSortOrder);
        $Query->where('Parent_Id',0);
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

            $actions = '<div class="btn-group" role="group" aria-label="Actions">';
            // Edit button
            if ($Is_Edit) {
                $actions .= '<a href="' . route('service_category.edit', $Random_Id) . '" class="btn btn-primary btn-sm me-1" title="Edit">';
                $actions .= '<i class="bx bx-edit"></i>';
                $actions .= '</a>';
            }

            // Service Sub Category button (optional, keep as secondary action)
            if ($Is_Read) {
                $actions .= '<a href="' . route('service_sub_category.index', $Random_Id) . '" class="btn btn-secondary btn-sm me-1" title="Service Sub Category">';
                $actions .= '<i class="bx bx-list-ul"></i>';
                $actions .= '</a>';
            }

            // Delete button (form)
            if ($Is_Delete) {
                $actions .= '<form action="' . route('service_category.delete') . '" method="POST" style="display:inline-block;" onsubmit="return confirm(\'Are you sure you want to delete this service category?\');">';
                $actions .= csrf_field();
                $actions .= '<input type="hidden" name="id" value="' . $id . '">';
                $actions .= '<button type="submit" class="btn btn-danger btn-sm" title="Delete">';
                $actions .= '<i class="bx bx-trash"></i>';
                $actions .= '</button>';
                $actions .= '</form>';
            }

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

    public function store(Request $request)
    {
        try
        {
            $validated_data = $request->validate([
                'Icon' => 'required|string|max:255',
                'Title' => 'required|string|max:255',
                'Subtitle' => 'required|string|max:255',
                'File_Name' => 'nullable|file|mimes:jpeg,png,gif,bmp,webp|max:2048',
                'Meta_Title' => 'required|string|max:255',
                'Description' => 'nullable|string|max:1000',
                'Meta_Keyword' => 'required|string|max:255',
                'Canonical_Url' => 'nullable|url|max:255',
                'Meta_Description' => 'required|string|max:500',
            ]);

            $validated_data['Status'] = (!empty($request->Status)) ? 1 : 0;
            $validated_data['File_Name'] = $this->handleFileUpload($request, 'File_Name', '/Uploads/Service_Categories/');
            $create = ServiceCategory::create($validated_data);
            return response()->json([
                'status' => 'success',
                'message' => 'Product Category created successfully!',
                'redirect' => redirect()->intended(route('service_category.index'))->getTargetUrl(),
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

    public function update(Request $request)
    {
        try
        {
            $id = $Room_Id = $request->id;
            $validated_data = $request->validate([
                'Icon' => 'required|string|max:255',
                'Title' => 'required|string|max:255',
                'Subtitle' => 'required|string|max:255',
                'File_Name' => 'nullable|file|mimes:jpeg,png,gif,bmp,webp|max:2048',
                'Meta_Title' => 'required|string|max:255',
                'Description' => 'nullable|string|max:1000',
                'Canonical_Url' => 'nullable|url|max:255',
                'Meta_Keyword' => 'required|string|max:255',
                'Meta_Description' => 'required|string|max:500',
            ]);

            $validated_data['Status'] = (!empty($request->Status)) ? 1 : 0;
            $entity = ServiceCategory::findOrFail($id);
            if ($request->hasFile('File_Name'))
            {
                $validated_data['File_Name'] = $this->handleFileUpload($request, 'File_Name', '/Uploads/Service_Categories/', $entity->File_Name ?? '');
            }
            $update = $entity->update($validated_data);

            return response()->json([
                'status' => 'success',
                'message' => 'Service Category updated successfully!',
                'redirect' => redirect()->intended(route('service_category.index'))->getTargetUrl(),
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

    public function status(Request $request)
    {
        try
        {
            $id = $request->id;
            $validated_data = $request->validate([
                'Status' => 'required|in:1,0',
            ]);

            $entity = ServiceCategory::findOrFail($id);
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

    public function destroy(Request $request)
    {
        try
        {
            $id = $request->id;
            $validated_data = $request->validate([
                'id' => 'required',
            ]);

            $entity = ServiceCategory::findOrFail($id);
            $this->deleteFile('/Uploads/Service_Categories/', $entity->File_Name ?? '');
            $validated_data['Is_Deleted'] = 1;
            $entity->update($validated_data);
            return back()->with('success', 'Deleted successfully!');
        }
        catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e)
        {
            return back()->with('error', 'An error occurred while deleting the service category: ' . $e->getMessage());
        }
        catch (\Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException  $e)
        {
            return back()->with('error', 'An error occurred while deleting the service category: ' . $e->getMessage());
        }
        catch (Exception $e)
        {
            return back()->with('error', 'An error occurred while deleting the service category: ' . $e->getMessage());
        }
    }

    public function axiosServiceSubCategory(Request $request)
    {
        try
        {
            $validated_data = $request->validate([
                'Product_Cat_Id' => 'required',
            ]);

            $Product_Cat_Id = $request->Product_Cat_Id;

            $entities = ServiceCategory::where('Parent_Id',$Product_Cat_Id)->pluck('Title','id')->toArray();
            return response()->json([
                'status' => 'success',
                'message' => 'Service Sub Category successfully!',
                'entities' => $entities,
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