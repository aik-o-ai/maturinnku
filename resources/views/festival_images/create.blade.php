<!DOCTYPE HTML>
<html lang="ja">

<head>
    <meta charset="utf-8">
    <title>Blog</title>
</head>

<body>
    <!-- formタグにenctypeを追加 -->
    <!-- enctypeとは、ファイルを送信する際にデータの形式を決めるもの -->
    <form action="/festival_images" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="title">
            <h2>Title</h2>
            <input type="text" name="title" placeholder="タイトル" value="{{ old('title') }}" />
        </div>
        <div class="body">
            <h2>Body</h2>
            <textarea name="body" placeholder="今日も1日お疲れさまでした。">{{ old('body') }}</textarea>
        </div>
        <!-- ここから追加 -->
        <div class="image">
            <input type="file" name="image">
        </div>
        <!-- ここまで追加 -->
        <input type="submit" value="store" />
    </form>



    <div class="footer">
        <a href="/">戻る</a>
    </div>
</body>

</html>