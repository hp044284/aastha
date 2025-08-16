<?php
namespace App\Http\Controllers\Admin;
use App\Models\City;
use App\Models\State;
use App\Models\Country;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CitiesController extends Controller
{
    public function Index(Request $request)
    {

        return view('Admin.Cities.Index');
    }

    public function Create(Request $request)
    {
        $countries = Country::select(\DB::raw("CONCAT(Country_Name, ' (', Country_Code, ')') as country_details"),'id')->pluck('country_details','id');
        return view('Admin.Cities.Create',compact('countries'));
    }

    public function Edit(Request $request, $Random_Id)
    {
        try
        {
            $countries = Country::select(\DB::raw("CONCAT(Country_Name, ' (', Country_Code, ')') as country_details"),'id')->pluck('country_details','id');
            $entity = City::where('Random_Id',$Random_Id)->firstOrFail();
            return view('Admin.Cities.Edit',compact('entity','countries'));
        }
        catch (\PDOException $e)
        {
            return to_route('city.index')->with('error', $e->getMessage());
        }
        catch (Exception $e)
        {
            return to_route('city.index')->with('error', $e->getMessage());
        }
        catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e)
        {
            return to_route('city.index')->with('error', $e->getMessage());
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

        // Total records
        $queryRecords = City::query();
        $totalRecords = $queryRecords->count();

        $Query = City::with('Country:id,Country_Name,Country_Code','State:id,Name,Status')->orderby($columnName, $columnSortOrder);
        if (!empty($searchValue))
        {
            $Query->where(function($query) use($searchValue)
            {
                $query->where('Name', 'like', '%' .$searchValue . '%')
                ->orWhereRelation('Country', function($query) use ($searchValue)
                {
                    $query->where('Country_Name', 'like', '%' .$searchValue . '%');
                })
                ->orWhereRelation('State', function($query) use ($searchValue)
                {
                    $query->where('Name', 'like', '%' .$searchValue . '%');
                })
                ;
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
            $data_arr[$incKey]['State_Id'] = !empty($record->State->Name) ? $record->State->Name : '';
            $data_arr[$incKey]['Country_Id'] = !empty($record->Country->Country_Name) ? $record->Country->Country_Name : '';
            $data_arr[$incKey]['Status'] = !empty($record->Status) ? '<button type="button" data-status="active" class="btn btn-success status-button" data-id="'.$id.'">Active</button>' : '<button type="button" class="btn btn-danger status-button" data-id="'.$id.'" data-status="inactive">Inactive</button>';

            $actions = '<div class="col">';
                $actions .= '<div class="btn-group" role="group" aria-label="Basic example">';
                    $actions .= '<a href="'.route('city.edit',$Random_Id).'" class="btn btn-outline-secondary"><i class="bx bx-edit"></i>Edit</a>';
                    $actions .= '<a href="javascript:void(0);" onclick="Delete_Entity('.$id.')" class="btn btn-outline-secondary"><i class="bx bx-edit"></i>Delete</a>';
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
                'Name' => 'required|string|max:255|unique:cities,Name',
                'State_Id' => 'required|integer|not_in:0',
                'Country_Id' => 'required|integer|not_in:0',
            ]);
            $validated_data['Status'] = (!empty($request->Status)) ? 1 : 0;
            $create = City::create($validated_data);
            return response()->json([
                'status' => 'success',
                'message' => 'City created successfully!',
                'redirect' => redirect()->intended(route('city.index'))->getTargetUrl(),
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
            $id = $Room_Id = $request->id;
            $validated_data = $request->validate([
                'Name' => 'required|string|max:255|unique:cities,Name,'. $id,
                'State_Id' => 'required|integer|not_in:0',
                'Country_Id' => 'required|integer|not_in:0',
            ]);
            $validated_data['Status'] = (!empty($request->Status)) ? 1 : 0;
            $entity = City::findOrFail($id);
            $update = $entity->update($validated_data);

            return response()->json([
                'status' => 'success',
                'message' => 'City updated successfully!',
                'redirect' => redirect()->intended(route('city.index'))->getTargetUrl(),
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

            $entity = City::findOrFail($id);
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

            $entity = City::findOrFail($id);
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

    public function Axios_State(Request $request)
    {
        try
        {
            $id = $request->id;
            $validated_data = $request->validate([
                'Country_Id' => 'required',
            ]);

            $Country_Id = $request->Country_Id;
            $entities = State::where('Country_Id',$Country_Id)->where('Status',1)->pluck('Name','id');
            return response()->json([
                'status' => 'success',
                'message' => 'State get successfully!',
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

    public function Axios_Cities(Request $request)
    {
        try
        {
            $id = $request->id;
            $validated_data = $request->validate([
                'State_Id' => 'required',
                'Country_Id' => 'required',
            ]);

            $State_Id = $request->State_Id;
            $Country_Id = $request->Country_Id;
            $entities = City::where('Country_Id',$Country_Id)->where('State_Id',$State_Id)->where('Status',1)->pluck('Name','id');
            return response()->json([
                'status' => 'success',
                'message' => 'Cities get successfully!',
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