<?php
namespace App\Http\Controllers\Admin;
use Exception;
use App\Models\Doctor;
use App\Models\Position;
use Illuminate\Http\Request;
use App\Models\Specialization;
use App\DataTables\DoctorDataTable;
use App\Http\Controllers\Controller;
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
            
            return view('admin.doctors.create', compact('positions','specializations'));
        } catch (Exception $e) {
            return back()->with('error', 'Failed to load create form: ' . $e->getMessage());
        }
    }

    public function store(StoreDoctorRequest $request)
    {
        try {
            echo '<pre>';
            print_r($request->all());die;
            $validated = $request->validated();
            $validated['status'] = $request->has('status') ? 1 : 0;

            Doctor::create($validated);
            return redirect()->route('doctors.index')->with('success', 'Doctor created successfully.');
        } catch (Exception $e) {
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
            $doctor = Doctor::findOrFail($id);
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
            $doctor = Doctor::findOrFail($id);
            $validated = $request->validated();
            $validated['status'] = $request->has('status') ? 1 : 0;
            $doctor->update($validated);
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
