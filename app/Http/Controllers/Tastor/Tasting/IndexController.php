<?php

namespace App\Http\Controllers\Tastor\Tasting;

use App\Http\Controllers\Controller;
use App\Models\Image;
use App\Models\ProductTasting;
use App\Models\Rate;
use App\Models\Tasting;
use Illuminate\Http\Request;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class IndexController extends Controller
{
  public function __invoke(Tasting $tasting)
  {
    // dd($tasting->id);
    // $products = DB::table('ratings')->where('tasting_id', $tasting->id)
    //   ->join('products', 'products.id', '=', 'product_id')
    //   ->join('tastings', 'tastings.id', '=', 'tasting_id')
    //   ->select('products.id as id', 'products.title as title', 'tastings.date', 'products.description as description', 'ratings.created_at', 'ratings.product_id', 'ratings.average')
    //   ->get()->groupBy('product_id')->map(function ($row) use ($tasting) {
    //     // dd($row);
    //     $image = Image::where('product_id', $row->first()->id)->where(
    //       'tasting_id',
    //       $tasting->id
    //     )->select('image')->get()->first();
    //     return [
    //       'id' => $row->first()->id,
    //       'title' => $row->first()->title,
    //       'date' => $row->first()->date,
    //       'description' => $row->first()->description,
    //       'created_at' => $row->last()->created_at,
    //       'average' => round($row->avg('average'), 2),
    //       'image' => isset($image) ? $image->image : null,
    //     ];
    //   });
    $products = $tasting->products;

    // dd($products->find(3)->ratings->avg('average'));

    return view('tastor.tasting.index', compact(['products', 'tasting']));
  }
}
