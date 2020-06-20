<?php
 
namespace App\Http\Controllers;
 
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Mail\HelloEmail;
use Mail;
 
class ContactController extends Controller
{
    public function index()
    {
        return view('contact.index');
    }
 
    public function send(Request $request)
    {
        $rules = [
            'name' => 'required|max:10',
            'email' => 'required|email',
            'message' => 'required|max:1000',
        ];
 
        $messages = [
            'name.required' => '名前を入力して下さい。',
            'name.max' => '名前は10文字以下で入力して下さい。',
            'email.required' => 'メールアドレスを入力して下さい。',
            'email.email' => '正しいメールアドレスを入力して下さい。',
            'message.required' => 'メッセージを入力して下さい。',
            'message.max' => 'メッセージは1000文字以下で入力して下さい。',
        ];
 
        $validator = Validator::make($request->all(), $rules, $messages);
 
        if ($validator->fails()) {
            return redirect('/contact')
                ->withErrors($validator)
                ->withInput();
        }
 
        $data = $validator->validate();
 
        Mail::to('admin@hoge.co.jp')->send(new HelloEmail($data));
 
        session()->flash('success', '送信いたしました！');
        return back();
    }
}