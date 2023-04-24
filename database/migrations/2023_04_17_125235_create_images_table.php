<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
  /**
   * Run the migrations.
   */
  public function up(): void
  {
    Schema::create('images', function (Blueprint $table) {
      $table->id();
      $table->string('image');
      $table->unsignedBigInteger('tasting_id');
      $table->unsignedBigInteger('product_id');
      $table->timestamps();

      $table->index('product_id', 'images_product_idx');
      $table->index('tasting_id', 'images_tasting_idx');

      $table->foreign('product_id', 'images_product_fk')
        ->on('products')->references('id');
      $table->foreign('tasting_id', 'images_tasting_fk')->on('tastings')->references('id');
    });
  }

  /**
   * Reverse the migrations.
   */
  public function down(): void
  {
    Schema::dropIfExists('images');
  }
};
