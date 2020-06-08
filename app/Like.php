<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Like extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $guarded = [''];

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
            'author_avatar_url' => $like['user']['profile_image_url_https']
        ]);
    }
}
