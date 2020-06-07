@extends('layouts.app')

@section('title', "Cameron's Likes")

@section('content')
<main class="max-w-lg mx-auto">
    <section class="shadow">
        @foreach($likes as $like)
        <article class="border-b border-gray-300 p-4">
            {{ $like->text }}
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