@extends('layouts.app')

@section('title','一覧')

@section('content')
{{-- @yieldで指定してる場所にコンテンツを挿入する（layout.blade.phpに設定してある。） --}}
{{-- @section()〜@endsection は 継承することができる （何を？）--}}
{{-- @extends はlayoutsフォルダの中にあるlayout.blade.phpを継承 --}}
{{-- @section('title','一覧') は変数「title」に「一覧」を代入の意 --}}


<a href="{{ route('diary.create') }}" class="btn btn-primary btn-block">
    新規投稿
  </a>

  {{-- @foreach は普通のループ処理と同じ --}}
  @foreach ($diaries as $diary)
    <div class="m-4 p-4 border border-primary">
      <p>{{$diary->title}}</p>
      <p>{{$diary->body}}</p>
      <p>{{$diary->created_at}}</p>

      {{-- Auth::check() : ログインしていたらtrue,他はfalse になりif文の中が実行されなくなる --}}
      @if (Auth::check() && $diary->user_id == Auth::user()->id)
        {{-- DiaryController.php に設定してある --}}
        {{-- diary.edit は web.phpに設定してある --}}
        <a href="{{ route('diary.edit', ['id' => $diary->id]) }}" class="btn btn-success">編集</a>

          <form action="{{ route('diary.destroy',['id' => $diary->id])}}" method="POST" class="d-inline">
          {{-- @csrf は外部からの攻撃防止用の専用コマンド --}}
          {{-- @csrf や @method('delete')はformタグのどこに入れても動く --}}
            @csrf
            @method('delete')
            <button class="btn btn-danger">削除</button>
          </form>
      @endif


    </div>
  @endforeach
  @endsection