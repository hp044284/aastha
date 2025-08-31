<?php
namespace App\Http\Controllers\Web;
use Throwable;
use App\Models\News;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class NewsController extends Controller
{
    public function index(Request $request)
    {
        try 
        {
            $news = News::where('status',1)->orderBy('id','DESC')->paginate(1);
            if ($request->ajax()) 
            {
                $html = view('web.news.news-items', compact('news'))->render();
                return response()->json([
                    'html' => $html,
                    'hasMorePages' => $news->hasMorePages(),
                    'currentPage' => $news->currentPage(),
                    'lastPage' => $news->lastPage(),
                    'total' => $news->total(),
                    'perPage' => $news->perPage()
                ]);
            }
            return view('web.news.index',compact('news'));
        } 
        catch (Throwable $th) 
        {
            return redirect()->route('home')->with('error', $th->getMessage());
        }
    }

    public function loadMore(Request $request)
    {
        try 
        {
            $page = $request->get('page', 1);
            $news = News::where('status',1)->orderBy('id','DESC')->paginate(10, ['*'], 'page', $page);
            
            if ($request->ajax()) {
                $html = view('web.news.news-items', compact('news'))->render();
                return response()->json([
                    'html' => $html,
                    'hasMorePages' => $news->hasMorePages(),
                    'currentPage' => $news->currentPage(),
                    'lastPage' => $news->lastPage(),
                    'total' => $news->total(),
                    'perPage' => $news->perPage()
                ]);
            }
            
            return response()->json(['error' => 'Invalid request'], 400);
        } 
        catch (Throwable $th) 
        {
            return response()->json(['error' => $th->getMessage()], 500);
        }
    }

    public function show($id)
    {
        try 
        {
            $news = News::findOrFail($id);
            return view('web.news.show', compact('news'));
        } 
        catch (Throwable $th) 
        {
            return redirect()->route('web.news.index')->with('error', $th->getMessage());
        }
    }
}
