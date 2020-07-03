@extends('layouts.app')

@section('title', "Cameron's Likes")

@section('content')

<section class="bg-gray-400 border-b border-gray-500 mb-8">
    <div class="container mx-auto text-center pt-6 pb-8 px-4">
        <h2 class="font-bold">What is This?</h2>
        <p>As a Twitter addict, I've been frustrated for years by Twitter's decision to order likes by the date of a Tweet's publication, and not the date liked. As a result, liked tweets frequently disappeared into the ether, never to be seen again. I built this to find those tweets.<br>
        <a class="underline" href="http://cameronscott.co/posts/2020/06/30/search-my-likes" target="_blank">Read the blog post</a> or <a class="underline" href="https://github.com/cameronscott137/likes" target="_blank">
            read the code
        </a>.
    </div>
</section>

<main class="max-w-xl mx-auto mt-4">
    <form method="GET" action="{{ url()->current() }}" class="md:mx-0 mx-4">
        <input type="search" name="term" class="border border-gray-300 rounded-full shadow-sm mb-4 py-2 px-4 text-sm w-full" placeholder="Search my likes, you weirdo" value="{{ request()->term }}" autocomplete="off">
    </form>
    <like-list :likes="{{ $likes }}"></like-list>
</main>
@endsection