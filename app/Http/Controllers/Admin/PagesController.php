<?php
namespace App\Http\Controllers\Admin;
use App\Models\Page;
use Illuminate\Http\Request;
use App\Traits\FileUploadTrait;
use App\Http\Controllers\Controller;

class PagesController extends Controller
{
    use FileUploadTrait;
    public function Index(Request $request)
    {
        return view('Admin.Pages.Index');
    }

    public function Create(Request $request)
    {
        return view('Admin.Pages.Create');
    }

    public function Edit(Request $request, $Random_Id)
    {
        try
        {
            $entity = Page::where('Random_Id',$Random_Id)->firstOrFail();
            return view('Admin.Pages.Edit',compact('entity'));
        }
        catch (\PDOException $e)
        {
            return to_route('page.index')->with('error', $e->getMessage());
        }
        catch (Exception $e)
        {
            return to_route('page.index')->with('error', $e->getMessage());
        }
        catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e)
        {
            return to_route('page.index')->with('error', $e->getMessage());
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
        $Is_Edit = $Auth_User->HasPermission('Pages', 'Is_Edit');

        // Total records
        $queryRecords = Page::query();
        $totalRecords = $queryRecords->count();

        $Query = Page::orderby($columnName, $columnSortOrder);
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
            $data_arr[$incKey]['Menu_Display'] = !empty($record->Menu_Display) ? $record->Menu_Display : '';
            $data_arr[$incKey]['Status'] = !empty($record->Status) ? '<button type="button" data-status="active" class="btn btn-success status-button" data-id="'.$id.'">Active</button>' : '<button type="button" class="btn btn-danger status-button" data-id="'.$id.'" data-status="inactive">Inactive</button>';

            $actions = '<div class="col">';
                $actions .= '<div class="btn-group" role="group" aria-label="Basic example">';
                    if($Is_Edit)
                    {
                        $actions .= '<a href="'.route('page.edit',$Random_Id).'" class="btn btn-outline-secondary"><i class="bx bx-edit"></i>Edit</a>';
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
                'Meta_Title' => 'required|string|max:255',
                'Description' => 'nullable|string',
                'Meta_Keyword' => 'required|string|max:255',
                'Canonical_Url' => 'nullable|url|max:255',
                'Meta_Description' => 'required|string|max:500',
                'Menu_Display' => 'required',
                'Icons_Name' => 'nullable|string|max:255',
                'File_Name' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            ]);

            $validated_data['Status'] = (!empty($request->Status)) ? 1 : 0;
            $validated_data['Is_Footer_Link'] = (!empty($request->Is_Footer_Link)) ? 1 : 0;
            $validated_data['Menu_Display'] = (!empty($request->Menu_Display)) ? implode(',', $request->Menu_Display) : NULL;
            if ($request->hasFile('File_Name'))
            {
                $filename = $this->handleFileUpload($request, 'File_Name', '/Uploads/Page/');
                $validated_data['File_Name'] = $filename;
            }
            $create = Page::create($validated_data);
            return response()->json([
                'status' => 'success',
                'message' => 'Page created successfully!',
                'redirect' => redirect()->intended(route('page.index'))->getTargetUrl(),
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
            // return $request->all();
            $id = $Room_Id = $request->id;
            $validated_data = $request->validate([
                'Title' => 'required|string|max:255',
                'Meta_Title' => 'required|string|max:255',
                'Description' => 'nullable|string',
                'Meta_Keyword' => 'required|string|max:255',
                'Canonical_Url' => 'nullable|url|max:255',
                'Meta_Description' => 'required|string|max:500',
                'Menu_Display' => 'required',
                'Icons_Name' => 'nullable|string|max:255',
                'File_Name' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                
            ]);
            
            $entity = Page::findOrFail($id);
            $validated_data['Status'] = (!empty($request->Status)) ? 1 : 0;
            $validated_data['Is_Footer_Link'] = (!empty($request->Is_Footer_Link)) ? 1 : 0;
            $validated_data['Menu_Display'] = (!empty($request->Menu_Display)) ? implode(',', $request->Menu_Display) : NULL;

            if ($request->hasFile('File_Name'))
            {
                $filename = $this->handleFileUpload($request, 'File_Name', '/Uploads/Page/',$entity->File_Name);
                $validated_data['File_Name'] = $filename;
            }
            
            $update = $entity->update($validated_data);

            return response()->json([
                'status' => 'success',
                'message' => 'Page updated successfully!',
                'redirect' => redirect()->intended(route('page.index'))->getTargetUrl(),
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

            $entity = Page::findOrFail($id);
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

            $entity = Page::findOrFail($id);
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

    public function Axios_Product_Sub_Category(Request $request)
    {
        try
        {
            $validated_data = $request->validate([
                'Product_Cat_Id' => 'required',
            ]);

            $Product_Cat_Id = $request->Product_Cat_Id;

            $entities = Page::where('Parent_Id',$Product_Cat_Id)->pluck('Title','id')->toArray();
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

            $entities = Page::where('Parent_Id',$Blog_Cat_Id)->pluck('Title','id')->toArray();
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