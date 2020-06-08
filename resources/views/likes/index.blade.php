@extends('layouts.app')

@section('title', "Cameron's Likes")

@section('content')
<main class="max-w-lg mx-auto mt-4">
    <form method="GET" action="{{ url()->current() }}">
        <input type="search" name="term" class="border border-gray-300 rounded-full shadow-sm mb-4 py-2 px-4 text-sm w-full" placeholder="Search my likes, you weirdo" value="{{ request()->term }}" autocomplete="off">
    </form>
    <section class="shadow bg-white">
        @foreach($likes as $like)
        <article class="border-b border-gray-300 p-4">
            <div class="mb-4">
                {{ $like->text }}
            </div>
            <footer class="flex items-center">
                <img class="rounded-full" src="{{ $like->author_avatar_url }}">
                <div class="ml-2">
                    <p class="text-sm font-bold">{{ $like->author_name }}</p>
                    <p class="text-xs">
                        {{ $like->created_at }}
                    </p>
                </div>
            </footer>
        </article>
        @endforeach
    </section>
</main>
@endsection