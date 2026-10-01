<?php

use App\Models\User;
use App\Models\WebsiteSetting;

test('admins can update website settings', function () {
    $admin = User::factory()->create(['role' => 'admin']);

    $this->actingAs($admin)
        ->post(route('admin.settings.update'), [
            'company_name' => 'A1 Website',
            'email' => 'hello@example.com',
        ])
        ->assertRedirectToRoute('admin.settings.index')
        ->assertSessionHas('success');

    expect(WebsiteSetting::get('company_name'))->toBe('A1 Website')
        ->and(WebsiteSetting::get('email'))->toBe('hello@example.com');
});

test('missing website setting returns the supplied default', function () {
    expect(WebsiteSetting::get('missing-key', 'fallback'))->toBe('fallback');
});
