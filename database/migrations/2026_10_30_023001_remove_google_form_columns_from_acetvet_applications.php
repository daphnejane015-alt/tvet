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
        Schema::table('acetvet_applications', function (Blueprint $table) {
            $table->dropColumn([
                'google_form_url',
                'google_form_submitted_at',
                'google_form_response_id',
                'agreed_to_terms',
            ]);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('acetvet_applications', function (Blueprint $table) {
            $table->string('google_form_url')->default('https://forms.gle/hk3YdAxCM1PbhnyD7')->after('phone_number');
            $table->timestamp('google_form_submitted_at')->nullable();
            $table->string('google_form_response_id')->nullable()->unique();
            $table->boolean('agreed_to_terms')->default(false);
        });
    }
};
