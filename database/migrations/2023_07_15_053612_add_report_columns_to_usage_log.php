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
            $table->integer('report_views')->default(0);
            $table->integer('report_views_bot')->default(0);
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
            $table->dropColumn('report_views');
            $table->integer('report_views_bot');
        });
    }
};
