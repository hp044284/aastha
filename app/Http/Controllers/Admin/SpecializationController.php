<?php
namespace App\Http\Controllers\Admin;
use Exception;
use App\Models\Specialization;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\DataTables\SpecializationDataTable;
use App\Http\Requests\StoreSpecializationRequest;
use App\Http\Requests\UpdateSpecializationRequest;

class SpecializationController extends Controller
{
    public function index(SpecializationDataTable $dataTable)
    {
        try 
        {
            return $dataTable->render('admin.specializations.index');
        } 
        catch (Exception $e) 
        {
            return to_route('dashboard')->with('error', 'Failed to fetch specializations: ' . $e->getMessage());
        }
    }

    public function create()
    {
        try 
        {
            return view('admin.specializations.create');
        } 
        catch (Exception $e) 
        {
            return back()->with('error', 'Failed to load create form: ' . $e->getMessage());
        }
    }

    public function store(StoreSpecializationRequest $request)
    {
        try 
        {
            Specialization::create($request->validated());
            return redirect()->route('specializations.index')->with('success', 'Specialization created successfully.');
        } 
        catch (Exception $e) 
        {
            return back()->withInput()->with('error', 'Failed to create specialization: ' . $e->getMessage());
        }
    }

    public function show($id)
    {
        try 
        {
            $specialization = Specialization::findOrFail($id);
            return view('admin.specializations.show', compact('specialization'));
        } 
        catch (Exception $e) 
        {
            return back()->with('error', 'Failed to fetch specialization: ' . $e->getMessage());
        }
    }

    public function edit($id)
    {
        try 
        {
            $specialization = Specialization::findOrFail($id);
            return view('admin.specializations.edit', compact('specialization'));
        } 
        catch (Exception $e) 
        {
            return back()->with('error', 'Failed to load edit form: ' . $e->getMessage());
        }
    }

    public function update(UpdateSpecializationRequest $request, $id)
    {
        try 
        {
            $specialization = Specialization::findOrFail($id);
            $specialization->update($request->validated());
            return redirect()->route('specializations.index')->with('success', 'Specialization updated successfully.');
        } 
        catch (Exception $e) 
        {
            return back()->withInput()->with('error', 'Failed to update specialization: ' . $e->getMessage());
        }
    }

    public function destroy($id)
    {
        try 
        {
            $specialization = Specialization::findOrFail($id);
            $specialization->delete();
            return redirect()->route('specializations.index')->with('success', 'Specialization deleted successfully.');
        } 
        catch (Exception $e) 
        {
            return back()->with('error', 'Failed to delete specialization: ' . $e->getMessage());
        }
    }
}
