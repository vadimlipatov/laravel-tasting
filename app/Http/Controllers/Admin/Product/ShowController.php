<?php

namespace App\Http\Controllers\Admin\Product;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Tasting;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ShowController extends Controller
{
  public function __invoke(Product $product)
  {
    $tastIds  = DB::table('ratings')->where('product_id', $product->id)->select('user_id')->distinct('user_id')->get();

    $tastings = [];
    $lastTastingDate = '';
    foreach ($tastIds as $key => $tastId) {
      $query =
        DB::table('ratings')
        ->where('product_id', $product->id)
        ->where('user_id', $tastId->user_id)
        ->join('tastings', 'tastings.id', '=', 'ratings.tasting_id');

      $lastTastingDate = $query->latest('date')->first()->date;
      // dd($lastTastingDate);

      // dd($query->get());
      // $tastings[$key]['id'] = $query->select('tastings.id')->first()->id;
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
    foreach ($tastings as $tasting) {
      $average += $tasting['average'];
    }
    if (count($tastings)) $average = $average / count($tastings);

    // dd($product);

    return view('admin.product.show', compact(['tastings', 'product', 'lastTastingDate', 'average']));
  }
}
