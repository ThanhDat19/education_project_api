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
        Schema::create('lesson_students', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id');
            $table->integer('lesson_id');
            $table->integer('course_id');
            $table->integer('watched_video');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lesson_students');
    }
};
