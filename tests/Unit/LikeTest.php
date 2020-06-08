<?php

namespace Tests\Unit;

use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class LikeTest extends TestCase
{

    use RefreshDatabase;

    /**
     * @test
     */
    public function a_likes_date_is_formatted()
    {
        $oldDate = Carbon::now()->subDay(rand(1, 10));
        $oldLike = create(\App\Like::class, [
            'created_at' => $oldDate
        ]);
        $this->assertEquals($oldLike->created_at, $oldDate->format('m/d/Y'));

        $newDate = Carbon::now()->subMinute(rand(1, 10));
        $newLike = create(\App\Like::class, [
            'created_at' => $newDate
        ]);
        $this->assertEquals($newLike->created_at, $newDate->diffForHumans());
    }
}
