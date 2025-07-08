<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    {{ __("You're logged in!") }}

                    <ul class="mt-4 list-disc list-inside">
                        <li><a href="{{ route('calendar.show') }}" class="text-blue-600 underline">カレンダーを見る</a></li>
                        <li><a href="{{ route('festival.create') }}" class="text-blue-600 underline">祭りを投稿する</a></li>

                    </ul>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>