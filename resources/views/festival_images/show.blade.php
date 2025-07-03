<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <!-- モバイル端末対応のための設定。画面の幅に合わせて表示を調整してくれru> -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Laravel</title>
    <!-- Google Fontsの「Nunito」フォントの読み込み -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
</head>

<body>
    <h1 class="title">
        {{ $festivalImage->title }}
    </h1>
    <div>
        <div>
            <h3>本文</h3>
            <p>{{ $festivalImage->body }}</p>
        </div>
        <!-- ここから追加 -->
        <div>
            <img src="{{ $festivalImage->image_url }}" alt="画像が読み込めません。" style="max-width: 400px;">
        </div>
        <!-- ここまで追加 -->
    </div>
    <div class="footer">
        <a href="/festival_images">戻る</a>
    </div>
</body>

</html>