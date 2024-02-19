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
        Schema::create('student_demographics', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            //ethnicity 
            $table->float("native_american_pct");
            $table->float("pacific_islander_pct");
            $table->float("asian_pct");
            $table->float("black_pct");
            $table->float("white_pct");
            $table->float("hispanic_pct");
            $table->float("two_or_more_races_pct");
            $table->float("unknow_race_pct");
            //gender 
            $table->float("male_pct");
            $table->float("non_male_pct");
            //parental education
            $table->float("middle_school_pct");
            $table->float("high_school_pct");
            $table->float("some_college_pct");
            $table->float("college_degree_pct");
            //student type
            $table->integer("undergraduate_count");
            $table->integer("graduate_count");
            //parental income
            $table->float("pct_0_30000");
            $table->float("pct_30001_48000");
            $table->float("pct_48001_75000");
            $table->float("pct_75001_110000");
            $table->float("pct_110001_greater");
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('student_demographics');
    }
};
