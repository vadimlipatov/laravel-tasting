<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Product extends Model
{
  use HasFactory;
  protected $guarded = false;

  public function ratings()
  {
    return $this->hasMany(Rating::class);
  }

  public function images()
  {
    return $this->hasMany(Image::class);
  }
}
