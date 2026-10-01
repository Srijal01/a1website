<?php

use App\Models\ContactMessage;
use App\Models\User;

function adminUser(): User
{
    return User::factory()->create(['role' => 'admin']);
}

function contactMessage(array $attributes = []): ContactMessage
{
    return ContactMessage::create(array_merge([
        'name' => 'Ada Lovelace',
        'email' => 'ada@example.com',
        'subject' => 'Project enquiry',
        'message' => 'Please contact me about a project.',
        'status' => 'unread',
    ], $attributes));
}

test('admins can filter contact messages by status', function () {
    $admin = adminUser();
    contactMessage();
    contactMessage(['email' => 'read@example.com', 'status' => 'read']);

    $response = $this->actingAs($admin)->get(route('admin.contact-messages.index', ['status' => 'read']));

    $response->assertSuccessful();
    expect($response->viewData('messages')->total())->toBe(1);
});

test('viewing an unread message marks it as read', function () {
    $admin = adminUser();
    $message = contactMessage();

    $this->actingAs($admin)
        ->get(route('admin.contact-messages.show', $message))
        ->assertSuccessful();

    expect($message->refresh()->status)->toBe('read');
});

test('admins can mark a contact message as replied', function () {
    $admin = adminUser();
    $message = contactMessage();

    $this->actingAs($admin)
        ->post(route('admin.contact-messages.mark-replied', $message))
        ->assertSessionHas('success');

    expect($message->refresh()->status)->toBe('replied');
});

test('admins can delete a contact message', function () {
    $admin = adminUser();
    $message = contactMessage();

    $this->actingAs($admin)
        ->delete(route('admin.contact-messages.destroy', $message))
        ->assertRedirectToRoute('admin.contact-messages.index');

    $this->assertDatabaseMissing('contact_messages', ['id' => $message->id]);
});
