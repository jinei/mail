@if (Session::has('success'))
<div id="sample">
    <p>{{ Session::get('success') }}</p>
</div>
@endif

<form action="{{ url('contact') }}" method="POST">
    @csrf

    <p>名前：<input type="text" name="name" value="{{old('name')}}"></p>
    @if ($errors->has('name'))
    <p>{{$errors->first('name')}}</p>
    @endif

    <p>メールアドレス：<input type="text" name="email" value="{{old('email')}}"></p>
    @if ($errors->has('email'))
    <p>{{$errors->first('email')}}</p>
    @endif

    <p>メッセージ：
    <textarea name="message">{{ old('message') }}</textarea></p>
    @if ($errors->has('message'))
    <p>{{$errors->first('message')}}</p>
    @endif

    <input type="submit" value="送信する">
</form>

@if (Session::has('success'))
<div id="sample">
    <p>{{ Session::get('success') }}</p>
</div>
@endif
