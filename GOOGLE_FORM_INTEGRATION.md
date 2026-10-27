# Google Form Integration Guide

## Overview
The TVET system now has a comprehensive Google Form integration that allows users to submit UP_TVET applications through Google Forms, with the data being captured and displayed in both the admin panel and user dashboard.

## Features Implemented

### 1. Enhanced Database Schema
Added the following fields to the `up_tvet_applications` table:
- `address` - Full address
- `city` - City/town
- `state` - State
- `postcode` - Postal code
- `education_level` - Education level (SPM, STPM, Diploma, etc.)
- `school_name` - Name of last school
- `graduation_year` - Year of graduation
- `course_interest` - Course of interest
- `why_choose_course` - Reason for choosing the course
- `emergency_contact_name` - Emergency contact person
- `emergency_contact_phone` - Emergency contact phone
- `emergency_contact_relationship` - Relationship to emergency contact
- `agreed_to_terms` - Whether user agreed to terms
- `google_form_submitted_at` - Timestamp of Google Form submission
- `google_form_response_id` - Unique ID from Google Form response

### 2. Admin Panel Enhancements
**Location:** `/admin/up-tvet`

- **Enhanced Table View:** Shows all form data including course interest, location, and status
- **Detailed Modal:** View complete applicant information with all new fields
- **Status Management:** Update application status (completed, verified, contacted)
- **Search & Filter:** Search by name, email, IC, phone; filter by status
- **Statistics:** Total applications, today's applications, verified count

### 3. User Dashboard Updates
**Location:** `/dashboard`

- **Status Display:** Shows current application status (completed, verified, contacted)
- **Course Interest:** Displays the course the user is interested in
- **Enhanced Modal:** Shows all submitted form data when user clicks "Lihat Rekod UP_TVET"

### 4. Manual Sync Command
**Command:** `php artisan up-tvet:sync-google-form`

An interactive command that allows admins to manually sync Google Form responses with the database. This is useful for:
- Testing the integration
- Manual data entry from Google Sheets
- Emergency data updates

## How It Works

### User Flow:
1. User logs in to the system
2. User clicks "Mohon UP_TVET" button
3. Modal opens with two-step process:
   - **Step 1:** User opens Google Form and fills it out
   - **Step 2:** User returns and confirms completion by entering their details
4. Data is saved to the `up_tvet_applications` table
5. User can view their application status in the dashboard
6. Admin can view and manage all applications in the admin panel

### Admin Flow:
1. Admin logs in and navigates to `/admin/up-tvet`
2. Admin sees list of all applicants with key information
3. Admin can:
   - Search for specific applicants
   - Filter by status
   - View detailed applicant information
   - Update application status
   - Add notes
   - Delete applications

## Current Implementation

### Manual Data Entry Mode
Currently, the system uses a manual confirmation flow where:
- Users fill out the Google Form externally
- Users return to the website to confirm and enter their details
- Data is stored in the local database
- Admins can view and manage the data

### Future Enhancement: Automatic Google Sheets API Sync

To enable automatic synchronization with Google Sheets, follow these steps:

1. **Create Google Cloud Project:**
   - Go to console.cloud.google.com
   - Create a new project
   - Enable Google Sheets API

2. **Create Service Account:**
   - Go to IAM & Admin > Service Accounts
   - Create a service account
   - Download the JSON credentials file

3. **Share Google Sheet:**
   - Open your Google Form's linked spreadsheet
   - Share with the service account email (give Editor access)

4. **Install Google Client Library:**
   ```bash
   composer require google/apiclient:^2.0
   ```

5. **Configure Credentials:**
   - Add the JSON credentials to your project
   - Update `.env` with credentials path

6. **Create Sync Script:**
   - Implement a scheduled task to fetch data from Google Sheets
   - Map Google Form responses to database fields
   - Handle duplicates and updates

## Database Migration

The migration file has been applied:
- File: `2026_10_08_000001_add_google_form_fields_to_up_tvet_applications.php`
- Status: ✓ Completed

## Files Modified

### Backend:
- `app/Models/UpTvetApplication.php` - Added new fillable fields
- `app/Http/Controllers/UpTvetController.php` - Updated validation and data saving
- `app/Console/Commands/SyncGoogleFormResponses.php` - New manual sync command
- `database/migrations/2026_10_08_000001_add_google_form_fields_to_up_tvet_applications.php` - New migration

### Frontend:
- `resources/views/admin/up_tvet/index.blade.php` - Enhanced admin view
- `resources/views/dashboard.blade.php` - Updated status display
- `resources/views/components/up-tvet-modal.blade.php` - Enhanced form fields and display

## Testing

The integration has been tested and verified:
- ✓ Database schema updated successfully
- ✓ New fields are being saved correctly
- ✓ User relationship working
- ✓ Admin panel displays all data
- ✓ User dashboard shows status updates
- ✓ Manual sync command operational

## Google Form URL
Current Google Form: https://forms.gle/hk3YdAxCM1PbhnyD7

## Status Values
- `completed` - User has filled the form and confirmed
- `verified` - Admin has verified the application
- `contacted` - Admin has contacted the applicant

## Support
For issues or questions:
1. Check the Laravel logs: `storage/logs/laravel.log`
2. Verify database connection in `.env`
3. Ensure migrations are applied: `php artisan migrate:status`
4. Test with the sync command: `php artisan up-tvet:sync-google-form`
