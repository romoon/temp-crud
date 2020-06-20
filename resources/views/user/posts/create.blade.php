@extends('layouts.app')

@section('title', '投稿の新規登録')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 mx-auto">
                <h2>投稿の新規登録</h2>
                <form action="{{ action('User\PostController@create') }}" method="post" enctype="multipart/form-data">

                    @if (count($errors) > 0)
                        <ul>
                            @foreach($errors->all() as $e)
                                <li>{{ $e }}</li>
                            @endforeach
                        </ul>
                    @endif

                    <div class="form-group row">
                        <label class="col-md-2">Title</label>
                        <div class="col-md-10">
                            <input type="text" class="form-control" name="title" value="{{  old('title') }}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-2">Body</label>
                        <div class="col-md-10">
                            <textarea class="form-control" name="body" rows="10">{{ old('body') }}</textarea>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-2">画像</label>
                        <div class="col-md-10">
                            <input type="file" class="form-control-file" name="image">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-2">公開/非公開</label>
                        <div class="col-md-10 can-toggle">
                            <input type="hidden" name="publication" value="0" />
                            <input id="d" type="checkbox" name="publication" value="1" checked />
                            <label for="d">
                                <div class="can-toggle__switch" data-checked="公開" data-unchecked="非公開"></div>
                                <div class="can-toggle__label-text">公開/非公開</div>
                            </label>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-12">
                            <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
                            {{ csrf_field() }}
                            <input type="submit" class="btn btn-rmngreen" value="登録">
                            <a href="{{ asset('user/posts/index') }}" role="button" class="btn btn-outline-rmngreen">投稿の一覧</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
