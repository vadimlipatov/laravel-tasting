<?php

namespace App\Http\Controllers\API\Product;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ShowController extends Controller
{
  public function __invoke(Request $request)
  {
    $productId = $request->productId;
    // return 111;
    $tastIds  = DB::table('ratings')->where('product_id', $productId)->select('user_id')->distinct('user_id')->get();

    $tastings  = [];
    $lastTastingDate = '';
    foreach ($tastIds as $key => $tastId) {
      $query =
        DB::table('ratings')
        ->where('product_id', $productId)
        ->where('user_id', $tastId->user_id)
        ->join('tastings', 'tastings.id', '=', 'ratings.tasting_id');

      $lastTastingDate = $query->latest('date')->first()->date;
      $tastings[$key]['id'] = $query->select('tastings.id')->first()->id;
      $tastings[$key]['title'] = $query->select('title')->first()->title;
      $tastings[$key]['date'] = $query->select('date')->first()->date;
      $tastings[$key]['peopleCount'] = $query->select('user_id')->count();
      $tastings[$key]['commercial'] = $query->avg('commercial');
      $tastings[$key]['appearance'] = $query->avg('appearance');
      $tastings[$key]['cut'] = $query->avg('cut');
      $tastings[$key]['color'] = $query->avg('color');
      $tastings[$key]['taste'] = $query->avg('taste');
      $tastings[$key]['smell'] = $query->avg('smell');
      $tastings[$key]['consistency'] = $query->avg('consistency');
      $tastings[$key]['average'] = $query->avg('average');
    }

    $average = 0;
    if (count($tastings)) {
      foreach ($tastings as $tasting) {
        $average += $tasting['average'];
      }
      $average = $average / count($tastings);
    }

    $product = Product::find($productId);

    return [
      'tastings' => $tastings ?? [],
      'product' => $product,
      'lastTastingDate' => $lastTastingDate,
      'average' => $average
    ];
  }
}
