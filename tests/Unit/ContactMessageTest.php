<?php

use App\Models\ContactMessage;

test('contact messages allow the fields used by the contact form', function () {
    $message = new ContactMessage;

    expect($message->getFillable())->toEqual([
        'name',
        'email',
        'phone',
        'subject',
        'message',
        'status',
    ]);
});

test('contact message status is cast to a string', function () {
    $message = new ContactMessage;

    expect($message->getCasts())->toMatchArray([
        'status' => 'string',
    ]);
});
