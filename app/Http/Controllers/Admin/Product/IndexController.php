<?php

namespace App\Http\Controllers\Admin\Product;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class IndexController extends Controller
{
  public function __invoke()
  {
    $products = Product::all()->toArray();

    foreach ($products as $key => $product) {
      $query = DB::table('ratings')->where('product_id', $product['id']);

      $products[$key]['lastActivityDate'] = $query->count() ? Carbon::parse($query->latest()->first()->created_at)->format('d.m.Y')  : '';
    }

    // dd($products);

    return view('admin.product.index', compact(['products']));
  }
}
