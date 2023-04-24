<?php

namespace App\Http\Controllers\Admin\Tasting;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Models\Tasting;

class CloseController extends Controller
{
  public function __invoke(Tasting $tasting)
  {
    // dd(111);
    $tasting->update(['status' => 0]);
    return redirect()->route('admin.tasting.index');
  }
}
