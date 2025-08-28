<?php
namespace App\Http\Controllers\Web;
use Throwable;
use Exception;
use PDOException;
use App\Models\Tag;
use App\Models\Blog;
use App\Models\Review;
use App\Models\BlogCategory;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\View;
use Illuminate\Database\Eloquent\ModelNotFoundException;
class BlogController extends Controller
{
    /**
     * Display a listing of the blogs.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  string|null  $slug
     * @return \Illuminate\Contracts\View\View|string|\Illuminate\Http\RedirectResponse
     */
    public function index(Request $request, $slug = null)
    {
        try 
        {
            $query = Blog::query()->where('Status', 1);

            // Apply search filter if provided
            if ($request->filled('search')) 
            {
                $query->where('Title', 'like', '%' . $request->search . '%');
            }

            $blogCategory = null;
            if (!empty($slug)) 
            {
                $blogCategory = BlogCategory::where('Parent_Id', 0)->where('Slug', $slug)->first();
                if ($blogCategory) 
                {
                    $query->where('Blog_Cat_Id', $blogCategory->id);
                }
            }
            
            $blogs = $query->orderByDesc('id')->paginate(3);
            $popularTags = Tag::withCount('blogs')->orderByDesc('blogs_count')->take(10)->get();
            $recentBlogs = Blog::where('Status', 1)->orderByDesc('id')->limit(3)->get();
            $blogCategories = BlogCategory::where('Parent_Id', 0)->where('Status', 1)->get();
            $viewData = [
                'blogs' => $blogs,
                'blog_categories' => $blogCategories,
                'recent_blogs' => $recentBlogs,
                'popularTags' => $popularTags,
            ];

            if ($request->ajax()) 
            {
                return view('web.blog.partials._list', $viewData)->render();
            }
            return view('web.blog.index', $viewData);

        } 
        catch (ModelNotFoundException $e) 
        {
            return to_route('home')->with('error', 'Resource not found.');
        } 
        catch (PDOException $e) 
        {
            return to_route('home')->with('error', 'A database error occurred. Please try again later.');
        } 
        catch (Exception $e) 
        {
            return to_route('home')->with('error', 'An unexpected error occurred. Please try again later.');
        }
    }

    /**
     * Display the details of a blog post or a blog category.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  string  $slug
     * @return \Illuminate\Contracts\View\View|\Illuminate\Http\RedirectResponse
     */
    public function details(Request $request, $slug)
    {
        try 
        {
            // Attempt to retrieve the blog post by slug
            $blog = Blog::with('tags')->where('Status', 1)->where('Slug', $slug)->first();

            if ($blog) 
            {
                $previousBlog = Blog::where('Status', 1)->where('id', '<', $blog->id)->orderBy('id', 'desc')->first();
                $nextBlog = Blog::where('Status', 1)->where('id', '>', $blog->id)->orderBy('id', 'asc')->first();
                $comments = Review::with('Children')->where([
                        ['Parent_Id', 0],
                        ['Blog_Id', $blog->id],
                        ['Status', 1],
                        ['Review_Status', 'Approved'],
                        ['Review_Type', 'Blog'],
                    ])
                    ->get();

                $recentBlogs = Blog::where('Status', 1)->orderByDesc('id')->limit(3)->get();
                $blogCategories = BlogCategory::where('Parent_Id', 0)->where('Status', 1)->get();

                $reviewQuery = Review::with('Children')
                                ->where([
                                    ['Blog_Id', $blog->id],
                                    ['Parent_Id', 0],
                                    ['Status', 1],
                                    ['Review_Status', 'Approved'],
                                ]);

                $reviewCount = $reviewQuery->count();
                $reviewEntities = $reviewQuery->get();

                return view('web.blog.detail', [
                    'blog' => $blog,
                    'comments' => $comments,
                    'nextBlog' => $nextBlog,
                    'previousBlog' => $previousBlog,
                    'recent_blogs' => $recentBlogs,
                    'review_count' => $reviewCount,
                    'blog_categories' => $blogCategories,
                    'review_entities' => $reviewEntities,
                ]);
            }

            // If not a blog post, attempt to retrieve as a category
            $category = BlogCategory::where('Slug', $slug)->first();

            if ($category) 
            {
                $query = Blog::query()->where('Status', 1);
                // Filter by category if found
                $query->where('Blog_Cat_Id', $category->id);

                $recentBlogs = Blog::where('Status', 1)->orderByDesc('id')->limit(3)->get();
                $blogCategories = BlogCategory::where('Parent_Id', 0)->where('Status', 1)->get();

                $blogs = $query->orderByDesc('id')->paginate(3);

                $popularTags = Tag::withCount('blogs')->orderByDesc('blogs_count')->take(10)->get();
                    return view('web.blog.index', [
                    'blogs' => $blogs,
                    'category' => $category,
                    'popularTags' => $popularTags,
                    'recent_blogs' => $recentBlogs,
                    'blog_categories' => $blogCategories,
                ]);
            }
            return to_route('home')->with('error', 'Blog not found.');
        } 
        catch (Throwable $e) 
        {
            return to_route('home')->with('error', $e->getMessage());
        }
    }

    /**
     * Display blogs associated with a specific tag.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  string  $slug
     * @return \Illuminate\Contracts\View\View|\Illuminate\Http\RedirectResponse
     */
    public function tag(Request $request, $slug)
    {
        try 
        {
            $tag = Tag::where('slug', $slug)->firstOrFail();
            $blogs = Blog::where('Status', 1)
                ->whereHas('tags', function ($query) use ($slug) {
                    $query->where('slug', $slug);
                })
                ->orderByDesc('id')
                ->paginate(6);

                $popularTags = Tag::withCount('blogs')->orderByDesc('blogs_count')->take(10)->get();
                $recent_blogs = Blog::where('Status', 1)->orderByDesc('id')->limit(3)->get();
                $blog_categories = BlogCategory::where('Parent_Id', 0)->where('Status', 1)->get();

            return view('web.blog.index', compact('blogs', 'blog_categories', 'recent_blogs', 'popularTags', 'tag'));
        } 
        catch (ModelNotFoundException | PDOException | Exception $e) 
        {
            return to_route('home')->with('error', $e->getMessage());
        }
    }
}
?>