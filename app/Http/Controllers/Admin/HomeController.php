<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
     public function index(Request $request)
     {
        $keyword = $request->keyword;
         if ($keyword != '') {
             $users = User::where('name', 'like', '%'.$keyword.'%')
             ->orwhere('nickname', 'like', '%'.$keyword.'%')
             ->orwhere('email', 'like', '%'.$keyword.'%')
             ->get();
         } else {
             $users = User::all();
         }
         return view('admin.index', ['users' => $users, 'keyword' => $keyword]);
     }

     public function delete(Request $request)
     {
       $user = User::find($request->id);
       // 削除する
       $user->delete();

       return redirect('admin/index');
     }
}
