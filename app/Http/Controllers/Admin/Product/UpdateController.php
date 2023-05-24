<?php

namespace App\Http\Controllers\Admin\Product;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Product;

class UpdateController extends Controller
{
  public function __invoke(Request $request, Product $product)
  {
    $data = $request->validate([
      'title' => 'required|string||min:5|max:250',
      'description' => 'nullable|string',
      'manufacturing_at' => 'required|string|date',
      'technologist' => 'nullable|string',
      'company' => 'nullable|string',
    ]);

    // dd($product);

    $product->update($data);

    return redirect()->route('admin.product.index')
      ->withSuccess('You have successfully updated product');
  }
}
