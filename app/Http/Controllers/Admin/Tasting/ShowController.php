<?php

namespace App\Http\Controllers\Admin\Tasting;

use App\Http\Controllers\Controller;
use App\Models\Image;
use App\Models\Tasting;
use App\Models\Product;
use App\Models\Rating;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ShowController extends Controller
{
  public function __invoke(Tasting $tasting)
  {
    $countProducts = Rating::where('tasting_id', $tasting->id)
      ->join('products', 'products.id', '=', 'ratings.product_id')
      ->get()->count();

    // dd($countProducts);

    $products = $tasting->products;

    foreach ($products as $key => $product) {
      $image = Image::where('product_id', $product->id)->where(
        'tasting_id',
        $tasting->id
      )->select('image')->get()->first();
      // dd($image);
      $product->image = null;
      if (isset($image)) $product->image = $image->image;
    }

    // dd($products->first()->ratings->last());

    $allProducts = Product::all();

    return view('admin.tasting.show', compact(['products', 'tasting', 'allProducts']));
  }
}
