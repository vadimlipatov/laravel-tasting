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

    $products = $tasting->products;

    return view('tastor.tasting.index', compact(['products', 'tasting']));
  }
}
