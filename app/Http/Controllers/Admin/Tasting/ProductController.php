<?php

namespace App\Http\Controllers\Admin\Tasting;

use App\Http\Controllers\Controller;
use App\Models\Tasting;
use App\Models\Rating;
use App\Models\Product;
use App\Models\Image;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
  public function __invoke(Tasting $tasting, Product $product)
  {
    $rates = Rating::where('tasting_id', $tasting->id)->where('product_id', $product->id)->get();

    // dd($rates);

    $average = round($rates->avg('average'), 2);
    $images = Image::where('product_id', $product->id)->where('tasting_id', $tasting->id)->select('image')->get();

    // для share
    $persons = "";
    // foreach ($rates as $key => $rate) {
    //   $id = $key + 1;
    //   $persons .= "\n$id. $rate->user->name - $rate->average";
    // };
    return view('admin.tasting.product.show', compact('rates', 'tasting', 'product', 'average', 'images', 'persons'));
  }
}
