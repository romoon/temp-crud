<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

use App\Models\Posts;
use App\Models\User;

class FrontController extends Controller
{
  public function index(Request $request)
  {
      $posts = Posts::where('publication', 1)->Latest('updated_at')->paginate(10);

      return view('/index', ['posts' => $posts]);
  }
}
