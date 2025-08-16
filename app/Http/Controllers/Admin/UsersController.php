<?php
namespace App\Http\Controllers\Admin;
use App\Models\User;
use Illuminate\Http\Request;
use App\Traits\FileUploadTrait;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\{Auth,Hash};
class UsersController extends Controller
{
    use FileUploadTrait;
    public function Index(Request $request)
    {
        return view('Admin.Users.Index');
    }

    public function Create(Request $request)
    {
        return view('Admin.Users.Create');
    }

    public function Profile(Request $request)
    {
        $AuthUser = Auth::user();
        return view('Admin.Users.Profile',compact('AuthUser'));
    }

    public function Change_Password(Request $request)
    {
        $AuthUser = Auth::user();
        return view('Admin.Users.Password',compact('AuthUser'));
    }

    public function Update_Profile(Request $request)
    {
        try
        {
            $AuthUser = Auth::user();
            $UserId = $AuthUser->id;

            $validator = validator($request->all(), [
                'email' => 'required|email|unique:users,email,'.$UserId,
                'mobile' => 'required|digits:10',
                'last_name' => 'required|string|max:255',
                'first_name' => 'required|string|max:255',
            ]);

            if ($validator->fails())
            {
                return response()->json(['status'=>'error','message' => $validator->errors()->first()], 422);
            }

            $data = $request->only(['first_name', 'last_name', 'email', 'mobile','File_Name']);
            if ($request->hasFile('File_Name'))
            {
                $filename = $this->handleFileUpload($request, 'File_Name', '/Uploads/users/', $AuthUser->File_Name ?? '');
                $data['File_Name'] = $filename;
            }
            
            $update = User::where('id', $UserId)->update($data);
            if ($update)
            {
                return response()->json([
                    'status' => 'success',
                    'message' => 'Profile updated successfully!!',

                ], 200);
            }
            else
            {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Unable to update!!',
                ], 422);
            }
        }
        catch (Exception $e)
        {
            return response()->json([
                'status' => 'error',
                'message' => 'An error occurred while updating the profile : ' . $e->getMessage(),
            ], 404);
        }
    }

    public function Edit(Request $request, $random_id)
    {
        try
        {
            $entity = User::where('random_id',$random_id)->firstOrFail();
            return view('Admin.Users.Edit',compact('entity'));
        }
        catch (\PDOException $e)
        {
            return to_route('user.index')->with('error', $e->getMessage());
        }
        catch (Exception $e)
        {
            return to_route('user.index')->with('error', $e->getMessage());
        }
        catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e)
        {
            return to_route('user.index')->with('error', $e->getMessage());
        }
    }

    public function Update_Password(Request $request)
    {
        try
        {
            $AuthUser = Auth::user();
            $UserId = $AuthUser->id;
            $validator = validator($request->all(), [
                'old_password' => 'required',
                'new_password' => 'required|string|min:8|confirmed',
                'new_password_confirmation' => 'required|string|min:8',
            ]);

            if ($validator->fails())
            {
                return response()->json(['status'=>'error','message' => $validator->errors()->first()], 422);
            }

            if (!Hash::check($request->old_password, $AuthUser->password))
            {
                return response()->json([
                    'status' => 'error',
                    'message' => 'The old password is incorrect.',
                ], 400);
            }

            if (strcmp($request->old_password, $request->new_password) === 0)
            {
                return response()->json([
                    'status' => 'error',
                    'message' => 'The new password cannot be the same as the old password.',
                ], 400);
            }

            $AuthUser->password = Hash::make($request->new_password);
            $AuthUser->save();

            return response()->json([
                'status' => 'success',
                'message' => 'Password updated successfully!',
                'redirect' => redirect()->intended(route('dashboard'))->getTargetUrl(),
            ], 200);
        }
        catch (Exception $e)
        {
            return response()->json([
                'status' => 'error',
                'message' => 'An error occurred while updating the profile : ' . $e->getMessage(),
            ], 404);
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
        $Is_Edit = $Auth_User->HasPermission('Users', 'Is_Edit');
        $Is_Delete = $Auth_User->HasPermission('Users', 'Is_Delete');

        // Total records
        $queryRecords = User::query();
        $queryRecords->where('role_id',3);
        $totalRecords = $queryRecords->count();

        $Query = User::orderby($columnName, $columnSortOrder);
        $Query->where('role_id',3);
        if (!empty($searchValue))
        {
            $Query->where(function($query) use($searchValue)
            {
                $query->where('first_name', 'like', '%' .$searchValue . '%')
                ->orWhere('email', 'like', '%' .$searchValue . '%')
                ->orWhere('mobile', 'like', '%' .$searchValue . '%')
                ->orWhere('gender', 'like', '%' .$searchValue . '%')
                ->orWhere('last_name', 'like', '%' .$searchValue . '%')
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
            $random_id = $record->random_id;
            $data_arr[$incKey]['id'] = $record->id;
            $data_arr[$incKey]['email'] = !empty($record->email) ? $record->email : '';
            $data_arr[$incKey]['gender'] = !empty($record->gender) ? $record->gender : '';
            $data_arr[$incKey]['mobile'] = !empty($record->mobile) ? $record->mobile : '';
            $data_arr[$incKey]['last_name'] = !empty($record->last_name) ? $record->last_name : '';
            $data_arr[$incKey]['first_name'] = !empty($record->first_name) ? $record->first_name : '';
            $data_arr[$incKey]['domain_name'] = !empty($record->domain_name) ? $record->domain_name : '';
            $data_arr[$incKey]['created_at'] = !empty($record->created_at) ? $record->created_at->format('d/m/Y') : '';

            $actions = '<div class="col">';
                $actions .= '<div class="btn-group" role="group" aria-label="Basic example">';
                    if ($Is_Edit)
                    {
                        $actions .= '<a href="'.route('user.edit',$random_id).'" class="btn btn-outline-secondary"><i class="bx bx-edit"></i>Edit</a>';
                    }
                    if($Is_Delete)
                    {
                        $actions .= '<a href="" class="btn btn-outline-secondary"><i class="bx bx-edit"></i>Delete</a>';
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
            $validatedData = $request->validate([
                'email' => 'required|email|unique:users,email',
                'mobile' => 'required|string|max:15|unique:users,mobile',
                'gender' => 'required|in:Male,Female,Other',
                'password' => 'required|string|min:8',
                'last_name' => 'required|string|max:255',
                'first_name' => 'required|string|max:255',
                'confirm_password' => 'required|string|min:8|same:password',
            ]);

            $validatedData['status'] = (!empty($request->status)) ? 1 : 0;
            $validatedData['role_id'] = 3;
            $validatedData['password'] = bcrypt($validatedData['password']);
            $validatedData['domain_name'] = (!empty($request->domain_name)) ? $request->domain_name : '';
            unset($validatedData['confirm_password']);
            User::create($validatedData);
            return response()->json([
                'status' => 'success',
                'message' => 'User created successfully!',
                'redirect' => redirect()->intended(route('user.index'))->getTargetUrl(),
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

    public function Update(Request $request)
    {
        try
        {
            $id = $request->id;
            $validatedData = $request->validate([
                'email' => 'required|email|unique:users,email,' . $id,
                'mobile' => 'required|string|max:15|unique:users,mobile,' . $id,
                'gender' => 'required|in:Male,Female,Other',
                'last_name' => 'required|string|max:255',
                'first_name' => 'required|string|max:255',
            ]);

            // Retrieve the user based on the ID
            $user = User::findOrFail($id);
            if (!empty($request->new_password))
            {
                $validatedData['password'] = Hash::make($request->new_password);
            }

            $user->update([
                'email' => $validatedData['email'],
                'gender' => $validatedData['gender'],
                'mobile' => $validatedData['mobile'],
                'status' => $request->has('status') ? $validatedData['status'] : false,
                'last_name' => $validatedData['last_name'],
                'first_name' => $validatedData['first_name'],
                'domain_name' => (!empty($request->domain_name)) ? $request->domain_name : '',
            ]);

            return response()->json([
                'status' => 'success',
                'message' => 'User updated successfully!',
                'redirect' => redirect()->intended(route('user.index'))->getTargetUrl(),
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