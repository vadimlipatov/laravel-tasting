<?php

namespace App\Http\Controllers\Admin\Product;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;

class StoreController extends Controller
{
  public function __invoke(Request $request)
  {
    $data = $request->validate([
      'title' => 'required|string||min:5|max:250',
      'description' => 'nullable|string',
      'manufacturing_at' => 'required|string|date',
      'technologist' => 'nullable|string',
      'company' => 'nullable|string',
    ]);
    // dd($request);
    Product::create($data);

    return redirect()->route('admin.product.index')
      ->withSuccess('You have successfully added product');
  }
}
