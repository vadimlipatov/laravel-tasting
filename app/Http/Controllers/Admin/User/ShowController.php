<?php

namespace App\Http\Controllers\Admin\User;

use App\Http\Controllers\Controller;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ShowController extends Controller
{
  public function __invoke(User $user)
  {
    $query = DB::table('ratings')->where('user_id', $user->id)->latest()->first();
    if ($query) {
      $lastActivityDate = Carbon::parse($query->created_at)->format('d.m.Y');
      $products = DB::table('ratings')->where('user_id', $user->id)
        ->join('tastings', 'tastings.id', '=', 'ratings.tasting_id')
        ->join('products', 'products.id', '=', 'ratings.product_id')
        ->get()->toArray();
    } else {
      $products = [];
      $lastActivityDate = '';
    }
    // dd($products);

    return view('admin.user.show', compact(['products', 'user', 'lastActivityDate']));
  }
}
