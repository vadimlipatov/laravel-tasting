<?php

namespace App\Http\Controllers\Tastor\Tasting;

use App\Http\Controllers\Controller;
use App\Http\Requests\Rate\StoreRequest;
use App\Models\Product;
use App\Models\Tasting;
use Illuminate\Http\Request;
use App\Models\Rate;
use App\Models\Rating;

class CreateController extends Controller
{
  public function __invoke(Request $request, Tasting $tasting, Product $product)
  {
    $average = ($request->commercial + $request->appearance + $request->cut + $request->color + $request->taste + $request->smell + $request->consistency) / 7;
    $average = round($average, 2);

    $data = [
      'commercial' => $request->commercial,
      'appearance' => $request->appearance,
      'cut' => $request->cut,
      'color' => $request->color,
      'taste' => $request->taste,
      'smell' => $request->smell,
      'consistency' => $request->consistency,
      'average' => $average,
      'comment' => $request->comment,
      'note' => $request->note,
      'user_id' => auth()->user()->id,
      'tasting_id' => $tasting->id,
      'product_id' => $product->id,
    ];
    // dd($data);
    Rating::firstOrCreate($data);

    return redirect()->route('tastor.tasting.index', compact('tasting'));
  }
}
