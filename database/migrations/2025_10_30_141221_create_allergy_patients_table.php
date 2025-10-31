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
        Schema::create('allergy_patient', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('allergy_id');
            $table->unsignedBigInteger('patient_id');
            $table->date('detection_date');
            $table->date('detection_end_date')->nullable();
            $table->text('comment')->nullable();
            $table->foreign('allergy_id')->references('id')->on('allergies');
            $table->foreign('patient_id')->references('id')->on('patients');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('allergy_patient');
    }
};
