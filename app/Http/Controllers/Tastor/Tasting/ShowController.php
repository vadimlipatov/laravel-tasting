<?php

namespace App\Http\Controllers\Tastor\Tasting;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Tasting;
use App\Models\Image;
use Illuminate\Http\Request;

class ShowController extends Controller
{
  public function __invoke(Tasting $tasting, Product $product)
  {
    $images = Image::where('product_id', $product->id)->where('tasting_id', $tasting->id)->select('image')->get();
    // dd($images);
    return view('tastor.tasting.show', compact(['tasting', 'product', 'images']));
  }
}
