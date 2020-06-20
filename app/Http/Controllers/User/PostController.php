<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\Posts;
use Storage;

class PostController extends Controller
{
    //
    public function add()
  {
      return view('user.posts.create');
  }

  public function create(Request $request)
  {
      // Varidationを行う
      $this->validate($request, Posts::$rules);

      $posts = new Posts;
      $form = $request->all();

      // フォームから画像が送信されてきたら、保存して、$posts->image_path に画像のパスを保存する
      if (isset($form['image'])) {
          $path = $request->file('image')->store('public/image');
          $posts->image_path = basename($path);
          // $path = Storage::disk('s3')->putFile('/',$form['image'],'public');
          // $posts->image_path = Storage::disk('s3')->url($path);
      } else {
          $posts->image_path = null;
      }
      unset($form['_token']);
      unset($form['image']);
      $posts->fill($form);
      $posts->save();

      return redirect('user/posts/create');
  }

  public function index(Request $request)
  {
      $currentuser = \Auth::user()->id;
      $cond_title = $request->cond_title;
      if ($cond_title != '') {
          // 検索されたら検索結果を取得する
          $posts = Posts::where('user_id', $currentuser)
          ->where('title', 'like', '%'.$cond_title.'%')
          ->orwhere('body', 'like', '%'.$cond_title.'%')
          ->get();
      } else {
          // それ以外はすべてのニュースを取得する
          $posts = Posts::where('user_id', $currentuser)
          ->get();
      }
      return view('user.posts.index', ['posts' => $posts, 'cond_title' => $cond_title]);
  }

  public function edit(Request $request)
  {
      $posts = Posts::find($request->id);
      if (empty($posts)) {
        abort(404);
      }
      return view('user.posts.edit', ['posts_form' => $posts]);
  }

  public function update(Request $request)
  {
      // Validationをかける
      $this->validate($request, Posts::$rules);
      // News Modelからデータを取得する
      $posts = Posts::find($request->id);
      // 送信されてきたフォームデータを格納する
      $posts_form = $request->all();
      if (isset($posts_form['image'])) {
        $path = $request->file('image')->store('public/image');
        $posts->image_path = basename($path);
        // $path = Storage::disk('s3')->putFile('/',$form['image'],'public');
        // $posts->image_path = Storage::disk('s3')->url($path);
        unset($posts_form['image']);
      } elseif (isset($request->remove)) {
        $posts->image_path = null;
        unset($posts_form['remove']);
      }
      unset($posts_form['_token']);
      // 該当するデータを上書きして保存する
      $posts->fill($posts_form)->save();

      return redirect('user/posts/index');
  }

  public function delete(Request $request)
  {
      // 該当するNews Modelを取得
      $posts = Posts::find($request->id);
      // 削除する
      $posts->delete();
      return redirect('user/posts/index');
  }
}
