<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CourseController extends Controller
{
    // Senarai kursus (public)
    public function index()
    {
        $courses = Course::with('category')->latest()->paginate(9);
        $categories = Category::withCount('courses')->get();
        return view('courses.index', compact('courses', 'categories'));
    }

    // Papar satu kursus (public)
    public function show(Course $course)
    {
        return view('courses.show', compact('course'));
    }

    // Form tambah kursus (admin)
    public function create()
    {
        $categories = Category::all();
        return view('admin.courses.create', compact('categories'));
    }

    // Simpan kursus baru (admin)
    public function store(Request $request)
    {
        $validated = $request->validate([
            'category_id' => 'required|exists:categories,id',
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'career_prospects' => 'nullable|string',
            'min_salary' => 'nullable|numeric|min:0',
            'max_salary' => 'nullable|numeric|min:0|gte:min_salary',
            'duration' => 'nullable|string|max:100',
            'image' => 'nullable|image|max:5120',
        ]);

        $validated['slug'] = Str::slug($validated['name']) . '-' . uniqid();

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('courses', 'public');
        }

        Course::create($validated);

        return redirect()->route('admin.courses.index')->with('success', 'Kursus berjaya ditambah.');
    }

    // Form edit kursus (admin)
    public function edit(Course $course)
    {
        $categories = Category::all();
        return view('admin.courses.edit', compact('course', 'categories'));
    }

    // Kemaskini kursus (admin)
    public function update(Request $request, Course $course)
    {
        $validated = $request->validate([
            'category_id' => 'required|exists:categories,id',
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'career_prospects' => 'nullable|string',
            'min_salary' => 'nullable|numeric|min:0',
            'max_salary' => 'nullable|numeric|min:0|gte:min_salary',
            'duration' => 'nullable|string|max:100',
            'image' => 'nullable|image|max:5120',
        ]);

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('courses', 'public');
        }

        $course->update($validated);

        return redirect()->route('admin.courses.index')->with('success', 'Kursus berjaya dikemaskini.');
    }

    // Padam kursus (admin)
    public function destroy(Course $course)
    {
        $course->delete();
        return redirect()->route('admin.courses.index')->with('success', 'Kursus berjaya dipadam.');
    }

    // Senarai kursus untuk admin
    public function adminIndex()
    {
        $courses = Course::with('category')->latest()->get();
        return view('admin.courses.index', compact('courses'));
    }
}