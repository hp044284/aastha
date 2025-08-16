<?php
namespace App\Http\Controllers\Web;
use Exception;
use PDOException;
use App\Models\Review;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Models\ProductCategory;
use App\Http\Controllers\Controller;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException;

class ProductController extends Controller
{
    public function index(Request $request, $slug = null)
    {
        try {
            $query = Product::query()->where('Status', 1);
            $product_category = null;

            // Filter by category slug (if provided)
            if (!empty($slug)) {
                $product_category = ProductCategory::where('Parent_Id', 0)->where('Slug', $slug)->first();

                if (!empty($product_category)) {
                    $query->where('Product_Category_Id', $product_category->id);
                }
            }

            // Filter by search keyword
            if (!empty($request->Search)) {
                $query->where('Product_Name', 'LIKE', '%' . $request->Search . '%');
            }

            // Paginate the result
            $entities = $query->orderBy('id', 'DESC')->paginate(16); // Set per-page limit

            // If AJAX request, return only partial view
            if ($request->ajax()) 
            {
                return view('web.ajax.product-list', compact('entities', 'product_category'))->render();
            }

            // Otherwise return the full page
            return view('web.products.index', compact('entities', 'product_category'));

        } catch (PDOException | Exception | ModelNotFoundException $e) {
            return redirect()->route('web.product.index')->with('error', $e->getMessage());
        }
    }


    public function details(Request $request, $slug)
    {
        try
        {

            $entity = Product::with('ProductReview','ProductFile')->where('Status',1)->where('Slug',$slug)->first();
            if (!empty($entity))
            {
                $product_id = $entity->id;
                $category_id = $entity->Product_Category_Id ?? 0;
                $entitySliders = Product::where('id','!=',$product_id)->where('Status',1)->where('Product_Category_Id',$category_id)->orderBy('id','DESC')->limit(10)->get();
    
                $cat_arr = [];
                if (!empty($entity->ProductCategory->Title ?? ''))
                {
                    $cat_arr[] = $entity->ProductCategory->Title;
                }
    
                if (!empty($entity->ProductSubCategory->Title ?? ''))
                {
                    $cat_arr[] = $entity->ProductSubCategory->Title;
                }
                return view('web.products.detail',compact('entity','cat_arr','entitySliders'));
            }

            $product_category = ProductCategory::where('Parent_Id',0)->where('Status',1)->where('Slug',$slug)->first();
            if (!empty($product_category))
            {
                $entities = Product::where('Product_Category_Id',$product_category->id)->where('Status',1)->orderBy('id','DESC')->paginate(16);
                return view('web.products.index',compact('entities','product_category'));
            }
        }
        catch (PDOException $e)
        {
            return to_route('web.product.index')->with('error', $e->getMessage());
        }
        catch (Exception $e)
        {
            return to_route('web.product.index')->with('error', $e->getMessage());
        }
        catch (ModelNotFoundException $e)
        {
            return to_route('home')->with('error', $e->getMessage());
        }
    }

    public function axiosReview(Request $request)
    {
        try
        {
            $validated_data = $request->validate([
                'Name' => 'required|string|max:255',
                'Email' => 'required|email|max:255',
                'Rating' => 'required',
                'Mobile' => 'required|numeric|digits:10',
                'Message' => 'required|string',
                'Product_Id' => 'required'
            ]);

            $validated_data['Review_Type'] = 'Product';
            $validated_data['Review_Status'] = 'Pending';

            $create = Review::create($validated_data);
            return response()->json([
                'status' => 'success',
                'message' => 'Thank you for your review! Your review is under admin approval and will be visible soon.',
            ], 200);
        }
        catch (ModelNotFoundException $e)
        {
            return response()->json([
                'status' => 'error',
                'message' => 'An error occurred while updating the profile : ' . $e->getMessage(),
            ], 404);
        }
        catch (MethodNotAllowedHttpException $e)
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