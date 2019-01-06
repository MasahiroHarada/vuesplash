<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class LogoutApiTest extends TestCase
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
    public function should_認証済みのユーザーをログアウトさせる()
    {
        $response = $this->actingAs($this->user)
                         ->json('POST', route('logout'));

        $response->assertStatus(200);
        $this->assertGuest();
    }
}
