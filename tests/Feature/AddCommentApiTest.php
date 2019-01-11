<?php

namespace Tests\Feature;

use App\Photo;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class AddCommentApiTest extends TestCase
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
    public function should_コメントを追加できる()
    {
        factory(Photo::class)->create();
        $photo = Photo::first();

        $content = 'sample content';

        $response = $this->actingAs($this->user)
            ->json('POST', route('photo.comment', [
                'photo' => $photo->id,
            ]), compact('content'));

        $comments = $photo->comments()->get();

        $response->assertStatus(201)
            ->assertJsonFragment([
                "author" => [
                    "name" => $this->user->name,
                ],
                "content" => $content,
            ]);

        $this->assertEquals(1, $comments->count());
        $this->assertEquals($content, $comments[0]->content);
    }
}
