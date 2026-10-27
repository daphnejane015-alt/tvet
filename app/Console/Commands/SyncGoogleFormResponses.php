<?php

namespace App\Console\Commands;

use App\Models\UpTvetApplication;
use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

class SyncGoogleFormResponses extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'up-tvet:sync-google-form';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Sync Google Form responses with local database (Manual Entry Mode)';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('=== Google Form Sync Command ===');
        $this->info('This command helps you manually sync Google Form responses.');
        $this->newLine();

        $this->warn('To automatically sync with Google Sheets API, you need to:');
        $this->warn('1. Create a Google Cloud Project');
        $this->warn('2. Enable Google Sheets API');
        $this->warn('3. Create service account credentials');
        $this->warn('4. Share your Google Sheet with the service account email');
        $this->warn('5. Install: composer require google/apiclient:^2.0');
        $this->newLine();

        $this->info('For now, you can manually add/update form responses using this interactive mode.');
        $this->newLine();

        if (!$this->confirm('Do you want to add/update a Google Form response manually?')) {
            $this->info('Operation cancelled.');
            return Command::SUCCESS;
        }

        $email = $this->ask('Enter the user email address');

        $user = User::where('email', $email)->first();

        if (!$user) {
            $this->error("User with email '{$email}' not found.");
            return Command::FAILURE;
        }

        $this->info("Found user: {$user->name}");

        // Check if application exists
        $application = UpTvetApplication::where('user_id', $user->id)->first();

        if ($application) {
            $this->info("Existing application found. Updating it...");
        } else {
            $this->info("Creating new application...");
            $application = new UpTvetApplication();
            $application->user_id = $user->id;
            $application->full_name = $user->name;
            $application->email = $user->email;
        }

        // Collect form data
        $application->ic_number = $this->ask('IC Number', $application->ic_number);
        $application->phone_number = $this->ask('Phone Number', $application->phone_number);
        $application->address = $this->ask('Address', $application->address);
        $application->city = $this->ask('City', $application->city);
        $application->state = $this->ask('State', $application->state);
        $application->postcode = $this->ask('Postcode', $application->postcode);
        $application->education_level = $this->ask('Education Level', $application->education_level);
        $application->school_name = $this->ask('School Name', $application->school_name);
        $application->graduation_year = $this->ask('Graduation Year', $application->graduation_year);
        $application->course_interest = $this->ask('Course Interest', $application->course_interest);
        $application->why_choose_course = $this->ask('Why Choose Course (optional)', $application->why_choose_course);
        $application->emergency_contact_name = $this->ask('Emergency Contact Name', $application->emergency_contact_name);
        $application->emergency_contact_phone = $this->ask('Emergency Contact Phone', $application->emergency_contact_phone);
        $application->emergency_contact_relationship = $this->ask('Emergency Contact Relationship', $application->emergency_contact_relationship);
        $application->google_form_response_id = $this->ask('Google Form Response ID (optional)', $application->google_form_response_id);
        $application->google_form_submitted_at = $this->ask('Google Form Submitted At (YYYY-MM-DD HH:MM:SS)', $application->google_form_submitted_at);
        $application->agreed_to_terms = $this->confirm('Agreed to terms?', $application->agreed_to_terms ?? true);
        $application->status = $this->choice('Status', ['completed', 'verified', 'contacted'], $application->status ?? 'completed');
        $application->notes = $this->ask('Admin Notes (optional)', $application->notes);
        $application->completed_at = $application->completed_at ?? now();
        $application->google_form_submitted_at = $application->google_form_submitted_at ?? now();

        $application->save();

        $this->newLine();
        $this->info('✓ Application saved successfully!');
        $this->table(
            ['Field', 'Value'],
            [
                ['Full Name', $application->full_name],
                ['Email', $application->email],
                ['IC Number', $application->ic_number],
                ['Phone', $application->phone_number],
                ['Address', $application->address],
                ['City', $application->city],
                ['State', $application->state],
                ['Education', $application->education_level],
                ['Course Interest', $application->course_interest],
                ['Status', $application->status],
            ]
        );

        Log::info('Google Form response synced manually', [
            'user_id' => $user->id,
            'email' => $user->email,
            'application_id' => $application->id,
        ]);

        return Command::SUCCESS;
    }
}
