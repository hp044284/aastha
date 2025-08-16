<?php
namespace App\Http\Controllers\Admin;
use App\Models\Review;
use Illuminate\Http\Request;
use App\Traits\FileUploadTrait;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class ReviewsController extends Controller
{
    use FileUploadTrait;
    public function Index(Request $request)
    {

        return view('Admin.Reviews.Index');
    }

    public function Create(Request $request)
    {
        return view('Admin.Reviews.Create');
    }

    public function Edit(Request $request, $Random_Id)
    {
        try
        {
            $entity = Review::where('Random_Id',$Random_Id)->firstOrFail();
            return view('Admin.Reviews.Edit',compact('entity'));
        }
        catch (\PDOException $e)
        {
            return to_route('review.index')->with('error', $e->getMessage());
        }
        catch (Exception $e)
        {
            return to_route('review.index')->with('error', $e->getMessage());
        }
        catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e)
        {
            return to_route('review.index')->with('error', $e->getMessage());
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
        $Is_Edit = $Auth_User->HasPermission('Reviews', 'Is_Edit');
        $Is_Delete = $Auth_User->HasPermission('Reviews', 'Is_Delete');

        // Total records
        $queryRecords = Review::query();
        $queryRecords->where('Parent_Id',0);
        $totalRecords = $queryRecords->count();

        $Query = Review::orderby($columnName, $columnSortOrder);
        $Query->with('Children');
        $Query->where('Parent_Id',0);
        if (!empty($searchValue))
        {
            $Query->where(function($query) use($searchValue)
            {
                $query->where('Name', 'like', '%' .$searchValue . '%')->orWhere('Email', 'like', '%' .$searchValue . '%');
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
            $data_arr[$incKey]['Name'] = !empty($record->Name) ? $record->Name : '';
            $data_arr[$incKey]['Email'] = !empty($record->Email) ? $record->Email : '';
            $data_arr[$incKey]['Status'] = !empty($record->Status) ? '<button type="button" data-status="active" class="btn btn-success status-button" data-id="'.$id.'">Active</button>' : '<button type="button" class="btn btn-danger status-button" data-id="'.$id.'" data-status="inactive">Inactive</button>';
            $data_arr[$incKey]['Review_Type'] = !empty($record->Review_Type) ? $record->Review_Type : '';
            $data_arr[$incKey]['Review_Status'] = !empty($record->Review_Status) ? $record->Review_Status : '';

            $actions = '<div class="col">';
                $actions .= '<div class="btn-group" role="group" aria-label="Basic example">';

                    if($Is_Edit)
                    {
                        if(isset($record->Review_Status) && $record->Review_Status == "Pending")
                        {
                            $actions .= '<a href="javascript:void(0);" onclick="Approve_Or_Reject('.$id.', \'Approved\',\''.addslashes($record->Review_Type).'\')" class="btn btn-outline-success"><i class="bx bx-check"></i>Approved</a>';
                            $actions .= '<a href="javascript:void(0);" onclick="Approve_Or_Reject('.$id.',\'Rejected\',\''.addslashes($record->Review_Type).'\')" class="btn btn-outline-danger"><i class="bx bx-x"></i>Rejected</a>';
                        }
                        $actions .= '<a href="javascript:void(0);" onclick="Reply_Review('.$id.')" class="btn btn-outline-primary"><i class="bx bx-reply"></i>Reply</a>';
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
            $create = Review::create($validated_data);
            return response()->json([
                'status' => 'success',
                'message' => 'Testimonial created successfully!',
                'redirect' => redirect()->intended(route('testimonial.Index'))->getTargetUrl(),
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
            $entity = Review::findOrFail($id);
            $validated_data['File_Name'] = $this->handleFileUpload($request, 'File_Name', '/Uploads/Testimonials/', $entity->File_Name ?? '');
            $update = $entity->update($validated_data);

            return response()->json([
                'status' => 'success',
                'message' => 'Testimonial updated successfully!',
                'redirect' => redirect()->intended(route('testimonial.Index'))->getTargetUrl(),
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

            $entity = Review::findOrFail($id);
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

            $entity = Review::findOrFail($id);
            $this->deleteFile('/Uploads/Testimonials/', $entity->File_Name ?? '');
            $validated_data['Is_Deleted'] = 1;
            $entity->update($validated_data);
            if ($entity->Review_Type == 'Product')
            {
                $Product_Id = $entity->Product_Id ?? 0;
                $productStats = Review::where('Review_Type', 'Product')
                ->where('Product_Id', $Product_Id)
                ->selectRaw('AVG(Rating) as Avg_Rating, COUNT(*) as Review_Count')
                ->first();

                \App\Models\Product::where('id',$Product_Id)->update([
                    "Avg_Rating" => $productStats->Avg_Rating,
                    "Review_Count" => $productStats->Review_Count,
                ]);
            }
            else
            {
                $Blog_Id = $entity->Blog_Id ?? 0;
                $Review_Count = Review::where('Review_Type','Blog')->where('Blog_Id',$Blog_Id)->count();
                \App\Models\Blog::where('id',$Product_Id)->update([
                    "Review_Count" => $Review_Count
                ]);
            }
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

    public function Axios_Approve_Reject(Request $request)
    {
        try
        {
            $id = $request->id;
            $validated_data = $request->validate([
                'id' => 'required',
                'Review_Status' => 'required',
            ]);
            $entity = Review::findOrFail($id);
            $validated_data['Review_Type'] = $request->Review_Type;
            $validated_data['Review_Status'] = $request->Review_Status;
            $entity->update($validated_data);
            if ($entity->Review_Type == 'Product' && $request->Review_Status == "Approved")
            {
                $Product_Id = $entity->Product_Id ?? 0;
                // $Review_Count = Review::where('Review_Type','Product')->where('Product_Id',$Product_Id)->count();
                $productStats = Review::where('Review_Type', 'Product')
                ->where('Product_Id', $Product_Id)
                ->where('Review_Status', 'Approved')
                ->selectRaw('AVG(Rating) as Avg_Rating, COUNT(*) as Review_Count')
                ->first();

                \App\Models\Product::where('id',$Product_Id)->update([
                    "Avg_Rating" => $productStats->Avg_Rating,
                    "Review_Count" => $productStats->Review_Count,
                ]);
            }
            else if($entity->Review_Type == 'Blog' && $request->Review_Status == "Approved")
            {
                $Blog_Id = $entity->Blog_Id ?? 0;
                $Review_Count = Review::where('Review_Type','Blog')->where('Blog_Id',$Blog_Id)->count();
                \App\Models\Blog::where('id',$Product_Id)->update([
                    "Review_Count" => $Review_Count
                ]);
            }
            return response()->json([
                'status' => 'success',
                'message' => $request->Review_Status.' successfully!',
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

    public function Reply_Review(Request $request)
    {
        try
        {
            $id = $request->id;
            $validated_data = $request->validate([
                'id' => 'required',
                'Message' => 'required',
            ]);
            $entity = Review::where('id',$id)->first();
            $Review_Entity = Review::where('Parent_Id',$id)->first();

            $Auth_User = Auth::user();
            if (!empty($Review_Entity))
            {
                $requestData = $request->only(['Message']);
                $Review_Entity->update($requestData);
            }
            else
            {
                Review::create([
                    "Name" => $Auth_User->first_name ?? '',
                    "Email" => $Auth_User->email ?? '',
                    "Message" => $request->Message ?? '',
                    "Blog_Id" => $entity->Blog_Id ?? '',
                    "Parent_Id" => $id ?? '',
                    "Review_Status" => 'Approved',
                ]);

            }
            return response()->json([
                'status' => 'success',
                'message' => 'Reply successfully!',
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