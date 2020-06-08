<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Like extends Model
{

    protected $guarded = [''];

    protected $casts = [
        'twitter_id' => 'integer'
    ];

    protected $dates = [
        'created_at',
    ];

    public function getCreatedAtAttribute($value)
    {
        $date = Carbon::parse($value);
        if ($date > Carbon::now()->subDay()) {
            return $date->diffForHumans();
        }
        return $date->format('m/d/Y');
    }

    /**
     * See if Like exists via Twitter ID. If no match is found,
     * store the new like.
     *
     * @param array $like
     * @return Like
     */
    public static function findOrCreate(array $like)
    {
        $existingLike = self::where('twitter_id', $like['id'])->first();
        if ($existingLike) return;
        return self::create([
            'twitter_id' => $like['id'],
            'text' => $like['full_text'],
            'author_name' => $like['user']['name'],
            'author_username' => $like['user']['screen_name'],
            'author_avatar_url' => $like['user']['profile_image_url_https'],
            'created_at' => Carbon::parse($like['created_at'])
        ]);
    }

    /**
     * Return oldest Like in the system, as determined by Twitter ID,
     * so that API calls can be offset.
     *
     * @return string
     */
    public static function oldestTwitterId()
    {
        return self::orderBy('twitter_id', 'asc')->first()->twitter_id;
    }
}
