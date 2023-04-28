<?php

namespace App\Http\Controllers\Admin\Tasting;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Tasting;

class StoreController extends Controller
{
  public function __invoke(Request $request)
  {
    $request->validate([
      'title' => 'required|string||min:5|max:250',
      'date' => 'required',
      'status' => 'required',
    ]);

    // dd($request);
    Tasting::create([
      'title' => $request->title,
      'date' => $request->date,
      'status' => $request->status,
    ]);

    return redirect()->route('admin.tasting.index')
      ->withSuccess('You have successfully added tasting');
  }
}
