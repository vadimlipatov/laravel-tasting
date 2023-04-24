<?php

namespace App\Http\Controllers\API\Tastor;

use App\Http\Controllers\Controller;
use App\Models\Image;
use App\Models\Product;
use App\Models\Tasting;
use App\Models\Rating;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ShowController extends Controller
{
  public function __invoke(Tasting $tasting, Product $product, Request $request)
  {
    // return $request;
    $images = Image::where('product_id', $product->id)->where('tasting_id', $tasting->id)->select('image')->get();
    $ratesCount = Rating::where('product_id', $product->id)->where('tasting_id', $tasting->id)->where('user_id', $request->user_id)->get()->count();

    return [
      'images' => $images,
      'product' => $product,
      'tasting' => $tasting,
      'blockButton' => $ratesCount
    ];
  }
}
