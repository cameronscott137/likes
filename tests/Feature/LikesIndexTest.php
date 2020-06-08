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
        $this->like = create(\App\Like::class);
    }

    /**
     * @test
     */
    public function testExample()
    {
        $response = $this->get(route('likesIndex'));
        $response->assertStatus(200);
    }
}
