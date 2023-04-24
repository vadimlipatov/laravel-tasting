<?php

namespace App\Http\Controllers\API\User;

use App\Http\Controllers\Controller;
use App\Http\Resources\ProductResource;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
  public function __invoke(Request $request)
  {
    $userId = $request->userId;
    $userName = DB::table('users')->where('id', $userId)->get()->first()->name;
    $query = DB::table('ratings')->where('user_id', $userId)->latest()->first();
    if ($query) {
      $lastActivityDate = Carbon::parse($query->created_at)->format('d.m.Y');
      $products = DB::table('ratings')->where('user_id', $userId)
        ->join('tastings', 'tastings.id', '=', 'ratings.tasting_id')
        ->join('products', 'products.id', '=', 'ratings.product_id')
        ->get()->toArray();
    } else {
      $products = [];
      $lastActivityDate = '';
    }
    // dd($products);

    return [
      'userName' => $userName,
      'products' => $products,
      'lastActivityDate' => $lastActivityDate,
    ];
  }
}
