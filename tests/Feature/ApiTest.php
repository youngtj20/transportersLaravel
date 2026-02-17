<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ApiTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test the login endpoint
     */
    public function test_login_endpoint(): void
    {
        $user = User::factory()->create([
            'email' => 'test@example.com',
            'password' => bcrypt('password'),
        ]);

        $response = $this->postJson('/api/login', [
            'email' => 'test@example.com',
            'password' => 'password',
        ]);

        $response->assertStatus(200)
                 ->assertJsonStructure([
                     'user',
                     'token',
                     'token_type'
                 ]);
    }

    /**
     * Test the public pages endpoint
     */
    public function test_public_pages_endpoint(): void
    {
        $response = $this->getJson('/api/pages');

        $response->assertStatus(200);
    }

    /**
     * Test the public posts endpoint
     */
    public function test_public_posts_endpoint(): void
    {
        $response = $this->getJson('/api/posts');

        $response->assertStatus(200);
    }

    /**
     * Test authenticated endpoints
     */
    public function test_protected_endpoints_require_authentication(): void
    {
        $response = $this->getJson('/api/me');

        $response->assertStatus(401);
    }
}
