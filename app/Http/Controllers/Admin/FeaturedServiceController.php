<?php
namespace App\Http\Controllers\Admin;
use Illuminate\Http\Request;
use App\Models\FeaturedService;
use App\Traits\FileUploadTrait;
use App\Models\FeaturedServiceTitle;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Exception;

class FeaturedServiceController extends Controller
{
    use FileUploadTrait;

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $featuredServices = FeaturedService::all();
            return view('admin.featured-services.index', compact('featuredServices'));
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Failed to load featured services: ' . $e->getMessage());
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        try {
            return view('admin.featured-services.create');
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Failed to load create form: ' . $e->getMessage());
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'title' => 'required|string|max:255',
                'sub_title' => 'required|string|max:255',
                'short_description' => 'required|string|max:255',
                'url' => 'required|string|max:255',
                'file_name' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048|dimensions:width=865,height=550',
            ]);

            if ($validator->fails()) 
            {
                return response()->json(['error' => $validator->errors()], 422);
            }
            $validated = $validator->validated();
            if ($request->hasFile('file_name'))
            {
                $validated['file_name'] = $this->handleFileUpload($request, 'file_name', '/Uploads/featured-services/');
            }
            $validated['status'] = $request->boolean('status') ? 1 : 0;
            $create = FeaturedService::create($validated);
            if ($create) 
            {
                if($request->has('extra_inputs'))   
                {
                    foreach($request->extra_inputs as $extra_input)
                    {
                        $create->featuredServiceTitles()->create(['title' => $extra_input]);
                    }
                }
                return response()->json(['message' => 'Featured service created successfully', 'redirect' => route('featured-services.index')], 200);
            }
            else
            {
                return response()->json(['message' => 'Featured service creation failed'], 400);
            }
        } catch (Exception $e) {
            return response()->json(['message' => 'An error occurred: ' . $e->getMessage()], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        try {
            $featuredService = FeaturedService::find($id);
            if (!$featuredService) {
                return redirect()->back()->with('error', 'Featured service not found.');
            }
            return view('admin.featured-services.show', compact('featuredService'));
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Failed to load featured service: ' . $e->getMessage());
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        try 
        {
            $entity = FeaturedService::with('featuredServiceTitles')->findOrFail($id);
            if (!$entity) {
                return redirect()->back()->with('error', 'Featured service not found.');
            }
            return view('admin.featured-services.edit', compact('entity'));
        } 
        catch (Exception $e) 
        {
            return redirect()->back()->with('error', 'Failed to load edit form: ' . $e->getMessage());
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        try {
            $id = $request->id;
            $entity = FeaturedService::find($id);
            if (!$entity) {
                return redirect()->back()->with('error', 'Featured service not found.');
            }
            $validator = Validator::make($request->all(), [
                'title' => 'required|string|max:255',
                'sub_title' => 'required|string|max:255',
                'short_description' => 'required|string|max:255',
                'url' => 'required|string|max:255',
                'file_name' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048|dimensions:width=865,height=550',
            ]);
            if ($validator->fails()) 
            {
                return response()->json(['error' => $validator->errors()], 422);
            }
            $validated = $validator->validated();
            if ($request->hasFile('file_name'))
            {
                $validated['file_name'] = $this->handleFileUpload($request, 'file_name', '/Uploads/featured-services/', $entity->file_name ?? '');
            }
            $validated['status'] = $request->boolean('status') ? 1 : 0;
            $update = $entity->update($validated);
            if ($update) 
            {
                if($request->has('extra_inputs'))   
                {
                    foreach($request->extra_inputs as $extra_input)
                    {
                        $entity->featuredServiceTitles()->updateOrCreate(['title' => $extra_input, 'featured_service_id' => $entity->id]);
                    }
                }
                return response()->json(['message' => 'Featured service updated successfully', 'redirect' => route('featured-services.index')], 200);
            }
            else
            {
                return response()->json(['message' => 'Featured service update failed'], 400);
            }
        } catch (Exception $e) {
            return response()->json(['message' => 'An error occurred: ' . $e->getMessage()], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        try {
            $featuredService = FeaturedService::find($request->id);
            if (!$featuredService) {
                return redirect()->route('featured-services.index')->with('error', 'Featured service not found.');
            }
            $featuredService->delete();
            return redirect()->route('featured-services.index')->with('success', 'Featured service deleted successfully');
        } catch (Exception $e) {
            return redirect()->route('featured-services.index')->with('error', 'An error occurred: ' . $e->getMessage());
        }
    }

    public function axiosRecord(Request $request)
    {
        try {
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
            $Is_Read = $Auth_User->HasPermission('Featured_Services', 'Is_Read');
            $Is_Edit = $Auth_User->HasPermission('Featured_Services', 'Is_Edit');
            $Is_Delete = $Auth_User->HasPermission('Featured_Services', 'Is_Delete');

            // Total records
            $queryRecords = FeaturedService::query();
            $totalRecords = $queryRecords->count();

            $Query = FeaturedService::orderby($columnName, $columnSortOrder);
            if (!empty($searchValue))
            {
                $Query->where(function($query) use($searchValue)
                {
                    $query->where('title', 'like', '%' .$searchValue . '%');
                });
            }

            $totalRecordswithFilter = $Query->count();
            $records = $Query->skip($start)->take($rowperpage)->get();

            $data_arr = array();
            $incKey = 0;
            foreach($records as $record)
            {
                $id = $record->id;
                $data_arr[$incKey]['id'] = $record->id;
                $data_arr[$incKey]['title'] = !empty($record->title) ? $record->title : '';
                $data_arr[$incKey]['status'] = !empty($record->status) ? '<button type="button" data-status="active" class="btn btn-success status-button" data-id="'.$id.'">Active</button>' : '<button type="button" class="btn btn-danger status-button" data-id="'.$id.'" data-status="inactive">Inactive</button>';

                $actions = '<div class="col">';
                    $actions .= '<div class="btn-group" role="group" aria-label="Basic example">';
                        if($Is_Edit)
                        {
                            $actions .= '<a href="'.route('featured-services.edit',$id).'" class="btn btn-outline-secondary"><i class="bx bx-edit"></i>Edit</a>';
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
        } catch (Exception $e) {
            $response = [
                "draw" => intval($request->get('draw')),
                "aaData" => [],
                "iTotalRecords" => 0,
                "iTotalDisplayRecords" => 0,
                "error" => $e->getMessage(),
            ];
            echo json_encode($response);
            exit;
        }
    }

    public function status(Request $request)
    {
        try 
        {
            $id = $request->id;
            $validated_data = $request->validate([
                'status' => 'required|in:1,0',
            ]);

            $entity = FeaturedService::findOrFail($id);
            $entity->status = $request->status ;
            $entity->save();
            return response()->json([
                'message' => 'Featured service status updated successfully',
                'status' => $entity->status == 1 ? 'active' : 'inactive',
                'redirect' => route('featured-services.index')
            ], 200);
        }
        catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e)
        {
            return response()->json([
                'status' => 'error',
                'message' => 'An error occurred while updating the profile : ' . $e->getMessage(),
            ], 404);
        }
        catch (Exception $e)
        {
            return response()->json(['message' => 'An error occurred: ' . $e->getMessage()], 500);
        }
    }

    public function deleteExtraInput(Request $request)
    {
        try 
        {
            $id = $request->id;
            $entity = FeaturedServiceTitle::findOrFail($id);
            $entity->delete();
            return response()->json([
                'message' => 'Extra input deleted successfully',
                'redirect' => route('featured-services.edit', $entity->featured_service_id)
            ], 200);
        }
        catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e)
        {
            return response()->json([
                'status' => 'error',
                'message' => 'An error occurred while updating the profile : ' . $e->getMessage(),
            ], 404);
        }
        catch (Exception $e)
        {
            return response()->json(['message' => 'An error occurred: ' . $e->getMessage()], 500);
        }
    }
}
