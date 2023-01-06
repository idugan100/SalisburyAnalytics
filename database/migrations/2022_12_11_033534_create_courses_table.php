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
            $table->integer('courseNumber')->unique();
            $table->string('courseTitle');
            $table->longtext('description');
            $table->integer('creditsLecture');
            $table->integer('creditsLab');
            $table->string('departmentCode');
            $table->string('syllabusLink');
            $table->integer('creditsTotal');

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
