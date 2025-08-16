<?php
namespace App\Http\Controllers\Admin;
use Exception;
use App\Models\Position;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\DataTables\PositionDataTable;
use App\Http\Requests\Position\StorePositionRequest;
use App\Http\Requests\Position\UpdatePositionRequest;

class PositionController extends Controller
{
    public function index(PositionDataTable $dataTable)
    {
        try {
            return $dataTable->render('admin.positions.index');
        } catch (Exception $e) {
            return to_route('dashboard')->with('error', 'Failed to fetch positions: ' . $e->getMessage());
        }
    }

    public function create()
    {
        try {
            return view('admin.positions.create');
        } catch (Exception $e) {
            return back()->with('error', 'Failed to load create form: ' . $e->getMessage());
        }
    }

    public function store(StorePositionRequest $request)
    {
        try 
        {
            $validated = $request->validated();
            $validated['status'] = $request->has('status') ? 1 : 0;
            
            Position::create($validated);
            return redirect()->route('positions.index')->with('success', 'Position created successfully.');
        } 
        catch (Exception $e) 
        {
            return back()->withInput()->with('error', 'Failed to create position: ' . $e->getMessage());
        }
    }

    public function show($id)
    {
        try 
        {
            $position = Position::findOrFail($id);
            return view('admin.positions.show', compact('position'));
        } 
        catch (Exception $e) 
        {
            return back()->with('error', 'Failed to fetch position: ' . $e->getMessage());
        }
    }

    public function edit($id)
    {
        try 
        {
            $position = Position::findOrFail($id);
            return view('admin.positions.edit', compact('position'));
        } 
        catch (Exception $e) 
        {
            return back()->with('error', 'Failed to load edit form: ' . $e->getMessage());
        }
    }

    public function update(UpdatePositionRequest $request, $id)
    {
        try 
        {
            $position = Position::findOrFail($id);
            $validated = $request->validated();
            $validated['status'] = $request->has('status') ? 1 : 0;
            $position->update($validated);
            return redirect()->route('positions.index')->with('success', 'Position updated successfully.');
        } 
        catch (Exception $e) 
        {
            return back()->withInput()->with('error', 'Failed to update position: ' . $e->getMessage());
        }
    }

    public function destroy($id)
    {
        try 
        {
            $position = Position::findOrFail($id);
            $position->delete();
            return redirect()->route('positions.index')->with('success', 'Position deleted successfully.');
        } 
        catch (Exception $e) 
        {
            return back()->with('error', 'Failed to delete position: ' . $e->getMessage());
        }
    }
}
