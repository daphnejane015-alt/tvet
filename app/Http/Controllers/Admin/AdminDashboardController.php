<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\Application;
use App\Models\UpTvetApplication;
use App\Models\User;
use App\Models\News;

class AdminDashboardController extends Controller
{
    public function index()
    {
        $totalCourses = Course::count();
        $totalStudents = User::where('role', 'student')->count();
        $totalApplications = Application::count();
        $pendingApplications = Application::where('status', 'pending')->count();
        $totalUpTvetApplications = UpTvetApplication::count();

        // 5 permohonan terkini
        $recentApplications = Application::with(['user', 'course'])
            ->latest()
            ->take(5)
            ->get();

        // 5 permohonan UP_TVET (Google Form) terkini
        $recentUpTvetApplications = UpTvetApplication::latest()
            ->take(5)
            ->get();

        // Kursus paling ramai dipohon
        $popularCourses = Course::withCount('applications')
            ->orderByDesc('applications_count')
            ->take(5)
            ->get();

        return view('admin.dashboard', compact(
            'totalCourses', 'totalStudents', 'totalApplications', 'pendingApplications',
            'totalUpTvetApplications', 'recentApplications', 'recentUpTvetApplications', 'popularCourses'
        ));
    }
}