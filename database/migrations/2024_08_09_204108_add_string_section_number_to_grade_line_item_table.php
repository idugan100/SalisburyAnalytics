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
        Schema::table('courses_x_professors_with_grades', function (Blueprint $table) {
            $table->string('section_number')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('courses_x_professors_with_grades', function (Blueprint $table) {
            $table->integer('section_number')->nullable()->change();
        });
    }
};
