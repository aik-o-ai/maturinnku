<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <title>イベント詳細</title>
    <style>
        body {
            font-family: sans-serif;
            margin: 2em;
        }

        .event-info {
            margin-bottom: 2em;
        }

        .event-images img {
            margin: 10px;
            border: 1px solid #ccc;
            border-radius: 8px;
        }
    </style>
</head>

<body>
    <h1>イベント詳細ページ</h1>

    <div class="event-info">
        <h2>{{ $event->event_title }}</h2>
        <p>{{ $event->event_body }}</p>
        <p><strong>日時：</strong>{{ $event->start_date }} ～ {{ $event->end_date }}</p>
        <p><strong>場所：</strong>{{ $event->location }}</p>
    </div>

    <div class="event-images">
        <h3>写真一覧</h3>
        @if($event->images->isEmpty())
        <p>この祭りにはまだ画像が投稿されていません。</p>
        @else
        @foreach ($event->images as $image)
        <img src="{{ asset('storage/' . $image->image_url) }}" alt="祭り画像" width="300">
        @endforeach
        @endif
    </div>

    <div class="footer">
        <a href="{{ route('calendar.show') }}">← カレンダーに戻る</a>
    </div>
</body>

</html>