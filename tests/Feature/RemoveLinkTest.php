<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class RemoveLinkTest extends TestCase
{
    /**
     * @test
     * TODO
     */
    public function if_like_with_Twitter_id_exists_dont_recreate_like()
    {
        $response = $this->get('/');
        $response->assertStatus(200);
    }
}