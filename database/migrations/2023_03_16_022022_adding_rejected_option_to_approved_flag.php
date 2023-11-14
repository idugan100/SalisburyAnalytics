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
        Schema::table('approved_flag', function (Blueprint $table) {
            Schema::table('reviews', function (Blueprint $table) {
                $table->integer('approved_flag')->default(0)->change();
            });
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('approved_flag', function (Blueprint $table) {
            Schema::table('reviews', function (Blueprint $table) {
                $table->boolean('approved_flag')->default(false)->change();
            });
        });
    }
};
