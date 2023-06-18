<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>伝言板アプリ（新規入力画面）</title>
</head>
<body>
<h1>伝言板アプリ</h1>
<h2>新規入力画面</h2>
<form action="/MessageBoard/confirm" method="POST">
    <div>
        <label for="name">名前</label><br>
        <input type="text" name="name" id="name" placeholder="名前を入力してください" value="{{old('name')}}" size="40">
        @if ($errors->has('name'))
            <p class="error">*{{ $errors->first('name') }}</p>
        @endif
    
    </div>
    <div>
        <br><label for="email">あなたの連絡先</label><br>
        <input type="email" name="email" id="email" placeholder="あなたの連絡先を入力してください" value="{{old('email')}}" size="40">
        @if ($errors->has('email'))
            <p class="error">*{{ $errors->first('email') }}</p>
        @endif
    </div>
    <div>
        <br><label for="to">誰に伝言を残しますか？</label><br>
        <input type="text" name="to" id="to" placeholder="伝言を残したい方の名前を入力してください" value="{{old('to')}}" size="40">
        @if ($errors->has('to'))
            <p class="error">*{{ $errors->first('to') }}</p>
        @endif
    </div>
    <div>
        <br><label for="contact">伝言の宛先（メールアドレス）</label><br>
        <input type="email" name="contact" id="contact" placeholder="伝言を残したい方の連絡先を入力してください" value="{{old('contact')}}" size="40">
        @if ($errors->has('contact'))
            <p class="error">*{{ $errors->first('contact') }}</p>
        @endif
    </div>
    <div>
        <br><label for="comment">要件・詳細</label><br>
        <textarea name="comment" id="comment" cols="45" rows="10" value="{{old('comment')}}">要件・詳細を入力してください</textarea>
        @if ($errors->has('comment'))
            <p class="error">*{{ $errors->first('comment') }}</p>
        @endif
    </div>
    <div>
       <br> <input type="submit" value="送信">
    </div>
    {{-- GET メソッド以外でリクエストする場合は、@csrfを含める --}}
    @csrf
</form>
   
</body>
</html>
