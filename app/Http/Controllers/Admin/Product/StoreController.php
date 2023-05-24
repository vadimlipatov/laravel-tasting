<?php

namespace App\Http\Controllers\Admin\Product;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;

class StoreController extends Controller
{
  public function __invoke(Request $request)
  {
    $request->validate([
      'title' => 'required|string||min:5|max:250',
      'description' => 'nullable|string',
    ]);
    // dd($request);
    Product::create([
      'title' => $request->title,
      'description' => $request->description,
    ]);

    return redirect()->route('admin.product.index')
      ->withSuccess('You have successfully added product');
  }
}
