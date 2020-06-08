@extends('layouts.app')

@section('title', "Cameron's Likes")

@section('content')
<main class="max-w-lg mx-auto mt-4">
    <form method="GET" action="{{ url()->current() }}">
        <input type="search" name="term" class="border border-gray-300 rounded-full shadow-sm mb-4 py-2 px-4 text-sm w-full" placeholder="Search my likes, you weirdo" value="{{ request()->term }}" autocomplete="off">
    </form>
    <like-list :likes="{{ $likes }}"></like-list>
</main>
@endsection