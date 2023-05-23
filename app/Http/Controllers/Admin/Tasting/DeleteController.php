<?php

namespace App\Http\Controllers\Admin\Tasting;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Models\Tasting;

class DeleteController extends Controller
{
  public function __invoke(Tasting $tasting)
  {

    $tasting->images->each(function ($image) {
      $image->delete();
    });

    $tasting->product_tastings->each(function ($item) {
      $item->delete();
    });

    $tasting->ratings->each(function ($item) {
      $item->delete();
    });

    $tasting->delete();

    return redirect()->route('admin.tasting.index');
  }
}
