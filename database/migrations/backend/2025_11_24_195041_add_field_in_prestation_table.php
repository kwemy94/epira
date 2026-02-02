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
        if(Schema::hasTable('prestations')){
            Schema::table('prestations', function (Blueprint $table) {
                $table->string('amount_patient', 255)->nullable()->after('amount');
                $table->string('amount_insurer', 255)->nullable()->after('amount');
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('prestations', function (Blueprint $table) {
            $table->dropColumn('amount_patient');
            $table->dropColumn('amount_insurer');
        });
    }
};
