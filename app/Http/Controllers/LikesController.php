<?php

namespace App\Http\Controllers;

use App\Like;
use Illuminate\Http\Request;
use Log;

class LikesController extends Controller
{
    public function __invoke(Request $request)
    {
        $likes = Like::whereSearch($request->term)
            ->orderBy('created_at', 'desc')
            ->offset($request->offset)
            ->limit(40)
            ->get();

        if ($request->expectsJson()) {
            return response($likes, 200);
        }

        return view('likes.index', [
            'likes' => $likes
        ]);
    }
}
