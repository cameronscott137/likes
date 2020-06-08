<?php

namespace App\Console\Commands;

use App\Like;
use Illuminate\Console\Command;
use App\Services\Twitter;
use GuzzleHttp\Psr7;
use GuzzleHttp\Exception\RequestException;

class RemoveLike extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'cameron:remove-like
                            {twitterId : The Twitter ID of the Like to remove}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Unlike the referenced Tweet via API, and destroy the corresponding Like model record';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle(Twitter $twitter)
    {
        $twitterId = $this->argument('twitterId');
        $like = Like::where('twitter_id', $twitterId)->first();
        if (!$like) return $this->error("No Like exists with that Twitter ID");
        try {
            $twitter->destroyLike(1116659043710439424);
        } catch (RequestException $e) {
            return $this->error("Removing the like from Twitter failed with the following output: {$e->getMessage()}");
        }
        $like->delete();
    }
}
