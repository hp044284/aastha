<?php

namespace App\Http\Controllers\Admin;
use App\Models\Page;
use App\Models\Service;
use App\Models\SeoPage;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Models\ProductCategory;
use App\Models\ServiceCategory;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class SeoPageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $seoPages = SeoPage::all();
        return view('Admin.seo-pages.index', compact('seoPages'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('Admin.seo-pages.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try 
        {
            $validated = $request->validate([
                'title' => 'required|string|max:255',
                'slug' => 'required|string|max:255|unique:seo_pages,slug',
                'content' => 'nullable|string',
                'meta_title' => 'nullable|string|max:255',
                'meta_description' => 'nullable|string',
                'meta_keywords' => 'nullable|string',
                'og_title' => 'nullable|string|max:255',
                'og_description' => 'nullable|string',
                'og_image' => 'nullable|string|max:255',
                'canonical_url' => 'nullable|string|max:255',
                'robots_index' => 'nullable|in:index,noindex',
                'robots_follow' => 'nullable|in:follow,nofollow',
                'schema_markup' => 'nullable|string',
                'status' => 'nullable|boolean',     
            ]);

            $validated['seoable_id'] = $request->seoable_id;

            if($request->seoable_type == 'product_category')
            {
                $validated['seoable_type'] = '\App\Models\ProductCategory';
            }
            else if($request->seoable_type == 'service_category')
            {
                $validated['seoable_type'] = '\App\Models\ServiceCategory';
            }
            else if($request->seoable_type == 'page')
            {
                $validated['seoable_type'] = '\App\Models\Page';
            }
            else if($request->seoable_type == 'service')
            {
                $validated['seoable_type'] = '\App\Models\Service';
            }
            
            $seoPage= SeoPage::create($validated);
            return response()->json([
                'status' => true,
                'message' => 'SEO Page created successfully.',
                'redirect' => route('seo_page.index'),
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage(),
            ]);
        }
        
    }

    /** 
     * Display the specified resource.
     */
    public function show($id)
    {
        $seoPage = SeoPage::findOrFail($id);
        return view('Admin.seo-pages.show', compact('seoPage'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $seoPage = SeoPage::findOrFail($id);
        return view('Admin.seo-pages.edit', compact('seoPage'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        try {
            $seoPage = SeoPage::findOrFail($request->id);

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:seo_pages,slug,' . $seoPage->id,
            'content' => 'nullable|string',
            'meta_title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string',
            'meta_keywords' => 'nullable|string',
            'og_title' => 'nullable|string|max:255',
            'og_description' => 'nullable|string',
            'og_image' => 'nullable|string|max:255',
            'canonical_url' => 'nullable|string|max:255',
            'robots_index' => 'nullable|in:index,noindex',
            'robots_follow' => 'nullable|in:follow,nofollow',
            'schema_markup' => 'nullable|string',
            'status' => 'nullable|boolean',
        ]);

            $seoPage->update($validated);

            return response()->json([
                'status' => true,
                'message' => 'SEO Page updated successfully.',
                'redirect' => route('seo_page.index'),
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage(),
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $seoPage = SeoPage::findOrFail($id);
        $seoPage->delete();
        return redirect()->route('seo_page.index')->with('success', 'SEO Page deleted successfully.');
    }


    public function getType(Request $request)
    {
        try 
        {
            $seoable_type = $request->seoable_type;
            $validator = Validator::make($request->all(), [
                'seoable_type' => 'required|string|in:product,service,page,category',
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'status' => false,
                    'message' => $validator->errors()->first(),
                ], 422);
            }

            if($seoable_type == 'product_category')
            {
                $seoPage = SeoPage::where('seoable_type', '\App\Models\ProductCategory')->pluck('seoable_id');
            }
            else if($seoable_type == 'service_category')
            {
                $seoPage = SeoPage::where('seoable_type', '\App\Models\ServiceCategory')->pluck('seoable_id');
            }
            else if($seoable_type == 'page')
            {
                $seoPage = SeoPage::where('seoable_type', '\App\Models\Page')->pluck('seoable_id');
            }
            else if($seoable_type == 'service')
            {
                $seoPage = SeoPage::where('seoable_type', '\App\Models\Service')->pluck('seoable_id');
            }
            
            if($seoable_type == 'product_category')
            {
                $seoable = ProductCategory::where('Status', 1)->whereNotIn('Id', $seoPage)->get(['Id', 'Title','Slug']);
            }
            else if($seoable_type == 'service_category')
            {
                $seoable = ServiceCategory::where('Status', 1)->whereNotIn('Id', $seoPage)->get(['Id', 'Title','Slug']);
            }
            else if($seoable_type == 'page')
            {
                $seoable = Page::where('Status', 1)->whereNotIn('Id', $seoPage)->get(['Id', 'Title','Slug']);
            }
            else if($seoable_type == 'service')
            {
                $seoable = Service::where('Status', 1)->whereNotIn('Id', $seoPage)->get(['Id', 'Title','Slug']);
            }
            else
            {
                return response()->json([
                    'status' => false,
                    'message' => 'Invalid SEOable type',
                ], 500);
            }
            return response()->json([
                'status' => true,
                'data' => $seoable,
            ]);
        } 
        catch (Throwable $th) 
        {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage(),
            ], 500);
        }
    }

    public function getSeoableDetails(Request $request)
    {
        try 
        {
            $validator = Validator::make($request->all(), [
                'seoable_id' => 'required|integer',
                'seoable_type' => 'required|string|in:product_category,service_category,page,service',
            ]);

            if ($validator->fails()) 
            {
                return response()->json([
                    'status' => false,
                    'message' => $validator->errors()->first(),
                ], 422);
            }

            $seoable_id = $request->seoable_id;
            $seoable_type = $request->seoable_type;

            if($seoable_type == 'product_category')
            {
                $seoable = ProductCategory::where('Id', $seoable_id)->first();
            }
            else if($seoable_type == 'service_category')
            {
                $seoable = ServiceCategory::where('Id', $seoable_id)->first();
            }
            else if($seoable_type == 'page')
            {
                $seoable = Page::where('Id', $seoable_id)->first();
            }
            else if($seoable_type == 'service')
            {
                $seoable = Service::where('Id', $seoable_id)->first();
            }
            else
            {
                return response()->json([
                    'status' => false,
                    'message' => 'Invalid SEOable type',
                ], 500);
            }
            return response()->json([
                'status' => true,
                'data' => $seoable,
            ]);
        } 
        catch (PDOException $e) 
        {
            return response()->json([
                'status' => false,
                'message' => $e->getMessage(),
            ], 500);
        } 
        catch (Exception $e) 
        {
            return response()->json([
                'status' => false,
                'message' => $e->getMessage(),
            ], 500);
        }
    }
}
