<x-app-layout>
    <x-slot name="header">
        <h1 class="font-semibold text-xl text-gray-800 leading-tight">
            投稿一覧
        </h1>
    </x-slot>

    <div class="py-6 max-w-7xl mx-auto sm:px-6 lg:px-8">
        <h1>Blog Name</h1>

        {{-- 認証済みユーザー名表示 --}}
        @auth
        <p>ようこそ、{{ Auth::user()->name }} さん！</p>
        @else
        <p>ログインしてください。</p>
        @endauth

        @foreach ($festivalImages as $festivalImage)
        <div class='festival_images'>

            <h2 class='title'>{{ $festivalImage->title ?? 'タイトルなし' }}</h2>
            <p class='body'>{{ $festivalImage->body }}</p>

            <a href="{{ route('festival_images.edit', $festivalImage->id) }}">編集</a>

        </div>
        @endforeach
    </div>
    </div>
</x-app-layout>