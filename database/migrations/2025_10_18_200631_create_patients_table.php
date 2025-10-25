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
        Schema::create('patients', function (Blueprint $table) {
            $table->id();
            $table->string('reference');
            $table->string('lastname');
            $table->string('firstname')->nullable();
            $table->string('sexe');
            $table->unsignedBigInteger('category_id')->nullable();
            $table->string('address')->nullable();
            $table->string('birth_date')->nullable();
            $table->unsignedBigInteger('matrimonial_id')->nullable();
            $table->string('birth_place')->nullable();
            $table->foreign('category_id')->references('id')->on('categories');
            $table->foreign('matrimonial_id')->references('id')->on('matrimonials');
            
            $table->string('mother_name')->nullable();
            $table->string('maiden_name')->nullable();
            $table->unsignedBigInteger('country_id')->nullable();
            $table->string('phone')->nullable();
            $table->string('email')->nullable();
            $table->string('other_phone')->nullable();
            $table->unsignedBigInteger('document_type')->nullable();
            $table->string('document_number')->nullable();
            $table->foreign('country_id')->references('id')->on('countries');

            $table->string('father_name')->nullable();
            $table->string('job')->nullable();
            $table->unsignedBigInteger('study_level_id')->nullable();
            $table->string('other_level_study')->nullable();
            $table->integer('spouce_age')->nullable();
            $table->string('spouce_job')->nullable();
            $table->string('nationality')->nullable();
            $table->string('employer')->nullable();
            $table->string('inter_reference')->nullable();
            $table->foreign('study_level_id')->references('id')->on('study_levels');

            # Groupe sanguin & habitude de vie
            $table->string('blood_group')->nullable();
            $table->double('weight')->nullable();
            $table->double('height')->nullable();
            $table->string('gsr')->nullable();
            $table->double('imc')->nullable();
            $table->boolean('smook')->nullable();
            $table->boolean('sport_pratice')->nullable();
            $table->boolean('herbal_medicine')->nullable();
            $table->text('other_information')->nullable();

            # antécédent
            $table->text('family_history')->nullable();
            $table->text('medical_history')->nullable();
            $table->text('surgical_history')->nullable();
            $table->text('genetic_history')->nullable();
            $table->text('other_history')->nullable();

            # Conditions de travail & Hygiène de vie
            $table->boolean('physical_overload')->nullable();
            $table->boolean('exhaustion')->nullable();
            $table->boolean('mental_overload')->nullable();
            $table->boolean('harassment')->nullable();
            $table->double('daily_working_hours')->nullable();
            $table->double('weekly_working_hours')->nullable();
            $table->boolean('fulfilment')->nullable();
            $table->boolean('motivation')->nullable();
            $table->boolean('boredom')->nullable();
            $table->boolean('stress')->nullable();

            $table->boolean('sedentarity')->nullable();
            $table->boolean('regular_walk')->nullable();
            $table->string('sport_type')->nullable();
            $table->string('sport_periode')->nullable();
            

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('patients');
    }
};
