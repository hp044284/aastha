<?php
namespace App\Http\Controllers\Admin;
use Exception;
use App\Models\News;
use App\Models\Event;
use Illuminate\Http\Request;
use App\DataTables\NewsDataTable;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\News\StoreNewsRequest;
use App\Http\Requests\News\UpdateNewsRequest;

class NewsController extends Controller
{
    public function index(NewsDataTable $dataTable)
    {
        try {
            return $dataTable->render('Admin.news.index');
        } catch (Exception $e) {
            return to_route('dashboard')->with('error', 'Failed to fetch news: ' . $e->getMessage());
        }
    }

    public function create()
    {
        try {
            $evnts = Event::where('status',1)->orderBy('id','DESC')->pluck('title','id');
            return view('Admin.news.create',compact('evnts'));
        } catch (Exception $e) {
            return back()->with('error', 'Failed to load create form: ' . $e->getMessage());
        }
    }

    public function store(StoreNewsRequest $request)
    {
        try 
        {
            $validated = $request->validated();
            $validated['status'] = $request->has('status') ? 1 : 0;
            if ($request->hasFile('file_name')) {
                $file = $request->file('file_name');
                $fileName = $file->hashName();
                $fileType = $file->getClientMimeType();
                $filePath = $file->storeAs('uploads/news', $fileName, 'public'); // Laravel storage method
                $validated['file_name'] = $fileName;
                $validated['file_type'] = $fileType;
            }
            
            News::create($validated);
            return redirect()->route('news.index')->with('success', 'News created successfully.');
        } 
        catch (Exception $e) 
        {
            return back()->withInput()->with('error', 'Failed to create news: ' . $e->getMessage());
        }
    }

    public function show($id)
    {
        try 
        {
            $news = News::findOrFail($id);
            return view('Admin.news.show', compact('news'));
        } 
        catch (Exception $e) 
        {
            return back()->with('error', 'Failed to fetch news: ' . $e->getMessage());
        }
    }

    public function edit($id)
    {
        try 
        {
            $news = News::findOrFail($id);
            $evnts = Event::where('status',1)->orderBy('id','DESC')->pluck('title','id');
            return view('Admin.news.edit', compact('news','evnts'));
        } 
        catch (Exception $e) 
        {
            return back()->with('error', 'Failed to load edit form: ' . $e->getMessage());
        }
    }

    public function update(UpdateNewsRequest $request, $id)
    {
        try 
        {
            $news = News::findOrFail($id);
            $validated = $request->validated();
            $validated['status'] = $request->has('status') ? 1 : 0;
            if ($request->hasFile('file_name')) {
                // Unlink old file if exists
                if (!empty($news->file_name) && Storage::disk('public')->exists('uploads/news/' . $news->file_name)) 
                {
                    Storage::disk('public')->delete('uploads/news/' . $news->file_name);
                }
                $file = $request->file('file_name');
                $fileName = $file->hashName();
                $fileType = $file->getClientMimeType();
                $filePath = $file->storeAs('uploads/news', $fileName, 'public'); // Laravel storage method
                $validated['file_name'] = $fileName;
                $validated['file_type'] = $fileType;
            }
            $news->update($validated);
            return redirect()->route('news.index')->with('success', 'News updated successfully.');
        } 
        catch (Exception $e) 
        {
            return back()->withInput()->with('error', 'Failed to update news: ' . $e->getMessage());
        }
    }

    public function destroy($id)
    {
        try 
        {
            $news = News::findOrFail($id);
            if (!empty($news->file_name) && Storage::disk('public')->exists('uploads/news/' . $news->file_name)) 
            {
                Storage::disk('public')->delete('uploads/news/' . $news->file_name);
            }
            $news->delete();
            return redirect()->route('news.index')->with('success', 'News deleted successfully.');
        } 
        catch (Exception $e) 
        {
            return back()->with('error', 'Failed to delete news: ' . $e->getMessage());
        }
    }
}
