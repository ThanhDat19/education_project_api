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
        Schema::create('courses', function (Blueprint $table) {
            $table->id();
            $table->integer('instructor');
            $table->integer('course_category_id');
            $table->string('title');
            $table->string('slug');
            $table->text('description');
            $table->string('video_course')->nullable();
            $table->integer('price');
            $table->string('course_image');
            $table->timestamp('start_date');
            $table->integer('published');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('courses');
    }
};
