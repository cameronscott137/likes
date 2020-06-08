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
}
