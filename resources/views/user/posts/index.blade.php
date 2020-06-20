@extends('layouts.app')

@section('title', '投稿の一覧')

@section('content')
    <div class="container">
        <div class="row">
            <div class="list-news col-md-10 mx-auto">
                <div class="row">
                    <div class="col-md-4">
                      <h2>投稿の一覧</h2>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-10">
                        <form action="{{ action('User\PostController@index') }}" method="get">
                            <div class="form-group row mt-4">
                                <label class="col-md-2">検索</label>
                                <div class="col-md-6">
                                    <input type="text" class="form-control" name="cond_title" value="{{ $cond_title }}">
                                </div>
                                <div class="col-md-4">
                                    {{ csrf_field() }}
                                    <input type="submit" class="btn btn-rmngreen" value="検索">
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="list-news col-md-10 mx-auto">
                <div class="row">
                    <table class="table">
                        <thead>
                            <tr>
                                <th width="10%">ID</th>
                                <th width="15%">更新日時</th>
                                <th width="15%">タイトル</th>
                                <th width="25%">本文</th>
                                <th width="10%">公開/</br>非公開</th>
                                <th width="20%">操作</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($posts as $post)
                                <tr>
                                    <th>{{ $post->id }}</th>
                                    <th>{{ $post->updated_at }}</th>
                                    <td>{{ \Str::limit($post->title, 100) }}</td>
                                    <td>{{ \Str::limit($post->body, 250) }}</td>
                                    @if ($post->publication === 1)
                                    <th bgcolor=""><font color="">公開</font></th>
                                    @else
                                    <th bgcolor=""><font color="#bfbfbf">非公開</font></th>
                                    @endif
                                    <td>
                                        <div>
                                            <a href="{{ action('User\PostController@edit', ['id' => $post->id]) }}" role="button" class="btn btn-outline-rmngreen">編集</a>
                                            <a href="{{ action('User\PostController@delete', ['id' => $post->id]) }}" role="button" class="btn btn-outline-danger" onclick="return confirm('本当に削除しますか？')">削除</a>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="row">
                  {{ $posts->links() }}
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-10 mx-auto mt-5">
                <div class="row">
                    <div class="col-md-10">
                      <a href="{{ asset('user/posts/create') }}" role="button" class="btn btn-rmngreen">新規投稿</a>
                      <a href="{{ asset('user/profile/edit') }}" role="button" class="btn btn-warning">ユーザー情報の編集</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
