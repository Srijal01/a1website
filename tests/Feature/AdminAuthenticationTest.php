<?php

use App\Models\User;

test('a guest is redirected to the admin login page', function () {
    $this->get(route('admin.dashboard'))
        ->assertRedirectToRoute('admin.login');
});

test('an admin can access the dashboard', function () {
    $admin = User::factory()->create(['role' => 'admin']);

    $this->actingAs($admin)
        ->get(route('admin.dashboard'))
        ->assertSuccessful();
});

test('a non-admin user is forbidden from the dashboard', function () {
    $user = User::factory()->create(['role' => 'editor']);

    $this->actingAs($user)
        ->get(route('admin.dashboard'))
        ->assertForbidden();
});

test('an admin can log in with valid credentials', function () {
    $admin = User::factory()->create([
        'email' => 'admin@example.com',
        'password' => 'password',
        'role' => 'admin',
    ]);

    $this->post(route('admin.login'), [
        'email' => $admin->email,
        'password' => 'password',
    ])->assertRedirectToRoute('admin.dashboard');

    $this->assertAuthenticatedAs($admin);
});

test('a valid non-admin login is rejected', function () {
    $user = User::factory()->create([
        'email' => 'editor@example.com',
        'password' => 'password',
        'role' => 'editor',
    ]);

    $this->post(route('admin.login'), [
        'email' => $user->email,
        'password' => 'password',
    ])
        ->assertSessionHasErrors('email')
        ->assertRedirect();

    $this->assertGuest();
});

test('admin login validates credentials', function () {
    $this->post(route('admin.login'), [
        'email' => 'not-an-email',
    ])->assertSessionHasErrors(['email', 'password']);
});

test('an authenticated admin can log out', function () {
    $admin = User::factory()->create(['role' => 'admin']);

    $this->actingAs($admin)
        ->post(route('admin.logout'))
        ->assertRedirectToRoute('admin.login');

    $this->assertGuest();
});
