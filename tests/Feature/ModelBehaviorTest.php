<?php

use App\Models\BlogCategory;
use App\Models\BlogPost;
use App\Models\Service;
use App\Models\User;

test('active services are ordered by sort order', function () {
    Service::create(['title' => 'Later', 'slug' => 'later', 'status' => true, 'sort_order' => 2]);
    Service::create(['title' => 'First', 'slug' => 'first', 'status' => true, 'sort_order' => 1]);
    Service::create(['title' => 'Hidden', 'slug' => 'hidden', 'status' => false, 'sort_order' => 0]);

    expect(Service::active()->pluck('slug')->all())->toBe(['first', 'later']);
});

test('published posts require a published status and a past publication date', function () {
    $category = BlogCategory::create(['name' => 'News', 'slug' => 'news']);
    $author = User::factory()->create();

    BlogPost::create([
        'category_id' => $category->id,
        'author_id' => $author->id,
        'title' => 'Published post',
        'slug' => 'published-post',
        'content' => 'Content',
        'status' => true,
        'published_at' => now()->subDay(),
    ]);
    BlogPost::create([
        'category_id' => $category->id,
        'author_id' => $author->id,
        'title' => 'Scheduled post',
        'slug' => 'scheduled-post',
        'content' => 'Content',
        'status' => true,
        'published_at' => now()->addDay(),
    ]);

    expect(BlogPost::published()->pluck('slug')->all())->toBe(['published-post']);
});

test('blog posts expose category and author relationships', function () {
    $category = BlogCategory::create(['name' => 'News', 'slug' => 'news']);
    $author = User::factory()->create();
    $post = BlogPost::create([
        'category_id' => $category->id,
        'author_id' => $author->id,
        'title' => 'Relationships',
        'slug' => 'relationships',
        'content' => 'Content',
        'status' => true,
        'published_at' => now(),
    ]);

    expect($post->category->is($category))->toBeTrue()
        ->and($post->author->is($author))->toBeTrue();
});
