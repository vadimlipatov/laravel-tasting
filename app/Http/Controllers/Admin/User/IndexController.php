<?php

namespace App\Http\Controllers\Admin\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class IndexController extends Controller
{
  public function __invoke()
  {
    $users = User::all();
    foreach ($users as $key => $user) {
      $query = DB::table('ratings')->where('user_id', $user['id']);

      $users[$key]['lastActivityDate'] = $query->count() ? Carbon::parse($query->latest()->first()->created_at)->format('d.m.Y')  : '';
    }

    // dd($usersArray);

    return view('admin.user.index', compact('users'));
  }
}
