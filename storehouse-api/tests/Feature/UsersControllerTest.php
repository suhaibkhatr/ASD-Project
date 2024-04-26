<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class UsersControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_can_create_resource()
    {
        $data = [
            "name" => "Test Resource",
            "email" => "Test@test.com",
            "password" => "Ss12345678",
        ];

        $response = $this->post("/api/auth/register", $data);
        $response->assertStatus(201);
        unset($data["password"]);
        $this->assertDatabaseHas("users", $data);
    }

    public function test_user_can_login()
    {
        $user = User::create([
            "name" => "Test User",
            "email" => "test@test.com",
            "password" => "12345",
        ]); // Assuming you have User model and users table

        $credentials = [
            "email" => $user->email,
            "password" => "12345",
        ];

        $response = $this->post("/api/auth/login", $credentials);
        $response->assertStatus(200);
        $this->assertAuthenticatedAs($user);
    }
}
