<?php

namespace App\Action;

use App\Models\Post;
use Illuminate\Support\Facades\Gate;

class CreatePost
{
    public static function create(string $title, string $content): Post
    {
        Gate::authorize('create', Post::class);

        return Post::create([
            'title' => $title,
            'content' => $content,
        ]);
    }
}
