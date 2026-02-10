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
        Schema::create('p_products', function (Blueprint $table) {
            $table->id();
            $table->string('reference')->unique();
            $table->unsignedBigInteger('category_id');
            $table->unsignedBigInteger('product_type_id');
            $table->unsignedBigInteger('stock_type_id')->nullable();
            $table->unsignedBigInteger('buy_unit_id')->nullable();
            $table->unsignedBigInteger('sale_unit_id')->nullable();
            $table->string('name');
            $table->text('description')->nullable();
            $table->tinyInteger('operation_type')->default(0)->comment("0 = Achat, 1 = Vente, 2 = Achat/Vente");
            $table->string('supplier')->nullable();
            $table->text('fiche_produit')->nullable();

            $table->double('sale_price_ht')->nullable();
            $table->string('sale_tva')->nullable();
            $table->double('sale_amount_tva')->nullable();
            $table->double('sale_amount_ttc')->nullable();
            $table->string('sale_device')->nullable();
            $table->string('sale_unit')->nullable();

            $table->double('buy_price_ht')->nullable();
            $table->string('buy_tva')->nullable();
            $table->double('buy_amount_tva')->nullable();
            $table->double('buy_amount_ttc')->nullable();
            $table->string('buy_device')->nullable();
            $table->string('buy_unit')->nullable();
            $table->foreign('category_id')->references('id')->on('p_categories')->onDelete('cascade');
            $table->foreign('product_type_id')->references('id')->on('p_product_types')->onDelete('cascade');
            $table->foreign('stock_type_id')->references('id')->on('p_stock_types')->onDelete('cascade');
            $table->foreign('buy_unit_id')->references('id')->on('p_units')->onDelete('cascade');
            $table->foreign('sale_unit_id')->references('id')->on('p_units')->onDelete('cascade');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('p_products');
    }
};
