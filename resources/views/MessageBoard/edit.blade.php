<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>伝言アプリ（編集画面）</title>
</head>
<body>
<h2>伝言の編集</h2>

<form action="/MessageBoard/edit/{{$message->id}}" method="POST">
    <div>
        <label for="name">投稿者名</label>
        <input type="text" name="name" id="name" value="{{old('name', $message->name)}}">
        {{-- @if ($errors->has('項目名')) でエラーがあるかを判定 --}}
        @if ($errors->has('name'))
            <p class="error">*{{ $errors->first('name') }}</p>
        @endif
    </div>
    <div>
        <label for="email">投稿者の連絡先</label>
        <input type="email" name="email" id="email" value="{{old('email', $message->email)}}">
        {{-- @if ($errors->has('項目名')) でエラーがあるかを判定 --}}
        @if ($errors->has('email'))
            <p class="error">*{{ $errors->first('email') }}</p>
        @endif
    </div>
    <div>
        <label for="to">伝言の宛先（名前）</label>
        <input type="text" name="to" id="to" value="{{old('to', $message->to)}}">
        {{-- @if ($errors->has('項目名')) でエラーがあるかを判定 --}}
        @if ($errors->has('to'))
            <p class="error">*{{ $errors->first('to') }}</p>
        @endif
    </div>
    <div>
        <label for="contact">伝言の宛先（メールアドレス）</label>
        <input type="text" name="contact" id="contact" value="{{old('contact', $message->contact)}}">
        {{-- @if ($errors->has('項目名')) でエラーがあるかを判定 --}}
        @if ($errors->has('contact'))
            <p class="error">*{{ $errors->first('contact') }}</p>
        @endif
    </div>
    <div>
        <label for="comment">要件・詳細</label>
        <input type="text" name="comment" id="comment" value="{{old('comment', $message->comment)}}">
        {{-- @if ($errors->has('項目名')) でエラーがあるかを判定 --}}
        @if ($errors->has('comment'))
            <p class="error">*{{ $errors->first('comment') }}</p>
        @endif
    </div>

    <div>
        <input type="submit" value="送信">
    </div>
    {{-- GET メソッド以外でリクエストする場合は、@csrfを含める --}}
    @csrf
</form>

</body>
</html>