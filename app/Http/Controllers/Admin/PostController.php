<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Tag;
use App\Http\Requests\PostRequest;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:admin.posts.index')->only('index');
        $this->middleware('can:admin.posts.destroy')->only('destroy');
        $this->middleware('can:admin.posts.create')->only('create', 'store');
        $this->middleware('can:admin.posts.edit')->only('edit', 'update');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.posts.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::pluck('name', 'id');
        $tags = Tag::all();

        return view('admin.posts.create', compact('categories', 'tags'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PostRequest $request)
    {
        $post = Post::create($request->all());

        if ($request->file('file')) {
            $url = Storage::put('posts', $request->file('file'));
            $post->image()->create([
                'url' => $url
            ]);
        }

        if ($request->tags) {
            $post->tag()->attach($request->tags);
        }

        return redirect()->route('admin.posts.edit', $post);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Post $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        $this->authorize('author', $post);

        $categories = Category::pluck('name', 'id');
        $tags = Tag::all();

        return view('admin.posts.edit', compact('post', 'categories', 'tags'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  Post $post
     * @return \Illuminate\Http\Response
     */
    public function update(PostRequest $request, Post $post)
    {
        $post->update($request->all());

        if ($request->file('file')) {
            $url = Storage::put('posts', $request->file('file'));
            if ($post->image) {
                Storage::delete($post->image->url);
                $post->image->update([
                    'url' => $url
                ]);
            } else {
                $post->image()->create([
                    'url' => $url
                ]);
            }
        }

        if ($request->tags) {
            $post->tag()->sync($request->tags);
        }

        return redirect()->route('admin.posts.edit', $post)->with('info', 'El post se actualizó con éxito');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Post $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        $this->authorize('author', $post);

        $post->delete();

        return redirect()->route('admin.posts.index')->with('info', 'El post se eliminó con éxito');
    }
}
