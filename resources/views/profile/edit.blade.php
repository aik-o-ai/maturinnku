<x-app-layout>
    <x-slot name="header">
        <h2>プロフィール編集</h2>
    </x-slot>

    <form method="POST" action="{{ route('profile.update') }}">
        @csrf
        @method('PATCH')

        <div>
            <label for="name">名前</label>
            <input id="name" name="name" value="{{ old('name', $user->name) }}" required autofocus />
            @error('name')<div>{{ $message }}</div>@enderror
        </div>

        <div>
            <label for="email">メールアドレス</label>
            <input id="email" name="email" type="email" value="{{ old('email', $user->email) }}" required />
            @error('email')<div>{{ $message }}</div>@enderror
        </div>

        <button type="submit">更新する</button>
    </form>
</x-app-layout>