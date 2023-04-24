<?php

namespace App\Http\Controllers\Admin\ProductTasting;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ProductTasting;
use App\Models\Tasting;

class StoreController extends Controller
{
  public function __invoke(Request $request, Tasting $tasting)
  {
    $products = $request->products;
    // dd($products);
    foreach ($products as $product_id) {
      ProductTasting::firstOrCreate([
        'product_id' => $product_id,
        'tasting_id' => $tasting->id,
      ]);
    }

    return redirect()->route('admin.tasting.show', $tasting);
  }
}
