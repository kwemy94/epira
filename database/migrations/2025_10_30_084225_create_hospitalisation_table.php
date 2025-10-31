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
        Schema::create('hospitalisations', function (Blueprint $table) {
            $table->id();
            $table->foreignId("prestation_id")->constraint('prestations')->onDelete('cascade');
            $table->date('enter_date');
            $table->date('exit_date');
            $table->string('doctor');
            $table->string('reference');
            $table->string('motif')->nullable();
            $table->string('service');
            $table->string('chambre')->nullable();
            $table->text('comment')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('hospitalisations');
    }
};
