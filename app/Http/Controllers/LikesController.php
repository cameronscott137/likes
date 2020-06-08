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
            ->offset($request->offset)
            ->limit(40);

        Log::info($request->offset);

        if ($request->expectsJson()) {
            return response($likes->get(), 200);
        }

        return view('likes.index', [
            'likes' => $likes->get()
        ]);
    }
}
