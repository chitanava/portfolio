<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index()
    {
        return view('site.posts.index');
    }

    public function show(Post $post)
    {
        $previous = $post->IsActive()
                        ->isPublished()
                        ->where('published_at', '<', $post->published_at)
                        ->orderBy('published_at', 'desc')
                        ->first();

        $next = $post->IsActive()
                    ->isPublished()
                    ->where('published_at', '>', $post->published_at)
                    ->orderBy('published_at', 'asc')
                    ->first();

        return view('site.posts.show', ['post' => $post, 'previous' => $previous, 'next' => $next]);
    }
}
