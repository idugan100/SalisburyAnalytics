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
        Schema::create('usage_log', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->integer("about_views")->default(0);
            $table->integer("course_views")->default(0);
            $table->integer("professor_views")->default(0);
            $table->integer("review_views")->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('usage_log');
    }
};
