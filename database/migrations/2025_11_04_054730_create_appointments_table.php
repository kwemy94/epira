<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        if (!Schema::hasTable('appointments')) {
            Schema::create('appointments', function (Blueprint $table) {
                $table->id();
                $table->unsignedBigInteger('staff_id');
                $table->unsignedBigInteger('patient_id');
                $table->date('appointment_date');
                $table->time('appointment_start_time')->nullable();
                $table->time('appointment_end_time')->nullable();
                $table->text('comment')->nullable();
                $table->foreign('staff_id')->references('id')->on('staffs');
                $table->foreign('patient_id')->references('id')->on('patients');
                $table->timestamps();
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('appointments');
    }
};
