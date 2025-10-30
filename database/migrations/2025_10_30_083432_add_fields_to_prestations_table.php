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
        Schema::table('prestations', function (Blueprint $table) {
            if (!Schema::hasColumn('prestations', 'prestation_type_id')) {
            $table->unsignedBigInteger('prestation_type_id')->after('insurer_id');
            $table->foreign('prestation_type_id')->references('id')->on('prestation_types')->onDelete('cascade');
            }
            if (!Schema::hasColumn('prestations', 'amount')) {
            $table->decimal('amount',10,2)->nullable()->after('prestation_type_id');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('prestations', function (Blueprint $table) {
           if (Schema::hasColumn('prestations', 'prestation_type_id')) {
                $table->dropForeign(['prestation_type_id']);
                $table->dropColumn('prestation_type_id');
            }
            if (Schema::hasColumn('prestations', 'amount')) {
                $table->dropColumn('amount');
            }
        });
    }
};
