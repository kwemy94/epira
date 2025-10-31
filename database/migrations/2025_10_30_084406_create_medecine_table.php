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
        Schema::create('medecines', function (Blueprint $table) {
            $table->id();
            $table->foreignId("prestation_id")->constraint('prestations')->onDelete('cascade');
            $table->foreignId("product_id")->constraint('products')->onDelete('cascade');
            $table->string('referene');
            $table->integer('unit_price');
            $table->integer('quantity');
            $table->integer('total_amount');
            $table->text('comment')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('medecines');
    }
};
