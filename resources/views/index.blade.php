@extends('layouts.app')

@section('title', 'トップページ')

@section('content')
    <div class="container">
        <div class="row">
            <div class="posts col-md-10 mx-auto mt-3">
              <div class="row">
                  <div class="col-md-10">
                    <h2>公開投稿一覧</h2>
                  </div>
              </div>
                @foreach($posts as $post)
                    <div class="post">
                        <div class="row">
                            <div class="image col-md-6 mt-4">
                                @if ($post->image_path)
                                    <img src="{{ asset('storage/image/' . $post->image_path) }}">
                                @endif
                            </div>
                            <div class="text col-md-6">
                                <div class="date">
                                    {{ $post->updated_at->format('Y年m月d日') }}
                                </div>
                                <div class="title mt-3">
                                    {{ str_limit($post->title, 150) }}
                                </div>
                                <div class="nickname mt-3">
                                    @if (optional($post->user)->nickname != null)
                                      <p>{{ str_limit(optional($post->user)->nickname, 150) }}</p>
                                    @else
                                      <p>no nickname</p>
                                    @endif
                                </div>
                                <div class="body mt-3">
                                    {{ str_limit($post->body, 1500) }}
                                </div>
                            </div>

                        </div>
                    </div>
                    <hr color="#c0c0c0">
                @endforeach
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-10 mx-auto mt-3">
            {{ $posts->links() }}
        </div>
    </div>
@endsection
