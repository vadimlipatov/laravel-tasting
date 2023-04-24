<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Image;
use App\Models\Product;
use App\Models\Tasting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ImageController extends Controller
{
  public function __invoke(Tasting $tasting, Product $product, Request $request)
  {
    // $data = $request->validated();
    // dd($tasting->id, $product->id);

    $image = Storage::disk('public')->put('images', $request['image']); // путь


    Image::firstOrCreate([
      'image' => $image,
      'tasting_id' => $tasting->id,
      'product_id' => $product->id,
    ]);

    return redirect()->route('admin.tasting.show', $tasting->id);
  }
}
