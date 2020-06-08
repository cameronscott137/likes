<?php

namespace App\Services;

use App\Like;

use GuzzleHttp\Client;
use GuzzleHttp\Subscriber\Oauth\Oauth1;
use GuzzleHttp\HandlerStack;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Log;

class Twitter extends Model
{
    public function __construct()
    {
         $this->client = $this->fetchClient();
    }

    /**
     * Return Guzzle Client.
     *
     * @return Client
     */
    public function fetchClient()
    {
        $stack = HandlerStack::create();
        $oauth = new Oauth1([
            'consumer_key' => config('services.twitter.api_key'),
            'consumer_secret' => config('services.twitter.api_secret'),
            'token' => config('services.twitter.access_token'),
            'token_secret' => config('services.twitter.access_secret')
        ]);
        $stack->push($oauth);

        $client = new Client([
            'base_uri' => 'https://api.twitter.com',
            'handler' => $stack,
            'auth' => 'oauth'
        ]);

        return $client;
    }

    public function syncLikes($likeId = null) {
        $likes = $this->fetchLikes($likeId);
        foreach ($likes as $like) {
            // dd($like);
            $like = Like::findOrCreate($like);
        }
        if (count($likes) > 0) {
            sleep(13); // Sleep for just long enough to avoid rate limiting.
            $this->syncLikes(Like::oldestTwitterId());
        }
    }

    public function fetchLikes($likeId = null)
    {
        $url = '/1.1/favorites/list.json?tweet_mode=extended';
        if ($likeId) {
            $url = "{$url}&max_id={$likeId}";
        }
        $response = $this->client->get($url);
        return json_decode($response->getBody(), true);
    }
}
