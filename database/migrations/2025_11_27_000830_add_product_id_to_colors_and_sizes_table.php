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
        Schema::table('colors', function (Blueprint $table) {
            $table->foreignId('product_id')->nullable()->constrained()->onDelete('cascade');
        });

        Schema::table('sizes', function (Blueprint $table) {
            $table->foreignId('product_id')->nullable()->constrained()->onDelete('cascade');
        });

        Schema::dropIfExists('product_color');
        Schema::dropIfExists('product_size');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('colors_and_sizes', function (Blueprint $table) {
            //
        });
    }
};
