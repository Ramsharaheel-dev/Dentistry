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
        Schema::table('users', function (Blueprint $table) {
            $table->integer('created_by')->default(0)->after('privilege');
            $table->integer('updated_by')->default(0)->after('privilege');
            $table->string('designation')->nullable()->after('privilege');
            $table->string('bio')->nullable()->after('designation');
            $table->string('gdc_number')->nullable()->after('designation');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['created_by','updated_by']);
        });
    }
};
