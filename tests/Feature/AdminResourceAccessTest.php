<?php

use App\Models\User;

test('admins can access every management index', function (string $routeName) {
    $admin = User::factory()->create(['role' => 'admin']);

    $this->actingAs($admin)
        ->get(route($routeName))
        ->assertSuccessful();
})->with([
    'dashboard' => 'admin.dashboard',
    'pages' => 'admin.pages.index',
    'services' => 'admin.services.index',
    'portfolio' => 'admin.portfolio.index',
    'technologies' => 'admin.technologies.index',
    'clients' => 'admin.clients.index',
    'testimonials' => 'admin.testimonials.index',
    'blog categories' => 'admin.blog-categories.index',
    'blog posts' => 'admin.blog-posts.index',
    'team members' => 'admin.team-members.index',
    'contact messages' => 'admin.contact-messages.index',
    'settings' => 'admin.settings.index',
]);

test('editors are forbidden from every management index', function (string $routeName) {
    $editor = User::factory()->create(['role' => 'editor']);

    $this->actingAs($editor)
        ->get(route($routeName))
        ->assertForbidden();
})->with([
    'dashboard' => 'admin.dashboard',
    'pages' => 'admin.pages.index',
    'services' => 'admin.services.index',
    'portfolio' => 'admin.portfolio.index',
    'technologies' => 'admin.technologies.index',
    'clients' => 'admin.clients.index',
    'testimonials' => 'admin.testimonials.index',
    'blog categories' => 'admin.blog-categories.index',
    'blog posts' => 'admin.blog-posts.index',
    'team members' => 'admin.team-members.index',
    'contact messages' => 'admin.contact-messages.index',
    'settings' => 'admin.settings.index',
]);
