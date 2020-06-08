<?php

namespace App\Http\Controllers;

use App\Like;
use Illuminate\Http\Request;

class LikesController extends Controller
{
    public function __invoke(Request $request)
    {
        $likes = Like::whereSearch($request->term)
            ->offset($request->offset)
            ->limit(40)
            // ->orderBy('created_at', 'asc')
            ->get();
        return view('likes.index', compact('likes'));
    }
}
