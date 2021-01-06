<?php

namespace App\Http\Controllers;

use App\Models\Movie;
use App\Models\Post;
use Illuminate\Http\Request;
use Inertia\Inertia;

class HomeController extends Controller
{
    public function homePage()
    {
        return Inertia::render('Dashboard', [
            'posts' => Post::with(['category','user'])->paginate(10)
        ]);
    }

    public function readPost(Post $post)
    {
        return Inertia::render('ViewPost', [
            'post' => $post,
            'comments' => $post->parentComments()->orderBy('created_at','desc')->paginate(15),
        ]);
    }

    public function moviePage()
    {
        return Inertia::render('Movie/Index', [
            'movies' => Movie::paginate(10)
        ]);
    }

    public function watchMovie(Movie $movie)
    {
        return Inertia::render('Movie/Watch', [
            'movie' => [
                'data' => $movie,
                'sources' => $movie->sources
            ]
        ]);
    }
}
