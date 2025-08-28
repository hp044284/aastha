<?php
namespace App\Http\Controllers\Admin;
use App\Models\Slider;
use Illuminate\Http\Request;
use App\Traits\FileUploadTrait;
use App\Http\Controllers\Controller;

class SlidersController extends Controller
{
    use FileUploadTrait;
    public function Index(Request $request)
    {
        return view('Admin.sliders.index');
    }

    public function Create(Request $request)
    {
        return view('Admin.sliders.create');
    }

    public function Edit(Request $request, $Random_Id)
    {
        try
        {
            $entity = Slider::where('Random_Id',$Random_Id)->firstOrFail();
            return view('Admin.sliders.edit',compact('entity'));
        }
        catch (\PDOException $e)
        {
            return to_route('slider.index')->with('error', $e->getMessage());
        }
        catch (Exception $e)
        {
            return to_route('slider.index')->with('error', $e->getMessage());
        }
        catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e)
        {
            return to_route('slider.index')->with('error', $e->getMessage());
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
        $Is_Edit = $Auth_User->HasPermission('Sliders', 'Is_Edit');
        $Is_Delete = $Auth_User->HasPermission('Sliders', 'Is_Delete');

        // Total records
        $queryRecords = Slider::query();
        $totalRecords = $queryRecords->count();

        $Query = Slider::orderby($columnName, $columnSortOrder);
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
                $actions .= '<a href="' . route('slider.edit', $Random_Id) . '" class="btn btn-primary btn-sm me-1" title="Edit">
                    <i class="bx bx-edit"></i>
                </a>';
            }
            // Delete button (form)
            if ($Is_Delete) {
                $actions .= '<form action="' . route('slider.delete') . '" method="POST" style="display:inline-block;" onsubmit="return confirm(\'Are you sure you want to delete this slider?\');">';
                $actions .= csrf_field();
                $actions .= '<input type="hidden" name="id" value="' . $id . '">';
                $actions .= '<button type="submit" class="btn btn-danger btn-sm" title="Delete">
                    <i class="bx bx-trash"></i>
                </button>';
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

    public function Store(Request $request)
    {
        try
        {
            $validated_data = $request->validate([
                'Title' => 'required|string|max:255',
                'Sub_Title' => 'required|string|max:255',
                'File_Name' => [
                    'required',
                    'file',
                    'mimes:jpeg,png,gif,bmp,webp',
                    'max:2048',
                    'dimensions:width=565,height=465',
                ],
                'Slider_Url' => 'required|url|max:255',
                'Short_Description' => 'required|string|max:1000',
            ],
            [
                'File_Name.dimensions' => 'The uploaded image must have dimensions of 565x465 pixels.',
            ]
            );

            $validated_data['Status'] = (!empty($request->Status)) ? 1 : 0;
            $validated_data['File_Name'] = $this->handleFileUpload($request, 'File_Name', '/Uploads/Sliders/');
            $create = Slider::create($validated_data);

            return response()->json([
                'status' => 'success',
                'message' => 'Slider created successfully!',
                'redirect' => redirect()->intended(route('slider.index'))->getTargetUrl(),
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
            $id = $request->id;
            $validated_data = $request->validate([
                'Title' => 'required|string|max:255',
                'Sub_Title' => 'required|string|max:255',
                'File_Name' => [
                    'nullable',
                    'file',
                    'mimes:jpeg,png,gif,bmp,webp',
                    'max:2048',
                    'dimensions:width=565,height=465',
                ],
                'Slider_Url' => 'required|url|max:255',
                'Short_Description' => 'required|string|max:1000',
            ],
            [
                'File_Name.dimensions' => 'The uploaded image must have dimensions of 565x465 pixels.',
            ]
            );

            $validated_data['Status'] = (!empty($request->Status)) ? 1 : 0;
            $entity = Slider::findOrFail($id);
            if ($request->hasFile('File_Name'))
            {
                $validated_data['File_Name'] = $this->handleFileUpload($request, 'File_Name', '/Uploads/Sliders/', $entity->File_Name ?? '');
            }
            $update = $entity->update($validated_data);
            return response()->json([
                'status' => 'success',
                'message' => 'Slider updated successfully!',
                'redirect' => redirect()->intended(route('slider.index'))->getTargetUrl(),
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

            $entity = Slider::findOrFail($id);
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

            $entity = Slider::findOrFail($id);
            $this->deleteFile('/Uploads/Sliders/', $entity->File_Name ?? '');
            $validated_data['Is_Deleted'] = 1;
            $entity->update($validated_data);

            return back()->with('success', 'Slider deleted successfully!');
        }
        catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e)
        {
            return back()->with('error', 'An error occurred while deleting the slider: ' . $e->getMessage());
        }
        catch (\Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException  $e)
        {
            return back()->with('error', 'An error occurred while deleting the slider: ' . $e->getMessage());
        }
        catch (Exception $e)
        {
            return back()->with('error', 'An error occurred while deleting the slider: ' . $e->getMessage());
        }
    }
}
?>