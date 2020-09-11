<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Post;
use App\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class DashboardController extends Controller
{
    public function index(){
        return view('pages.admin.dashboard', [
            'author' => User::role('author')->count(),
            'post' => Post::count(),
            'admininistrator' =>   User::role('administrator')->count()
        ]);
    }
}
