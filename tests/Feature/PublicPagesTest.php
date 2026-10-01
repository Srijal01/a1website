<?php

test('public pages return successful responses', function (string $uri) {
    $this->get($uri)->assertSuccessful();
})->with([
    'home' => '/',
    'about' => '/about',
    'services' => '/services',
    'portfolio' => '/portfolio',
    'technologies' => '/technologies',
    'blog' => '/blog',
    'contact' => '/contact',
]);

test('unknown public resources return not found', function (string $uri) {
    $this->get($uri)->assertNotFound();
})->with([
    'service' => '/services/does-not-exist',
    'portfolio item' => '/portfolio/does-not-exist',
    'blog post' => '/blog/does-not-exist',
    'page' => '/does-not-exist',
]);
