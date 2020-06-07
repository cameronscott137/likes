<?php

namespace App\Http\Controllers;

use App\Like;
use Illuminate\Http\Request;

class LikesController extends Controller
{
    public function __invoke(Request $request)
    {
        $likes = Like::all();
        return view('likes.index', compact('likes'));
    }
}
