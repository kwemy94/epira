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
        Schema::table('patients', function (Blueprint $table) {
            if (Schema::hasTable('patients')) {
                Schema::table('patients', function (Blueprint $table) {
                    if (!Schema::hasColumn('patients', 'blood_type_id')) {
                        $table->unsignedBigInteger('blood_type_id')->nullable();
                        $table->foreign('blood_type_id')->references('id')->on('blood_types');
                    }
                });

            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('patients', function (Blueprint $table) {
            if (Schema::hasColumn('patients', 'blood_type_id')) {
                $table->dropForeign(['blood_type_id']);
                $table->dropColumn('blood_type_id');
            }
        });
    }

};
