<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ThumbnailRequest;
use App\Models\Post;
use App\Models\Thumbnail;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManagerStatic;

class ThumbnailController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (Auth::user()->hasRole('administrator')) {
            $thumbnails = Thumbnail::with(['post'])->latest()->paginate(10);
        }else{
            $thumbnails = Thumbnail::with(['post'])->latest()->paginate(30);
        }
        return view('pages.admin.thumbnail.index', compact('thumbnails'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $posts = Post::all();
        return view('pages.admin.thumbnail.create', compact('posts'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ThumbnailRequest $request)
    {
        $thumbnail = Thumbnail::all();

        if ($request->has('image')) {
            // ini validasi jika post sudah ada maka tendang usernya
            foreach ($thumbnail as $id) {
                if ($request->post_id == $id->post_id) {
                    session()->flash('error', 'Thumbnail Untuk Post tersebut sudah ada silahkan gunakan post yang lain!');
                    return redirect()->route('thumbnail.index');
                }
            }
            
            $post = Post::findOrFail($request->post_id);
            $image = $request->file('image');
            $name = $post->slug . '_' . time();
            $fileName = $name . '.' . $image->getClientOriginalExtension();
            $folder = Thumbnail::UPLOAD_DIR . '/images';
            $filePath = $image->store($folder .  '/original');
            $resizedImage = $this->_resizeImage($image,  $fileName, $folder);
            $params = array_merge(
                [
                    'post_id' => $request->post_id,
                    'image' => $filePath,
                ],
                $resizedImage
            );

            Thumbnail::create($params);
            session()->flash('success', 'Thumbnail Berhasil ditambahkan');
            return redirect()->route('thumbnail.index');
        
        }
        
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
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
            $thumbnail = Thumbnail::findOrfail($id);
        } elseif (Thumbnail::findOrfail($id)->post->user_id == Auth::user()->id) {
            $thumbnail = Thumbnail::findOrfail($id);
        } else {
            return redirect()->back();
        }
        $thumbnail->delete();
        Storage::delete([$thumbnail->s, $thumbnail->m, $thumbnail->l, $thumbnail->xl, $thumbnail->xxl, $thumbnail->image]);

        session()->flash('success', 'Thumbnail Berhasil dihapus');

        return redirect()->route('thumbnail.index');
    }

    private function _resizeImage($image, $fileName, $folder)
    {
        $resizedImage = [];

        $smallImageFilePath = $folder . '/small/' . $fileName;
        $size = explode('x', Thumbnail::s);
        list($width, $height) = $size;

        $smallImageFile = ImageManagerStatic::make($image)->resize($width, $height)->stream();
        if (Storage::put($smallImageFilePath, $smallImageFile)) {
            $resizedImage['s'] = $smallImageFilePath;
        }

        $mediumImageFilePath = $folder . '/medium/' . $fileName;
        $size = explode('x', Thumbnail::m);
        list($width, $height) = $size;

        $mediumImageFile = ImageManagerStatic::make($image)->resize($width, $height)->stream();
        if (Storage::put($mediumImageFilePath, $mediumImageFile)) {
            $resizedImage['m'] = $mediumImageFilePath;
        }

        $largeImageFilePath = $folder . '/large/' . $fileName;
        $size = explode('x', Thumbnail::l);
        list($width, $height) = $size;

        $largeImageFile = ImageManagerStatic::make($image)->resize($width, $height)->stream();
        if (Storage::put($largeImageFilePath, $largeImageFile)) {
            $resizedImage['l'] = $largeImageFilePath;
        }

        $extraLargeImageFilePath  = $folder . '/xlarge/' . $fileName;
        $size = explode('x', Thumbnail::xl);
        list($width, $height) = $size;

        $extraLargeImageFile = ImageManagerStatic::make($image)->resize($width, $height)->stream();
        if (Storage::put($extraLargeImageFilePath, $extraLargeImageFile)) {
            $resizedImage['xl'] = $extraLargeImageFilePath;
        }

        $exextraLargeImageFilePath  = $folder . '/xxlarge/' . $fileName;
        $size = explode('x', Thumbnail::xxl);
        list($width, $height) = $size;

        $exextraLargeImageFile = ImageManagerStatic::make($image)->resize($width, $height)->stream();
        if (Storage::put($exextraLargeImageFilePath, $exextraLargeImageFile)) {
            $resizedImage['xxl'] = $exextraLargeImageFilePath;
        }

        return $resizedImage;
    }


    // public function data_ajax()
    // {
    //     $items = Thumbnail::with(['post'])->latest()->get();
        
        
    //     if (Auth::user()->hasRole('author')) {
    //             if ($items->post->id == $items->post_id && Auth::user()->id == $items->post->user_id) {
    //                 return datatables()->of($items)
    //                     ->addColumn('title', function ($i) {
    //                         return $i->post->title;
    //                     })
    //                     ->addColumn('thumb', function ($i) {
    //                         return '<img src="' . Storage::url($i->s) . '" alt="" class="img-fluid">';
    //                     })
    //                     ->addColumn('action', function ($i) {
    //                         return '<form action="'. route('thumbnail.destroy', $i->id).'"method="post">
    //                                     <input type="hidden" name="_token" value="' . csrf_token() . '">
    //                                     <input type="hidden" name="_method" value="delete">
                                        
    //                                     <button class=" btn btn-danger btn-sm" type="submit" onclick="return confirm(\'Apakah anda yakin ingin menghapus ?\')"><i class="fa fa-trash"></i></button>
    //                                 </form>';
    //                     })
    //                     ->rawColumns(['thumb', 'action'])
    //                     ->make(true);
    //             }
    //     } else {
    //         return datatables()->of($items)
    //             ->addColumn('title', function ($i) {
    //                 return $i->post->title;
    //             })
    //             ->addColumn('thumb', function ($i) {
    //                 return '<img src="' . Storage::url($i->s) . '" alt="" class="img-fluid">';
    //             })
    //             ->addColumn('action', function ($i) {
    //                 return '<form action="' . route('thumbnail.destroy', $i->id) . '"method="post">
    //                                 <input type="hidden" name="_token" value="' . csrf_token() . '">
    //                                 <input type="hidden" name="_method" value="delete">
                                    
    //                                 <button class=" btn btn-danger btn-sm" type="submit" onclick="return confirm(\'Apakah anda yakin ingin menghapus ?\')"><i class="fa fa-trash"></i></button>
    //                             </form>';
    //             })
    //             ->rawColumns(['thumb', 'action'])
    //             ->make(true);
    //     // }
    // }
}
