<?php

namespace Tests\Feature\Auth;

use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AuthenticationTest extends TestCase
{
    use RefreshDatabase;

    public function test_login_screen_can_be_rendered(): void
    {
        $response = $this->get('/login');

        $response->assertStatus(200);
    }

    public function test_admin_login_screen_can_be_rendered(): void
    {
        $response = $this->get('/admin/login');

        $response->assertStatus(200);
        $response->assertSee('Log Masuk Pentadbir');
    }

    public function test_users_can_authenticate_using_the_login_screen(): void
    {
        $user = User::factory()->create([
            'role' => 'student',
        ]);

        $response = $this->post('/login', [
            'login_type' => 'student',
            'email' => $user->email,
            'password' => 'password',
        ]);

        $this->assertAuthenticated();
        $response->assertRedirect(RouteServiceProvider::HOME);
    }

    public function test_admin_can_authenticate_via_admin_login(): void
    {
        $admin = User::factory()->create([
            'role' => 'admin',
        ]);

        $response = $this->post('/login', [
            'login_type' => 'admin',
            'email' => $admin->email,
            'password' => 'password',
        ]);

        $this->assertAuthenticated();
        $response->assertRedirect(route('admin.dashboard'));
    }

    public function test_student_cannot_login_through_admin_tab(): void
    {
        $student = User::factory()->create([
            'role' => 'student',
        ]);

        $response = $this->post('/login', [
            'login_type' => 'admin',
            'email' => $student->email,
            'password' => 'password',
        ]);

        $this->assertGuest();
        $response->assertRedirect(route('admin.login'));
        $response->assertSessionHasErrors('email');
    }

    public function test_users_can_not_authenticate_with_invalid_password(): void
    {
        $user = User::factory()->create();

        $this->post('/login', [
            'email' => $user->email,
            'password' => 'wrong-password',
        ]);

        $this->assertGuest();
    }

    public function test_users_can_logout(): void
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->post('/logout');

        $this->assertGuest();
        $response->assertRedirect('/');
    }
}
