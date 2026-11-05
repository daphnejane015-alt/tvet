<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\UpTvetApplication;
use App\Models\User;
use App\Models\News;

class AdminDashboardController extends Controller
{
    public function index()
    {
        $totalCourses = Course::count();
        $totalStudents = User::where('role', 'student')->count();
        $totalUpTvetApplications = UpTvetApplication::count();
        $pendingApplications = UpTvetApplication::where('status', 'completed')->count();

        // 5 permohonan UP_TVET terkini
        $recentUpTvetApplications = UpTvetApplication::latest()
            ->take(5)
            ->get();

        // Ambil semua kursus yang wujud di laman pengguna beserta kategori
        $allCourses = Course::with('category')->get();

        // Hitung bilangan pendaftaran per kursus daripada acetvet_applications (berdasarkan course_interest)
        $upTvetCounts = UpTvetApplication::select('course_interest', \DB::raw('count(*) as total'))
            ->whereNotNull('course_interest')
            ->where('course_interest', '!=', '')
            ->groupBy('course_interest')
            ->pluck('total', 'course_interest');

        // Petakan setiap kursus kepada jumlah pemohon sebenar
        $popularCourses = $allCourses->map(function ($course) use ($upTvetCounts) {
            $upCount = $upTvetCounts->get($course->name, 0);

            // Jumlah keseluruhan pendaftaran bagi kursus ini
            $course->total_registered = $upCount;
            $course->uptvet_count = $upCount;

            // Dapatkan senarai 3 pemohon terkini untuk dipaparkan secara langsung (detail preview)
            $course->latest_applicants = UpTvetApplication::where('course_interest', $course->name)
                ->latest()
                ->take(3)
                ->get(['id', 'full_name', 'email', 'phone_number', 'status', 'completed_at', 'created_at']);

            return $course;
        })->sortByDesc('total_registered')->values();

        return view('admin.dashboard', compact(
            'totalCourses', 'totalStudents', 'pendingApplications',
            'totalUpTvetApplications', 'recentUpTvetApplications', 'popularCourses'
        ));
    }

    /**
     * Paparan terperinci bagi semua Kursus Paling Diminati & Analisis Pemohon
     */
    public function popularCoursesDetails()
    {
        $allCourses = Course::with('category')->get();

        $upTvetCounts = UpTvetApplication::select('course_interest', \DB::raw('count(*) as total'))
            ->whereNotNull('course_interest')
            ->where('course_interest', '!=', '')
            ->groupBy('course_interest')
            ->pluck('total', 'course_interest');

        $courses = $allCourses->map(function ($course) use ($upTvetCounts) {
            $upCount = $upTvetCounts->get($course->name, 0);

            $course->total_registered = $upCount;
            $course->uptvet_count = $upCount;

            // Dapatkan pemohon untuk kursus ini
            $course->applicants = UpTvetApplication::where('course_interest', $course->name)
                ->latest()
                ->get();

            return $course;
        })->sortByDesc('total_registered')->values();

        $totalRegistrations = $courses->sum('total_registered');

        return view('admin.courses.popular', compact('courses', 'totalRegistrations'));
    }
}