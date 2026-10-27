<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\UpTvetApplication;
use App\Models\User;
use App\Mail\UpTvetUserConfirmationMail;
use App\Mail\UpTvetAdminNotificationMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;

class UpTvetController extends Controller
{
    /**
     * Papar borang permohonan TVET
     */
     public function showForm()
     {
         if (!auth()->check()) {
             return redirect()->route('login')->with('info', 'Sila log masuk untuk mengisi borang permohonan TVET.');
         }

         $courses = Course::with('category')->orderBy('name')->get();
         $latestApp = auth()->user()->upTvetApplication;

         return view('up_tvet_form', compact('courses', 'latestApp'));
     }

    /**
     * Semak status permohonan UP_TVET pengguna semasa (JSON)
     */
    public function checkStatus()
    {
        if (!auth()->check()) {
            return response()->json([
                'authenticated' => false,
                'completed' => false,
                'google_form_url' => 'https://forms.gle/hk3YdAxCM1PbhnyD7',
            ]);
        }

        $user = auth()->user();
        $application = $user->upTvetApplication;

        return response()->json([
            'authenticated' => true,
            'completed' => $application ? true : false,
            'application' => $application ? [
                'full_name' => $application->full_name,
                'email' => $application->email,
                'ic_number' => $application->ic_number,
                'phone_number' => $application->phone_number,
                'status' => $application->status,
                'completed_at' => $application->completed_at ? $application->completed_at->format('d/m/Y, h:i A') : $application->created_at->format('d/m/Y, h:i A'),
            ] : null,
            'google_form_url' => 'https://forms.gle/hk3YdAxCM1PbhnyD7',
        ]);
    }

    /**
     * Pengesahan pengguna bahawa telah mengisi Google Form / Borang TVET
     */
    public function confirm(Request $request)
    {
        $user = auth()->user();

        // Semak jika pengguna sudah pernah memohon kursus yang sama
        $requestedCourse = $request->input('course_interest');
        if ($requestedCourse) {
            $existingSameCourse = UpTvetApplication::where('user_id', $user->id)
                ->where('course_interest', $requestedCourse)
                ->first();
            if ($existingSameCourse) {
                return back()->withInput()->with('up_tvet_error', 'Anda telah pun memohon kursus "' . $requestedCourse . '" sebelum ini. Anda boleh memilih kursus lain atau mengemaskini permohonan sedia ada.');
            }
        }

        $validated = $request->validate([
            'ic_number' => 'required|string|max:30',
            'phone_number' => 'required|string|max:25',
            'address' => 'nullable|string|max:255',
            'city' => 'nullable|string|max:100',
            'state' => 'nullable|string|max:100',
            'postcode' => 'nullable|string|max:10',
            'education_level' => 'nullable|string|max:100',
            'school_name' => 'nullable|string|max:255',
            'graduation_year' => 'nullable|integer|min:1900|max:2100',
            'course_interest' => 'required|string|max:255',
            'why_choose_course' => 'nullable|string|max:1000',
            'emergency_contact_name' => 'nullable|string|max:255',
            'emergency_contact_phone' => 'nullable|string|max:25',
            'emergency_contact_relationship' => 'nullable|string|max:100',
            'father_name' => 'nullable|string|max:255',
            'father_contact' => 'nullable|string|max:25',
            'father_occupation' => 'nullable|string|max:255',
            'mother_name' => 'nullable|string|max:255',
            'mother_contact' => 'nullable|string|max:25',
            'mother_occupation' => 'nullable|string|max:255',
            'total_income' => 'nullable|numeric|min:0',
            'invitation_officer_name' => 'nullable|string|max:255',
            'invitation_officer_contact' => 'nullable|string|max:25',
            'notes' => 'nullable|string|max:500',
        ]);

        $application = UpTvetApplication::create([
            'user_id' => $user->id,
            'full_name' => $user->name,
            'email' => $user->email,
            'ic_number' => $validated['ic_number'] ?? null,
            'phone_number' => $validated['phone_number'] ?? null,
            'address' => $validated['address'] ?? null,
            'city' => $validated['city'] ?? null,
            'state' => $validated['state'] ?? null,
            'postcode' => $validated['postcode'] ?? null,
            'education_level' => $validated['education_level'] ?? null,
            'school_name' => $validated['school_name'] ?? null,
            'graduation_year' => $validated['graduation_year'] ?? null,
            'course_interest' => $validated['course_interest'] ?? null,
            'why_choose_course' => $validated['why_choose_course'] ?? null,
            'emergency_contact_name' => $validated['emergency_contact_name'] ?? null,
            'emergency_contact_phone' => $validated['emergency_contact_phone'] ?? null,
            'emergency_contact_relationship' => $validated['emergency_contact_relationship'] ?? null,
            'father_name' => $validated['father_name'] ?? null,
            'father_contact' => $validated['father_contact'] ?? null,
            'father_occupation' => $validated['father_occupation'] ?? null,
            'mother_name' => $validated['mother_name'] ?? null,
            'mother_contact' => $validated['mother_contact'] ?? null,
            'mother_occupation' => $validated['mother_occupation'] ?? null,
            'total_income' => $validated['total_income'] ?? null,
            'invitation_officer_name' => $validated['invitation_officer_name'] ?? null,
            'invitation_officer_contact' => $validated['invitation_officer_contact'] ?? null,
            'notes' => $validated['notes'] ?? null,
            'google_form_url' => 'https://forms.gle/hk3YdAxCM1PbhnyD7',
            'status' => 'completed',
            'completed_at' => now(),
            'google_form_submitted_at' => now(),
            'agreed_to_terms' => true,
        ]);

        // Hantar emel pengesahan kepada pelajar dan notifikasi kepada admin
        try {
            // Emel Pelajar
            Mail::to($user->email)->send(new UpTvetUserConfirmationMail($application));

            // Emel Pentadbir
            $adminEmails = User::where('role', 'admin')->pluck('email')->filter()->toArray();
            if (empty($adminEmails)) {
                $adminEmails = ['admin@tvet.com'];
            }
            Mail::to($adminEmails)->send(new UpTvetAdminNotificationMail($application));
        } catch (\Exception $e) {
            Log::warning('UP_TVET Email Sending Notice: ' . $e->getMessage());
        }

        return redirect()->route('dashboard')->with('up_tvet_success', 'Permohonan borang TVET anda untuk kursus "' . ($application->course_interest ?? '') . '" berjaya direkodkan!');
    }

