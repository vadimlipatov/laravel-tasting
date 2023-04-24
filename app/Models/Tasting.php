<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tasting extends Model
{
  use HasFactory;
  protected $guarded = false;

  public function products()
  {
    return $this->belongsToMany(Product::class, 'product_tastings', 'tasting_id', 'product_id');
  }

  public function ratings()
  {
    return $this->hasMany(Rating::class);
  }

  public function images()
  {
    return $this->hasMany(Image::class);
  }

  public function product_tastings()
  {
    return $this->hasMany(ProductTasting::class);
  }

  // public function getDateAsCarbonAttribute()
  // {
  //   return Carbon::parse($this->created_at);
  // }
}
