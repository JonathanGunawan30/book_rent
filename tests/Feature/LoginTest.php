<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class LoginTest extends TestCase
{
    public function testUserLoginAdminSuccess()
    {
        $this->post('/login', [
            'username' => 'admin',
            'password' => 'rahasia',
        ])->assertStatus(302)->assertRedirect('/dashboard');
    }

    public function testUserLoginNotActivated()
    {
        $this->post('/login', [
            'username' => 'jonathan',
            'password' => 'rahasia',
        ])->assertRedirect('/login')
        ->assertStatus(302);

        $this->followingRedirects()->post('/login', [
            'username' => 'jonathan',
            'password' => 'rahasia',
        ])->assertSeeText('Your account is not active yet. Please contact admin to activate your account.');
    }

    public function testUserLoginClientSuccess()
    {
        $this->post('/login', [
            'username' => 'kimi',
            'password' => 'rahasia',
        ])->assertStatus(302)->assertRedirect('/profile');
    }

    public function testUserLoginNotFound()
    {
        $this->post('/login', [
            'username' => 'salah',
            'password' => 'salah juga'
        ])->assertStatus(302)->assertRedirect('/login');

        $this->followingRedirects()->post('/login', [
            'username' => 'salah',
            'password' => 'salah juga'
        ])->assertSeeText('Username and password do not match.');
    }

    public function testAuthenticatedUserCannotAccessLoginPage()
    {

        $user = User::query()->where('username', '=', 'kimi')->first();

        $this->actingAs($user);

        $response = $this->get('/login');

        $response->assertRedirect('/home')->assertStatus(302);
    }

    public function testUserClientCannotAccessDashboardPage()
    {

        $user = User::query()->where('username', '=', 'kimi')->first();

        $this->actingAs($user);

        $response = $this->get('/dashboard');

        $response->assertRedirect('/home')->assertStatus(302);
    }

    public function testUserAdminCannotAccessProfilePage()
    {

        $user = User::query()->where('username', '=', 'admin')->first();

        $this->actingAs($user);

        $response = $this->get('/profile');

        $response->assertRedirect('/home')->assertStatus(302);
    }

}
