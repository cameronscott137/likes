<?php

namespace App\Services;

use GuzzleHttp\Client;
use GuzzleHttp\Subscriber\Oauth\Oauth1;
use GuzzleHttp\HandlerStack;
use Illuminate\Database\Eloquent\Model;

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

    public function fetchLikes()
    {
        $response = $this->client->get('/1.1/favorites/list.json?tweet_mode=extended');
        return json_decode($response->getBody(), true);
    }
}
