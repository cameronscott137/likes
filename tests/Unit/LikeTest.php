<?php

namespace Tests\Unit;

use App\Like;
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

    /**
     * @test
     * TODO
     */
    public function likes_can_be_searched()
    {

    }

    /**
     * @test
     * TODO
     */
    public function like_model_can_return_oldest_twitter_id()
    {
    }

    /**
     * @test
     * TODO
     */
    public function like_text_can_have_hashtags_and_mentions_linked()
    {
        $text = "Something I wish I’d said more clearly in this piece: The people raising valid points about the methodological limits or @samswey’s #8cantwait work have not exactly brought a ton in the way of better evidence to back up other ideas.";
        $revisedText = Like::parseLikeText($text);
        $this->assertEquals(
            $revisedText,
            'Something I wish I’d said more clearly in this piece: The people raising valid points about the methodological limits or <a class="text-blue-400 hover:text-blue-700 underline" target="_blank" href="https://twitter.com/samswey">@samswey</a>’s <a class="text-blue-400 hover:text-blue-700 underline" target="_blank" href="https://twitter.com/hashtag/8cantwait">#8cantwait</a> work have not exactly brought a ton in the way of better evidence to back up other ideas.'
        );
    }
}
