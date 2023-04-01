<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('courses', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->integer('courseNumber');
            $table->string('courseTitle');
            $table->longtext('description')->nullable();
            $table->integer('creditsLecture')->nullable();
            $table->integer('creditsLab')->nullable();
            $table->string('departmentCode');
            $table->string('syllabusLink')->nullable();
            $table->integer('creditsTotal')->nullable();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('courses');
    }
};
