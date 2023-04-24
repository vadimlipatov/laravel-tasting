<?php

namespace App\Http\Controllers\Admin\Tasting;

use App\Http\Controllers\Controller;
use App\Models\Tasting;
use Illuminate\Http\Request;
use App\Models\User;

class IndexController extends Controller
{
  public function __invoke()
  {
    $tastings = Tasting::all();

    // dd($tastings->first());
    // dd($tastings->first()->products->first()->ratings);

    $activeTastings = $tastings->where('status', 1);
    $finishTastings = $tastings->where('status', 0);

    return view('admin.tasting.index', compact(['activeTastings', 'finishTastings']));
  }
}
