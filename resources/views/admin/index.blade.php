@extends('layouts.app_admin')

@section('title', 'ユーザ一覧')

@section('content')
    <div class="container">
        <div class="row">
            <h2>ユーザー一覧</h2>
        </div>
        <!-- 検索 -->
        <div class="row">
            <div class="col-md-10">
                <form action="{{ action('Admin\HomeController@index') }}" method="get">
                    <div class="form-group row mt-4">
                        <label class="col-md-2">検索</label>
                        <div class="col-md-6">
                            <input type="text" class="form-control" name="keyword" value="{{ $keyword }}">
                        </div>
                        <div class="col-md-4">
                            {{ csrf_field() }}
                            <input type="submit" class="btn btn-rmngreen" value="検索">
                            <a href="{{ action('Admin\HomeController@index', $keyword=null) }}" role="button" class="btn btn-outline-rmngreen">リセット</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <!-- 一覧表 -->
        <div class="row">
            <div class="list-news col-md-12 mx-auto">
                <div class="row">
                    <table class="table">
                        <thead>
                            <tr>
                                <th width="10%">id</th>
                                <th width="20%">名前</th>
                                <th width="20%">ニックネーム</th>
                                <th width="20%">メールアドレス</th>
                                <th width="20%">操作</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($users as $user)
                                <tr>
                                    <td>{{ \Str::limit($user->id, 10) }}</td>
                                    <td>{{ \Str::limit($user->name, 20) }}</td>
                                    <td>{{ \Str::limit($user->nickname, 20) }}</td>
                                    <td>{{ \Str::limit($user->email, 50) }}</td>
                                    <td>
                                        <div>
                                          <a href="{{ action('Admin\HomeController@delete', ['id' => $user->id]) }}" role="button" class="btn btn-outline-danger" onclick="return confirm('本当に削除しますか？')">削除</a>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
