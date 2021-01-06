<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\Request;
use Inertia\Inertia;
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
        return Inertia::render('Admin/Post/Index', [
            'posts' => Post::with(['category:id,name','user:id,name'])->paginate(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return Inertia::render('Admin/Post/Create', [
            'categories' => Category::get()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validateWithBag('storePost', [
            'title' => ['string','required','max:255'],
            'description' => ['string','required'],
            'body' => ['string','required'],
            'category' => ['string','required', 'exists:categories,name'],
        ]);
        $post = Category::firstWhere('name',$request->category)->posts()->create([
            'title' => $request->title,
            'description' => $request->description,
            'body' => $request->body,
            'slug' => Str::slug(Str::words($request->title, 15)),
            'user_id' => $request->user()->id
        ]);
        return redirect()->route('admin.post.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        return Inertia::render('Admin/Post/Edit', [
            'post' => [
                'data' => $post,
                'category' => $post->category()->first()
            ],
            'categories' => Category::get()
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
        $request->validateWithBag('storePost', [
            'title' => ['string','required','max:255'],
            'description' => ['string','required'],
            'body' => ['string','required'],
            'category' => ['string','required', 'exists:categories,name'],
        ]);
        $post->update([
            'title' => $request->title,
            'description' => $request->description,
            'body' => $request->body,
            'category_id' => Category::firstWhere('name',$request->category)->id
        ]);
        return redirect()->route('admin.post.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        $post->delete();
        return redirect()->route('admin.post.index');
    }
}
