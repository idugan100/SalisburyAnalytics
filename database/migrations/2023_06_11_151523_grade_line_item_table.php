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
        Schema::create('courses_x_professors_with_grades', function (Blueprint $table) {
            $table->id();
            $table->string('semester');
            $table->integer('professor_ID');
            $table->integer('course_ID');
            $table->integer('quantity');
            $table->char('grade',1);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
};