    /**
     * Papar borang kemaskini permohonan TVET oleh pengguna
     */
    public function edit(UpTvetApplication $upTvetApplication)
    {
        // Pastikan hanya pemilik permohonan atau admin boleh kemaskini
        if (auth()->id() !== $upTvetApplication->user_id && !auth()->user()->isAdmin()) {
            abort(403, 'Akses tidak dibenarkan.');
        }

        $courses = Course::with('category')->orderBy('name')->get();

        return view('up_tvet_edit', compact('upTvetApplication', 'courses'));
    }

    /**
     * Kemaskini permohonan TVET oleh pengguna
     */
    public function update(Request $request, UpTvetApplication $upTvetApplication)
    {
        if (auth()->id() !== $upTvetApplication->user_id && !auth()->user()->isAdmin()) {
            abort(403, 'Akses tidak dibenarkan.');
        }

        $validated = $request->validate([
            'ic_number' => 'required|string|max:30',
            'phone_number' => 'required|string|max:25',
            'address' => 'nullable|string|max:255',
            'city' => 'nullable|string|max:100',
            'state' => 'nullable|string|max:100',
            'postcode' => 'nullable|string|max:10',
            'education_level' => 'nullable|string|max:100',
            'school_name' => 'nullable|string|max:255',
            'graduation_year' => 'nullable|integer|min:1900|max:2100',
            'course_interest' => 'required|string|max:255',
            'why_choose_course' => 'nullable|string|max:1000',
            'emergency_contact_name' => 'nullable|string|max:255',
            'emergency_contact_phone' => 'nullable|string|max:25',
            'emergency_contact_relationship' => 'nullable|string|max:100',
            'father_name' => 'nullable|string|max:255',
            'father_contact' => 'nullable|string|max:25',
            'father_occupation' => 'nullable|string|max:255',
            'mother_name' => 'nullable|string|max:255',
            'mother_contact' => 'nullable|string|max:25',
            'mother_occupation' => 'nullable|string|max:255',
            'total_income' => 'nullable|numeric|min:0',
            'invitation_officer_name' => 'nullable|string|max:255',
            'invitation_officer_contact' => 'nullable|string|max:25',
            'notes' => 'nullable|string|max:500',
        ]);

        // Semak jika menukar ke kursus yang sudah dipohon dalam permohonan lain oleh pengguna sama
        if ($request->course_interest !== $upTvetApplication->course_interest) {
            $duplicate = UpTvetApplication::where('user_id', auth()->id())
                ->where('id', '!=', $upTvetApplication->id)
                ->where('course_interest', $request->course_interest)
                ->exists();
            if ($duplicate) {
                return back()->withInput()->with('up_tvet_error', 'Anda telah pun memohon kursus "' . $request->course_interest . '" dalam rekod permohonan lain.');
            }
        }

        $upTvetApplication->update($validated);

        return redirect()->route('dashboard')->with('success', 'Permohonan kursus "' . $upTvetApplication->course_interest . '" berjaya dikemaskini.');
    }
}
