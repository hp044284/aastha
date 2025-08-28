<?php
namespace App\Http\Controllers\Admin;
use Exception;
use App\Models\Doctor;
use App\Models\Position;
use Illuminate\Http\Request;
use App\Models\Specialization;
use App\DataTables\DoctorDataTable;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\Doctor\StoreDoctorRequest;
use App\Http\Requests\Doctor\UpdateDoctorRequest;

class DoctorController extends Controller
{
    public function index(DoctorDataTable $dataTable)
    {
        try {
            return $dataTable->render('admin.doctors.index');
        } catch (Exception $e) {
            return to_route('dashboard')->with('error', 'Failed to fetch doctors: ' . $e->getMessage());
        }
    }

    public function create()
    {
        try {
            $positions = Position::where('status', 1)->orderBy('title','asc')->get();
            $specializations = Specialization::where('status', 1)->orderBy('title','asc')->get();

            $startYear = 1970;
            $endYear   = date('Y') + 1;
            $years = range($startYear, $endYear);

            return view('admin.doctors.create', compact('positions','specializations','years'));
        } catch (Exception $e) {
            return back()->with('error', 'Failed to load create form: ' . $e->getMessage());
        }
    }

    public function store(StoreDoctorRequest $request)
    {
        try {

            $validated = collect($request->validated())
            ->only(['name', 'position_id', 'affiliation','about_us','status'])
            ->toArray();
            $validated['status'] = $request->has('status') ? 1 : 0;

            if ($request->hasFile('image')) 
            {
                $image = $request->file('image');
                $imagePath = $image->store('uploads/doctors', 'public');
                $validated['image'] = $imagePath;
            }


            $create = Doctor::create($validated);
            if($request->has('education'))
            {
                foreach ($request->input('education', []) as $educationData) 
                {
                    $create->education()->create($educationData);
                }
            }

            // Handle positions
            if($request->has('positions'))
            {
                foreach ($request->input('positions', []) as $positionData)
                {
                    $create->positions()->create($positionData);
                }
            }

            // Handle affiliations
            if($request->has('affiliations'))
            {
                foreach ($request->input('affiliations', []) as $affiliationData)
                {
                    $create->affiliations()->create($affiliationData);
                }
            }

            // Handle specializations (many-to-many)
            if($request->has('specialization_id'))
            {
                foreach ($request->input('specialization_id', []) as $specializationId) 
                {
                    $create->doctorSpecializations()->create(['specialization_id' => $specializationId]);
                }
            }

            return redirect()->route('doctors.index')->with('success', 'Doctor created successfully.');
        } catch (Exception $e) 
        {
            echo $e->getMessage();die;
            return back()->withInput()->with('error', 'Failed to create doctor: ' . $e->getMessage());
        }
    }

    public function show($id)
    {
        try {
            $doctor = Doctor::findOrFail($id);
            return view('admin.doctors.show', compact('doctor'));
        } catch (Exception $e) {
            return back()->with('error', 'Failed to fetch doctor: ' . $e->getMessage());
        }
    }

    public function edit($id)
    {
        try {
            $doctor = Doctor::with('education','positions','affiliations','doctorSpecializations')->findOrFail($id);
            $selectedSpecializations = $doctor->doctorSpecializations->pluck('specialization_id')->toArray();
            $positions = Position::where('status', 1)->orderBy('title','asc')->get();
            $specializations = Specialization::where('status', 1)->orderBy('title','asc')->get();
            return view('admin.doctors.edit', compact('doctor', 'positions','specializations'));
        } catch (Exception $e) {
            return back()->with('error', 'Failed to load edit form: ' . $e->getMessage());
        }
    }

    public function update(UpdateDoctorRequest $request, $id)
    {
        try {
            // echo '<pre>';
            // print_r($request->all());
            // die;
            $doctor = Doctor::findOrFail($id);

            $validated = collect($request->validated())
            ->only(['name', 'position_id', 'affiliation','about_us','status'])
            ->toArray();
            $validated['status'] = $request->has('status') ? 1 : 0;

            if ($request->hasFile('image')) 
            {
                // Unlink old image if exists
                if ($doctor->image && Storage::disk('public')->exists($doctor->image)) 
                {
                    Storage::disk('public')->delete($doctor->image);
                }
                $image = $request->file('image');
                $imagePath = $image->store('uploads/doctors', 'public');
                $validated['image'] = $imagePath;
            }
            $doctor->update($validated);

            if($request->has('education'))
            {
                $doctor->education()->delete();
                foreach ($request->input('education', []) as $educationData) 
                {
                    $doctor->education()->create($educationData);
                }
            }

            // Handle positions
            if($request->has('positions'))
            {
                $doctor->positions()->delete();
                foreach ($request->input('positions', []) as $positionData)
                {
                    $doctor->positions()->create($positionData);
                }
            }

            // Handle affiliations
            if($request->has('affiliations'))
            {
                $doctor->affiliations()->delete();
                foreach ($request->input('affiliations', []) as $affiliationData)
                {
                    $doctor->affiliations()->create($affiliationData);
                }
            }

            // Handle specializations (many-to-many)
            if($request->has('specialization_id'))
            {
                $doctor->doctorSpecializations()->delete();
                foreach ($request->input('specialization_id', []) as $specializationId) 
                {
                    $doctor->doctorSpecializations()->create(['specialization_id' => $specializationId]);
                }
            }

            return redirect()->route('doctors.index')->with('success', 'Doctor updated successfully.');
        } catch (Exception $e) {
            return back()->withInput()->with('error', 'Failed to update doctor: ' . $e->getMessage());
        }
    }

    public function destroy($id)
    {
        try {
            $doctor = Doctor::findOrFail($id);
            $doctor->delete();
            return redirect()->route('doctors.index')->with('success', 'Doctor deleted successfully.');
        } catch (Exception $e) {
            return back()->with('error', 'Failed to delete doctor: ' . $e->getMessage());
        }
    }
}
