<?php

use App\Models\User;

test('users correctly identify administrators', function () {
    expect((new User(['role' => 'admin']))->isAdmin())->toBeTrue()
        ->and((new User(['role' => 'editor']))->isAdmin())->toBeFalse();
});

test('users hide passwords and remember tokens', function () {
    expect((new User)->getHidden())->toEqual(['password', 'remember_token']);
});
