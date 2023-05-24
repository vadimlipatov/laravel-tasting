<?php

namespace App\Http\Controllers\Admin\Product;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Rating;
use App\Models\Image;
use App\Models\ProductTasting;
use Illuminate\Http\Request;

class DeleteController extends Controller
{
  public function __invoke(Request $request)
  {
    ProductTasting::where('product_id', $request->id)->each(function ($pt) {
      $pt->delete();
    });
    Rating::where('product_id', $request->id)->each(function ($rating) {
      $rating->delete();
    });
    Image::where('product_id', $request->id)->each(function ($image) {
      $image->delete();
    });
    Product::find($request->id)->delete();
    // $product->delete();
    return redirect()->route('admin.product.index');
  }
}
