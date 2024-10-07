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
        Schema::create('assign_videos', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('assigned_by')->nullable();
            $table->unsignedBigInteger('assigned_uid');
            $table->string('video_type');
            $table->unsignedBigInteger('video_id');
            $table->string('watched_time')->nullable();
            $table->string('total_length')->nullable();
            $table->date('end_date')->nullable();
            $table->time('end_time')->nullable();
            $table->enum('video_status', ['completed', 'notcompleted','inprogress'])->default('notcompleted')->nullable();
            $table->json('survey_data')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('assign_videos');
    }
};
