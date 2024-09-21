<?php


use App\Action\CreatePost;
use App\Models\Post;
use App\Models\User;
use Illuminate\Auth\Access\AuthorizationException;
use function Pest\Laravel\assertDatabaseCount;
use function Pest\Laravel\assertDatabaseHas;

mutates(CreatePost::class);

it('can create a post', function () {
    $user = User::factory()->create();
    $this->actingAs($user);

   $post = CreatePost::create("Test Title", "Lorem ipsum dolor sit amit");

   expect($post)->toBeInstanceOf(Post::class);
   expect($post->title)->toBe("Test Title");
   expect($post->content)->toBe("Lorem ipsum dolor sit amit");
   assertDatabaseHas('posts', ['title' => "Test Title", 'content' => "Lorem ipsum dolor sit amit"]);
   assertDatabaseCount('posts', 1);
});

it('cannot create a post when unauthorized', function () {
    expect(fn() => CreatePost::create("Test Title", "Lorem ipsum dolor sit amit"))->toThrow(AuthorizationException::class);
});
