<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Inertia\Inertia;

class AdminController extends Controller
{
    public function dashboard()
    {
        return Inertia::render('Admin/Dashboard', [
            'data' => [
                'user' => User::count(),
                'post' => Post::count(),
                'comment' => Comment::count(),
                'admin' => User::role('admin')->count()
            ]
        ]);
    }
}
