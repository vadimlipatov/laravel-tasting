<?php

namespace App\Http\Controllers\Tastor;

use App\Http\Controllers\Controller;
use App\Models\Tasting;
use App\Models\Rating;
use Illuminate\Http\Request;

class IndexController extends Controller
{
  public function __invoke()
  {
    $activeTastings = Tasting::where('status', 1)->get();
    $closeTastings = Tasting::where('status', 0)->get();

    return view('tastor.index', compact(['activeTastings', 'closeTastings']));
  }
}
