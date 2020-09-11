<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use App\Models\Tag;
use App\Models\Thumbnail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $banner1 = Post::with(['thumbnail'])->latest()->take(1)->first();
        $banner2 = Post::with(['thumbnail'])->where('id', '!=', $banner1->id)->latest()->take(1)->first();
        $banner3 = Post::with(['thumbnail'])->where('id', '!=', $banner1->id)-> where('id', '!=', $banner2->id)->latest()->take(1)->first();
        $populars = $this->populars();
        $posts = Post::with(['thumbnail'])->where('id', '!=', $banner2->id)->where('id', '!=', $banner1->id)->where('id', '!=', $banner3->id)->latest()->limit(6)->get();
        $categories = Category::all();
        $thum = Thumbnail::all();
        // dd($pop->thumbnail);
        $tags = Tag::all();
        return view('pages.home', compact('posts', 'categories', 'populars', 'banner2', 'banner1', 'banner3', 'tags', 'thum'));
    }

    public function post($slug){
        $populars = $this->populars();
        $posts = Post::with(['thumbnail'])->latest()->limit(6)->get();
        $post = Post::where('slug', $slug)->first();
        $categories = Category::all();
        $tags = Tag::all();
        $thum = Thumbnail::all();
        views($post)->record(); //ini untuk menyimpan view dari package https://github.com/cyrildewit/eloquent-viewable
        return view('pages.blog.post', compact('post', 'categories', 'populars', 'tags', 'thum'));
    }

    public function all_post()
    {
        $populars = $this->populars();
        $posts = Post::latest()->limit(6)->get();
        $posts = Post::latest()->paginate(8);
        $categories = Category::all();
        $tags = Tag::all();
        $thum = Thumbnail::all();
        return view('pages.blog.all-post', compact('posts', 'categories', 'populars', 'tags', 'thum'));
    }

    public function category(Category $category){
        $populars = $this->populars();
        $posts = Post::latest()->limit(6)->get();
        $categories = Category::all();
        $posts = $category->post()->latest()->paginate(6);
        $tags = Tag::all();
        $thum = Thumbnail::all();
        return view('pages.blog.all-post', compact('posts','categories', 'populars', 'tags', 'thum'));
    }

    public function tag(Tag $tag)
    {
        $populars = $this->populars();
        $posts = Post::latest()->limit(6)->get();
        $categories = Category::all();
        $posts = $tag->post()->latest()->paginate(6);
        $tags = Tag::all();
        $thum = Thumbnail::all();
        return view('pages.blog.all-post', compact('posts', 'categories', 'populars', 'tags', 'thum'));
    }

    public function search(){
        $populars = $this->populars();
        $categories = Category::all();
        $tags = Tag::all();
        $query = request('query');
        $posts = Post::where("title", "like", "%$query%")->latest()->paginate(6);
        return view('pages.blog.all-post', compact('posts', 'categories', 'populars', 'tags'));
    }

    public function populars(){
        return DB::table('posts')
            ->join('views', 'posts.id', '=', 'views.viewable_id')
            ->select(DB::raw('count(viewable_id) as count'), 'posts.id', 'posts.title', 'posts.slug', 'posts.category_id')
            ->groupBy('id', 'title', 'slug', 'category_id',)
            ->orderBy('count', 'desc')
            ->take(4)
            ->get();
    }

    
}
