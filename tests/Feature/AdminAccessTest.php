<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AdminAccessTest extends TestCase
{
    use RefreshDatabase;

    public function test_guest_cannot_access_admin_dashboard(): void
    {
        $response = $this->get('/admin');

        $response->assertRedirect('/login');
    }

    public function test_buyer_cannot_access_admin_dashboard(): void
    {
        $user = User::factory()->create([
            'is_admin' => false,
        ]);

        $response = $this->actingAs($user)->get('/admin');

        $response->assertRedirect('/');
    }

    public function test_admin_can_access_dashboard(): void
    {
        $user = User::factory()->create([
            'is_admin' => true,
        ]);

        $response = $this->actingAs($user)->get('/admin');

        $response->assertOk();
    }
}
