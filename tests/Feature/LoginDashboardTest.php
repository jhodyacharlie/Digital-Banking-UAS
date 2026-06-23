<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class LoginDashboardTest extends TestCase
{
    use RefreshDatabase;

    public function test_login_redirects_to_dashboard_even_when_intended_url_exists(): void
    {
        $user = User::updateOrCreate(
            ['email' => 'login-dashboard@example.com'],
            [
                'name' => 'Login Dashboard',
                'no_card' => '999000111',
                'password' => 'password',
            ]
        );

        $response = $this
            ->withSession(['url.intended' => route('posts.create')])
            ->post('/login', [
                'no_card' => $user->no_card,
                'password' => 'password',
            ]);

        $response->assertRedirect(route('dashboard'));
        $this->assertAuthenticatedAs($user);
    }

    public function test_authenticated_user_opening_login_is_redirected_to_dashboard(): void
    {
        $user = User::updateOrCreate(
            ['email' => 'already-login-dashboard@example.com'],
            [
                'name' => 'Already Login',
                'no_card' => '999000222',
                'password' => 'password',
            ]
        );

        $this->actingAs($user)
            ->get('/login')
            ->assertRedirect(route('dashboard'));
    }

    public function test_authenticated_user_can_view_dashboard(): void
    {
        $user = User::updateOrCreate(
            ['email' => 'view-dashboard@example.com'],
            [
                'name' => 'View Dashboard',
                'no_card' => '999000333',
                'password' => 'password',
            ]
        );

        $this->actingAs($user)
            ->get('/dashboard')
            ->assertOk()
            ->assertSee('Digital Banking')
            ->assertSee('Saldo tersedia');
    }

    public function test_authenticated_user_can_open_dashboard_support_pages(): void
    {
        $user = User::updateOrCreate(
            ['email' => 'support-pages@example.com'],
            [
                'name' => 'Support Pages',
                'no_card' => '999000444',
                'password' => 'password',
            ]
        );

        $this->actingAs($user)->get('/payment')->assertOk()->assertSee('Buat transfer baru');
        $this->actingAs($user)->get('/status')->assertOk()->assertSee('Status pembayaran');
        $this->actingAs($user)->get('/transactions')->assertOk()->assertSee('Transaction history');
        $this->actingAs($user)->get('/security')->assertOk()->assertSee('Security center');
        $this->actingAs($user)->get('/notifications')->assertOk()->assertSee('Daftar notifikasi');
    }

    public function test_authenticated_user_can_create_pending_transfer(): void
    {
        $user = User::updateOrCreate(
            ['email' => 'transfer-dashboard@example.com'],
            [
                'name' => 'Transfer Dashboard',
                'no_card' => '999000555',
                'password' => 'password',
            ]
        );

        $this->actingAs($user)
            ->post('/payment', ['amount' => 250000])
            ->assertRedirect(route('status.index'));

        $this->assertDatabaseHas('payments', [
            'user_id' => $user->id,
            'amount' => 250000,
            'status' => 'Pending',
        ]);
    }

    public function test_login_accepts_email_like_account_even_when_email_is_not_standard_format(): void
    {
        $user = User::updateOrCreate(
            ['email' => 'jhodya@jhodya'],
            [
                'name' => 'Charlie',
                'no_card' => '111222333444',
                'password' => '133345',
            ]
        );

        $this->post('/login', [
            'no_card' => 'jhodya@jhodya',
            'password' => '133345',
        ])->assertRedirect(route('dashboard'));

        $this->assertAuthenticatedAs($user);
    }
}
