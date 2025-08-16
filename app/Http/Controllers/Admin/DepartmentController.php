<?php
namespace App\Http\Controllers\Admin;
use Exception;
use App\Models\Department;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\DataTables\DepartmentDataTable;
use App\Http\Requests\StoreDepartmentRequest;
use App\Http\Requests\UpdateDepartmentRequest;

class DepartmentController extends Controller
{
    public function index(DepartmentDataTable $dataTable)
    {
        try 
        {
            return $dataTable->render('admin.departments.index');
        } 
        catch (Exception $e) 
        {
            return to_route('dashboard')->with('error', 'Failed to fetch departments: ' . $e->getMessage());
        }
    }

    public function create()
    {
        try 
        {
            return view('admin.departments.create');
        } 
        catch (Exception $e) 
        {
            return back()->with('error', 'Failed to load create form: ' . $e->getMessage());
        }
    }

    public function store(StoreDepartmentRequest $request)
    {
        try 
        {
            Department::create($request->validated());
            return redirect()->route('departments.index')->with('success', 'Department created successfully.');
        } 
        catch (Exception $e) 
        {
            return back()->withInput()->with('error', 'Failed to create department: ' . $e->getMessage());
        }
    }

    public function show($id)
    {
        try 
        {
            $department = Department::findOrFail($id);
            return view('admin.departments.show', compact('department'));
        } 
        catch (Exception $e) 
        {
            return back()->with('error', 'Failed to fetch department: ' . $e->getMessage());
        }
    }

    public function edit($id)
    {
        try 
        {
            $department = Department::findOrFail($id);
            return view('admin.departments.edit', compact('department'));
        } 
        catch (Exception $e) 
        {
            return back()->with('error', 'Failed to load edit form: ' . $e->getMessage());
        }
    }

    public function update(UpdateDepartmentRequest $request, $id)
    {
        try 
        {
            $department = Department::findOrFail($id);
            $department->update($request->validated());
            return redirect()->route('departments.index')->with('success', 'Department updated successfully.');
        } 
        catch (Exception $e) 
        {
            return back()->withInput()->with('error', 'Failed to update department: ' . $e->getMessage());
        }
    }

    public function destroy($id)
    {
        try 
        {
            $department = Department::findOrFail($id);
            $department->delete();
            return redirect()->route('departments.index')->with('success', 'Department deleted successfully.');
        } 
        catch (Exception $e) 
        {
            return back()->with('error', 'Failed to delete department: ' . $e->getMessage());
        }
    }
}
