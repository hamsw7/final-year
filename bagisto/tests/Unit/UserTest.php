<?php

use App\Models\User;
use Illuminate\Support\Facades\Hash;

it('logs in a user with correct credentials', function () {
    $user = User::factory()->create([
        'password' => Hash::make('secret123'),
    ]);

    $response = $this->post('/login', [
        'email' => $user->email,
        'password' => 'secret123',
    ]);

    $response->assertRedirect('/dashboard'); // Change if your redirect is different
    $this->assertAuthenticatedAs($user);
});

it('fails login with incorrect password', function () {
    $user = User::factory()->create([
        'password' => Hash::make('secret123'),
    ]);

    $response = $this->post('/login', [
        'email' => $user->email,
        'password' => 'wrongpassword',
    ]);

    $response->assertSessionHasErrors(); // or ->assertRedirect(), depending on your setup
    $this->assertGuest();
});
