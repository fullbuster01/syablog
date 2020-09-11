<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\NameRequest;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('pages.admin.category.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.admin.category.create');
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
        Category::create([
            'name' => $name,
            'slug' => Str::slug($name)
        ]);
        session()->flash('success', 'Kategori Berhasil ditambahkan');
        return redirect()->route('category.index');
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
        $category = Category::findOrFail($id);
        return view('pages.admin.category.edit', compact('category'));
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
        $category = Category::findOrfail($id);
        $name = $request->name;
        $category->update([
            'name' => $name,
            'slug' => Str::slug($name)
        ]);
        session()->flash('success', 'Kategori Berhasil diubah');
        return redirect()->route('category.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $category = Category::findOrfail($id);
        $category->delete();
        session()->flash('success', 'Kategori Berhasil dihapus');
        return redirect()->back();
    }

    public function data_ajax()
    {
        $items =Category::latest()->get();
        return datatables()->of($items)
            ->addIndexColumn()
            ->addColumn('action', function ($i) {
                return '<form action="'. route('category.destroy', $i->id). '"method="post">
                            <input type="hidden" name="_token" value="' . csrf_token() . '">
                            <input type="hidden" name="_method" value="delete">
                            <a href="'. route('category.edit', $i->id).'" class="btn btn-primary btn-sm"><i class="fa fa-pencil-alt"></i></a>
                            <button class=" btn btn-danger btn-sm" type="submit" onclick="return confirm(\'Apakah anda yakin ingin menghapus ?\')"><i class="fa fa-trash"></i></button>
                        </form>';
            })
            ->rawColumns(['action'])
            ->make(true);
    }
}
