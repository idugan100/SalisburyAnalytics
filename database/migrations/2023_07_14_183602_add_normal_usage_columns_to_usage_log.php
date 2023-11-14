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
        Schema::table('usage_log', function (Blueprint $table) {
            $table->integer('about_views')->default(0);
            $table->integer('course_views')->default(0);
            $table->integer('professor_views')->default(0);
            $table->integer('review_views')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('usage_log', function (Blueprint $table) {
            $table->dropColumn('about_views');
            $table->dropColumn('course_views');
            $table->dropColumn('professor_views');
            $table->dropColumn('review_views');
        });
    }
};
