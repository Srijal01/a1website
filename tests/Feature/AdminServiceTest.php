<?php

use App\Models\Service;
use App\Models\User;

test('admins can create a service', function () {
    $admin = User::factory()->create(['role' => 'admin']);

    $this->actingAs($admin)
        ->post(route('admin.services.store'), [
            'title' => 'Web Development',
            'short_description' => 'Modern web applications.',
            'status' => '1',
            'sort_order' => '1',
        ])
        ->assertRedirectToRoute('admin.services.index')
        ->assertSessionHas('success');

    $this->assertDatabaseHas('services', [
        'title' => 'Web Development',
        'slug' => 'web-development',
        'status' => 1,
    ]);
});

test('service creation validates required and numeric fields', function (array $payload, string $field) {
    $admin = User::factory()->create(['role' => 'admin']);

    $this->actingAs($admin)
        ->post(route('admin.services.store'), $payload)
        ->assertSessionHasErrors($field);
})->with([
    'missing title' => [['sort_order' => 0], 'title'],
    'invalid sort order' => [['title' => 'Web Development', 'sort_order' => -1], 'sort_order'],
]);

test('service slugs must be unique', function () {
    $admin = User::factory()->create(['role' => 'admin']);
    Service::create(['title' => 'Web Development', 'slug' => 'web-development']);

    $this->actingAs($admin)
        ->post(route('admin.services.store'), [
            'title' => 'Another Service',
            'slug' => 'web-development',
        ])
        ->assertSessionHasErrors('slug');
});
