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
        Schema::create('consultations', function (Blueprint $table) {
            $table->id();
            $table->foreignId("prestation_id")->constraint('prestations')->onDelete('cascade');
            $table->string('reference');
            $table->datetime('start_date');
            $table->datetime('end_date');
            $table->string('doctor');
            $table->integer('unit_price');
            $table->integer('tarif');
            $table->boolean('paye',0);
            $table->date('payment_date')->nullable();
            $table->string('payment_mode')->nullable();
            $table->text('comment')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('consultations');
    }
};
