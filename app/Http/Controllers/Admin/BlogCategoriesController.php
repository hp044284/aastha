<?php
namespace App\Http\Controllers\Admin;
use Illuminate\Http\Request;
use App\Models\BlogCategory;
use App\Traits\FileUploadTrait;
use App\Http\Controllers\Controller;

class BlogCategoriesController extends Controller
{
    use FileUploadTrait;
    public function index(Request $request)
    {

        return view('Admin.blog-categories.index');
    }

    public function create(Request $request)
    {
        return view('Admin.blog-categories.create');
    }

    public function edit(Request $request, $Random_Id)
    {
        try
        {
            $entity = BlogCategory::where('Random_Id',$Random_Id)->firstOrFail();
            return view('Admin.blog-categories.edit',compact('entity'));
        }
        catch (\PDOException $e)
        {
            return to_route('blog_category.index')->with('error', $e->getMessage());
        }
        catch (Exception $e)
        {
            return to_route('blog_category.index')->with('error', $e->getMessage());
        }
        catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e)
        {
            return to_route('blog_category.index')->with('error', $e->getMessage());
        }
    }

    public function axiosRecord(Request $request)
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
        $Is_Read = $Auth_User->HasPermission('Blog_Sub_Categories', 'Is_Read');
        $Is_Edit = $Auth_User->HasPermission('Blog_Categories', 'Is_Edit');
        $Is_Delete = $Auth_User->HasPermission('Blog_Categories', 'Is_Delete');

        // Total records
        $queryRecords = BlogCategory::query();
        $queryRecords->where('Parent_Id',0);
        $totalRecords = $queryRecords->count();

        $Query = BlogCategory::orderby($columnName, $columnSortOrder);
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
            // Show button
            // $actions .= '<button type="button" onclick="showBlogCategoryOffcanvas(' . $id . ')" class="btn btn-info btn-sm me-1" title="Show">';
            // $actions .= '<i class="bx bx-show"></i>';
            // $actions .= '</button>';

            // Edit button
            if ($Is_Edit) {
                $actions .= '<a href="' . route('blog_category.edit', $Random_Id) . '" class="btn btn-primary btn-sm me-1" title="Edit">';
                $actions .= '<i class="bx bx-edit"></i>';
                $actions .= '</a>';
            }

            // Delete button (form)
            if ($Is_Delete) {
                $actions .= '<form action="' . route('blog_category.delete', $id) . '" method="POST" style="display:inline-block;" onsubmit="return confirm(\'Are you sure you want to delete this blog category?\');">';
                $actions .= csrf_field();
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
                'Title' => 'required|string|max:255',
                'File_Name' => 'nullable|file|mimes:jpeg,png,gif,bmp,webp|max:2048',
                'Meta_Title' => 'required|string|max:255',
                'Description' => 'nullable|string',
                'Meta_Keyword' => 'required|string',
                'Canonical_Url' => 'nullable|url|max:255',
                'Meta_Description' => 'required|string|max:500',
            ]);

            $validated_data['Status'] = (!empty($request->Status)) ? 1 : 0;
            $validated_data['File_Name'] = $this->handleFileUpload($request, 'File_Name', '/Uploads/Blog_Categories/');

            $create = BlogCategory::create($validated_data);
            return response()->json([
                'status' => 'success',
                'message' => 'Blog Category created successfully!',
                'redirect' => redirect()->intended(route('blog_category.index'))->getTargetUrl(),
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
                'Title' => 'required|string|max:255',
                'Meta_Title' => 'required|string|max:255',
                'Description' => 'nullable|string',
                'Meta_Keyword' => 'required|string',
                'Canonical_Url' => 'nullable|url|max:255',
                'Meta_Description' => 'required|string|max:500',
                'File_Name' => 'nullable|file|mimes:jpeg,png,gif,bmp,webp|max:2048',
            ]);

            $validated_data['Status'] = (!empty($request->Status)) ? 1 : 0;
            $entity = BlogCategory::findOrFail($id);
            if ($request->hasFile('File_Name'))
            {
                $validated_data['File_Name'] = $this->handleFileUpload($request, 'File_Name', '/Uploads/Blog_Categories/', $entity->File_Name ?? '');
            }
            $update = $entity->update($validated_data);

            return response()->json([
                'status' => 'success',
                'message' => 'Blog Category updated successfully!',
                'redirect' => redirect()->intended(route('blog_category.index'))->getTargetUrl(),
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

            $entity = BlogCategory::findOrFail($id);
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

            $entity = BlogCategory::findOrFail($id);
            $this->deleteFile('/Uploads/Blog_Categories/', $entity->File_Name ?? '');
            $validated_data['Is_Deleted'] = 1;
            $entity->update($validated_data);
            return back()->with('success', 'The blog category has been deleted successfully.');
        }
        catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e)
        {
            return back()->with('error', 'A system error occurred while processing your request. Please try again or contact support if the issue persists.');
        }
        catch (\Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException  $e)
        {
            return back()->with('error', 'A system error occurred while processing your request. Please try again or contact support if the issue persists.');
        }
        catch (Exception $e)
        {
            return back()->with('error', 'A system error occurred while processing your request. Please try again or contact support if the issue persists.');
        }
    }

    public function Axios_Product_Sub_Category(Request $request)
    {
        try
        {
            $validated_data = $request->validate([
                'Product_Cat_Id' => 'required',
            ]);

            $Product_Cat_Id = $request->Product_Cat_Id;

            $entities = BlogCategory::where('Parent_Id',$Product_Cat_Id)->pluck('Title','id')->toArray();
            return response()->json([
                'status' => 'success',
                'message' => 'Product Sub Category successfully!',
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

    public function Axios_Blog_Sub_Category(Request $request)
    {
        try
        {
            $validated_data = $request->validate([
                'Blog_Cat_Id' => 'required',
            ]);

            $Blog_Cat_Id = $request->Blog_Cat_Id;

            $entities = BlogCategory::where('Parent_Id',$Blog_Cat_Id)->pluck('Title','id')->toArray();
            return response()->json([
                'status' => 'success',
                'message' => 'Product Sub Category successfully!',
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