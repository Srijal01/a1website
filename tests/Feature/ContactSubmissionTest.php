<?php

test('a visitor can submit a contact message', function () {
    $payload = [
        'name' => 'Ada Lovelace',
        'email' => 'ada@example.com',
        'phone' => '+1 555 0100',
        'subject' => 'Project enquiry',
        'message' => 'I would like to discuss a new project.',
    ];

    $response = $this->post(route('contact.store'), $payload);

    $response
        ->assertRedirectToRoute('contact')
        ->assertSessionHas('success');

    $this->assertDatabaseHas('contact_messages', [
        ...$payload,
        'status' => 'unread',
    ]);
});

test('a contact message is rejected when required data is invalid', function (array $payload, string $field) {
    $response = $this->post(route('contact.store'), $payload);

    $response->assertSessionHasErrors($field);
    $this->assertDatabaseCount('contact_messages', 0);
})->with([
    'missing name' => [
        [
            'email' => 'ada@example.com',
            'subject' => 'Project enquiry',
            'message' => 'I would like to discuss a new project.',
        ],
        'name',
    ],
    'invalid email' => [
        [
            'name' => 'Ada Lovelace',
            'email' => 'not-an-email',
            'subject' => 'Project enquiry',
            'message' => 'I would like to discuss a new project.',
        ],
        'email',
    ],
    'missing subject' => [
        [
            'name' => 'Ada Lovelace',
            'email' => 'ada@example.com',
            'message' => 'I would like to discuss a new project.',
        ],
        'subject',
    ],
]);
