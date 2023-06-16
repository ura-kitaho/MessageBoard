<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>伝言板アプリ（確認画面）</title>
</head>
<body>
<form action="" method="post">
    <input type="hidden" name="name" value="{{$request->name}}">
    <input type="hidden" name="email" value="{{$request->email}}">
    <input type="hidden" name="to" value="{{$request->to}}">
    <input type="hidden" name="contact" value="{{$request->contact}}">
    <input type="hidden" name="comment" value="{{$request->comment}}">

<p>伝言内容確認</p>
<ul>
    <li>
        名前：
        <p>{{$request->name}}</p>
        
    </li>
</ul>
<ul>
    <li>
        あなたの連絡先：
        <p>{{$request->email}}</p>
      
    </li>
</ul>
<ul>
    <li>
        伝言を宛先名：
        <p>{{$request->to}}</p>
      
    </li>
</ul>
<ul>
    <li>
        伝言の宛先（メールアドレス）：
        <p>{{$request->contact}}</p>
       
    </li>
</ul>
<ul>
    <li>
        要件・詳細：
        <p>{{$request->comment}}</p>
        @if ($errors->has('coomment'))
            <p class="error">*{{ $errors->first('comment') }}</p>
        @endif
    </li>
</ul>
<di>
<button class="btn btn-primary" type="submit" name="back">
        <i class="fa-solid fa-caret-left"></i>戻る
    </button>
   
    <button class="btn btn-primary" type="submit" name="send">
        送信 <i class="fa-solid fa-caret-right"></i>
    </button>
</div>
@csrf
</form>
</body>
</html>
