<?php

namespace Tests\Feature;

use App\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class RegisterApiTest extends TestCase
{
    use RefreshDatabase, AuthTest;

    /**
     * @test
     */
    public function should_新しいユーザーを作成する()
    {
        $data = $this->userData();
        $data['password_confirmation'] = $data['password'];

        $response = $this->json('POST', route('register'), $data);

        $response->assertStatus(201);

        $user = User::first();
        $this->assertEquals($data['name'], $user->name);
    }

    /**
     * @test
     */
    public function should_作成したユーザーを返却する()
    {
        $data = $this->userData();
        $data['password_confirmation'] = $data['password'];

        $response = $this->json('POST', route('register'), $data);

        $user = User::first();

        $response
            ->assertStatus(201)
            ->assertJson(['name' => $user->name]);
    }
}
