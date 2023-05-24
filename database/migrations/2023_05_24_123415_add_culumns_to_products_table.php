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
    Schema::table('products', function (Blueprint $table) {
      $table->text('manufacturing_at')->after('description');
      $table->text('technologist')->nullable()->after('manufacturing_at');
      $table->text('company')->nullable()->after('technologist');
    });
  }

  /**
   * Reverse the migrations.
   */
  public function down(): void
  {
    Schema::table('products', function (Blueprint $table) {
      $table->dropColumn('manufacturing_at');
      $table->dropColumn('technologist');
      $table->dropColumn('company');
    });
  }
};
