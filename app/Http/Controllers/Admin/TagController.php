<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\NameRequest;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class TagController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('pages.admin.tag.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.admin.tag.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(NameRequest $request)
    {
        $name = $request->name;
        Tag::create([
            'name' => $name,
            'slug' => Str::slug($name)
        ]);
        session()->flash('success', 'Tag Berhasil ditambahkan');
        return redirect()->route('tag.index');
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
        $tag = Tag::findOrFail($id);
        return view('pages.admin.tag.edit', compact('tag'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(NameRequest $request, $id)
    {
        $tag = Tag::findOrFail($id);
        $name = $request->name;
        $tag->update([
            'name' => $name,
            'slug' => Str::slug($name)
        ]);
        session()->flash('success', 'Tag Berhasil diupdate');
        return redirect()->route('tag.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $tag = Tag::findOrFail($id);
        $tag->delete();
        session()->flash('success', 'Tag Berhasil dihapus');
        return redirect()->back();
    }

    public function data_ajax()
    {
        $items = Tag::latest()->get();
        return datatables()->of($items)
            ->addIndexColumn()
            ->addColumn('action', function ($i) {
                return '<form action="'. route('tag.destroy', $i->id). '"method="post">
                            <input type="hidden" name="_token" value="' . csrf_token() . '">
                            <input type="hidden" name="_method" value="delete">
                            <a href="'. route('tag.edit', $i->id).'" class="btn btn-primary btn-sm"><i class="fa fa-pencil-alt"></i></a>
                            <button class=" btn btn-danger btn-sm" type="submit" onclick="return confirm(\'Apakah anda yakin ingin menghapus ?\')"><i class="fa fa-trash"></i></button>
                        </form>';
            })
            ->rawColumns(['action'])
            ->make(true);
    }
}
