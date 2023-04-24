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
    Schema::create('product_tastings', function (Blueprint $table) {
      $table->id();
      $table->unsignedBigInteger('product_id')->nullable();
      $table->unsignedBigInteger('tasting_id')->nullable();
      $table->timestamps();

      $table->index('product_id', 'ptp_idx');
      $table->index('tasting_id', 'ptt_idx');

      $table->foreign('product_id', 'ptp_fk')->on('products')->references('id');
      $table->foreign('tasting_id', 'ptt_fk')->on('tastings')->references('id');
    });
  }

  /**
   * Reverse the migrations.
   */
  public function down(): void
  {
    Schema::dropIfExists('product_tastings');
  }
};
