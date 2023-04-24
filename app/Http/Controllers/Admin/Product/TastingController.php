<?php

namespace App\Http\Controllers\Admin\Product;

use App\Http\Controllers\Controller;
use App\Models\Tasting;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TastingController extends Controller
{
  public function __invoke(Product $product, Tasting $tasting)
  {
    $tastings = DB::table('ratings')
      ->where('product_id', $product->id)
      ->join('users', 'users.id', '=', 'ratings.user_id')
      ->join('tastings', 'tastings.id', '=', 'ratings.tasting_id')
      ->join('products', 'products.id', '=', 'ratings.product_id')
      ->select('ratings.id', 'tastings.title as t_title', 'products.title as p_title', 'date', 'name',  'commercial', 'appearance', 'cut', 'color', 'taste', 'smell', 'consistency', 'average', 'comment', 'note', 'description', 'ratings.created_at as created_at')
      ->get();

    $lastTastingDate = Tasting::all()->last()->date;
    return view('admin.product.tasting.show');
  }
}
