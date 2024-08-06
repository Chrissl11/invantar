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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('product_name');
            $table->string('product_number');
            $table->decimal('product_purchasePrice', 8, 2);
            $table->decimal('product_residualValue', 8, 2);
            $table->text('product_description')->nullable();
            $table->timestamps();
            $table->unsignedBigInteger('inventory_id');
            $table->foreign('inventory_id')->references('id')->on('inventories')->cascadeOnDelete();
            $table->unsignedBigInteger('status_id');
            $table->foreign('status_id')->references('id')->on('statuses')->cascadeOnDelete();
        });
        Schema::table('products', function (Blueprint $table) {
            $table->integer('product_number')->autoIncrement()->unique();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
