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
        Schema::table('appointments', function (Blueprint $table) {
            if(!Schema::hasColumn('appointments', "appointment_start_time")){
                $table->time('appointment_start_time')->after('appointment_date')->nullable();
            }
            if(!Schema::hasColumn('appointments', "appointment_end_time")){
                $table->time('appointment_end_time')->after('appointment_date')->nullable();
            }
            if(!Schema::hasColumn('appointments', "comment")){
                $table->text('comment')->nullable();
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('appointments', function (Blueprint $table) {
            if(Schema::hasColumn('appointments', "appointment_start_time")){
                $table->dropColumn('appointment_start_time');
            }
            if(Schema::hasColumn('appointments', "appointment_end_time")){
                $table->dropColumn('appointment_end_time');
            }
            if(Schema::hasColumn('appointments', "comment")){
                $table->dropColumn('comment');
            }
        });
    }
};
