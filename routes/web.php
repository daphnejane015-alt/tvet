<?php

use App\Http\Controllers\CourseController;
use App\Http\Controllers\ApplicationController;
use App\Http\Controllers\UpTvetController;
use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Admin\UpTvetApplicationController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\NewsController;
use App\Models\News;
use Illuminate\Support\Facades\Route;

// ==== PUBLIC ROUTES ====
Route::get('/', function () {
    $news = News::where('is_active', true)
        ->orderBy('order')
        ->orderBy('created_at', 'desc')
        ->take(10)
        ->get();
    return view('welcome', compact('news'));
})->name('welcome');

// Route Baharu Pengenalan
Route::get('/pengenalan', function () {
    return view('pengenalan');
})->name('pengenalan');

Route::get('/courses', [CourseController::class, 'index'])->name('courses.index');
Route::get('/courses/{course}', [CourseController::class, 'show'])->name('courses.show');

// Semak status borang UP_TVET
Route::get('/up-tvet/status', [UpTvetController::class, 'checkStatus'])->name('up-tvet.status');

// ==== AUTH REQUIRED (BREEZE) ====
require __DIR__.'/auth.php';

// ==== STUDENT ROUTES ====
Route::middleware('auth')->group(function () {
    Route::get('/dashboard', function () {
        $user = auth()->user();
        if ($user->isAdmin()) {
            return redirect()->route('admin.dashboard');
        }
        $upTvetApplications = $user->upTvetApplications()->latest()->get();
        return view('dashboard', compact('upTvetApplications'));
    })->name('dashboard');

    Route::post('/courses/{course}/apply', [ApplicationController::class, 'store'])->name('applications.store');
    Route::get('/my-applications', [ApplicationController::class, 'myApplications'])->name('applications.my');

    // Permohonan Kursus TVET (Pelajar)
    Route::get('/up-tvet/form', [UpTvetController::class, 'showForm'])->name('up-tvet.form');
    Route::post('/up-tvet/confirm', [UpTvetController::class, 'confirm'])->name('up-tvet.confirm');
    Route::get('/up-tvet/{upTvetApplication}/edit', [UpTvetController::class, 'edit'])->name('up-tvet.edit');
    Route::put('/up-tvet/{upTvetApplication}', [UpTvetController::class, 'update'])->name('up-tvet.update');

    Route::get('/profile', [App\Http\Controllers\ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [App\Http\Controllers\ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [App\Http\Controllers\ProfileController::class, 'destroy'])->name('profile.destroy');
});

// ==== ADMIN ROUTES ====
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');

    Route::get('/courses', [CourseController::class, 'adminIndex'])->name('courses.index');
    Route::get('/courses/create', [CourseController::class, 'create'])->name('courses.create');
    Route::post('/courses', [CourseController::class, 'store'])->name('courses.store');
    Route::get('/courses/{course}/edit', [CourseController::class, 'edit'])->name('courses.edit');
    Route::put('/courses/{course}', [CourseController::class, 'update'])->name('courses.update');
    Route::delete('/courses/{course}', [CourseController::class, 'destroy'])->name('courses.destroy');

    Route::get('/applications', [ApplicationController::class, 'adminIndex'])->name('applications.index');
    Route::patch('/applications/{application}', [ApplicationController::class, 'updateStatus'])->name('applications.update');

    // Pengurusan Permohonan Google Form UP_TVET (Permohonan Kursus TVET)
    Route::get('/up-tvet', [UpTvetApplicationController::class, 'index'])->name('up-tvet.index');
    Route::get('/up-tvet/{upTvetApplication}/edit', [UpTvetApplicationController::class, 'edit'])->name('up-tvet.edit');
    Route::put('/up-tvet/{upTvetApplication}', [UpTvetApplicationController::class, 'update'])->name('up-tvet.update');
    Route::patch('/up-tvet/{upTvetApplication}/status', [UpTvetApplicationController::class, 'updateStatus'])->name('up-tvet.update-status');
    Route::delete('/up-tvet/{upTvetApplication}', [UpTvetApplicationController::class, 'destroy'])->name('up-tvet.destroy');

    // Pengurusan Pengguna (Senarai Pengguna)
    Route::get('/users', [UserController::class, 'index'])->name('users.index');
    Route::get('/users/{user}/edit', [UserController::class, 'edit'])->name('users.edit');
    Route::put('/users/{user}', [UserController::class, 'update'])->name('users.update');
    Route::delete('/users/{user}', [UserController::class, 'destroy'])->name('users.destroy');

    // Pengurusan Berita (News)
    Route::get('/news', [NewsController::class, 'index'])->name('news.index');
    Route::get('/news/create', [NewsController::class, 'create'])->name('news.create');
    Route::post('/news', [NewsController::class, 'store'])->name('news.store');
    Route::get('/news/{news}/edit', [NewsController::class, 'edit'])->name('news.edit');
    Route::put('/news/{news}', [NewsController::class, 'update'])->name('news.update');
    Route::delete('/news/{news}', [NewsController::class, 'destroy'])->name('news.destroy');
    Route::patch('/news/{news}/toggle-status', [NewsController::class, 'toggleStatus'])->name('news.toggle-status');
});