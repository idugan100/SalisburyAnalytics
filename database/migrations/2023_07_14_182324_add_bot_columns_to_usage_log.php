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
            $table->renameColumn('about_views', 'about_views_bot');
            $table->renameColumn('course_views', 'course_views_bot');
            $table->renameColumn('review_views', 'review_views_bot');
            $table->renameColumn('professor_views', 'professor_views_bot');

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
            $table->renameColumn('about_views_bot', 'about_views');
            $table->renameColumn('course_views_bot', 'course_views');
            $table->renameColumn('review_views_bot', 'review_views');
            $table->renameColumn('professor_views_bot', 'professor_views');
        });
    }
};
