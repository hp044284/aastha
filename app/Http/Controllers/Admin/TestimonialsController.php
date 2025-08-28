<?php
namespace App\Http\Controllers\Admin;
use Exception;
use App\Models\Testimonial;
use Illuminate\Http\Request;
use App\Traits\FileUploadTrait;
use App\Http\Controllers\Controller;
use App\DataTables\TestimonialDataTable;
use App\Http\Requests\Testimonial\StoreTestimonialRequest;
use App\Http\Requests\Testimonial\UpdateTestimonialRequest;

class TestimonialsController extends Controller
{
    use FileUploadTrait;

    public function index(TestimonialDataTable $dataTable)
    {
        try {
            return $dataTable->render('Admin.testimonials.index');
        } catch (Exception $e) {
            return to_route('dashboard')->with('error', 'Failed to fetch testimonials: ' . $e->getMessage());
        }
    }

    public function create()
    {
        try {
            return view('Admin.testimonials.create');
        } catch (Exception $e) {
            return back()->with('error', 'Failed to load create form: ' . $e->getMessage());
        }
    }

    public function store(StoreTestimonialRequest $request)
    {
        try {
            // Use a custom Form Request for validation, as in other store methods
            $validated = $request->validated();
            $validated['status'] = $request->has('status') ? 1 : 0;
            if ($request->hasFile('image')) {
                $validated['image'] = $this->storeUploadedFile($request, [
                    'inputName'   => 'image',
                    'uploadPath'  => 'uploads/testimonials',
                    'oldFileName' => null
                ]);
            }
            Testimonial::create($validated);
            return redirect()->route('testimonials.index')->with('success', 'Testimonial created successfully.');
        } catch (Exception $e) {
            return back()->withInput()->with('error', 'Failed to create testimonial: ' . $e->getMessage());
        }
    }

    public function show($id)
    {
        try {
            $testimonial = Testimonial::findOrFail($id);
            return view('Admin.testimonials.show', compact('testimonial'));
        } catch (Exception $e) {
            return back()->with('error', 'Failed to fetch testimonial: ' . $e->getMessage());
        }
    }

    public function edit($id)
    {
        try {
            $testimonial = Testimonial::findOrFail($id);
            return view('Admin.testimonials.edit', compact('testimonial'));
        } catch (Exception $e) {
            return back()->with('error', 'Failed to load edit form: ' . $e->getMessage());
        }
    }

    public function update(UpdateTestimonialRequest $request, $id)
    {
        try {
            $testimonial = Testimonial::findOrFail($id);
            $validated = $request->validated();
            $validated['status'] = $request->has('status') ? 1 : 0;
            if ($request->hasFile('image')) {
                $validated['image'] = $this->storeUploadedFile($request, [
                    'inputName'   => 'image',
                    'uploadPath'  => 'uploads/testimonials',
                    'oldFileName' => $testimonial->image ?? null
                ]);
            }
            $testimonial->update($validated);
            return redirect()->route('testimonials.index')->with('success', 'Testimonial updated successfully.');
        } catch (Exception $e) {
            return back()->withInput()->with('error', 'Failed to update testimonial: ' . $e->getMessage());
        }
    }

    public function destroy($id)
    {
        try {
            $testimonial = Testimonial::findOrFail($id);
            $this->deleteFile('/Uploads/Testimonials/', $testimonial->file_name ?? '');
            $testimonial->update(['is_deleted' => 1]);
            return redirect()->route('testimonials.index')->with('success', 'Testimonial deleted successfully.');
        } catch (Exception $e) {
            return back()->with('error', 'Failed to delete testimonial: ' . $e->getMessage());
        }
    }
}