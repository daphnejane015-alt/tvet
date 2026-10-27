<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\UpTvetApplication;
use Illuminate\Http\Request;

class UpTvetApplicationController extends Controller
{
    /**
     * Papar senarai pemohon yang telah melengkapkan permohonan kursus TVET
     */
    public function index(Request $request)
    {
        $search = $request->query('search');
        $status = $request->query('status');

        $query = UpTvetApplication::with('user')->latest();

        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('full_name', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%")
                  ->orWhere('ic_number', 'like', "%{$search}%")
                  ->orWhere('phone_number', 'like', "%{$search}%");
            });
        }

        if ($status && in_array($status, ['completed', 'verified', 'contacted'])) {
            $query->where('status', $status);
        }

        $applications = $query->paginate(15)->withQueryString();

        $totalCount = UpTvetApplication::count();
        $todayCount = UpTvetApplication::whereDate('completed_at', today())->count();
        $verifiedCount = UpTvetApplication::where('status', 'verified')->count();

        return view('admin.up_tvet.index', compact(
            'applications',
            'search',
            'status',
            'totalCount',
            'todayCount',
            'verifiedCount'
        ));
    }

    /**
     * Kemaskini status pemohon TVET
     */
    public function updateStatus(Request $request, UpTvetApplication $upTvetApplication)
    {
        $request->validate([
            'status' => 'required|in:completed,verified,contacted',
            'notes' => 'nullable|string|max:500',
        ]);

        $upTvetApplication->update([
            'status' => $request->status,
            'notes' => $request->notes ?? $upTvetApplication->notes,
        ]);

        return back()->with('success', 'Status pemohon ' . $upTvetApplication->full_name . ' berjaya dikemaskini.');
    }

    /**
     * Padam rekod permohonan TVET
     */
    public function destroy(UpTvetApplication $upTvetApplication)
    {
        $name = $upTvetApplication->full_name;
        $upTvetApplication->delete();

        return back()->with('success', 'Rekod permohonan untuk ' . $name . ' berjaya dipadam.');
    }

    /**
     * Papar borang edit pemohon TVET
     */
    public function edit(UpTvetApplication $upTvetApplication)
    {
        $courses = Course::with('category')->orderBy('name')->get();

        return view('admin.up_tvet.edit', compact('upTvetApplication', 'courses'));
    }

    /**
     * Kemaskini rekod pemohon UP_TVET
     */
    public function update(Request $request, UpTvetApplication $upTvetApplication)
    {
        $validated = $request->validate([
            'full_name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'ic_number' => 'nullable|string|max:30',
            'phone_number' => 'nullable|string|max:25',
            'address' => 'nullable|string|max:255',
            'city' => 'nullable|string|max:100',
            'state' => 'nullable|string|max:100',
            'postcode' => 'nullable|string|max:10',
            'education_level' => 'nullable|string|max:100',
            'school_name' => 'nullable|string|max:255',
            'graduation_year' => 'nullable|integer|min:1900|max:2100',
            'course_interest' => 'nullable|string|max:255',
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
            'status' => 'required|in:completed,verified,contacted',
            'notes' => 'nullable|string|max:500',
        ]);

        $upTvetApplication->update($validated);

        return redirect()->route('admin.up-tvet.index')->with('success', 'Rekod permohonan untuk ' . $upTvetApplication->full_name . ' berjaya dikemaskini.');
    }
}
