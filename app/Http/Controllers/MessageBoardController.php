<?php

namespace App\Http\Controllers;

use App\Models\Message;
use Illuminate\Http\Request;

class MessageBoardController extends Controller
{
    
    public function add(){
        return view('MessageBoard.add');

}

public function confirm(Request $request){
    //dd($request->all());

    $this->validate($request, [
        /* name 欄を 必須項目、2文字以上、100文字以内で形式判定する */
        'name' => ['required', 'min:2', 'max:100'],
        'email' => ['email'],
        'to' => ['required', 'min:2', 'max:100'],
        'contact' => ['email'],
        'comment' => ['between:1,500']
    ]);

    if ($request->has('back')){
        /* withInput() で、現在の入力内容をリダイレクトのリクエストに付加する */
        return redirect('/MessageBoard')->withInput();
    }

    if($request->has('send')){
        $new_message = new Message();
        $new_message->name = $request->name;
        $new_message->email = $request->email;
        $new_message->to = $request->to;
        $new_message->contact = $request->contact;
        $new_message->comment = $request->comment;
       
        $new_message ->save();


        return redirect('/MessageBoard/complete');


    }


    return view('MessageBoard.confirm', compact('request'));
}

public function index(Request $request) {
 
    $keyword = $request->input('keyword');

    $query = Message::query();
   
    // return view('MessageBoard.index', compact('messages'));

    //   if($request->has('search')){



        if(!empty($keyword)) {
      
        

        // $query = Message::query();

      
            $query->where('id', 'LIKE', "%{$keyword}%")
             ->orWhere('name', 'LIKE', "%{$keyword}%")
             ->orWhere('email', 'LIKE', "%{$keyword}%")
             ->orWhere('to', 'LIKE', "%{$keyword}%")
             ->orWhere('contact', 'LIKE', "%{$keyword}%")
             ->orWhere('comment', 'LIKE', "%{$keyword}%");
        }

        $posts = $query->get();

        return view('MessageBoard.index', compact('posts', 'keyword'));
    }





public function delete($id)
{
    /* Contact モデルで、削除する対象のデータを取得する
     * URLに、削除するデータを含めているので、それを利用する
     */
    $message_to_delete = Message::find($id);

    /* 取得したデータの削除を実行する */
    $message_to_delete->delete();

    /* 一覧画面を表示する */
    return redirect('/MessageBoard/index');
}

public function edit($id)
{
    /* Contact モデルで、編集する対象のデータを取得する
     */
    $message = Message::find($id);

    /* 編集画面に、データを表示する */
    return view('MessageBoard.edit', compact('message'));
}

public function update(Request $request, $id)
    {
        /* バリデーションを実施する */
        $this->validate($request, [
            /* name 欄を 必須項目、2文字以上、100文字以内で形式判定する */
            'name' => ['required', 'min:2', 'max:100'],
            'email' => ['email'],
            'to' => ['required', 'min:2', 'max:100'],
            'contact' => ['email'],
            'comment' => ['between:1,500']
        ]);

        /* Contact モデルで、編集する対象のデータを取得する */
        $message = Message::find($id);

        /* リクエストで渡された値を設定する */
        $message->name = $request->name;
        $message->email = $request->email;
        $message->to = $request->to;
        $message->contact = $request->contact;
        $message->comment = $request->comment;

        /* データベースに保存 */
        $message->save();

        /* 一覧画面に戻る */
        return redirect('/MessageBoard/index');
    }



}
