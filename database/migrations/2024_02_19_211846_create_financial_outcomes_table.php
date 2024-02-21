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
        Schema::create('financial_outcomes', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('program_name');
            $table->string('credential_name');
            $table->integer('median_income_year_1');
            $table->integer('median_income_year_4');
            $table->float('unemployment_pct_year_1');
            $table->float('unemployment_pct_year_4');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('financial_outcomes');
    }
};
