<?php

namespace App\Http\Controllers;

use App\Models\Post;

class BlogController extends Controller
{
    public function index()
    {
        $posts = Post::published()->ordered()->paginate(9)->withQueryString();

        return view('pages.blog.index', compact('posts'));
    }

    public function show(Post $post)
    {
        abort_unless($post->published_at && $post->published_at->isPast(), 404);

        $related = Post::published()
            ->where('id', '!=', $post->id)
            ->ordered()
            ->limit(3)
            ->get();

        return view('pages.blog.show', compact('post', 'related'));
    }
}
