@extends('layouts.app')

@section('title', '投稿の編集')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 mx-auto">
                <h2>投稿の編集</h2>
                <form action="{{ action('User\PostController@update') }}" method="post" enctype="multipart/form-data">
                    @if (count($errors) > 0)
                        <ul>
                            @foreach($errors->all() as $e)
                                <li>{{ $e }}</li>
                            @endforeach
                        </ul>
                    @endif
                    <div class="form-group row">
                        <label class="col-md-2" for="title">タイトル</label>
                        <div class="col-md-10">
                            <input type="text" class="form-control" name="title" value="{{ $posts_form->title }}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-2" for="body">本文</label>
                        <div class="col-md-10">
                            <textarea class="form-control" name="body" rows="20">{{ $posts_form->body }}</textarea>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-2" for="image">画像</label>
                        <div class="col-md-10">
                            <input type="file" class="form-control-file" name="image">
                            <div class="form-text text-info">
                                設定中: {{ $posts_form->image_path }}
                            </div>
                            <div class="form-check">
                                <label class="form-check-label">
                                    <input type="checkbox" class="form-check-input" name="remove" value="true">画像を削除
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-2">公開/非公開</label>
                        <div class="col-md-10 can-toggle demo-rebrand-1">
                            <input type="hidden" name="publication" value="0" />
                            @if ($posts_form->publication === 1)
                            <input id="d" type="checkbox" name="publication" value="1" checked />
                            @else
                            <input id="d" type="checkbox" name="publication" value="1" />
                            @endif
                            <label for="d">
                                <div class="can-toggle__switch" data-checked="公開" data-unchecked="非公開"></div>
                                <div class="can-toggle__label-text">公開/非公開</div>
                            </label>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-12">
                            <input type="hidden" name="id" value="{{ $posts_form->id }}">
                            {{ csrf_field() }}
                            <input type="submit" class="btn btn-outline-rmngreen" value="更新">
                            <a href="{{ asset('user/posts/index') }}" role="button" class="btn btn-outline-rmngreen">投稿の一覧</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
