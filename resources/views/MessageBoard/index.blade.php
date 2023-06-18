<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>伝言アプリ（伝言の一覧画面）</title>
</head>
<body>
<h2>伝言の一覧</h2>

<!--検索参考箇所  -->
<div>
  <form action="/MessageBoard/index" method="GET">
    <input type="text" name="search" value="{{ $keyword }}">
    <input type="submit" value="検索">
  </form>
</div>
<!--  -->


@if ($messages->count() > 0)
    <table border="1">
        <tr>
            <th>ID</th>
            <th>投稿者名</th>
            <th>投稿者の連絡先</th>
            <th>伝言の宛先（名前）</th>
            <th>伝言の宛先（メールアドレス）</th>
            <th>要件・詳細</th>
            <th>送信日時</th>
            <th>編集</th>
            <th>削除</th>
        </tr>
        {{-- @foreach ディレクティブで、1件ずつ処理 --}}
        @foreach ($messages as $message)
            <tr>
                <td>{{ $message->id }}</td>
                <td>{{ $message->name }}</td>
                <td>{{ $message->email }}</td>
                <td>{{ $message->to }}</td>
                <td>{{ $message->contact }}</td>
                <td>{{ $message->comment }}</td>
                <td>{{ $message->created_at }}</td>
                <td><a href="/MessageBoard/edit/{{ $message->id }}">編集</a></td>
                <td>
                    {{-- 各お問い合わせデータごとに、削除ボタンを追加 --}}
                    {{-- 「削除」というデータの内容変更を伴う操作なので、form からPOST メソッドを使う --}}
                    {{-- action先URLにIDを含めて、削除するデータを特定できるようにしておく --}}
                    <form action="/MessageBoard/delete/{{ $message->id }}" method="post">
                        <input type="submit"  name="delete" value="削除">
                        @csrf
                    </form>
                </td>
            </tr>
            @endforeach
    </table>
@else
    <p>伝言がありません</p>
@endif