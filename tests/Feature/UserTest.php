<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UserTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_register(): void
    {
        $response = $this->post('/api/v1/register', [
            "name" => "test_user",
            "email" => "test@gmail.com",
            "password" => "test123",
            "password_confirmation" => "test123",
        ],[
            "Content-Type" => "application/json",
        ]);
        $response->assertStatus(201);
    }
}
