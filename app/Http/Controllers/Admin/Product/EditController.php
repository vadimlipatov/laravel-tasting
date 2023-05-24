<?php

namespace App\Http\Controllers\Admin\Product;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Post;
use App\Models\Tag;

class EditController extends Controller
{
  public function __invoke(Product $product)
  {
    // dd($product);
    return view('admin.product.edit', compact('product'));
  }
}
