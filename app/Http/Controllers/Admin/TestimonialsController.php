<?php
namespace App\Http\Controllers\Admin;
use App\Models\Testimonial;
use Illuminate\Http\Request;
use App\Traits\FileUploadTrait;
use App\Http\Controllers\Controller;

class TestimonialsController extends Controller
{
    use FileUploadTrait;
    public function Index(Request $request)
    {
        return view('Admin.Testimonials.Index');
    }

    public function Create(Request $request)
    {
        return view('Admin.Testimonials.Create');
    }

    public function Edit(Request $request, $Random_Id)
    {
        try
        {
            $entity = Testimonial::where('Random_Id',$Random_Id)->firstOrFail();
            return view('Admin.Testimonials.Edit',compact('entity'));
        }
        catch (\PDOException $e)
        {
            return to_route('testimonial.index')->with('error', $e->getMessage());
        }
        catch (Exception $e)
        {
            return to_route('testimonial.index')->with('error', $e->getMessage());
        }
        catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e)
        {
            return to_route('testimonial.index')->with('error', $e->getMessage());
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
        $Is_Edit = $Auth_User->HasPermission('Testimonials', 'Is_Edit');
        $Is_Delete = $Auth_User->HasPermission('Testimonials', 'Is_Delete');

        // Total records
        $queryRecords = Testimonial::query();
        $totalRecords = $queryRecords->count();

        $Query = Testimonial::orderby($columnName, $columnSortOrder);
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
            $data_arr[$incKey]['Last_Name'] = !empty($record->Last_Name) ? $record->Last_Name : '';
            $data_arr[$incKey]['First_Name'] = !empty($record->First_Name) ? $record->First_Name : '';
            $data_arr[$incKey]['Status'] = !empty($record->Status) ? '<button type="button" data-status="active" class="btn btn-success status-button" data-id="'.$id.'">Active</button>' : '<button type="button" class="btn btn-danger status-button" data-id="'.$id.'" data-status="inactive">Inactive</button>';

            $actions = '<div class="col">';
                $actions .= '<div class="btn-group" role="group" aria-label="Basic example">';
                    if($Is_Edit)
                    {
                        $actions .= '<a href="'.route('testimonial.edit',$Random_Id).'" class="btn btn-outline-secondary"><i class="bx bx-edit"></i>Edit</a>';
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
                'Position' => 'nullable|string|max:255',
                'File_Name' => 'nullable|file|mimes:jpeg,png,gif,bmp,webp|max:2048',
                'Last_Name' => 'required|string|max:255',
                'First_Name' => 'required|string|max:255',
                'Message' => ['nullable', 'string', 'max:1000', function ($attribute, $value, $fail)
                {
                    if (str_word_count($value) > 20)
                    {
                        $fail('The ' . $attribute . ' may not be greater than 20 words.');
                    }
                }],
            ]);

            $validated_data['Status'] = (!empty($request->Status)) ? 1 : 0;
            $validated_data['File_Name'] = $this->handleFileUpload($request, 'File_Name', '/Uploads/Testimonials/');
            $create = Testimonial::create($validated_data);
            return response()->json([
                'status' => 'success',
                'message' => 'Testimonial created successfully!',
                'redirect' => redirect()->intended(route('testimonial.index'))->getTargetUrl(),
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
                'Position' => 'nullable|string|max:255',
                'File_Name' => 'nullable|file|mimes:jpeg,png,gif,bmp,webp|max:2048',
                'First_Name' => 'required|string|max:255',
                'Last_Name' => 'required|string|max:255',
                'Message' => ['nullable', 'string', 'max:1000', function ($attribute, $value, $fail)
                {
                    if (str_word_count($value) > 20)
                    {
                        $fail('The ' . $attribute . ' may not be greater than 20 words.');
                    }
                }],
            ]);

            $validated_data['Status'] = (!empty($request->Status)) ? 1 : 0;
            $entity = Testimonial::findOrFail($id);
            if ($request->hasFile('File_Name'))
            {
                $validated_data['File_Name'] = $this->handleFileUpload($request, 'File_Name', '/Uploads/Testimonials/', $entity->File_Name ?? '');
            }
            $update = $entity->update($validated_data);

            return response()->json([
                'status' => 'success',
                'message' => 'Testimonial updated successfully!',
                'redirect' => redirect()->intended(route('testimonial.index'))->getTargetUrl(),
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

            $entity = Testimonial::findOrFail($id);
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

            $entity = Testimonial::findOrFail($id);
            $this->deleteFile('/Uploads/Testimonials/', $entity->File_Name ?? '');
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