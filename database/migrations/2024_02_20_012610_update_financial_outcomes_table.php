<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('financial_outcomes', function (Blueprint $table) {
            $table->softDeletes();
            $table->dropColumn("unemployment_pct_year_1");
            $table->dropColumn("unemployment_pct_year_4");
            $table->integer("employed_count_year_1");
            $table->integer("unemployed_count_year_1");
            $table->integer("employed_count_year_4");
            $table->integer("unemployed_count_year_4");

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('financial_outcomes', function (Blueprint $table) {
            $table->dropColumn("deleted_at");
            $table->float("unemployment_pct_year_1");
            $table->float("unemployment_pct_year_4");
            $table->dropColumn("employed_count_year_1");
            $table->dropColumn("unemployed_count_year_1");
            $table->dropColumn("employed_count_year_4");
            $table->dropColumn("unemployed_count_year_4");
        });
        
    }
};
