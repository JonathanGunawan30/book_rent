<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class RegisterTest extends TestCase
{

    public function test_user_can_register()
    {
        $formData = [
            'username' => 'testuser_' . uniqid(),
            'password' => 'password123',
            'phone' => '081234567890',
            'address' => '123 Test Street',
        ];

        $this->post('/register', $formData)
            ->assertRedirect('/register')
            ->assertSessionHas('message', 'Registration successful! Please contact the admin to activate your account.');

        $this->assertDatabaseHas(
                'users', [
            'username' => 'testuser',
            'password' => Hash::check('password123', User::first()->password),
        ]);
    }
}
