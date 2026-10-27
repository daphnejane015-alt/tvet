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
        Schema::table('up_tvet_applications', function (Blueprint $table) {
            // Parent information fields
            $table->string('father_name')->nullable();
            $table->string('father_contact')->nullable();
            $table->string('father_occupation')->nullable();
            $table->string('mother_name')->nullable();
            $table->string('mother_contact')->nullable();
            $table->string('mother_occupation')->nullable();
            $table->decimal('total_income', 10, 2)->nullable()->comment('Total household income in RM');

            // Invitation officer fields
            $table->string('invitation_officer_name')->nullable();
            $table->string('invitation_officer_contact')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('up_tvet_applications', function (Blueprint $table) {
            $table->dropColumn([
                'father_name',
                'father_contact',
                'father_occupation',
                'mother_name',
                'mother_contact',
                'mother_occupation',
                'total_income',
                'invitation_officer_name',
                'invitation_officer_contact',
            ]);
        });
    }
};
