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
        Schema::rename('up_tvet_applications', 'acetvet_applications');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::rename('acetvet_applications', 'up_tvet_applications');
    }
};
