<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            祭りを投稿する
        </h2>
    </x-slot>

    <div class="py-12 max-w-4xl mx-auto">
        <form method="POST" action="{{ route('festival.store') }}" enctype="multipart/form-data">
            @csrf

            <div>
                <label for="event_title">タイトル</label>
                <input type="text" name="event_title" id="event_title" required>
            </div>

            <div>
                <label for="event_body">内容</label>
                <textarea name="event_body" id="event_body" rows="3"></textarea>
            </div>
            <div class="mt-4">
                <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">投稿する</button>
            </div>
        </form>
    </div>
</x-app-layout>