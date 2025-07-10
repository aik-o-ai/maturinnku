<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            投稿の編集
        </h2>
    </x-slot>

    <div class="py-6 max-w-7xl mx-auto sm:px-6 lg:px-8">
        <form method="POST" action="{{ route('festival_images.update', $festivalImage->id) }}">
            @csrf
            @method('PUT')

            <div>
                <label for="title">タイトル</label>
                <input type="text" name="title" id="title" required>
            </div>

            <div>
                <label for="body">本文</label>
                <textarea name="body" id="body" rows="3"></textarea>
            </div>

            <button type="submit">更新する</button>
        </form>
    </div>
</x-app-layout>