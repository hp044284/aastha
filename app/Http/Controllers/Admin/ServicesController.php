<?php
namespace App\Http\Controllers\Admin;
use Exception;
use App\Models\Service;
use Illuminate\Http\Request;
use App\Traits\FileUploadTrait;
use App\Models\ServiceCategory;
use App\Http\Controllers\Controller;
use App\DataTables\ServiceDataTable;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\Service\StoreServiceRequest;
use App\Http\Requests\Service\UpdateServiceRequest;

class ServicesController extends Controller
{
    use FileUploadTrait;

    public function index(ServiceDataTable $dataTable, Request $request)
    {
        try {
            // Pass $request to datatable if needed for filtering
            return $dataTable->render('Admin.services.index');
        } catch (Exception $e) {
            return to_route('dashboard')->with('error', 'Failed to fetch services: ' . $e->getMessage());
        }
    }

    public function create(Request $request)
    {
        try {
            $sub_categories = ServiceCategory::where('Parent_Id', 0)->pluck('Title', 'id')->toArray();
            return view('Admin.services.create', compact('sub_categories'));
        } catch (Exception $e) {
            return back()->with('error', 'Failed to load create form: ' . $e->getMessage());
        }
    }

    public function store(StoreServiceRequest $request)
    {
        try 
        {
            $validated = $request->validated();
            $filtered = collect($validated)->only([
                'title', 'meta_title', 'category_id', 'meta_keyword', 'meta_description', 'description','file_name','status','icon'
            ])->toArray();
            $filtered['status'] = $request->has('status') ? 1 : 0;

            if ($request->hasFile('file_name')) 
            {
                $file = $request->file('file_name');
                $path = $file->store('uploads/services', 'public');
                $filtered['file_name'] = $path;
            }
            
            $create = Service::create($filtered);
            if ($request->has('faqs') && is_array($request->input('faqs'))) 
            {
                foreach ($request->input('faqs') as $faq) 
                {
                    $create->faqs()->create($faq);
                }
            }
            return redirect()->route('services.index')->with('success', 'Service created successfully.');
        } 
        catch (Exception $e) 
        {
            return back()->withInput()->with('error', 'Failed to create service: ' . $e->getMessage());
        }
    }

    public function show(Request $request, $id)
    {
        try 
        {
            $service = Service::findOrFail($id);
            return view('Admin.services.show', compact('service', 'request'));
        } 
        catch (Exception $e) 
        {
            return back()->with('error', 'Failed to fetch service: ' . $e->getMessage());
        }
    }

    public function edit(Request $request, $id)
    {
        try 
        {
            $service = Service::with('faqs')->findOrFail($id);
            $faqs = $service->faqs->toArray();
            $sub_categories = ServiceCategory::where('Parent_Id', 0)->pluck('Title', 'id')->toArray();
            return view('Admin.services.edit', compact('service', 'sub_categories', 'request','faqs'));
        } 
        catch (Exception $e) 
        {
            return back()->with('error', 'Failed to load edit form: ' . $e->getMessage());
        }
    }

    public function update(UpdateServiceRequest $request, $id)
    {
        try 
        {
            $service = Service::findOrFail($id);
            $validated = $request->validated();
            $filtered = collect($validated)->only([
                'title', 'meta_title', 'category_id', 'meta_keyword', 'meta_description', 'description','file_name','status','icon'
            ])->toArray();
            $filtered['status'] = $request->has('status') ? 1 : 0;
            // If a new file is uploaded, delete the old image file
            if ($request->hasFile('file_name')) 
            {
                // Delete old file if exists
                if ($service->file_name && Storage::disk('public')->exists($service->file_name)) 
                {
                    Storage::disk('public')->delete($service->file_name);
                }
                $file = $request->file('file_name');
                $path = $file->store('uploads/services', 'public');
                $filtered['file_name'] = $path;
            }
            $service->update($filtered);

            // Save FAQs on edit (update) case
            if ($request->has('faqs') && is_array($request->input('faqs'))) 
            {
                // Remove all old faqs for this service
                $service->faqs()->delete();
                // Insert new faqs
                foreach ($request->input('faqs') as $faq) 
                {
                    $service->faqs()->create($faq);
                }
            }
            return redirect()->route('services.index')->with('success', 'Service updated successfully.');
        } 
        catch (Exception $e) 
        {
            return back()->withInput()->with('error', 'Failed to update service: ' . $e->getMessage());
        }
    }

    public function destroy(Request $request, $id)
    {
        try 
        {
            $service = Service::findOrFail($id);
            if ($service->file_name && Storage::disk('public')->exists($service->file_name)) 
            {
                Storage::disk('public')->delete($service->file_name);
            }
            $service->delete();
            return redirect()->route('services.index')->with('success', 'Service deleted successfully.');
        } 
        catch (Exception $e) 
        {
            return back()->with('error', 'Failed to delete service: ' . $e->getMessage());
        }
    }
}