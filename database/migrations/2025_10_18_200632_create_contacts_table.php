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
        Schema::create('contacts', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('contact_type_id')->nullable();
            $table->unsignedBigInteger('patient_id');
            $table->string('contact_name')->nullable();
            $table->string('sexe')->nullable();
            $table->string('contact_job')->nullable();
            $table->string('contact_employer')->nullable();
            $table->string('contact_address')->nullable();
            $table->string('contact_phone')->nullable();
            $table->string('cni')->nullable();
            $table->string('contact_other_phone')->nullable();
            $table->text('employer')->nullable();
            $table->string('comment')->nullable();
            $table->foreign('contact_type_id')->references('id')->on('contact_types');
            $table->foreign('patient_id')->references('id')->on('patients');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('contacts');
    }
};
