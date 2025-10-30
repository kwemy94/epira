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
        if (!Schema::hasTable('patients')) {
            return;
        }

        Schema::table('patients', function (Blueprint $table) {

            $stringFields = ['sport_type', 'sport_frequency', 'fat_food', 'salt_consumption', 'water_consumption', 'stimulant_consumption'];

            $booleanFields = ['walk', 'sedentary'];

            $timeFields = ['breakfast_time', 'lunch_time', 'dinner_time', 'snack_time'];

            foreach ($stringFields as $field) {
                if (!Schema::hasColumn('patients', $field)) {
                    $table->string($field)->nullable();
                }
            }

            if (!Schema::hasColumn('patients', 'fat_food_comment')) {
                $table->text('fat_food_comment')->nullable();
            }

            foreach ($timeFields as $field) {
                if (!Schema::hasColumn('patients', $field)) {
                    $table->time($field)->nullable();
                }
            }

            foreach ($booleanFields as $field) {
                if (!Schema::hasColumn('patients', $field)) {
                    $table->boolean($field)->default(false);
                }
            }

            if (!Schema::hasColumn('patients', 'sleep_time')) {
                $table->decimal('sleep_time', 4, 1)->nullable();
            }
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        if (!Schema::hasTable('patients')) {
            return;
        }

        Schema::table('patients', function (Blueprint $table) {

            $columns = [
                # chaînes de caractères
                'sport_type',
                'sport_frequency',
                'fat_food',
                'salt_consumption',
                'water_consumption',
                'stimulant_consumption',

                # booléens
                'walk',
                'sedentary',

                # heures
                'breakfast_time',
                'lunch_time',
                'dinner_time',
                'snack_time',

                # texte et numérique
                'fat_food_comment',
                'sleep_time'
            ];

            foreach ($columns as $column) {
                if (Schema::hasColumn('patients', $column)) {
                    $table->dropColumn($column);
                }
            }
        });
    }

};
