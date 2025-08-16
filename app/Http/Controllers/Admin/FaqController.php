<?php
namespace App\Http\Controllers\Admin;
use Exception;
use App\Models\Faq;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class FaqController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('Admin.faq.index');
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
        $Is_Read = $Auth_User->HasPermission('Product_Sub_Categories', 'Is_Read');
        $Is_Edit = $Auth_User->HasPermission('Product_Categories', 'Is_Edit');
        $Is_Delete = $Auth_User->HasPermission('Product_Categories', 'Is_Delete');

        // Total records
        $queryRecords = Faq::query();
        $totalRecords = $queryRecords->count();

        $Query = Faq::orderby($columnName, $columnSortOrder);
        
        if (!empty($searchValue))
        {
            $Query->where(function($query) use($searchValue)
            {
                $query->where('question', 'like', '%' .$searchValue . '%');
            });
        }

        $totalRecordswithFilter = $Query->count();
        $records = $Query->skip($start)->take($rowperpage)->get();

        $data_arr = array();
        $incKey = 0;
        foreach($records as $record)
        {
            $id = $record->id;
            $Random_Id = $record->id;
            $data_arr[$incKey]['id'] = $record->id;
            $data_arr[$incKey]['question'] = !empty($record->question) ? $record->question : '';
            $data_arr[$incKey]['status'] = !empty($record->status) ? '<button type="button" data-status="active" class="btn btn-success status-button" data-id="'.$id.'">Active</button>' : '<button type="button" class="btn btn-danger status-button" data-id="'.$id.'" data-status="inactive">Inactive</button>';

            $actions = '<div class="col">';
                $actions .= '<div class="btn-group" role="group" aria-label="Basic example">';
                    if($Is_Edit)
                    {
                        $actions .= '<a href="'.route('faqs.edit',$id).'" class="btn btn-outline-secondary"><i class="bx bx-edit"></i>Edit</a>';
                    }

                    if ($Is_Delete)
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

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('Admin.faq.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try 
        {
            $validator = Validator::make($request->all(), [
                'question' => 'required',
                'answer' => 'required',
                'status' => 'required',
            ]);

            if ($validator->fails()) 
            {
                return response()->json(['status' => false, 'message' => $validator->errors()->first()], 422);
            }

            $validated = $validator->validate();
            $validated['status'] = $request->status ? 1 : 0;
            $Faq = Faq::create($validated);

            return response()->json(['status' => true, 'message' => 'Faq created successfully'], 200);
        }
        catch (Exception $e)
        {
            return response()->json(['status' => false, 'message' => 'Something went wrong'], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        try
        {
            $entity = Faq::findOrFail($id);
            return view('Admin.faq.edit',compact('entity'));
        }
        catch (Exception $e)
        {
            return redirect()->back()->with('error', 'Something went wrong');
        }
        catch (ModelNotFoundException $e)
        {
            return redirect()->back()->with('error', 'Faq not found');
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        try
        {
            $validator = Validator::make($request->all(), [
                'question' => 'required',
                'answer' => 'required',
                'status' => 'required',
            ]);

            if ($validator->fails())
            {
                return response()->json(['status' => false, 'message' => $validator->errors()->first()], 422);
            }

            $validated = $validator->validate();
            $validated['status'] = $request->status ? 1 : 0;
            $entity = Faq::findOrFail($id);
            $entity->update($validated);
            return response()->json(['status' => true, 'message' => 'Faq updated successfully'], 200);
        }
        catch (Exception $e)
        {
            return response()->json(['status' => false, 'message' => 'Something went wrong'], 500);
        }
        catch (ModelNotFoundException $e)
        {
            return response()->json(['status' => false, 'message' => 'Faq not found'], 404);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try
        {
            $entity = Faq::findOrFail($id);
            $entity->delete();
            return response()->json(['status' => true, 'message' => 'Faq deleted successfully'], 200);
        }
        catch (Exception $e)
        {
            return response()->json(['status' => false, 'message' => 'Something went wrong'], 500);
        }
        catch (ModelNotFoundException $e)
        {
            return response()->json(['status' => false, 'message' => 'Faq not found'], 404);
        }
    }
}
