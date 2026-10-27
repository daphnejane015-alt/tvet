<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Clean up duplicate categories (keep the first occurrence)
        DB::statement('
            DELETE FROM categories c1
            USING categories c2
            WHERE c1.id > c2.id
            AND c1.name = c2.name
        ');

        // Clean up duplicate courses (keep the first occurrence based on name)
        DB::statement('
            DELETE FROM courses c1
            USING courses c2
            WHERE c1.id > c2.id
            AND c1.name = c2.name
        ');

        // Clean up duplicate news (keep the first occurrence based on title)
        DB::statement('
            DELETE FROM news n1
            USING news n2
            WHERE n1.id > n2.id
            AND n1.title = n2.title
        ');

        // Clean up duplicate admin users (keep the first occurrence based on email)
        DB::statement('
            DELETE FROM users u1
            USING users u2
            WHERE u1.id > u2.id
            AND u1.email = u2.email
            AND u1.role = "admin"
        ');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // No rollback needed - data is already cleaned
    }
};
