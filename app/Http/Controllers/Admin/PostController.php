<?php

namespace App\Http\Controllers\Admin;

use App\Models\Post;
use Illuminate\Support\Arr;
use App\Http\Controllers\Controller;
use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdatePostRequest;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.post.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.post.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePostRequest $request)
    {
        $post = Post::create($request->except(['image']));

        if ($tags = json_decode($request->post_tags, true)) {
            $tags = Arr::map($tags, function ($value, $key) {
                return $value['name'];
            });
        }
        $post->attachTags($tags);

        if ($request->hasFile('image')) {
            $post->addMediaFromRequest('image')->toMediaCollection();
        }

        return redirect()->route('admin.posts.index')->with('status', 'Post created.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post)
    {
        $tags = $post->tags()->get()->map(function ($value, $key) {
            return ['name' => $value->name];
        });

        return view('admin.post.edit', ['post' => $post, 'tags' => $tags]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePostRequest $request, Post $post)
    {
        $post->update($request->except(['image']));

        if ($tags = json_decode($request->post_tags, true)) {
            $tags = Arr::map($tags, function ($value, $key) {
                return $value['name'];
            });
        }
        $post->syncTags($tags);

        if ($request->hasFile('image')) {
            if ($post->getMedia()->isNotEmpty()) {
                $post->getMedia()[0]->delete();
            }

            $post->addMediaFromRequest('image')->toMediaCollection();
        }

        return redirect()
            ->route('admin.posts.edit', $post->id)
            ->with('status', 'Post updated.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        $post->delete();

        return redirect()
            ->route('admin.posts.index')
            ->with('status', 'Post deleted.');
    }
}
