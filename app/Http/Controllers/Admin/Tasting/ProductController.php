<?php

namespace App\Http\Controllers\Admin\Tasting;

use App\Http\Controllers\Controller;
use App\Models\Tasting;
use App\Models\Product;
use App\Models\Image;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
  public function __invoke(Tasting $tasting, Product $product)
  {
    $ratesQuery = DB::table('ratings')->where('tasting_id', $tasting->id)->where('product_id', $product->id)
      ->join('users', 'users.id', '=', 'ratings.user_id');

    $rates = $ratesQuery->get()->toArray();
    $average = round($ratesQuery->avg('average'), 2);
    $images = Image::where('product_id', $product->id)->where('tasting_id', $tasting->id)->select('image')->get();
    // $user = User::find($id)->name;
    // dd(round($average, 2));
    $persons = "";
    foreach ($rates as $key => $rate) {
      $id = $key + 1;
      $persons .= "\n$id. $rate->name - $rate->average";
    };
    return view('admin.tasting.product.show', compact('rates', 'tasting', 'product', 'average', 'images', 'persons'));
  }
}
