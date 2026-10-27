<?php

namespace App\Http\Controllers;

use App\Models\Application;
use App\Models\Course;
use Illuminate\Http\Request;

class ApplicationController extends Controller
{
    // Pelajar hantar permohonan
    public function store(Request $request, Course $course)
    {
        $exists = Application::where('user_id', auth()->id())
            ->where('course_id', $course->id)
            ->exists();

        if ($exists) {
            return back()->with('error', 'Anda sudah memohon kursus ini.');
        }

        Application::create([
            'user_id' => auth()->id(),
            'course_id' => $course->id,
            'status' => 'pending',
        ]);

        return back()->with('success', 'Permohonan berjaya dihantar.');
    }

    // Pelajar lihat status permohonan sendiri
    public function myApplications()
    {
        $applications = Application::with('course')
            ->where('user_id', auth()->id())
            ->latest()
            ->get();

        return view('applications.my', compact('applications'));
    }

    // Admin lihat semua permohonan
    public function adminIndex()
    {
        $applications = Application::with(['user', 'course'])->latest()->get();
        return view('admin.applications.index', compact('applications'));
    }

    // Admin lulus/tolak permohonan
    public function updateStatus(Request $request, Application $application)
    {
        $request->validate([
            'status' => 'required|in:approved,rejected',
        ]);

        $application->update(['status' => $request->status]);

        return back()->with('success', 'Status permohonan dikemaskini.');
    }
}
