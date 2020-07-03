<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class LikesIndexTest extends TestCase
{

    use RefreshDatabase;

    public function setUp():void
    {
        parent::setUp();
        $this->firstLike = create(\App\Like::class, [
            'created_at' => now()->subDay()
        ]);
        $this->secondLike = create(\App\Like::class, [
            'created_at' => now()->subDays(2)
        ]);
        $this->searchableLike = create(\App\Like::class, [
            'text' => 'What a fabulous sample tweet',
            'author_name' => 'Cameron Scott',
            'author_username' => 'cameronhscott',
            'created_at' => now()->subDays(3)
        ]);
    }

    /**
     * @test
     */
    public function initial_load_displays_list_of_likes()
    {
        $response = $this->get(route('likesIndex'));
        $response->assertStatus(200)
            ->assertViewIs('likes.index')
            ->assertViewHas('likes');
    }

    /**
     * @test
     */
    public function like_list_can_be_offset()
    {
        $response = $this->get(route('likesIndex', ['offset' => 1]));
        $responseData = $response->original->getData()['likes'];
        $this->assertEquals($this->secondLike->id, $responseData->first()->id);
    }

    /**
     * @test
     */
    public function like_list_is_searchable()
    {
        $response = $this->get(
            route('likesIndex', ['term' => 'sample tweet']
        ), ['Accept' => 'application/json']);
        $response->assertStatus(200)
            ->assertJsonFragment([
                'text' => $this->searchableLike->text
            ])->assertJsonMissing([
                'text' => $this->firstLike->text
            ])
            ->assertJsonMissing([
                'text' => $this->secondLike->text
            ]);
    }

    /**
     * @test
     */
    public function json_get_request_returns_json_list_of_likes()
    {
        $response = $this->get(route('likesIndex'), ['Accept' => 'application/json']);
        $response->assertStatus(200)
            ->assertJsonFragment([
                'text' => $this->firstLike->text
            ])->assertJsonFragment([
                'text' => $this->secondLike->text
            ])->assertJsonFragment([
                'text' => $this->searchableLike->text
            ]);
    }
}
