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
        Schema::create('staffs', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('staff_type_id')->nullable();
            $table->unsignedBigInteger('profesionnal_title_id')->nullable();
            $table->unsignedBigInteger('specialization_id')->nullable();
            $table->string('firstname');
            $table->string('lastname');
            $table->string('sexe');
            $table->string('email');
            $table->string('phone')->nullable();
            $table->string('fix_phone')->nullable();
            $table->string('password');
            $table->string('address')->nullable();
            $table->string('avatar')->nullable();
            $table->boolean('email_notification')->nullable();
            $table->boolean('intern')->nullable();
            $table->boolean('generic_account')->nullable();
            $table->integer('appointment_max')->nullable();
            $table->boolean('honorary_appointment')->nullable();
            $table->boolean('authorize_appointment')->nullable();
            $table->text('comment')->nullable();
            $table->foreign('staff_type_id')->references('id')->on('staff_types');
            $table->foreign('profesionnal_title_id')->references('id')->on('profesionnal_titles');
            $table->foreign('specialization_id')->references('id')->on('specializations');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('staffs');
    }
};
