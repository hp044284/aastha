<?php
namespace App\Http\Controllers\Admin;
use App\Models\Blog;
use App\Models\Tag;
use App\Models\BlogTag;
use App\Models\BlogCategory;
use Illuminate\Http\Request;
use App\Traits\FileUploadTrait;
use App\Http\Controllers\Controller;

class BlogsController extends Controller
{
    use FileUploadTrait;
    public function index(Request $request)
    {

        return view('Admin.blogs.index');
    }

    public function create(Request $request)
    {
        $Blog_Categories = BlogCategory::where('Parent_Id',0)->where('Status',1)->pluck('Title','id');
        return view('Admin.blogs.create',compact('Blog_Categories'));
    }

    public function edit(Request $request, $Random_Id)
    {
        try
        {
            $entity = Blog::where('Random_Id',$Random_Id)->firstOrFail();
            $Blog_Categories = BlogCategory::where('Parent_Id',0)->where('Status',1)->pluck('Title','id');
            return view('Admin.blogs.edit',compact('entity','Blog_Categories'));
        }
        catch (\PDOException $e)
        {
            return to_route('blog.index')->with('error', $e->getMessage());
        }
        catch (Exception $e)
        {
            return to_route('blog.index')->with('error', $e->getMessage());
        }
        catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e)
        {
            return to_route('blog.index')->with('error', $e->getMessage());
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
        $Is_Edit = $Auth_User->HasPermission('Blogs', 'Is_Edit');
        $Is_Delete = $Auth_User->HasPermission('Blogs', 'Is_Delete');

        // Total records
        $queryRecords = Blog::query();
        $totalRecords = $queryRecords->count();

        $Query = Blog::orderby($columnName, $columnSortOrder);
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
            // $actions .= '<button type="button" onclick="showBlogOffcanvas(' . $id . ')" class="btn btn-info btn-sm me-1" title="Show">';
            // $actions .= '<i class="bx bx-show"></i>';
            // $actions .= '</button>';

            // Edit button
            if ($Is_Edit) {
                $actions .= '<a href="' . route('blog.edit', $Random_Id) . '" class="btn btn-primary btn-sm me-1" title="Edit">';
                $actions .= '<i class="bx bx-edit"></i>';
                $actions .= '</a>';
            }

            // Delete button (form)
            if ($Is_Delete) {
                $actions .= '<form action="' . route('blog.delete', $id) . '" method="POST" style="display:inline-block;" onsubmit="return confirm(\'Are you sure you want to delete this blog?\');">';
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
                'Tags' => 'nullable|string|max:500',
                'Title' => 'required|string|max:255',
                'File_Name' => 'nullable|file|mimes:jpeg,png,gif,bmp,webp|max:2048',
                'Meta_Title' => 'required|string|max:255',
                'Description' => 'nullable|string',
                'Meta_Keyword' => 'required|string',
                'Blog_Cat_Id' => 'required',
                'Canonical_Url' => 'nullable|url|max:255',
                'Blog_Sub_Cat_Id' => 'nullable',
                'Meta_Description' => 'required|string|max:500',
            ]);

            

            $validated_data['Status'] = (!empty($request->Status)) ? 1 : 0;
            $validated_data['File_Name'] = $this->handleFileUpload($request, 'File_Name', '/Uploads/Blogs/');
            $create = Blog::create($validated_data);
            if ($create)
            {
                $Blog_Cat_Id = $request->Blog_Cat_Id;
                $Total_Blog = Blog::where('Blog_Cat_Id',$Blog_Cat_Id)->count();
                BlogCategory::where('id',$Blog_Cat_Id)->update(['Total_Blog' => $Total_Blog]);

                $tags = explode(',', $validated_data['Tags']);
                $tag_ids = [];
                foreach ($tags as $tag) 
                {
                    $tag_ids[] = Tag::firstOrCreate(['name' => trim($tag)])->id;
                }

                $create->tags()->sync($tag_ids);

            }
            return response()->json([
                'status' => 'success',
                'message' => 'Blog created successfully!',
                'redirect' => redirect()->intended(route('blog.index'))->getTargetUrl(),
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
                'Tags' => 'nullable|string|max:500',
                'Title' => 'required|string|max:255',
                'File_Name' => 'nullable|file|mimes:jpeg,png,gif,bmp,webp|max:2048',
                'Meta_Title' => 'required|string|max:255',
                'Description' => 'nullable|string',
                'Blog_Cat_Id' => 'required',
                'Meta_Keyword' => 'required|string',
                'Canonical_Url' => 'nullable|url|max:255',
                'Blog_Sub_Cat_Id' => 'nullable',
                'Meta_Description' => 'required|string|max:500',
            ]);

            $validated_data['Status'] = (!empty($request->Status)) ? 1 : 0;
            $entity = Blog::findOrFail($id);
            if ($request->hasFile('File_Name'))
            {
                $validated_data['File_Name'] = $this->handleFileUpload($request, 'File_Name', '/Uploads/Blogs/', $entity->File_Name ?? '');
            }
            $update = $entity->update($validated_data);
            if ($update)
            {
                $Blog_Cat_Id = $request->Blog_Cat_Id;
                $Total_Blog = Blog::where('Blog_Cat_Id',$Blog_Cat_Id)->count();
                BlogCategory::where('id',$Blog_Cat_Id)->update(['Total_Blog' => $Total_Blog]);

                $tags = explode(',', $validated_data['Tags']);
                $tag_ids = [];
                foreach ($tags as $tag) 
                {
                    $tag_ids[] = Tag::firstOrCreate(['name' => trim($tag)])->id;
                }
                $entity->tags()->sync($tag_ids);
            }
            return response()->json([
                'status' => 'success',
                'message' => 'Blog updated successfully!',
                'redirect' => redirect()->intended(route('blog.index'))->getTargetUrl(),
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

            $entity = Blog::findOrFail($id);
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

            $entity = Blog::findOrFail($id);
            $this->deleteFile('/Uploads/Blogs/', $entity->File_Name ?? '');
            $validated_data['Is_Deleted'] = 1;
            $entity->update($validated_data);
            return redirect()->back()->with('success', 'Deleted successfully!');
        }
        catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e)
        {
            return redirect()->back()->with('error', 'An error occurred while updating the profile : ' . $e->getMessage());
        }
        catch (\Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException  $e)
        {
            return redirect()->back()->with('error', 'An error occurred while updating the profile : ' . $e->getMessage());
        }
        catch (Exception $e)
        {
            return redirect()->back()->with('error', 'An error occurred while updating the profile : ' . $e->getMessage());
        }
    }

    public function axiosProductSubCategory(Request $request)
    {
        try
        {
            $validated_data = $request->validate([
                'Product_Cat_Id' => 'required',
            ]);

            $Product_Cat_Id = $request->Product_Cat_Id;

            $entities = Blog::where('Parent_Id',$Product_Cat_Id)->pluck('Title','id')->toArray();
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