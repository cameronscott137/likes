<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Like extends Model
{

    protected $guarded = [''];

    protected $casts = [
        'media' => 'array',
        'urls' => 'array'
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

    public function scopeWhereSearch($query, $search)
    {
        foreach (explode(' ', $search) as $term) {
            $query->where(function ($query) use ($term) {
                $query->where('text', 'LIKE', '%' . $term . '%')
                    ->orWhere('author_name', 'LIKE', '%' . $term . '%')
                    ->orWhere('author_username', 'LIKE', '%' . $term . '%')
                    ->orWhere('urls', 'LIKE', '%' . $term . '%');
            });
        }
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
            'text' => self::parseLikeText($like['full_text']),
            'author_name' => $like['user']['name'],
            'author_username' => $like['user']['screen_name'],
            'author_avatar_url' => $like['user']['profile_image_url_https'],
            'urls' => (count($like['entities']['urls']) ? $like['entities']['urls'] : null),
            'media' => (isset($like['entities']['media']) ? $like['entities']['media'] : null),
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

    public static function parseLikeText($text)
    {
        $textWithLinksRemoved = preg_replace(
            '/\b(?:(?:https|ftp):\/\/)?\w[\w-]*(?:\.[\w-]+)+\S*/',
            '',
            $text
        );
        $textwithHashtagsLinked = preg_replace(
            '/#([^# ]+)/',
            '<a class="text-blue-500 hover:text-blue-700 underline" target="_blank" href="https://twitter.com/hashtag/$1">$0</a>',
            $textWithLinksRemoved
        );
        $textWithMentionsLinked = preg_replace(
            '/@([^@ |^@’|^@:]+)/',
            '<a class="text-blue-500 hover:text-blue-700 underline" target="_blank" href="https://twitter.com/$1">$0</a>',
            $textwithHashtagsLinked
        );
        return trim($textWithMentionsLinked);
    }
}
