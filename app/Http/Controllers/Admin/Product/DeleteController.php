<?php

namespace App\Http\Controllers\Admin\Product;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Models\User;

class DeleteController extends Controller
{
  public function __invoke(Request $request)
  {
    Product::find($request->id)->delete();
    // $product->delete();
    return redirect()->route('admin.product.index');
  }
}
