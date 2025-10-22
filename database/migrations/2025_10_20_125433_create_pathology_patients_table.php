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
        Schema::create('pathology_patient', function (Blueprint $table) {
            $table->id();
             $table->unsignedBigInteger('pathology_id');
            $table->unsignedBigInteger('patient_id');
            $table->foreign('pathology_id')->references('id')->on('pathologies');
            $table->foreign('patient_id')->references('id')->on('patients');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pathology_patient');
    }
};
