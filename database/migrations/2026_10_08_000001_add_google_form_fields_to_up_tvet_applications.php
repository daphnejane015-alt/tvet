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
            // Google Form specific fields
            $table->string('address')->nullable();
            $table->string('city')->nullable();
            $table->string('state')->nullable();
            $table->string('postcode')->nullable();
            $table->string('education_level')->nullable();
            $table->string('school_name')->nullable();
            $table->year('graduation_year')->nullable();
            $table->string('course_interest')->nullable();
            $table->text('why_choose_course')->nullable();
            $table->string('emergency_contact_name')->nullable();
            $table->string('emergency_contact_phone')->nullable();
            $table->string('emergency_contact_relationship')->nullable();
            $table->boolean('agreed_to_terms')->default(false);
            $table->timestamp('google_form_submitted_at')->nullable();
            $table->string('google_form_response_id')->nullable()->unique();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('up_tvet_applications', function (Blueprint $table) {
            $table->dropColumn([
                'address',
                'city',
                'state',
                'postcode',
                'education_level',
                'school_name',
                'graduation_year',
                'course_interest',
                'why_choose_course',
                'emergency_contact_name',
                'emergency_contact_phone',
                'emergency_contact_relationship',
                'agreed_to_terms',
                'google_form_submitted_at',
                'google_form_response_id',
            ]);
        });
    }
};
