<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class LoginApiTest extends TestCase
{
    use RefreshDatabase, AuthTest;

    public function setUp()
    {
        parent::setUp();

        $this->createUser();
    }

    /**
     * @test
     */
    public function should_登録済みのユーザーを認証する()
    {
        $response = $this->json('POST', route('login'), $this->credentials());

        $response->assertStatus(200);
        $this->assertAuthenticatedAs($this->user);
    }

    /**
     * @test
     */
    public function should_認証済みのユーザーを返却する()
    {
        $response = $this->json('POST', route('login'), $this->credentials());

        $response
            ->assertStatus(200)
            ->assertJson(['name' => $this->user->name]);
    }
}
