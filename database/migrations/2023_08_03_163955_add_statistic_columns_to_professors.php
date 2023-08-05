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
            $table->integer("total_enrollment");
            $table->float("W_rate");
            $table->float("A_rate");
            $table->float("B_rate");
            $table->float("C_rate");
            $table->float("D_rate");
            $table->float("F_rate");
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
            $table->dropColumn("total_enrollment");
            $table->dropColumn("W_rate");
            $table->dropColumn("A_rate");
            $table->dropColumn("B_rate");
            $table->dropColumn("C_rate");
            $table->dropColumn("D_rate");
            $table->dropColumn("F_rate");
 
        });
    }
};
