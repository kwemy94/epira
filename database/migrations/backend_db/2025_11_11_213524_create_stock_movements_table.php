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
        Schema::create('p_stock_movement', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('product_id');
            $table->unsignedBigInteger('warehouse_id');
            $table->double('quantity');
            $table->double('buy_unit_price')->nullable();
            $table->double('sale_unit_price')->nullable();
            $table->string('movement_type')->default('out-stock');
            $table->date('movement_date')->nullable();
            $table->foreign('product_id')->references('id')->on('p_products')->onDelete('cascade');
            $table->foreign('warehouse_id')->references('id')->on('p_warehouses')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('p_stock_movement');
    }
};
