<?php
namespace App\Http\Controllers\Admin;
use Exception;
use App\Models\Team;
use App\Models\Position;
use App\Models\Department;
use Illuminate\Http\Request;
use App\DataTables\TeamDataTable;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\Team\StoreTeamRequest;
use App\Http\Requests\Team\UpdateTeamRequest;

class TeamController extends Controller
{
    public function index(TeamDataTable $dataTable)
    {
        try {
            return $dataTable->render('Admin.teams.index');
        } catch (Exception $e) {
            return to_route('dashboard')->with('error', 'Failed to fetch team: ' . $e->getMessage());
        }
    }

    public function create()
    {
        try {
            $departments = Department::where('status', 1)->orderBy('name', 'asc')->pluck('name', 'id');
            $positions = Position::where('status', 1)->orderBy('title', 'asc')->pluck('title', 'id');
            return view('Admin.teams.create', compact('departments', 'positions'));
        } catch (Exception $e) {
            return back()->with('error', 'Failed to load create form: ' . $e->getMessage());
        }
    }

    public function store(StoreTeamRequest $request)
    {
        try {
            $validated = $request->validated();
            $validated['status'] = $request->input('status') == 1 ? 1 : 0;
            if ($request->hasFile('file_name')) {
                $file = $request->file('file_name');
                $fileName = $file->hashName();
                $fileType = $file->getClientMimeType();
                $filePath = $file->storeAs('uploads/teams', $fileName, 'public');
                $validated['file_name'] = $filePath;
                $validated['file_type'] = $fileType;
            }
            Team::create($validated);
            return redirect()->route('teams.index')->with('success', 'Team created successfully.');
        } catch (Exception $e) {
            return back()->withInput()->with('error', 'Failed to create team: ' . $e->getMessage());
        }
    }

    public function show($id)
    {
        try {
            $team = Team::with(['department', 'position'])->findOrFail($id);
            return view('Admin.teams.show', compact('team'));
        } catch (Exception $e) {
            return back()->with('error', 'Failed to fetch team: ' . $e->getMessage());
        }
    }

    public function edit($id)
    {
        try {
            $team = Team::findOrFail($id);
            $departments = Department::where('status', 1)->orderBy('name', 'asc')->pluck('name', 'id');
            $positions = Position::where('status', 1)->orderBy('title', 'asc')->pluck('title', 'id');
            return view('Admin.teams.edit', compact('team', 'departments', 'positions'));
        } catch (Exception $e) {
            return back()->with('error', 'Failed to load edit form: ' . $e->getMessage());
        }
    }

    public function update(UpdateTeamRequest $request, $id)
    {
        try {
            
            $team = Team::findOrFail($id);
            $validated = $request->validated();
            $validated['status'] = $request->input('status') == 1 ? 1 : 0;
            if ($request->hasFile('file_name')) {
                // Delete old file if exists
                if (!empty($team->file_name) && Storage::disk('public')->exists($team->file_name)) {
                    Storage::disk('public')->delete($team->file_name);
                }
                $file = $request->file('file_name');
                $fileName = $file->hashName();
                $fileType = $file->getClientMimeType();
                $filePath = $file->storeAs('uploads/teams', $fileName, 'public');
                $validated['file_name'] = $filePath;
                $validated['file_type'] = $fileType;
            }
            $team->update($validated);
            return redirect()->route('teams.index')->with('success', 'Team updated successfully.');
        } catch (Exception $e) {
            return back()->withInput()->with('error', 'Failed to update team: ' . $e->getMessage());
        }
    }

    public function destroy($id)
    {
        try {
            $team = Team::findOrFail($id);
            if (!empty($team->file_name) && Storage::disk('public')->exists($team->file_name)) {
                Storage::disk('public')->delete($team->file_name);
            }
            $team->delete();
            return redirect()->route('teams.index')->with('success', 'Team deleted successfully.');
        } catch (Exception $e) {
            return back()->with('error', 'Failed to delete team: ' . $e->getMessage());
        }
    }
}
