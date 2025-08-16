<?php
namespace App\Http\Controllers\Admin;
use App\Models\Product;
use App\Models\Product_File;
use Illuminate\Http\Request;
use App\Traits\FileUploadTrait;
use Illuminate\Support\Facades\File;
use App\Http\Controllers\Controller;

class ProductsController extends Controller
{
    use FileUploadTrait;
    public function Index(Request $request)
    {
        return view('Admin.Products.Index');
    }

    public function Create(Request $request)
    {
        $product_categories = \App\Models\ProductCategory::where('Parent_Id',0)->pluck('Title','id')->toArray();
        return view('Admin.Products.Create',compact('product_categories'));
    }

    public function Edit(Request $request, $Random_Id)
    {
        try
        {
            $entity = Product::with('ProductFile')->where('Random_Id',$Random_Id)->firstOrFail();
            // echo '<pre>';
            // print_r($entity);
            // die;
            $product_categories = \App\Models\ProductCategory::where('Parent_Id',0)->pluck('Title','id')->toArray();
            return view('Admin.Products.Edit',compact('entity','product_categories'));
        }
        catch (\PDOException $e)
        {
            return to_route('product.index')->with('error', $e->getMessage());
        }
        catch (Exception $e)
        {
            return to_route('product.index')->with('error', $e->getMessage());
        }
        catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e)
        {
            return to_route('product.index')->with('error', $e->getMessage());
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
        $Is_Edit = $Auth_User->HasPermission('Products', 'Is_Edit');
        $Is_Delete = $Auth_User->HasPermission('Products', 'Is_Delete');

        // Total records
        $queryRecords = Product::query();
        $totalRecords = $queryRecords->count();

        $Query = Product::orderby($columnName, $columnSortOrder);
        if (!empty($searchValue))
        {
            $Query->where(function($query) use($searchValue)
            {
                $query->where('Product_Name', 'like', '%' .$searchValue . '%')->orWhere('Price', 'like', '%' .$searchValue . '%')->orWhere('Sku', 'like', '%' .$searchValue . '%')->orWhere('Quntity', 'like', '%' .$searchValue . '%')
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
            $data_arr[$incKey]['Sku'] = !empty($record->Sku) ? $record->Sku : '';
            $data_arr[$incKey]['Price'] = !empty($record->Price) ? $record->Price : 0.00;
            $data_arr[$incKey]['Quntity'] = !empty($record->Quntity) ? $record->Quntity : '';
            $data_arr[$incKey]['Product_Name'] = !empty($record->Product_Name) ? $record->Product_Name : '';
            $data_arr[$incKey]['Status'] = !empty($record->Status) ? '<button type="button" data-status="active" class="btn btn-success status-button" data-id="'.$id.'">Active</button>' : '<button type="button" class="btn btn-danger status-button" data-id="'.$id.'" data-status="inactive">Inactive</button>';

            $actions = '<div class="col">';
                $actions .= '<div class="btn-group" role="group" aria-label="Basic example">';
                    if($Is_Edit)
                    {
                        $actions .= '<a href="'.route('product.edit',$Random_Id).'" class="btn btn-outline-secondary"><i class="bx bx-edit"></i>Edit</a>';
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

    public function Store(Request $request)
    {
        try
        {
            $validated_data = $request->validate([
                'Sku' => 'required|string|max:255',
                'Tags' => 'nullable|string',
                'Price' => 'required|regex:/^\d+(\.\d{1,2})?$/',
                'Quntity' => 'required|integer|min:1',
                'Old_Price' => 'required|regex:/^\d+(\.\d{1,2})?$/',
                'File_Name' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
                'Meta_Title' => 'nullable|string|max:255',
                'Description' => 'nullable|string',
                'Product_Name' => 'required|string|max:255',
                'Secondary_File' => 'nullable|array',
                'Secondary_File.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
                'Meta_Description' => 'nullable|string',
                'Short_Description' => 'nullable|string',
                'Product_Category_Id' => 'required|integer|exists:product_categories,id',
                'Aditional_Description' => 'nullable|string',
                'Product_Sub_Category_Id' => 'nullable|integer|exists:product_categories,id',
            ]);

            $filtered = $request->only(['Sku','Tags','Price','Old_Price','Quntity','Meta_Title','Description','Product_Name','Meta_Description','Short_Description','Product_Category_Id','Aditional_Description','Product_Sub_Category_Id']);
            $filtered['Status'] = (!empty($request->Status)) ? 1 : 0;
            $filtered['File_Name'] = $this->handleFileUpload($request, 'File_Name', '/Uploads/Products/');
            $create = Product::create($filtered);
            if ($create)
            {
                $Product_Id = $create->id ?? 0;
                if ($request->hasFile('Secondary_File'))
                {
                    $Product_File_Arr = [];
                    $Secondary_Files = $request->file('Secondary_File');
                    foreach ($Secondary_Files as $Secondary_File_Key => $Secondary_File)
                    {
                        if ($Secondary_File->isValid())
                        {
                            $fileName = $Secondary_File->hashName();
                            $destinationPath = public_path('/Uploads/Products/');
                            $Secondary_File->move($destinationPath, $fileName);
                            $Product_File_Arr[] = [
                                "File_Name" => $fileName,
                                "Product_Id" => $Product_Id,
                            ];
                        }
                    }

                    if (!empty($Product_File_Arr))
                    {
                        Product_File::insert($Product_File_Arr);
                    }
                }

            }
            return response()->json([
                'status' => 'success',
                'message' => 'Product created successfully!',
                'redirect' => redirect()->intended(route('product.index'))->getTargetUrl(),
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
            $id = $Product_Id = $request->id;
            $validated_data = $request->validate([
                'Sku' => 'required|string|max:255',
                'Tags' => 'nullable|string',
                'Price' => 'required|regex:/^\d+(\.\d{1,2})?$/',
                'Quntity' => 'required|integer|min:1',
                'File_Name' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
                'Old_Price' => 'required|regex:/^\d+(\.\d{1,2})?$/',
                'Meta_Title' => 'nullable|string|max:255',
                'Description' => 'nullable|string',
                'Product_Name' => 'required|string|max:255',
                'Secondary_File' => 'nullable|array',
                'Secondary_File.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
                'Meta_Description' => 'nullable|string',
                'Short_Description' => 'nullable|string',
                'Product_Category_Id' => 'required|integer|exists:product_categories,id',
                'Aditional_Description' => 'nullable|string',
                'Product_Sub_Category_Id' => 'nullable|integer|exists:product_categories,id',
            ]);

            $entity = Product::findOrFail($id);
            $filtered = $request->only(['Sku','Tags','Price','Old_Price','Quntity','Meta_Title','Description','Product_Name','Meta_Description','Short_Description','Product_Category_Id','Aditional_Description','Product_Sub_Category_Id']);
            $filtered['Status'] = (!empty($request->Status)) ? 1 : 0;

            if ($request->hasFile('File_Name'))
            {
                $filtered['File_Name'] = $this->handleFileUpload($request, 'File_Name', '/Uploads/Products/',$entity->File_Name ?? '');
            }

            $update = $entity->update($filtered);
            if ($update)
            {
                if ($request->hasFile('Secondary_File'))
                {
                    $Product_File_Arr = [];
                    $Secondary_Files = $request->file('Secondary_File');
                    foreach ($Secondary_Files as $Secondary_File_Key => $Secondary_File)
                    {
                        $Check_File_Exist = Product_File::where('Product_Id',$Product_Id)->where('id',$Secondary_File_Key)->first();
                        if (!empty($Check_File_Exist))
                        {
                            $public_path = public_path('/Uploads/Products/'.$Check_File_Exist->File_Name ?? '');
                            if (!empty($Check_File_Exist->File_Name) && File::exists($public_path))
                            {
                                @unlink($public_path);
                            }

                            if ($Secondary_File->isValid())
                            {
                                $fileName = $Secondary_File->hashName();
                                $destinationPath = public_path('/Uploads/Products/');
                                $Secondary_File->move($destinationPath, $fileName);
                                $Check_File_Exist->File_Name = $fileName;
                                $Check_File_Exist->save();
                            }
                        }
                        else
                        {
                            if ($Secondary_File->isValid())
                            {
                                $fileName = $Secondary_File->hashName();
                                $destinationPath = public_path('/Uploads/Products/');
                                $Secondary_File->move($destinationPath, $fileName);
                                $Product_File_Arr[] = [
                                    "File_Name" => $fileName,
                                    "Product_Id" => $Product_Id,
                                ];
                            }
                        }
                    }

                    if (!empty($Product_File_Arr))
                    {
                        Product_File::insert($Product_File_Arr);
                    }
                }
            }

            return response()->json([
                'status' => 'success',
                'message' => 'Product updated successfully!',
                'redirect' => redirect()->intended(route('product.index'))->getTargetUrl(),
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

            $entity = Product::findOrFail($id);
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

    public function Delete(Request $request)
    {
        try
        {
            $id = $request->id;
            $validated_data = $request->validate([
                'id' => 'required',
            ]);

            $entity = Product::with('ProductFile')->findOrFail($id);
            $this->deleteFile('/Uploads/Products/', $entity->File_Name ?? '');
            $validated_data['Is_Deleted'] = 1;
            $entity->update($validated_data);
            if(!empty($entity->ProductFile))
            {
                foreach ($entity->ProductFile as $productFileKey => $productFile)
                {
                    $public_path = public_path('/Uploads/Products/'.$productFile->File_Name);
                    if(!empty($productFile->File_Name) && (File::exists($public_path)))
                    {
                        @unlink($public_path);
                    }
                    $productFile->delete();
                }
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

    public function Room_File_Distroy(Request $request)
    {
        try
        {
            $id = $request->id;
            $validated_data = $request->validate([
                'id' => 'required',
            ]);

            $entity = Room_File::findOrFail($id);
            $public_path = public_path('/Uploads/Rooms/'.$entity->File_Name ?? '');
            if(!empty($entity->File_Name) && File::exists($public_path))
            {
                @unlink($public_path);
            }
            $entity->delete();

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