<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProfileRequest;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function index(){
        $user = Auth::user();
        return view('pages.admin.profile.index', compact('user'));
    }

    public function edit($id)
    {
        if ($id == Auth::user()->id) {
            $user = User::findOrFail($id);
        } else {
            return redirect()->back();
        }
        
        return view('pages.admin.profile.edit', compact('user'));
    }

    public function update(ProfileRequest $request ,$id)
    {
        $user = User::findOrFail($id);
        if ($user->id == Auth::user()->id) {
            $params = $request->all();
            $user->update($params);
        } else {
            return redirect()->back();
        }
        
        return redirect()->route('profile');;
    }
}
