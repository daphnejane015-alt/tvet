<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('courses', function (Blueprint $table) {
            $table->text('career_prospects')->nullable()->after('description');
            $table->decimal('min_salary', 8, 2)->nullable()->after('career_prospects');
            $table->decimal('max_salary', 8, 2)->nullable()->after('min_salary');
        });
    }

    public function down(): void
    {
        Schema::table('courses', function (Blueprint $table) {
            $table->dropColumn(['career_prospects', 'min_salary', 'max_salary']);
        });
    }
};