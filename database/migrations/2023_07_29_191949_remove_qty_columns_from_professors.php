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
        Schema::table('professors', function (Blueprint $table) {
            $table->dropColumn('qty_A');
            $table->dropColumn('qty_B');
            $table->dropColumn('qty_C');
            $table->dropColumn('qty_D');
            $table->dropColumn('qty_F');
            $table->dropColumn('qty_W');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('professors', function (Blueprint $table) {
            $table->integer('qty_A')->nullable();
            $table->integer('qty_B')->nullable();
            $table->integer('qty_C')->nullable();
            $table->integer('qty_D')->nullable();
            $table->integer('qty_F')->nullable();
            $table->integer('qty_W')->nullable();
        });
    }
};
