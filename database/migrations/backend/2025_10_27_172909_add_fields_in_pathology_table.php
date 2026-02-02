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
        Schema::table('pathologies', function (Blueprint $table) {
            if (Schema::hasTable('pathologies')) {
                Schema::table('pathologies', function (Blueprint $table) {
                    if (!Schema::hasColumn('pathologies', 'blood_type_id')) {
                        $table->boolean('pathology_type')->default(0)->comment("0=>principal, 1=> associé");
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
        Schema::table('pathologies', function (Blueprint $table) {
            if (Schema::hasColumn('pathologies', 'pathology_type')) {
                $table->dropColumn('pathology_type');
            }
        });
    }

};
