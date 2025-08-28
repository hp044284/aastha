<?php
namespace App\Http\Controllers\Admin;
use Exception;
use App\Models\CaseStudy;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\DataTables\CaseStudyDataTable;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\CaseStudy\StoreCaseStudyRequest;
use App\Http\Requests\CaseStudy\UpdateCaseStudyRequest;

class CaseStudyController extends Controller
{
    public function index(CaseStudyDataTable $dataTable)
    {
        try {
            return $dataTable->render('Admin.case-studies.index');
        } catch (Exception $e) {
            return to_route('dashboard')->with('error', 'Failed to fetch case studies: ' . $e->getMessage());
        }
    }

    public function create()
    {
        try {
            return view('Admin.case-studies.create');
        } catch (Exception $e) {
            return back()->with('error', 'Failed to load create form: ' . $e->getMessage());
        }
    }

    public function store(StoreCaseStudyRequest $request)
    {
        try {
            $validated = $request->validated();
            $validated['status'] = $request->has('status') ? 1 : 0;

            if ($request->hasFile('image')) {
                $validated['image'] = $request->file('image')->store('uploads/case_studies', 'public');
            }

            CaseStudy::create($validated);
            return redirect()->route('case-studies.index')->with('success', 'Case Study created successfully.');
        } 
        catch (Exception $e) 
        {
            echo $e->getMessage();
            die;
            return back()->withInput()->with('error', 'Failed to create case study: ' . $e->getMessage());
        }
    }

    public function show($id)
    {
        try {
            $caseStudy = CaseStudy::findOrFail($id);
            return view('Admin.case-studies.show', compact('caseStudy'));
        } catch (Exception $e) {
            return back()->with('error', 'Failed to fetch case study: ' . $e->getMessage());
        }
    }

    public function edit($id)
    {
        try {
            $caseStudy = CaseStudy::findOrFail($id);
            return view('Admin.case-studies.edit', compact('caseStudy'));
        } catch (Exception $e) {
            return back()->with('error', 'Failed to load edit form: ' . $e->getMessage());
        }
    }

    public function update(UpdateCaseStudyRequest $request, $id)
    {
        try {
            $caseStudy = CaseStudy::findOrFail($id);
            $validated = $request->validated();
            $validated['status'] = $request->has('status') ? 1 : 0;

            if ($request->hasFile('image')) 
            {
                // Delete old image if it exists
                if ($caseStudy->image && Storage::disk('public')->exists($caseStudy->image)) 
                {
                    Storage::disk('public')->delete($caseStudy->image);
                }
                $validated['image'] = $request->file('image')->store('uploads/case_studies', 'public');
            }

            $caseStudy->update($validated);
            return redirect()->route('case-studies.index')->with('success', 'Case Study updated successfully.');
        } catch (Exception $e) {
            return back()->withInput()->with('error', 'Failed to update case study: ' . $e->getMessage());
        }
    }

    public function destroy($id)
    {
        try {
            $caseStudy = CaseStudy::findOrFail($id);
            $caseStudy->delete();
            return redirect()->route('case-studies.index')->with('success', 'Case Study deleted successfully.');
        } catch (Exception $e) {
            return back()->with('error', 'Failed to delete case study: ' . $e->getMessage());
        }
    }
}
