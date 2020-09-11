<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\PostRequest;
use App\Models\Category;
use App\Models\Post;
use App\Models\Tag;
use App\Models\Thumbnail;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (Auth::user()->hasRole('administrator')) {
            $posts = Post::with(['thumbnail' , 'category', 'user'])->latest()->paginate(10);
        }else{
            $posts = Post::with(['thumbnail' , 'category', 'user'])->latest()->paginate(30);
        }
        return view('pages.admin.post.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::get();
        $tags = Tag::get();
        return view('pages.admin.post.create', compact('categories', 'tags'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PostRequest $request)
    {
        $params = $request->all();
        // $thumbnail = request()->file('thumbail')->store("images/posts");
        $slug = Str::slug($params['title']);
        $params['slug'] = $slug;
        $params['category_id'] = request('category');
        $params['user_id'] = Auth::user()->id;

        $post = auth()->user()->post()->create($params);
        $post->tags()->attach($request->tag);

        session()->flash('success', 'Post Berhasil ditambahkan Jangan lupa untuk mengupload thumbnailnya!!');

        return redirect()->route('post.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $posts = Post::findOrFail($id);
        return view('pages.admin.post.show', compact('posts'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (Auth::user()->hasRole('administrator')) {
            $post = Post::findOrfail($id);
        } elseif (Post::findOrfail($id)->user_id == Auth::user()->id) {
            $post = Post::findOrfail($id);
        } else {
            return redirect()->route('post.index');
        }

        $categories = Category::get();
        $tags = Tag::get();
        return view('pages.admin.post.edit', compact('categories', 'tags', 'post'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(PostRequest $request, $id)
    {
        if (Auth::user()->hasRole('administrator')) {
            $post = Post::findOrfail($id);
        } elseif (Post::findOrfail($id)->user_id == Auth::user()->id) {
            $post = Post::findOrfail($id);
        } else {
            return redirect()->back();
        }
        // validasi untuk menghapus gambar yg sebelumnya jika diupdate
        // if (request()->file('thumbnail')) {
        //     Storage::delete($post->thumbnail);
        //     $thumbnail = request()->file('thumbnail')->store("images/posts");
        // } else {
        //     $thumbnail = $post->thumbnail;
        // }

        $params = $request->all();
        $params['category_id'] = request('category');
        $post->update($params);
        $post->tags()->sync(request('tag'));

        session()->flash('success', 'Post Berhasil diubah');

        return redirect()->route('post.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        if (Auth::user()->hasRole('administrator')) {
            $post = Post::findOrfail($id);
            $thumbnail = Thumbnail::where('post_id', $id)->first();
        } elseif (Post::findOrfail($id)->user_id == Auth::user()->id) {
            $post = Post::findOrfail($id);
            $thumbnail = Thumbnail::where('post_id', $id)->first();
        } else {
            return redirect()->back();
        }
        $post->delete();
        $thumbnail->delete();

        session()->flash('success', 'Post Berhasil dihapus');

        return redirect()->route('post.index');
    }


    public function tampil_hapus()
    {
        $posts = Post::onlyTrashed()->latest()->paginate(10);
        $user = User::onlyTrashed()->get();
        $thumbnail = Thumbnail::onlyTrashed()->get();
        return view('pages.admin.post.hapus', compact('posts', 'thumbnail', 'user'));
    }

    public function restore($id)
    {
        $post = Post::withTrashed()->where('id', $id)->first();
        $thumbnail = Thumbnail::withTrashed()->where('post_id', $id)->first();
        $thumbnail->restore();
        $post->restore();

        session()->flash('success', 'Post Berhasil direstore');

        return redirect()->back();
    }

    public function kill($id)
    {
        $post = Post::withTrashed()->where('id', $id)->first();
        $thumbnail = Thumbnail::withTrashed()->where('post_id', $id)->first();
        $post->forceDelete();
        $post->tags()->detach(); //ini untuk menghapus di table post_tag
        Storage::delete([$thumbnail->s, $thumbnail->m, $thumbnail->l, $thumbnail->xl, $thumbnail->xxl, $thumbnail->image]); //unuk delete gambar di storage

        session()->flash('success', 'Post Berhasil dihapus secara permanen');

        return redirect()->back();
    }

    // public function data_ajax()
    // {
    //     $items = Post::with(['thumbnail', 'category', 'user'])->latest()->get();
    //     // dd($items->thumbnail);
    //     if (Auth::user()->hasRole('author')) {
    //         if (Auth::user()->id == $items->user->id) {
    //             return datatables()->of($items)
    //                 ->addColumn('category', function ($i) {
    //                     return $i->category->name;
    //                 })
    //                 ->addColumn('thumbnail', function ($i) {
    //                     return '<img src="' . Storage::url($i->thumbnail->first()->s) . '" alt="" class="img-fluid">';
    //                 })
    //                 ->addColumn('user', function ($i) {
    //                     return $i->user->name;
    //                 })
    //                 ->addColumn('action', function ($i) {
    //                     return '<form action="' . route('post.destroy', $i->id) . '"method="post">
    //                                 <input type="hidden" name="_token" value="' . csrf_token() . '">
    //                                 <input type="hidden" name="_method" value="delete">
    //                                 <a href="' . route('post.show', $i->id) . '" class="btn btn-primary btn-sm"><i class="fa fa-eye"></i></a>
    //                                 <a href="{' . route('post.edit', $i->id) . '" class="btn btn-primary btn-sm"><i class="fa fa-pencil-alt"></i></a>
    //                                 <button class=" btn btn-danger btn-sm" type="submit" onclick="return confirm(\'Apakah anda yakin ingin menghapus ?\')"><i class="fa fa-trash"></i></button>
    //                             </form>';
    //                 })
    //                 ->rawColumns(['thumbnail', 'action'])
    //                 ->make(true);
    //         }
    //     } else {
    //         return datatables()->of($items)
    //             ->addColumn('category', function ($i) {
    //                 return $i->category->name;
    //             })
    //             ->addColumn('thumbnail', function ($i) {
    //                 return '<img src="' . Storage::url($i->thumbnail->first()->s) . '" alt="" class="img-fluid">';
    //             })
    //             ->addColumn('user', function ($i) {
    //                 return $i->user->name;
    //             })
    //             ->addColumn('action', function ($i) {
    //                 return '<form action="' . route('post.destroy', $i->id) . '"method="post">
    //                                 <input type="hidden" name="_token" value="' . csrf_token() . '">
    //                                 <input type="hidden" name="_method" value="delete">
    //                                 <a href="' . route('post.show', $i->id) . '" class="btn btn-primary btn-sm"><i class="fa fa-eye"></i></a>
    //                                 <a href="{' . route('post.edit', $i->id) . '" class="btn btn-primary btn-sm"><i class="fa fa-pencil-alt"></i></a>
    //                                 <button class=" btn btn-danger btn-sm" type="submit" onclick="return confirm(\'Apakah anda yakin ingin menghapus ?\')"><i class="fa fa-trash"></i></button>
    //                             </form>';
    //             })
    //             ->rawColumns(['thumbnail', 'action'])
    //             ->make(true);
    //     }
    // }
}
