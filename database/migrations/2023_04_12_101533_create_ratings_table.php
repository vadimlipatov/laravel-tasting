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
    Schema::create('ratings', function (Blueprint $table) {
      $table->id();
      $table->float('commercial', 2, 1);
      $table->float('appearance', 2, 1);
      $table->float('cut', 2, 1);
      $table->float('color', 2, 1);
      $table->float('taste', 2, 1);
      $table->float('smell', 2, 1);
      $table->float('consistency', 2, 1);
      $table->float('average', 2, 1);
      $table->text('comment')->nullable();
      $table->text('note')->nullable();
      $table->unsignedBigInteger('user_id');
      $table->unsignedBigInteger('tasting_id');
      $table->unsignedBigInteger('product_id');
      $table->timestamps();

      $table->index('user_id', 'rates_user_idx');
      $table->index('tasting_id', 'rates_tasting_idx');
      $table->index('product_id', 'rates_product_idx');

      $table->foreign('user_id', 'rates_user_fk')
        ->on('users')->references('id');
      $table->foreign('tasting_id', 'rates_tasting_fk')->on('tastings')->references('id');
      $table->foreign('product_id', 'rates_product_fk')->on('products')->references('id');
    });
  }

  /**
   * Reverse the migrations.
   */
  public function down(): void
  {
    Schema::dropIfExists('ratings');
  }
};
