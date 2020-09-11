<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;
use App\Models\Thumbnail;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('pages.admin.user.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.admin.user.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserRequest $request)
    {
        if (request()->input('password')) {
            $password = Hash::make($request->password);
        } else {
            $password = Hash::make('Password123');
        }
        

        $params = $request->all();
        $params['password'] = $password;
        // $params = $params->assignRole('author');
        $user = User::create($params);
        $user->assignRole('author');
        session()->flash('success', 'User Berhasil ditambahkan');
        return redirect()->route('user.index');
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
        $user = User::findOrFail($id);
        return view('pages.admin.user.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UserRequest $request, $id)
    {
        if (request()->input('password')) {
            $password = Hash::make($request->password);
        } else {
            $password = auth()->user()->password;
        }
        $params = $request->except('token', 'username', 'email');
        $params['password'] = $password;
        $user = User::findOrFail($id);
        $user->update($params);
        session()->flash('success', 'User Berhasil diubah');
        return redirect()->route('user.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $thumbnail = Thumbnail::all();
        $user = User::findOrFail($id);
        $post = $user->post;
        $user->delete();
        foreach ($post as $p) {
            ($p->delete()); // untuk delete post
            foreach ($thumbnail as $key) {
                if ($p->id == $key->post_id) {
                    $key->delete(); //untuk delete thumbnail
                };
            }
        }
        session()->flash('success', 'User Berhasil dihapus');
        return redirect()->back();
    }

    public function data_ajax()
    {
        $items = User::latest()->get();
        return datatables()->of($items)
            ->addIndexColumn()
            ->addColumn('type', function ($i) {
                if ($i->hasRole('administrator')) {
                    return '<h6><span class="badge badge-info">Administrator</span></h6>';
                } else {
                    return '<h6><span class="badge badge-warning">Author</span></h6>';
                }
            })
            ->addColumn('action', function ($i) {
                return '<form action="'. route('user.destroy', $i->id). '"method="POST">
                            <input type="hidden" name="_token" value="' . csrf_token() . '">
                            <input type="hidden" name="_method" value="delete">
                            <a href="'. route('user.edit', $i->id).'" class="btn btn-primary btn-sm"><i class="fa fa-pencil-alt"></i></a>
                            <button class=" btn btn-danger btn-sm" type="submit" onclick="return confirm(\'Apakah anda yakin ingin menghapus ?\')"><i class="fa fa-trash"></i></button>
                        </form>';
            })
            ->rawColumns(['type','action'])
            ->make(true);
    }
}
