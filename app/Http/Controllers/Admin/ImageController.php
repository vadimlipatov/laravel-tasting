<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Image;
use App\Models\Product;
use App\Models\Tasting;
use Illuminate\Http\File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ImageController extends Controller
{
  public function __invoke(Tasting $tasting, Product $product, Request $request)
  {

    $request->validate([
      'image' => 'required|image'
    ]);

    // $image = Storage::disk('public')->put('images', $request['image']); // путь

    $imageName = 'images/' . time() . '.' . $request->image->extension();

    // Public Folder
    $request->image->move(public_path('storage/images'), $imageName);

    Image::firstOrCreate([
      'image' => $imageName,
      'tasting_id' => $tasting->id,
      'product_id' => $product->id,
    ]);

    return redirect()->route('admin.tasting.show', $tasting->id);
  }
}
