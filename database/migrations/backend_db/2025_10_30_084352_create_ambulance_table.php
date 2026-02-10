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
        Schema::create('ambulances', function (Blueprint $table) {
            $table->id();
              $table->foreignId("prestation_id")->constraint('prestations')->onDelete('cascade');
            $table->string('referene');
            $table->datetime('start_date');
            $table->datetime('end_date');
            $table->string('doctor');
            $table->string('service');
            $table->string('type_ambulance');
            $table->string('motif')->nullable();
            $table->text('comment')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ambulances');
    }
};
